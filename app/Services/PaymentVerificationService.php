<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\Order;
use App\Models\UsedMutation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentVerificationService
{
    public function verify(Order $order, ?int $actorId = null): array
    {
        return DB::transaction(function () use ($order, $actorId) {
            $order = Order::query()
                ->with(['payment', 'items.book'])
                ->lockForUpdate()
                ->findOrFail($order->id);

            if (in_array($order->status, ['paid', 'expired'], true)) {
                return ['status' => $order->status];
            }

            if (!$order->payment) {
                $order->update(['status' => 'failed']);
                AuditLog::log($actorId, 'payment_missing', 'order', $order->id);
                return ['status' => 'failed'];
            }

            if ($order->expires_at && now()->greaterThan($order->expires_at)) {
                $order->update(['status' => 'expired']);
                $order->payment->update(['status' => 'expired']);
                app(QrCleanupService::class)->cleanup($order);

                AuditLog::log($actorId, 'status_expired', 'order', $order->id);
                return ['status' => 'expired'];
            }

            $order->payment->update(['last_checked_at' => now()]);

            $expected = (int) $order->payment->expected_amount;
            $mutations = app(MutasiService::class)->fetchLatest();

            foreach ($mutations as $m) {
                // only incoming payments
                if (($m['status'] ?? null) !== 'IN') continue;

                $amount = (int) ($m['amount'] ?? 0);
                if ($amount !== $expected) continue;

                $mutationId = (string) ($m['id'] ?? '');
                if ($mutationId === '') continue;

                $mutationKey = 'premium-media:' . $mutationId;

                $mutationTime = null;
                if (!empty($m['date'])) {
                    try {
                        $mutationTime = Carbon::createFromFormat('d/m/Y H:i', $m['date'], config('app.timezone'));
                    } catch (\Throwable $e) {
                        $mutationTime = null;
                    }
                }

                try {
                    UsedMutation::create([
                        'order_id' => $order->id,
                        'mutation_key' => $mutationKey,
                        'mutation_id' => (int) $mutationId,
                        'amount' => $amount,
                        'mutation_time' => $mutationTime,
                        'description' => $m['keterangan'] ?? null,
                        'raw' => $m,
                    ]);
                } catch (\Throwable $e) {
                    // already used
                    continue;
                }

                $order->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);

                $order->payment->update([
                    'status' => 'paid',
                ]);

                app(QrCleanupService::class)->cleanup($order);

                AuditLog::log($actorId, 'status_paid', 'order', $order->id, [
                    'mutation_key' => $mutationKey,
                    'amount' => $amount,
                ]);

                return ['status' => 'paid'];
            }

            return ['status' => 'pending'];
        });
    }
}

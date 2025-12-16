<?php

namespace App\Console\Commands;

use App\Models\AuditLog;
use App\Models\Order;
use App\Services\QrCleanupService;
use Illuminate\Console\Command;

class ExpireOrdersCommand extends Command
{
    protected $signature = 'dimz:expire-orders';
    protected $description = 'Expire pending orders that passed expires_at and cleanup QR';

    public function handle(): int
    {
        $orders = Order::query()
            ->where('status', 'pending')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now())
            ->with('payment')
            ->limit(200)
            ->get();

        foreach ($orders as $order) {
            $order->update(['status' => 'expired']);
            if ($order->payment) {
                $order->payment->update(['status' => 'expired']);
            }
            app(QrCleanupService::class)->cleanup($order);

            AuditLog::log(null, 'status_expired_scheduler', 'order', $order->id);
        }

        $this->info("Expired ".$orders->count()." orders.");
        return 0;
    }
}

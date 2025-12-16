<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Order;
use App\Services\PaymentVerificationService;
use App\Services\QrisDynamicService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(int $orderId)
    {
        $order = Order::query()->with('payment')->findOrFail($orderId);

        // user hanya boleh lihat order sendiri (kecuali admin)
        if (!auth()->user()->hasRole('admin') && $order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status === 'paid') {
            return redirect()->route('orders.show', $order->id)->with('success', 'Order sudah dibayar.');
        }

        if ($order->expires_at && now()->greaterThan($order->expires_at)) {
            return redirect()->route('orders.show', $order->id)->with('error', 'Order sudah expired.');
        }

        // generate QR kalau belum ada
        if ($order->payment && $order->payment->status === 'pending' && empty($order->payment->qris_dynamic_image)) {
            $qrisRaw = config('services.qris.raw');
            if (!$qrisRaw) {
                abort(500, 'QRIS_STATIC_RAW belum diset di .env');
            }

            $result = app(QrisDynamicService::class)->generate($qrisRaw, (int) $order->payment->expected_amount);

            $order->payment->update([
                'qris_dynamic_payload' => $result['qris_dynamic'],
                'qris_dynamic_image' => $result['qr_png'],
                'qris_generated_at' => now(),
            ]);

            AuditLog::log(auth()->id(), 'qris_generated', 'order', $order->id);
        }

        $order->refresh();

        return view('payment.show', compact('order'));
    }

    public function check(Request $request, int $orderId)
    {
        $order = Order::query()->with('payment')->findOrFail($orderId);

        if (!auth()->user()->hasRole('admin') && $order->user_id !== auth()->id()) {
            abort(403);
        }

        $result = app(PaymentVerificationService::class)->verify($order, auth()->id());

        return response()->json($result);
    }
}

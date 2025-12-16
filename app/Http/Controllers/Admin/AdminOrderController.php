<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Order;
use App\Models\UsedMutation;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->with('user', 'payment')->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $orderId)
    {
        $order = Order::with(['user', 'items.book', 'payment'])->findOrFail($orderId);
        return view('admin.orders.show', compact('order'));
    }

    public function manualConfirm(Request $request, int $orderId)
    {
        $order = Order::with('payment')->findOrFail($orderId);

        if ($order->status !== 'pending') {
            return back()->with('error', 'Order bukan pending.');
        }

        // tandai paid manual
        $order->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        if ($order->payment) {
            $order->payment->update(['status' => 'paid']);
        }

        // create fake used_mutation key (manual)
        $key = 'manual:' . $order->id . ':' . now()->timestamp;
        UsedMutation::create([
            'order_id' => $order->id,
            'mutation_key' => $key,
            'amount' => $order->payment?->expected_amount ?? $order->total_amount,
            'description' => 'Manual confirm by admin',
            'raw' => ['manual' => true],
        ]);

        AuditLog::log(auth()->id(), 'manual_confirm_paid', 'order', $order->id);

        return back()->with('success', 'Order berhasil dikonfirmasi PAID (manual).');
    }
}

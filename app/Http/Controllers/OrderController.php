<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->with('items.book')
            ->paginate(15);

        return view('orders.index', compact('orders'));
    }

    public function show(int $orderId)
    {
        $order = Order::query()
            ->where('id', $orderId)
            ->where('user_id', auth()->id())
            ->with(['items.book', 'payment'])
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}

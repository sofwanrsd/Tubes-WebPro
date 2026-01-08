<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $query = Order::query()
            ->where('user_id', auth()->id())
            ->latest();

        // 1. Search (ID)
        if ($search = request('search')) {
            $query->where('id', 'like', "%{$search}%");
        }

        // 2. Filter Status
        if ($status = request('status')) {
            if ($status !== 'all') {
                $query->where('status', $status);
            }
        }

        // 3. Per Page
        $perPage = request('per_page', 10);
        $orders = $query->with('items.book')->paginate($perPage)->withQueryString();

        return view('user.orders.index', compact('orders'));
    }

    public function show(int $orderId)
    {
        $order = Order::query()
            ->where('id', $orderId)
            ->where('user_id', auth()->id())
            ->with(['items.book', 'payment'])
            ->firstOrFail();

        return view('user.orders.show', compact('order'));
    }
}

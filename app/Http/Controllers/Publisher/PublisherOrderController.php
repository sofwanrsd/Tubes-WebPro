<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PublisherOrderController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Query orders that have at least one book from this publisher
        // Also eager load items and items.book to filter them in view or here
        $query = Order::whereHas('items.book', function ($q) use ($userId) {
            $q->where('publisher_id', $userId);
        })->latest();

        if ($search = request('search')) {
             $query->where(function ($q) use ($search) {
                 $q->where('id', 'like', "%{$search}%")
                   ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
             });
        }
        
        if ($status = request('status')) {
             if ($status !== 'all') {
                  $query->where('status', $status);
             }
        }

        $perPage = request('per_page', 20);
        $orders = $query->with(['user', 'items.book'])->paginate($perPage)->withQueryString();

        return view('publisher.orders.index', compact('orders'));
    }
}

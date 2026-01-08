<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

class UserDashboardController extends Controller
{
    public function index()
    {
        $uid = auth()->id();

        // User-centric metrics
        // 1. Total Books Owned (Items in Paid Orders)
        // Accessing items via relationship. Assuming 1 item row per book.
        $booksOwned = Order::where('user_id', $uid)
            ->where('status', 'paid')
            ->withCount('items')
            ->get()
            ->sum('items_count');

        // 2. Total Spend (Paid Orders only)
        $totalSpend = Order::where('user_id', $uid)
            ->where('status', 'paid')
            ->sum('total_amount');
        
        // 3. Pending (Keep getting count as it's actionable)
        $pending = Order::where('user_id', $uid)->where('status', 'pending')->count();

        return view('user.index', compact('booksOwned', 'totalSpend', 'pending'));
    }

    public function library()
    {
        // Get all paid orders with their items and related book data
        $orders = Order::where('user_id', auth()->id())
            ->where('status', 'paid')
            ->with(['items.book.publisher'])
            ->latest()
            ->get();

        // Flatten items to get a list of "my books"
        // Use a collection to maybe unique them by book_id if user bought same book twice (unlikely for digital but safer)
        $myBooks = $orders->flatMap->items->unique('book_id');

        return view('user.library', compact('myBooks'));
    }
}

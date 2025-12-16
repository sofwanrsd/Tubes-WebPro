<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

class UserDashboardController extends Controller
{
    public function index()
    {
        $uid = auth()->id();

        $total = Order::where('user_id', $uid)->count();
        $paid = Order::where('user_id', $uid)->where('status', 'paid')->count();
        $expired = Order::where('user_id', $uid)->where('status', 'expired')->count();
        $pending = Order::where('user_id', $uid)->where('status', 'pending')->count();

        $recent = Order::where('user_id', $uid)->latest()->with('items.book')->take(10)->get();

        return view('dashboard.user', compact('total', 'paid', 'expired', 'pending', 'recent'));
    }
}

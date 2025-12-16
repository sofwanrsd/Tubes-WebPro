<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pending = Order::where('status', 'pending')->count();
        $paid = Order::where('status', 'paid')->count();
        $expired = Order::where('status', 'expired')->count();

        return view('admin.dashboard', compact('pending', 'paid', 'expired'));
    }
}

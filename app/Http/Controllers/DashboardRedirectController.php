<?php

namespace App\Http\Controllers;

class DashboardRedirectController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('publisher')) {
            return redirect()->route('publisher.dashboard');
        }

        return redirect()->route('user.dashboard');
    }
}

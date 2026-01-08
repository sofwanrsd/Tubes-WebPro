<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $query = User::latest();

        // 1. Search (Name/Email)
        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 2. Role Filter (using Spatie permission HasRoles trait scope if available, or whereHas)
        // Assuming simple role check or using Spatie's 'role' scope if the model uses HasRoles
        if ($role = request('role')) {
            if ($role !== 'all') {
                $query->role($role);
            }
        }

        // 3. Pagination
        $perPage = request('per_page', 20);
        $users = $query->paginate($perPage)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, int $userId)
    {
        $request->validate([
            'role' => ['required', 'in:user,publisher,admin'],
        ]);

        $user = User::findOrFail($userId);

        // reset roles -> set new
        $user->syncRoles([$request->role]);

        AuditLog::log(auth()->id(), 'user_role_updated', 'user', $user->id, [
            'role' => $request->role,
        ]);

        return back()->with('success', 'Role user diupdate.');
    }
}

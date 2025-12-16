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
        $users = User::latest()->paginate(20);
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

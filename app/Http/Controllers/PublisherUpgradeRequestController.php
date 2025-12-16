<?php

namespace App\Http\Controllers;

use App\Models\PublisherUpgradeRequest;
use App\Models\User;
use App\Notifications\AdminPublisherUpgradeRequested;
use App\Notifications\UserPublisherUpgradeApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class PublisherUpgradeRequestController extends Controller
{
    /**
     * USER submit request upgrade publisher.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        // optional: note untuk admin
        $request->validate([
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        // kalau sudah admin/publisher tidak boleh request
        if ($user->hasRole('admin') || $user->hasRole('publisher')) {
            return back()->with('error', 'Akun kamu sudah memiliki akses Publisher/Admin.');
        }

        // pastikan role admin/publisher/user ada (biar aman)
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'publisher', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // kalau user belum punya role user (kasus register bug), assign dulu biar konsisten
        if (!$user->hasRole('user')) {
            $user->assignRole('user');
        }

        // tidak boleh bikin request baru kalau masih pending
        $exists = PublisherUpgradeRequest::query()
            ->where('user_id', $user->id)
            ->where('status', PublisherUpgradeRequest::STATUS_PENDING)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Kamu sudah punya request pending. Tunggu admin memproses.');
        }

        $req = PublisherUpgradeRequest::create([
            'user_id' => $user->id,
            'status'  => PublisherUpgradeRequest::STATUS_PENDING,
            'note'    => $request->input('note'),
        ]);

        // kirim email ke semua admin
        $admins = User::role('admin')->get();
        if ($admins->isEmpty()) {
            // kalau tidak ada admin, request tetap tersimpan
            return back()->with('success', 'Request tersimpan, tapi belum ada admin yang menerima email (admin belum ada).');
        }

        Notification::send($admins, new AdminPublisherUpgradeRequested($req));

        return back()->with('success', 'Request upgrade terkirim. Admin akan menerima email.');
    }

    /**
     * ADMIN approve via signed link.
     */
    public function approve(PublisherUpgradeRequest $upgradeRequest, Request $request)
    {
        // extra safety (harusnya sudah lewat middleware role:admin)
        if (!$request->user()->hasRole('admin')) {
            abort(403);
        }

        if ($upgradeRequest->status !== PublisherUpgradeRequest::STATUS_PENDING) {
            return redirect()->route('admin.dashboard')->with('error', 'Request ini sudah diproses.');
        }

        $user = $upgradeRequest->user;
        if (!$user) {
            return redirect()->route('admin.dashboard')->with('error', 'User tidak ditemukan.');
        }

        // update status request
        $upgradeRequest->status     = PublisherUpgradeRequest::STATUS_APPROVED;
        $upgradeRequest->decided_at = now();
        $upgradeRequest->decided_by = $request->user()->id;
        $upgradeRequest->save();

        // pastikan role publisher ada
        Role::firstOrCreate(['name' => 'publisher', 'guard_name' => 'web']);

        // assign publisher dan hapus role user agar tidak dobel
        if (!$user->hasRole('publisher')) {
            $user->assignRole('publisher');
        }
        if ($user->hasRole('user')) {
            $user->removeRole('user');
        }

        // kirim email ke user bahwa upgrade sukses
        $user->notify(new UserPublisherUpgradeApproved());

        return redirect()->route('admin.dashboard')->with('success', 'Upgrade Publisher berhasil diproses.');
    }

    /**
     * ADMIN reject via signed link.
     */
    public function reject(PublisherUpgradeRequest $upgradeRequest, Request $request)
    {
        // extra safety
        if (!$request->user()->hasRole('admin')) {
            abort(403);
        }

        if ($upgradeRequest->status !== PublisherUpgradeRequest::STATUS_PENDING) {
            return redirect()->route('admin.dashboard')->with('error', 'Request ini sudah diproses.');
        }

        $upgradeRequest->status     = PublisherUpgradeRequest::STATUS_REJECTED;
        $upgradeRequest->decided_at = now();
        $upgradeRequest->decided_by = $request->user()->id;
        $upgradeRequest->save();

        return redirect()->route('admin.dashboard')->with('success', 'Request upgrade ditolak.');
    }
}

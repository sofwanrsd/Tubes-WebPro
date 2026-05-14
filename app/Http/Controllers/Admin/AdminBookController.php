<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index()
    {
        $query = Book::latest()->with('publisher');

        // 1. Search (Title or Publisher Name)
        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('publisher', fn($p) => $p->where('name', 'like', "%{$search}%"));
            });
        }

        // 2. Filter Status
        if ($status = request('status')) {
            if ($status !== 'all') {
                $query->where('status', $status);
            }
        }

        // 3. Pagination
        $perPage = request('per_page', 20);
        $books = $query->paginate($perPage)->withQueryString();

        return view('admin.books.index', compact('books'));
    }

    public function setStatus(Request $request, int $bookId)
    {
        $request->validate([
            'status' => ['required', 'in:draft,published,unpublished'],
        ]);

        $book = Book::findOrFail($bookId);
        $book->update(['status' => $request->status]);

        AuditLog::log(auth()->id(), 'book_status_updated', 'book', $book->id, [
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status buku diupdate.');
    }
}

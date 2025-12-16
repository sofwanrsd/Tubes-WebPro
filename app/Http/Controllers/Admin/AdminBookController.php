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
        $books = Book::latest()->with('publisher')->paginate(20);
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

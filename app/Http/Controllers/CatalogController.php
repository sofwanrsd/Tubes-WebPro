<?php

namespace App\Http\Controllers;

use App\Models\Book;

class CatalogController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->where('status', 'published')
            ->latest()
            ->paginate(12);

        return view('catalog.index', compact('books'));
    }

    public function show(string $slug)
    {
        $book = Book::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('catalog.show', compact('book'));
    }
}

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

        $purchasedBookIds = [];
        if (auth()->check()) {
            // Get IDs of books in paid orders
            $purchasedBookIds = auth()->user()->hasMany(\App\Models\Order::class)
                ->where('status', 'paid')
                ->with('items')
                ->get()
                ->flatMap->items
                ->pluck('book_id')
                ->toArray();
        }

        return view('catalog.index', compact('books', 'purchasedBookIds'));
    }

    public function show(string $slug)
    {
        $book = Book::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $isPurchased = false;
        if (auth()->check()) {
            $isPurchased = auth()->user()->hasPurchased($book->id);
        }

        return view('catalog.show', compact('book', 'isPurchased'));
    }
}

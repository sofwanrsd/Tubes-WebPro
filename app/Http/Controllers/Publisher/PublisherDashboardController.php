<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\OrderItem;

class PublisherDashboardController extends Controller
{
    public function index()
    {
        $publisherId = auth()->id();

        $booksTotal = Book::where('publisher_id', $publisherId)->count();
        $booksPublished = Book::where('publisher_id', $publisherId)->where('status', 'published')->count();

        $paidItems = OrderItem::query()
            ->whereHas('book', fn($q) => $q->where('publisher_id', $publisherId))
            ->whereHas('order', fn($q) => $q->where('status', 'paid'));

        $salesCount = (clone $paidItems)->count();
        $revenue = (clone $paidItems)->sum('price'); // saldo publisher (tanpa unique_code)

        return view('publisher.dashboard', compact('booksTotal', 'booksPublished', 'salesCount', 'revenue'));
    }
}

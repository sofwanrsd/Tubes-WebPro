<?php

namespace App\Http\Controllers;

use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::where('status', 'published')
                     ->latest()
                     ->take(4)
                     ->with('publisher')
                     ->get();

        return view('home', compact('books'));
    }
}

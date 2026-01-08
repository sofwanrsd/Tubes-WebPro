<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $items = [];
        $subtotal = 0;

        // Ambil semua Key/ID buku dari session
        $bookIds = [];
        foreach ($cart as $key => $val) {
            $id = is_array($val) ? ($val['id'] ?? ($val['book_id'] ?? $key)) : $key;
            $bookIds[] = $id;
        }

        // Fetch fresh data dari DB supaya cover & detail selalu update
        $books = Book::with('publisher')->whereIn('id', $bookIds)->get()->keyBy('id');

        foreach ($cart as $key => $val) {
            $id = is_array($val) ? ($val['id'] ?? ($val['book_id'] ?? $key)) : $key;
            
            // Skip jika buku sudah dihapus dari DB
            if (!isset($books[$id])) continue;

            $book = $books[$id];

            $items[] = [
                'id' => $book->id,
                'title' => $book->title,
                'price' => (int) $book->price,
                'coverPath' => $book->cover_path,
                'slug' => $book->slug,
                'genre' => $book->genre,
                'author_name' => $book->publisher->name ?? 'Admin',
                'qty' => 1, // Digital goods selalu 1
            ];

            $subtotal += (int) $book->price;
        }

        return view('cart.index', compact('items', 'subtotal'));
    }

    public function add(Request $request, int $bookId)
    {
        $book = Book::query()
            ->where('id', $bookId)
            ->where('status', 'published')
            ->firstOrFail();

        // Prevent Repurchase
        if (auth()->check() && auth()->user()->hasPurchased($book->id)) {
             if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kamu sudah memiliki buku ini!'
                ], 400);
            }
            return redirect()->back()->with('error', 'Kamu sudah memiliki buku ini!');
        }

        $cart = $request->session()->get('cart', []);

        // 1 buku = 1 item (no qty)
        $cart[$book->id] = [
            'book_id' => $book->id,
            'title' => $book->title,
            'price' => (int) $book->price,
            'slug' => $book->slug,
            'cover_path' => $book->cover_path,
            'genre' => $book->genre,
            'author_name' => $book->publisher->name ?? 'Admin',
        ];

        $request->session()->put('cart', $cart);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Buku ditambahkan ke keranjang.',
                'cart_count' => count($cart)
            ]);
        }

        if ($request->input('redirect') === 'back') {
            return redirect()->back()->with('success', 'Buku ditambahkan ke keranjang.');
        }

        return redirect()->route('cart.index')->with('success', 'Buku ditambahkan ke keranjang.');
    }

    public function remove(Request $request, int $bookId)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$bookId]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang.');
    }

    public function clear(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan.');
    }
}

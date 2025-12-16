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

        foreach ($cart as $bookId => $row) {
            $items[] = $row;
            $subtotal += (int) $row['price'];
        }

        return view('cart.index', compact('items', 'subtotal'));
    }

    public function add(Request $request, int $bookId)
    {
        $book = Book::query()
            ->where('id', $bookId)
            ->where('status', 'published')
            ->firstOrFail();

        $cart = $request->session()->get('cart', []);

        // 1 buku = 1 item (no qty)
        $cart[$book->id] = [
            'book_id' => $book->id,
            'title' => $book->title,
            'price' => (int) $book->price,
            'slug' => $book->slug,
        ];

        $request->session()->put('cart', $cart);

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

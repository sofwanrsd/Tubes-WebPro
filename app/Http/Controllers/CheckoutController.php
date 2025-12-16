<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Services\UniqueAmountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $items = array_values($cart);
        $subtotal = array_sum(array_map(fn($x) => (int)$x['price'], $items));

        return view('checkout.index', compact('items', 'subtotal'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'agree' => ['required', 'accepted'],
        ], [
            'agree.required' => 'Kamu wajib menyetujui Syarat & Ketentuan.',
        ]);

        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $userId = (int) auth()->id();

        $items = array_values($cart);
        $subtotal = array_sum(array_map(fn($x) => (int)$x['price'], $items));

        $uniqueCode = app(UniqueAmountService::class)->generateUniqueCode($subtotal);
        $total = $subtotal + $uniqueCode;

        $expiresMinutes = (int) env('ORDER_EXPIRES_MINUTES', 30);
        $expiresAt = now()->addMinutes($expiresMinutes);

        $order = DB::transaction(function () use ($userId, $items, $subtotal, $uniqueCode, $total, $expiresAt) {
            $order = Order::create([
                'user_id' => $userId,
                'status' => 'pending',
                'subtotal' => $subtotal,
                'unique_code' => $uniqueCode,
                'total_amount' => $total,
                'expires_at' => $expiresAt,
            ]);

            foreach ($items as $it) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => (int) $it['book_id'],
                    'price' => (int) $it['price'],
                ]);
            }

            Payment::create([
                'order_id' => $order->id,
                'method' => 'QRIS_DYNAMIC_FROM_STATIC',
                'expected_amount' => $total,
                'status' => 'pending',
            ]);

            return $order;
        });

        $request->session()->forget('cart');

        return redirect()->route('payment.show', $order->id);
    }
}

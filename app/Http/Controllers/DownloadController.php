<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download(int $orderId, int $bookId)
    {
        $order = Order::query()
            ->where('id', $orderId)
            ->where('user_id', auth()->id())
            ->with('items.book')
            ->firstOrFail();

        if ($order->status !== 'paid') {
            abort(403, 'Order belum paid.');
        }

        $item = $order->items->firstWhere('book_id', $bookId);
        if (!$item) {
            abort(404);
        }

        $book = $item->book;
        if (!$book || !$book->file_path) {
            abort(404, 'File e-book belum ada.');
        }

        return Storage::disk('private')->download($book->file_path, $book->slug.'.pdf');
    }
}

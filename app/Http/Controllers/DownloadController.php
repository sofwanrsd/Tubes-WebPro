<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadController extends Controller
{
    public function download(int $orderId, int $bookId)
    {
        $order = Order::query()
            ->where('id', $orderId)
            ->where('user_id', auth()->id())
            ->with('items.book')
            ->firstOrFail();

        // status order kamu kemungkinan "PAID" (bukan "paid")
        $status = strtoupper((string) $order->status);
        if ($status !== 'PAID') {
            abort(403, 'Order belum PAID.');
        }

        $item = $order->items->firstWhere('book_id', $bookId);
        if (!$item) abort(404);

        $book = $item->book;
        if (!$book || !$book->file_path) {
            abort(404, 'File e-book belum ada.');
        }

        if (!Storage::disk('private')->exists($book->file_path)) {
            abort(404, 'File e-book tidak ditemukan di storage.');
        }

        $safeName = Str::slug($book->title ?: ($book->slug ?: 'ebook')) . '.pdf';

        return Storage::disk('private')->download($book->file_path, $safeName);
    }
}

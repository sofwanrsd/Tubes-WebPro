<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublisherBookController extends Controller
{
    public function index()
    {
        $books = Book::where('publisher_id', auth()->id())->latest()->paginate(15);
        return view('publisher.books.index', compact('books'));
    }

    public function create()
    {
        return view('publisher.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published,unpublished'],

            // dibuat REQUIRED biar jelas saat upload
            'cover' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'ebook' => ['required', 'file', 'mimes:pdf', 'max:51200'], // 50MB
        ]);

        // slug unik
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $i = 1;
        while (Book::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i++;
        }

        // cover -> public
        $coverPath = $request->file('cover')->store('covers', 'public');

        // ebook -> private (pakai nama unik biar tidak ketimpa)
        $ebookName = $slug . '-' . Str::random(10) . '.pdf';
        $filePath = $request->file('ebook')->storeAs('ebooks', $ebookName, 'private');

        $book = Book::create([
            'publisher_id' => auth()->id(),
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'price' => (int) $request->price,
            'cover_path' => $coverPath, // contoh: covers/xxx.png
            'file_path' => $filePath,   // contoh: ebooks/xxx.pdf
            'status' => $request->status,
        ]);

        AuditLog::log(auth()->id(), 'book_created', 'book', $book->id);

        return redirect()->route('publisher.books.index')->with('success', 'Buku berhasil dibuat.');
    }

    public function edit(Book $book)
    {
        abort_unless($book->publisher_id === auth()->id(), 403);
        return view('publisher.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        abort_unless($book->publisher_id === auth()->id(), 403);

        $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:draft,published,unpublished'],

            // edit boleh opsional
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'ebook' => ['nullable', 'file', 'mimes:pdf', 'max:51200'],
        ]);

        // jika title berubah, update slug (unik)
        if ($book->title !== $request->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $i = 1;
            while (Book::where('slug', $slug)->where('id', '!=', $book->id)->exists()) {
                $slug = $originalSlug . '-' . $i++;
            }
            $book->slug = $slug;
        }

        if ($request->hasFile('cover')) {
            if ($book->cover_path) {
                Storage::disk('public')->delete($book->cover_path);
            }
            $book->cover_path = $request->file('cover')->store('covers', 'public');
        }

        if ($request->hasFile('ebook')) {
            if ($book->file_path) {
                Storage::disk('private')->delete($book->file_path);
            }
            $ebookName = ($book->slug ?: Str::slug($request->title)) . '-' . Str::random(10) . '.pdf';
            $book->file_path = $request->file('ebook')->storeAs('ebooks', $ebookName, 'private');
        }

        $book->title = $request->title;
        $book->description = $request->description;
        $book->price = (int) $request->price;
        $book->status = $request->status;
        $book->save();

        AuditLog::log(auth()->id(), 'book_updated', 'book', $book->id);

        return redirect()->route('publisher.books.index')->with('success', 'Buku berhasil diupdate.');
    }

    public function destroy(Book $book)
    {
        abort_unless($book->publisher_id === auth()->id(), 403);

        if ($book->cover_path) Storage::disk('public')->delete($book->cover_path);
        if ($book->file_path) Storage::disk('private')->delete($book->file_path);

        AuditLog::log(auth()->id(), 'book_deleted', 'book', $book->id);

        $book->delete();

        return redirect()->route('publisher.books.index')->with('success', 'Buku dihapus.');
    }
}

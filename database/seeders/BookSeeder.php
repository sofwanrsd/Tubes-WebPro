<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get publishers
        $gramedia = User::where('email', 'gramedia@dimzstore.com')->first();
        $erlangga = User::where('email', 'erlangga@dimzstore.com')->first();
        $indie = User::where('email', 'indie@dimzstore.com')->first();

        if (!$gramedia || !$erlangga || !$indie) {
            $this->command->error('Please run UserSeeder first!');
            return;
        }

        // Placeholder cover URLs (using picsum.photos for variety)
        $coverUrls = [
            'https://picsum.photos/seed/book1/400/600',
            'https://picsum.photos/seed/book2/400/600',
            'https://picsum.photos/seed/book3/400/600',
            'https://picsum.photos/seed/book4/400/600',
            'https://picsum.photos/seed/book5/400/600',
            'https://picsum.photos/seed/book6/400/600',
            'https://picsum.photos/seed/book7/400/600',
            'https://picsum.photos/seed/book8/400/600',
            'https://picsum.photos/seed/book9/400/600',
            'https://picsum.photos/seed/book10/400/600',
            'https://picsum.photos/seed/book11/400/600',
            'https://picsum.photos/seed/book12/400/600',
            'https://picsum.photos/seed/book13/400/600',
            'https://picsum.photos/seed/book14/400/600',
        ];

        $books = [
            // Gramedia Books
            [
                'publisher_id' => $gramedia->id,
                'title' => 'Laskar Pelangi',
                'genre' => 'Fiksi',
                'description' => 'Novel inspiratif tentang perjuangan anak-anak Belitong dalam mengejar pendidikan. Kisah yang mengharukan dan penuh semangat.',
                'price' => 75000,
                'status' => 'published',
                'cover_url' => $coverUrls[0],
            ],
            [
                'publisher_id' => $gramedia->id,
                'title' => 'Bumi Manusia',
                'genre' => 'Fiksi',
                'description' => 'Karya Pramoedya Ananta Toer yang mengisahkan perjuangan Minke di era kolonial Belanda. Sebuah epik sastra Indonesia.',
                'price' => 89000,
                'status' => 'published',
                'cover_url' => $coverUrls[1],
            ],
            [
                'publisher_id' => $gramedia->id,
                'title' => 'Filosofi Teras',
                'genre' => 'Self-Help',
                'description' => 'Buku tentang filosofi Stoisisme yang dikemas dengan bahasa ringan dan relevan untuk kehidupan modern.',
                'price' => 98000,
                'status' => 'published',
                'cover_url' => $coverUrls[2],
            ],
            [
                'publisher_id' => $gramedia->id,
                'title' => 'Atomic Habits (Edisi Indonesia)',
                'genre' => 'Self-Help',
                'description' => 'Panduan praktis membangun kebiasaan baik dan menghilangkan kebiasaan buruk. Best-seller internasional.',
                'price' => 99000,
                'status' => 'published',
                'cover_url' => $coverUrls[3],
            ],

            // Erlangga Books
            [
                'publisher_id' => $erlangga->id,
                'title' => 'Matematika Dasar untuk SMA',
                'genre' => 'Pendidikan',
                'description' => 'Buku panduan lengkap matematika untuk siswa SMA. Dilengkapi contoh soal dan pembahasan.',
                'price' => 65000,
                'status' => 'published',
                'cover_url' => $coverUrls[4],
            ],
            [
                'publisher_id' => $erlangga->id,
                'title' => 'Fisika Modern',
                'genre' => 'Pendidikan',
                'description' => 'Membahas konsep fisika modern dari relativitas hingga mekanika kuantum dengan pendekatan yang mudah dipahami.',
                'price' => 78000,
                'status' => 'published',
                'cover_url' => $coverUrls[5],
            ],
            [
                'publisher_id' => $erlangga->id,
                'title' => 'Panduan TOEFL iBT',
                'genre' => 'Pendidikan',
                'description' => 'Buku persiapan TOEFL iBT lengkap dengan strategi, tips, dan latihan soal.',
                'price' => 125000,
                'status' => 'published',
                'cover_url' => $coverUrls[6],
            ],
            [
                'publisher_id' => $erlangga->id,
                'title' => 'Bahasa Inggris untuk Pemula',
                'genre' => 'Pendidikan',
                'description' => 'Panduan belajar bahasa Inggris dari nol. Cocok untuk autodidak.',
                'price' => 55000,
                'status' => 'published',
                'cover_url' => $coverUrls[7],
            ],

            // Indie Writer Books
            [
                'publisher_id' => $indie->id,
                'title' => 'Kode Rahasia JavaScript',
                'genre' => 'Teknologi',
                'description' => 'Buku programming JavaScript untuk pemula hingga mahir. Belajar dari dasar hingga framework modern.',
                'price' => 149000,
                'status' => 'published',
                'cover_url' => $coverUrls[8],
            ],
            [
                'publisher_id' => $indie->id,
                'title' => 'Laravel 10: Panduan Lengkap',
                'genre' => 'Teknologi',
                'description' => 'Tutorial lengkap Laravel 10 dari instalasi hingga deployment. Termasuk project nyata.',
                'price' => 175000,
                'status' => 'published',
                'cover_url' => $coverUrls[9],
            ],
            [
                'publisher_id' => $indie->id,
                'title' => 'UI/UX Design Fundamentals',
                'genre' => 'Desain',
                'description' => 'Dasar-dasar desain UI/UX untuk aplikasi modern. Dilengkapi studi kasus dan best practices.',
                'price' => 135000,
                'status' => 'published',
                'cover_url' => $coverUrls[10],
            ],
            [
                'publisher_id' => $indie->id,
                'title' => 'Startup dari Nol',
                'genre' => 'Bisnis',
                'description' => 'Panduan membangun startup dari ide hingga eksekusi. Belajar dari pengalaman praktisi.',
                'price' => 89000,
                'status' => 'published',
                'cover_url' => $coverUrls[11],
            ],
            [
                'publisher_id' => $indie->id,
                'title' => 'Cerita Pendek Pilihan 2024',
                'genre' => 'Fiksi',
                'description' => 'Kumpulan cerpen terbaik dari penulis-penulis muda Indonesia. Tema beragam dan menyentuh.',
                'price' => 45000,
                'status' => 'published',
                'cover_url' => $coverUrls[12],
            ],
            [
                'publisher_id' => $indie->id,
                'title' => 'Meditasi untuk Pemula',
                'genre' => 'Self-Help',
                'description' => 'Panduan praktis meditasi dan mindfulness untuk kehidupan sehari-hari.',
                'price' => 68000,
                'status' => 'draft',  // Draft example
                'cover_url' => $coverUrls[13],
            ],
            [
                'publisher_id' => $indie->id,
                'title' => 'Ebook Promo 10K',
                'genre' => 'Fiksi',
                'description' => 'Buku promosi spesial dengan harga terjangkau. Cocok untuk testing pembayaran QRIS.',
                'price' => 10000,
                'status' => 'published',
                'cover_url' => 'https://picsum.photos/seed/book15/400/600',
            ],
        ];

        foreach ($books as $bookData) {
            $bookData['slug'] = Str::slug($bookData['title']);
            
            // Download cover image and save to storage
            $coverUrl = $bookData['cover_url'];
            unset($bookData['cover_url']);
            
            // Check if book already exists
            $existingBook = Book::where('slug', $bookData['slug'])->first();
            if (!$existingBook) {
                // Download and save cover
                try {
                    $imageContents = @file_get_contents($coverUrl);
                    if ($imageContents) {
                        $coverFilename = 'covers/' . $bookData['slug'] . '.jpg';
                        \Storage::disk('public')->put($coverFilename, $imageContents);
                        $bookData['cover_path'] = $coverFilename;
                    }
                } catch (\Exception $e) {
                    // If download fails, leave cover_path empty
                    $this->command->warn("Could not download cover for: " . $bookData['title']);
                }
                
                Book::create($bookData);
            }
        }

        $this->command->info('Books seeded successfully! Total: ' . count($books));
    }
}

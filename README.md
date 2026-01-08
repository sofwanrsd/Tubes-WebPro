# Dimz Store — Tubes WebPro (Laravel)

Aplikasi e-commerce digital (E-Book Store) berbasis Laravel dengan:
- Landing page + Catalog dengan search & filter
- Cart & Checkout dengan QRIS Payment
- Pembayaran QRIS (statis → dinamis via API)
- Verifikasi pembayaran otomatis via API Mutasi (menggunakan **kode unik**)
- Dashboard berbasis role: **User / Publisher / Admin**
- RBAC menggunakan **Spatie Laravel Permission**
- Auth + UI kit menggunakan **Laravel Breeze**
- Akses download e-book otomatis setelah pembayaran sukses
- Profile dengan foto profil
- Publisher Studio untuk kelola buku & pantau penjualan
- Admin Panel untuk kelola user, buku, dan pesanan
- Sistem upgrade Publisher dengan approval admin
- UI Theme: **Hero Dark Wine & Gold**

---

## 1) Navigasi & UI

### Saat belum login
Navbar:
- Brand (Logo/Tulisan)
- Home
- Catalog
- Cart
- Login | Register

### Saat sudah login
Navbar:
- Brand (Logo/Tulisan)
- Home
- Catalog
- Cart
- My Account (dropdown):
  - Dashboard (menyesuaikan role)
  - Profile
  - Logout

---

## 2) Role & Hak Akses (RBAC)

Role default:
- `user`
- `publisher`
- `admin`

Catatan:
- Role **tidak disimpan** di kolom `users`.
- Role disimpan oleh Spatie di tabel:
  - `roles`
  - `model_has_roles`

### User
- Melihat riwayat transaksi (sukses/gagal/expired/pending)
- Download e-book jika order **PAID**
- Lihat detail order & status

### Publisher
- CRUD buku (My Studio)
- Melihat saldo/pendapatan (untuk pencairan: hubungi admin)

### Admin
- Kelola user & role
- Kelola buku
- Kelola order & pembayaran (termasuk tindakan manual confirm bila diperlukan)

---

## 3) Flow Transaksi & Pembayaran

1. User memilih buku → masuk cart
2. Checkout → sistem membuat `orders` status `PENDING`
3. Sistem generate `unique_code` (kode unik) untuk membedakan transaksi (karena API mutasi hanya 3 data terbaru)
4. Sistem memanggil API QRIS statis→dinamis untuk nominal `total_amount` dan menyimpan data QR ke tabel `payments`
5. User melakukan pembayaran via QRIS
6. Sistem melakukan pengecekan mutasi:
   - Cocokkan nominal + kode unik (sesuai strategi matching)
   - Cegah double-claim: simpan mutasi yang sudah dipakai ke `used_mutations`
7. Jika cocok → set order `PAID`, set `paid_at`, aktifkan akses download
8. Jika melewati `expires_at` → set `EXPIRED` dan cleanup QR payload/image

---

## 4) Integrasi API

### A) API QRIS Statis → Dinamis
Base URL (default):
- `https://qrisin-three.vercel.app`

Endpoint:
- `POST /api/generate`

Body JSON:
```json
{
  "qris_raw": "000201010212...",
  "amount": "15000"
}
```

Response:
```json
{
  "status": true,
  "qris_dynamic": "000201010212...",
  "qr_png": "data:image/png;base64,..."
}
```

### B) API Mutasi (Premium Media)
Endpoint:
- `POST https://premium-media.id/apiv3/mutasi`

Body (x-www-form-urlencoded):
- `username`
- `token`
- `id`

Response berisi array **3 mutasi terbaru**.

---

## 5) UI Theme

Aplikasi menggunakan tema konsisten **Hero Dark Wine & Gold**:
- Primary Color: `#5C0F14` (Dark Wine)
- Accent Color: `#E6B65C` (Gold)
- Background Gradient: Slate → Cream

Tema diterapkan ke:
- Halaman Auth (Login, Register, Forgot Password, dll)
- Dashboard (User, Publisher, Admin)
- Profile Page
- Semua panel administrasi

---

## 6) Tech Stack
- PHP 8.x
- Laravel 10 + Vite
- Laravel Breeze (Auth UI kit)
- TailwindCSS
- MySQL/MariaDB
- Spatie Laravel Permission (RBAC)
- Laravel HTTP Client (untuk call API QRIS & Mutasi)

---

## 6) Cara Clone & Setup Lokal

### Prasyarat
- PHP 8.x
- Composer
- Node.js + NPM
- MySQL/MariaDB

### Step-by-step
1) Clone repo
```bash
git clone https://github.com/sofwanrsd/Tubes-WebPro.git
cd Tubes-WebPro
```

2) Install dependency PHP
```bash
composer install
```

3) Buat `.env`
```bash
cp .env.example .env
php artisan key:generate
```

4) Set database di `.env`
```env
DB_DATABASE=dimz_store
DB_USERNAME=root
DB_PASSWORD=
```

5) Set ENV untuk API (semua bisa kamu ubah via `.env`)
```env
# APP
APP_NAME="Dimz Store"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# QRIS
QRIS_DYNAMIC_BASE_URL=https://qrisin-three.vercel.app
QRIS_STATIC_RAW=000201010212...ISI_QRIS_RAW_KAMU...
# Untuk lokal Windows kadang SSL bermasalah → boleh false
QRIS_HTTP_VERIFY_SSL=false

# MUTASI
MUTASI_BASE_URL=https://premium-media.id
MUTASI_USERNAME=xxxxx
MUTASI_TOKEN=xxxxx
MUTASI_ID=xxxxx
```

6) Migrate + seed
```bash
php artisan migrate
php artisan db:seed
```

7) Install dependency frontend
```bash
npm install
npm run dev
```

8) Jalankan server
```bash
php artisan serve
```

9) (Jika ada fitur download dari storage)
```bash
php artisan storage:link
```

---

## 7) Default Role Saat Register
Setiap user baru akan otomatis mendapat role default **`user`** pada proses register.

Jika ada user lama belum punya role:
```bash
php artisan tinker
```
```php
$u = \App\Models\User::where('email', 'emailkamu@example.com')->first();
$u->assignRole('user');
```

---

## 8) Scheduler Auto-Check (Opsional)
Jika kamu mengaktifkan auto-check pembayaran via scheduler:

Linux cron:
```bash
* * * * * php /path/to/project/artisan schedule:run >> /dev/null 2>&1
```

Local testing:
```bash
php artisan schedule:work
```

---

## 9) Deployment Notes (Ringkas)
```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
npm ci
npm run build
php artisan optimize:clear
```

---

## 10) Troubleshooting

### A) Error RoleMiddleware tidak ditemukan
Jika pakai Spatie v6, namespace middleware adalah:
- `Spatie\Permission\Middleware\RoleMiddleware`
bukan `Spatie\Permission\Middlewares\RoleMiddleware`.

Cek di `app/Http/Kernel.php`:
```php
'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
```

### B) Payment error saat generate QR
Pastikan:
- `QRIS_STATIC_RAW` terisi benar
- `QRIS_DYNAMIC_BASE_URL` benar
- Coba set `QRIS_HTTP_VERIFY_SSL=false` saat lokal bila ada masalah SSL

### C) Perubahan `.env` tidak kebaca
```bash
php artisan optimize:clear
php artisan config:clear
```

### D) Warning openssl already loaded
Itu dari konfigurasi PHP (openssl loaded dua kali). Biasanya tidak fatal.
Perbaiki dengan memastikan `extension=openssl` hanya aktif 1x di `php.ini`.

---

## 11) Git: Push Project ke Repo (jika repo masih kosong)
Dari folder project Laravel:
```bash
git init
git add .
git commit -m "Initial commit: Dimz Store"
git branch -M main
git remote add origin https://github.com/sofwanrsd/Tubes-WebPro.git
git push -u origin main
```

Checklist sebelum push:
- `.env` jangan ikut commit (pastikan ada di `.gitignore`)
- `vendor/` dan `node_modules/` jangan ikut commit
- Pastikan `.env.example` tersedia untuk setup orang lain

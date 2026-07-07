# Petshop E-Commerce Web Application

Proyek ini adalah aplikasi e-commerce sederhana untuk toko hewan peliharaan berbasis Laravel dan Bootstrap. Aplikasi ini mendukung tiga peran pengguna: Admin, Staff, dan Customer, dengan alur belanja, checkout, pengelolaan order, serta panel admin untuk melihat data pengguna, produk, dan penjualan.

## Fitur Utama

- Tampilan halaman depan yang menampilkan daftar produk.
- Sistem login dan registrasi untuk customer.
- Proses menambahkan produk ke keranjang dan checkout.
- Manajemen order oleh staff dengan status Pending, Success, atau Failed.
- Dashboard admin untuk melihat pengguna, produk, dan grafik penjualan.
- Data seeding default untuk akun admin, staff, dan customer.

## Akun Default

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

| Role | Email | Password |
|---|---|---|
| Admin | admin@example.com | password |
| Staff | staff@example.com | password |
| Customer | customer@example.com | password |

## Cara Install Proyek Dari Awal

Berikut langkah instalasi yang disarankan di lingkungan Windows.

### 1. Persyaratan

Pastikan perangkat Anda sudah menginstal:

- PHP 8.1+
- Composer
- Node.js dan npm
- MySQL atau database lokal lain

### 2. Clone Project

```bash
git clone <url-repository>
cd E-Commers
```

### 3. Install Dependency PHP dan Node

```bash
composer install
npm install
```

### 4. Siapkan File Environment

Salin file environment contoh lalu sesuaikan konfigurasi database:

```bash
copy .env.example .env
```

Edit file `.env` dan atur konfigurasi database, misalnya:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommers
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate App Key

```bash
php artisan key:generate
```

### 6. Jalankan Migrasi dan Seeder

```bash
php artisan migrate:fresh --seed
```

Perintah ini akan membuat tabel database dan mengisi data awal termasuk akun default.

### 7. Buat Link Storage (jika diperlukan)

```bash
php artisan storage:link
```

### 8. Jalankan Aplikasi

Buka dua terminal terpisah:

Terminal 1 untuk backend:

```bash
php artisan serve
```

Terminal 2 untuk frontend assets:

```bash
npm run dev
```

Setelah itu buka browser ke alamat:

```text
http://127.0.0.1:8000
```

## Cara Kerja Aplikasi

Secara umum alur aplikasi adalah sebagai berikut:

1. Pengunjung melihat halaman depan yang menampilkan daftar produk.
2. Jika ingin membeli, pengguna harus login atau register terlebih dahulu.
3. Setelah login, customer dapat melihat produk, menambahkannya ke keranjang, lalu masuk ke proses checkout.
4. Customer membuat order dan menunggu proses verifikasi.
5. Staff melihat order yang masuk dan mengubah status order menjadi Pending, Success, atau Failed.
6. Admin dapat mengelola pengguna, produk, serta melihat data penjualan dan statistik terkait.

## Alur Kerja Terakhir Kerangka Proyek

Struktur proyek ini terbagi menjadi beberapa bagian utama:

- `app/` : berisi logika inti aplikasi, termasuk model, controller, dan service yang digunakan oleh sistem.
- `app/Models/` : model data seperti User, Product, Order, OrderItem, Category, dan lain-lain.
- `app/Http/Controllers/` : controller yang menangani request dari user untuk halaman dan fitur tertentu.
- `routes/` : mendefinisikan rute aplikasi, seperti halaman web dan endpoint API.
- `resources/views/` : berisi template Blade untuk tampilan frontend.
- `resources/js/` : file JavaScript untuk kebutuhan frontend.
- `database/migrations/` : file migrasi untuk membuat struktur tabel database.
- `database/seeders/` : file untuk mengisi data awal seperti akun dan produk.
- `public/` : file publik yang dapat diakses langsung, termasuk aset yang di-compile.
- `config/` : konfigurasi aplikasi seperti database, auth, session, dan lainnya.

## Catatan

Untuk pengembangan lebih lanjut, proyek ini masih bisa dikembangkan dengan fitur seperti pembayaran otomatis, integrasi pengiriman, review produk, dan notifikasi melalui email atau WhatsApp.

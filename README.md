<div align="center">
  <h1>📚 Book Collection Manager</h1>
  <p>Aplikasi web personal untuk mengelola, mengelompokkan, dan memantau koleksi buku pribadi Anda.</p>
  
  [![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
  [![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
  [![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
</div>

<br>

## 📖 Tentang Proyek

**Book Collection Manager** adalah aplikasi berbasis web yang dirancang untuk para pecinta buku agar dapat mengelola koleksi pribadi mereka dengan rapi dan modern. Aplikasi ini dibangun menggunakan **Laravel** sebagai framework backend dan **Tailwind CSS** untuk antarmuka yang responsif.

Proyek ini dibuat sebagai bagian dari portofolio pengembangan web, dengan fokus pada implementasi **Relasi Database (Eloquent ORM)**, **Autentikasi Aman**, **Dashboard Statistik Interaktif**, dan **Sistem Keamanan Mode Demo (Read-Only)**.

## 📸 Tangkapan Layar (Screenshots)

Berikut adalah beberapa tampilan antarmuka dari aplikasi ini:

**1. Dashboard Katalog & Statistik**
*Menampilkan ringkasan data dan grafik genre favorit.*
<img src="https://github.com/yarhns/book-collection-manager/blob/main/screenshots/dashboard.png?raw=true" alt="Dashboard Katalog" width="100%" style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">

**2. Mode Demo (Read-Only)**
*Banner peringatan oranye/kuning saat pengunjung mencoba mode demo.*
<img src="https://github.com/yarhns/book-collection-manager/blob/main/screenshots/demo-mode.png?raw=true" alt="Mode Demo" width="100%" style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">

**3. Daftar Koleksi Buku & Modal Edit**
*Halaman utama untuk mengelola buku, dilengkapi fitur pencarian dan pop-up edit.*
<img src="https://github.com/yarhns/book-collection-manager/blob/main/screenshots/koleksi.png?raw=true" alt="Koleksi Buku" width="100%" style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">

**4. Manajemen Kategori**
*Mengelompokkan buku berdasarkan genre dengan fitur CRUD dan Modal.*
<img src="https://github.com/yarhns/book-collection-manager/blob/main/screenshots/kategori.png?raw=true" alt="Manajemen Kategori" width="100%" style="border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">

## ✨ Fitur Utama

- 🔐 **Autentikasi Multi-User**: Sistem Register dan Login yang aman menggunakan Laravel Breeze (Password Hashing).
- 📖 **CRUD Buku Lengkap**: Tambah, lihat, edit (melalui Pop-up Modal interaktif), dan hapus data buku.
- 🏷️ **Relasi Kategori**: Mengelompokkan buku berdasarkan genre dengan relasi `One-to-Many`.
- 🔍 **Pencarian & Pagination**: Mencari buku berdasarkan judul/penulis dan navigasi halaman.
- 📊 **Dashboard Statistik**: Menampilkan total buku, kategori, penulis, serta Grafik Donat menggunakan *Chart.js*.
- 👁️ **Mode Demo (Read-Only)**: Fitur khusus bagi pengunjung untuk mencoba aplikasi tanpa bisa merusak data asli (dilindungi Custom Middleware).
- 🎨 **UI/UX Modern**: Antarmuka bersih, Navbar *Sticky*, notifikasi interaktif, dan 100% responsif.

## 🛠️ Teknologi yang Digunakan

| Kategori | Teknologi |
|---|---|
| **Backend** | Laravel 12, PHP 8.2 |
| **Database** | MySQL |
| **Frontend** | Blade, Tailwind CSS v2, Alpine.js |
| **Autentikasi** | Laravel Breeze |
| **Library Tambahan** | Chart.js, FontAwesome |
| **Build Tool** | Vite |

## 🏗️ Arsitektur Database

- **Tabel `users`**: Menyimpan data pengguna (Admin & Tamu Demo).
- **Tabel `categories`**: Menyimpan data kategori/genre.
- **Tabel `books`**: Menyimpan data buku dengan *Foreign Key* `category_id`. Relasi menggunakan `onDelete('cascade')`.

## 🚀 Cara Menjalankan di Lokal

### Prasyarat
Pastikan Anda sudah menginstal: **PHP >= 8.2**, **Composer**, **Node.js & NPM**, dan **MySQL** (XAMPP/Laragon).

### Langkah Instalasi
1. **Clone repositori ini:**
   ```bash
   git clone https://github.com/yarhns/book-collection-manager.git
   cd book-collection-manager

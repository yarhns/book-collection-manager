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

## ✨ Fitur Utama

- 🔐 **Autentikasi Multi-User**: Sistem Register dan Login yang aman menggunakan Laravel Breeze (Password Hashing).
- 📖 **CRUD Buku Lengkap**: Tambah, lihat, edit (melalui Pop-up Modal interaktif), dan hapus data buku.
- 🏷️ **Relasi Kategori**: Mengelompokkan buku berdasarkan genre dengan relasi `One-to-Many` (Satu kategori memiliki banyak buku).
- 🔍 **Pencarian & Pagination**: Mencari buku berdasarkan judul/penulis dan navigasi halaman yang efisien.
- 📊 **Dashboard Statistik**: Menampilkan ringkasan total buku, kategori, penulis, serta Grafik Donat (Doughnut Chart) genre favorit menggunakan *Chart.js*.
- 👁️ **Mode Demo (Read-Only)**: Fitur khusus bagi pengunjung untuk mencoba aplikasi dan melihat dashboard tanpa bisa merusak/mengubah data asli. Dilindungi oleh *Custom Middleware*.
- 🎨 **UI/UX Modern**: Antarmuka bersih, Navbar *Sticky*, notifikasi interaktif, dan 100% responsif di perangkat mobile.

## 🛠️ Teknologi yang Digunakan

| Kategori | Teknologi |
|---|---|
| **Backend** | Laravel 12, PHP 8.2 |
| **Database** | MySQL (via XAMPP/Laragon) |
| **Frontend** | Blade Templating, Tailwind CSS v2, Alpine.js |
| **Autentikasi** | Laravel Breeze |
| **Library Tambahan** | Chart.js (Grafik), FontAwesome (Ikon) |
| **Build Tool** | Vite |

## 🏗️ Arsitektur & Struktur Database

Aplikasi ini menggunakan relasi **One-to-Many** antara `Category` dan `Book`.

- **Tabel `users`**: Menyimpan data pengguna (Admin & Tamu Demo).
- **Tabel `categories`**: Menyimpan data kategori/genre (contoh: Fiksi, Teknologi, Sejarah).
- **Tabel `books`**: Menyimpan data buku dengan *Foreign Key* `category_id` yang terhubung ke tabel `categories`.
  - *(Catatan: Jika kategori dihapus, maka buku di dalamnya juga ikut terhapus menggunakan metode `onDelete('cascade')`).*

## 🚀 Cara Menjalankan di Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer Anda:

### Prasyarat
Pastikan Anda sudah menginstal: **PHP >= 8.2**, **Composer**, **Node.js & NPM**, dan **MySQL** (XAMPP/Laragon).

### Langkah Instalasi
1. **Clone repositori ini:**
   ```bash
   git clone https://github.com/yarhns/book-collection-manager.git
   cd book-collection-manager

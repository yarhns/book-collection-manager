# 📚 Book Collection Manager

Aplikasi web personal untuk mengelola koleksi buku pribadi. Dibangun dengan Laravel dan Tailwind CSS, dilengkapi dengan fitur autentikasi, manajemen kategori, dashboard statistik interaktif, dan **Mode Demo (Read-Only)** untuk pengunjung.

🔗 **[Live Demo (Segera Hadir)]** | 📂 **[Repositori Ini]**

---

## ✨ Fitur Utama

- 🔐 **Autentikasi Multi-User**: Register dan Login aman menggunakan Laravel Breeze.
- 📖 **CRUD Buku**: Tambah, lihat, edit (via Pop-up Modal), dan hapus data buku.
- 🏷️ **Relasi Kategori**: Mengelompokkan buku berdasarkan genre (One-to-Many Relationship).
- 🔍 **Pencarian & Pagination**: Mencari buku berdasarkan judul/penulis dan navigasi halaman yang rapi.
- 📊 **Dashboard Statistik**: Menampilkan total buku, kategori, penulis, dan grafik (Doughnut Chart) genre favorit menggunakan Chart.js.
- 👁️ **Mode Demo (Read-Only)**: Pengunjung dapat mencoba aplikasi dan melihat dashboard tanpa bisa mengubah data (dilindungi oleh Middleware).
- 🎨 **UI/UX Modern**: Desain responsif, navbar *sticky*, notifikasi interaktif, dan form modal yang elegan.

## 🛠️ Teknologi yang Digunakan

| Kategori | Teknologi |
|---|---|
| **Backend** | Laravel 12, PHP 8.2 |
| **Database** | MySQL |
| **Frontend** | Blade, Tailwind CSS, Alpine.js |
| **Library Tambahan** | Chart.js (Grafik), FontAwesome (Ikon) |
| **Autentikasi** | Laravel Breeze |

## 🚀 Cara Menjalankan di Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer Anda:

1. **Clone repositori ini:**
   ```bash
   git clone https://github.com/yarhns/book-collection-manager.git
   cd book-collection-manager

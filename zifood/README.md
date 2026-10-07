<div align="center">

  <img src="public/img/logo.png" alt="ZiFood Logo" width="120" style="border-radius: 50%;">

  # 🍽️ ZiFood — Platform Kuliner & E-Commerce Modern

  **Menghubungkan Cita Rasa Lokal dengan Kemudahan Teknologi Masa Depan**

  <p align="center">
    <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12"></a>
    <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-%3E%3D%208.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2"></a>
    <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS"></a>
    <a href="https://alpinejs.dev"><img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white" alt="Alpine.js"></a>
    <a href="LICENSE"><img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="MIT License"></a>
  </p>

  <p align="center">
    <b>ZiFood</b> adalah platform pemesanan makanan & minuman berbasis web yang dirancang untuk mendukung talenta muda, siswa, dan pelaku UMKM kuliner di Indonesia. Dengan antarmuka modern bernuansa <i>glassmorphism</i>, ZiFood memberikan pengalaman pemesanan yang cepat, praktis, dan menyenangkan.
  </p>

  ---

  <p align="center">
    <a href="#-tentang-zifood">Tentang</a> •
    <a href="#-fitur-utama">Fitur Utama</a> •
    <a href="#-teknologi-yang-digunakan">Teknologi</a> •
    <a href="#-alur-pengguna-role">Alur Pengguna</a> •
    <a href="#-panduan-instalasi">Instalasi</a> •
    <a href="#-struktur-direktori">Struktur Direktori</a> •
    <a href="#-kontak--pengembang">Kontak</a>
  </p>

</div>

<br>

---

## 📖 Tentang ZiFood

**ZiFood** hadir sebagai solusi atas antrean panjang dan kesulitan akses pemesanan kuliner di lingkungan sekolah maupun masyarakat. Melalui sistem ini:
* **Pelanggan/Siswa** dapat memesan makanan secara instan dari kelas atau rumah dengan harga terjangkau dan kualitas terjamin.
* **Penjual/Mitra Kuliner** dapat mengelola katalog menu, memantau pesanan masuk secara *real-time*, melihat rekap keuangan/omzet, serta membangun branding toko mereka sendiri.

---

## ✨ Fitur Utama

### 🌟 1. Landing Page Interaktif & Informatif
- **Hero Banner Dinamis**: Visual memikat dengan animasi *floating* dan kombinasi gradien modern.
- **Lightbox Video Player**: Saksikan video profil pengenalan ZiFood secara langsung dalam popup modal interaktif (*autoplay* & kontrol penuh).
- **Katalog Menu Unggulan**: Cuplikan menu terbaik beserta ulasan dan rating pelanggan.
- **FAQ & Informasi Kontak**: Informasi lengkap dan akses media sosial pengembang.

---

### 🛒 2. Modul Pembeli (Buyer)
- **Eksplorasi Menu & Toko**: Cari dan temukan berbagai hidangan dari toko mitra terdaftar.
- **Keranjang Belanja Cerdas (Smart Cart)**:
  - Tambah menu ke keranjang dengan satu klik.
  - Tambah/kurang kuantitas item secara langsung.
  - Opsi **Beli Langsung (Buy Now)** untuk transaksi cepat tanpa perantara.
- **Checkout Pesanan**: Tambahkan catatan khusus (misal: *tingkat kepedasan, tanpa seledri*) saat memesan.
- **Tracking Pesanan (Pesanan Saya)**:
  - Pantau status pesanan: `Menunggu` ➔ `Diproses` ➔ `Selesai` / `Dibatalkan`.
  - Tombol **Batalkan Pesanan** (jika pesanan masih dalam status menunggu).
  - Fitur **Pesan Ulang (Re-order)** untuk memesan kembali menu favorit dalam satu klik.
- **Rating & Review**: Berikan ulasan dan penilaian bintang (1-5) setelah pesanan selesai dinikmati.
- **Manajemen Profil**: Kelola identitas, nomor telepon, dan alamat pengiriman.

---

### 🏪 3. Modul Penjual (Seller)
- **Dashboard Toko & Analitik**: Ringkasan performa penjualan, total menu, pesanan aktif, dan ringkasan pendapatan.
- **Manajemen Menu (Katalog Produk)**:
  - Tambah, edit, dan hapus menu makanan/minuman (CRUD lengkap).
  - Upload foto menu, penentuan harga, kategori, dan stok barang.
- **Manajemen Pesanan Masuk**:
  - Pantau pesanan baru dari pembeli beserta rincian jumlah dan catatan pembeli.
  - Ubah status pesanan secara bertahap (`Menunggu` ➔ `Diproses` ➔ `Selesai` / `Dibatalkan`).
- **Laporan Keuangan (Finance)**:
  - Rekap saldo dan ringkasan transaksi pesanan yang telah diselesaikan.
- **Profil & Personalisasi Toko**:
  - Kustomisasi foto profil dan *banner cover* toko.
  - Pengaturan nama toko, bio singkat, nomor kontak, dan alamat operasional.
- **Ulasan Pelanggan**: Pantau masukan dan rating yang diberikan oleh pelanggan untuk peningkatan kualitas menu.

---

### 🔐 4. Sistem Keamanan & Akses
- **Multi-Role Authentication**: Pemisahan hak akses yang ketat antara peran `penjual` dan `pembeli` menggunakan middleware Laravel.
- **Enkripsi Data**: Enkripsi password menggunakan algoritma hashing bawaan Laravel (Bcrypt).
- **Proteksi CSRF**: Perlindungan penuh pada seluruh formulir transaksi dan formulir input data.

---

## 🛠️ Teknologi yang Digunakan

| Kategori | Teknologi | Keterangan |
| :--- | :--- | :--- |
| **Backend Framework** | [Laravel 12](https://laravel.com/) | Kerangka kerja PHP modern dengan arsitektur MVC |
| **Bahasa Pemrograman** | [PHP 8.2+](https://www.php.net/) | Engine eksekusi sisi server |
| **Database** | MySQL / MariaDB / SQLite | Relational Database Management System |
| **ORM** | Eloquent ORM | Pemodelan relasi database yang rapi & ekspresif |
| **Styling & UI** | [Tailwind CSS](https://tailwindcss.com/) | Utility-first CSS framework |
| **Interaktivitas UI** | [Alpine.js](https://alpinejs.dev/) | Framework Javascript minimalis & reaktif |
| **Ikonografi** | [Font Awesome 6](https://fontawesome.com/) | Ikon grafis vektor |
| **Tipografi** | [Plus Jakarta Sans](https://fonts.google.com/specimen/Plus+Jakarta+Sans) | Font modern untuk kenyamanan keterbacaan |

---

## 👥 Alur Pengguna (User Roles)

```
                     ┌──────────────────────────┐
                     │   Landing Page (ZiFood)  │
                     └─────────────┬────────────┘
                                   │
                    ┌──────────────┴──────────────┐
                    ▼                             ▼
         [Daftar / Masuk: Pembeli]     [Daftar / Masuk: Penjual]
                    │                             │
    ┌───────────────┴───────────────┐  ┌──────────┴──────────────────┐
    ▼                               ▼  ▼                             ▼
Jelajahi Menu & Toko          Checkout Menu  Kelola Menu & Stok         Proses Pesanan
    │                               │  │                             │
    ▼                               ▼  ▼                             ▼
Tambah ke Keranjang           Lacak Status   Laporan Keuangan & Saldo    Lihat Ulasan
```

---

## 🚀 Panduan Instalasi (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan ZiFood di komputer lokal Anda:

### 1. Prasyarat Sistem
Pastikan perangkat Anda sudah terinstal:
* **PHP** versi `>= 8.2`
* **Composer** versi terbaru
* **MySQL** / MariaDB (misal via XAMPP, Laragon, dsb.)
* **Git**

### 2. Klon Repositori
```bash
git clone https://github.com/username-anda/zifood.git
cd zifood
```

### 3. Pasang Dependensi PHP
```bash
composer install
```

### 4. Konfigurasi Environment (`.env`)
Salin file template `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
> *Pada sistem Windows PowerShell / CMD:*
> ```powershell
> copy .env.example .env
> ```

Buka file `.env` lalu sesuaikan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zifood
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Migrasi Database & Seeder
Buat database baru bernama `zifood` pada MySQL Anda, kemudian jalankan migrasi tabel:
```bash
php artisan migrate
```
*(Opsional) Jalankan seeder untuk memasukkan data awal:*
```bash
php artisan db:seed
```

### 7. Hubungkan Storage Link
Pastikan folder upload aset dapat diakses publik:
```bash
php artisan storage:link
```

### 8. Jalankan Server Lokal
```bash
php artisan serve
```

Aplikasi kini dapat diakses melalui browser Anda di:
👉 **`http://127.0.0.1:8000`**

---

## 📁 Struktur Direktori Proyek

Ringkasan struktur direktori utama ZiFood:

```plaintext
zifood/
├── app/
│   ├── Http/
│   │   ├── Controllers/         # AuthController, MenuController, OrderController, CartController, dsb.
│   │   └── Middleware/          # Role Middleware (Penjual & Pembeli)
│   └── Models/                  # User, Menu, Order, Cart, Review
├── database/
│   ├── migrations/              # Skema tabel database (Users, Menus, Orders, Carts, Reviews, dll.)
│   └── seeders/                 # Data inisialisasi awal
├── public/
│   ├── img/                     # Logo dan aset visual statis
│   └── vid/                     # Video profil ZiFood (zifood vidio.mp4)
├── resources/
│   └── views/
│       ├── auth/                # Halaman Login & Register
│       ├── buyer/               # Halaman Pembeli (Dashboard, Cart, Orders, Profile, Explore)
│       ├── seller/              # Halaman Penjual (Dashboard, Products, Orders, Finance, Shop, Reviews)
│       └── welcome.blade.php    # Landing Page Utama
├── routes/
│   └── web.php                  # Seluruh rute aplikasi (Public, Auth, Penjual, Pembeli)
└── README.md                    # Dokumentasi proyek
```

---

## 📱 Akun Pengujian (Demo)

Anda dapat membuat akun baru melalui menu **Daftar Sekarang** dengan memilih peran yang diinginkan:

| Peran | Deskripsi Akses |
| :--- | :--- |
| **Pembeli** | Akses katalog kuliner, memasukkan menu ke keranjang, checkout pesanan, melacak status, dan memberikan ulasan. |
| **Penjual** | Akses dashboard manajemen, membuat menu baru, memproses pesanan masuk, mengelola keuangan, dan mengatur profil toko. |

---

## 👨‍💻 Kontak & Pengembang

Proyek ini dikembangkan oleh:
* **Pengembang**: Zaidan
* **Email**: [Zaidanf504@gmail.com](mailto:Zaidanf504@gmail.com)
* **Instagram**: [@jidan_flutter](https://www.instagram.com/jidan_flutter/)
* **WhatsApp**: [+62 821-4006-6232](https://wa.me/6282140066232)
* **Alamat**: Kota Pasuruan, Jawa Timur, Indonesia

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah lisensi [MIT License](LICENSE) — Anda bebas menggunakannya untuk tujuan pembelajaran dan pengembangan lebih lanjut.

<div align="center">
  <sub>Dibuat dengan ❤️ untuk kemajuan kuliner nusantara bersama <b>ZiFood</b>.</sub>
</div>

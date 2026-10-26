# 🛒 K-Pop Merchandise Inventory System (Kpop-Inventory)

Aplikasi berbasis web untuk mengelola inventaris merchandise K-Pop secara efisien, lengkap dengan manajemen stok, kategori, supplier, serta sistem transaksi pembelian (checkout) dan riwayat pesanan bagi pelanggan.

---

## 👥 Hak Akses & Kunci Akun Login (Roles & Credentials)

Aplikasi ini memiliki 3 tingkat hak akses (*roles*) yang dapat digunakan untuk menguji fitur yang berbeda. Berikut adalah daftar email dan password default-nya:

| Role / Hak Akses | Nama Akun | Email Login | Password | Akses & Fitur Utama |
| :--- | :--- | :--- | :--- | :--- |
| **Admin** | Admin Utama | `admin@kpopmerch.com` | `password123` | Mengontrol penuh seluruh data (Kategori, Supplier, Produk, Transaksi, dan Manajemen Akun). |
| **Staff** | Staff Gudang | `staff@kpopmerch.com` | `password123` | Mengelola stok gudang, produk, dan memantau jalannya transaksi barang masuk/keluar. |
| **Customer** | Customer Pembeli | `customer@kpopmerch.com` | `password123` | Melakukan *browsing* produk K-Pop, melakukan *checkout* pembelian, dan melihat **Pesanan Saya**. |

---

## 🚀 Fitur Utama Aplikasi
1. **Manajemen Kategori & Supplier**: Mengelola daftar kategori merchandise (Lightstick, Album, Photocard, dll) serta data supplier terpercaya secara CRUD lengkap.
2. **Manajemen Produk**: Menambah, mengubah, dan menghapus data stok produk merchandise lengkap dengan harga, foto, dan kategori.
3. **Sistem Transaksi & Checkout**: Memungkinkan pelanggan melakukan pembelian langsung secara online serta pencatatan transaksi barang masuk/keluar untuk kebutuhan inventaris.
4. **Riwayat Pesanan ("Pesanan Saya")**: Fitur khusus *customer* untuk melacak daftar riwayat transaksi atau pesanan yang pernah dibuat.
5. **Autentikasi & Otorisasi Berbasis Role**: Pembatasan hak akses halaman secara otomatis menggunakan middleware Laravel (Admin, Staff, dan Customer terpisah).

---

## 🛠️ Teknologi yang Digunakan
* **Framework Backend**: Laravel (PHP 8.5)
* **Database**: MySQL via XAMPP
* **Frontend**: Blade Templating Engine & Tailwind CSS
* **Development Tools**: Visual Studio Code, Composer, Git

---

## ⚙️ Cara Menjalankan Proyek (Installation Guide)

Jika kamu baru saja menyalakan komputer atau membuka kembali proyek ini setelah mematikan terminal, ikuti langkah-langkah berikut:

1. **Nyalakan XAMPP Control Panel**
   * Pastikan module **Apache** dan **MySQL** dalam status **Start** (Running).

2. **Buka Proyek melalui Terminal VS Code**
   * Masuk ke direktori proyek kamu.

3. **Jalankan Perintah Server Laravel**
   ```bash
   php artisan serve
# DEMO API Payment Gateway Wrapper

Platform Payment Gateway Wrapper berbasis **PHP Native MVC** yang dirancang khusus untuk meneruskan pembayaran, mengelola saldo merchant, serta menjembatani sistem Anda dengan multi-versi **YoBasePay Gateway (V1 / V2 / V3)** secara dinamis.

---

## 🚀 Fitur Utama

1. **Arsitektur PHP MVC Kustom**: Dibuat secara native, sangat ringan, tanpa dependensi berat, dan berkinerja tinggi.
2. **Routing Bersih (Clean URL)**: Didukung oleh penataan `.htaccess` pintar di tingkat root dan public directory.
3. **Multi-Proyek Terpisah**: Memungkinkan merchant membuat beberapa aplikasi mandiri dengan kredensial unik.
4. **Versi API Dinamis**: Pilih secara spesifik rute backend gateway (V1, V2, atau V3) untuk masing-masing proyek yang Anda kelola.
5. **Autentikasi Bearer Ganda**: Mendukung otentikasi global (`Merchant Key`) maupun otentikasi spesifik (`Project Key`).
6. **Keamanan Webhook HMAC**: Menandatangani notifikasi callback ke server Anda menggunakan algoritma enkripsi HMAC-SHA256 untuk memvalidasi keaslian transaksi.
7. **Portal Dokumentasi Terintegrasi**: Panduan integrasi komprehensif interaktif langsung dari Dasbor.

---

## 📁 Struktur Folder Proyek

```text
demoapi/
├── app/                    # Inti Logika Aplikasi (MVC)
│   ├── config/             # File Konfigurasi URL, DB, & API Credentials
│   ├── controllers/        # Logika Controller Halaman & Endpoint API
│   ├── core/               # Engine Utama (App Router, Controller Base, PDO Database)
│   ├── models/             # Logika Query Database (User, Transaction, Projects)
│   └── views/              # Kumpulan Template UI/UX Mode Terang
├── public/                 # Akses Publik Web Server (index.php, .htaccess)
├── database.sql            # Skema Struktur Basis Data SQL Lengkap
├── .htaccess               # Penanganan Rewrite URL untuk Laragon/Apache
└── README.md               # Dokumentasi ini
```

---

## ⚙️ Panduan Pemasangan (Instalasi)

### 1. Persyaratan Sistem
- **Laragon** / **XAMPP** (Rekomendasi PHP versi 7.4 hingga 8.2+)
- **MySQL / MariaDB** aktif.
- Modul `mod_rewrite` Apache diaktifkan.

### 2. Langkah Setup Database
1. Buka **phpMyAdmin** atau client SQL pilihan Anda (HeidiSQL / DBeaver).
2. Buat basis data baru bernama `demoapi_db`.
3. Impor struktur tabel dari file [database.sql](file:///c:/laragon/www/demoapi/database.sql) yang berada di folder utama root proyek.

### 3. Konfigurasi Kredensial
Buka file konfigurasi di `app/config/config.php` lalu sesuaikan kredensial DB Anda:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // isi password jika ada
define('DB_NAME', 'demoapi_db');
```

### 4. Akses Dashboard
Jalankan server lokal dan buka peramban Anda pada:
```text
http://localhost/demoapi
```
**Kredensial Bawaan (Default):**
- Username: `admin`
- Password: `password123`

---

## 📡 Referensi API Ringkas

Semua permintaan API memerlukan penyematan HTTP Header Otentikasi:
`Authorization: Bearer {MERCHANT_API_KEY_ATAU_PROJECT_KEY}`

### 1. Buat Pembayaran (Create)
- **Endpoint**: `/api/v1/payments/create`
- **Metode**: `POST`
- **Payload JSON**:
  ```json
  {
    "amount": 25000,
    "ref_id": "INV-RANDOM-123",
    "customer_name": "Budi Santoso"
  }
  ```

### 2. Cek Status Transaksi
- **Endpoint**: `/api/v1/payments/status/{ref_id_atau_trx_id}`
- **Metode**: `GET`

### 3. Struktur Webhook Signature
Platform ini mengirimkan header `X-DemoAPI-Signature` berisi kode HMAC-SHA256.
Cara validasi di backend server merchant:
```php
$signature = hash_hmac('sha256', file_get_contents('php://input'), 'API_KEY_ANDA');
```

---

## 🏆 Teknologi yang Digunakan
- **Backend**: PHP Core Native (Object-Oriented) + PDO Driver
- **Frontend**: Bootstrap 5 (Mode Terang Minimalis), AOS Library (Animate On Scroll), FontAwesome 6 Icons.
- **Database**: MySQL / MariaDB.

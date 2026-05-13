<div align="center">

<!-- ANIMATED HEADER TYPING -->
<img src="https://readme-typing-svg.herokuapp.com?font=Inter&weight=800&size=36&duration=3000&pause=1000&color=0D6EFD&center=true&vCenter=true&width=700&height=70&lines=DEMO+API+WRAPPER;Multi-Version+YoBasePay;Clean+Architecture+PHP+MVC;Automated+HMAC+Security" alt="Typing SVG" />

<p align="center">
  <strong>High-performance Native PHP Payment Wrapper Engine</strong>
</p>

<!-- DYNAMIC ANIMATED BADGES -->
<a href="https://php.net">
  <img src="https://img.shields.io/badge/PHP-7.4%2B%20%7C%208.x-blue?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version" />
</a>
<a href="https://getbootstrap.com">
  <img src="https://img.shields.io/badge/UI-Bootstrap%205-7952b3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5" />
</a>
<a href="https://mysql.com">
  <img src="https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
</a>
<a href="#">
  <img src="https://img.shields.io/badge/License-MIT-brightgreen?style=for-the-badge" alt="MIT License" />
</a>

<br />
<hr style="border: 1px dashed #dee2e6" />

</div>

## Pengenalan Singkat

Platform Payment Gateway Wrapper canggih berbasis PHP Native MVC yang dirancang khusus untuk menjembatani aplikasi e-commerce Anda dengan ekosistem multi-versi YoBasePay Gateway (V1 / V2 / V3) secara aman, real-time, dan otomatis.

---

## Fitur Unggulan

<details open>
<summary><b>Klik Untuk Melihat Keunggulan Platform</b></summary>
<br/>

*   Routing Clean URL: Didukung oleh engine `.htaccess` pintar yang menghilangkan ekstensi berkas secara otomatis.
*   Multi-Proyek Merchant: Buat ratusan proyek dengan kredensial `Project Key (PRJ_)` terisolasi.
*   Target Versi Dinamis: Tentukan secara spesifik backend API tujuan (V1, V2, atau V3) pada setiap proyek aplikasi.
*   Validasi Webhook HMAC: Enkripsi tandatangan searah SHA256 menjamin notifikasi sukses 100% otentik.
*   Native MVC Engine: Dibuat dari nol, nol dependensi pihak ketiga (Zero bloating), berkinerja super kilat!
*   SVG Captcha Generator: Pelindung keamanan formulir pendaftaran anti-bot yang 100% bebas ketergantungan ekstensi server.
</details>

---

## Pratinjau Arsitektur Folder

```mermaid
graph TD
    A[demoapi/] --> B[app/]
    A --> C[public/]
    B --> D[core/ - Engine Utama]
    B --> E[controllers/ - API Dispatcher]
    B --> F[models/ - Database Layer]
    B --> G[views/ - UI Bootstrap 5]
    C --> H[index.php - Entry Point]
    style A fill:#f9f,stroke:#333,stroke-width:2px
    style D fill:#bbf,stroke:#333,stroke-width:2px
    style E fill:#dfd,stroke:#333,stroke-width:2px
    style G fill:#ffd,stroke:#333,stroke-width:2px
```

---

## Langkah Pemasangan

### Persiapan Sistem
*   Aktifkan Laragon / XAMPP (PHP 7.4 - 8.2+).
*   Pastikan modul Apache Rewrite (`mod_rewrite`) aktif.

### Inisialisasi Database
1.  Buka manajer basis data Anda (HeidiSQL / phpMyAdmin).
2.  Eksekusi skema terstruktur lengkap dari file [database.sql](file:///c:/laragon/www/demoapi/database.sql).

### Konfigurasi Kredensial Lokal
Buka berkas konfigurasi Anda:
```php
// file: app/config/config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'demoapi_db');
define('DB_USER', 'root');
define('DB_PASS', ''); // sesuaikan password database Anda
```

---

## API Command Reference Center

<div align="center">
  <img src="https://img.shields.io/badge/Header-Authorization%3A%20Bearer%20%7BKey%7D-red?style=flat-square" alt="Auth Header" />
</div>

| Metode | Endpoint | Fungsi & Keterangan |
| :--- | :--- | :--- |
| `POST` | `/api/v1/payments/create` | Membuat tautan & Gambar QRIS baru. |
| `GET` | `/api/v1/payments/status/{id}` | Polling / Cek status pembayaran spesifik. |
| `POST` | `/api/webhook` | Penerima callback gerbang YoBasePay. |

<br/>

#### Snippet cURL Pembuatan QRIS Instan:
```bash
curl -X POST "http://localhost/demoapi/api/v1/payments/create" \
-H "Authorization: Bearer YOUR_API_KEY" \
-H "Content-Type: application/json" \
-d '{
  "amount": 25000,
  "ref_id": "INV-UNIQUE-REF-123",
  "customer_name": "Budi Santoso"
}'
```

---

## Verifikasi Tanda Tangan Webhook (HMAC-SHA256)
Berikut visualisasi alur logika otentikasi callback pada server backend Anda:

```php
<?php
$rawPayload = file_get_contents('php://input');
$headers = apache_request_headers();
$receivedSig = $headers['X-DemoAPI-Signature'] ?? '';

// Buat hash pencocokan lokal menggunakan API Key Anda
$expectedSig = hash_hmac('sha256', $rawPayload, 'KUNCI_API_MERCHANT_ANDA');

if (hash_equals($expectedSig, $receivedSig)) {
    // LUNAS! Data otentik & Terverifikasi secara sah.
    echo json_encode(["status" => "OK"]);
} else {
    http_response_code(401);
}
?>
```

---

<div align="center">

### Dibuat dengan Penuh Semangat

<img src="https://forthebadge.com/images/featured/featured-built-with-love.svg" height="30" />
<img src="https://forthebadge.com/images/featured/featured-coffe-powered.svg" height="30" />

</div>

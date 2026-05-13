<?php
$user = $data['user'];
?>

<div class="row mb-4" data-aos="fade-down">
    <div class="col">
        <h2 class="fw-bold"><i class="fa-solid fa-code me-2 text-primary"></i> Developer Portal & API Docs</h2>
        <p class="text-muted">Gunakan panduan komprehensif di bawah ini untuk mengintegrasikan sistem e-commerce Anda dengan platform wrapper kami.</p>
    </div>
</div>

<?php if (isset($_SESSION['flash_success'])): ?>
    <div class="alert alert-success bg-opacity-10 border-success border-opacity-25 text-success mb-4" role="alert" data-aos="zoom-in">
        <i class="fa-solid fa-circle-check me-2"></i> <?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?>
    </div>
<?php endif; ?>

<div class="row g-4 mb-5" data-aos="fade-up">
    <!-- Kiri: Konfigurasi & API Key -->
    <div class="col-xl-4 col-lg-5">
        <div class="glass-card p-4 mb-4">
            <h5 class="fw-bold mb-3 pb-2 border-bottom"><i class="fa-solid fa-key me-1 text-primary"></i> Kredensial Global</h5>
            
            <div class="mb-4">
                <label class="form-label text-muted small fw-bold">GLOBAL MERCHANT API KEY</label>
                <div class="d-flex gap-2 align-items-center bg-light p-3 rounded-3 border">
                    <code id="apiKeyText" class="text-danger flex-grow-1 font-monospace text-break" style="font-size: 0.85rem;"><?= htmlspecialchars($user['api_key']) ?></code>
                    <button onclick="copyApiKey()" class="btn btn-sm btn-outline-secondary border-opacity-25 py-1" title="Salin API Key">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                </div>
                <div class="form-text text-muted small mt-2">
                    <i class="fa-solid fa-circle-info text-primary me-1"></i> API Key global ini akan selalu menggunakan versi <strong>YoBasePay V3</strong> secara baku.
                </div>
            </div>

            <form action="<?= BASEURL ?>/dashboard/settings" method="POST" class="border-top pt-3">
                <div class="mb-3">
                    <label for="webhook_url" class="form-label text-muted small fw-bold">GLOBAL WEBHOOK URL</label>
                    <input type="url" class="form-control form-control-dark" id="webhook_url" name="webhook_url" 
                           value="<?= htmlspecialchars($user['webhook_url'] ?? '') ?>" 
                           placeholder="https://server-anda.com/webhook" required>
                    <div class="form-text text-muted small">Callback target default jika tidak diatur di tingkat proyek.</div>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold py-2">
                    <i class="fa-solid fa-floppy-disk me-2"></i> Perbarui Webhook
                </button>
            </form>
        </div>

        <!-- Info Card -->
        <div class="card border-warning bg-warning bg-opacity-10 text-dark p-3 rounded-3 border">
            <div class="d-flex">
                <div class="me-2"><i class="fa-solid fa-triangle-exclamation fa-lg text-warning"></i></div>
                <div>
                    <h6 class="fw-bold mb-1">Proyek Multi-Versi</h6>
                    <p class="small mb-0 text-muted">Gunakan tab <strong><a href="<?= BASEURL ?>/dashboard/projects" class="text-decoration-none fw-bold">Proyek</a></strong> untuk membuat kredensial per-proyek jika Anda ingin menembak gerbang <strong>YoBasePay V1 atau V2</strong> secara terpisah.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kanan: Dokumentasi API Lengkap -->
    <div class="col-xl-8 col-lg-7">
        <div class="glass-card p-4 h-100">
            <h5 class="fw-bold mb-3 pb-2 border-bottom"><i class="fa-solid fa-book me-1 text-primary"></i> Referensi API Lengkap</h5>
            
            <!-- Dokumentasi Navigation Tabs -->
            <ul class="nav nav-pills bg-light p-1 rounded-3 mb-4 overflow-auto flex-nowrap" id="apiDocsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active py-2 px-3" data-bs-toggle="pill" data-bs-target="#tabIntro" type="button" role="tab"><i class="fa-solid fa-rocket me-1"></i> Pengenalan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-2 px-3" data-bs-toggle="pill" data-bs-target="#tabCreate" type="button" role="tab"><i class="fa-solid fa-plus me-1"></i> 1. Create</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-2 px-3" data-bs-toggle="pill" data-bs-target="#tabStatus" type="button" role="tab"><i class="fa-solid fa-magnifying-glass me-1"></i> 2. Status</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-2 px-3" data-bs-toggle="pill" data-bs-target="#tabWebhook" type="button" role="tab"><i class="fa-solid fa-bell me-1"></i> 3. Webhook</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-2 px-3 text-nowrap" data-bs-toggle="pill" data-bs-target="#tabSDK" type="button" role="tab"><i class="fa-solid fa-code me-1"></i> 4. Code Snippets</button>
                </li>
            </ul>

            <!-- Tab Content Rendering -->
            <div class="tab-content" id="apiDocsTabsContent">
                
                <!-- Tab: Introduction -->
                <div class="tab-pane fade show active" id="tabIntro" role="tabpanel">
                    <h6 class="fw-bold text-dark">Base Endpoint URL</h6>
                    <div class="bg-light p-2 px-3 rounded border mb-3 font-monospace text-primary small">
                        <?= BASEURL ?>
                    </div>
                    
                    <p class="small text-muted">Untuk mengakses semua rute API kami, Anda harus mengirimkan token otentikasi di bagian HTTP Header permintaan Anda.</p>
                    
                    <h6 class="fw-bold text-dark mt-4">Metode Otentikasi</h6>
                    <div class="table-responsive mb-3">
                        <table class="table table-sm table-bordered small mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Tipe Kunci</th>
                                    <th>Nilai Header</th>
                                    <th>Versi Default</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-secondary">Merchant Key</span></td>
                                    <td><code>Authorization: Bearer <?= substr($user['api_key'], 0, 12) ?>...</code></td>
                                    <td class="fw-bold">V3</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-primary">Project Key</span></td>
                                    <td><code>Authorization: Bearer PRJ_XXXXX...</code></td>
                                    <td class="text-info">Dinamis (V1/V2/V3)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="small text-muted mb-4"><i class="fa-solid fa-circle-info me-1"></i> Kunci Proyek (`PRJ_`) secara cerdas akan mengalihkan forwarding ke endpoint gerbang YoBasePay yang sesuai dengan pilihan versi saat proyek tersebut dibuat.</p>

                    <h6 class="fw-bold text-dark mt-4"><i class="fa-solid fa-triangle-exclamation text-danger me-1"></i> Daftar HTTP & Error Status</h6>
                    <p class="small text-muted">Platform wrapper mengembalikan kode HTTP standar serta objek error JSON saat validasi gagal:</p>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped small border">
                            <thead>
                                <tr class="bg-light">
                                    <th>HTTP</th>
                                    <th>Kode Keadaan</th>
                                    <th>Arti & Respon Skema</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code class="text-success">200</code></td>
                                    <td>OK</td>
                                    <td>Sukses, properti <code>"status": true</code> dikembalikan.</td>
                                </tr>
                                <tr>
                                    <td><code class="text-danger">400</code></td>
                                    <td>Bad Request</td>
                                    <td>Data masukan tidak valid (misalnya, <code>"Duplicate ref_id"</code>).</td>
                                </tr>
                                <tr>
                                    <td><code class="text-danger">401</code></td>
                                    <td>Unauthorized</td>
                                    <td>Kunci API tidak terdaftar / Hilang dari HTTP Header.</td>
                                </tr>
                                <tr>
                                    <td><code class="text-danger">404</code></td>
                                    <td>Not Found</td>
                                    <td>Endpoint atau data transaksi yang dicari tidak ada.</td>
                                </tr>
                                <tr>
                                    <td><code class="text-warning">502</code></td>
                                    <td>Gateway Error</td>
                                    <td>YoBasePay backend mengembalikan galat atau tidak merespon.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab: Create Payment -->
                <div class="tab-pane fade" id="tabCreate" role="tabpanel">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-success px-2 py-1 font-monospace">POST</span>
                        <code class="text-primary font-monospace small fw-bold">/api/v1/payments/create</code>
                    </div>
                    <p class="small text-muted">Kirimkan permintaan berikut untuk membangkitkan tautan tagihan dan gambar QRIS dari YoBasePay.</p>
                    
                    <h6 class="fw-bold text-dark small mb-2">Request Body (JSON)</h6>
<pre class="bg-dark text-light p-3 rounded-3 font-monospace small mb-3">
{
  "amount": 15000,
  "ref_id": "INV-2026-0001",
  "customer_name": "Budi Santoso",
  "customer_email": "budi@gmail.com"
}
</pre>
                    <h6 class="fw-bold text-dark small mb-2">Respon Sukses (HTTP 200)</h6>
<pre class="bg-dark text-light p-3 rounded-3 font-monospace small mb-0" style="color: #a7f3d0 !important; max-height: 250px; overflow: auto;">
{
  "status": true,
  "message": "Payment created successfully",
  "data": {
    "trx_id": "YO-V3-A1B2C3D4",
    "ref_id": "INV-2026-0001",
    "amount": 15000,
    "fee_admin": 650,
    "net_amount": 14350,
    "qr_image": "https://api.qrserver.com/v1/create-qr-code/?size=300&data=...",
    "payment_url": "https://yobasepay.net/pay/...",
    "expired_at": "2026-05-13 09:45:00"
  }
}
</pre>
                </div>

                <!-- Tab: Check Status -->
                <div class="tab-pane fade" id="tabStatus" role="tabpanel">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary px-2 py-1 font-monospace">GET</span>
                        <code class="text-primary font-monospace small fw-bold">/api/v1/payments/status/{ref_id_atau_trx_id}</code>
                    </div>
                    <p class="small text-muted">Cek status tagihan secara berkala (*polling*) menggunakan ID referensi merchant (`ref_id`) Anda atau ID transaksi dari platform wrapper (`trx_id`).</p>
                    
                    <h6 class="fw-bold text-dark mt-3 small mb-2">Contoh Request cURL</h6>
<pre class="bg-dark text-info p-3 rounded-3 font-monospace small mb-3">
curl -X GET "<?= BASEURL ?>/api/v1/payments/status/INV-2026-0001" \
-H "Authorization: Bearer {API_KEY_ANDA}"
</pre>

                    <h6 class="fw-bold text-dark small mb-2">Contoh Respon Sukses</h6>
<pre class="bg-dark text-light p-3 rounded-3 font-monospace small mb-0" style="max-height: 250px; overflow: auto;">
{
  "status": true,
  "data": {
    "trx_id": "YO-V3-A1B2C3D4",
    "ref_id": "INV-2026-0001",
    "status": "SUCCESS", // PENDING, SUCCESS, atau EXPIRED
    "amount": 15000,
    "net_amount": 14350,
    "created_at": "2026-05-13 09:30:00",
    "paid_at": "2026-05-13 09:32:45"
  }
}
</pre>
                </div>

                <!-- Tab: Webhook Forwarding -->
                <div class="tab-pane fade" id="tabWebhook" role="tabpanel">
                    <p class="small text-muted">Setiap kali gerbang YoBasePay mendeteksi pembayaran sukses, platform kami akan menerima callback, mengkreditkan saldo Anda, kemudian secara otomatis menembakkan Webhook lanjutan ke server Anda.</p>
                    
                    <h6 class="fw-bold text-dark small mb-2">Format Payload Kiriman Ke Server Anda (JSON POST)</h6>
<pre class="bg-dark text-light p-3 rounded-3 font-monospace small mb-3" style="color: #fcd34d !important;">
{
  "status": "PAID",
  "merchant_ref_id": "INV-2026-0001",
  "trx_id": "YO-V3-A1B2C3D4",
  "amount_paid": 15000,
  "net_amount": 14350,
  "signature": "64e5582f3e9f55e80... (HMAC-SHA256)"
}
</pre>
                    <h6 class="fw-bold text-dark mt-3 small mb-2">Langkah Validasi Keamanan (Signature Check)</h6>
                    <p class="small text-muted mb-2">Kami menyematkan signature khusus menggunakan HMAC SHA-256 dengan kunci rahasia menggunakan **API Key Anda**. Verifikasi signature tersebut di sisi backend server Anda:</p>
<pre class="bg-light p-3 rounded-3 border font-monospace text-dark small mb-0" style="font-size: 0.8rem;">
// Contoh Verifikasi di PHP:
$rawPayload = file_get_contents('php://input');
$headers = apache_request_headers();
$incomingSig = $headers['X-DemoAPI-Signature'] ?? '';

$apiKey = 'API_KEY_ANDA';
$calculatedSig = hash_hmac('sha256', $rawPayload, $apiKey);

if (hash_equals($calculatedSig, $incomingSig)) {
    // Valid & Aman! Update pesanan Anda menjadi lunas.
}
</pre>
                </div>

                <!-- Tab: Code Snippets (Node JS / Python / Multi Language) -->
                <div class="tab-pane fade" id="tabSDK" role="tabpanel">
                    <p class="small text-muted">Contoh potongan kode untuk membuat request pembayaran sukses menggunakan berbagai bahasa pemrograman:</p>
                    
                    <nav class="mb-2">
                        <div class="nav nav-tabs small" id="sdkLangTabs" role="tablist">
                            <button class="nav-link active py-1 px-2" data-bs-toggle="tab" data-bs-target="#sdkNode" type="button" role="tab">Node.js (Axios)</button>
                            <button class="nav-link py-1 px-2" data-bs-toggle="tab" data-bs-target="#sdkPython" type="button" role="tab">Python (Requests)</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="sdkLangTabsContent">
                        <!-- Node.js -->
                        <div class="tab-pane fade show active" id="sdkNode" role="tabpanel">
<pre class="bg-dark text-light p-3 rounded-3 font-monospace small mb-0" style="font-size: 0.75rem; max-height: 250px; overflow: auto;">
const axios = require('axios');

const createPayment = async () => {
  try {
    const response = await axios.post('<?= BASEURL ?>/api/v1/payments/create', {
      amount: 25000,
      ref_id: 'INV-' + Date.now(),
      customer_name: 'Rendi Lesmana'
    }, {
      headers: {
        'Authorization': 'Bearer YOUR_KEY_HERE',
        'Content-Type': 'application/json'
      }
    });
    console.log('Payment QR URL:', response.data.data.qr_image);
  } catch (error) {
    console.error('Error creating payment:', error.response.data);
  }
};
</pre>
                        </div>
                        <!-- Python -->
                        <div class="tab-pane fade" id="sdkPython" role="tabpanel">
<pre class="bg-dark text-light p-3 rounded-3 font-monospace small mb-0" style="font-size: 0.75rem; max-height: 250px; overflow: auto;">
import requests
import time

url = "<?= BASEURL ?>/api/v1/payments/create"
headers = {
    "Authorization": "Bearer YOUR_KEY_HERE",
    "Content-Type": "application/json"
}
payload = {
    "amount": 25000,
    "ref_id": f"INV-{int(time.time())}",
    "customer_name": "Rendi Lesmana"
}

response = requests.post(url, json=payload, headers=headers)
if response.status_code == 200:
    data = response.json()
    print("QR Link:", data['data']['qr_image'])
else:
    print("Failed:", response.text)
</pre>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
function copyApiKey() {
    const text = document.getElementById('apiKeyText').innerText;
    navigator.clipboard.writeText(text).then(() => {
        alert('API Key berhasil disalin ke clipboard!');
    }).catch(err => {
        console.error('Could not copy text: ', err);
    });
}
</script>

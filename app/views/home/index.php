<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'DEMO API - Fast Payment Wrapper' ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #333547;
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #eaecef;
            padding: 1rem 0;
            transition: padding 0.2s;
        }

        .hero-section {
            padding: 140px 0 90px;
            background: radial-gradient(circle at bottom right, #eef2f7 0%, #ffffff 80%);
        }

        .hero-badge {
            background-color: #e7f1ff;
            color: #0d6efd;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-size: clamp(2.5rem, 4.5vw, 3.8rem);
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #1f2937;
            line-height: 1.2;
        }

        .hero-desc {
            font-size: 1.15rem;
            color: #6b7280;
            max-width: 540px;
            margin-bottom: 2rem;
        }

        .custom-card {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .custom-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
        }

        .code-mockup {
            background-color: #1e293b;
            color: #f8fafc;
            border-radius: 12px;
            font-family: 'Fira Code', monospace;
            font-size: 0.8rem;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .code-header {
            background-color: #0f172a;
            padding: 10px 15px;
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .code-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .code-body {
            padding: 16px;
            line-height: 1.6;
        }

        .token-keyword { color: #c084fc; }
        .token-string { color: #34d399; }
        .token-key { color: #60a5fa; }
        .token-number { color: #fca5a5; }

        .features-section {
            padding: 80px 0;
            background-color: #f9fafb;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background-color: #eef2f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #0d6efd;
            margin-bottom: 1.2rem;
        }

        .cta-section {
            padding: 70px 0;
            background-color: #0d6efd;
            color: #ffffff;
        }

        .btn-cta-light {
            background-color: #ffffff;
            color: #0d6efd;
            font-weight: 600;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            transition: opacity 0.2s;
        }
        
        .btn-cta-light:hover {
            opacity: 0.9;
            color: #0d6efd;
        }

        footer {
            background-color: #f3f4f6;
            border-top: 1px solid #e5e7eb;
            padding: 40px 0;
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold" href="<?= BASEURL ?>/home">
            <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded-3 me-2" style="width: 32px; height: 32px;">
                <i class="fa-solid fa-bolt fa-sm"></i>
            </div>
            <span>DEMO<span class="text-primary">API</span></span>
        </a>
        
        <div class="ms-auto d-flex align-items-center gap-3">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= BASEURL ?>/dashboard" class="btn btn-primary px-4 py-2 rounded-3">
                    Dashboard
                </a>
            <?php else: ?>
                <a href="<?= BASEURL ?>/home/login" class="text-secondary text-decoration-none fw-semibold small me-2">Developer Log in</a>
                <a href="<?= BASEURL ?>/home/login" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold">
                    Mulai Sekarang
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left -->
            <div class="col-lg-6 text-center text-lg-start" data-aos="fade-right">
                <div class="hero-badge">
                    🚀 Simple Payment Wrapper V3
                </div>
                <h1 class="hero-title mb-3">
                    Solusi Integrasi <span class="text-primary">QRIS Gateway</span> Mudah
                </h1>
                <p class="hero-desc">
                    DEMO API menyediakan layer wrapper native untuk menghubungkan web Anda dengan API YoBasePay V3. Cepat, aman, dan andal.
                </p>
                <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3 mb-4">
                    <a href="<?= BASEURL ?>/home/login" class="btn btn-primary btn-lg px-4 py-3 fw-semibold rounded-3">
                        Masuk ke Dashboard
                    </a>
                    <a href="#features" class="btn btn-outline-secondary btn-lg px-4 py-3 fw-semibold rounded-3">
                        Pelajari Fitur
                    </a>
                </div>
            </div>

            <!-- Right -->
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left" data-aos-delay="100">
                <div class="code-mockup">
                    <div class="code-header">
                        <div class="code-dot bg-danger"></div>
                        <div class="code-dot bg-warning"></div>
                        <div class="code-dot bg-success"></div>
                        <span class="text-muted small ms-2" style="font-size: 0.7rem;">cURL Request</span>
                    </div>
                    <div class="code-body">
<span class="text-muted">// Endpoint Pembuatan Tagihan</span><br>
<span class="token-keyword">curl</span> -X POST <span class="token-string">"<?= BASEURL ?>/api/v1/payments/create"</span> \<br>
&nbsp;&nbsp;-H <span class="token-string">"Authorization: Bearer {MERCHANT_KEY}"</span> \<br>
&nbsp;&nbsp;-d '{<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="token-key">"amount"</span>: <span class="token-number">25000</span>,<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="token-key">"ref_id"</span>: <span class="token-string">"INV-<?= date('Ymd') ?>-01"</span><br>
&nbsp;&nbsp;}'
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="features-section" id="features">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-bold text-uppercase small tracking-widest">Fitur Unggulan</span>
            <h2 class="fw-bold mt-2 text-dark">Mengapa Memilih DEMO API?</h2>
            <p class="text-muted mx-auto" style="max-width: 500px;">Membangun sistem routing handal di atas core PHP Native yang sangat ringan.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="custom-card p-4 h-100">
                    <div class="feature-icon bg-primary bg-opacity-10 text-primary">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h5 class="fw-bold text-dark">API Forwarding</h5>
                    <p class="text-muted small mb-0">Meneruskan pembayaran ke YoBasePay V3 secara real-time dengan respon latensi yang sangat rendah.</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="custom-card p-4 h-100">
                    <div class="feature-icon bg-success bg-opacity-10 text-success">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Validasi Webhook</h5>
                    <p class="text-muted small mb-0">Validasi signature HMAC-SHA256 memastikan setiap notifikasi callback transaksi adalah sah dan aman.</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="custom-card p-4 h-100">
                    <div class="feature-icon bg-warning bg-opacity-10 text-warning">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Manajemen Saldo</h5>
                    <p class="text-muted small mb-0">Potongan fee admin dan pencatatan volume penjualan bersih (net) diproses secara otomatis.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section text-center">
    <div class="container" data-aos="zoom-in">
        <h2 class="fw-bold mb-3">Mulai Integrasi Hari Ini</h2>
        <p class="opacity-75 mb-4 mx-auto" style="max-width: 500px;">Konfigurasi API Key Anda dan buat request pembayaran pertama Anda sekarang juga.</p>
        <a href="<?= BASEURL ?>/home/login" class="btn btn-cta-light btn-lg px-5 fw-bold shadow-sm">
            Buka Dashboard <i class="fa-solid fa-arrow-right ms-1"></i>
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="text-center text-md-start">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-6">
                <span class="fw-bold text-dark"><i class="fa-solid fa-bolt text-primary me-1"></i> DEMOAPI</span>
                <p class="text-muted small mt-2">&copy; <?= date('Y') ?> DEMO API Wrapper. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end text-muted small align-self-center">
                Menggunakan PHP Native MVC & Bootstrap 5.
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 600, once: true });
</script>
</body>
</html>

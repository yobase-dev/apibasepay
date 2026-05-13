<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DEMO API Wrapper</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            color: #333547;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }
        .card-login {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }
        .brand-logo {
            background-color: #0d6efd;
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin: 0 auto 15px;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .info-box {
            background-color: #e7f1ff;
            border: 1px solid #b6d4fe;
            border-radius: 8px;
            padding: 12px;
            font-size: 13px;
            color: #084298;
        }
        .back-link {
            text-decoration: none;
            font-size: 13px;
            color: #6c757d;
            transition: color 0.2s;
        }
        .back-link:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="login-container" data-aos="fade-up">
    <div class="mb-3 text-start">
        <a href="<?= BASEURL ?>/home" class="back-link"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
    </div>
    
    <div class="card-login text-center">
        <div class="brand-logo">
            <i class="fa-solid fa-bolt"></i>
        </div>
        <h4 class="fw-bold mb-1 text-dark">DEMO<span class="text-primary">API</span></h4>
        <p class="text-muted small mb-4">Silakan masuk untuk mengelola gateway</p>

        <?php if (isset($_SESSION['flash_error'])): ?>
            <div class="alert alert-danger py-2 mb-3 text-start small" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['flash_success'])): ?>
            <div class="alert alert-success py-2 mb-3 text-start small" role="alert">
                <i class="fa-solid fa-circle-check me-1"></i> <?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASEURL ?>/home/login" method="POST" class="text-start mb-3">
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted mb-1">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autocomplete="off">
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold text-muted mb-1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Log In</button>
        </form>

        <div class="mb-4 small text-center">
            <span class="text-muted">Belum punya akun?</span> <a href="<?= BASEURL ?>/home/register" class="text-decoration-none fw-bold">Daftar Sekarang</a>
        </div>

        <div class="info-box text-start">
            <i class="fa-solid fa-circle-info me-1"></i> <strong>Akun Default:</strong><br>
            User: <code>admin</code>, Pass: <code>password123</code>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 400 });</script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Merchant - DEMO API Wrapper</title>
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
        <a href="<?= BASEURL ?>/home/login" class="back-link"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Login</a>
    </div>
    
    <div class="card-login text-center">
        <div class="brand-logo">
            <i class="fa-solid fa-user-plus"></i>
        </div>
        <h4 class="fw-bold mb-1 text-dark">Daftar Merchant</h4>
        <p class="text-muted small mb-4">Buat akun pengembang API baru Anda</p>

        <?php if (isset($_SESSION['flash_error'])): ?>
            <div class="alert alert-danger py-2 mb-3 text-start small" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASEURL ?>/home/register" method="POST" class="text-start mb-3">
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted mb-1">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Pilih username" minlength="3" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted mb-1">Email Resmi</label>
                <input type="email" name="email" class="form-control" placeholder="nama@email.com" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted mb-1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter" minlength="6" required>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold text-muted mb-1">Ulangi Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Ketik ulang password" required>
            </div>

            <!-- CAPTCHA BLOCK -->
            <div class="mb-4 p-2 bg-light rounded border">
                <label class="form-label small fw-bold text-muted mb-1">Verifikasi Keamanan (Captcha)</label>
                <div class="d-flex gap-2 align-items-center mb-2">
                    <img id="captchaImg" src="<?= BASEURL ?>/home/captcha" alt="Captcha Image" class="img-fluid" style="height: 45px;">
                    <button type="button" onclick="refreshCaptcha()" class="btn btn-sm btn-outline-secondary h-100" title="Refresh Captcha">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </button>
                </div>
                <input type="text" name="captcha" class="form-control" placeholder="Ketik kode di atas" required autocomplete="off" style="text-transform: uppercase;">
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Buat Akun Baru</button>
        </form>

        <div class="small text-center">
            <span class="text-muted">Sudah punya akun?</span> <a href="<?= BASEURL ?>/home/login" class="text-decoration-none fw-bold">Masuk Disini</a>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 400 });

    function refreshCaptcha() {
        const img = document.getElementById('captchaImg');
        // Use timestamp parameter to force server request and prevent browser caching
        img.src = "<?= BASEURL ?>/home/captcha?t=" + new Date().getTime();
    }
</script>
</body>
</html>

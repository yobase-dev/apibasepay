<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'DEMO API Wrapper' ?></title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Animate on Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Core Custom CSS for Light Simple Design -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            color: #333547;
            min-height: 100vh;
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        /* Maintain the class name 'glass-card' for compatibility but style as clean white card */
        .glass-card {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: box-shadow 0.2s ease-in-out;
        }

        .glass-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            color: #495057;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            color: #0d6efd;
            background-color: #f8f9fa;
        }

        .btn-primary-glow {
            background-color: #0d6efd;
            border: none;
            color: white;
            font-weight: 500;
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            transition: background-color 0.2s;
        }

        .btn-primary-glow:hover {
            background-color: #0b5ed7;
            color: white;
        }

        .table-glass {
            color: #212529;
        }

        .table-glass th {
            background-color: #f8f9fa !important;
            color: #6c757d;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            font-weight: 700;
            padding: 1rem;
            border-bottom: 2px solid #dee2e6;
        }

        .table-glass td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #eff2f7;
        }

        .badge-status {
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.4em 0.8em;
            border-radius: 6px;
        }

        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .badge-success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .badge-expired {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .form-control-dark {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            color: #212529;
            border-radius: 8px;
            padding: 0.75rem 1rem;
        }

        .form-control-dark:focus {
            background-color: #ffffff;
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            color: #212529;
        }

        .api-key-display {
            background-color: #f8f9fa;
            font-family: monospace;
            padding: 10px;
            border-radius: 6px;
            border: 1px dashed #ced4da;
            color: #dc3545;
        }
    </style>
</head>
<body>

<?php if (isset($_SESSION['user_id'])): ?>
<nav class="navbar navbar-expand-lg sticky-top navbar-light">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= BASEURL ?>/dashboard">
            <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded-3 me-2" style="width: 36px; height: 36px;">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <span class="fw-bold tracking-tight fs-4 text-dark">DEMO<span class="text-primary">API</span></span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASEURL ?>/dashboard"><i class="fa-solid fa-chart-line me-1"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASEURL ?>/dashboard/projects"><i class="fa-solid fa-folder me-1"></i> Proyek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASEURL ?>/dashboard/settings"><i class="fa-solid fa-gear me-1"></i> API Config</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="nav-link text-danger" href="<?= BASEURL ?>/home/logout"><i class="fa-solid fa-right-from-bracket me-1"></i> Keluar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php endif; ?>

<div class="container py-4">

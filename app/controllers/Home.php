<?php

class Home extends Controller {

    public function index() {
        // Serve landing page
        $data = [
            'title' => 'DEMO API - Ultra Fast Payment Gateway Wrapper'
        ];
        $this->view('home/index', $data);
    }

    public function login() {
        // If already logged in, redirect to dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->model('User_model')->login($username, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                header('Location: ' . BASEURL . '/dashboard');
                exit;
            } else {
                $_SESSION['flash_error'] = 'Username atau Password salah!';
                header('Location: ' . BASEURL . '/home/login');
                exit;
            }
        }

        // Serve the login form (from login.php view)
        $this->view('home/login');
    }

    public function register() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $captcha_input = trim($_POST['captcha'] ?? '');

            $userModel = $this->model('User_model');

            // 1. Basic Validations
            if (strlen($username) < 3) {
                $_SESSION['flash_error'] = 'Username minimal 3 karakter!';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash_error'] = 'Format email tidak valid!';
            } elseif (strlen($password) < 6) {
                $_SESSION['flash_error'] = 'Password minimal 6 karakter!';
            } elseif ($password !== $confirm_password) {
                $_SESSION['flash_error'] = 'Konfirmasi password tidak cocok!';
            } 
            // 2. Captcha Validation
            elseif (empty($captcha_input) || strtolower($captcha_input) !== ($_SESSION['captcha_code'] ?? '')) {
                $_SESSION['flash_error'] = 'Kode Captcha salah!';
            } 
            // 3. Unique Checks
            elseif ($userModel->checkUsernameExists($username)) {
                $_SESSION['flash_error'] = 'Username sudah terdaftar!';
            } elseif ($userModel->checkEmailExists($email)) {
                $_SESSION['flash_error'] = 'Email sudah terdaftar!';
            } 
            // 4. Attempt Registration
            else {
                if ($userModel->registerUser($username, $email, $password)) {
                    // Clear captcha after success
                    unset($_SESSION['captcha_code']);
                    $_SESSION['flash_success'] = 'Pendaftaran berhasil! Silakan login.';
                    header('Location: ' . BASEURL . '/home/login');
                    exit;
                } else {
                    $_SESSION['flash_error'] = 'Terjadi kesalahan pendaftaran!';
                }
            }
            
            header('Location: ' . BASEURL . '/home/register');
            exit;
        }

        $this->view('home/register');
    }

    public function captcha() {
        // Ensure clean session state before writing code
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';
        for ($i = 0; $i < 5; $i++) {
            $code .= $chars[rand(0, strlen($chars) - 1)];
        }
        $_SESSION['captcha_code'] = strtolower($code);

        header('Content-type: image/svg+xml');
        header('Cache-Control: no-cache, must-revalidate');
        
        $width = 140;
        $height = 45;
        
        echo '<?xml version="1.0" encoding="UTF-8" standalone="no"?>';
        echo '<svg width="'.$width.'" height="'.$height.'" xmlns="http://www.w3.org/2000/svg" style="background:#f8f9fa; border-radius:8px; border:1px solid #dee2e6;">';
        
        // Background noise (lines)
        for ($i = 0; $i < 5; $i++) {
            echo '<line x1="'.rand(0, $width).'" y1="'.rand(0, $height).'" x2="'.rand(0, $width).'" y2="'.rand(0, $height).'" stroke="#ced4da" stroke-width="'.rand(1,2).'"/>';
        }
        
        // Render text characters
        $colors = ['#dc3545', '#0d6efd', '#198754', '#6f42c1', '#212529'];
        for ($i = 0; $i < strlen($code); $i++) {
            $x = 18 + ($i * 22);
            $y = 30 + rand(-3, 3);
            $rot = rand(-20, 20);
            $color = $colors[rand(0, count($colors)-1)];
            echo '<text x="'.$x.'" y="'.$y.'" font-family="Arial, sans-serif" font-size="22" font-weight="bold" fill="'.$color.'" transform="rotate('.$rot.' '.$x.' '.$y.')">'.$code[$i].'</text>';
        }
        
        // Foreground dots for extra noise
        for ($i = 0; $i < 30; $i++) {
            echo '<circle cx="'.rand(0, $width).'" cy="'.rand(0, $height).'" r="'.(rand(5, 15)/10).'" fill="#6c757d" opacity="0.3"/>';
        }

        echo '</svg>';
        exit;
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASEURL . '/home');
        exit;
    }
}

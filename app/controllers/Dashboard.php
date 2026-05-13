<?php

class Dashboard extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }

    public function index() {
        $userId = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        $trxModel = $this->model('Trx_model');
        $userModel = $this->model('User_model');

        $user = $userModel->getUserById($userId);

        if ($role === 'admin') {
            $transactions = $trxModel->getAllTransactions();
            $summary = $trxModel->getSummary();
        } else {
            $transactions = $trxModel->getMerchantTransactions($userId);
            $summary = $trxModel->getSummary($userId);
        }

        $data = [
            'title' => 'Dashboard - Demo API',
            'user' => $user,
            'transactions' => $transactions,
            'summary' => $summary
        ];

        $this->view('templates/header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer');
    }

    public function projects() {
        $userId = $_SESSION['user_id'];
        
        $projectModel = $this->model('Project_model');
        $userModel = $this->model('User_model');

        // POST Create Project
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $apiVersion = $_POST['api_version'] ?? 'v3';
            $webhookUrl = trim($_POST['webhook_url'] ?? '');

            if (empty($name)) {
                $_SESSION['flash_error'] = 'Nama proyek tidak boleh kosong!';
            } elseif (!in_array($apiVersion, ['v1', 'v2', 'v3'])) {
                $_SESSION['flash_error'] = 'Versi API tidak valid!';
            } else {
                if ($projectModel->createProject($userId, $name, $apiVersion, $webhookUrl)) {
                    $_SESSION['flash_success'] = 'Proyek berhasil dibuat!';
                } else {
                    $_SESSION['flash_error'] = 'Gagal membuat proyek!';
                }
            }
            header('Location: ' . BASEURL . '/dashboard/projects');
            exit;
        }

        $user = $userModel->getUserById($userId);
        $projects = $projectModel->getProjectsByUserId($userId);

        $data = [
            'title' => 'Kelola Proyek - Demo API',
            'user' => $user,
            'projects' => $projects
        ];

        $this->view('templates/header', $data);
        $this->view('dashboard/projects', $data);
        $this->view('templates/footer');
    }

    public function settings() {
        $userId = $_SESSION['user_id'];
        $userModel = $this->model('User_model');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $webhookUrl = $_POST['webhook_url'] ?? '';
            
            // Save implementation (simple query direct in model or here, let's use model)
            $db = new Database();
            $db->query('UPDATE users SET webhook_url = :webhook_url WHERE id = :id');
            $db->bind(':webhook_url', $webhookUrl);
            $db->bind(':id', $userId);
            $db->execute();

            $_SESSION['flash_success'] = 'Settings updated successfully!';
            header('Location: ' . BASEURL . '/dashboard/settings');
            exit;
        }

        $user = $userModel->getUserById($userId);
        
        $data = [
            'title' => 'Settings - Demo API',
            'user' => $user
        ];

        $this->view('templates/header', $data);
        $this->view('dashboard/settings', $data);
        $this->view('templates/footer');
    }
}

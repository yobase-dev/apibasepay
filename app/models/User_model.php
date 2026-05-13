<?php

class User_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getUserById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getUserByApiKey($api_key) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE api_key = :api_key');
        $this->db->bind(':api_key', $api_key);
        return $this->db->single();
    }

    public function addBalance($userId, $amount) {
        $this->db->query('UPDATE ' . $this->table . ' SET balance = balance + :amount WHERE id = :id');
        $this->db->bind(':amount', $amount);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    public function deductBalance($userId, $amount) {
        $this->db->query('UPDATE ' . $this->table . ' SET balance = balance - :amount WHERE id = :id AND balance >= :amount');
        $this->db->bind(':amount', $amount);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    public function getAllUsers() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = :username');
        $this->db->bind(':username', $username);
        $user = $this->db->single();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function checkUsernameExists($username) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = :username');
        $this->db->bind(':username', $username);
        return $this->db->single() ? true : false;
    }

    public function checkEmailExists($email) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email = :email');
        $this->db->bind(':email', $email);
        return $this->db->single() ? true : false;
    }

    public function registerUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $apiKey = 'DEMO_' . strtoupper(bin2hex(random_bytes(16)));

        $this->db->query('INSERT INTO ' . $this->table . ' (username, email, password, role, api_key, balance) VALUES (:username, :email, :password, "merchant", :api_key, 0.00)');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':api_key', $apiKey);
        
        return $this->db->execute();
    }
}

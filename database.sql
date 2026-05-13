-- DEMO API Database Schema
CREATE DATABASE IF NOT EXISTS demoapi_db;
USE demoapi_db;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'merchant') NOT NULL DEFAULT 'merchant',
    api_key VARCHAR(100) UNIQUE NOT NULL,
    webhook_url VARCHAR(255),
    balance DECIMAL(15, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ADD PROJECTS TABLE
CREATE TABLE IF NOT EXISTS projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    api_version ENUM('v1', 'v2', 'v3') NOT NULL DEFAULT 'v3',
    project_key VARCHAR(100) UNIQUE NOT NULL,
    webhook_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS transactions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    project_id INT NULL, -- Reference to project, nullable for legacy
    ref_id_merchant VARCHAR(100) NOT NULL,
    trx_id_yobase VARCHAR(100) NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    fee_admin DECIMAL(15, 2) DEFAULT 0.00,
    net_amount DECIMAL(15, 2) NOT NULL,
    status ENUM('PENDING', 'SUCCESS', 'EXPIRED') DEFAULT 'PENDING',
    qr_url TEXT,
    payment_url TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    paid_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE SET NULL,
    UNIQUE KEY (user_id, ref_id_merchant)
);

-- Seed basic users
INSERT IGNORE INTO users (username, email, password, role, api_key, balance) VALUES 
('admin', 'admin@example.com', '$2y$10$WlXvjX07w.7.XJkY3C/6G.xQnJ7QZ2e1jOqY9tNfX.n9C.d2q.v/y', 'admin', 'API_KEY_ADMIN_SAMPLE', 0.00),
('merchant1', 'merchant1@example.com', '$2y$10$WlXvjX07w.7.XJkY3C/6G.xQnJ7QZ2e1jOqY9tNfX.n9C.d2q.v/y', 'merchant', 'API_KEY_MERCHANT_SAMPLE', 0.00);

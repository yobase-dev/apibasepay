<?php

define('BASEURL', 'http://localhost/demoapi');

// DB Connection config
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'demoapi_db');

// YoBasePay API Configuration
define('YOBASE_API_KEY', 'your_yobase_api_key_here'); // Admin API key to interact with YoBasePay V3
define('YOBASE_SECRET_KEY', 'your_yobase_secret_here'); // For HMAC validation
define('YOBASE_API_URL', 'https://yobasepay.net/api_v3.php'); // Placeholder example

// Admin settings
define('ADMIN_FEE_PERCENTAGE', 1); // Example 1% fee
define('ADMIN_FEE_FLAT', 500); // Example RP 500 flat fee

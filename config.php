<?php
    
    ini_set('display_errors', 1);
error_reporting(E_ALL);


// Security Headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

// Session Management
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    session_start();
}

// Database Credentials
define('DB_HOST', 'input host');
define('DB_USER', 'input pusher name ');
define('DB_PASS', 'input pass');
define('DB_NAME', 'input name');

// External API Keys (Replace with your actual keys)
define('WEATHER_API_KEY', 'input api'); 
define('NEWS_API_KEY', 'input api');

// PDO Connection
function getDBConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        // Return null or handle error without revealing credentials
        error_log("DB Connection Error: " . $e->getMessage());
        return null;
    }
}
?>
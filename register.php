<?php
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

// Input Sanitization
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$email    = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';

if (!$username || !$email || strlen($password) < 8) {
    echo json_encode(['status' => 'error', 'message' => 'Please provide a valid username, email, and a password of at least 8 characters.']);
    exit;
}

$pdo = getDBConnection();
if (!$pdo) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed. Please check backend config.']);
    exit;
}

try {
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email OR username = :username LIMIT 1");
    $stmt->execute([':email' => $email, ':username' => $username]);
    if ($stmt->fetch()) {
        echo json_encode(['status' => 'error', 'message' => 'Username or Email is already registered.']);
        exit;
    }

    // Secure Password Hashing
    $passwordHash = password_hash($password, PASSWORD_ARGON2ID);

    // Insert user
    $insertStmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, created_at) VALUES (:username, :email, :hash, NOW())");
    $insertStmt->execute([
        ':username' => $username,
        ':email'    => $email,
        ':hash'     => $passwordHash
    ]);

    echo json_encode(['status' => 'success', 'message' => 'Registration successful! You can now log in.']);
} catch (PDOException $e) {
    error_log("Registration Error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'An error occurred while saving your data.']);
}
?>
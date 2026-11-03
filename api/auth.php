<?php
/**
 * API Autentikasi — Register & Login
 * All-in-One Sport Chatbot
 */

header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');

// Muat config & database
$config = require dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';
// Hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
    exit;
}

// Start session untuk menyimpan user login
session_start();

$input  = json_decode(file_get_contents('php://input'), true);
$action = trim($input['action'] ?? '');

// ==================== REGISTER ====================
if ($action === 'register') {
    $username = trim($input['username'] ?? '');
    $email    = trim($input['email'] ?? '');
    $password = $input['password'] ?? '';

    // Validasi input
    if (empty($username) || empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi.']);
        exit;
    }
    if (strlen($username) < 3 || strlen($username) > 50) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Username harus 3–50 karakter.']);
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Format email tidak valid.']);
        exit;
    }
    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Password minimal 6 karakter.']);
        exit;
    }

    $db = getDB();

    // Cek username/email sudah ada
    $stmt = $db->prepare('SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1');
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
        http_response_code(409);
        echo json_encode(['status' => 'error', 'message' => 'Username atau email sudah digunakan.']);
        exit;
    }

    // Simpan user baru
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $db->prepare('INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)');
    $stmt->execute([$username, $email, $hash]);
    $userId = (int) $db->lastInsertId();

    // Langsung login setelah register
    $_SESSION['user_id']   = $userId;
    $_SESSION['username']  = $username;
    $_SESSION['email']     = $email;

    echo json_encode([
        'status'   => 'success',
        'message'  => 'Registrasi berhasil! Selamat datang, ' . $username . '.',
        'user'     => ['id' => $userId, 'username' => $username, 'email' => $email]
    ]);
    exit;
}

// ==================== LOGIN ====================
if ($action === 'login') {
    $identifier = trim($input['identifier'] ?? ''); // username atau email
    $password   = $input['password'] ?? '';

    if (empty($identifier) || empty($password)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Username/email dan password wajib diisi.']);
        exit;
    }

    $db   = getDB();
    $stmt = $db->prepare('SELECT id, username, email, password_hash FROM users WHERE username = ? OR email = ? LIMIT 1');
    $stmt->execute([$identifier, $identifier]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Username/email atau password salah.']);
        exit;
    }

    // Update last_login
    $db->prepare('UPDATE users SET last_login = NOW() WHERE id = ?')->execute([$user['id']]);

    // Set session
    $_SESSION['user_id']  = (int) $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email']    = $user['email'];

    echo json_encode([
        'status'  => 'success',
        'message' => 'Login berhasil! Selamat datang kembali, ' . $user['username'] . '.',
        'user'    => ['id' => $user['id'], 'username' => $user['username'], 'email' => $user['email']]
    ]);
    exit;
}

// ==================== LOGOUT ====================
if ($action === 'logout') {
    session_start();
    session_destroy();
    echo json_encode(['status' => 'success', 'message' => 'Logout berhasil.']);
    exit;
}

// ==================== CEK STATUS LOGIN ====================
if ($action === 'check') {
    if (!empty($_SESSION['user_id'])) {
        echo json_encode([
            'status'        => 'success',
            'authenticated' => true,
            'user'          => [
                'id'       => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'email'    => $_SESSION['email']
            ]
        ]);
    } else {
        echo json_encode(['status' => 'success', 'authenticated' => false]);
    }
    exit;
}

http_response_code(400);
echo json_encode(['status' => 'error', 'message' => 'Action tidak dikenal.']);

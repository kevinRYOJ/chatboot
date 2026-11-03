<?php
/**
 * API Sessions — Kelola Sesi Chat (Buat, List, Hapus)
 * All-in-One Sport Chatbot
 */

header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');

session_start();

$config = require dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';

// Guard: hanya user yang sudah login
if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu.']);
    exit;
}

$userId = (int) $_SESSION['user_id'];
$method = $_SERVER['REQUEST_METHOD'];
$input  = json_decode(file_get_contents('php://input'), true) ?? [];
$db     = getDB();

// ==================== GET: Daftar semua sesi user ====================
if ($method === 'GET') {
    $action = $_GET['action'] ?? 'list';

    // Ambil daftar sesi (sidebar history)
    if ($action === 'list') {
        $stmt = $db->prepare('
            SELECT s.id, s.mode, s.title, s.created_at, s.updated_at,
                   COUNT(m.id) AS message_count
            FROM chat_sessions s
            LEFT JOIN chat_messages m ON m.session_id = s.id
            WHERE s.user_id = ?
            GROUP BY s.id
            ORDER BY s.updated_at DESC
            LIMIT 50
        ');
        $stmt->execute([$userId]);
        $sessions = $stmt->fetchAll();

        echo json_encode(['status' => 'success', 'sessions' => $sessions]);
        exit;
    }

    // Ambil pesan dalam satu sesi
    if ($action === 'messages') {
        $sessionId = (int) ($_GET['session_id'] ?? 0);
        if (!$sessionId) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'session_id diperlukan.']);
            exit;
        }

        // Verifikasi kepemilikan sesi
        $stmt = $db->prepare('SELECT id, mode, title FROM chat_sessions WHERE id = ? AND user_id = ?');
        $stmt->execute([$sessionId, $userId]);
        $session = $stmt->fetch();

        if (!$session) {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Sesi tidak ditemukan.']);
            exit;
        }

        // Ambil semua pesan dalam sesi
        $stmt = $db->prepare('
            SELECT id, role, content, model_used, prompt_tokens, completion_tokens, total_tokens, created_at
            FROM chat_messages
            WHERE session_id = ?
            ORDER BY created_at ASC
        ');
        $stmt->execute([$sessionId]);
        $messages = $stmt->fetchAll();

        echo json_encode([
            'status'   => 'success',
            'session'  => $session,
            'messages' => $messages
        ]);
        exit;
    }
}

// ==================== POST: Buat sesi baru ====================
if ($method === 'POST') {
    $action = $input['action'] ?? '';

    if ($action === 'create') {
        $mode = in_array($input['mode'] ?? '', ['workout', 'nutrisi', 'info']) ? $input['mode'] : 'workout';

        $stmt = $db->prepare('INSERT INTO chat_sessions (user_id, mode) VALUES (?, ?)');
        $stmt->execute([$userId, $mode]);
        $sessionId = (int) $db->lastInsertId();

        echo json_encode([
            'status'     => 'success',
            'session_id' => $sessionId
        ]);
        exit;
    }

    // Update judul sesi (diambil dari pesan pertama)
    if ($action === 'update_title') {
        $sessionId = (int) ($input['session_id'] ?? 0);
        $title     = mb_substr(trim($input['title'] ?? ''), 0, 255);

        if (!$sessionId || empty($title)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'session_id dan title diperlukan.']);
            exit;
        }

        $stmt = $db->prepare('UPDATE chat_sessions SET title = ? WHERE id = ? AND user_id = ?');
        $stmt->execute([$title, $sessionId, $userId]);

        echo json_encode(['status' => 'success']);
        exit;
    }
}

// ==================== DELETE: Hapus satu sesi ====================
if ($method === 'DELETE') {
    $sessionId = (int) ($input['session_id'] ?? 0);
    if (!$sessionId) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'session_id diperlukan.']);
        exit;
    }

    // Verifikasi kepemilikan sebelum hapus
    $stmt = $db->prepare('DELETE FROM chat_sessions WHERE id = ? AND user_id = ?');
    $stmt->execute([$sessionId, $userId]);

    if ($stmt->rowCount() === 0) {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Sesi tidak ditemukan atau bukan milik Anda.']);
        exit;
    }

    echo json_encode(['status' => 'success', 'message' => 'Sesi berhasil dihapus.']);
    exit;
}

http_response_code(400);
echo json_encode(['status' => 'error', 'message' => 'Request tidak valid.']);

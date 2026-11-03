<?php
/**
 * API Chat Endpoint
 * Menerima request chat dari frontend dan meneruskannya ke Google Gemini API
 * + Menyimpan riwayat ke database MySQL
 */

header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');

session_start();

// Hanya izinkan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Hanya metode POST yang diizinkan.'
    ]);
    exit;
}

// Muat file konfigurasi, database & system prompt
$config = require dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/config/prompts.php';

// Guard: hanya user yang sudah login
if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Silakan login terlebih dahulu untuk memulai chat.'
    ]);
    exit;
}

$userId = (int) $_SESSION['user_id'];

// Cek apakah API Key Gemini sudah diisi
$apiKey = trim($config['gemini_api_key'] ?? '');
if (empty($apiKey) || strpos($apiKey, 'your_') !== false || $apiKey === 'AIza_your_gemini_api_key_here') {
    http_response_code(400);
    echo json_encode([
        'status'  => 'error',
        'message' => 'GEMINI_API_KEY belum dikonfigurasi di file .env! Silakan buka file .env dan masukkan API Key dari Google AI Studio (https://aistudio.google.com)'
    ]);
    exit;
}

// Baca body JSON yang dikirim frontend
$inputRaw  = file_get_contents('php://input');
$inputData = json_decode($inputRaw, true);

if (!is_array($inputData)) {
    http_response_code(400);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Format payload harus berupa JSON valid.'
    ]);
    exit;
}

$userMessage = trim($inputData['message'] ?? '');
$mode        = trim($inputData['mode'] ?? 'workout');
$sessionId   = isset($inputData['session_id']) ? (int) $inputData['session_id'] : null;
$history     = is_array($inputData['history'] ?? null) ? $inputData['history'] : [];

if (empty($userMessage)) {
    http_response_code(400);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Pesan tidak boleh kosong.'
    ]);
    exit;
}

$db = getDB();

// ---- Tangani session_id ----
// Jika belum ada session, buat sesi baru
if (!$sessionId) {
    $stmt = $db->prepare('INSERT INTO chat_sessions (user_id, mode) VALUES (?, ?)');
    $validMode = in_array($mode, ['workout', 'nutrisi', 'info']) ? $mode : 'workout';
    $stmt->execute([$userId, $validMode]);
    $sessionId = (int) $db->lastInsertId();
} else {
    // Verifikasi sesi milik user yang login
    $stmt = $db->prepare('SELECT id FROM chat_sessions WHERE id = ? AND user_id = ?');
    $stmt->execute([$sessionId, $userId]);
    if (!$stmt->fetch()) {
        http_response_code(403);
        echo json_encode([
            'status'  => 'error',
            'message' => 'Sesi tidak valid.'
        ]);
        exit;
    }
}

// ---- Simpan pesan user ke DB ----
$stmt = $db->prepare('INSERT INTO chat_messages (session_id, role, content) VALUES (?, \'user\', ?)');
$stmt->execute([$sessionId, $userMessage]);

// ---- Update judul sesi dari pesan pertama user ----
$stmt = $db->prepare('SELECT title FROM chat_sessions WHERE id = ?');
$stmt->execute([$sessionId]);
$sess = $stmt->fetch();
if (empty($sess['title'])) {
    $autoTitle = mb_substr($userMessage, 0, 100);
    $db->prepare('UPDATE chat_sessions SET title = ? WHERE id = ?')->execute([$autoTitle, $sessionId]);
}

// Ambil system prompt berdasarkan mode yang dipilih
$systemPrompt = getSystemPrompt($mode);

// Bangun struktur contents untuk Gemini API
$contents = [];

// Masukkan riwayat percakapan sebelumnya (max 10 giliran terakhir)
$recentHistory = array_slice($history, -10);
foreach ($recentHistory as $chatItem) {
    if (isset($chatItem['role']) && isset($chatItem['content'])) {
        $role       = ($chatItem['role'] === 'user') ? 'user' : 'model';
        $contents[] = [
            'role'  => $role,
            'parts' => [
                ['text' => (string) $chatItem['content']]
            ]
        ];
    }
}

// Tambahkan pesan user saat ini
$contents[] = [
    'role'  => 'user',
    'parts' => [
        ['text' => $userMessage]
    ]
];

// Siapkan payload Gemini API
$payload = [
    'system_instruction' => [
        'parts' => [
            ['text' => $systemPrompt]
        ]
    ],
    'contents'        => $contents,
    'generationConfig' => [
        'temperature'     => (float) $config['temperature'],
        'maxOutputTokens' => (int) $config['max_tokens']
    ]
];

// Fungsi cURL ke Gemini API
function callGeminiApi($model, $apiKey, $payload) {
    $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . urlencode($apiKey);

    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 35,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json'
        ],
        CURLOPT_POSTFIELDS     => json_encode($payload)
    ]);

    $responseBody = curl_exec($ch);
    $httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError    = curl_error($ch);
    curl_close($ch);

    return [$responseBody, $httpCode, $curlError];
}

// Ambil daftar kandidat model yang akan dicoba berurutan
$modelsToTry = !empty($config['gemini_models'])
    ? $config['gemini_models']
    : ['gemini-1.5-flash', 'gemini-1.5-flash-8b', 'gemini-2.0-flash', 'gemini-1.5-pro'];

$successfulResponse = null;
$successfulModel    = null;
$lastErrorMsg       = 'Tidak ada model yang berhasil dihubungi.';
$attemptedModels    = [];

// Loop mencoba setiap model jika model sebelumnya kehabisan kuota atau error
foreach ($modelsToTry as $candidateModel) {
    $candidateModel    = trim($candidateModel);
    if (empty($candidateModel)) continue;
    $attemptedModels[] = $candidateModel;

    list($responseBody, $httpCode, $curlError) = callGeminiApi($candidateModel, $apiKey, $payload);

    if ($responseBody === false) {
        $lastErrorMsg = "cURL error pada {$candidateModel}: " . $curlError;
        continue;
    }

    $decodedResponse = json_decode($responseBody, true);

    // Jika model berhasil mengembalikan teks jawaban
    if ($httpCode === 200 && !isset($decodedResponse['error']) && !empty($decodedResponse['candidates'][0]['content']['parts'][0]['text'])) {
        $successfulResponse = $decodedResponse;
        $successfulModel    = $candidateModel;
        break; // Berhasil! Keluar dari loop fallback
    }

    // Catat pesan error (kuota habis/429/404) dan otomatis coba model berikutnya
    $lastErrorMsg = $decodedResponse['error']['message'] ?? "HTTP {$httpCode} pada model {$candidateModel}";
}

// Jika seluruh model dalam daftar gagal
if (!$successfulResponse) {
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'message' => "Seluruh model (" . implode(', ', $attemptedModels) . ") tidak dapat diakses atau kuota habis. Error terakhir: " . $lastErrorMsg
    ]);
    exit;
}

// Ambil teks jawaban dari model yang berhasil
$replyContent = $successfulResponse['candidates'][0]['content']['parts'][0]['text'] ?? '';
$usageMeta    = $successfulResponse['usageMetadata'] ?? [];

$promptTokens     = (int) ($usageMeta['promptTokenCount']     ?? 0);
$completionTokens = (int) ($usageMeta['candidatesTokenCount'] ?? 0);
$totalTokens      = (int) ($usageMeta['totalTokenCount']      ?? 0);

// ---- Simpan balasan AI ke database ----
$stmt = $db->prepare('
    INSERT INTO chat_messages
        (session_id, role, content, model_used, prompt_tokens, completion_tokens, total_tokens)
    VALUES (?, \'assistant\', ?, ?, ?, ?, ?)
');
$stmt->execute([$sessionId, $replyContent, $successfulModel, $promptTokens, $completionTokens, $totalTokens]);

// Update updated_at sesi
$db->prepare('UPDATE chat_sessions SET updated_at = NOW() WHERE id = ?')->execute([$sessionId]);

echo json_encode([
    'status'     => 'success',
    'reply'      => $replyContent,
    'usage'      => [
        'prompt_tokens'     => $promptTokens,
        'completion_tokens' => $completionTokens,
        'total_tokens'      => $totalTokens
    ],
    'mode'       => $mode,
    'model'      => $successfulModel,
    'session_id' => $sessionId
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

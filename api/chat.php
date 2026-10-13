<?php
/**
 * API Chat Endpoint
 * Menerima request chat dari frontend dan meneruskannya ke Groq Cloud API
 */

header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');

// Hanya izinkan metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Hanya metode POST yang diizinkan.'
    ]);
    exit;
}

// Muat file konfigurasi & system prompt
$config = require dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/config/prompts.php';

// Cek apakah API Key sudah diisi
$apiKey = trim($config['groq_api_key'] ?? '');
if (empty($apiKey) || $apiKey === 'gsk_your_groq_api_key_here') {
    http_response_code(400);
    echo json_encode([
        'status'  => 'error',
        'message' => 'GROQ_API_KEY belum dikonfigurasi di file .env! Silakan buka file .env dan masukkan API Key dari https://console.groq.com/keys'
    ]);
    exit;
}

// Baca body JSON yang dikirim frontend
$inputRaw = file_get_contents('php://input');
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
$history     = is_array($inputData['history'] ?? null) ? $inputData['history'] : [];

if (empty($userMessage)) {
    http_response_code(400);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Pesan tidak boleh kosong.'
    ]);
    exit;
}

// Siapkan system prompt berdasarkan mode yang dipilih
$systemPrompt = getSystemPrompt($mode);

// Bangun struktur percakapan (OpenAI/Groq compatible)
$messages = [
    [
        'role'    => 'system',
        'content' => $systemPrompt
    ]
];

// Masukkan riwayat percakapan sebelumnya jika ada (maksimal 10 pesan terakhir untuk efisiensi token)
$recentHistory = array_slice($history, -10);
foreach ($recentHistory as $chatItem) {
    if (isset($chatItem['role']) && isset($chatItem['content'])) {
        $role = ($chatItem['role'] === 'user') ? 'user' : 'assistant';
        $messages[] = [
            'role'    => $role,
            'content' => (string) $chatItem['content']
        ];
    }
}

// Tambahkan pesan user saat ini
$messages[] = [
    'role'    => 'user',
    'content' => $userMessage
];

// Siapkan payload request ke Groq API
$payload = [
    'model'       => $config['groq_model'],
    'messages'    => $messages,
    'temperature' => (float) $config['temperature'],
    'max_tokens'  => (int) $config['max_tokens']
];

// Kirim request menggunakan cURL
$ch = curl_init($config['groq_api_url']);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ],
    CURLOPT_POSTFIELDS     => json_encode($payload)
]);

$responseBody = curl_exec($ch);
$httpCode     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError    = curl_error($ch);
curl_close($ch);

// Tangani kemungkinan error cURL
if ($responseBody === false) {
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Gagal menghubungi Groq API: ' . $curlError
    ]);
    exit;
}

$decodedResponse = json_decode($responseBody, true);

// Tangani error respons dari server Groq
if ($httpCode !== 200 || isset($decodedResponse['error'])) {
    $errorMsg = $decodedResponse['error']['message'] ?? 'Terjadi kesalahan pada Groq API (Kode HTTP: ' . $httpCode . ')';
    http_response_code($httpCode >= 400 && $httpCode < 600 ? $httpCode : 500);
    echo json_encode([
        'status'  => 'error',
        'message' => $errorMsg,
        'details' => $decodedResponse['error'] ?? null
    ]);
    exit;
}

// Ambil teks balasan AI & data penggunaan token
$replyContent = $decodedResponse['choices'][0]['message']['content'] ?? '';
$usageData    = $decodedResponse['usage'] ?? [
    'prompt_tokens'     => 0,
    'completion_tokens' => 0,
    'total_tokens'      => 0
];

echo json_encode([
    'status'  => 'success',
    'reply'   => $replyContent,
    'usage'   => [
        'prompt_tokens'     => $usageData['prompt_tokens'] ?? 0,
        'completion_tokens' => $usageData['completion_tokens'] ?? 0,
        'total_tokens'      => $usageData['total_tokens'] ?? 0
    ],
    'mode'    => $mode,
    'model'   => $config['groq_model']
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

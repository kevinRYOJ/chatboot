<?php
/**
 * API Chat Endpoint
 * Menerima request chat dari frontend dan meneruskannya ke Google Gemini API
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

// Ambil system prompt berdasarkan mode yang dipilih
$systemPrompt = getSystemPrompt($mode);

// Bangun struktur contents untuk Gemini API
$contents = [];

// Masukkan riwayat percakapan sebelumnya (role: 'user' atau 'model')
$recentHistory = array_slice($history, -10);
foreach ($recentHistory as $chatItem) {
    if (isset($chatItem['role']) && isset($chatItem['content'])) {
        $role = ($chatItem['role'] === 'user') ? 'user' : 'model';
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
    'contents' => $contents,
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
$modelsToTry = !empty($config['gemini_models']) ? $config['gemini_models'] : ['gemini-1.5-flash', 'gemini-1.5-flash-8b', 'gemini-2.0-flash', 'gemini-1.5-pro'];

$successfulResponse = null;
$successfulModel = null;
$lastErrorMsg = 'Tidak ada model yang berhasil dihubungi.';
$attemptedModels = [];

// Loop mencoba setiap model jika model sebelumnya kehabisan kuota atau error
foreach ($modelsToTry as $candidateModel) {
    $candidateModel = trim($candidateModel);
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

echo json_encode([
    'status'  => 'success',
    'reply'   => $replyContent,
    'usage'   => [
        'prompt_tokens'     => $usageMeta['promptTokenCount'] ?? 0,
        'completion_tokens' => $usageMeta['candidatesTokenCount'] ?? 0,
        'total_tokens'      => $usageMeta['totalTokenCount'] ?? 0
    ],
    'mode'    => $mode,
    'model'   => $successfulModel
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

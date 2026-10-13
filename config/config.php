<?php
/**
 * Konfigurasi Aplikasi & Loader File .env
 * All-in-One Sport Chatbot
 */

// Fungsi untuk membaca file .env secara native tanpa dependency composer
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        return;
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        // Lewati komentar
        if (strpos($line, '#') === 0 || empty($line)) {
            continue;
        }

        // Pisahkan key dan value
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Bersihkan kutip jika ada
            $value = trim($value, '"\'');

            // Simpan ke environment jika belum ada
            if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
                putenv("$key=$value");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }
}

// Muat file .env dari root folder proyek
$envPath = dirname(__DIR__) . '/.env';
loadEnv($envPath);

// Helper function untuk mengambil nilai env dengan nilai default
function env($key, $default = null) {
    $val = getenv($key);
    if ($val === false) {
        $val = $_ENV[$key] ?? $_SERVER[$key] ?? $default;
    }
    return $val;
}

// Array konfigurasi utama
return [
    'app_name'     => env('APP_NAME', 'All-in-One Sport Chatbot'),
    'app_env'      => env('APP_ENV', 'development'),
    'groq_api_key' => env('GROQ_API_KEY', ''),
    'groq_model'   => env('GROQ_MODEL', 'llama-3.3-70b-versatile'),
    'groq_api_url' => 'https://api.groq.com/openai/v1/chat/completions',
    'max_tokens'   => 1500,
    'temperature'  => 0.7,
];

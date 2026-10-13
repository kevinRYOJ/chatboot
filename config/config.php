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

// Parse daftar model Gemini (fallback berurutan)
$modelsRaw = env('GEMINI_MODELS', env('GEMINI_MODEL', 'gemini-1.5-flash, gemini-1.5-flash-8b, gemini-2.0-flash, gemini-1.5-pro'));
$modelsList = array_values(array_filter(array_map('trim', explode(',', $modelsRaw))));

// Parse API Keys jika user memasukkan lebih dari satu key (dipisah koma)
$apiKeysRaw = env('GEMINI_API_KEYS', env('GEMINI_API_KEY', ''));
$apiKeysList = array_values(array_filter(array_map('trim', explode(',', $apiKeysRaw))));

// Array konfigurasi utama
return [
    'app_name'       => env('APP_NAME', 'All-in-One Sport Chatbot'),
    'app_env'        => env('APP_ENV', 'development'),
    'gemini_api_key' => $apiKeysList[0] ?? '',
    'gemini_api_keys'=> $apiKeysList,
    'gemini_model'   => $modelsList[0] ?? 'gemini-1.5-flash',
    'gemini_models'  => $modelsList,
    'max_tokens'     => 1500,
    'temperature'    => 0.7,
];

<?php
/**
 * Halaman Utama — All-in-One Sport Chatbot
 * Stack: Native PHP, HTML5, CSS3, Vanilla JS
 */

$config = require __DIR__ . '/config/config.php';
$appName = htmlspecialchars($config['app_name']);
$modelName = htmlspecialchars($config['groq_model']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $appName; ?> — AI Workout, Nutrisi & Olahraga</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏋️</text></svg>">
</head>
<body>

<div class="app-container">
    <!-- Overlay Mobile saat Sidebar terbuka -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ================= Sidebar ================= -->
    <aside class="sidebar" id="sidebar">
        <div class="brand-section">
            <div class="brand-icon">🏋️</div>
            <div class="brand-text">
                <h1>SportAI Bot</h1>
                <span>Fitness & Nutrition</span>
            </div>
        </div>

        <div class="mode-section">
            <div class="section-label">Pilih Mode Chatbot</div>
            <div class="mode-list">
                <!-- Mode 1: Workout -->
                <div class="mode-card active" data-mode="workout">
                    <div class="mode-emoji">💪</div>
                    <div class="mode-info">
                        <h3>Workout & Latihan</h3>
                        <p>Program gym, kalistenik, form aman, & jadwal mingguan</p>
                    </div>
                </div>

                <!-- Mode 2: Nutrisi -->
                <div class="mode-card" data-mode="nutrisi">
                    <div class="mode-emoji">🍎</div>
                    <div class="mode-info">
                        <h3>Nutrisi & Diet</h3>
                        <p>Hitung BMR/TDEE, protein harian & meal plan lokal</p>
                    </div>
                </div>

                <!-- Mode 3: Info Olahraga -->
                <div class="mode-card" data-mode="info">
                    <div class="mode-emoji">⚽</div>
                    <div class="mode-info">
                        <h3>Info Olahraga</h3>
                        <p>Analisis taktik, aturan resmi, & wawasan mental juara</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-footer">
            <button type="button" class="btn-clear" id="btnClearChat">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/>
                </svg>
                Reset Percakapan
            </button>

            <div class="system-badge">
                <span><span class="status-dot"></span>Gemini AI Online</span>
                <strong>Flash 1.5</strong>
            </div>
        </div>
    </aside>

    <!-- ================= Main Chat Area ================= -->
    <main class="main-chat">
        <!-- Top Bar Header -->
        <header class="chat-header">
            <div class="header-left">
                <button type="button" class="btn-menu-toggle" id="btnMenuToggle" aria-label="Toggle menu">☰</button>
                <div class="current-mode-tag">
                    <span class="tag-badge" id="currentModeTag">💪 Workout & Latihan</span>
                </div>
            </div>
            <div class="header-right">
                <div class="model-tag">
                    <span>Engine:</span>
                    <strong><?= $modelName; ?></strong>
                </div>
            </div>
        </header>

        <!-- Message Feed Stream -->
        <div class="chat-messages" id="chatMessages">
            <!-- Pesan akan di-render secara dinamis oleh assets/js/app.js -->
        </div>

        <!-- Chat Input Form -->
        <div class="chat-input-area">
            <form id="chatForm" class="input-container">
                <textarea 
                    id="messageInput" 
                    class="chat-textarea" 
                    placeholder="Tanyakan program latihan, variasi gerakan, atau jadwal gym..." 
                    rows="1"
                    required
                ></textarea>
                <button type="submit" id="btnSend" class="btn-send" disabled aria-label="Kirim Pesan">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </form>
            <div class="input-hint">
                Tekan <strong>Enter</strong> untuk kirim • <strong>Shift + Enter</strong> untuk baris baru
            </div>
        </div>
    </main>
</div>

<!-- Toast Notifikasi Error -->
<div class="toast-error" id="toastError"></div>

<!-- Skrip Frontend -->
<script src="assets/js/app.js"></script>
</body>
</html>

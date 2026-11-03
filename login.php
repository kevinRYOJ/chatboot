<?php
/**
 * Halaman Login & Register — All-in-One Sport Chatbot
 */
$config  = require __DIR__ . '/config/config.php';
$appName = htmlspecialchars($config['app_name']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $appName ?> — Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/auth.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏆</text></svg>">
</head>

<body class="auth-body">

    <div class="auth-wrapper">
        <!-- Logo / Brand -->
        <div class="auth-brand">
            <div class="brand-icon">🏆</div>
            <div>
                <h1>SportAI Bot</h1>
                <span>Fitness & Nutrition</span>
            </div>
        </div>

        <!-- Card Auth -->
        <div class="auth-card">

            <!-- Tab Switch -->
            <div class="auth-tabs">
                <button class="auth-tab active" id="tabLogin" onclick="switchTab('login')">Login</button>
                <button class="auth-tab" id="tabRegister" onclick="switchTab('register')">Daftar</button>
            </div>

            <!-- Alert Error/Success -->
            <div class="auth-alert" id="authAlert" style="display:none;"></div>

            <!-- ===== Form Login ===== -->
            <form id="formLogin" class="auth-form" onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label for="loginIdentifier">Username atau Email</label>
                    <input type="text" id="loginIdentifier" placeholder="Masukkan username atau email" required autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" placeholder="Masukkan password" required autocomplete="current-password">
                </div>
                <button type="submit" class="btn-auth" id="btnLogin">
                    <span id="btnLoginText">Masuk</span>
                    <span id="btnLoginSpinner" style="display:none;">⏳ Memproses...</span>
                </button>
            </form>

            <!-- ===== Form Register ===== -->
            <form id="formRegister" class="auth-form" style="display:none;" onsubmit="handleRegister(event)">
                <div class="form-group">
                    <label for="regUsername">Username</label>
                    <input type="text" id="regUsername" placeholder="Buat username (min. 3 karakter)" required minlength="3" maxlength="50" autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="regEmail">Email</label>
                    <input type="email" id="regEmail" placeholder="Masukkan email aktif" required autocomplete="email">
                </div>
                <div class="form-group">
                    <label for="regPassword">Password</label>
                    <input type="password" id="regPassword" placeholder="Buat password (min. 6 karakter)" required minlength="6" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label for="regPasswordConfirm">Konfirmasi Password</label>
                    <input type="password" id="regPasswordConfirm" placeholder="Ulangi password" required autocomplete="new-password">
                </div>
                <button type="submit" class="btn-auth" id="btnRegister">
                    <span id="btnRegisterText">Daftar Sekarang</span>
                    <span id="btnRegisterSpinner" style="display:none;">⏳ Mendaftar...</span>
                </button>
            </form>

        </div>

        <p class="auth-footer">
            All-in-One Sport Chatbot &copy; <?= date('Y') ?> &mdash; Powered by Google Gemini AI
        </p>
    </div>

    <script>
        function switchTab(tab) {
            const isLogin = tab === 'login';
            document.getElementById('formLogin').style.display    = isLogin ? 'flex' : 'none';
            document.getElementById('formRegister').style.display = isLogin ? 'none' : 'flex';
            document.getElementById('tabLogin').classList.toggle('active', isLogin);
            document.getElementById('tabRegister').classList.toggle('active', !isLogin);
            hideAlert();
        }

        function showAlert(message, type = 'error') {
            const el = document.getElementById('authAlert');
            el.textContent = message;
            el.className   = 'auth-alert ' + type;
            el.style.display = 'block';
        }

        function hideAlert() {
            document.getElementById('authAlert').style.display = 'none';
        }

        function setLoading(formType, loading) {
            const cap = formType.charAt(0).toUpperCase() + formType.slice(1);
            document.getElementById('btn' + cap + 'Text').style.display    = loading ? 'none' : 'inline';
            document.getElementById('btn' + cap + 'Spinner').style.display = loading ? 'inline' : 'none';
            document.getElementById('btn' + cap).disabled = loading;
        }

        async function handleLogin(e) {
            e.preventDefault();
            hideAlert();
            setLoading('login', true);

            const identifier = document.getElementById('loginIdentifier').value.trim();
            const password   = document.getElementById('loginPassword').value;

            try {
                const res  = await fetch('api/auth.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'login', identifier, password })
                });
                const data = await res.json();

                if (data.status === 'success') {
                    showAlert('✅ ' + data.message, 'success');
                    setTimeout(() => { window.location.href = 'index.php'; }, 800);
                } else {
                    showAlert('❌ ' + data.message);
                    setLoading('login', false);
                }
            } catch (err) {
                showAlert('❌ Terjadi kesalahan koneksi. Coba lagi.');
                setLoading('login', false);
            }
        }

        async function handleRegister(e) {
            e.preventDefault();
            hideAlert();

            const username        = document.getElementById('regUsername').value.trim();
            const email           = document.getElementById('regEmail').value.trim();
            const password        = document.getElementById('regPassword').value;
            const passwordConfirm = document.getElementById('regPasswordConfirm').value;

            if (password !== passwordConfirm) {
                showAlert('❌ Konfirmasi password tidak cocok.');
                return;
            }

            setLoading('register', true);

            try {
                const res  = await fetch('api/auth.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'register', username, email, password })
                });
                const data = await res.json();

                if (data.status === 'success') {
                    showAlert('✅ ' + data.message, 'success');
                    setTimeout(() => { window.location.href = 'index.php'; }, 800);
                } else {
                    showAlert('❌ ' + data.message);
                    setLoading('register', false);
                }
            } catch (err) {
                showAlert('❌ Terjadi kesalahan koneksi. Coba lagi.');
                setLoading('register', false);
            }
        }
    </script>

</body>
</html>

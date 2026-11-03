/**
 * All-in-One Sport Chatbot — Frontend Logic
 * Stack: Vanilla JavaScript (Fetch API, Lightweight Markdown Parser)
 * v2.0 — dengan sistem autentikasi & riwayat chat persisten
 */

document.addEventListener('DOMContentLoaded', () => {
    // ================================================================
    //  State Aplikasi
    // ================================================================
    let currentMode    = 'workout';
    let chatHistory    = [];          // Riwayat untuk konteks AI (in-memory)
    let isGenerating   = false;
    let currentSession = null;        // ID sesi aktif di database

    // Mode Metadata
    const modeConfig = {
        workout: {
            title: '💪 Workout & Latihan',
            tag: 'Personal Trainer Mode',
            placeholder: 'Tanyakan program latihan, variasi gerakan, atau jadwal gym...',
            welcomeTitle: 'Siap Latihan Hari Ini? 💪',
            welcomeDesc: 'Aku Personal Trainer AI siap membantu merancang program latihan, rekomendasi gerakan aman, hingga panduan kebugaran untukmu.',
            icon: '💪',
            suggestions: [
                'Buat jadwal latihan 3 hari untuk pemula di rumah',
                'Bagaimana form squat yang benar agar tidak cedera lutut?',
                'Rekomendasi variasi push-up untuk otot dada atas',
                'Berapa repetisi optimal untuk hypertrophy otot?'
            ]
        },
        nutrisi: {
            title: '🥗 Nutrisi & Diet',
            tag: 'Sport Nutritionist Mode',
            placeholder: 'Tanyakan perhitungan kalori, BMR/TDEE, atau meal plan atlet...',
            welcomeTitle: 'Optimalkan Nutrisi Olahragamu 🥗',
            welcomeDesc: 'Konsultasikan target kalori, kebutuhan protein harian, menu pre-workout, dan strategi diet sehat berbasis bahan lokal.',
            icon: '🥗',
            suggestions: [
                'Hitung BMR dan TDEE untuk pria 70kg, 170cm, olahraga 4x seminggu',
                'Menu pre-workout 45 menit sebelum lari pagi',
                'Sumber protein lokal murah selain dada ayam',
                'Berapa gram protein per kg berat badan untuk muscle gain?'
            ]
        },
        info: {
            title: '🏅 Info Olahraga',
            tag: 'Sports Analyst Mode',
            placeholder: 'Tanyakan aturan pertandingan, analisis taktik, atau fakta atlet...',
            welcomeTitle: 'Wawasan & Info Olahraga Dunia 🏅',
            welcomeDesc: 'Eksplorasi taktik sepak bola, aturan resmi bulu tangkis, basket, renang, dan dapatkan inspirasi mental bertanding.',
            icon: '🏅',
            suggestions: [
                'Jelaskan perbedaan formasi 4-3-3 dan 3-5-2 dalam sepak bola',
                'Teknik pukulan netting bulu tangkis untuk pemula',
                'Tips membangun mental juara sebelum pertandingan',
                'Aturan rotasi dan posisi dalam bola voli'
            ]
        }
    };

    // ================================================================
    //  Elemen DOM
    // ================================================================
    const messagesContainer = document.getElementById('chatMessages');
    const chatForm          = document.getElementById('chatForm');
    const messageInput      = document.getElementById('messageInput');
    const btnSend           = document.getElementById('btnSend');
    const btnClear          = document.getElementById('btnClearChat');
    const modeCards         = document.querySelectorAll('.mode-card');
    const currentModeTag    = document.getElementById('currentModeTag');
    const sidebar           = document.getElementById('sidebar');
    const btnMenuToggle     = document.getElementById('btnMenuToggle');
    const sidebarOverlay    = document.getElementById('sidebarOverlay');
    const toastError        = document.getElementById('toastError');
    const historyList       = document.getElementById('historyList');
    const btnNewChat        = document.getElementById('btnNewChat');
    const btnLogout         = document.getElementById('btnLogout');

    // ================================================================
    //  Auto Resize Textarea
    // ================================================================
    messageInput.addEventListener('input', () => {
        messageInput.style.height = 'auto';
        messageInput.style.height = Math.min(messageInput.scrollHeight, 140) + 'px';
        btnSend.disabled = messageInput.value.trim() === '' || isGenerating;
    });

    messageInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (!btnSend.disabled) chatForm.dispatchEvent(new Event('submit'));
        }
    });

    // ================================================================
    //  Navigasi Mode
    // ================================================================
    modeCards.forEach(card => {
        card.addEventListener('click', () => {
            const selectedMode = card.getAttribute('data-mode');
            if (selectedMode === currentMode) return;

            modeCards.forEach(c => c.classList.remove('active'));
            card.classList.add('active');
            currentMode = selectedMode;
            updateModeUI();
            closeMobileSidebar();
        });
    });

    function updateModeUI() {
        const config = modeConfig[currentMode];
        currentModeTag.textContent   = config.title;
        messageInput.placeholder     = config.placeholder;
        if (chatHistory.length === 0) renderWelcomeScreen();
    }

    // ================================================================
    //  Sidebar Mobile
    // ================================================================
    btnMenuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        sidebarOverlay.classList.toggle('active');
    });

    sidebarOverlay.addEventListener('click', closeMobileSidebar);

    function closeMobileSidebar() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('active');
    }

    // ================================================================
    //  Logout
    // ================================================================
    btnLogout.addEventListener('click', async () => {
        if (!confirm('Yakin ingin logout?')) return;
        try {
            await fetch('api/auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'logout' })
            });
        } finally {
            window.location.href = 'login.php';
        }
    });

    // ================================================================
    //  Reset / Chat Baru
    // ================================================================
    btnClear.addEventListener('click', () => {
        if (chatHistory.length === 0 && !currentSession) return;
        if (confirm('Reset percakapan saat ini? Riwayat yang sudah tersimpan tetap bisa diakses di sidebar.')) {
            startNewSession();
        }
    });

    btnNewChat.addEventListener('click', () => {
        startNewSession();
        closeMobileSidebar();
    });

    function startNewSession() {
        currentSession = null;
        chatHistory    = [];
        renderWelcomeScreen();

        // Hilangkan active pada history item
        document.querySelectorAll('.history-item').forEach(el => el.classList.remove('active'));
    }

    // ================================================================
    //  Riwayat Chat — Load & Render di Sidebar
    // ================================================================
    async function loadHistory() {
        try {
            const res  = await fetch('api/sessions.php?action=list');
            const data = await res.json();

            if (data.status !== 'success') {
                historyList.innerHTML = '<div class="history-empty">Gagal memuat riwayat.</div>';
                return;
            }

            renderHistoryList(data.sessions);
        } catch (e) {
            historyList.innerHTML = '<div class="history-empty">Gagal memuat riwayat.</div>';
        }
    }

    function renderHistoryList(sessions) {
        if (!sessions || sessions.length === 0) {
            historyList.innerHTML = '<div class="history-empty">Belum ada riwayat chat.<br>Mulai percakapan pertamamu! 💬</div>';
            return;
        }

        historyList.innerHTML = '';
        sessions.forEach(sess => {
            const item = document.createElement('div');
            item.className = 'history-item' + (sess.id == currentSession ? ' active' : '');
            item.dataset.sessionId = sess.id;
            item.dataset.mode      = sess.mode;

            const icon  = modeConfig[sess.mode]?.icon || '💬';
            const title = sess.title || 'Chat tanpa judul';
            const date  = formatRelativeTime(sess.updated_at);

            item.innerHTML = `
                <span class="history-item-icon">${icon}</span>
                <div class="history-item-text">
                    <div class="history-item-title">${escapeHTML(title)}</div>
                    <div class="history-item-meta">${date} · ${sess.message_count} pesan</div>
                </div>
                <button class="history-item-delete" data-session-id="${sess.id}" title="Hapus sesi">×</button>
            `;

            // Klik item — buka sesi
            item.addEventListener('click', (e) => {
                if (e.target.classList.contains('history-item-delete')) return;
                loadSession(sess.id, sess.mode);
                closeMobileSidebar();
            });

            // Tombol hapus
            item.querySelector('.history-item-delete').addEventListener('click', async (e) => {
                e.stopPropagation();
                if (!confirm('Hapus sesi chat ini?')) return;
                await deleteSession(sess.id);
                await loadHistory();
                if (currentSession == sess.id) startNewSession();
            });

            historyList.appendChild(item);
        });
    }

    // Buka sesi lama dari history
    async function loadSession(sessionId, mode) {
        try {
            const res  = await fetch(`api/sessions.php?action=messages&session_id=${sessionId}`);
            const data = await res.json();

            if (data.status !== 'success') {
                showToast('Gagal membuka sesi chat.');
                return;
            }

            // Set state
            currentSession = sessionId;
            currentMode    = data.session.mode || mode;
            chatHistory    = [];

            // Update mode UI
            modeCards.forEach(c => {
                c.classList.toggle('active', c.dataset.mode === currentMode);
            });
            updateModeUI();

            // Render semua pesan
            messagesContainer.innerHTML = '';
            data.messages.forEach(msg => {
                const usage = msg.role === 'assistant' ? {
                    prompt_tokens:     msg.prompt_tokens,
                    completion_tokens: msg.completion_tokens,
                    total_tokens:      msg.total_tokens
                } : null;

                appendMessage(msg.role === 'user' ? 'user' : 'assistant', msg.content, usage, msg.model_used);

                // Rebuild in-memory history untuk konteks AI
                chatHistory.push({ role: msg.role, content: msg.content });
            });

            // Mark active di sidebar
            document.querySelectorAll('.history-item').forEach(el => {
                el.classList.toggle('active', el.dataset.sessionId == sessionId);
            });

        } catch (e) {
            showToast('Gagal membuka sesi chat.');
        }
    }

    async function deleteSession(sessionId) {
        await fetch('api/sessions.php', {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ session_id: sessionId })
        });
    }

    // ================================================================
    //  Submit Chat
    // ================================================================
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const userMessage = messageInput.value.trim();
        if (!userMessage || isGenerating) return;

        isGenerating       = true;
        btnSend.disabled   = true;
        messageInput.value = '';
        messageInput.style.height = 'auto';

        // Hapus welcome screen jika masih tampil
        const welcomeCard = messagesContainer.querySelector('.welcome-card');
        if (welcomeCard) welcomeCard.remove();

        // Tampilkan pesan user
        appendMessage('user', userMessage);

        // Tambah ke history konteks AI
        chatHistory.push({ role: 'user', content: userMessage });

        // Tampilkan typing indicator
        const typingRow = showTypingIndicator();

        try {
            const res = await fetch('api/chat.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    message:    userMessage,
                    mode:       currentMode,
                    session_id: currentSession,
                    history:    chatHistory.slice(0, -1)  // exclude pesan user yg baru saja
                })
            });

            typingRow.remove();

            if (res.status === 401) {
                window.location.href = 'login.php';
                return;
            }

            const data = await res.json();

            if (data.status === 'success') {
                // Simpan session_id yang baru dibuat (jika belum ada)
                if (!currentSession && data.session_id) {
                    currentSession = data.session_id;
                }

                appendMessage('assistant', data.reply, data.usage, data.model);
                chatHistory.push({ role: 'assistant', content: data.reply });

                // Refresh history sidebar
                await loadHistory();

            } else {
                showToast('⚠️ ' + (data.message || 'Terjadi kesalahan.'));
                chatHistory.pop(); // batalkan user message dari history
            }

        } catch (err) {
            typingRow.remove();
            showToast('❌ Koneksi gagal. Periksa jaringan dan coba lagi.');
            chatHistory.pop();
        } finally {
            isGenerating       = false;
            btnSend.disabled   = messageInput.value.trim() === '';
        }
    });

    // ================================================================
    //  Render Welcome Screen
    // ================================================================
    function renderWelcomeScreen() {
        messagesContainer.innerHTML = '';
        const config = modeConfig[currentMode];

        const card = document.createElement('div');
        card.className = 'welcome-card';
        card.innerHTML = `
            <div class="welcome-icon">${config.icon}</div>
            <h2>${config.welcomeTitle}</h2>
            <p>${config.welcomeDesc}</p>
            <div class="suggestion-chips">
                ${config.suggestions.map(s => `<button class="chip" type="button">${escapeHTML(s)}</button>`).join('')}
            </div>
        `;

        card.querySelectorAll('.chip').forEach(chip => {
            chip.addEventListener('click', () => {
                messageInput.value = chip.textContent;
                messageInput.dispatchEvent(new Event('input'));
                chatForm.dispatchEvent(new Event('submit'));
            });
        });

        messagesContainer.appendChild(card);
    }

    // ================================================================
    //  Append Message ke UI
    // ================================================================
    function appendMessage(role, content, usage = null, modelUsed = null) {
        const row = document.createElement('div');
        row.className = `message-row ${role}`;

        const avatar = document.createElement('div');
        avatar.className = 'avatar';
        avatar.innerHTML = role === 'user' ? '👤' : '🤖';

        const bubbleWrap = document.createElement('div');
        bubbleWrap.className = 'bubble-wrap';

        const bubble = document.createElement('div');
        bubble.className = 'bubble';

        if (role === 'assistant') {
            bubble.innerHTML = formatMarkdown(content);
        } else {
            bubble.textContent = content;
        }

        bubbleWrap.appendChild(bubble);

        // Tampilkan token usage
        if (role === 'assistant' && usage && (usage.prompt_tokens || usage.completion_tokens)) {
            const tokenMeta = document.createElement('div');
            tokenMeta.className = 'token-meta';
            tokenMeta.innerHTML = `
                ${modelUsed ? `<span>🤖 <strong>${escapeHTML(modelUsed)}</strong></span>` : ''}
                <span>📥 In: <strong>${usage.prompt_tokens}</strong> tok</span>
                <span>📤 Out: <strong>${usage.completion_tokens}</strong> tok</span>
                <span>📊 Total: <strong>${usage.total_tokens}</strong></span>
            `;
            bubbleWrap.appendChild(tokenMeta);
        }

        row.appendChild(avatar);
        row.appendChild(bubbleWrap);
        messagesContainer.appendChild(row);
        scrollToBottom();
    }

    function showTypingIndicator() {
        const row = document.createElement('div');
        row.className = 'message-row assistant typing-row';

        const avatar = document.createElement('div');
        avatar.className = 'avatar';
        avatar.innerHTML = '🤖';

        const indicator = document.createElement('div');
        indicator.className = 'typing-indicator';
        indicator.innerHTML = `
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
        `;

        row.appendChild(avatar);
        row.appendChild(indicator);
        messagesContainer.appendChild(row);
        scrollToBottom();
        return row;
    }

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function showToast(message) {
        if (!toastError) return;
        toastError.textContent = message;
        toastError.style.display = 'block';
        setTimeout(() => { toastError.style.display = 'none'; }, 5000);
    }

    // ================================================================
    //  Utilities
    // ================================================================
    function escapeHTML(str) {
        return String(str).replace(/[&<>'"]/g, tag => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;'
        }[tag] || tag));
    }

    function formatRelativeTime(dateStr) {
        if (!dateStr) return '';
        const date  = new Date(dateStr.replace(' ', 'T'));
        const now   = new Date();
        const diffMs = now - date;
        const diffM  = Math.floor(diffMs / 60000);
        const diffH  = Math.floor(diffMs / 3600000);
        const diffD  = Math.floor(diffMs / 86400000);

        if (diffM < 1)  return 'Baru saja';
        if (diffM < 60) return `${diffM} menit lalu`;
        if (diffH < 24) return `${diffH} jam lalu`;
        if (diffD < 7)  return `${diffD} hari lalu`;
        return date.toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' });
    }

    // ================================================================
    //  Lightweight Markdown Formatter
    // ================================================================
    function formatMarkdown(text) {
        if (!text) return '';

        let html = escapeHTML(text);

        // Code blocks: ```code```
        html = html.replace(/```([\s\S]*?)```/g, '<pre><code>$1</code></pre>');

        // Inline code: `code`
        html = html.replace(/`([^`]+)`/g, '<code>$1</code>');

        // Bold: **text**
        html = html.replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>');

        // Italic: *text*
        html = html.replace(/\*([^*]+)\*/g, '<em>$1</em>');

        // Headers: ###, ##, #
        html = html.replace(/^### (.*$)/gim, '<h4 style="margin: 8px 0 4px; color:#38bdf8;">$1</h4>');
        html = html.replace(/^## (.*$)/gim,  '<h3 style="margin: 12px 0 6px; color:#34d399;">$1</h3>');
        html = html.replace(/^# (.*$)/gim,   '<h2 style="margin: 14px 0 8px; color:#f8fafc;">$1</h2>');

        // Markdown Table
        html = html.replace(/((?:\|[^\n]+\|\r?\n)+)/g, (match) => {
            const rows = match.trim().split('\n');
            if (rows.length < 2) return match;
            let tableHtml = '<table>';
            rows.forEach((row, idx) => {
                const cols = row.split('|').filter((_, cIdx, arr) => cIdx > 0 && cIdx < arr.length - 1);
                if (row.includes('---')) return;
                const tag = idx === 0 ? 'th' : 'td';
                tableHtml += '<tr>' + cols.map(c => `<${tag}>${c.trim()}</${tag}>`).join('') + '</tr>';
            });
            tableHtml += '</table>';
            return tableHtml;
        });

        // Unordered lists
        html = html.replace(/^\s*[-*]\s+(.*)$/gim, '<li>$1</li>');
        html = html.replace(/(<li>.*<\/li>)/gms, '<ul>$1</ul>');

        // Ordered lists
        html = html.replace(/^\s*\d+\.\s+(.*)$/gim, '<li>$1</li>');

        // Paragraphs / linebreaks
        html = html.replace(/\n\n+/g, '</p><p>');
        html = html.replace(/\n/g, '<br>');

        return '<p>' + html + '</p>';
    }

    // ================================================================
    //  Init
    // ================================================================
    renderWelcomeScreen();
    loadHistory();
});

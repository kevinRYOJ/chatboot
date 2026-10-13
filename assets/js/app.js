/**
 * All-in-One Sport Chatbot — Frontend Logic
 * Stack: Vanilla JavaScript (Fetch API, Lightweight Markdown Parser)
 */

document.addEventListener('DOMContentLoaded', () => {
    // State Aplikasi
    let currentMode = 'workout';
    let chatHistory = [];
    let isGenerating = false;

    // Mode Metadata
    const modeConfig = {
        workout: {
            title: '💪 Workout & Latihan',
            tag: 'Personal Trainer Mode',
            placeholder: 'Tanyakan program latihan, variasi gerakan, atau jadwal gym...',
            welcomeTitle: 'Siap Latihan Hari Ini? 💪',
            welcomeDesc: 'Aku Personal Trainer AI siap membantu merancang program latihan, rekomendasi gerakan aman, hingga panduan kebugaran untukmu.',
            suggestions: [
                'Buat jadwal latihan 3 hari untuk pemula di rumah',
                'Bagaimana form squat yang benar agar tidak cedera lutut?',
                'Rekomendasi variasi push-up untuk otot dada atas',
                'Berapa repetisi optimal untuk hypertrophy otot?'
            ]
        },
        nutrisi: {
            title: '🍎 Nutrisi & Diet',
            tag: 'Sport Nutritionist Mode',
            placeholder: 'Tanyakan perhitungan kalori, BMR/TDEE, atau meal plan atlet...',
            welcomeTitle: 'Optimalkan Nutrisi Olahragamu 🍎',
            welcomeDesc: 'Konsultasikan target kalori, kebutuhan protein harian, menu pre-workout, dan strategi diet sehat berbasis bahan lokal.',
            suggestions: [
                'Hitung BMR dan TDEE untuk pria 70kg, 170cm, olahraga 4x seminggu',
                'Menu pre-workout 45 menit sebelum lari pagi',
                'Sumber protein lokal murah selain dada ayam',
                'Berapa gram protein per kg berat badan untuk muscle gain?'
            ]
        },
        info: {
            title: '⚽ Info Olahraga',
            tag: 'Sports Analyst Mode',
            placeholder: 'Tanyakan aturan pertandingan, analisis taktik, atau fakta atlet...',
            welcomeTitle: 'Wawasan & Info Olahraga Dunia ⚽',
            welcomeDesc: 'Eksplorasi taktik sepak bola, aturan resmi bulu tangkis, basket, renang, dan dapatkan inspirasi mental bertanding.',
            suggestions: [
                'Jelaskan perbedaan formasi 4-3-3 dan 3-5-2 dalam sepak bola',
                'Teknik pukulan netting bulu tangkis untuk pemula',
                'Tips membangun mental juara sebelum pertandingan',
                'Aturan rotasi dan posisi dalam bola voli'
            ]
        }
    };

    // Elemen DOM
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

    // ---------------- Auto Resize Textarea ----------------
    messageInput.addEventListener('input', () => {
        messageInput.style.height = 'auto';
        messageInput.style.height = Math.min(messageInput.scrollHeight, 140) + 'px';
        btnSend.disabled = messageInput.value.trim() === '' || isGenerating;
    });

    // Enter untuk kirim, Shift+Enter untuk baris baru
    messageInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (!btnSend.disabled) {
                chatForm.dispatchEvent(new Event('submit'));
            }
        }
    });

    // ---------------- Navigasi Mode ----------------
    modeCards.forEach(card => {
        card.addEventListener('click', () => {
            const selectedMode = card.getAttribute('data-mode');
            if (selectedMode === currentMode) return;

            modeCards.forEach(c => c.classList.remove('active'));
            card.classList.add('active');

            currentMode = selectedMode;
            updateModeUI();

            // Tutup sidebar di tampilan mobile jika terbuka
            closeMobileSidebar();
        });
    });

    function updateModeUI() {
        const config = modeConfig[currentMode];
        currentModeTag.textContent = config.title;
        messageInput.placeholder = config.placeholder;

        // Jika riwayat chat kosong, update welcome card
        const welcomeCard = document.querySelector('.welcome-card');
        if (welcomeCard) {
            welcomeCard.querySelector('h2').textContent = config.welcomeTitle;
            welcomeCard.querySelector('p').textContent = config.welcomeDesc;

            const chipsContainer = welcomeCard.querySelector('.suggestion-chips');
            chipsContainer.innerHTML = '';
            config.suggestions.forEach(text => {
                const chip = document.createElement('button');
                chip.className = 'chip';
                chip.type = 'button';
                chip.textContent = text;
                chip.addEventListener('click', () => {
                    messageInput.value = text;
                    messageInput.dispatchEvent(new Event('input'));
                    chatForm.dispatchEvent(new Event('submit'));
                });
                chipsContainer.appendChild(chip);
            });
        }
    }

    // ---------------- Mobile Sidebar Toggle ----------------
    if (btnMenuToggle) {
        btnMenuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('active');
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
    }

    function closeMobileSidebar() {
        if (sidebar) sidebar.classList.remove('open');
        if (sidebarOverlay) sidebarOverlay.classList.remove('active');
    }

    // ---------------- Reset Chat ----------------
    btnClear.addEventListener('click', () => {
        if (confirm('Apakah kamu yakin ingin mereset seluruh riwayat chat?')) {
            chatHistory = [];
            renderWelcomeScreen();
            messageInput.value = '';
            messageInput.style.height = 'auto';
            btnSend.disabled = true;
        }
    });

    function renderWelcomeScreen() {
        const config = modeConfig[currentMode];
        messagesContainer.innerHTML = `
            <div class="welcome-card">
                <div class="welcome-icon">🏋️‍♂️</div>
                <h2>${config.welcomeTitle}</h2>
                <p>${config.welcomeDesc}</p>
                <div class="suggestion-chips">
                    ${config.suggestions.map(s => `<button type="button" class="chip">${escapeHTML(s)}</button>`).join('')}
                </div>
            </div>
        `;

        // Pasang event listener chip baru
        messagesContainer.querySelectorAll('.chip').forEach(chip => {
            chip.addEventListener('click', () => {
                messageInput.value = chip.textContent;
                messageInput.dispatchEvent(new Event('input'));
                chatForm.dispatchEvent(new Event('submit'));
            });
        });
    }

    // ---------------- Kirim Pesan Form ----------------
    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const userText = messageInput.value.trim();
        if (!userText || isGenerating) return;

        // Hapus welcome screen jika ada
        const welcomeCard = document.querySelector('.welcome-card');
        if (welcomeCard) {
            welcomeCard.remove();
        }

        // Tampilkan pesan user di chat
        appendMessage('user', userText);

        // Reset input
        messageInput.value = '';
        messageInput.style.height = 'auto';
        isGenerating = true;
        btnSend.disabled = true;

        // Tampilkan indikator mengetik
        const typingEl = showTypingIndicator();

        try {
            const response = await fetch('api/chat.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    message: userText,
                    mode: currentMode,
                    history: chatHistory
                })
            });

            const data = await response.json();

            // Hapus typing indicator
            typingEl.remove();

            if (!response.ok || data.status === 'error') {
                throw new Error(data.message || 'Gagal memproses pesan.');
            }

            // Tampilkan balasan bot
            appendMessage('assistant', data.reply, data.usage);

            // Simpan ke riwayat lokal
            chatHistory.push({ role: 'user', content: userText });
            chatHistory.push({ role: 'assistant', content: data.reply });

        } catch (err) {
            if (typingEl) typingEl.remove();
            showToast(err.message);
            appendMessage('assistant', `⚠️ **Terjadi kendala:** ${err.message}`);
        } finally {
            isGenerating = false;
            btnSend.disabled = messageInput.value.trim() === '';
            messageInput.focus();
        }
    });

    // ---------------- Helper Render Chat Bubble ----------------
    function appendMessage(role, content, usage = null) {
        const row = document.createElement('div');
        row.className = `message-row ${role}`;

        const avatar = document.createElement('div');
        avatar.className = 'avatar';
        avatar.innerHTML = role === 'user' ? '👤' : '⚡';

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

        // Tampilkan token usage (sangat berguna untuk eksperimen Google Sheets!)
        if (role === 'assistant' && usage && (usage.prompt_tokens || usage.completion_tokens)) {
            const tokenMeta = document.createElement('div');
            tokenMeta.className = 'token-meta';
            tokenMeta.innerHTML = `
                <span>📥 Input: <strong>${usage.prompt_tokens}</strong> tok</span>
                <span>📤 Output: <strong>${usage.completion_tokens}</strong> tok</span>
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
        avatar.innerHTML = '⚡';

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
        setTimeout(() => {
            toastError.style.display = 'none';
        }, 5000);
    }

    function escapeHTML(str) {
        return str.replace(/[&<>'"]/g, tag => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            "'": '&#39;',
            '"': '&quot;'
        }[tag] || tag));
    }

    // ---------------- Lightweight Markdown Formatter ----------------
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
        html = html.replace(/^## (.*$)/gim, '<h3 style="margin: 12px 0 6px; color:#34d399;">$1</h3>');
        html = html.replace(/^# (.*$)/gim, '<h2 style="margin: 14px 0 8px; color:#f8fafc;">$1</h2>');

        // Markdown Table simple parser
        html = html.replace(/((?:\|[^\n]+\|\r?\n)+)/g, (match) => {
            const rows = match.trim().split('\n');
            if (rows.length < 2) return match;

            let tableHtml = '<table>';
            rows.forEach((row, idx) => {
                const cols = row.split('|').filter((_, cIdx, arr) => cIdx > 0 && cIdx < arr.length - 1);
                // Lewati separator baris (|---|---|)
                if (row.includes('---')) return;

                const tag = idx === 0 ? 'th' : 'td';
                tableHtml += '<tr>' + cols.map(c => `<${tag}>${c.trim()}</${tag}>`).join('') + '</tr>';
            });
            tableHtml += '</table>';
            return tableHtml;
        });

        // Unordered lists (- or *)
        html = html.replace(/^\s*[-*]\s+(.*)$/gim, '<li>$1</li>');
        html = html.replace(/(<li>.*<\/li>)/gms, '<ul>$1</ul>');

        // Ordered lists (1. )
        html = html.replace(/^\s*\d+\.\s+(.*)$/gim, '<li>$1</li>');

        // Paragraphs / linebreaks
        html = html.replace(/\n\n+/g, '</p><p>');
        html = html.replace(/\n/g, '<br>');

        return '<p>' + html + '</p>';
    }

    // Inisialisasi tampilan awal
    renderWelcomeScreen();
});

# 🏆 All-in-One Sport Chatbot (PHP & Google Gemini API)

> Aplikasi Chatbot Olahraga cerdas berbasis AI untuk panduan **Workout**, **Nutrisi Atlet**, dan **Informasi Dunia Olahraga**.  
> Didukung oleh **Google Gemini API** dengan sistem **fallback model otomatis** — jika kuota satu model habis, chatbot langsung berpindah ke model cadangan tanpa error.  
> Dilengkapi sistem **Login & Registrasi** serta **penyimpanan riwayat chat** menggunakan **MySQL**.

---

## ✨ Fitur Utama

- 🔐 **Sistem Autentikasi** — Register & Login dengan password ter-enkripsi (bcrypt). Setiap user punya riwayat chat masing-masing.
- 💪 **Mode Workout & Latihan** — Rekomendasi program latihan, kalistenik, gym, dan koreksi form gerakan *(Persona: Personal Trainer NASM-CPT)*.
- 🥗 **Mode Nutrisi & Diet** — Kalkulasi BMR & TDEE, meal plan lokal, dan strategi nutrisi atlet *(Persona: Ahli Gizi CSSD)*.
- 🏅 **Mode Info Olahraga** — Analisis taktik, aturan resmi, sejarah kejuaraan *(Persona: Komentator & Analis Olahraga)*.
- 🚫 **Pembatasan Topik** — Chatbot menolak pertanyaan di luar konteks olahraga/nutrisi secara otomatis.
- 📋 **Riwayat Chat Persisten** — Semua percakapan tersimpan di database dan bisa dibuka kembali kapan saja.
- 📊 **Pelacak Token Real-time** — Setiap balasan AI menampilkan jumlah Token Input & Output (berguna untuk eksperimen).
- 🔄 **Fallback Model Otomatis** — Jika model Gemini utama kehabisan kuota, sistem otomatis pindah ke model cadangan.
- 💬 **Antarmuka Modern & Responsif** — Dark mode, AJAX (tanpa refresh), mendukung HP maupun laptop.

---

## 🏗️ Arsitektur Aplikasi

```
Browser (User)
    │
    ├──[GET]──► login.php          ← Halaman Register / Login
    │               │
    │           api/auth.php       ← Proses autentikasi (register/login/logout)
    │               │
    │           MySQL: users       ← Simpan data akun (username, email, bcrypt hash)
    │
    └──[GET]──► index.php          ← Halaman utama chat (redirect ke login jika belum login)
                    │
                    ├── assets/css/style.css   ← Tampilan dark mode
                    ├── assets/css/auth.css    ← Tampilan login & history panel
                    └── assets/js/app.js       ← Logika frontend (AJAX, markdown, history)
                                │
                    ┌───────────┴────────────────────┐
                    │                                │
              [POST] api/chat.php            [GET/POST/DELETE]
              Kirim pesan ke Gemini          api/sessions.php
                    │                        Kelola sesi chat
                    │                                │
              config/prompts.php            MySQL: chat_sessions
              System Prompt per mode        MySQL: chat_messages
                    │
              Google Gemini API
              (dengan fallback model)
                    │
              Simpan balasan AI
              ke chat_messages
```

### Alur Lengkap per Request Chat

```
User ketik pesan
      │
      ▼
app.js  ──[POST JSON]──►  api/chat.php
                                │
                          Cek session PHP
                          (sudah login?)
                                │
                    ┌───────────┴──────────────┐
                   Belum                      Sudah
                    │                          │
              Tolak (401)            Ambil/Buat session_id
                                     di tabel chat_sessions
                                               │
                                    Simpan pesan user
                                    ke chat_messages
                                               │
                                    Kirim ke Gemini API
                                    (coba model 1 → 2 → 3 → dst)
                                               │
                                    Simpan balasan AI
                                    ke chat_messages
                                               │
                              ◄──[JSON response]──
                                               │
                              app.js render pesan
                              + refresh sidebar history
```

---

## 📁 Struktur Folder Proyek

```text
chatboot/
├── index.php                 # Halaman utama chat (dengan guard login)
├── login.php                 # Halaman Register & Login
├── .env                      # Konfigurasi rahasia (API Key + DB) — JANGAN di-commit!
├── .env.example              # Template konfigurasi — aman untuk GitHub
├── .gitignore                # Mencegah .env bocor ke Git
├── README.md                 # Dokumentasi ini
│
├── api/
│   ├── auth.php              # Endpoint: register, login, logout, cek sesi
│   ├── chat.php              # Endpoint: kirim pesan ke Gemini + simpan ke DB
│   └── sessions.php          # Endpoint: list sesi, buka sesi lama, hapus sesi
│
├── config/
│   ├── config.php            # Loader .env & konfigurasi umum aplikasi
│   ├── database.php          # Koneksi PDO ke MySQL
│   └── prompts.php           # System Prompt per mode + aturan pembatasan topik
│
├── assets/
│   ├── css/
│   │   ├── style.css         # Desain dark mode modern & responsif
│   │   └── auth.css          # Styling halaman login & history panel sidebar
│   └── js/
│       └── app.js            # Logika frontend: AJAX, history, markdown, logout
│
├── database/
│   └── schema.sql            # Skema tabel MySQL (users, chat_sessions, chat_messages)
│
├── docs/
│   └── GITHUB_ISSUES.md      # Daftar task milestone proyek
│
└── experiments/              # Dokumentasi eksperimen prompt engineering
    ├── TEMPLATE_EKSPERIMEN.md
    └── hasil/
        ├── analisis-final.md
        ├── workout-prompt-test.md
        ├── nutrisi-prompt-test.md
        └── info-prompt-test.md
```

---

## 🗄️ Struktur Database

Terdiri dari **3 tabel** di database `sportchatbot`:

```sql
users                          chat_sessions                chat_messages
─────────────────────          ─────────────────────────    ──────────────────────────
id           (PK)              id            (PK)           id                (PK)
username     UNIQUE            user_id  ──►  users.id       session_id  ──►  sessions.id
email        UNIQUE            mode          workout/       role              user/assistant
password_hash  bcrypt                        nutrisi/info   content           TEXT
created_at                     title         auto-generate  model_used        nama model Gemini
last_login                     created_at                   prompt_tokens
                               updated_at                   completion_tokens
                                                            total_tokens
                                                            created_at
```

---

## 🚀 Panduan Menjalankan Aplikasi (Dari Nol)

### Langkah 1 — Prasyarat

Pastikan sudah terinstall:
- **PHP 8.0+** dengan ekstensi `curl` dan `pdo_mysql` aktif
- **MySQL / MariaDB** (via XAMPP atau Laragon)
- **Web server** Apache (via XAMPP / Laragon) atau PHP built-in server

Cek versi PHP:
```bash
php -v
```

> **Rekomendasi:** Gunakan **[Laragon](https://laragon.org/)** (Windows) — sudah include Apache, MySQL, dan phpMyAdmin sekaligus.

---

### Langkah 2 — Clone / Download Project

**Cara A — Clone via Git:**
```bash
git clone https://github.com/kevinRYOJ/chatboot.git
cd chatboot
```

**Cara B — Download ZIP:**
1. Buka [github.com/kevinRYOJ/chatboot](https://github.com/kevinRYOJ/chatboot)
2. Klik tombol **Code → Download ZIP**
3. Ekstrak ke dalam folder web server:
   - XAMPP → `C:\xampp\htdocs\chatboot\`
   - Laragon → `C:\laragon\www\chatboot\`

---

### Langkah 3 — Setup Database MySQL

1. Pastikan **MySQL** sudah berjalan (Start All di XAMPP/Laragon)
2. Buka **phpMyAdmin** di browser:
   ```
   http://localhost/phpmyadmin
   ```
3. Klik tab **SQL** di bagian atas
4. **Copy-paste** seluruh isi file `database/schema.sql` ke dalam kotak SQL
5. Klik tombol **Go**

> ✅ Database `sportchatbot` beserta ketiga tabelnya akan otomatis terbuat — tidak perlu buat database manual terlebih dahulu karena script sudah include `CREATE DATABASE IF NOT EXISTS`.

---

### Langkah 4 — Dapatkan API Key Google Gemini (Gratis)

1. Buka 👉 [aistudio.google.com/app/apikey](https://aistudio.google.com/app/apikey)
2. Login dengan akun Google
3. Klik **Create API Key**
4. Salin API Key (diawali `AIza...`)

---

### Langkah 5 — Konfigurasi File `.env`

Duplikat file `.env.example` menjadi `.env`:
```bash
# Windows CMD
copy .env.example .env

# Windows PowerShell
Copy-Item .env.example .env

# Mac / Linux
cp .env.example .env
```

Buka `.env` dan isi nilainya:
```ini
# API Key Gemini (WAJIB)
GEMINI_API_KEY=AIzaSy_paste_api_key_kamu_di_sini

# Konfigurasi Database MySQL (WAJIB)
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=sportchatbot
DB_USER=root
DB_PASS=             ← kosongkan jika XAMPP/Laragon default (tanpa password)

# Urutan model Gemini — opsional, bisa dikustomisasi
GEMINI_MODELS=gemini-2.0-flash, gemini-1.5-flash, gemini-1.5-flash-8b, gemini-1.5-pro
```

> ⚠️ **Jangan upload file `.env` ke GitHub!** File ini sudah masuk `.gitignore`.

---

### Langkah 6 — Jalankan Aplikasi

**Jika pakai XAMPP / Laragon (Apache):**
```
http://localhost/chatboot
```

**Jika pakai PHP Built-in Server:**
```bash
php -S localhost:8000
```
Lalu buka: `http://localhost:8000`

Kamu akan langsung diarahkan ke halaman **Login**. Daftar akun baru, lalu mulai chat! 🎉

---

## 🔄 Sistem Fallback Model Otomatis

Jika model utama kehabisan kuota atau error, sistem otomatis mencoba model berikutnya:

```
gemini-2.0-flash → gemini-1.5-flash → gemini-1.5-flash-8b → gemini-1.5-pro
```

Urutan ini bisa dikustomisasi lewat `.env`:
```ini
GEMINI_MODELS=gemini-2.0-flash, gemini-1.5-flash, gemini-1.5-flash-8b, gemini-1.5-pro
```

---

## ❓ Troubleshooting

| Masalah | Solusi |
|---|---|
| Redirect ke login terus | Pastikan session PHP aktif & database sudah di-import |
| `Koneksi database gagal` | Cek MySQL sudah berjalan & isi `DB_PASS` di `.env` sudah benar |
| `GEMINI_API_KEY belum dikonfigurasi` | Pastikan file `.env` sudah dibuat dan API Key sudah diisi |
| Chatbot tidak merespons | Cek API Key masih valid di [aistudio.google.com](https://aistudio.google.com) |
| Kuota habis | Sistem otomatis pindah ke model cadangan. Jika semua habis, tunggu reset kuota harian |
| `curl extension not found` | Aktifkan di `php.ini`: hapus tanda `;` pada baris `extension=curl` |
| `pdo_mysql extension not found` | Aktifkan di `php.ini`: hapus tanda `;` pada baris `extension=pdo_mysql` |
| Halaman tidak bisa dibuka (built-in server) | Pastikan perintah `php -S localhost:8000` masih berjalan di terminal |

---

## 👥 Tim Pengembang

| Nama | Akun GitHub | Peran Utama |
|---|---|---|
| **Kevin** | [@kevinRYOJ](https://github.com/kevinRYOJ) | Project Lead, Backend API & Database |
| **Fernanda** | [@fernanda-hensem](https://github.com/fernanda-hensem) | Frontend Developer & UI Styling |
| **Rico** | [@ricozack97](https://github.com/ricozack97) | Prompt Engineer & Quality Assurance |

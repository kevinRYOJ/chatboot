# 🏋️ All-in-One Sport Chatbot (PHP & Google Gemini API)

> Aplikasi Chatbot Olahraga cerdas berbasis AI untuk panduan Workout, Nutrisi atlet, dan Informasi Dunia Olahraga.  
> Didukung oleh **Google Gemini API** dengan sistem **fallback model otomatis** — jika kuota satu model habis, chatbot langsung berpindah ke model cadangan tanpa error.

---

## ✨ Fitur Utama

- 💪 **Mode Workout & Latihan** — Rekomendasi program latihan kebugaran, kalistenik, gym, repetisi, dan koreksi form gerakan aman *(Persona: Personal Trainer bersertifikat NASM-CPT)*.
- 🍎 **Mode Nutrisi & Diet** — Kalkulasi kalori harian (BMR & TDEE), target protein, meal plan lokal terjangkau, dan strategi hidrasi *(Persona: Ahli Gizi Olahraga CSSD)*.
- ⚽ **Mode Info Olahraga** — Analisis taktik pertandingan, aturan resmi cabang olahraga populer, wawasan sejarah, dan motivasi atlet *(Persona: Komentator & Analis Olahraga)*.
- 📊 **Pelacak Token Terintegrasi** — Setiap balasan AI menampilkan jumlah **Token Input** dan **Token Output** secara real-time, berguna untuk pencatatan eksperimen.
- 🔄 **Fallback Model Otomatis** — Jika kuota model utama habis, sistem otomatis mencoba model cadangan berikutnya tanpa perlu restart.
- 💬 **Antarmuka Modern & Responsif** — Desain dark mode modern, AJAX Fetch (tanpa refresh halaman), mendukung tampilan HP maupun Laptop.

---

## 🚀 Panduan Menjalankan Aplikasi (Dari Nol)

### Langkah 1 — Prasyarat

Pastikan kamu sudah menginstall **PHP 8.0 atau lebih baru**.

Cek versi PHP kamu di terminal:
```bash
php -v
```
Jika belum ada, install via **[XAMPP](https://www.apachefriends.org/)** atau **[Laragon](https://laragon.org/)** (Windows).

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
3. Ekstrak ZIP ke folder yang kamu inginkan

---

### Langkah 3 — Dapatkan API Key Gratis dari Google

1. Buka 👉 [aistudio.google.com/app/apikey](https://aistudio.google.com/app/apikey)
2. Login menggunakan **akun Google** kamu
3. Klik tombol **Create API Key**
4. Salin API Key yang muncul (formatnya diawali `AIza...`)

> **Gratis!** Google menyediakan free tier yang cukup untuk penggunaan eksperimen dan belajar.

---

### Langkah 4 — Konfigurasi File `.env`

Di dalam folder project, **duplikat file `.env.example`** menjadi `.env`:

```bash
# Windows (Command Prompt)
copy .env.example .env

# Windows (PowerShell)
Copy-Item .env.example .env

# Mac / Linux
cp .env.example .env
```

Buka file `.env` dan isi API Key kamu:
```ini
GEMINI_API_KEY=AIzaSy_paste_api_key_kamu_di_sini
```

> ⚠️ **Jangan upload file `.env` ke GitHub!** File ini sudah masuk `.gitignore` dan akan otomatis diabaikan.

---

### Langkah 5 — Jalankan Aplikasi

**Cara Cepat — PHP Built-in Server (direkomendasikan untuk testing):**

Buka terminal di dalam folder project, lalu jalankan:
```bash
php -S localhost:8000
```

Kemudian buka browser dan akses:  
👉 **[http://localhost:8000](http://localhost:8000)**

---

**Cara Alternatif — XAMPP / Laragon:**
1. Pindahkan folder `chatboot` ke dalam:
   - XAMPP → `C:\xampp\htdocs\`
   - Laragon → `C:\laragon\www\`
2. Nyalakan modul **Apache**
3. Buka browser dan akses:  
   👉 **[http://localhost/chatboot](http://localhost/chatboot)**

---

## 🔄 Sistem Fallback Model Otomatis

Chatbot ini memiliki sistem fallback otomatis. Jika model utama kehabisan kuota atau error, sistem akan **otomatis mencoba model berikutnya** tanpa perlu intervensi manual.

Urutan model default (bisa diubah di file `.env`):
```
gemini-2.0-flash → gemini-1.5-flash → gemini-1.5-flash-8b → gemini-1.5-pro
```

Untuk mengustomisasi urutan model, tambahkan baris berikut di `.env`:
```ini
GEMINI_MODELS=gemini-2.0-flash, gemini-1.5-flash, gemini-1.5-flash-8b, gemini-1.5-pro
```

---

## 📁 Struktur Folder Proyek

```text
chatboot/
├── index.php                 # Halaman utama aplikasi (UI Chatbot)
├── .env                      # File konfigurasi rahasia (API Key) — JANGAN di-commit!
├── .env.example              # Template konfigurasi — aman untuk GitHub
├── .gitignore                # Mencegah file .env bocor ke Git
├── README.md                 # Dokumentasi panduan proyek ini
│
├── api/
│   └── chat.php              # Backend: memanggil Google Gemini API via cURL + fallback model
│
├── config/
│   ├── config.php            # Loader file .env & konfigurasi umum aplikasi
│   └── prompts.php           # System Prompt untuk 3 mode (Workout / Nutrisi / Info)
│
├── assets/
│   ├── css/
│   │   └── style.css         # Desain visual dark mode modern & responsif
│   └── js/
│       └── app.js            # Interaksi chat AJAX, Markdown formatter, token tracker
│
├── docs/                     # Dokumentasi teknis & perencanaan proyek
│   └── GITHUB_ISSUES.md      # Daftar 25 task (Milestone 1–4)
│
└── experiments/              # Dokumentasi 28 kombinasi eksperimen prompt engineering
    ├── TEMPLATE_EKSPERIMEN.md
    └── hasil/
        ├── analisis-final.md
        ├── workout-prompt-test.md
        ├── nutrisi-prompt-test.md
        └── info-prompt-test.md
```

---

## ❓ Troubleshooting

| Masalah | Solusi |
|---|---|
| Halaman tidak bisa dibuka | Pastikan perintah `php -S localhost:8000` masih berjalan di terminal |
| `GEMINI_API_KEY belum dikonfigurasi` | Pastikan file `.env` sudah dibuat dan API Key sudah diisi dengan benar |
| Chatbot tidak merespons / error | Cek apakah API Key masih valid di [aistudio.google.com](https://aistudio.google.com) |
| Kuota habis | Sistem akan otomatis pindah ke model cadangan. Jika semua habis, tunggu reset kuota harian |
| `curl extension not found` | Aktifkan ekstensi `curl` di file `php.ini` (hapus tanda `;` di baris `extension=curl`) |

---

## 👥 Tim Pengembang

| Nama | Akun GitHub | Peran Utama |
|---|---|---|
| **Kevin** | [@kevinRYOJ](https://github.com/kevinRYOJ) | Project Lead & Backend API cURL |
| **Fernanda** | [@fernanda-hensem](https://github.com/fernanda-hensem) | Frontend Developer & UI Styling |
| **Rico** | [@ricozack97](https://github.com/ricozack97) | Prompt Engineer & Quality Assurance |
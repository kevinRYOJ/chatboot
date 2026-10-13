# 🏋️ All-in-One Sport Chatbot (PHP & Google Gemini API)

> Aplikasi Chatbot Olahraga cerdas berbasis AI untuk panduan Workout, Nutrisi atlet, dan Informasi Dunia Olahraga.  
> Didukung oleh **Google Gemini API** (`gemini-1.5-flash`) yang sangat natural dalam berbahasa Indonesia, cepat, dan memiliki free tier gratis dari Google.

---

## ✨ Fitur Utama

- 💪 **Mode Workout & Latihan:** Rekomendasi program latihan kebugaran, kalistenik, gym, repetisi, dan koreksi form gerakan aman (Persona: Personal Trainer bersertifikat NASM-CPT).
- 🍎 **Mode Nutrisi & Diet:** Kalkulasi kalori harian (BMR & TDEE), target protein, meal plan lokal terjangkau, dan strategi hidrasi (Persona: Ahli Gizi Olahraga CSSD).
- ⚽ **Mode Info Olahraga:** Analisis taktik pertandingan, aturan resmi cabang olahraga populer, wawasan sejarah, dan motivasi atlet (Persona: Komentator & Analis Olahraga).
- 📊 **Pelacak Penggunaan Token Terintegrasi:** Setiap balasan AI menampilkan jumlah **Token Input** dan **Token Output**, mempermudah pencatatan data pada tabel eksperimen tugas.
- 💬 **Antarmuka Modern & Responsif:** Desain modern, cepat tanpa refresh halaman (AJAX Fetch), dan mendukung tampilan HP maupun Laptop.

---

## 🚀 Panduan Menjalankan Aplikasi

### 1. Prasyarat
- **PHP** versi 8.0 atau lebih baru (dengan ekstensi `curl` dan `json` aktif).
- Bisa dijalankan menggunakan **PHP CLI Built-in Server**, **XAMPP**, atau **Laragon**.

### 2. Dapatkan API Key Gratis dari Google Gemini
1. Buka [aistudio.google.com/app/apikey](https://aistudio.google.com/app/apikey)
2. Login menggunakan akun Google kamu.
3. Klik tombol **Create API Key**, lalu salin kuncinya (format: `AIza...`).

### 3. Konfigurasi File `.env`
Buka file `.env` di folder proyek dan tempel API Key kamu:
```ini
GEMINI_API_KEY=AIzaSy_paste_api_key_kamu_di_sini
GEMINI_MODEL=gemini-1.5-flash
```

### 4. Jalankan Aplikasi di Browser

#### Cara Cepat (Terminal / VSCode):
Jalankan perintah berikut di terminal:
```bash
php -S localhost:8000
```
Buka browser dan akses:  
👉 **`http://localhost:8000`**

#### Cara Menggunakan XAMPP / Laragon:
1. Pastikan folder proyek berada di dalam folder server web (`htdocs` atau `www`).
2. Nyalakan modul **Apache**.
3. Buka browser dan akses:  
👉 **`http://localhost/chatboot`**

---

## 📁 Struktur Folder Proyek

```text
chatboot/
├── index.php                 # Halaman utama aplikasi (UI Chatbot)
├── .env                      # File konfigurasi rahasia (API Key Gemini)
├── .env.example              # Template contoh konfigurasi untuk GitHub
├── .gitignore                # Mencegah file .env bocor ke Git
├── README.md                 # Dokumentasi panduan proyek
│
├── api/
│   └── chat.php              # Backend API cURL yang memanggil Google Gemini Cloud
│
├── config/
│   ├── config.php            # Loader file .env & konfigurasi umum
│   └── prompts.php           # Kumpulan System Prompt 3 mode olahraga
│
├── assets/
│   ├── css/
│   │   └── style.css         # Desain visual modern & responsif
│   └── js/
│       └── app.js            # Interaksi chat real-time & format Markdown
│
├── docs/                     # Dokumentasi pengembangan & issue GitHub
│   ├── GITHUB_ISSUES.md
│   └── arsitektur.md
│
└── experiments/              # Panduan 28 kombinasi prompt engineering
    ├── TEMPLATE_EKSPERIMEN.md
    └── hasil/
        └── analisis-final.md
```

---

## 👥 Tim Pengembang

| Nama | Akun GitHub | Peran Utama |
|---|---|---|
| **Kevin** | `kevinRYOJ` | Project Lead & Backend API cURL |
| **Fernanda** | `fernanda-hensem` | Frontend Developer & UI Styling |
| **Rico** | `ricozack97` | Prompt Engineer & Quality Assurance |
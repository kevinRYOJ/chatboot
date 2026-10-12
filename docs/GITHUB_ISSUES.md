# 📋 GitHub Issues — All-in-One Sport Chatbot (PHP & Groq API)

> **Repository:** `kevinRYOJ/chatboot`  
> **Tech Stack:** PHP (Native Modern) + Groq API (`llama-3.3-70b-versatile` / `llama-3.1-8b-instant`)  
> **Tim:**  
> - 👑 Kevin (`kevinRYOJ`) — Project Manager & Lead Backend  
> - 👤 Fernanda (`fernanda-hensem`) — Frontend & Feature Developer  
> - 👤 Rico (`ricozack97`) — Prompt Engineer & QA  
> **Total:** 22 Task | 4 Milestone | 3 Anggota

---

# 🏁 MILESTONE 1 — Setup & Persiapan Proyek

---

## TASK-01 · Inisialisasi Repository GitHub & Keamanan
**Assignee:** `kevinRYOJ` | **Label:** `setup`, `admin` | **Milestone:** Milestone 1 | **Status:** Done

### 📝 Deskripsi
Membuat repository GitHub sebagai pusat kolaborasi tim, mengatur branch develop, branch protection di branch `main`, dan CI/CD awal.

### ✅ Acceptance Criteria
- [x] Repository `chatboot` sudah dibuat di GitHub
- [x] Branch `main` dan `develop` sudah aktif
- [x] File `.gitignore`, `.env.example`, dan `README.md` sudah ada
- [x] Branch protection rule di `main` sudah aktif
- [x] Fernanda (`fernanda-hensem`) dan Rico (`ricozack97`) sudah diundang sebagai Collaborator

---

## TASK-02 · Setup GitHub Project Board
**Assignee:** `kevinRYOJ` | **Label:** `setup`, `admin` | **Milestone:** Milestone 1 | **Status:** In Progress

### 📝 Deskripsi
Mengatur papan Kanban di GitHub Projects agar tim bisa melacak progres pekerjaan secara transparan.

### ✅ Acceptance Criteria
- [ ] Kolom board tersusun: Backlog / Ready / In Progress / In Review / Done
- [ ] 4 Milestone sudah dibuat (M1 s/d M4) dengan due date
- [ ] Semua 22 task sudah masuk ke board
- [ ] Setiap task memiliki Assignee, Labels, Priority, dan Milestone

---

## TASK-03 · Buat Struktur Folder Proyek PHP
**Assignee:** `kevinRYOJ` | **Label:** `setup` | **Milestone:** Milestone 1 | **Status:** Backlog

### 📝 Deskripsi
Menyiapkan struktur folder standar PHP agar modular, rapi, dan mudah dikembangkan bersama.

### ✅ Acceptance Criteria
- [ ] Folder `api/`, `config/`, `assets/css/`, `assets/js/`, `docs/`, `experiments/` sudah tersedia
- [ ] File konfigurasi `config/config.php` dan `config/prompts.php` sudah disiapkan
- [ ] Struktur folder sudah di-push ke branch `develop`

### 🗂️ Struktur yang Dibuat
```
chatboot/
├── .env.example
├── .gitignore
├── index.php
├── README.md
├── api/
│   └── chat.php
├── config/
│   ├── config.php
│   └── prompts.php
├── assets/
│   ├── css/style.css
│   └── js/app.js
├── docs/
└── experiments/
    └── hasil/
```

---

## TASK-04 · Dokumentasi Arsitektur Sistem (PHP + Groq API)
**Assignee:** `kevinRYOJ` | **Label:** `documentation` | **Milestone:** Milestone 1 | **Status:** Backlog

### 📝 Deskripsi
Membuat dokumen arsitektur alur sistem komunikasi antara browser client, server PHP, dan Groq AI Cloud.

### ✅ Acceptance Criteria
- [ ] File `docs/arsitektur.md` menjelaskan alur client-server
- [ ] Diagram alur: User (Browser) → AJAX `fetch()` → `api/chat.php` → cURL Groq API → JSON response
- [ ] Penjelasan 3 mode utama (Workout, Nutrisi, Info Olahraga)

---

## TASK-05 · Setup Environment PHP & Konfigurasi API Key
**Assignee:** `fernanda-hensem` | **Label:** `setup` | **Milestone:** Milestone 1 | **Status:** Backlog

### 📝 Deskripsi
Menyiapkan environment lokal PHP dan memastikan ekstensi cURL serta JSON aktif untuk memanggil Groq API.

### ✅ Acceptance Criteria
- [ ] PHP versi 8.0+ berjalan di komputer lokal (XAMPP / Laragon / PHP CLI)
- [ ] Ekstensi `curl` dan `json` aktif
- [ ] File `.env` lokal berhasil dibuat dari `.env.example`
- [ ] API Key Groq sudah terpasang dan siap digunakan

---

## TASK-06 · Riset & Kumpulkan Referensi Prompt Engineering
**Assignee:** `ricozack97` | **Label:** `research` | **Milestone:** Milestone 1 | **Status:** Backlog

### 📝 Deskripsi
Mempelajari 5 teknik prompt engineering yang akan diuji coba pada Milestone 3.

### ✅ Acceptance Criteria
- [ ] 5 teknik dipahami: Zero-shot, Negative, Action-oriented, Chain of Thought (CoT), Few-shot
- [ ] File `docs/prompt-engineering-ref.md` dibuat dengan contoh kasus olahraga
- [ ] Disediakan minimal 1 contoh prompt untuk tiap teknik

---

# 🏁 MILESTONE 2 — Pengembangan Chatbot (Core Features)

---

## TASK-07 · Buat User Interface Chatbot (HTML, CSS, JS)
**Assignee:** `fernanda-hensem` | **Label:** `feature`, `frontend` | **Milestone:** Milestone 2 | **Status:** Backlog

### 📝 Deskripsi
Membuat tampilan web chat interaktif yang modern, responsif, dan mudah digunakan di `index.php`.

### ✅ Acceptance Criteria
- [ ] Header judul "🏋️ Sport AI Chatbot"
- [ ] Sidebar pilihan mode: Workout & Latihan, Nutrisi & Diet, Info Olahraga
- [ ] Area chat menampilkan riwayat percakapan user dan bot
- [ ] Input chat tidak me-reload halaman (menggunakan AJAX `fetch()` di `assets/js/app.js`)
- [ ] Tombol Reset Chat untuk menghapus riwayat pesan

---

## TASK-08 · Integrasi Groq API dengan PHP cURL
**Assignee:** `kevinRYOJ` | **Label:** `feature`, `backend` | **Milestone:** Milestone 2 | **Status:** Backlog

### 📝 Deskripsi
Membangun endpoint backend `api/chat.php` yang menerima pesan dari frontend dan meneruskannya ke Groq API menggunakan cURL.

### ✅ Acceptance Criteria
- [ ] Endpoint `api/chat.php` menerima request POST JSON `{ message, mode, history }`
- [ ] Mengirim request ke `https://api.groq.com/openai/v1/chat/completions` menggunakan cURL
- [ ] Menggunakan model `llama-3.3-70b-versatile` atau `llama-3.1-8b-instant`
- [ ] Mengembalikan respons JSON `{ reply: "...", status: "success" }`
- [ ] Menangani error jika API Key tidak valid atau koneksi terputus

---

## TASK-09 · Buat & Test System Prompt — Mode Workout
**Assignee:** `fernanda-hensem` | **Label:** `feature`, `prompt` | **Milestone:** Milestone 2 | **Status:** Backlog

### 📝 Deskripsi
Menyusun system prompt persona Personal Trainer profesional di `config/prompts.php` dan mengujinya.

### ✅ Acceptance Criteria
- [ ] System prompt mode Workout dibuat dengan instruksi keselamatan dan kustomisasi level kebugaran
- [ ] Diuji dengan minimal 5 pertanyaan workout yang bervariasi
- [ ] Hasil pengujian dicatat di `experiments/hasil/workout-prompt-test.md`

---

## TASK-10 · Buat & Test System Prompt — Mode Nutrisi
**Assignee:** `fernanda-hensem` | **Label:** `feature`, `prompt` | **Milestone:** Milestone 2 | **Status:** Backlog

### 📝 Deskripsi
Menyusun system prompt persona Ahli Gizi Olahraga untuk perhitungan kalori, BMR/TDEE, dan meal plan.

### ✅ Acceptance Criteria
- [ ] System prompt mode Nutrisi dibuat dengan batasan ilmiah dan tidak menyarankan obat terlarang
- [ ] Diuji dengan minimal 5 pertanyaan terkait kalori & pola makan
- [ ] Hasil pengujian dicatat di `experiments/hasil/nutrisi-prompt-test.md`

---

## TASK-11 · Buat & Test System Prompt — Mode Info Olahraga
**Assignee:** `ricozack97` | **Label:** `feature`, `prompt` | **Milestone:** Milestone 2 | **Status:** Backlog

### 📝 Deskripsi
Menyusun system prompt persona Komentator & Analis Olahraga Indonesia yang antusias dan memotivasi.

### ✅ Acceptance Criteria
- [ ] System prompt mencakup aturan olahraga, teknik dasar, dan motivasi atlet nasional
- [ ] Diuji dengan minimal 5 pertanyaan seputar olahraga populer (sepak bola, bulu tangkis, basket)
- [ ] Hasil pengujian dicatat di `experiments/hasil/info-prompt-test.md`

---

## TASK-12 · Buat Template Eksperimen Google Sheets
**Assignee:** `ricozack97` | **Label:** `experiment`, `documentation` | **Milestone:** Milestone 2 | **Status:** Backlog

### 📝 Deskripsi
Membuat spreadsheet Google Sheets untuk mendokumentasikan data uji eksperimen prompt engineering tim.

### ✅ Acceptance Criteria
- [ ] Kolom lengkap: Prompt, Nomor Kombinasi, Teknik Prompting, Token Input, Token Output, Deskripsi Kualitas, Tester, Mode
- [ ] Diberikan format warna pembeda per anggota tim
- [ ] Tautan spreadsheet dibagikan ke seluruh anggota dan dicantumkan di README.md

---

# 🏁 MILESTONE 3 — Eksperimen Prompt Engineering

---

## TASK-13 · Eksperimen Kombinasi 1 & 1.2 (Zero-shot)
**Assignee:** `kevinRYOJ` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji kombinasi Task description + Zero-shot dan Negative prompting pada mode Workout.

### ✅ Acceptance Criteria
- [ ] Kombinasi 1 (Zero-shot standar) dijalankan dan diukur token serta kualitasnya
- [ ] Kombinasi 1.2 (Zero-shot + batasan alat gym mahal / suplemen) dijalankan
- [ ] Data dicatat ke Google Sheets dan dianalisis perbedaannya

---

## TASK-14 · Eksperimen Kombinasi 4 & 4.2 (Action-oriented & Format)
**Assignee:** `kevinRYOJ` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji efektivitas persona, action-oriented, dan format keluaran berupa tabel pada program latihan 4 minggu.

### ✅ Acceptance Criteria
- [ ] Kombinasi 4 (Format tabel terstruktur) diuji
- [ ] Kombinasi 4.2 (Format tabel + batasan latihan berisiko cedera) diuji
- [ ] Evaluasi kerapian format output dan kepatuhan model LLaMA terhadap batasan

---

## TASK-15 · Eksperimen Kombinasi 2 & 2.2 (Action-oriented & Constraint)
**Assignee:** `fernanda-hensem` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji perhitungan kalori dan menu makanan menggunakan teknik action-oriented dengan batasan menu lokal Indonesia.

### ✅ Acceptance Criteria
- [ ] Kombinasi 2 (Perhitungan kalori langsung) dijalankan dan diverifikasi akurasi matematisnya
- [ ] Kombinasi 2.2 (Constraint: bahan makanan lokal Indonesia & tanpa suplemen mahal) dijalankan
- [ ] Data dicatat ke Google Sheets

---

## TASK-16 · Eksperimen Kombinasi 3 & 3.2 (Persona & Scope)
**Assignee:** `fernanda-hensem` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji peran Persona Pelatih Bulu Tangkis Nasional dengan dan tanpa negative prompting (membatasi strategi tim).

### ✅ Acceptance Criteria
- [ ] Kombinasi 3 (Persona pelatih nasional) diuji gaya bahasanya
- [ ] Kombinasi 3.2 (Persona + larangan membahas permainan ganda) diuji fokus bahasannya
- [ ] Data dicatat ke Google Sheets

---

## TASK-17 · Eksperimen Kombinasi 5 — Chain of Thought (CoT)
**Assignee:** `ricozack97` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji teknik penalaran bertahap (Chain of Thought / CoT) pada kasus konsultasi nutrisi & penurunan berat badan kompleks.

### ✅ Acceptance Criteria
- [ ] Prompt CoT 5 langkah (analisis, defisit kalori, meal plan, olahraga, timeline) dijalankan
- [ ] Dibandingkan penggunaan token dan kedalaman jawaban terhadap Zero-shot (TASK-13)
- [ ] Data dicatat ke Google Sheets

---

## TASK-18 · Rekap & Analisis Akhir Hasil Eksperimen
**Assignee:** `ricozack97` | **Label:** `experiment`, `documentation` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menganalisis seluruh data dari Google Sheets dan menyusun laporan kesimpulan eksperimen prompt engineering.

### ✅ Acceptance Criteria
- [ ] Tabel rangkuman seluruh 9 kombinasi tersaji lengkap
- [ ] Analisis efisiensi token vs kualitas jawaban dirumuskan
- [ ] Rekomendasi formulasi prompt terbaik untuk tiap mode dituangkan di `experiments/hasil/analisis-final.md`

---

# 🏁 MILESTONE 4 — Testing, Finalisasi & Deployment

---

## TASK-19 · Integrasi Prompt Optimal ke Konfigurasi PHP
**Assignee:** `kevinRYOJ` | **Label:** `feature`, `integration` | **Milestone:** Milestone 4 | **Status:** Backlog

### 📝 Deskripsi
Mengadopsi kombinasi prompt terbaik dari hasil analisis (TASK-18) ke dalam `config/prompts.php`.

### ✅ Acceptance Criteria
- [ ] `config/prompts.php` diperbarui dengan prompt hasil optimasi
- [ ] Chatbot diuji secara live dengan konfigurasi prompt baru
- [ ] Respons bot terbukti lebih akurat dan terstruktur

---

## TASK-20 · User Acceptance Testing (UAT 30 Skenario)
**Assignee:** `kevinRYOJ` | **Label:** `testing` | **Milestone:** Milestone 4 | **Status:** Backlog

### 📝 Deskripsi
Melakukan pengujian mutu sistem dengan 30 skenario berbeda (10 skenario per mode).

### ✅ Acceptance Criteria
- [ ] 10 skenario mode Workout, 10 skenario mode Nutrisi, 10 skenario mode Info dijalankan
- [ ] Bug atau keanehan respons dicatat sebagai Issue baru di GitHub
- [ ] Tidak ada bug kritis sebelum proyek siap dipresentasikan

---

## TASK-21 · Finalisasi Dokumentasi README.md Proyek
**Assignee:** `fernanda-hensem` | **Label:** `documentation` | **Milestone:** Milestone 4 | **Status:** Backlog

### 📝 Deskripsi
Menyempurnakan dokumentasi proyek agar orang lain dapat mereplikasi aplikasi ini dengan mudah.

### ✅ Acceptance Criteria
- [ ] Deskripsi proyek dan screenshot aplikasi terpasang
- [ ] Panduan instalasi lokal jelas (`git clone`, konfigurasi `.env`, jalankan `php -S localhost:8000`)
- [ ] Tautan ke Google Sheets eksperimen tertera
- [ ] Daftar kontributor tim lengkap

---

## TASK-22 · Deployment Web Chatbot PHP
**Assignee:** `ricozack97` | **Label:** `deployment` | **Milestone:** Milestone 4 | **Status:** Backlog

### 📝 Deskripsi
Men-deploy aplikasi PHP ke platform online agar bisa diakses publik via browser tanpa instalasi lokal.

### ✅ Acceptance Criteria
- [ ] Aplikasi live di hosting (misal: InfinityFree / Render / Railway / cPanel)
- [ ] API Key Groq terkonfigurasi dengan aman di environment hosting
- [ ] URL live ditambahkan ke `README.md` dan siap dipresentasikan

---

## 📊 Ringkasan Pembagian Tugas

| Anggota Tim | Username GitHub | Tanggung Jawab Utama | Total Task |
|---|---|---|---|
| **Kevin** (Admin) | `kevinRYOJ` | Project Management, Backend API cURL, Prompt Exp 1 & 4, UAT | **10 task** (01, 02, 03, 04, 08, 13, 14, 19, 20) |
| **Fernanda** | `fernanda-hensem` | Frontend UI (HTML/CSS/JS), Prompt Exp 2 & 3, README | **6 task** (05, 07, 09, 10, 15, 16, 21) |
| **Rico** | `ricozack97` | Prompt Ref, Exp CoT, Analisis Data Sheets, Deployment | **6 task** (06, 11, 12, 17, 18, 22) |

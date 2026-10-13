# 📋 GitHub Issues — All-in-One Sport Chatbot (PHP & Groq API)

> **Repository:** `kevinRYOJ/chatboot`  
> **Tech Stack:** PHP (Native Modern) + Groq API (`llama-3.3-70b-versatile`)  
> **Tim:**  
> - 👑 Kevin (`kevinRYOJ`) — Project Manager & Lead Backend (10 Task)  
> - 👤 Fernanda (`fernanda-hensem`) — Frontend & Feature Developer (7 Task)  
> - 👤 Rico (`ricozack97`) — Prompt Engineer & QA (8 Task)  
> **Total:** 25 Task | 4 Milestone | 28 Kombinasi Eksperimen Lengkap

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
- [ ] Semua task sudah masuk ke board
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
Mempelajari teknik-teknik prompt engineering (Zero-shot, Negative, Action-oriented, CoT, ToT, Few-shot, Tool-based) yang akan diuji coba pada Milestone 3.

### ✅ Acceptance Criteria
- [ ] Teknik-teknik dipahami dan dirangkum
- [ ] File `docs/prompt-engineering-ref.md` dibuat dengan contoh kasus olahraga
- [ ] Disediakan acuan tabel 28 kombinasi dosen

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
- [ ] Mengirim request ke endpoint Groq `https://api.groq.com/openai/v1/chat/completions` menggunakan cURL
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
Membuat spreadsheet Google Sheets untuk mendokumentasikan data uji eksperimen prompt engineering tim (28 kombinasi).

### ✅ Acceptance Criteria
- [ ] Kolom lengkap: Prompt, Nomor Kombinasi, Teknik Prompting, Token Input, Token Output, Deskripsi Kualitas, Tester, Mode
- [ ] Diberikan format warna pembeda per anggota tim (Kevin: Biru, Fernanda: Hijau, Rico: Kuning)
- [ ] Tautan spreadsheet dibagikan ke seluruh anggota dan dicantumkan di README.md

---

# 🏁 MILESTONE 3 — Eksperimen Prompt Engineering (28 Kombinasi)

---

## TASK-13 · Eksperimen Prompt Batch 1 (Kombinasi 1 s/d 2.2)
**Assignee:** `kevinRYOJ` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji 4 kombinasi dasar:
- Kombinasi 1: Task description + Zero-shot
- Kombinasi 1.2: Task description + Zero-shot + Negative
- Kombinasi 2: Task description + Action-oriented
- Kombinasi 2.2: Task description + Constraints + Action-oriented

### ✅ Acceptance Criteria
- [ ] 4 prompt dijalankan di Chatbot / Playground Groq
- [ ] Token input, token output, dan evaluasi kualitas dicatat di Google Sheets
- [ ] Evaluasi perbedaan efek negative prompting dan batasan constraint

---

## TASK-14 · Eksperimen Prompt Batch 2 (Kombinasi 3 s/d 4.2)
**Assignee:** `kevinRYOJ` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji peran Persona dan Response Format:
- Kombinasi 3: Persona Pelatih + Zero-shot
- Kombinasi 3.2: Persona Pelatih + Zero-shot + Negative
- Kombinasi 4: Persona PT + Action-oriented + Format Tabel
- Kombinasi 4.2: Persona PT + Action-oriented + Format Tabel + Negative

### ✅ Acceptance Criteria
- [ ] 4 prompt dijalankan dan dievaluasi
- [ ] Kerapian format tabel output diverifikasi
- [ ] Data dicatat ke Google Sheets

---

## TASK-15 · Eksperimen Prompt Batch 3 (Kombinasi 5 & 5.2)
**Assignee:** `kevinRYOJ` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji penalaran bertahap Chain of Thought (CoT) dengan input data/konteks kasus atlet maraton dan atlet angkat besi.

### ✅ Acceptance Criteria
- [ ] Kombinasi 5 (CoT + Input data) dijalankan
- [ ] Kombinasi 5.2 (CoT + Input data + Negative) dijalankan
- [ ] Perbandingan kedalaman langkah analisis dan token output dicatat ke Google Sheets

---

## TASK-16 · Eksperimen Prompt Batch 4 (Kombinasi 6 s/d 7.2)
**Assignee:** `fernanda-hensem` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji Tree of Thought (ToT) eksplorasi 3 cabang latihan dan Single-shot prompting taktik sepak bola:
- Kombinasi 6: ToT 3 cabang latihan lutut
- Kombinasi 6.2: ToT 3 cabang + Negative prompting
- Kombinasi 7: Single-shot motivasi tanding
- Kombinasi 7.2: Single-shot + Constraint taktik bertahan

### ✅ Acceptance Criteria
- [ ] 4 prompt dijalankan dan dievaluasi
- [ ] Efektivitas penalaran bercabang (ToT) dicatat
- [ ] Data dicatat ke Google Sheets

---

## TASK-17 · Eksperimen Prompt Batch 5 (Kombinasi 8 s/d 9.2)
**Assignee:** `fernanda-hensem` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji Few-shot prompting dan Tool-based prompting (simulasi fungsi kalkulator kalori dan query statistik pertandingan):
- Kombinasi 8: Few-shot snack pre-workout
- Kombinasi 8.2: Few-shot klasifikasi nutrisi format JSON
- Kombinasi 9: Tool-based BMR/TDEE calculator
- Kombinasi 9.2: Tool-based statistik pertandingan sepak bola

### ✅ Acceptance Criteria
- [ ] 4 prompt dijalankan dan diverifikasi kepatuhan format JSON dan tool-calling
- [ ] Data dicatat ke Google Sheets

---

## TASK-18 · Eksperimen Prompt Batch 6 (Kombinasi 10 & 10.2)
**Assignee:** `fernanda-hensem` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji multi-teknik prompting (kombinasi Zero, Single, Few-shot, Action-oriented, dan Negative) pada variasi push-up dan panduan peregangan sprint.

### ✅ Acceptance Criteria
- [ ] Kombinasi 10 (Variasi push-up dada atas) dijalankan
- [ ] Kombinasi 10.2 (Peregangan dinamis sprint + instruksi) dijalankan
- [ ] Data dicatat ke Google Sheets

---

## TASK-19 · Eksperimen Prompt Batch 7 (Kombinasi 11 s/d 12.2)
**Assignee:** `ricozack97` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji integrasi Tool-based dengan Chain of Thought (CoT) pada kasus nutrisi dan analisis formasi sepak bola/futsal:
- Kombinasi 11: Tool nutrisi tempe + CoT
- Kombinasi 11.2: Tool defisit kalori + CoT + Constraints
- Kombinasi 12: Tool taktik formasi 3-5-2 + CoT
- Kombinasi 12.2: Tool powerplay futsal + CoT + Konteks

### ✅ Acceptance Criteria
- [ ] 4 prompt diuji secara komprehensif
- [ ] Analisis konsistensi logika perhitungan dicatat ke Google Sheets

---

## TASK-20 · Eksperimen Prompt Batch 8 (Kombinasi 13 s/d 14.2)
**Assignee:** `ricozack97` | **Label:** `experiment` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Menguji prompt tingkat lanjut paling kompleks:
- Kombinasi 13: Full Multi-tech + ToT + CoT periodisasi latihan
- Kombinasi 13.2: Full Multi-tech + ToT + CoT metode recovery maraton
- Kombinasi 14: 6-Elemen Struktur Lengkap + CoT perenang olimpiade
- Kombinasi 14.2: 6-Elemen Struktur Lengkap + CoT + Strict Negative Prompting

### ✅ Acceptance Criteria
- [ ] 4 prompt tingkat lanjut dijalankan
- [ ] Evaluasi kelengkapan respon dan kepatuhan batasan anti-doping
- [ ] Data dicatat ke Google Sheets

---

## TASK-21 · Rekapitulasi & Analisis Akhir 28 Eksperimen
**Assignee:** `ricozack97` | **Label:** `experiment`, `documentation` | **Milestone:** Milestone 3 | **Status:** Backlog

### 📝 Deskripsi
Mengumpulkan data seluruh 28 kombinasi dari Google Sheets, membandingkan efisiensi token vs kualitas, dan menyusun laporan kesimpulan di `experiments/hasil/analisis-final.md`.

### ✅ Acceptance Criteria
- [ ] Tabel rekapitulasi 28 kombinasi terisi lengkap
- [ ] Grafik komparatif rating dan token dibuat
- [ ] Formulasi prompt terbaik per mode dirumuskan untuk diimplementasikan ke chatbot

---

# 🏁 MILESTONE 4 — Testing, Finalisasi & Deployment

---

## TASK-22 · Integrasi Prompt Optimal ke Konfigurasi PHP
**Assignee:** `kevinRYOJ` | **Label:** `feature`, `integration` | **Milestone:** Milestone 4 | **Status:** Backlog

### 📝 Deskripsi
Mengadopsi kombinasi prompt terbaik hasil riset Milestone 3 ke dalam file `config/prompts.php`.

### ✅ Acceptance Criteria
- [ ] `config/prompts.php` diupdate dengan formulasi prompt optimal
- [ ] Mode Workout, Nutrisi, dan Info Olahraga menghasilkan jawaban yang jauh lebih presisi
- [ ] Kode di-commit dan di-push ke branch `develop`

---

## TASK-23 · User Acceptance Testing (UAT 30 Skenario)
**Assignee:** `kevinRYOJ` | **Label:** `testing` | **Milestone:** Milestone 4 | **Status:** Backlog

### 📝 Deskripsi
Melakukan pengujian mutu sistem menyeluruh dengan 30 skenario uji (10 skenario per mode).

### ✅ Acceptance Criteria
- [ ] 10 skenario Workout, 10 skenario Nutrisi, 10 skenario Info Olahraga dijalankan
- [ ] Bug dicatat dan diperbaiki
- [ ] Semua fungsi chat, reset, ganti mode, dan respons berjalan normal

---

## TASK-24 · Finalisasi Dokumentasi README.md Proyek
**Assignee:** `fernanda-hensem` | **Label:** `documentation` | **Milestone:** Milestone 4 | **Status:** Backlog

### 📝 Deskripsi
Menyempurnakan dokumentasi proyek agar orang lain dapat mereplikasi aplikasi ini dengan mudah.

### ✅ Acceptance Criteria
- [ ] Screenshot aplikasi chat dipasang
- [ ] Panduan instalasi lokal jelas (`php -S localhost:8000`)
- [ ] Link Google Sheets 28 eksperimen dicantumkan
- [ ] Kredit kontribusi tim lengkap

---

## TASK-25 · Deployment Web Chatbot PHP
**Assignee:** `ricozack97` | **Label:** `deployment` | **Milestone:** Milestone 4 | **Status:** Backlog

### 📝 Deskripsi
Men-deploy aplikasi PHP ke platform online agar bisa diakses publik via browser tanpa instalasi lokal.

### ✅ Acceptance Criteria
- [ ] Aplikasi live di hosting (InfinityFree / Render / Railway / cPanel)
- [ ] API Key Groq terkonfigurasi dengan aman di environment hosting
- [ ] URL live ditambahkan ke `README.md` dan siap dipresentasikan

---

## 📊 Ringkasan Pembagian Tugas Akhir

| Anggota Tim | Username | Tanggung Jawab Utama | Task ID | Total Task |
|---|---|---|---|---|
| 👑 **Kevin** | `kevinRYOJ` | Project Lead, Backend API, Exp Kombinasi 1 s/d 5.2, UAT | 01, 02, 03, 04, 08, 13, 14, 15, 22, 23 | **10 Task** |
| 👤 **Fernanda** | `fernanda-hensem` | Frontend UI, Exp Kombinasi 6 s/d 10, Dokumentasi README | 05, 07, 09, 10, 16, 17, 18, 24 | **8 Task** |
| 👤 **Rico** | `ricozack97` | Prompt Ref, Exp Kombinasi 10.2 s/d 14.2, Analisis Final, Deploy | 06, 11, 12, 19, 20, 21, 25 | **7 Task** |
| **TOTAL** | | **Semua 4 Milestone & 28 Kombinasi Eksperimen** | **TASK 01 s/d 25** | **25 Task** |

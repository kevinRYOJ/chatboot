# 📋 GitHub Issues — All-in-One Sport Chatbot
> Copy-paste tiap task ini langsung ke GitHub Issues  
> **Tim:** Kevin (Admin) · Teman 1 · Teman 2  
> **Total:** 22 Task | 4 Milestone | 3 Anggota

---

# 🏁 MILESTONE 1 — Setup & Persiapan Proyek

---

## TASK-01 · Inisialisasi Repository GitHub
**Assignee:** Kevin | **Label:** `setup` `admin` | **Status:** Backlog

### 📝 Deskripsi
Membuat repository GitHub sebagai pusat kolaborasi tim untuk proyek All-in-One Sport Chatbot.

### ✅ Acceptance Criteria
- [ ] Repository `sport-chatbot` sudah ada di GitHub
- [ ] Branch `main` dan `develop` sudah dibuat
- [ ] File `README.md`, `.gitignore`, `LICENSE` sudah ada
- [ ] Teman 1 dan Teman 2 sudah bisa push ke repo

### 📌 Langkah-langkah
1. Buka https://github.com/new
2. Repository name: `sport-chatbot`
3. Visibility: **Public**
4. Centang: ✅ Add a README file
5. Add .gitignore: pilih **Python**
6. License: **MIT License**
7. Klik **Create repository**
8. Di tab **Settings → Collaborators**, undang Teman 1 & Teman 2
9. Buat branch `develop`:
   ```bash
   git checkout -b develop
   git push origin develop
   ```

### 📎 Catatan
- Semua development dilakukan di branch `develop`
- Merge ke `main` hanya saat milestone selesai

---

## TASK-02 · Setup GitHub Project Board
**Assignee:** Kevin | **Label:** `setup` `admin` | **Status:** Backlog

### 📝 Deskripsi
Mengatur GitHub Projects agar tim bisa tracking progress secara visual.

### ✅ Acceptance Criteria
- [ ] Board punya kolom: Backlog / Ready / In Progress / In Review / Done
- [ ] Semua 22 task sudah masuk ke board
- [ ] Setiap task sudah ada: assignee, label, milestone
- [ ] 4 Milestone sudah dibuat dengan deadline

### 📌 Langkah-langkah
1. Buka tab **Projects** di repository
2. Klik **New Project** → pilih **Board**
3. Buat kolom: 🟢 Backlog → 🔵 Ready → 🟡 In Progress → 🟠 In Review → ✅ Done
4. Buat 4 Milestone di **Issues → Milestones**:
   - M1: Setup & Persiapan (due: Minggu 1)
   - M2: Core Features (due: Minggu 2)
   - M3: Eksperimen Prompt (due: Minggu 3)
   - M4: Testing & Deploy (due: Minggu 4)
5. Tambahkan semua task dari dokumen ini sebagai Issues

---

## TASK-03 · Buat Struktur Folder Proyek
**Assignee:** Kevin | **Label:** `setup` | **Status:** Backlog

### 📝 Deskripsi
Menyiapkan struktur folder standar agar semua anggota tim bekerja di tempat yang sama.

### ✅ Acceptance Criteria
- [ ] Semua folder sudah ada di repository
- [ ] File placeholder (`.gitkeep`) ada di folder kosong
- [ ] Struktur sudah di-push ke branch `develop`

### 📌 Langkah-langkah
```bash
git clone https://github.com/kevinRYOJ/sport-chatbot.git
cd sport-chatbot
git checkout develop

mkdir docs experiments experiments/hasil assets

echo "" > app.py
echo "GEMINI_API_KEY=your_api_key_here" > .env.example
touch experiments/hasil/.gitkeep
touch assets/.gitkeep

git add .
git commit -m "feat: initialize project structure"
git push origin develop
```

### 🗂️ Hasil Akhir Struktur
```
sport-chatbot/
├── app.py
├── .env.example
├── .env                    ← JANGAN di-push! Ada di .gitignore
├── requirements.txt
├── README.md
├── docs/
│   ├── arsitektur.md
│   ├── prompt-engineering-ref.md
│   └── GITHUB_ISSUES.md
├── experiments/
│   ├── TEMPLATE_EKSPERIMEN.md
│   └── hasil/
│       ├── workout-prompt-test.md
│       ├── nutrisi-prompt-test.md
│       ├── info-prompt-test.md
│       └── analisis-final.md
└── assets/
```

---

## TASK-04 · Dokumentasi Arsitektur Sistem
**Assignee:** Kevin | **Label:** `documentation` | **Status:** Backlog

### 📝 Deskripsi
Membuat dokumentasi arsitektur yang bisa dipahami siapapun yang ingin mereplikasi proyek ini.

### ✅ Acceptance Criteria
- [ ] File `docs/arsitektur.md` sudah lengkap
- [ ] Terdapat diagram alur sistem
- [ ] Semua komponen dijelaskan dengan bahasa sederhana

### 📎 Catatan
Lihat file `docs/arsitektur.md` yang sudah disediakan sebagai template.

---

## TASK-05 · Setup Environment & Dependencies
**Assignee:** Teman 1 | **Label:** `setup` | **Status:** Backlog

### 📝 Deskripsi
Menyiapkan semua library yang dibutuhkan dan memastikan environment berjalan di semua komputer.

### ✅ Acceptance Criteria
- [ ] File `requirements.txt` sudah ada dan lengkap
- [ ] File `.env.example` sudah ada
- [ ] Sudah di-test install di komputer lokal
- [ ] Tidak ada error saat jalankan `streamlit run app.py`

### 📌 Langkah-langkah
1. Buat `requirements.txt`:
```
streamlit>=1.28.0
google-generativeai>=0.3.1
python-dotenv>=1.0.0
```

2. Test install:
```bash
pip install -r requirements.txt
```

3. Pastikan `.env` ada di `.gitignore`:
```
.env
__pycache__/
*.pyc
```

### ⚠️ Penting
> Jangan pernah push file `.env` ke GitHub! API key harus tetap rahasia.

---

## TASK-06 · Riset & Kumpulkan Referensi Prompt Engineering
**Assignee:** Teman 2 | **Label:** `research` | **Status:** Backlog

### 📝 Deskripsi
Memahami 5 teknik prompt engineering yang akan dieksperimenkan di Milestone 3.

### ✅ Acceptance Criteria
- [ ] 5 teknik prompting sudah dipahami dan dirangkum
- [ ] File `docs/prompt-engineering-ref.md` sudah dibuat
- [ ] Minimal 1 contoh prompt olahraga untuk tiap teknik

### 📌 5 Teknik yang Dipelajari

| Teknik | Deskripsi | Contoh Olahraga |
|--------|-----------|-----------------|
| Zero-shot | Langsung tanya tanpa contoh | "Jelaskan cara squat yang benar." |
| Negative | Tambahkan larangan/batasan | "Jelaskan diet atlet. Jangan sebut suplemen berbayar." |
| Action-oriented | Mulai dengan kata kerja aktif | "Buat program latihan 30 hari untuk pemula." |
| Chain of Thought | Minta AI berpikir step-by-step | "Pikirkan langkah demi langkah: analisis kondisi user, lalu..." |
| Few-shot | Berikan 2-3 contoh sebelum pertanyaan | "Q: Program pemula? A:[contoh]. Q: Program lanjut?" |

---

# 🏁 MILESTONE 2 — Pengembangan Chatbot (Core Features)

---

## TASK-07 · Buat Main App & UI Layout (Streamlit)
**Assignee:** Kevin | **Label:** `feature` `frontend` | **Status:** Backlog

### 📝 Deskripsi
Membuat tampilan utama chatbot menggunakan Streamlit.

### ✅ Acceptance Criteria
- [ ] App bisa dijalankan dengan `streamlit run app.py`
- [ ] Ada sidebar dengan pilihan 3 mode
- [ ] Ada area chat yang menampilkan history percakapan
- [ ] Ada tombol Reset Chat
- [ ] Tampilan rapi dan mudah digunakan

### 📎 Catatan
Lihat file `app.py` yang sudah disediakan sebagai starter code.

---

## TASK-08 · Integrasi Gemini API
**Assignee:** Kevin | **Label:** `feature` `backend` | **Status:** Backlog

### 📝 Deskripsi
Menghubungkan app Streamlit dengan Gemini API sehingga chatbot bisa menjawab pertanyaan.

### ✅ Acceptance Criteria
- [ ] Chatbot bisa menjawab pertanyaan dari user
- [ ] Setiap mode punya persona berbeda
- [ ] History percakapan terkirim ke Gemini (kontekstual)
- [ ] Error handling jika API key salah

### 📌 Cara Dapat API Key Gratis
1. Buka https://aistudio.google.com
2. Login dengan akun Google
3. Klik **Get API Key → Create API Key**
4. Paste ke file `.env`: `GEMINI_API_KEY=AIza...`

---

## TASK-09 · Buat & Test System Prompt — Mode Workout
**Assignee:** Teman 1 | **Label:** `feature` `prompt` | **Status:** Backlog

### 📝 Deskripsi
Membuat dan mengoptimalkan system prompt untuk mode Workout.

### ✅ Acceptance Criteria
- [ ] System prompt sudah dibuat
- [ ] Diuji dengan 5 pertanyaan berbeda
- [ ] Jawaban relevan, aman, dan memotivasi
- [ ] Hasil test didokumentasikan di `experiments/hasil/workout-prompt-test.md`

### 📌 5 Pertanyaan untuk Testing
1. "Aku mau sixpack, harus mulai dari mana?"
2. "Workout apa yang cocok untuk pemula yang mau turun 10kg?"
3. "Aku tidak punya gym, bisa olahraga di rumah?"
4. "Berapa kali seminggu sebaiknya olahraga untuk pemula?"
5. "Otot saya sering nyeri setelah latihan, normal tidak?"

---

## TASK-10 · Buat & Test System Prompt — Mode Nutrisi
**Assignee:** Teman 1 | **Label:** `feature` `prompt` | **Status:** Backlog

### 📝 Deskripsi
Membuat system prompt untuk mode Nutrisi agar chatbot bisa memberikan saran gizi akurat.

### ✅ Acceptance Criteria
- [ ] System prompt sudah dibuat
- [ ] Bisa menghitung kalori (BMR/TDEE)
- [ ] Diuji dengan 5 pertanyaan berbeda
- [ ] Hasil test di `experiments/hasil/nutrisi-prompt-test.md`

### 📌 5 Pertanyaan untuk Testing
1. "Aku 70kg, 170cm, 22 tahun. Berapa kalori per hari?"
2. "Makanan apa yang bagus dimakan sebelum olahraga?"
3. "Aku vegetarian tapi mau bangun otot, bisa tidak?"
4. "Apa itu defisit kalori dan gimana caranya?"
5. "Berapa gram protein per hari untuk muscle gain?"

---

## TASK-11 · Buat & Test System Prompt — Mode Info Olahraga
**Assignee:** Teman 2 | **Label:** `feature` `prompt` | **Status:** Backlog

### 📝 Deskripsi
Membuat system prompt untuk mode Info Olahraga yang fokus pada informasi dan motivasi.

### ✅ Acceptance Criteria
- [ ] System prompt sudah dibuat
- [ ] Fokus pada olahraga populer Indonesia
- [ ] Diuji dengan 5 pertanyaan berbeda
- [ ] Hasil test di `experiments/hasil/info-prompt-test.md`

### 📌 5 Pertanyaan untuk Testing
1. "Teknik dasar apa yang harus dikuasai pemain bulu tangkis pemula?"
2. "Apa perbedaan formasi 4-3-3 dan 4-4-2 dalam sepak bola?"
3. "Aku ingin mulai olahraga tapi tidak tahu pilih yang mana, rekomendasikan!"
4. "Bagaimana cara meningkatkan mental sebelum pertandingan?"
5. "Siapa atlet Indonesia yang bisa jadi inspirasi untuk generasi muda?"

---

## TASK-12 · Buat Template Eksperimen Google Sheets
**Assignee:** Teman 2 | **Label:** `experiment` `documentation` | **Status:** Backlog

### 📝 Deskripsi
Membuat template Google Sheets untuk mencatat semua hasil eksperimen prompt engineering.

### ✅ Acceptance Criteria
- [ ] Google Sheets sudah dibuat dan bisa diakses tim
- [ ] Semua kolom sudah ada dan diberi warna
- [ ] Contoh data sudah diisi di 1 baris
- [ ] Link Sheets sudah dishare ke Kevin dan Teman 1
- [ ] Link disimpan di README.md

### 📌 Struktur Kolom Google Sheets

| Kolom | Nama | Keterangan |
|-------|------|-----------|
| A | Prompt | Teks prompt yang diujikan |
| B | Nomor Kombinasi | 1 / 1.2 / 2 / 2.2 / 3 / 3.2 / 4 / 4.2 / 5 |
| C | Jenis Prompt Engineering | Zero-shot / Negative / Action-oriented / CoT |
| D | Jumlah Token Input | Estimasi: jumlah kata × 1.3 |
| E | Jumlah Token Output | Estimasi: jumlah kata jawaban × 1.3 |
| F | Deskripsi Kualitas Hasil | Sangat Baik / Baik / Cukup / Kurang + alasan |
| G | Assignee | Kevin / Teman 1 / Teman 2 |
| H | Mode Chatbot | Workout / Nutrisi / Info |

**Warna baris:** 🟦 Kevin · 🟩 Teman 1 · 🟨 Teman 2

---

# 🏁 MILESTONE 3 — Eksperimen Prompt Engineering

---

## TASK-13 · Eksperimen Kombinasi 1 & 1.2 (Zero-shot)
**Assignee:** Kevin | **Label:** `experiment` | **Status:** Backlog

### 📝 Deskripsi
Menguji kombinasi Task description + Zero-shot / Negative prompting pada mode Workout.

### ✅ Acceptance Criteria
- [ ] 2 prompt sudah dijalankan di chatbot
- [ ] Token input & output sudah dihitung
- [ ] Hasil sudah dicatat di Google Sheets
- [ ] Evaluasi kualitas sudah ditulis
- [ ] Perbandingan Kombinasi 1 vs 1.2 sudah dibuat

### 📌 Lihat detail prompt di `experiments/TEMPLATE_EKSPERIMEN.md` bagian Kombinasi 1 & 1.2

---

## TASK-14 · Eksperimen Kombinasi 4 & 4.2 (Action-oriented + Format)
**Assignee:** Kevin | **Label:** `experiment` | **Status:** Backlog

### ✅ Acceptance Criteria
- [ ] 2 prompt sudah dijalankan
- [ ] Evaluasi apakah format tabel berhasil diikuti Gemini
- [ ] Evaluasi apakah negative prompting mengubah isi jawaban
- [ ] Hasil dicatat di Google Sheets

### 📌 Lihat detail prompt di `experiments/TEMPLATE_EKSPERIMEN.md` bagian Kombinasi 4 & 4.2

---

## TASK-15 · Eksperimen Kombinasi 2 & 2.2 (Action-oriented)
**Assignee:** Teman 1 | **Label:** `experiment` | **Status:** Backlog

### ✅ Acceptance Criteria
- [ ] 2 prompt sudah dijalankan pada mode Nutrisi
- [ ] Evaluasi akurasi perhitungan kalori
- [ ] Evaluasi apakah constraint "makanan Indonesia" berhasil
- [ ] Hasil dicatat di Google Sheets

### 📌 Lihat detail prompt di `experiments/TEMPLATE_EKSPERIMEN.md` bagian Kombinasi 2 & 2.2

---

## TASK-16 · Eksperimen Kombinasi 3 & 3.2 (Persona + Zero-shot)
**Assignee:** Teman 1 | **Label:** `experiment` | **Status:** Backlog

### ✅ Acceptance Criteria
- [ ] 2 prompt sudah dijalankan pada mode Info Olahraga
- [ ] Evaluasi apakah persona mengubah gaya bahasa jawaban
- [ ] Evaluasi apakah negative prompting berhasil batasi topik
- [ ] Hasil dicatat di Google Sheets

### 📌 Lihat detail prompt di `experiments/TEMPLATE_EKSPERIMEN.md` bagian Kombinasi 3 & 3.2

---

## TASK-17 · Eksperimen Kombinasi 5 — Chain of Thought (CoT)
**Assignee:** Teman 2 | **Label:** `experiment` | **Status:** Backlog

### 📝 Deskripsi
Chain of Thought adalah teknik meminta AI berpikir langkah demi langkah. Ini biasanya menghasilkan jawaban paling komprehensif tapi menggunakan token paling banyak.

### ✅ Acceptance Criteria
- [ ] Prompt CoT sudah dijalankan pada mode Nutrisi
- [ ] Bandingkan dengan hasil Zero-shot dari TASK-13
- [ ] Hitung selisih token output CoT vs Zero-shot
- [ ] Evaluasi: apakah kualitas CoT sebanding dengan tokennya?
- [ ] Hasil dicatat di Google Sheets

### 📌 Lihat detail prompt di `experiments/TEMPLATE_EKSPERIMEN.md` bagian Kombinasi 5

---

## TASK-18 · Rekap & Analisis Hasil Eksperimen
**Assignee:** Teman 2 | **Label:** `experiment` `documentation` | **Status:** Backlog

### 📝 Deskripsi
Menganalisis semua hasil eksperimen dan memberikan rekomendasi prompt terbaik untuk setiap mode.

### ✅ Acceptance Criteria
- [ ] Semua data dari Google Sheets sudah terkumpul
- [ ] Ada tabel perbandingan semua kombinasi
- [ ] Ada rekomendasi prompt terbaik per mode chatbot
- [ ] File `experiments/hasil/analisis-final.md` sudah diisi lengkap

### 📌 Lihat template di `experiments/hasil/analisis-final.md`

---

# 🏁 MILESTONE 4 — Testing, Finalisasi & Dokumentasi

---

## TASK-19 · Integrasi System Prompt Terbaik ke App
**Assignee:** Kevin | **Label:** `feature` `integration` | **Status:** Backlog

### 📝 Deskripsi
Menggunakan hasil eksperimen (TASK-18) untuk upgrade system prompt di `app.py`.

### ✅ Acceptance Criteria
- [ ] System prompt di `app.py` sudah diperbarui berdasarkan hasil eksperimen
- [ ] Semua 3 mode berjalan dengan prompt optimal
- [ ] Di-test end-to-end, tidak ada error
- [ ] Commit: `feat: integrate optimized prompts from experiments`

---

## TASK-20 · User Acceptance Testing (UAT)
**Assignee:** Kevin | **Label:** `testing` | **Status:** Backlog

### 📝 Deskripsi
Melakukan pengujian menyeluruh 30 skenario sebelum app di-deploy.

### ✅ Acceptance Criteria
- [ ] 10 skenario test per mode dijalankan (30 total)
- [ ] Semua bug dilaporkan sebagai GitHub Issues
- [ ] Semua bug critical diperbaiki sebelum deploy

### 📌 Skenario Test (per mode, lakukan untuk Workout/Nutrisi/Info)
1. Pertanyaan umum/normal
2. Minta program/rekomendasi spesifik
3. Tanya hal yang tidak relevan (uji ketahanan)
4. Bahasa campur Indonesia-Inggris
5. Pertanyaan sangat panjang (>100 kata)
6. Pertanyaan sangat pendek (1-2 kata)
7. Reset chat, lanjut percakapan baru
8. Ganti mode di tengah percakapan
9. Pertanyaan follow-up (uji konteks/memori)
10. Input karakter aneh atau simbol

### 📌 Format Laporan Bug (buat sebagai GitHub Issue baru)
```
Judul: [BUG] deskripsi singkat
Mode: Workout / Nutrisi / Info
Langkah reproduksi:
  1. ...
  2. ...
Hasil yang diharapkan: ...
Hasil yang terjadi: ...
Screenshot: [jika ada]
Severity: Critical / Major / Minor
```

---

## TASK-21 · Finalisasi README.md
**Assignee:** Teman 1 | **Label:** `documentation` | **Status:** Backlog

### 📝 Deskripsi
Membuat README final yang lengkap agar siapapun bisa mereplikasi proyek ini.

### ✅ Acceptance Criteria
- [ ] README bisa dipahami orang yang belum kenal proyek ini
- [ ] Ada instruksi instalasi yang jelas dan bisa diikuti
- [ ] Ada screenshot tampilan chatbot
- [ ] Ada link ke Google Sheets eksperimen
- [ ] Ada kredit tim

### 📎 Catatan
Update file `README.md` yang sudah ada dengan konten final.

---

## TASK-22 · Deploy ke Streamlit Cloud
**Assignee:** Teman 2 | **Label:** `deployment` | **Status:** Backlog

### 📝 Deskripsi
Men-deploy aplikasi ke Streamlit Cloud agar bisa diakses publik.

### ✅ Acceptance Criteria
- [ ] App live dan bisa diakses via URL publik
- [ ] API Key di-set di Streamlit Secrets (bukan hardcode)
- [ ] URL deploy ditambahkan ke README.md
- [ ] App berjalan normal di cloud tanpa error

### 📌 Langkah Deploy
1. Pastikan semua kode sudah di branch `main`
2. Buka https://share.streamlit.io → Login GitHub
3. **New app** → pilih repo `sport-chatbot`, branch `main`, file `app.py`
4. **Advanced settings → Secrets**:
   ```toml
   GEMINI_API_KEY = "AIza..."
   ```
5. Klik **Deploy!** → tunggu live → copy URL ke README.md

### ⚠️ Penting
> JANGAN hardcode API key di `app.py`. Selalu gunakan Streamlit Secrets.

---

## 📊 Ringkasan

| Anggota | Task | Total |
|---------|------|-------|
| 👑 Kevin | 01, 02, 03, 04, 07, 08, 13, 14, 19, 20 | 10 task |
| 👤 Teman 1 | 05, 09, 10, 15, 16, 21 | 6 task |
| 👤 Teman 2 | 06, 11, 12, 17, 18, 22 | 6 task |
| **TOTAL** | | **22 task** |

### Label GitHub

| Label | Hex | Keterangan |
|-------|-----|-----------|
| `setup` | `#0075ca` | Task persiapan awal |
| `feature` | `#0e8a16` | Pengembangan fitur |
| `experiment` | `#e4e669` | Eksperimen prompt |
| `documentation` | `#cfd3d7` | Penulisan dokumentasi |
| `testing` | `#d93f0b` | Testing & QA |
| `deployment` | `#6f42c1` | Deploy aplikasi |
| `admin` | `#333333` | Khusus admin |
| `research` | `#54aeff` | Riset & referensi |
| `prompt` | `#f9d0c4` | Pembuatan prompt |

# 🏋️ Sport AI Chatbot

> Chatbot olahraga berbasis AI powered by Google Gemini.  
> Membantu workout, nutrisi, dan info olahraga dalam satu aplikasi.

---

## ✨ Fitur
- 💪 **Mode Workout** — Program latihan & tips gym personal
- 🍎 **Mode Nutrisi** — Hitung kalori, meal plan, diet olahraga
- ⚽ **Mode Info Olahraga** — Teknik, motivasi, info cabang olahraga

---

## 🚀 Cara Install & Jalankan

### 1. Clone Repository
```bash
git clone https://github.com/kevinRYOJ/sport-chatbot.git
cd sport-chatbot
```

### 2. Install Dependencies
```bash
pip install -r requirements.txt
```

### 3. Setup API Key
```bash
cp .env.example .env
```
Edit file `.env`, isi `GEMINI_API_KEY` dengan API key kamu.  
Dapatkan API Key **gratis** di: https://aistudio.google.com/

### 4. Jalankan App
```bash
streamlit run app.py
```

---

## 🧪 Eksperimen Prompt Engineering
Link Google Sheets: [akan diisi setelah TASK-12]

Lihat dokumentasi eksperimen di:
- `experiments/TEMPLATE_EKSPERIMEN.md` — Panduan & semua prompt
- `experiments/hasil/` — Hasil test tiap mode
- `experiments/hasil/analisis-final.md` — Analisis & rekomendasi

---

## 📁 Struktur Proyek
```
sport-chatbot/
├── app.py                        ← File utama chatbot
├── .env.example                  ← Template API key
├── requirements.txt              ← Daftar library
├── docs/
│   ├── GITHUB_ISSUES.md         ← Daftar semua task GitHub
│   ├── arsitektur.md            ← Dokumentasi arsitektur
│   └── prompt-engineering-ref.md ← Referensi teknik prompting
└── experiments/
    ├── TEMPLATE_EKSPERIMEN.md   ← Panduan eksperimen lengkap
    └── hasil/
        ├── workout-prompt-test.md
        ├── nutrisi-prompt-test.md
        ├── info-prompt-test.md
        └── analisis-final.md
```

---

## 👥 Tim
| Nama | Role | Task |
|------|------|------|
| Kevin | Admin & Lead Developer | TASK 01,02,03,04,07,08,13,14,19,20 |
| Teman 1 | Feature Developer | TASK 05,09,10,15,16,21 |
| Teman 2 | Prompt Engineer & QA | TASK 06,11,12,17,18,22 |

---

## 🔗 Links
- GitHub Project Board: https://github.com/kevinRYOJ/sport-chatbot/projects
- Live Demo: [akan diisi setelah TASK-22]
- Google Sheets Eksperimen: [akan diisi setelah TASK-12]
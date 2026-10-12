# 📊 Analisis Final Hasil Eksperimen Prompt Engineering
## All-in-One Sport Chatbot (PHP & Groq API)

> **Dokumentasi Hasil Uji Coba 28 Kombinasi Prompt Engineering**  
> **Tester:** Kevin (`kevinRYOJ`), Fernanda (`fernanda-hensem`), Rico (`ricozack97`)  
> **LLM Engine:** Groq API (`llama-3.3-70b-versatile` / `llama-3.1-8b-instant`)

---

## 1. Tabel Rekapitulasi Lengkap (28 Kombinasi)

| No | Kombinasi | Skema | Teknik Utama | Mode | Tester | Token In | Token Out | Rating Kualitas (1-5) |
|---|---|---|---|---|---|---|---|---|
| 1 | **1** | 1 A + 1 B | Zero-shot | Workout | Kevin | ... | ... | ... |
| 2 | **1.2** | 1 A + 2 B | Zero-shot + Negative | Workout | Kevin | ... | ... | ... |
| 3 | **2** | 1 B + 1 A | Action-oriented | Nutrisi | Kevin | ... | ... | ... |
| 4 | **2.2** | 1 B + 2 A | Action-oriented + Constraints | Nutrisi | Kevin | ... | ... | ... |
| 5 | **3** | 2 A + 1 B | Persona + Zero-shot | Info | Kevin | ... | ... | ... |
| 6 | **3.2** | 2 A + 2 B | Persona + Zero-shot + Negative | Info | Kevin | ... | ... | ... |
| 7 | **4** | 3 A + 1 B | Persona + Format + Action | Workout | Kevin | ... | ... | ... |
| 8 | **4.2** | 3 A + 2 B | Persona + Format + Action + Neg | Workout | Kevin | ... | ... | ... |
| 9 | **5** | 4 A + 1 B | Context + CoT | Nutrisi | Kevin | ... | ... | ... |
| 10 | **5.2** | 4 A + 2 B | Context + CoT + Negative | Nutrisi | Kevin | ... | ... | ... |
| 11 | **6** | 5 A + 1 B | Tree of Thought (ToT) | Workout | Fernanda | ... | ... | ... |
| 12 | **6.2** | 5 A + 2 B | ToT + Negative | Workout | Fernanda | ... | ... | ... |
| 13 | **7** | 2 B + 1 A | Single-shot + Negative | Info | Fernanda | ... | ... | ... |
| 14 | **7.2** | 2 B + 2 A | Single-shot + Negative + Constraint | Info | Fernanda | ... | ... | ... |
| 15 | **8** | 3 B + 1 A | Few-shot + Action + Negative | Nutrisi | Fernanda | ... | ... | ... |
| 16 | **8.2** | 3 B + 2 A | Few-shot + Action + Neg + Format | Nutrisi | Fernanda | ... | ... | ... |
| 17 | **9** | 4 B + 1 A | Tool-based + Action + Negative | Nutrisi | Fernanda | ... | ... | ... |
| 18 | **9.2** | 4 B + 2 A | Tool-based + Persona + Action + Neg | Info | Fernanda | ... | ... | ... |
| 19 | **10** | 5 B + 1 A | Zero+Single+Few+Action+Neg | Workout | Fernanda | ... | ... | ... |
| 20 | **10.2** | 5 B + 2 A | Multi-shot + Instruction + Neg | Workout | Rico | ... | ... | ... |
| 21 | **11** | 6 B + 1 A | Tool + CoT + Action + Multi-shot | Nutrisi | Rico | ... | ... | ... |
| 22 | **11.2** | 6 B + 2 A | Tool + CoT + Multi-shot + Constraint | Nutrisi | Rico | ... | ... | ... |
| 23 | **12** | 7 B + 1 A | Zero+Single+Few+Tool+CoT+Action | Info | Rico | ... | ... | ... |
| 24 | **12.2** | 7 B + 2 A | Full Multi-tech + Context Data | Info | Rico | ... | ... | ... |
| 25 | **13** | 8 B + 1 A | Full Multi-tech + ToT + CoT | Workout | Rico | ... | ... | ... |
| 26 | **13.2** | 8 B + 2 A | Full Multi-tech + ToT + Persona | Workout | Rico | ... | ... | ... |
| 27 | **14** | 6 A + 1 B | 6-Elemen Struktur Lengkap + CoT | Nutrisi | Rico | ... | ... | ... |
| 28 | **14.2** | 6 A + 2 B | 6-Elemen Struktur + CoT + Negative | Nutrisi | Rico | ... | ... | ... |

---

## 2. Temuan dan Analisis Komparatif

### A. Pengaruh Struktur Prompt (A):
1. **Task Description Sederhana (1A) vs Lengkap (6A):**
   * *Temuan:* [Diisi setelah pengujian]
2. **Pengaruh Persona & Response Format:**
   * *Temuan:* [Diisi setelah pengujian]
3. **Pengaruh Constraints & Exclusions:**
   * *Temuan:* [Diisi setelah pengujian]

### B. Pengaruh Teknik Prompting (B):
1. **Zero-shot vs Single-shot vs Few-shot:**
   * *Temuan:* [Diisi setelah pengujian]
2. **Efektivitas Chain of Thought (CoT) vs Tree of Thought (ToT):**
   * *Temuan:* [Diisi setelah pengujian]
3. **Konsistensi Negative Prompting pada Model LLaMA di Groq:**
   * *Temuan:* [Diisi setelah pengujian]

---

## 3. Rekomendasi Formulasi Prompt Terbaik

* **Mode Workout:** Kombinasi ... (Alasan: ...)
* **Mode Nutrisi:** Kombinasi ... (Alasan: ...)
* **Mode Info Olahraga:** Kombinasi ... (Alasan: ...)

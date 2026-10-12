# 📊 Analisis Final Hasil Eksperimen Prompt Engineering
## All-in-One Sport Chatbot

> **Petunjuk:** Isi dokumen ini setelah semua eksperimen (TASK-13 s/d TASK-17) selesai.  
> **Dikerjakan oleh:** Teman 2  
> **Deadline:** Minggu 3 (sebelum TASK-19 dimulai)

---

## 1. Tabel Rangkuman Semua Eksperimen

| No | Kombinasi | Skema | Teknik | Mode | Token Input | Token Output | Rating (1-5) |
|----|-----------|-------|--------|------|-------------|--------------|--------------|
| 1 | 1 | 1A + 1B | Zero-shot | Workout | ... | ... | ... |
| 2 | 1.2 | 1A + 2B | Zero-shot + Negative | Workout | ... | ... | ... |
| 3 | 2 | 1B + 1A | Action-oriented | Nutrisi | ... | ... | ... |
| 4 | 2.2 | 1B + 2A | Action-oriented + Constraint | Nutrisi | ... | ... | ... |
| 5 | 3 | 2A + 1B | Persona + Zero-shot | Info | ... | ... | ... |
| 6 | 3.2 | 2A + 2B | Persona + Zero-shot + Negative | Info | ... | ... | ... |
| 7 | 4 | 3A + 1B | Persona + Format + Action | Workout | ... | ... | ... |
| 8 | 4.2 | 3A + 2B | Persona + Format + Action + Negative | Workout | ... | ... | ... |
| 9 | 5 | 4A + 1B | Chain of Thought (CoT) | Nutrisi | ... | ... | ... |

---

## 2. Analisis Per Teknik Prompting

### 2.1 Zero-shot Prompting (Kombinasi 1 & 1.2)
**Pertanyaan analisis:**
- Apakah jawaban sudah cukup relevan tanpa contoh?
- Seberapa konsisten kualitas jawabannya?

**Temuan:**
> [isi setelah eksperimen selesai]

---

### 2.2 Negative Prompting (Kombinasi 1.2, 2.2, 3.2, 4.2)
**Pertanyaan analisis:**
- Seberapa efektif larangan/batasan diikuti oleh Gemini?
- Apakah negative prompting meningkatkan atau menurunkan kualitas?

**Temuan:**
> [isi setelah eksperimen selesai]

---

### 2.3 Action-oriented Prompting (Kombinasi 2, 2.2, 4, 4.2)
**Pertanyaan analisis:**
- Apakah kata kerja aktif membuat jawaban lebih spesifik?
- Apakah jawaban lebih terstruktur dibanding zero-shot?

**Temuan:**
> [isi setelah eksperimen selesai]

---

### 2.4 Persona Prompting (Kombinasi 3, 3.2, 4, 4.2)
**Pertanyaan analisis:**
- Apakah persona mengubah gaya bahasa secara signifikan?
- Apakah persona meningkatkan kepercayaan terhadap jawaban?

**Temuan:**
> [isi setelah eksperimen selesai]

---

### 2.5 Chain of Thought / CoT (Kombinasi 5)
**Pertanyaan analisis:**
- Apakah CoT menghasilkan jawaban paling komprehensif?
- Apakah kualitas sepadan dengan banyaknya token yang digunakan?
- Perbandingan token output CoT vs Zero-shot:

| Metrik | Zero-shot (Komb. 1) | CoT (Komb. 5) | Selisih |
|--------|---------------------|---------------|---------|
| Token Output | ... | ... | ... |
| Rating Kualitas | .../5 | .../5 | ... |
| Efisiensi | ... | ... | ... |

**Temuan:**
> [isi setelah eksperimen selesai]

---

## 3. Rekomendasi Prompt Terbaik Per Mode

### Mode 💪 Workout
**Kombinasi terbaik:** Kombinasi ...  
**Alasan:** ...  
**Prompt yang direkomendasikan:**
```
[paste prompt terbaik di sini]
```

---

### Mode 🍎 Nutrisi
**Kombinasi terbaik:** Kombinasi ...  
**Alasan:** ...  
**Prompt yang direkomendasikan:**
```
[paste prompt terbaik di sini]
```

---

### Mode ⚽ Info Olahraga
**Kombinasi terbaik:** Kombinasi ...  
**Alasan:** ...  
**Prompt yang direkomendasikan:**
```
[paste prompt terbaik di sini]
```

---

## 4. Temuan Utama

1. **Teknik yang menghasilkan kualitas tertinggi:**  
   > ...

2. **Teknik yang paling efisien (token sedikit, kualitas tinggi):**  
   > ...

3. **Teknik yang sebaiknya dihindari:**  
   > ...

4. **Efek negative prompting secara umum:**  
   > ...

5. **Apakah CoT selalu lebih baik?**  
   > ...

---

## 5. Rekomendasi untuk Pengembangan Selanjutnya

- [ ] Coba kombinasikan persona + CoT untuk hasil optimal
- [ ] Tambahkan few-shot prompting sebagai eksperimen lanjutan
- [ ] Pertimbangkan prompt yang berbeda untuk user pemula vs lanjut
- [ ] [tambahkan rekomendasi lain setelah eksperimen]

---

## 6. Grafik Perbandingan (Opsional)

> Buat di Google Sheets dengan data dari tabel rangkuman:
> - Bar chart: Rating kualitas per kombinasi
> - Scatter plot: Token output vs Rating kualitas
> - Pie chart: Distribusi teknik yang paling sering menghasilkan rating tinggi

---

*Dokumen ini dibuat oleh Teman 2 sebagai bagian dari TASK-18*  
*Tanggal dibuat: [DD/MM/YYYY]*  
*Terakhir diupdate: [DD/MM/YYYY]*

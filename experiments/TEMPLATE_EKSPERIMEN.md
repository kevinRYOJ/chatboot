# 🧪 Template Eksperimen Prompt Engineering
## All-in-One Sport Chatbot

> **Petunjuk Penggunaan:**
> 1. Jalankan setiap prompt di chatbot
> 2. Catat hasilnya di Google Sheets
> 3. Isi evaluasi kualitas secara jujur
> 4. Estimasi Token = jumlah kata × 1.3

---

## 📊 Struktur Google Sheets

| Kolom | Nama | Contoh Isi |
|-------|------|-----------|
| A | Prompt | "Buatkan program latihan seminggu..." |
| B | Nomor Kombinasi | 1 / 1.2 / 2 / 2.2 / 3 / 3.2 / 4 / 4.2 / 5 |
| C | Jenis Prompt Engineering | Zero-shot / Negative / Action-oriented / CoT |
| D | Jumlah Token Input | 45 |
| E | Jumlah Token Output | 320 |
| F | Deskripsi Kualitas Hasil | Baik — jawaban terstruktur dan relevan |
| G | Assignee | Kevin / Teman 1 / Teman 2 |
| H | Mode Chatbot | Workout / Nutrisi / Info |

---

## 📋 Tabel Kombinasi Referensi

| Nomor | Skema | Struktur Prompt (A) | Teknik Prompting (B) |
|-------|-------|---------------------|----------------------|
| 1 | 1A + 1B | Task description | Zero-shot prompting |
| 1.2 | 1A + 2B | Task description | Zero-shot + Negative prompting |
| 2 | 1B + 1A | Task description | Action-oriented prompting |
| 2.2 | 1B + 2A | Task description + Constraints | Action-oriented prompting |
| 3 | 2A + 1B | Task description + Persona | Zero-shot prompting |
| 3.2 | 2A + 2B | Task description + Persona | Zero-shot + Negative prompting |
| 4 | 3A + 1B | Task description + Persona + Response format | Action-oriented prompting |
| 4.2 | 3A + 2B | Task description + Persona + Response format | Action-oriented + Negative prompting |
| 5 | 4A + 1B | Task desc + Persona + Format + Context | Chain of Thought (CoT) |

---

# 🔬 DETAIL PROMPT PER KOMBINASI

---

## KOMBINASI 1 — Task description + Zero-shot
**Assignee:** Kevin | **Mode:** 💪 Workout

### Prompt yang Dijalankan
```
Buatkan program latihan seminggu untuk seseorang yang ingin
menurunkan berat badan. Jangan gunakan contoh dari orang lain.
```

### Yang Diamati
- Apakah program latihan masuk akal untuk pemula?
- Apakah ada variasi latihan setiap hari?
- Apakah ada informasi durasi/intensitas?

### Isian Google Sheets
| Kolom | Isi |
|-------|-----|
| B | 1 |
| C | Zero-shot prompting |
| D | hitung: jumlah kata × 1.3 |
| E | hitung: jumlah kata jawaban × 1.3 |
| F | [evaluasi kualitas kamu] |
| G | Kevin |
| H | Workout |

---

## KOMBINASI 1.2 — Task description + Zero-shot + Negative
**Assignee:** Kevin | **Mode:** 💪 Workout

### Prompt yang Dijalankan
```
Buatkan program latihan seminggu untuk seseorang yang ingin
menurunkan berat badan. Jangan menyarankan olahraga yang
membutuhkan peralatan gym mahal. Jangan menyebut suplemen apapun.
```

### Yang Diamati
- Apakah constraint "tanpa gym mahal" berhasil diikuti?
- Apakah ada perbedaan signifikan dengan Kombinasi 1?
- Mana yang lebih berguna untuk user dengan budget terbatas?

### Pertanyaan Analisis
> Bandingkan langsung dengan Kombinasi 1:
> - Apakah negative prompting membuat jawaban lebih praktis?
> - Apakah ada informasi yang hilang karena constraint?

---

## KOMBINASI 2 — Task description + Action-oriented
**Assignee:** Teman 1 | **Mode:** 🍎 Nutrisi

### Prompt yang Dijalankan
```
Hitung kebutuhan kalori harian untuk pria berusia 22 tahun,
berat 70kg, tinggi 170cm, yang aktif berolahraga 4x seminggu
dengan tujuan membentuk otot.
```

### Yang Diamati
- Apakah rumus BMR/TDEE digunakan dengan benar?
- Apakah angka kalori yang diberikan masuk akal?
- Apakah ada breakdown makro (protein/karbo/lemak)?

### Cara Verifikasi Manual
```
BMR (laki-laki) = 88.36 + (13.4 × berat) + (4.8 × tinggi) - (5.7 × usia)
               = 88.36 + (13.4 × 70) + (4.8 × 170) - (5.7 × 22)
               = 88.36 + 938 + 816 - 125.4
               = 1,716.96 kkal

TDEE (aktif 4x/minggu, faktor 1.55) = 1,716.96 × 1.55 = 2,661 kkal
Untuk muscle gain, tambah 300-500 kkal = sekitar 2,961-3,161 kkal/hari
```
*Cek apakah jawaban Gemini mendekati nilai ini.*

---

## KOMBINASI 2.2 — Task description + Constraints + Action-oriented
**Assignee:** Teman 1 | **Mode:** 🍎 Nutrisi

### Prompt yang Dijalankan
```
Hitung kebutuhan kalori harian untuk pria 22 tahun, 70kg, 170cm,
aktif olahraga 4x seminggu, tujuan muscle gain.
Jangan rekomendasikan suplemen berbayar mahal.
Fokus pada makanan yang mudah didapat di Indonesia.
```

### Yang Diamati
- Apakah makanan yang direkomendasikan adalah makanan Indonesia asli?
- Apakah suplemen tidak disebutkan?
- Apakah perhitungan kalori tetap akurat meski ada constraint?

---

## KOMBINASI 3 — Task description + Persona + Zero-shot
**Assignee:** Teman 1 | **Mode:** ⚽ Info Olahraga

### Prompt yang Dijalankan
```
Kamu adalah pelatih bulu tangkis nasional Indonesia
berpengalaman 15 tahun. Jelaskan teknik dasar yang harus
dikuasai pemain bulu tangkis pemula usia 15-20 tahun.
```

### Yang Diamati
- Apakah gaya bahasa berubah (lebih formal/profesional) dengan persona?
- Apakah teknik yang disebutkan spesifik dan terstruktur?
- Apakah ada urutan prioritas teknik yang logis?

---

## KOMBINASI 3.2 — Task description + Persona + Zero-shot + Negative
**Assignee:** Teman 1 | **Mode:** ⚽ Info Olahraga

### Prompt yang Dijalankan
```
Kamu adalah pelatih bulu tangkis nasional Indonesia
berpengalaman 15 tahun. Jelaskan teknik dasar untuk pemula
usia 15-20 tahun. Jangan membahas strategi permainan ganda
atau taktik tim. Fokus pada teknik individu saja.
```

### Yang Diamati
- Apakah negative prompting berhasil membatasi topik ke teknik individu?
- Apakah jawaban lebih terfokus dibanding Kombinasi 3?

---

## KOMBINASI 4 — Task desc + Persona + Response format + Action-oriented
**Assignee:** Kevin | **Mode:** 💪 Workout

### Prompt yang Dijalankan
```
Kamu adalah personal trainer profesional bersertifikat.
Buatkan program latihan 4 minggu untuk pemula yang ingin
membentuk otot. Sajikan dalam format tabel dengan kolom:
Minggu | Hari | Nama Latihan | Set × Rep | Durasi.
```

### Yang Diamati
- Apakah Gemini berhasil membuat tabel yang rapi?
- Apakah program 4 minggu ada progressinya?
- Apakah latihan aman untuk pemula?

---

## KOMBINASI 4.2 — Task desc + Persona + Response format + Action-oriented + Negative
**Assignee:** Kevin | **Mode:** 💪 Workout

### Prompt yang Dijalankan
```
Kamu adalah personal trainer profesional bersertifikat.
Buatkan program latihan 4 minggu untuk pemula yang ingin
membentuk otot dalam format tabel (Minggu|Hari|Latihan|Set×Rep|Durasi).
Jangan sarankan latihan yang berisiko cedera untuk pemula
seperti deadlift berat atau squat maksimal.
```

### Yang Diamati
- Apakah latihan berisiko berhasil dihilangkan?
- Apakah format tabel tetap rapi dengan adanya constraint?
- Bandingkan dengan Kombinasi 4: mana yang lebih aman dan berguna?

---

## KOMBINASI 5 — Chain of Thought (CoT) [PALING KOMPLEKS]
**Assignee:** Teman 2 | **Mode:** 🍎 Nutrisi

### Prompt yang Dijalankan
```
Kamu adalah ahli gizi olahraga bersertifikat.

Seorang user datang dengan kondisi berikut:
- Pria, 25 tahun, 80kg, 175cm
- Ingin turun berat badan 10kg dalam 3 bulan
- Bisa olahraga 3x seminggu
- Tidak ada alergi makanan

Pikirkan langkah demi langkah:

LANGKAH 1: Analisis kondisi dan hitung BMR/TDEE user
LANGKAH 2: Tentukan defisit kalori yang aman dan realistis
LANGKAH 3: Buat meal plan harian (sarapan, makan siang, makan malam, snack)
LANGKAH 4: Rekomendasikan jenis olahraga yang sesuai
LANGKAH 5: Berikan timeline realistis dan tips motivasi
```

### Yang Diamati
- Apakah Gemini mengikuti 5 langkah secara berurutan?
- Apakah perhitungan BMR/TDEE akurat?
- Apakah target 10kg dalam 3 bulan dinilai realistis?
- Berapa total token output? (bandingkan dengan kombinasi lain)

### Cara Verifikasi Target Berat Badan
```
Defisit aman: 500 kkal/hari = 0.5 kg/minggu = 2 kg/bulan
Untuk 10kg dalam 3 bulan = 3.3 kg/bulan → perlu defisit ~830 kkal/hari
Ini AGRESIF dan perlu divalidasi oleh chatbot apakah realistis atau tidak.
```

### Pertanyaan Analisis Kritis
> - Apakah CoT lebih baik dari Zero-shot untuk kasus kompleks seperti ini?
> - Seberapa besar selisih token output CoT vs Zero-shot?
> - Apakah kualitas jawaban sepadan dengan banyaknya token yang digunakan?

---

# 📝 Template Dokumentasi Hasil Test

## Template untuk `experiments/hasil/[mode]-prompt-test.md`

```markdown
# Hasil Test Prompt: Mode [Workout / Nutrisi / Info]
**Tanggal:** [DD/MM/YYYY]
**Tester:** [Nama]
**Kombinasi yang diuji:** [Nomor kombinasi]

---

## Pertanyaan 1
**Prompt:** [teks prompt]
**Jawaban Chatbot:**
[copy paste jawaban]

**Evaluasi:**
- Relevansi: ⭐⭐⭐⭐⭐ (1-5)
- Akurasi: ⭐⭐⭐⭐⭐ (1-5)
- Keterbacaan: ⭐⭐⭐⭐⭐ (1-5)
- Komentar: [catatan singkat]

---

[ulangi untuk pertanyaan 2-5]

## Kesimpulan
Prompt terbaik untuk mode ini: Kombinasi [X]
Alasan: [penjelasan singkat]
```

---

# 📊 Skala Evaluasi Kualitas

| Rating | Label | Kriteria |
|--------|-------|---------|
| ⭐ | Sangat Kurang | Jawaban tidak relevan / menyesatkan |
| ⭐⭐ | Kurang | Relevan tapi tidak akurat atau tidak berguna |
| ⭐⭐⭐ | Cukup | Relevan dan akurat tapi kurang detail |
| ⭐⭐⭐⭐ | Baik | Relevan, akurat, dan cukup detail |
| ⭐⭐⭐⭐⭐ | Sangat Baik | Relevan, akurat, detail, dan mudah dipahami |

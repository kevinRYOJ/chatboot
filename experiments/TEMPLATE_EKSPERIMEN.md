# 🧪 Panduan & Template Lengkap 28 Eksperimen Prompt Engineering
## Proyek: All-in-One Sport Chatbot (PHP & Groq API)

> **Pembagian Tim:**  
> - 👑 **Kevin (`kevinRYOJ`):** Kombinasi **1 s/d 5.2** (10 Kombinasi)  
> - 👤 **Fernanda (`fernanda-hensem`):** Kombinasi **6 s/d 10** (9 Kombinasi)  
> - 👤 **Rico (`ricozack97`):** Kombinasi **10.2 s/d 14.2** (9 Kombinasi)  
> **Total:** 28 Kombinasi Sesuai Tabel Resmi Dosen

---

## 📊 Format Kolom Pengisian Google Sheets

| Kolom | Nama Kolom | Keterangan Pengisian |
|---|---|---|
| **A** | **Prompt** | Teks prompt yang dikirimkan ke Chatbot / LLM |
| **B** | **Nomor Kombinasi** | 1, 1.2, 2, 2.2, 3, 3.2, ... s/d 14.2 |
| **C** | **Jenis Prompt Engineering** | Salin teknik dari kolom D tabel dosen |
| **D** | **Jumlah Token Input** | Estimasi: `Jumlah kata prompt × 1.3` |
| **E** | **Jumlah Token Output** | Estimasi: `Jumlah kata jawaban × 1.3` |
| **F** | **Deskripsi Kualitas Hasil** | Evaluasi (Sangat Baik / Baik / Cukup / Kurang) + alasan |
| **G** | **Tester** | Kevin / Fernanda / Rico |
| **H** | **Mode Chatbot** | Workout / Nutrisi / Info Olahraga |

---

# 👑 BAGIAN 1: KEVIN (`kevinRYOJ`) — Kombinasi 1 s/d 5.2

---

### [1] Kombinasi 1 (Skema: 1 A dengan 1 B)
* **Struktur (A):** Task description
* **Teknik (B):** Zero-shot prompting
* **Mode:** 💪 Workout
* **Prompt Olahraga:**
```text
Buatkan program latihan kardio mingguan untuk pemula yang ingin menurunkan berat badan.
```

---

### [2] Kombinasi 1.2 (Skema: 1 A dengan 2 B)
* **Struktur (A):** Task description
* **Teknik (B):** Zero-shot prompting, Negative prompting
* **Mode:** 💪 Workout
* **Prompt Olahraga:**
```text
Buatkan program latihan kardio mingguan untuk pemula yang ingin menurunkan berat badan. Jangan menyarankan penggunaan alat gym mahal atau treadmill, dan jangan sarankan latihan intensitas tinggi (HIIT).
```

---

### [3] Kombinasi 2 (Skema: 1 B dengan 1 A)
* **Struktur (A):** Task description
* **Teknik (B):** Action-oriented prompting
* **Mode:** 🍎 Nutrisi
* **Prompt Olahraga:**
```text
Hitung kebutuhan kalori harian serta tentukan target asupan protein untuk pria 70kg dengan tinggi 170cm yang ingin menambah massa otot.
```

---

### [4] Kombinasi 2.2 (Skema: 1 B dengan 2 A)
* **Struktur (A):** Task description, Constraints or exclusions
* **Teknik (B):** Action-oriented prompting
* **Mode:** 🍎 Nutrisi
* **Prompt Olahraga:**
```text
Hitung kebutuhan kalori harian dan susun meal plan untuk pria 70kg, 170cm. Batasi pilihan makanan hanya pada bahan pangan lokal Indonesia yang terjangkau, dan jangan masukkan suplemen whey protein atau multivitamin berbayar.
```

---

### [5] Kombinasi 3 (Skema: 2 A dengan 1 B)
* **Struktur (A):** Task description, Persona or role
* **Teknik (B):** Zero-shot prompting
* **Mode:** ⚽ Info Olahraga
* **Prompt Olahraga:**
```text
Kamu adalah seorang pelatih kepala bulu tangkis nasional berprestasi. Jelaskan teknik dasar pukulan netting dan smash yang efektif bagi atlet muda.
```

---

### [6] Kombinasi 3.2 (Skema: 2 A dengan 2 B)
* **Struktur (A):** Task description, Persona or role
* **Teknik (B):** Zero-shot prompting, Negative prompting
* **Mode:** ⚽ Info Olahraga
* **Prompt Olahraga:**
```text
Kamu adalah seorang pelatih kepala bulu tangkis nasional berprestasi. Jelaskan teknik dasar pukulan netting dan smash bagi atlet muda. Jangan membahas taktik permainan nomor ganda, dan jangan gunakan istilah asing tanpa penjelasan bahasa Indonesia.
```

---

### [7] Kombinasi 4 (Skema: 3 A dengan 1 B)
* **Struktur (A):** Task description, Persona or role, Response format
* **Teknik (B):** Action-oriented prompting
* **Mode:** 💪 Workout
* **Prompt Olahraga:**
```text
Kamu adalah personal trainer profesional bersertifikat. Rancang program latihan angkat beban 4 minggu untuk pemula. Sajikan output dalam format tabel terstruktur dengan kolom: Minggu | Hari | Nama Latihan | Set x Repetisi | Durasi Istirahat.
```

---

### [8] Kombinasi 4.2 (Skema: 3 A dengan 2 B)
* **Struktur (A):** Task description, Persona or role, Response format
* **Teknik (B):** Action-oriented prompting, Negative prompting
* **Mode:** 💪 Workout
* **Prompt Olahraga:**
```text
Kamu adalah personal trainer profesional bersertifikat. Rancang program latihan angkat beban 4 minggu untuk pemula dalam format tabel (Minggu | Hari | Nama Latihan | Set x Rep | Istirahat). Jangan sertakan gerakan berbahaya bagi pemula seperti barbell deadlift maksimal atau behind-the-neck press.
```

---

### [9] Kombinasi 5 (Skema: 4 A dengan 1 B)
* **Struktur (A):** Task description, Persona or role, Response format, Input data/context
* **Teknik (B):** Chain of thought (CoT) prompting
* **Mode:** 🍎 Nutrisi
* **Prompt Olahraga:**
```text
Kamu adalah ahli gizi olahraga klinis.
Konteks: Seorang pelari maraton berusia 26 tahun (berat 60kg, tinggi 168cm) bersiap untuk lomba maraton dalam 2 minggu.
Tugas: Buat rencana carb-loading.
Pikirkan secara bertahap (langkah demi langkah):
Langkah 1: Analisis kebutuhan glikogen dan kalori pelari.
Langkah 2: Tentukan jadwal peningkatan persentase karbohidrat H-7 hingga hari H.
Langkah 3: Tuliskan menu makan spesifik tiap fase.
Sajikan dalam format laporan terstruktur dengan heading tebal untuk tiap langkah.
```

---

### [10] Kombinasi 5.2 (Skema: 4 A dengan 2 B)
* **Struktur (A):** Task description, Persona or role, Response format, Input data/context
* **Teknik (B):** Chain of thought (CoT) prompting, Negative prompting
* **Mode:** 🍎 Nutrisi
* **Prompt Olahraga:**
```text
Kamu adalah ahli gizi olahraga klinis.
Konteks: Seorang atlet angkat besi wanita kelas 55kg sedang dalam periode cut berat badan 1 minggu sebelum timbang badan.
Tugas: Buat strategi pemotongan air dan garam yang aman.
Pikirkan secara bertahap langkah demi langkah dari H-5 hingga hari timbang badan.
Format: Poin berurutan per hari.
Batasan: Jangan rekomendasikan penggunaan obat diuretik, sauna ekstrem, atau dehidrasi lebih dari 3% berat badan.
```

---

# 👤 BAGIAN 2: FERNANDA (`fernanda-hensem`) — Kombinasi 6 s/d 10

---

### [11] Kombinasi 6 (Skema: 5 A dengan 1 B)
* **Struktur (A):** Task description, Instruction, Response format, Input data/context, Persona or role
* **Teknik (B):** Tree of thought (ToT) prompting
* **Mode:** 💪 Workout
* **Prompt Olahraga:**
```text
Kamu adalah konsultan kebugaran dan biomekanik olahraga.
Konteks: Klien usia 40 tahun dengan riwayat nyeri lutut ringan ingin membakar lemak tanpa memperparah cedera.
Instruksi: Evaluasi 3 alternatif cabang olahraga (Opsi A: Berenang, Opsi B: Sepeda Statis, Opsi C: Jalan Cepat Incline). Untuk setiap opsi, jabarkan kelebihan, risiko biomekanik terhadap lutut, dan estimasi pembakaran kalori. Rekomendasikan opsi terbaik berdasarkan evaluasi cabang pemikiran tersebut.
Format: Analisis 3 Cabang + Kesimpulan Rekomendasi Akhir.
```

---

### [12] Kombinasi 6.2 (Skema: 5 A dengan 2 B)
* **Struktur (A):** Task description, Instruction, Response format, Input data/context, Persona or role
* **Teknik (B):** Tree of thought (ToT) prompting, Negative prompting
* **Mode:** 💪 Workout
* **Prompt Olahraga:**
```text
Kamu adalah konsultan kebugaran dan biomekanik olahraga.
Konteks: Klien usia 40 tahun dengan riwayat nyeri lutut ringan ingin latihan fat-loss.
Instruksi: Analisis 3 alternatif jalur latihan (Berenang vs Sepeda Statis vs Rowing Machine), bandingkan pro dan kontra tiap jalur, lalu pilih 1 yang paling optimal.
Format: Evaluasi bercabang dan kesimpulan.
Batasan: Jangan sertakan gerakan lompat (plyometrics), lari jalan raya, atau gerakan beban yang menekuk lutut melebihi 90 derajat.
```

---

### [13] Kombinasi 7 (Skema: 2 B dengan 1 A)
* **Struktur (A):** Task description
* **Teknik (B):** Single-shot prompting, Negative prompting
* **Mode:** ⚽ Info Olahraga
* **Prompt Olahraga:**
```text
Buat tips motivasi singkat sebelum bertanding untuk atlet sepak bola.
Contoh:
Target: Basket
Pesan: "Fokus pada penguasaan rebound dan komunikasi defense, kemenangan dibangun dari disiplin tiap detik!"

Sekarang buat untuk Sepak Bola:
Batasan: Jangan gunakan kalimat klise seperti "pantang menyerah" atau "berdoa saja".
```

---

### [14] Kombinasi 7.2 (Skema: 2 B dengan 2 A)
* **Struktur (A):** Task description, Constraints or exclusions
* **Teknik (B):** Single-shot prompting, Negative prompting
* **Mode:** ⚽ Info Olahraga
* **Prompt Olahraga:**
```text
Buatkan instruksi taktik bertahan sepak bola saat menghadapi serangan balik cepat.
Contoh:
Olahraga: Futsal
Instruksi: "Tutup jalur passing tengah, paksa lawan menggiring ke pinggir lapangan, jangan langsung tekel sebelum ada cover."

Sekarang buat untuk Sepak Bola 11 lawan 11.
Batasan: Maksimal 3 kalimat ringkas. Jangan sarankan pelanggaran profesional (tactical foul).
```

---

### [15] Kombinasi 8 (Skema: 3 B dengan 1 A)
* **Struktur (A):** Task description
* **Teknik (B):** Few-shot prompting, Action-oriented prompting, Negative prompting
* **Mode:** 🍎 Nutrisi
* **Prompt Olahraga:**
```text
Tentukan camilan pre-workout berenergi tinggi berdasarkan contoh berikut:
Contoh 1:
Waktu: 60 menit sebelum lari
Menu: Pisang ambon + 1 sdm selai kacang
Contoh 2:
Waktu: 30 menit sebelum renang
Menu: 2 butir kurma + segelas air kelapa

Tugas: Tentukan menu camilan 45 menit sebelum latihan gym angkat beban.
Tindakan: Tuliskan porsi dan kandungan karbohidrat cepat serapnya.
Batasan: Jangan sarankan suplemen pre-workout berkafein tinggi atau minuman energi kalengan.
```

---

### [16] Kombinasi 8.2 (Skema: 3 B dengan 2 A)
* **Struktur (A):** Task description, Response format
* **Teknik (B):** Few-shot prompting, Action-oriented prompting, Negative prompting
* **Mode:** 🍎 Nutrisi
* **Prompt Olahraga:**
```text
Klasifikasikan jenis makanan olahraga berdasarkan contoh:
Contoh 1: Dada ayam rebus -> Kategori: Sumber Protein Murni -> Fungsi: Pembentukan Jaringan Otot
Contoh 2: Nasi merah -> Kategori: Karbohidrat Kompleks -> Fungsi: Energi Bertahan Lama

Tugas: Klasifikasikan buah alpukat dan telur rebus utuh.
Format: Sajikan dalam format JSON: [{"nama": "...", "kategori": "...", "fungsi": "..."}]
Batasan: Jangan sertakan ulasan deskriptif di luar sintaks JSON valid.
```

---

### [17] Kombinasi 9 (Skema: 4 B dengan 1 A)
* **Struktur (A):** Task description
* **Teknik (B):** Tool-based prompting, Zero-shot prompting, Action-oriented prompting, Negative prompting
* **Mode:** 🍎 Nutrisi (Simulasi Tool Kalkulator Kalori)
* **Prompt Olahraga:**
```text
Gunakan tools kalkulator BMR/TDEE dengan format fungsi `calculate_tdee(gender, weight_kg, height_cm, age, activity_level)`.
Tugas: Panggil tool tersebut untuk user: Pria, 80kg, 175cm, 24 tahun, aktivitas moderat (1.55). Berikan estimasi output pemanggilan fungsinya secara langsung tanpa basa-basi. Jangan sertakan teks disclaimer medis panjang.
```

---

### [18] Kombinasi 9.2 (Skema: 4 B dengan 2 A)
* **Struktur (A):** Task description, Persona or role
* **Teknik (B):** Tool-based prompting, Zero-shot prompting, Action-oriented prompting, Negative prompting
* **Mode:** ⚽ Info Olahraga (Simulasi Tool Data API Pertandingan)
* **Prompt Olahraga:**
```text
Kamu adalah analis statistik data olahraga.
Tugas: Eksekusi query fungsi `get_match_stats(team="Indonesia", opponent="Vietnam", tournament="AFF Cup")` untuk menampilkan perbandingan penguasaan bola dan tembakan ke gawang.
Tindakan: Tampilkan data tabel hasil query simulasi.
Batasan: Jangan gunakan data imajinatif di luar konteks pertandingan resmi FIFA, dan jangan masukkan opini subjektif suporter.
```

---

### [19] Kombinasi 10 (Skema: 5 B dengan 1 A)
* **Struktur (A):** Task description
* **Teknik (B):** Zero-shot, Single-shot, Few-shot, Action-oriented, Negative prompting
* **Mode:** 💪 Workout
* **Prompt Olahraga:**
```text
Rancang variasi gerakan push-up untuk melatih otot dada bagian atas.
Pola acuan:
Contoh 1: Push-up standar melatih dada tengah secara merata.
Contoh 2: Diamond push-up lebih memfokuskan kontraksi pada otot trisep.
Tindakan: Jelaskan posisi kaki dan tangan untuk variasi incline/decline push-up.
Batasan: Jangan menyarankan beban eksternal (weight vest/plate) di atas punggung.
```

---

# 👤 BAGIAN 3: RICO (`ricozack97`) — Kombinasi 10.2 s/d 14.2

---

### [20] Kombinasi 10.2 (Skema: 5 B dengan 2 A)
* **Struktur (A):** Task description, Instruction
* **Teknik (B):** Zero-shot, Single-shot, Few-shot, Action-oriented, Negative prompting
* **Mode:** 💪 Workout
* **Prompt Olahraga:**
```text
Tugas: Susun panduan peregangan dinamis sebelum lari cepat (sprint).
Instruksi:
1. Pelajari pola: Leg swing (mobilitas panggul), Butt kicks (pemanasan paha belakang).
2. Tuliskan 3 gerakan lanjutan secara runtut.
3. Sertakan durasi per gerakan.
Batasan: Jangan sarankan peregangan statis (menahan posisi diam lebih dari 15 detik) sebelum sesi sprint dimulai.
```

---

### [21] Kombinasi 11 (Skema: 6 B dengan 1 A)
* **Struktur (A):** Task description
* **Teknik (B):** Tool-based, Action-oriented, Negative, CoT, Zero-shot, Single-shot prompting
* **Mode:** 🍎 Nutrisi
* **Prompt Olahraga:**
```text
Simulasikan pemanggilan API kalori `fetch_food_nutrition(food_item="100g tempe goreng")`.
Pikirkan langkah demi langkah:
Langkah 1: Jalankan tool untuk mendapatkan data kalori, protein, lemak, dan karbohidrat.
Langkah 2: Bandingkan rasio nutrisi tersebut dengan contoh acuan: 100g dada ayam (165 kkal, 31g protein).
Langkah 3: Hitung apakah tempe cocok sebagai sumber protein utama harian atlet.
Batasan: Jangan menyimpulkan tanpa menampilkan angka matematis gram protein per 100 kalori.
```

---

### [22] Kombinasi 11.2 (Skema: 6 B dengan 2 A)
* **Struktur (A):** Task description, Constraints or exclusions
* **Teknik (B):** Tool-based, Action-oriented, Negative, CoT, Zero-shot, Single-shot prompting
* **Mode:** 🍎 Nutrisi
* **Prompt Olahraga:**
```text
Tugas: Hitung defisit kalori mingguan dengan simulasi fungsi `calculate_deficit(target_kg=4, duration_weeks=8)`.
Pikirkan penalaran step-by-step: berapa kkal defisit per hari, bagaimana penyesuaian porsi makan, dan berapa kalori yang dibakar dari jogging.
Batasan ketat: Defisit tidak boleh melebihi 700 kkal per hari. Jangan rekomendasikan diet tanpa karbohidrat sama sekali (keto ekstrem).
```

---

### [23] Kombinasi 12 (Skema: 7 B dengan 1 A)
* **Struktur (A):** Task description
* **Teknik (B):** Zero-shot, Single-shot, Few-shot, Tool-based, Action-oriented, Negative, Chain of thought (CoT) prompting
* **Mode:** ⚽ Info Olahraga
* **Prompt Olahraga:**
```text
Eksekusi rencana analisis taktik sepak bola modern.
Acuan:
Contoh: Formasi 4-3-3 mengandalkan inverted winger untuk cut-inside dan overlapping fullback.
Simulasi tool: `analyze_formation(formation="3-5-2", playstyle="counter-attack")`.
Penalaran bertahap:
1. Uraikan transisi bertahan ke menyerang dari output tool.
2. Analisis kelemahan pada area flank/sayap belakang wingback.
3. Berikan instruksi langsung kepada gelandang bertahan.
Batasan: Jangan bahas taktik bola mati (corner kick/free kick).
```

---

### [24] Kombinasi 12.2 (Skema: 7 B dengan 2 A)
* **Struktur (A):** Task description, Input data/context
* **Teknik (B):** Zero-shot, Single-shot, Few-shot, Tool-based, Action-oriented, Negative, Chain of thought (CoT) prompting
* **Mode:** ⚽ Info Olahraga
* **Prompt Olahraga:**
```text
Konteks data pertandingan: Tim Futsal U-20 tertinggal 1-3 dengan sisa waktu 4 menit pada babak kedua.
Tugas: Susun strategi Power Play menggunakan simulasi fungsi `run_powerplay_simulation(time_remaining=4, goal_deficit=2)`.
Pikirkan langkah demi langkah: rotasi bola, posisi anchor, penembak kedua tiang, dan pencegahan kebobolan gawang kosong.
Batasan: Jangan lakukan tembakan spekulatif jarak jauh tanpa screen kiper.
```

---

### [25] Kombinasi 13 (Skema: 8 B dengan 1 A)
* **Struktur (A):** Task description
* **Teknik (B):** Zero-shot, Single-shot, Few-shot, Tool-based, Action-oriented, Negative, CoT, Tree of thought (ToT) prompting
* **Mode:** 💪 Workout
* **Prompt Olahraga:**
```text
Rancang strategi pemilihan jenis periodisasi latihan (Linear vs Undulating vs Block periodization) untuk atlet angkat besi pemula.
Gunakan simulasi pemanggilan tool `evaluate_periodization_risk(athlete_level="beginner")`.
Jelajahi 3 cabang pemikiran (ToT):
- Cabang 1: Periodisasi Linear (analisis adaptasi beban, hitung risiko plateu).
- Cabang 2: Periodisasi Undulating (analisis variasi stimulus, hitung kelelahan sistem saraf).
- Cabang 3: Periodisasi Block (analisis fokus fase, hitung kompleksitas program).
Langkah CoT: Bandingkan ketiga cabang, eliminasi opsi yang tidak ramah pemula, dan pilih 1 rekomendasi terbaik.
Batasan: Jangan masukkan fase latihan peaking kompetisi profesional.
```

---

### [26] Kombinasi 13.2 (Skema: 8 B dengan 2 A)
* **Struktur (A):** Task description, Persona or role
* **Teknik (B):** Zero-shot, Single-shot, Few-shot, Tool-based, Action-oriented, Negative, CoT, Tree of thought (ToT) prompting
* **Mode:** 💪 Workout
* **Prompt Olahraga:**
```text
Kamu adalah Direktur Performa Atletik Kebugaran Nasional.
Tugas: Tentukan metode pemulihan pasca-maraton (Recovery Run vs Cold Water Immersion vs Massage Gun).
Simulasi tool: `get_muscle_damage_markers(fatigue_level="high")`.
Eksplorasi cabang pemikiran (ToT) untuk masing-masing 3 metode pemulihan.
Jalankan penalaran langkah demi langkah (CoT) dengan memperhitungkan waktu pemulihan jaringan otot.
Batasan: Jangan rekomendasikan kompres es langsung pada luka terbuka atau terapi obat antiinflamasi nonsteroid tanpa resep.
```

---

### [27] Kombinasi 14 (Skema: 6 A dengan 1 B)
* **Struktur (A):** Task description, Instruction, Response format, Input data/context, Persona or role, Constraints or exclusions
* **Teknik (B):** Chain of thought (CoT) prompting
* **Mode:** 🍎 Nutrisi
* **Prompt Olahraga:**
```text
Kamu adalah Kepala Tim Ahli Gizi Olimpiade Indonesia.
Konteks: Seorang atlet renang gaya bebas 100m (Pria, 21 tahun, 78kg, 188cm) berlatih 2 sesi sehari (pagi renang 2 jam, sore gym 1.5 jam).
Tugas: Buat protokol nutrisi dan hidrasi lengkap selama 24 jam.
Instruksi:
1. Pikirkan langkah demi langkah dari kebutuhan energi total harian (TDEE).
2. Rinci waktu asupan: Pre-training 1, Intra-training 1, Recovery 1, Pre-training 2, Recovery 2, dan Sebelum tidur.
3. Jelaskan rasio cairan elektrolit per jam latihan.
Format: Sajikan dengan heading terstruktur, tabel waktu makan, dan ringkasan makronutrien.
Batasan: Jangan menyertakan bahan makanan yang berisiko tercemar zat doping (WADA banned list).
```

---

### [28] Kombinasi 14.2 (Skema: 6 A dengan 2 B)
* **Struktur (A):** Task description, Instruction, Response format, Input data/context, Persona or role, Constraints or exclusions
* **Teknik (B):** Chain of thought (CoT) prompting, Negative prompting
* **Mode:** 🍎 Nutrisi & Performa
* **Prompt Olahraga:**
```text
Kamu adalah Kepala Tim Ahli Gizi Olimpiade Indonesia.
Konteks: Seorang atlet renang gaya bebas 100m (Pria, 21 tahun, 78kg, 188cm) dengan 2 sesi latihan berat sehari.
Tugas: Buat protokol nutrisi, hidrasi, dan strategi pemulihan 24 jam.
Instruksi: Pikirkan secara mendalam langkah demi langkah dari analisis beban glikogen, sintesis protein otot, hingga kualitas tidur malam.
Format: Laporan komprehensif berformat Markdown rapi dengan tabel breakdown gram karbohidrat/kg BB dan gram protein/kg BB.
Batasan & Negative Prompting:
- Jangan gunakan estimasi kalori kasar tanpa rumus ilmiah.
- Jangan rekomendasikan makanan cepat saji berlemak jenuh tinggi.
- Jangan sebutkan merek dagang suplemen komersial tertentu.
- Jangan abaikan kebutuhan natrium dan magnesium atlet.
```

---

## 🎯 Petunjuk Praktis Menjalankan Uji Coba:
1. Buka Chatbot kalian (atau Groq Playground console).
2. Kirim prompt di atas satu per satu sesuai bagian tugas masing-masing.
3. Catat:
   - Jumlah kata prompt (kalikan 1.3 untuk estimasi Token In).
   - Jumlah kata jawaban (kalikan 1.3 untuk estimasi Token Out).
   - Beri penilaian jujur di kolom Evaluasi Google Sheets!

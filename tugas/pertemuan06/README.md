# TUGAS 1: Eksplorasi Database dengan Query 

## Statistik Buku (5 query):
### 1. Total buku seluruhnya (jumlah judul unik yang belum dihapus)
<img width="1366" height="768" alt="Screenshot (110)" src="https://github.com/user-attachments/assets/181090c6-f170-4771-90a2-8e02b687471a" />

    SELECT COUNT(*) AS total_judul_buku FROM buku WHERE is_deleted = 0;

### 2. Total nilai inventaris (sum harga × stok)
<img width="1366" height="768" alt="Screenshot (111)" src="https://github.com/user-attachments/assets/7cfbe689-a889-4d80-8e3d-2b9898383f46" />

    SELECT SUM(harga * stok) AS total_nilai_inventaris FROM buku WHERE is_deleted = 0;

### 3. Rata-rata harga buku
<img width="1366" height="720" alt="Screenshot 2026-05-24 145022" src="https://github.com/user-attachments/assets/0f252f3a-4842-494f-adf9-1ddab6410736" />

    SELECT AVG(harga) AS rata_rata_harga FROM buku WHERE is_deleted = 0;

### 4. Buku termahal (tampilkan judul dan harga)
<img width="1366" height="768" alt="Screenshot (112)" src="https://github.com/user-attachments/assets/67878599-dd48-400e-9256-b9001d3b6eec" />

    SELECT judul, harga FROM buku 
    WHERE is_deleted = 0 
    ORDER BY harga DESC 
    LIMIT 1;

### 5. Buku dengan stok terbanyak
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/86e12022-4aa1-4844-8c10-45a3a162a88e" />

    SELECT judul, stok FROM buku 
    WHERE is_deleted = 0 
    ORDER BY stok DESC 
    LIMIT 1;

## Filter dan Pencarian (5 query):
### 1. Semua buku kategori Programming yang harga < 100.000
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/5b46cdf4-d2b5-4b37-b95a-f4211f760d80" />

    SELECT * FROM buku 
    WHERE kategori = 'Programming' AND harga < 100000 AND is_deleted = 0;

### 2. Buku yang judulnya mengandung kata "PHP" atau "MySQL"
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/20ba1b5c-02a9-4746-b09b-95d6545d4312" />

    SELECT * FROM buku 
    WHERE (judul LIKE '%PHP%' OR judul LIKE '%MySQL%') AND is_deleted = 0;

### 3. Buku yang terbit tahun 2024
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/7dcff2dd-acff-47b7-8b04-cebea713c83a" />

    SELECT * FROM buku 
    WHERE tahun_terbit = 2024 AND is_deleted = 0;

### 4. Buku yang stoknya antara 5-10
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/8885d4de-a144-4373-bbbb-d29e52ff4ccb" />

    SELECT * FROM buku 
    WHERE stok BETWEEN 5 AND 10 AND is_deleted = 0;

### 5. Buku yang pengarangnya "Budi Raharjo"
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/200b5dff-d06d-4166-8a57-ffe4bcf04d81" />

    SELECT * FROM buku 
    WHERE pengarang = 'Budi Raharjo' AND is_deleted = 0;

## Grouping dan Agregasi (3 query):
### 1. Jumlah buku per kategori (dengan total stok per kategori)
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/c104ab3f-392f-4a5f-8af0-557463853b0e" />

    SELECT kategori, COUNT(*) AS jumlah_judul, SUM(stok) AS total_stok 
    FROM buku 
    WHERE is_deleted = 0 
    GROUP BY kategori;

### 2. Rata-rata harga per kategori
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/01d9d14d-2a27-44fa-ac35-72ad5c33f74c" />

    SELECT kategori, AVG(harga) AS rata_rata_harga 
    FROM buku 
    WHERE is_deleted = 0 
    GROUP BY kategori;

### 3. Kategori dengan total nilai inventaris terbesar
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/a21f24da-753c-480d-8b94-0db879fff8a0" />

    SELECT kategori, SUM(harga * stok) AS total_nilai_inventaris 
    FROM buku 
    WHERE is_deleted = 0 
    GROUP BY kategori 
    ORDER BY total_nilai_inventaris DESC 
    LIMIT 1;

## Update Data (2 query):
### 1. Naikkan harga semua buku kategori Programming sebesar 5%
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/dc51a246-6877-4753-9fe9-b232f0e3dcea" />

    UPDATE buku 
    SET harga = harga * 1.05 
    WHERE kategori = 'Programming' AND is_deleted = 0;

### 2. Tambah stok 10 untuk semua buku yang stoknya < 5
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/2de3d7e7-b3ec-4b73-a744-d0c1ae7dce6e" />

      UPDATE buku 
      SET stok = stok + 10 
      WHERE stok < 5 AND is_deleted = 0;

## Laporan Khusus (2 query):
### 1. Daftar buku yang perlu restocking (stok < 5)
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/2a1ab93f-4a1c-40ec-816b-581ef7f71976" />

    SELECT kode_buku, judul, stok, penerbit 
    FROM buku 
    WHERE stok < 5 AND is_deleted = 0;

### 2. Top 5 buku termahal
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/fb9a5020-fe4e-4dbd-8fda-70ad4d5c65f7" />

    SELECT kode_buku, judul, kategori, harga
    FROM buku 
    WHERE is_deleted = 0 
    ORDER BY harga DESC 
    LIMIT 5;

# Tugas 2: Desain Database Lengkap
## 1. ERD
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/4c59c3ad-49d5-468c-99e6-0d14b6ef4a23" />

## 2. Screenshot
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/537bdaff-3042-47b3-b441-2ec1b3179770" />

### 1. Modifikasi Tabel Buku:
* Ganti kolom kategori (ENUM) menjadi id_kategori (INT)
* Ganti kolom penerbit (VARCHAR) menjadi id_penerbit (INT)

### 2. Tambahkan FOREIGN KEY
Data yang harus diisi:
* Minimal 5 kategori
* Minimal 5 penerbit
* Minimal 15 buku dengan relasi yang benar

### 3. Query yang harus dibuat:
1. JOIN untuk tampilkan buku dengan nama kategori dan penerbit
   <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/8198d8cc-e154-47b3-bcf7-dfcb72e9e1d8" />

       SELECT 
            b.id_buku,
            b.kode_buku,
            b.judul,
            b.pengarang,
            k.nama_kategori,
            p.nama_penerbit
        FROM buku b
        LEFT JOIN kategori_buku k ON b.id_kategori = k.id_kategori
        LEFT JOIN penerbit p ON b.id_penerbit = p.id_penerbit
        WHERE b.is_deleted = 0;

2. Jumlah buku per kategori
   <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/59972f6e-e682-432c-bbfd-9f429a3f048c" />

       SELECT 
            k.nama_kategori,
            IFNULL(SUM(b.stok), 0) AS total_stok_buku
        FROM kategori_buku k
        LEFT JOIN buku b ON k.id_kategori = b.id_kategori AND b.is_deleted = 0
        GROUP BY k.id_kategori, k.nama_kategori;

4. Jumlah buku per penerbit
   <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/d394888a-4e1b-4f80-a0ad-38833f51d996" />
   
       SELECT 
            p.nama_penerbit,
            IFNULL(SUM(b.stok), 0) AS total_stok_buku
        FROM penerbit p
        LEFT JOIN buku b ON p.id_penerbit = b.id_penerbit AND b.is_deleted = 0
        GROUP BY p.id_penerbit, p.nama_penerbit;
   
5. Buku beserta detail lengkap (kategori + penerbit)
   <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/0298b446-1e89-463e-ab62-263ec7ae59a6" />
           
       SELECT 
            b.id_buku,
            b.kode_buku,
            b.judul,
            b.pengarang,
            b.tahun_terbit,
            b.isbn,
            b.harga,
            b.stok,
            b.deskripsi,
            IFNULL(k.nama_kategori, 'Belum Diatur') AS kategori,
            IFNULL(p.nama_penerbit, 'Belum Diatur') AS penerbit,
            IFNULL(r.nama_rak, 'Belum Diatur') AS nama_rak,
            IFNULL(r.lokasi, 'Belum Diatur') AS lokasi_rak
        FROM buku b
        LEFT JOIN kategori_buku k ON b.id_kategori = k.id_kategori
        LEFT JOIN penerbit p ON b.id_penerbit = p.id_penerbit
        LEFT JOIN rak r ON b.id_rak = r.id_rak
        WHERE b.is_deleted = 0;

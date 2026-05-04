-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2026 at 02:10 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int NOT NULL,
  `kode_anggota` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `tanggal_daftar` date NOT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `kode_anggota`, `nama`, `email`, `telepon`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `pekerjaan`, `tanggal_daftar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AGT-001', 'Budi Santoso', 'budi.santoso@email.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta', '1995-05-15', 'Laki-laki', 'Mahasiswa', '2024-01-10', 'Aktif', '2026-05-04 13:24:59', '2026-05-04 13:24:59'),
(2, 'AGT-002', 'Siti Nurhaliza', 'siti.nur@email.com', '081234567891', 'Jl. Sudirman No. 25, Bandung', '1998-08-20', 'Perempuan', 'Pegawai', '2024-01-15', 'Aktif', '2026-05-04 13:24:59', '2026-05-04 13:24:59'),
(3, 'AGT-003', 'Ahmad Dhani', 'ahmad.dhani@email.com', '081234567892', 'Jl. Gatot Subroto No. 5, Surabaya', '1992-03-10', 'Laki-laki', 'Pegawai', '2024-02-01', 'Aktif', '2026-05-04 13:24:59', '2026-05-04 13:24:59'),
(4, 'AGT-004', 'Dewi Lestari', 'dewi.lestari@email.com', '081234567893', 'Jl. Ahmad Yani No. 30, Yogyakarta', '2000-12-05', 'Perempuan', 'Mahasiswa', '2024-02-10', 'Aktif', '2026-05-04 13:24:59', '2026-05-04 13:24:59'),
(5, 'AGT-005', 'Rizky Febian', 'rizky.feb@email.com', '081234567894', 'Jl. Diponegoro No. 15, Semarang', '1997-07-18', 'Laki-laki', 'Pelajar', '2024-02-15', 'Nonaktif', '2026-05-04 13:24:59', '2026-05-04 13:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `kategori` enum('Programming','Database','Web Design','Networking') NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` int NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul`, `kategori`, `pengarang`, `penerbit`, `tahun_terbit`, `isbn`, `harga`, `stok`, `deskripsi`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'BK-001', 'Pemrograman PHP untuk Pemula', 'Programming', 'Budi Raharjo', 'Informatika', 2023, '978-602-1234-56-1', '113135.00', 20, 'Buku panduan PHP terbaru edisi revisi', '2026-05-04 13:16:59', '2026-05-04 13:20:34', 0),
(2, 'BK-002', 'Mastering MySQL Database', 'Database', 'Andi Nugroho', 'Graha Ilmu', 2022, '978-602-1234-56-2', '126445.00', 5, 'Panduan komprehensif administrasi dan optimasi MySQL', '2026-05-04 13:16:59', '2026-05-04 13:20:34', 0),
(3, 'BK-003', 'Laravel Framework Advanced', 'Programming', 'Siti Aminah', 'Informatika', 2024, '978-602-1234-56-3', '125000.00', 13, 'Teknik advanced development dengan Laravel framework', '2026-05-04 13:16:59', '2026-05-04 13:19:02', 0),
(4, 'BK-004', 'Web Design Principles', 'Web Design', 'Dedi Santoso', 'Andi', 2023, '978-602-1234-56-4', '113135.00', 15, 'Prinsip dan best practice dalam desain web modern', '2026-05-04 13:16:59', '2026-05-04 13:20:34', 0),
(6, 'BK-006', 'PHP Web Services', 'Programming', 'Budi Raharjo', 'Informatika', 2024, '978-602-1234-56-6', '90000.00', 17, 'Membangun RESTful API dengan PHP', '2026-05-04 13:16:59', '2026-05-04 13:19:02', 0),
(7, 'BK-007', 'PostgreSQL Advanced', 'Database', 'Ahmad Yani', 'Graha Ilmu', 2024, '978-602-1234-56-7', '115000.00', 7, 'Teknik advanced PostgreSQL untuk enterprise', '2026-05-04 13:16:59', '2026-05-04 13:16:59', 0),
(9, 'BK-008', 'JavaScript Modern', 'Programming', 'Siti Aminah', 'Informatika', 2023, NULL, '80000.00', 5, NULL, '2026-05-04 13:22:43', '2026-05-04 13:23:07', 1),
(10, 'BK-009', 'React Native Development', 'Programming', 'Ahmad Yani', 'Informatika', 2024, NULL, '135000.00', 10, NULL, '2026-05-04 13:22:43', '2026-05-04 13:22:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `id_buku` int NOT NULL,
  `id_anggota` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `tanggal_harus_kembali` date NOT NULL,
  `status` enum('Dipinjam','Dikembalikan','Terlambat') DEFAULT 'Dipinjam',
  `denda` decimal(10,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_buku`, `id_anggota`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_harus_kembali`, `status`, `denda`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-02-01', NULL, '2024-02-08', 'Dipinjam', '0.00', '2026-05-04 13:25:44', '2026-05-04 13:25:44'),
(2, 2, 2, '2024-02-03', NULL, '2024-02-10', 'Dipinjam', '0.00', '2026-05-04 13:25:44', '2026-05-04 13:25:44'),
(3, 3, 1, '2024-01-25', NULL, '2024-02-01', 'Dikembalikan', '0.00', '2026-05-04 13:25:44', '2026-05-04 13:25:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `kode_anggota` (`kode_anggota`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

------------------------------------
--- TUGAS QUERY SQL PERPUSTAKAAN ---
------------------------------------

-- Statistik Buku (5 query)

-- 1.1 Total buku seluruhnya (jumlah judul)
SELECT COUNT(*) AS total_judul_buku FROM buku;

-- 1.2 Total nilai inventaris (sum harga x stok)
SELECT SUM(harga * stok) AS total_nilai_inventaris FROM buku;

-- 1.3 Rata-rata harga buku
SELECT AVG(harga) AS rata_rata_harga FROM buku;

-- 1.4 Buku termahal (judul dan harga)
SELECT judul, harga FROM buku 
ORDER BY harga DESC 
LIMIT 1;

-- 1.5 Buku dengan stok terbanyak
SELECT judul, stok FROM buku 
ORDER BY stok DESC 
LIMIT 1;

-- Filter dan Pencarian (5 query)

-- 2.1 Semua buku kategori Programming yang harga < 100.000
SELECT * FROM buku 
WHERE kategori = 'Programming' AND harga < 100000;

-- 2.2 Buku yang judulnya mengandung kata "PHP" atau "MySQL"
SELECT * FROM buku 
WHERE judul LIKE '%PHP%' OR judul LIKE '%MySQL%';

-- 2.3 Buku yang terbit tahun 2024
SELECT * FROM buku 
WHERE tahun_terbit = 2024;

-- 2.4 Buku yang stoknya antara 5-10
SELECT * FROM buku 
WHERE stok BETWEEN 5 AND 10;

-- 2.5 Buku yang pengarangnya "Budi Raharjo"
SELECT * FROM buku 
WHERE pengarang = 'Budi Raharjo';

-- Grouping dan Agregasi (3 query)

-- 3.1 Jumlah buku per kategori (dengan total stok per kategori)
SELECT kategori, COUNT(*) AS jumlah_judul, SUM(stok) AS total_stok 
FROM buku 
GROUP BY kategori;

-- 3.2 Rata-rata harga per kategori
SELECT kategori, AVG(harga) AS rata_rata_harga_kategori 
FROM buku 
GROUP BY kategori;

-- 3.3 Kategori dengan total nilai inventaris terbesar
SELECT kategori, SUM(harga * stok) AS nilai_inventaris 
FROM buku 
GROUP BY kategori 
ORDER BY nilai_inventaris DESC 
LIMIT 1;

-- Update Data (2 query)

-- 4.1 Naikkan harga semua buku kategori Programming sebesar 5%
UPDATE buku 
SET harga = harga * 1.05 
WHERE kategori = 'Programming';

-- Verifikasi perubahan
SELECT judul, kategori, harga 
FROM buku 
WHERE kategori = 'Programming';

-- 4.2 Tambah stok 10 untuk semua buku yang stoknya < 5
UPDATE buku 
SET stok = stok + 10 
WHERE stok < 5;

-- Verifikasi perubahan
SELECT * FROM buku WHERE stok;

-- Laporan Khusus (2 query)
-- 5.1 Daftar buku yang perlu restocking (stok < 5)
SELECT judul, pengarang, stok 
FROM buku 
WHERE stok < 5;

-- 5.2 Top 5 buku termahal
SELECT judul, pengarang, harga 
FROM buku 
ORDER BY harga DESC 
LIMIT 5;
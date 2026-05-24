-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2026 at 08:56 AM
-- Server version: 8.4.3
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_2`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_buku` (IN `p_judul` VARCHAR(100), IN `p_pengarang` VARCHAR(100), IN `p_tahun` INT, IN `p_kategori` INT, IN `p_penerbit` INT, IN `p_rak` INT)   BEGIN
    INSERT INTO buku (judul, pengarang, tahun_terbit, id_kategori, id_penerbit, id_rak)
    VALUES (p_judul, p_pengarang, p_tahun, p_kategori, p_penerbit, p_rak);
END$$

DELIMITER ;

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
(1, 'AGT-001', 'Budi Santoso', 'budi.santoso@email.com', '081234567890', 'Jl. Merdeka No. 10, Jakarta', '1995-05-15', 'Laki-laki', 'Mahasiswa', '2024-01-10', 'Aktif', '2026-05-17 07:27:03', '2026-05-17 07:27:03'),
(2, 'AGT-002', 'Siti Nurhaliza', 'siti.nur@email.com', '081234567891', 'Jl. Sudirman No. 25, Bandung', '1998-08-20', 'Perempuan', 'Pegawai', '2024-01-15', 'Aktif', '2026-05-17 07:27:03', '2026-05-17 07:27:03'),
(3, 'AGT-003', 'Ahmad Dhani', 'ahmad.dhani@email.com', '081234567892', 'Jl. Gatot Subroto No. 5, Surabaya', '1992-03-10', 'Laki-laki', 'Pegawai', '2024-02-01', 'Aktif', '2026-05-17 07:27:03', '2026-05-17 07:27:03'),
(4, 'AGT-004', 'Dewi Lestari', 'dewi.lestari@email.com', '081234567893', 'Jl. Ahmad Yani No. 30, Yogyakarta', '2000-12-05', 'Perempuan', 'Mahasiswa', '2024-02-10', 'Aktif', '2026-05-17 07:27:03', '2026-05-17 07:27:03'),
(5, 'AGT-005', 'Rizky Febian', 'rizky.feb@email.com', '081234567894', 'Jl. Diponegoro No. 15, Semarang', '1997-07-18', 'Laki-laki', 'Pelajar', '2024-02-15', 'Nonaktif', '2026-05-17 07:27:03', '2026-05-17 07:27:03');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `tahun_terbit` int NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) DEFAULT '0',
  `id_kategori` int DEFAULT NULL,
  `id_penerbit` int DEFAULT NULL,
  `id_rak` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul`, `pengarang`, `tahun_terbit`, `isbn`, `harga`, `stok`, `deskripsi`, `created_at`, `updated_at`, `is_deleted`, `id_kategori`, `id_penerbit`, `id_rak`) VALUES
(1, 'BK-001', 'Pemrograman PHP untuk Pemula', 'Budi Raharjo', 2023, '978-602-1234-56-1', 93500.00, 20, 'Buku panduan PHP terbaru edisi revisi', '2026-05-17 07:20:50', '2026-05-17 07:24:31', 0, NULL, NULL, NULL),
(2, 'BK-002', 'Mastering MySQL Database', 'Andi Nugroho', 2022, '978-602-1234-56-2', 104500.00, 5, 'Panduan komprehensif administrasi dan optimasi MySQL', '2026-05-17 07:20:50', '2026-05-17 07:24:31', 0, NULL, NULL, NULL),
(3, 'BK-003', 'Laravel Framework Advanced', 'Siti Aminah', 2024, '978-602-1234-56-3', 125000.00, 13, 'Teknik advanced development dengan Laravel framework', '2026-05-17 07:20:50', '2026-05-17 07:24:20', 0, NULL, NULL, NULL),
(4, 'BK-004', 'Web Design Principles', 'Dedi Santoso', 2023, '978-602-1234-56-4', 93500.00, 15, 'Prinsip dan best practice dalam desain web modern', '2026-05-17 07:20:50', '2026-05-17 07:24:31', 0, NULL, NULL, NULL),
(6, 'BK-006', 'PHP Web Services', 'Budi Raharjo', 2024, '978-602-1234-56-6', 90000.00, 17, 'Membangun RESTful API dengan PHP', '2026-05-17 07:20:50', '2026-05-17 07:24:20', 0, NULL, NULL, NULL),
(7, 'BK-007', 'PostgreSQL Advanced', 'Ahmad Yani', 2024, '978-602-1234-56-7', 115000.00, 7, 'Teknik advanced PostgreSQL untuk enterprise', '2026-05-17 07:20:50', '2026-05-17 07:20:50', 0, NULL, NULL, NULL),
(9, 'BK-008', 'JavaScript Modern', 'Siti Aminah', 2023, NULL, 80000.00, 5, NULL, '2026-05-17 07:25:45', '2026-05-17 07:26:15', 1, NULL, NULL, NULL),
(10, 'BK-009', 'React Native Development', 'Ahmad Yani', 2024, NULL, 135000.00, 10, NULL, '2026-05-17 07:25:45', '2026-05-17 07:25:45', 0, NULL, NULL, NULL),
(11, 'BK-010', 'Logika Pemrograman Python', 'Hendra Wijaya', 2024, '978-602-9988-11-0', 85000.00, 15, 'Buku panduan dasar algoritma dan logika menggunakan Python.', '2026-05-17 08:37:10', '2026-05-17 08:49:58', 0, 1, 5, 1),
(12, 'BK-011', 'Optimasi Query MySQL untuk Pemula', 'Andi Nugroho', 2023, '978-602-9988-12-7', 95000.00, 8, 'Trik mempercepat performa database dan pembuatan indexing.', '2026-05-17 08:37:10', '2026-05-17 08:49:58', 0, 2, 2, 2),
(13, 'BK-012', 'Desain Web Landing Page dengan Tailwind CSS', 'Siti Aminah', 2025, '978-602-9988-13-4', 79000.00, 12, 'Panduan praktis membuat website responsif ala modern agency.', '2026-05-17 08:37:10', '2026-05-17 08:49:58', 0, 3, 1, 3),
(14, 'BK-013', 'Membangun Jaringan Warnet & Kantor Kecil', 'Melani Putri', 2022, '978-602-9988-14-1', 68000.00, 7, 'Langkah demi langkah setting router, crimping kabel, dan sharing printer.', '2026-05-17 08:37:10', '2026-05-17 08:49:58', 0, 4, 4, 4),
(15, 'BK-014', 'Analisis Data Ringan dengan Pandas dan NumPy', 'Hendra Wijaya', 2024, '978-602-9988-15-8', 110000.00, 10, 'Belajar dasar-dasar ilmu data science untuk pemula non-IT.', '2026-05-17 08:37:10', '2026-05-17 08:49:58', 0, 5, 5, 5),
(16, 'BK-015', 'Rest API Laravel 10 & Vue JS', 'Budi Raharjo', 2024, '978-602-9988-16-5', 125000.00, 14, 'Studi kasus membuat aplikasi Fullstack Decoupled Architecture.', '2026-05-17 08:37:10', '2026-05-17 08:49:58', 0, 1, 1, 1),
(17, 'BK-016', 'Pengantar Administrasi Database PostgreSQL', 'Ahmad Yani', 2023, '978-602-9988-17-2', 105000.00, 6, 'Mengenal replikasi data dan manajemen user privilese pada Postgres.', '2026-05-17 08:37:10', '2026-05-17 08:49:58', 0, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori`, `nama_kategori`, `deskripsi`, `created_at`) VALUES
(1, 'Teknologi', 'Buku tentang IT dan komputer', '2026-05-17 08:21:07'),
(2, 'Sains', 'Buku ilmu pengetahuan', '2026-05-17 08:21:07'),
(3, 'Sejarah', 'Buku sejarah dunia', '2026-05-17 08:21:07'),
(4, 'Novel', 'Buku cerita fiksi', '2026-05-17 08:21:07'),
(5, 'Pendidikan', 'Buku pelajaran', '2026-05-17 08:21:07');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int NOT NULL,
  `nama_penerbit` varchar(100) NOT NULL,
  `alamat` text,
  `telepon` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`, `telepon`, `email`, `created_at`) VALUES
(1, 'Gramedia', 'Jakarta', '0811111111', 'gramedia@email.com', '2026-05-17 08:21:41'),
(2, 'Erlangga', 'Bandung', '0822222222', 'erlangga@email.com', '2026-05-17 08:21:41'),
(3, 'Mizan', 'Bandung', '0833333333', 'mizan@email.com', '2026-05-17 08:21:41'),
(4, 'Andi Offset', 'Yogyakarta', '0844444444', 'andi@email.com', '2026-05-17 08:21:41'),
(5, 'Deepublish', 'Yogyakarta', '0855555555', 'deepublish@email.com', '2026-05-17 08:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id_rak` int NOT NULL,
  `kode_rak` varchar(20) NOT NULL,
  `nama_rak` varchar(50) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id_rak`, `kode_rak`, `nama_rak`, `lokasi`, `created_at`) VALUES
(1, 'R01', 'Rak Teknologi', 'Lantai 1', '2026-05-17 08:49:05'),
(2, 'R02', 'Rak Sains', 'Lantai 1', '2026-05-17 08:49:05'),
(3, 'R03', 'Rak Sejarah', 'Lantai 2', '2026-05-17 08:49:05'),
(4, 'R04', 'Rak Novel', 'Lantai 2', '2026-05-17 08:49:05'),
(5, 'R05', 'Rak Pendidikan', 'Lantai 3', '2026-05-17 08:49:05');

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
(1, 1, 1, '2024-02-01', NULL, '2024-02-08', 'Dipinjam', 0.00, '2026-05-17 07:28:07', '2026-05-17 07:28:07'),
(2, 2, 2, '2024-02-03', NULL, '2024-02-10', 'Dipinjam', 0.00, '2026-05-17 07:28:07', '2026-05-17 07:28:07'),
(3, 3, 1, '2024-01-25', NULL, '2024-02-01', 'Dikembalikan', 0.00, '2026-05-17 07:28:07', '2026-05-17 07:28:07');

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
  ADD UNIQUE KEY `kode_buku` (`kode_buku`),
  ADD KEY `fk_kategori` (`id_kategori`),
  ADD KEY `fk_penerbit` (`id_penerbit`),
  ADD KEY `fk_rak` (`id_rak`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id_rak`),
  ADD UNIQUE KEY `kode_rak` (`kode_rak`);

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
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id_rak` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_buku` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penerbit` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rak` FOREIGN KEY (`id_rak`) REFERENCES `rak` (`id_rak`) ON DELETE SET NULL ON UPDATE CASCADE;

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
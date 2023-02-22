-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 04:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sidang`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` int(11) NOT NULL,
  `nama_cuti` varchar(255) NOT NULL,
  `batas_hari` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `nama_cuti`, `batas_hari`) VALUES
(1, 'Cuti Tahunan', 12),
(2, 'Cuti Melahirkan', 0),
(3, 'Cuti Menikah', 0),
(4, 'Cuti Kerabat Meninggal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_cuti`
--

CREATE TABLE `data_cuti` (
  `id` int(11) NOT NULL,
  `id_cuti` int(11) NOT NULL,
  `nip` bigint(20) NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `status_approval` varchar(20) NOT NULL,
  `nip_atasan` bigint(20) NOT NULL,
  `tanggal_pengajuan` datetime NOT NULL,
  `tgl_mulai_cuti` date NOT NULL,
  `tgl_akhir_cuti` date NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_cuti`
--

INSERT INTO `data_cuti` (`id`, `id_cuti`, `nip`, `jumlah_hari`, `status_approval`, `nip_atasan`, `tanggal_pengajuan`, `tgl_mulai_cuti`, `tgl_akhir_cuti`, `id_jabatan`) VALUES
(1, 1, 1791209830491805, 2, 'SUCCESS', 1791209830491801, '2023-02-20 00:00:00', '2023-02-20', '2023-02-21', 6),
(2, 3, 1791209830491805, 1, 'PENDING', 1791209830491801, '2023-02-20 00:00:00', '2023-02-24', '2023-02-24', 6),
(3, 1, 1791209830491805, 3, 'FAILED', 1791209830491801, '2023-02-21 00:00:00', '2023-02-28', '2023-03-02', 6),
(5, 1, 1791209830491805, 2, 'SUCCESS', 1791209830491801, '2023-02-21 00:00:00', '2023-02-28', '2023-03-01', 6),
(6, 1, 1791209830491805, 1, 'SUCCESS', 1791209830491801, '2023-02-21 00:00:00', '2023-02-28', '2023-02-28', 6),
(7, 1, 1791209830491805, 1, 'SUCCESS', 1791209830491801, '2023-02-21 00:00:00', '2023-01-30', '2023-01-30', 6);

-- --------------------------------------------------------

--
-- Table structure for table `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(20) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `gaji_pokok` bigint(20) NOT NULL,
  `transport` bigint(20) NOT NULL,
  `uang_makan` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `transport`, `uang_makan`) VALUES
(2, 'Admin', 3500000, 200000, 300000),
(3, 'HR External Staff', 2500000, 200000, 300000),
(4, 'President Director', 5500000, 200000, 300000),
(5, 'HR Internal Staff', 3700000, 200000, 300000),
(6, 'Exim Staff', 3200000, 200000, 300000),
(7, 'PPIC & Logistic Manager', 4100000, 200000, 300000),
(8, 'Operational Director', 5200000, 200000, 300000),
(9, 'Quality Control Staff', 3120000, 200000, 300000),
(10, 'Coordinator Shift', 4320000, 200000, 300000),
(11, 'Purchasing Staff', 4330000, 200000, 300000),
(12, 'Press Head', 4400000, 200000, 300000),
(13, 'Sales & Marketing Staff', 3700000, 200000, 300000),
(14, 'Export & Logistic Admin', 4530000, 200000, 300000),
(15, 'Accounting & Finance Admin', 5320000, 200000, 300000),
(16, 'Maintenance Operator', 4560000, 200000, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `data_kehadiran`
--

CREATE TABLE `data_kehadiran` (
  `id_kehadiran` int(20) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `nip` bigint(20) DEFAULT NULL,
  `hadir` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `alpha` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_kehadiran`
--

INSERT INTO `data_kehadiran` (`id_kehadiran`, `bulan`, `nip`, `hadir`, `izin`, `sakit`, `alpha`, `id_jabatan`) VALUES
(1, '022023', 1791209830492812, 20, 0, 0, 5, 9),
(2, '022023', 1791209830491806, 25, 0, 0, 0, 3),
(3, '022023', 1791209830491807, 25, 0, 0, 0, 2),
(4, '022023', 1791209830491809, 25, 0, 0, 0, 16),
(5, '022023', 17912098304918010, 25, 0, 0, 0, 12),
(6, '022023', 1791209830491808, 25, 0, 0, 0, 13),
(7, '022023', 1791209830491801, 25, 0, 0, 0, 4),
(8, '022023', 17912098304928116, 25, 0, 0, 0, 3),
(9, '022023', 17912098304928113, 25, 0, 0, 0, 3),
(10, '022023', 1791209830491912, 24, 0, 0, 1, 10),
(11, '022023', 17912098304928115, 23, 0, 0, 2, 10),
(12, '022023', 17912098304918012, 25, 0, 0, 0, 11),
(13, '022023', 1791209830491802, 25, 0, 0, 0, 8),
(14, '022023', 17912098304928114, 25, 0, 0, 0, 10),
(15, '022023', 1791209830491805, 25, 0, 0, 0, 6),
(16, '022023', 17912098304918011, 25, 0, 0, 0, 6),
(17, '012023', 1791209830492812, 25, 0, 0, 0, 9),
(18, '012023', 1791209830491806, 25, 0, 0, 0, 3),
(19, '012023', 1791209830491807, 25, 0, 0, 0, 2),
(20, '012023', 1791209830491809, 25, 0, 0, 0, 16),
(21, '012023', 17912098304918010, 25, 0, 0, 0, 12),
(22, '012023', 1791209830491808, 25, 0, 0, 0, 13),
(23, '012023', 1791209830491801, 25, 0, 0, 0, 4),
(24, '012023', 17912098304928116, 25, 0, 0, 0, 3),
(25, '012023', 17912098304928113, 25, 0, 0, 0, 3),
(26, '012023', 1791209830491912, 25, 0, 0, 0, 10),
(27, '012023', 17912098304928115, 25, 0, 0, 0, 10),
(28, '012023', 17912098304918012, 25, 0, 0, 0, 11),
(29, '012023', 1791209830491802, 25, 0, 0, 0, 8),
(30, '012023', 17912098304928114, 25, 0, 0, 0, 10),
(31, '012023', 1791209830491805, 24, 0, 0, 0, 6),
(32, '012023', 17912098304918011, 25, 0, 0, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `nip` bigint(20) NOT NULL,
  `nama_pegawai` varchar(200) NOT NULL,
  `nik` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_jabatan` int(20) DEFAULT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `no_telp` bigint(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `id_akses` int(11) DEFAULT NULL,
  `status_keaktifan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`nip`, `nama_pegawai`, `nik`, `username`, `password`, `id_jabatan`, `jenis_kelamin`, `alamat`, `no_telp`, `email`, `tgl_masuk`, `status`, `photo`, `id_akses`, `status_keaktifan`) VALUES
(1791209830491801, 'Hendry Djahja', 3103846890002394, 'hendry', '81dc9bdb52d04dc20036dbd8313ed055', 4, 'Laki-Laki', 'Jl. KH Agus Salim 16, Sabang, Menteng Jakarta Pusat', 81274857362, 'hendrydjahja@gmail.com', '2012-02-06', 'Pegawai Tetap', 'boy7.png', 3, 'Aktif'),
(1791209830491802, 'Richard Djahja', 3302846820002197, 'richard', '81dc9bdb52d04dc20036dbd8313ed055', 8, 'Laki-Laki', 'JL. Tebet Raya No. 84, Tebet, Jakarta Selatan', 81222691988, 'richarddjahja@gmail.com', '2012-02-01', 'Pegawai Tetap', 'boy8.png', 2, 'Aktif'),
(1791209830491805, 'Yana', 3321846230002213, 'yana', '81dc9bdb52d04dc20036dbd8313ed055', 6, 'Laki-Laki', 'Jl. Metro Pondok Indah Kav. IV, Kebayoran Lama, Jakarta Selatan', 81245760990, 'yana@gmail.com', '2023-02-06', 'Pegawai Tetap', 'boy32.png', 2, 'Aktif'),
(1791209830491806, 'Dijah', 3318246420002237, 'dijah', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'Perempuan', 'Jl. Setiabudi Tengah No. 3, Jakarta Selatan 12910', 81260217971, 'dijah@gmail.com', '2023-02-05', 'Pegawai Tetap', 'boy21.png', 2, 'Aktif'),
(1791209830491807, 'Dwitya', 3662442312000091, 'dwitya', '81dc9bdb52d04dc20036dbd8313ed055', 2, 'Perempuan', 'Jalan Gunung Sahari 11 Kecil Nomor 22,RT 3 RW 3, Jakarta ', 81282388488, 'dwitya@gmail.com', '2016-01-01', 'Pegawai Tetap', 'girl12.jpeg', 1, 'Aktif'),
(1791209830491808, 'Havita Safitri', 3954818850002169, 'havita', '81dc9bdb52d04dc20036dbd8313ed055', 13, 'Perempuan', 'Jalan Bonang No. 19. RT 2/RW 5 Menteng, Jakarta Pusat', 81285539295, 'havitaf@gmail.com', '2017-01-01', 'Pegawai Tetap', 'girl121.jpeg', 2, 'Aktif'),
(1791209830491809, 'Fadlan', 3132892820002168, 'fadlan', '81dc9bdb52d04dc20036dbd8313ed055', 16, 'Laki-Laki', 'Jl. Seulawah Raya no. B-3, Kompleks TNI AU Waringin Permai, Jatiwaringin, Kelurahan Cipinang Melayu, Kecamatan Makasar, Jakarta Timur 13620', 81285550385, 'fadlan1@gmail.com', '2019-01-28', 'Pegawai Tetap', 'boy33.png', 2, 'Aktif'),
(1791209830491912, 'Murdoko', 6702656820002218, 'murdoko', '81dc9bdb52d04dc20036dbd8313ed055', 10, 'Laki-Laki', 'Jl Pramuka Sari 5 no 7, Rawasari, Cempaka Putih, Jakarta Pusat. Belakang Hotel Sentral', 82292245433, 'murd0k0@gmail.com', '2023-01-31', 'Pegawai Tetap', 'boy35.png', 2, 'Aktif'),
(1791209830492812, 'Arif B.', 3103846890002394, 'arif', '81dc9bdb52d04dc20036dbd8313ed055', 9, 'Laki-Laki', 'Jln. Raden Saleh Raya no 37 Cikini Jakarta Pusat ', 82311884417, 'arifb2@gmail.com', '2017-01-31', 'Pegawai Tetap', 'boy42.png', 2, 'Aktif'),
(17912098304918010, 'Haryono', 3321473950002449, 'haryono', '81dc9bdb52d04dc20036dbd8313ed055', 12, 'Laki-Laki', 'Jl. Kemuning Raya No. 1 RT/RW 012/02 Utan Kayu Utara, Kec. Matraman – Jakarta Timur', 81297145562, 'hary08@gmail.com', '2019-12-02', 'Pegawai Tetap', 'boy41.png', 2, 'Aktif'),
(17912098304918011, 'Yulia', 3213849360002420, 'yulia', '81dc9bdb52d04dc20036dbd8313ed055', 6, 'Perempuan', 'Jalan Pulo Raya V No.14, Kebayoran Baru, Jakarta Selatan 12170 (Belakang Kantor Walikota Jakarta Selatan)', 81355255781, 'yulia02@gmail.com', '2011-02-07', 'Pegawai Tetap', 'girl4.jpeg', 2, 'Aktif'),
(17912098304918012, 'Riana', 3127493857460234, 'riana', '81dc9bdb52d04dc20036dbd8313ed055', 11, 'Perempuan', 'Jl. Martapura III No. 4 dan No 8, Kebon Melati, Tanah Abang, Jakarta Pusat 10230', 82259710745, 'r1ana@gmail.com', '2017-02-01', 'Pegawai Tetap', 'girl31.jpeg', 2, 'Aktif'),
(17912098304928113, 'Lasma Pardosi', 6948576689000391, 'lasma', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'Perempuan', 'Jl. Kramat Jaya Baru 3 No. 14 RW/RT: 01/15 Kel/Kec: Johar Baru – Jakarta Pusat', 82312446655, 'lasma.pardosi@gloryoffset.com', '2017-02-14', 'Pegawai Tetap', 'girl5.jpeg', 1, 'Aktif'),
(17912098304928114, 'Syafrudin', 6384028490002394, 'syafrudin', '81dc9bdb52d04dc20036dbd8313ed055', 10, 'Laki-Laki', 'Green Garden Blok B13 No.27 Kel. Rorotan Kec. Cilincing Jakarta Utara', 85227777728, 'syafrudin@gmail.com', '2016-02-17', 'Pegawai Tetap', 'boy36.png', 2, 'Aktif'),
(17912098304928115, 'Nuroso', 6503843850002394, 'nuroso', '81dc9bdb52d04dc20036dbd8313ed055', 10, 'Laki-Laki', 'Jl. Gunung Sahari XI No. 24 RT 3/3, Jakarta Pusat (Belakang BNI 46)', 83841212099, 'nuroso@gmail.com', '2019-01-15', 'Pegawai Tetap', 'boy43.png', 2, 'Aktif'),
(17912098304928116, 'Kevin Hansdinata', 1234567890987650, 'kevin', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'Laki-Laki', 'UBM', 81348212340, 'kevin@gmail.com', '2023-01-01', 'Pegawai Tetap', 'boy9.png', 2, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_akses` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_akses`, `keterangan`) VALUES
(1, 'admin'),
(2, 'pegawai'),
(3, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `potongan_gaji`
--

CREATE TABLE `potongan_gaji` (
  `id_pot` int(11) NOT NULL,
  `potongan` varchar(50) NOT NULL,
  `jml_potongan` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `potongan_gaji`
--

INSERT INTO `potongan_gaji` (`id_pot`, `potongan`, `jml_potongan`) VALUES
(1, 'Jaminan Kesehatan (%)', 1),
(2, 'Jaminan Hari Tua (%)', 2),
(3, 'Jaminan Pensiun (%)', 1),
(4, 'Alpha (Dalam Rupiah)', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `relation_cuti_potongan`
--

CREATE TABLE `relation_cuti_potongan` (
  `id` int(11) NOT NULL,
  `id_cuti` int(11) NOT NULL,
  `col_jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relation_cuti_potongan`
--

INSERT INTO `relation_cuti_potongan` (`id`, `id_cuti`, `col_jabatan`) VALUES
(1, 1, 'uang_makan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_cuti`
--
ALTER TABLE `data_cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cuti` (`id_cuti`),
  ADD KEY `nip` (`nip`),
  ADD KEY `nip_atasan` (`nip_atasan`);

--
-- Indexes for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_akses` (`id_akses`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  ADD PRIMARY KEY (`id_pot`);

--
-- Indexes for table `relation_cuti_potongan`
--
ALTER TABLE `relation_cuti_potongan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cuti` (`id_cuti`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_cuti`
--
ALTER TABLE `data_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id_kehadiran` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  MODIFY `id_pot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `relation_cuti_potongan`
--
ALTER TABLE `relation_cuti_potongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_cuti`
--
ALTER TABLE `data_cuti`
  ADD CONSTRAINT `data_cuti_ibfk_1` FOREIGN KEY (`id_cuti`) REFERENCES `cuti` (`id`),
  ADD CONSTRAINT `data_cuti_ibfk_2` FOREIGN KEY (`nip`) REFERENCES `data_pegawai` (`nip`),
  ADD CONSTRAINT `data_cuti_ibfk_3` FOREIGN KEY (`nip_atasan`) REFERENCES `data_pegawai` (`nip`);

--
-- Constraints for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD CONSTRAINT `data_kehadiran_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `data_pegawai` (`nip`);

--
-- Constraints for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD CONSTRAINT `data_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `data_jabatan` (`id_jabatan`),
  ADD CONSTRAINT `data_pegawai_ibfk_2` FOREIGN KEY (`id_akses`) REFERENCES `hak_akses` (`id_akses`);

--
-- Constraints for table `relation_cuti_potongan`
--
ALTER TABLE `relation_cuti_potongan`
  ADD CONSTRAINT `relation_cuti_potongan_ibfk_1` FOREIGN KEY (`id_cuti`) REFERENCES `cuti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

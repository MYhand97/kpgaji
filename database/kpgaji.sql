-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 10:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpgaji`
--
CREATE DATABASE IF NOT EXISTS `kpgaji` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `kpgaji`;

-- --------------------------------------------------------

--
-- Table structure for table `dtkaryawan`
--

CREATE TABLE `dtkaryawan` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `bagian` varchar(100) NOT NULL,
  `tglmasuk` date NOT NULL,
  `jk` varchar(2) NOT NULL,
  `noktp` varchar(20) NOT NULL,
  `tmptlahir` varchar(100) NOT NULL,
  `tgllahir` date NOT NULL,
  `nokk` varchar(20) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `nmibu` varchar(150) NOT NULL,
  `npwp` varchar(16) NOT NULL,
  `bpjstk` varchar(15) NOT NULL,
  `bpjspensi` varchar(15) NOT NULL,
  `bpjskes` varchar(15) NOT NULL,
  `norek` varchar(11) NOT NULL,
  `notelp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dtkaryawan`
--

INSERT INTO `dtkaryawan` (`id`, `nik`, `nama`, `jabatan`, `bagian`, `tglmasuk`, `jk`, `noktp`, `tmptlahir`, `tgllahir`, `nokk`, `alamat`, `nmibu`, `npwp`, `bpjstk`, `bpjspensi`, `bpjskes`, `norek`, `notelp`) VALUES
(1, '1001001', 'Ina Permata', 'Cereal Production', 'Diskmill', '2020-05-08', 'P', '1123456789101213', 'Tangerang', '1995-10-11', '1234567891011121', 'JL.Permata Indah No.10 Rt.01/RW.003 Kel, Kec, Kota', 'ANU ANU', '123846192839472', '19839283088', '19839283088', '9890876543219', '9839203948', '109283746582'),
(2, '0110110', 'Tedjo Selamet', 'Production Packing', 'Line-3', '2020-01-10', 'L', '4211233098765432', 'Jakarta', '1998-06-25', '6987654322254321', 'Jl.Rumah Kita Blok H/10, RT.05/RW.003, Kec, Kel, Kota', 'Surti', '182937501928374', '91028394751', '91028394751', '9897649209823', '0983745820', '908746219238'),
(9, '4004001', 'Cantik', 'Production Packing', 'Line-1', '2020-01-20', 'P', '1123456789215432', 'Bali', '1990-05-25', '2345676421265432', 'AlamatNih', 'Munaroh', '092837468192037', '09203849501', '09203849501', '0009283745123', '0928347581', '092837465728');

-- --------------------------------------------------------

--
-- Table structure for table `fileabsen`
--

CREATE TABLE `fileabsen` (
  `id` int(11) NOT NULL,
  `tglupload` date NOT NULL,
  `nfile` varchar(100) NOT NULL,
  `tipefille` varchar(10) NOT NULL,
  `ukfile` varchar(20) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fileabsen`
--

-- INSERT INTO `fileabsen` (`id`, `tglupload`, `nfile`, `tipefille`, `ukfile`, `file`) VALUES
-- (1, '2020-05-05', 'Absen_23_Oktober_2020', 'docx', '471280', 'files/Absen_23_Oktober_2020.docx'),
-- (3, '2020-05-05', 'Ina Permata', 'docx', '8040334', 'files/Ina Permata.docx');

-- --------------------------------------------------------

--
-- Table structure for table `filegaji`
--

CREATE TABLE `filegaji` (
  `id` int(11) NOT NULL,
  `tglupload` date NOT NULL,
  `nfile` varchar(100) NOT NULL,
  `tipefile` varchar(10) NOT NULL,
  `ukfile` varchar(20) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filegaji`
--

--INSERT INTO `filegaji` (`id`, `tglupload`, `nfile`, `tipefile`, `ukfile`, `file`) VALUES
--(1, '2020-05-11', '16_April_2020_sd_15_Mei_2020', 'pdf', '36909', 'filesgaji/16_April_2020_sd_15_Mei_2020.pdf'),
--(3, '2020-05-11', 'absen_Oktober_2020', 'xls', '2305', 'filesgaji/absen_Oktober_2020.xls');

-- --------------------------------------------------------

--
-- Table structure for table `filekaryawan`
--

CREATE TABLE `filekaryawan` (
  `id` int(11) NOT NULL,
  `tglupload` date NOT NULL,
  `nfile` varchar(100) NOT NULL,
  `tipefile` varchar(10) NOT NULL,
  `ukfile` varchar(20) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filekaryawan`
--

--INSERT INTO `filekaryawan` (`id`, `tglupload`, `nfile`, `tipefile`, `ukfile`, `file`) VALUES
--(1, '2020-05-11', 'DataKaryawan_Januari', 'xls', '2305', 'fileskaryawan/DataKaryawan_Januari.xls');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `jbtan` varchar(100) NOT NULL,
  `bagian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `jbtan`, `bagian`) VALUES
(1, 'Production Packing', 'Line-1'),
(2, 'Production Packing', 'Line-2'),
(3, 'Production Packing', 'Line-3'),
(4, 'Production Packing', 'Line-4'),
(5, 'Production Packing', 'Line-5'),
(6, 'Production Packing', 'Line-6'),
(7, 'Production Packing', 'Line-7'),
(8, 'Cereal Production', 'Diskmill'),
(9, 'Cereal Production', 'Mixing'),
(10, 'Engineering Utility', 'Tata Udara'),
(11, 'Production Central Kitchen ', 'Grinding'),
(12, 'Production Central Kitchen', 'Mixing Line-1'),
(13, 'Production Central Kitchen', 'Mixing Line-2'),
(14, 'Production Central Kitchen', 'Mixing Line-3'),
(15, 'Production Central Kitchen', 'Mixing Line-4'),
(16, 'Production Central Kitchen', 'Mixing Line-5'),
(17, 'Production Central Kitchen', 'Mixing Line-6'),
(18, 'Production Central Kitchen', 'Mixing Line-7'),
(19, 'Production Packing', 'GDTP'),
(20, 'Production Packing', 'Manual In Carton'),
(21, 'Production Packing', 'Manual Suzuki'),
(22, 'Production Packing', 'Printing'),
(23, 'Technic Packing', 'Line'),
(24, 'Warehouse', 'MDC'),
(25, 'Warehouse', 'PM'),
(26, 'Warehouse', 'RM'),
(29, 'Production', 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `laporanabsen`
--

CREATE TABLE `laporanabsen` (
  `id` int(11) NOT NULL,
  `tglupload` date NOT NULL,
  `nfile` varchar(100) NOT NULL,
  `tipefile` varchar(10) NOT NULL,
  `ukfile` varchar(20) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporanabsen`
--

--INSERT INTO `laporanabsen` (`id`, `tglupload`, `nfile`, `tipefile`, `ukfile`, `file`) VALUES
--(1, '2020-05-11', 'absen_Oktober_2020', 'xls', '2305', 'filesabsen/absen_Oktober_2020.xls');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `bagian` varchar(100) NOT NULL,
  `pinjaman` float NOT NULL,
  `kperluan` varchar(100) NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `tglpenye` date NOT NULL,
  `tglpenge` date NOT NULL,
  `carapenge` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `nik`, `nama`, `jabatan`, `bagian`, `pinjaman`, `kperluan`, `waktu`, `tglpenye`, `tglpenge`, `carapenge`) VALUES
(1, '1001001', 'Ina Permata', 'Cereal Production', 'Diskmill', 1000000, 'Bayar Berobat', '120', '2020-05-01', '2020-07-01', 'Transfer'),
(2, '0110110', 'Tedjo Selamet', 'Production Packing', 'Line-3', 2000000, 'Bayar Motor', '1 Bulan', '2020-01-01', '2020-02-01', 'Tunai'),
(5, '1001001', 'Ina Permata', 'Cereal Production', 'Diskmill', 2000000, 'Bayar Motor', '1 Bulan', '2020-05-01', '2020-06-01', 'Potong Gaji'),
(8, '1001001', 'Ina Permata', 'Cereal Production', 'Diskmill', 2000, 'beli permen', '2hari', '2020-05-02', '2020-05-03', 'Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `tbbagian`
--

CREATE TABLE `tbbagian` (
  `bagian_id` int(11) NOT NULL,
  `bagian` varchar(100) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbbagian`
--

INSERT INTO `tbbagian` (`bagian_id`, `bagian`, `jabatan_id`, `status`) VALUES
(1, 'Diskmill', 1, 1),
(2, 'Mixing', 1, 1),
(3, 'Tata Udara', 2, 1),
(4, 'Grinding', 3, 1),
(5, 'Mixing Line-1', 3, 1),
(6, 'Mixing Line-2', 3, 1),
(7, 'Mixing Line-3', 3, 1),
(8, 'Mixing Line-4', 3, 1),
(9, 'Mixing Line-5', 3, 1),
(10, 'Mixing Line-6', 3, 1),
(11, 'Mixing Line-7', 3, 1),
(12, 'GDTP', 4, 1),
(13, 'Manual In Carton', 4, 1),
(14, 'Manual Suzuki', 4, 1),
(15, 'Printing', 4, 1),
(16, 'Line-1', 4, 1),
(17, 'Line-2', 4, 1),
(18, 'Line-3', 4, 1),
(19, 'Line-4', 4, 1),
(20, 'Line-5', 4, 1),
(21, 'Line-6', 4, 1),
(22, 'Line-7', 4, 1),
(23, 'Line', 5, 1),
(24, 'Line-1', 5, 1),
(25, 'Line-2', 5, 1),
(26, 'Line-3', 5, 1),
(27, 'Line-4', 5, 1),
(28, 'Line-5', 5, 1),
(29, 'Line-6', 5, 1),
(30, 'Line-7', 5, 1),
(31, 'MDC', 6, 1),
(32, 'PM', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbgaji`
--

CREATE TABLE `tbgaji` (
  `id` int(11) NOT NULL,
  `periode` varchar(200) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `bagian` varchar(100) NOT NULL,
  `jmlmasuk` float NOT NULL,
  `gajipokok` float NOT NULL,
  `jmllembur` float NOT NULL,
  `uanglembur` float NOT NULL,
  `bpjstk` float NOT NULL,
  `bpjspen` float NOT NULL,
  `bpjskes` float NOT NULL,
  `pph` float NOT NULL,
  `pinjaman` float NOT NULL,
  `tglup` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbgaji`
--

INSERT INTO `tbgaji` (`id`, `periode`, `nik`, `nama`, `jabatan`, `bagian`, `jmlmasuk`, `gajipokok`, `jmllembur`, `uanglembur`, `bpjstk`, `bpjspen`, `bpjskes`, `pph`, `pinjaman`, `tglup`) VALUES
(6, '16-April-2020 s/d 15-Mei-2020', '1001001', 'Ina Permata', 'Cereal Production', 'Diskmill', 30, 4500000, 20, 510000, 88180, 44090, 44090, 20000, 2000000, '2020-04-30'),
(7, '16-April-2020 s/d 15-Mei-2020', '0110110', 'Tedjo Selamet', 'Production Packing', 'Line-3', 20, 3000000, 5, 127500, 88180, 44090, 44090, 0, 0, '2020-04-30'),
(8, '16-April-2020 s/d 15-Mei-2020', '0110110', 'Tedjo Selamet', 'Cereal Production', 'Diskmill', 30, 4500000, 20, 510000, 0, 0, 0, 20000, 0, '2020-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `tbjabatan`
--

CREATE TABLE `tbjabatan` (
  `jabatan_id` int(11) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0:Blocked 1:active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbjabatan`
--

INSERT INTO `tbjabatan` (`jabatan_id`, `jabatan`, `status`) VALUES
(1, 'Cereal Production', 1),
(2, 'Engineering Utility', 1),
(3, 'Production Central Kitchen', 1),
(4, 'Production Packing', 1),
(5, 'Technic Packing', 1),
(6, 'Warehouse', 1),
(9, 'Production', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `pswrd` varchar(50) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nik`, `pswrd`, `nama`, `level`) VALUES
(7, '1001001', '57b9cdfbafb42a79ef2c2afa8875bb9f', 'Ina Permata', 'admin'),
(12, '0110110', '03f0e9cf8c21203d616a25c29cc42798', 'Tedjo Selamet', 'karyawan'),
(14, '0010011', 'd3e784448078b746bab305a33cfda405', 'Aku Owner', 'owner'),
(15, '202041', '72d918c5a12def78251b2cab001f0b4d', 'Added', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dtkaryawan`
--
ALTER TABLE `dtkaryawan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dunik` (`nik`),
  ADD UNIQUE KEY `dunktp` (`noktp`),
  ADD UNIQUE KEY `dunpwp` (`npwp`),
  ADD UNIQUE KEY `dubpjstk` (`bpjstk`),
  ADD UNIQUE KEY `dubpjspen` (`bpjspensi`),
  ADD UNIQUE KEY `dubpjskes` (`bpjskes`),
  ADD UNIQUE KEY `dunorek` (`norek`),
  ADD KEY `inama` (`nama`),
  ADD KEY `fgbgian` (`bagian`),
  ADD KEY `fgjbtan` (`jabatan`);

--
-- Indexes for table `fileabsen`
--
ALTER TABLE `fileabsen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filegaji`
--
ALTER TABLE `filegaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filekaryawan`
--
ALTER TABLE `filekaryawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ubgian` (`bagian`),
  ADD KEY `injbtan` (`jbtan`);

--
-- Indexes for table `laporanabsen`
--
ALTER TABLE `laporanabsen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fgnik_pin` (`nik`),
  ADD KEY `fgnama_pin` (`nama`),
  ADD KEY `fgjab_pin` (`jabatan`),
  ADD KEY `fgbag_pin` (`bagian`);

--
-- Indexes for table `tbbagian`
--
ALTER TABLE `tbbagian`
  ADD PRIMARY KEY (`bagian_id`),
  ADD KEY `fkid` (`jabatan_id`),
  ADD KEY `bagian` (`bagian`);

--
-- Indexes for table `tbgaji`
--
ALTER TABLE `tbgaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fknik` (`nik`),
  ADD KEY `fknama` (`nama`),
  ADD KEY `fkjbtan` (`jabatan`),
  ADD KEY `fkbgian` (`bagian`);

--
-- Indexes for table `tbjabatan`
--
ALTER TABLE `tbjabatan`
  ADD PRIMARY KEY (`jabatan_id`),
  ADD UNIQUE KEY `uJab` (`jabatan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dtkaryawan`
--
ALTER TABLE `dtkaryawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fileabsen`
--
ALTER TABLE `fileabsen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `filegaji`
--
ALTER TABLE `filegaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `filekaryawan`
--
ALTER TABLE `filekaryawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `laporanabsen`
--
ALTER TABLE `laporanabsen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbbagian`
--
ALTER TABLE `tbbagian`
  MODIFY `bagian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbgaji`
--
ALTER TABLE `tbgaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbjabatan`
--
ALTER TABLE `tbjabatan`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dtkaryawan`
--
ALTER TABLE `dtkaryawan`
  ADD CONSTRAINT `fgbgian` FOREIGN KEY (`bagian`) REFERENCES `tbbagian` (`bagian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fgjbtan` FOREIGN KEY (`jabatan`) REFERENCES `tbjabatan` (`jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `fgbag_pin` FOREIGN KEY (`bagian`) REFERENCES `dtkaryawan` (`bagian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fgjab_pin` FOREIGN KEY (`jabatan`) REFERENCES `dtkaryawan` (`jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fgnama_pin` FOREIGN KEY (`nama`) REFERENCES `dtkaryawan` (`nama`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fgnik_pin` FOREIGN KEY (`nik`) REFERENCES `dtkaryawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbbagian`
--
ALTER TABLE `tbbagian`
  ADD CONSTRAINT `fkid` FOREIGN KEY (`jabatan_id`) REFERENCES `tbjabatan` (`jabatan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbgaji`
--
ALTER TABLE `tbgaji`
  ADD CONSTRAINT `fkbgian` FOREIGN KEY (`bagian`) REFERENCES `dtkaryawan` (`bagian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkjbtan` FOREIGN KEY (`jabatan`) REFERENCES `dtkaryawan` (`jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fknama` FOREIGN KEY (`nama`) REFERENCES `dtkaryawan` (`nama`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fknik` FOREIGN KEY (`nik`) REFERENCES `dtkaryawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

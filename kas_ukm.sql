-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2026 at 09:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kas_ukm`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

DROP TABLE IF EXISTS `anggota`;
CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kas_keluar`
--

DROP TABLE IF EXISTS `kas_keluar`;
CREATE TABLE IF NOT EXISTS `kas_keluar` (
  `id_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_keluar`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kas_keluar`
--

INSERT INTO `kas_keluar` (`id_keluar`, `tanggal`, `jumlah`, `keterangan`, `id_user`, `jenis`) VALUES(3, '2026-01-27', 200000, 'beli ', NULL, 'Transport');
INSERT INTO `kas_keluar` (`id_keluar`, `tanggal`, `jumlah`, `keterangan`, `id_user`, `jenis`) VALUES(4, '2026-01-27', 50000, 'ecp', NULL, 'Kegiatan');

-- --------------------------------------------------------

--
-- Table structure for table `kas_masuk`
--

DROP TABLE IF EXISTS `kas_masuk`;
CREATE TABLE IF NOT EXISTS `kas_masuk` (
  `id_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `sumber` enum('Iuran Anggota','Donasi','Lainnya') NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_masuk`),
  KEY `kas_masuk_ibfk_1` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kas_masuk`
--

INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(3, '2026-01-18', 100000, 'Iuran Anggota', 'uang kas', 1, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(4, '2026-01-23', 123232323, 'Iuran Anggota', 'khs', 1, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(13, '2026-01-27', 50000, 'Iuran Anggota', 'uang kas', NULL, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(14, '2026-01-27', 50000, 'Iuran Anggota', 'uang kas', NULL, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(15, '2026-01-27', 50000, 'Iuran Anggota', 'uang kas', NULL, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(16, '2026-01-27', 50000, 'Iuran Anggota', 'uang kas', NULL, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(17, '2026-01-28', 10000, 'Iuran Anggota', 'Iuran kas via transfer', 3, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(18, '2026-01-28', 10000, 'Iuran Anggota', 'Iuran kas via transfer', 3, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(19, '2026-01-28', 10000, 'Iuran Anggota', 'Iuran kas via transfer', 3, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(20, '2026-01-28', 10000, 'Iuran Anggota', 'Iuran kas via transfer', 3, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(21, '2026-01-28', 10000, 'Iuran Anggota', 'Iuran kas via transfer', 3, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(22, '2026-01-28', 10000, 'Iuran Anggota', 'Iuran kas via transfer', 3, NULL);
INSERT INTO `kas_masuk` (`id_masuk`, `tanggal`, `jumlah`, `sumber`, `keterangan`, `id_user`, `jenis`) VALUES(23, '2026-01-28', 10000, 'Iuran Anggota', 'Iuran kas via transfer', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_kas`
--

DROP TABLE IF EXISTS `pembayaran_kas`;
CREATE TABLE IF NOT EXISTS `pembayaran_kas` (
  `id_bayar` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `metode` enum('transfer','qris') DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `status` enum('pending','diterima','ditolak') DEFAULT 'pending',
  PRIMARY KEY (`id_bayar`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran_kas`
--

INSERT INTO `pembayaran_kas` (`id_bayar`, `id_user`, `tanggal`, `jumlah`, `metode`, `bukti`, `status`) VALUES(1, 3, '2026-01-28', 10, '', '1769574338_Screenshot 2026-01-28 110850.png', '');
INSERT INTO `pembayaran_kas` (`id_bayar`, `id_user`, `tanggal`, `jumlah`, `metode`, `bukti`, `status`) VALUES(2, 3, '2026-01-28', 10000, 'transfer', '1769576527_669.png', '');
INSERT INTO `pembayaran_kas` (`id_bayar`, `id_user`, `tanggal`, `jumlah`, `metode`, `bukti`, `status`) VALUES(3, 3, '2026-01-28', 10000, 'transfer', '1769577103_801.png', '');
INSERT INTO `pembayaran_kas` (`id_bayar`, `id_user`, `tanggal`, `jumlah`, `metode`, `bukti`, `status`) VALUES(4, 3, '2026-01-28', 10000, 'transfer', '1769577333_950.png', '');
INSERT INTO `pembayaran_kas` (`id_bayar`, `id_user`, `tanggal`, `jumlah`, `metode`, `bukti`, `status`) VALUES(5, 3, '2026-01-28', 10000, 'transfer', '1769578565_976.png', '');
INSERT INTO `pembayaran_kas` (`id_bayar`, `id_user`, `tanggal`, `jumlah`, `metode`, `bukti`, `status`) VALUES(6, 3, '2026-01-28', 10000, 'transfer', '1769578934_569.png', '');
INSERT INTO `pembayaran_kas` (`id_bayar`, `id_user`, `tanggal`, `jumlah`, `metode`, `bukti`, `status`) VALUES(7, 3, '2026-01-28', 10000, 'transfer', '1769585765_604.png', 'diterima');
INSERT INTO `pembayaran_kas` (`id_bayar`, `id_user`, `tanggal`, `jumlah`, `metode`, `bukti`, `status`) VALUES(8, 3, '2026-01-28', 10000, 'transfer', '1769591669_694.png', 'diterima');
INSERT INTO `pembayaran_kas` (`id_bayar`, `id_user`, `tanggal`, `jumlah`, `metode`, `bukti`, `status`) VALUES(9, 3, '2026-01-28', 10000, 'transfer', '1769592267_332.png', 'diterima');
INSERT INTO `pembayaran_kas` (`id_bayar`, `id_user`, `tanggal`, `jumlah`, `metode`, `bukti`, `status`) VALUES(10, 3, '2026-01-29', 10000, 'transfer', '1769655382_503.png', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('bendahara','anggota') DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES(1, 'Anisa', 'bendahara', '24552011287', 'bendahara');
INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES(3, 'Sultan', 'sultan', '24552011376', 'anggota');
INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES(4, NULL, 'dhenia', '$2y$10$ok1fUPVjkCKulZ.Ym17Bv.IRg5vhfRDG.LseBPcfDQ8Sw/gmG.To.', 'anggota');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kas_keluar`
--
ALTER TABLE `kas_keluar`
  ADD CONSTRAINT `kas_keluar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `kas_masuk`
--
ALTER TABLE `kas_masuk`
  ADD CONSTRAINT `kas_masuk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;

--
-- Constraints for table `pembayaran_kas`
--
ALTER TABLE `pembayaran_kas`
  ADD CONSTRAINT `pembayaran_kas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

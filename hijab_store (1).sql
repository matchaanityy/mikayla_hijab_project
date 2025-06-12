-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 02:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hijab_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `id_detail_order` int(20) NOT NULL,
  `id_order` int(20) NOT NULL,
  `id_produk` int(20) NOT NULL,
  `qty` varchar(1000) NOT NULL,
  `subtotal` varchar(10000) NOT NULL,
  `tgl_order` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_order`
--

INSERT INTO `detail_order` (`id_detail_order`, `id_order`, `id_produk`, `qty`, `subtotal`, `tgl_order`) VALUES
(1, 8, 1, '1', '30000', ''),
(2, 8, 2, '1', '35000', ''),
(3, 9, 3, '1', '25000', ''),
(4, 10, 4, '2', '90000', ''),
(5, 11, 2, '7', '245000', ''),
(6, 12, 4, '3', '135000', ''),
(7, 13, 1, '18', '540000', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `id_admin` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL,
  `telp_admin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbadmin`
--

INSERT INTO `tbadmin` (`id_admin`, `username`, `password`, `telp_admin`) VALUES
(1, 'aline', 'alin1234', '0814771271990'),
(2, 'Caca', 'caca123', '082774927495'),
(3, 'Ali', 'ali123', '08938648590');

-- --------------------------------------------------------

--
-- Table structure for table `tbkategori`
--

CREATE TABLE `tbkategori` (
  `id_kategori` int(20) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tborder`
--

CREATE TABLE `tborder` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_admin` int(20) NOT NULL,
  `id_pengiriman` int(20) NOT NULL,
  `tgl_order` date NOT NULL,
  `jumlah_barang` int(100) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tborder`
--

INSERT INTO `tborder` (`id_order`, `id_user`, `id_admin`, `id_pengiriman`, `tgl_order`, `jumlah_barang`, `total_harga`) VALUES
(1, 1, 0, 0, '2025-06-11', 0, 30000.00),
(8, 1, 0, 0, '2025-06-11', 0, 65000.00),
(9, 1, 0, 0, '2025-06-11', 0, 25000.00),
(10, 1, 0, 0, '2025-06-11', 0, 90000.00),
(11, 1, 0, 0, '2025-06-11', 0, 245000.00),
(12, 1, 0, 0, '2025-06-12', 0, 135000.00),
(13, 1, 0, 0, '2025-06-12', 0, 540000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbpengiriman`
--

CREATE TABLE `tbpengiriman` (
  `no_resi` int(50) NOT NULL,
  `id_order` int(11) NOT NULL,
  `ekspedisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbproduk`
--

CREATE TABLE `tbproduk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(20) NOT NULL,
  `stok` varchar(1000) NOT NULL,
  `gambar` varchar(2000) NOT NULL,
  `harga` int(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbproduk`
--

INSERT INTO `tbproduk` (`id_produk`, `nama_produk`, `stok`, `gambar`, `harga`, `deskripsi`, `tgl_masuk`) VALUES
(1, 'Pashmina Silk', '', 'pashmina_silk.jpg', 30000, '-', '0000-00-00'),
(2, 'Pashmina Shawl', '', 'pashmina_shawldb.jpg', 35000, 'daily activity', '0000-00-00'),
(3, 'Pashmina cerutty', '', 'pashmina_ceruty.jpg', 25000, 'bahannya adem', '0000-00-00'),
(4, 'Pashmina Chiffon', '', 'pashmina_chiffon.jpg', 45000, 'very soft', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbrating`
--

CREATE TABLE `tbrating` (
  `id_rating` int(10) NOT NULL,
  `rating` varchar(5) NOT NULL,
  `komentar` varchar(1000) NOT NULL,
  `tgl_rating` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `id_user` int(20) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `password_user` varchar(10) NOT NULL,
  `telp_user` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`id_user`, `nama_user`, `password_user`, `telp_user`, `alamat`) VALUES
(1, 'Alin', 'iya123', '0812346897', 'Wonogiri'),
(3, 'Ali', '', '08926524257', 'Yaman'),
(4, 'Ayu', 'ayu123', '081384958385', 'Semarang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id_detail_order`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbkategori`
--
ALTER TABLE `tbkategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tborder`
--
ALTER TABLE `tborder`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbpengiriman`
--
ALTER TABLE `tbpengiriman`
  ADD PRIMARY KEY (`no_resi`);

--
-- Indexes for table `tbproduk`
--
ALTER TABLE `tbproduk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbrating`
--
ALTER TABLE `tbrating`
  ADD PRIMARY KEY (`id_rating`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id_detail_order` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `id_admin` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbkategori`
--
ALTER TABLE `tbkategori`
  MODIFY `id_kategori` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tborder`
--
ALTER TABLE `tborder`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbpengiriman`
--
ALTER TABLE `tbpengiriman`
  MODIFY `no_resi` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbproduk`
--
ALTER TABLE `tbproduk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbrating`
--
ALTER TABLE `tbrating`
  MODIFY `id_rating` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `id_order` FOREIGN KEY (`id_order`) REFERENCES `tborder` (`id_order`),
  ADD CONSTRAINT `id_produk` FOREIGN KEY (`id_produk`) REFERENCES `tbproduk` (`id_produk`);

--
-- Constraints for table `tborder`
--
ALTER TABLE `tborder`
  ADD CONSTRAINT `tborder_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbuser` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

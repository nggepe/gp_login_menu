-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2019 at 02:39 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `your_project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu_nama` varchar(20) DEFAULT NULL,
  `url` text,
  `id_modul` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_nama`, `url`, `id_modul`) VALUES
(1, 'Satuan', 'master/satuan', 2),
(2, 'Produk', 'master/produk', 2),
(3, 'Supplier', 'master/supplier', 2),
(4, 'User', 'master/user', 2),
(5, 'Pegawai', 'master/pegawai', 2),
(6, 'Jabatan', 'master/jabatan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `tipe` enum('','dropdown') DEFAULT NULL,
  `url` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `nama`, `icon`, `tipe`, `url`) VALUES
(1, 'Dashboard', 'fas fa-tv', '', 'dashboard/Home'),
(2, 'Master', 'fas fa-fire', 'dropdown', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `no_telpon` varchar(20) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `alamat`, `no_telpon`, `username`, `password`) VALUES
(1, 'Administrator', 'Disini', '+2988194', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_menu_modul` (`id_modul`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_menu_modul` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

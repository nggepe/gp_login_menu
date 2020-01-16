-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2020 at 06:01 PM
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
-- Table structure for table `master_jabatan`
--

CREATE TABLE `master_jabatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_jabatan`
--

INSERT INTO `master_jabatan` (`id`, `nama`) VALUES
(1, 'Direktur'),
(2, 'Wakil Direktur'),
(3, 'Sekretaris'),
(5, 'Sopir'),
(6, 'Bendahara');

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
(6, 'Jabatan', 'master/jabatan', 2),
(8, 'Hak Akses', 'setting/User_privilege', 4);

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
(2, 'Master', 'fas fa-fire', 'dropdown', NULL),
(4, 'Setting', 'fas fa-cog', 'dropdown', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` text,
  `status_kepegawaian` tinyint(1) DEFAULT '1',
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `no_telpon` varchar(20) DEFAULT NULL,
  `id_master_jabatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status_kepegawaian`, `nama`, `alamat`, `no_telpon`, `id_master_jabatan`) VALUES
(1, 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', 1, 'Daroja', 'Jln. Sehat', '081913900049', 1),
(2, 'sopir', 'd386c1221d25de3e8eb78dd5e73a8aac', 1, 'Daroji', 'Jln. Kencang', '089192829', 5),
(3, 'wakadik', '9ad29d3f8809e581416fdd72d6d6ffa3', 1, 'Daroju', 'Jln. Sehat', '0333888888', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_privilege`
--

CREATE TABLE `user_group_privilege` (
  `id` int(11) NOT NULL,
  `id_master_jabatan` int(11) NOT NULL DEFAULT '0',
  `id_menu` int(11) DEFAULT NULL,
  `id_modul` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group_privilege`
--

INSERT INTO `user_group_privilege` (`id`, `id_master_jabatan`, `id_menu`, `id_modul`) VALUES
(120, 1, 8, 4),
(121, 1, NULL, 1),
(122, 1, 1, 2),
(123, 1, 2, 2),
(124, 1, 3, 2),
(125, 1, 4, 2),
(126, 1, 5, 2),
(127, 1, 6, 2),
(131, 5, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_master_jabatan` (`id_master_jabatan`);

--
-- Indexes for table `user_group_privilege`
--
ALTER TABLE `user_group_privilege`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_group_privilege_master_jabatan` (`id_master_jabatan`),
  ADD KEY `FK_user_group_privilege_menu` (`id_menu`),
  ADD KEY `FK_user_group_privilege_modul` (`id_modul`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_group_privilege`
--
ALTER TABLE `user_group_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_menu_modul` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_user_master_jabatan` FOREIGN KEY (`id_master_jabatan`) REFERENCES `master_jabatan` (`id`);

--
-- Constraints for table `user_group_privilege`
--
ALTER TABLE `user_group_privilege`
  ADD CONSTRAINT `FK_user_group_privilege_master_jabatan` FOREIGN KEY (`id_master_jabatan`) REFERENCES `master_jabatan` (`id`),
  ADD CONSTRAINT `FK_user_group_privilege_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_group_privilege_modul` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

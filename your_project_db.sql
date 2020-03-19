-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2020 at 12:47 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Simple CRUD', 'generator/generator_', 5),
(2, 'Simple Artikel', 'generator/Generator_artikel', 5),
(3, 'Single Update', 'generator/single_update', 5),
(4, 'User', 'master/user', 2),
(5, 'Manajemen Menu', 'generator/manajemen_menu', 5),
(6, 'Privilege', 'master/user_privilege', 2),
(7, 'Ubah Password', 'setting/Ubah_password', 4),
(8, 'Hak Akses', 'setting/User_privilege', 4),
(13, 'supplier', 'generated/supplier', 2),
(14, 'Customer', 'generated/customer', 2),
(15, 'profil', 'generated/profil', 2);

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
(4, 'Setting', 'fas fa-cog', 'dropdown', NULL),
(5, 'Generator Ajax', 'fas fa-wrench', 'dropdown', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id_user_privilege` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status_kepegawaian`, `nama`, `alamat`, `no_telpon`, `id_user_privilege`) VALUES
(1, 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', 1, 'Daroja', 'Jln. Sehat', '081913900049', 1),
(2, 'sopir', 'd386c1221d25de3e8eb78dd5e73a8aac', 1, 'Daroji', 'Jln. Kencang', '089192829', 5),
(3, 'wakadik', '9ad29d3f8809e581416fdd72d6d6ffa3', 1, 'Daroju', 'Jln. Sehat', '0333888888', 2),
(4, 'asd', '7815696ecbf1c96e6894b779456d330e', 1, 'Tumijan', 'Pandaan', '082991', 2),
(5, 'developer', '5e8edd851d2fdfbd7415232c67367cc3', 1, 'Paijan', 'Jln. Sehat', '088289192', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_privilege`
--

CREATE TABLE `user_group_privilege` (
  `id` int(11) NOT NULL,
  `id_user_privilege` int(11) NOT NULL DEFAULT '0',
  `id_menu` int(11) DEFAULT NULL,
  `id_modul` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group_privilege`
--

INSERT INTO `user_group_privilege` (`id`, `id_user_privilege`, `id_menu`, `id_modul`) VALUES
(131, 5, NULL, 1),
(213, 1, 8, 4),
(214, 1, NULL, 1),
(215, 1, 4, 2),
(216, 1, 6, 2),
(217, 1, 7, 4),
(218, 1, 13, 2),
(219, 1, 14, 2),
(220, 1, 15, 2),
(221, 1, 1, 5),
(222, 1, 2, 5),
(223, 1, 3, 5),
(224, 1, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_privilege`
--

CREATE TABLE `user_privilege` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_privilege`
--

INSERT INTO `user_privilege` (`id`, `nama`) VALUES
(1, 'Direktur'),
(2, 'Wakil Direktur'),
(3, 'Sekretaris'),
(5, 'Sopir'),
(6, 'Bendahara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
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
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_master_jabatan` (`id_user_privilege`);

--
-- Indexes for table `user_group_privilege`
--
ALTER TABLE `user_group_privilege`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_group_privilege_master_jabatan` (`id_user_privilege`),
  ADD KEY `FK_user_group_privilege_menu` (`id_menu`),
  ADD KEY `FK_user_group_privilege_modul` (`id_modul`);

--
-- Indexes for table `user_privilege`
--
ALTER TABLE `user_privilege`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_group_privilege`
--
ALTER TABLE `user_group_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `user_privilege`
--
ALTER TABLE `user_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `FK_user_master_jabatan` FOREIGN KEY (`id_user_privilege`) REFERENCES `user_privilege` (`id`);

--
-- Constraints for table `user_group_privilege`
--
ALTER TABLE `user_group_privilege`
  ADD CONSTRAINT `FK_user_group_privilege_master_jabatan` FOREIGN KEY (`id_user_privilege`) REFERENCES `user_privilege` (`id`),
  ADD CONSTRAINT `FK_user_group_privilege_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_group_privilege_modul` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

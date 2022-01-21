-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 04:35 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_web`
--

CREATE TABLE `admin_web` (
  `nik` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `enable_login` varchar(50) NOT NULL,
  `create` varchar(255) NOT NULL,
  `update` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_web`
--

INSERT INTO `admin_web` (`nik`, `username`, `password`, `fullname`, `position`, `enable_login`, `create`, `update`) VALUES
('1111', 'master', '$2y$10$nXT6l7uV8JZKL4ld/SUkt..o1wXFXAopneA06GfF2i0ruYI1Wc7g2', 'master', 'admin', '1', '', ''),
('2222', 'admin', '$2y$10$HSHAVqy8kfBDQ4ZmlbZkdeiigGMvvL3/mMaKvLc0aZnoFKTrFoijy', 'admin', 'adminUndia', '1', '03-Nov-2021 02:17:49 PM', '');

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `stts_voting` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `stts_voting`) VALUES
(1, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `file_paslon`
--

CREATE TABLE `file_paslon` (
  `id` int(11) NOT NULL,
  `id_paslon` int(11) NOT NULL DEFAULT 0,
  `file_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_paslon`
--

INSERT INTO `file_paslon` (`id`, `id_paslon`, `file_name`) VALUES
(100, 4574, '1642128900_7399457603ad20abda05.jpg'),
(101, 4574, '1642128900_7ec945e8203152cfe08b.jpg'),
(102, 4574, '1642128900_40fbf1ade41120f12bd6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mas_aksesmenu`
--

CREATE TABLE `mas_aksesmenu` (
  `id` int(11) NOT NULL,
  `posisi` varchar(50) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mas_aksesmenu`
--

INSERT INTO `mas_aksesmenu` (`id`, `posisi`, `menu_id`) VALUES
(1, 'admin', 1),
(2, 'admin', 2),
(4, 'admin', 4);

-- --------------------------------------------------------

--
-- Table structure for table `mas_menu`
--

CREATE TABLE `mas_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `app` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `stts` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mas_menu`
--

INSERT INTO `mas_menu` (`id`, `menu`, `app`, `icon`, `stts`) VALUES
(1, 'Admin', 'security', ' fa-cogs', 'true'),
(2, 'Paslon', 'security', 'fa-address-card', 'true'),
(3, 'Voting', 'security', 'fa-poll', 'true'),
(4, 'User', 'security', 'fa-user', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `mas_submenu`
--

CREATE TABLE `mas_submenu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `sub_menu` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `stts` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mas_submenu`
--

INSERT INTO `mas_submenu` (`id`, `menu_id`, `sub_menu`, `url`, `stts`) VALUES
(1, 1, 'Menu', 'admin/menu', 'false'),
(2, 1, 'User Managemen', 'admin/user', 'true'),
(3, 2, 'Paslon', 'admin/user_paslon', 'true'),
(4, 1, 'User App', 'admin/user_app', 'true'),
(5, 3, 'Hasil', 'admin/hasil', 'true'),
(6, 2, 'Ques ON', 'admin/ques_on', 'true'),
(7, 4, 'Password', 'home/edit_password', 'true'),
(8, 2, 'File Paslon', 'admin/file_paslon', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `paslon`
--

CREATE TABLE `paslon` (
  `id` int(11) NOT NULL,
  `nim_presiden` int(11) DEFAULT NULL,
  `nama_presiden` varchar(255) DEFAULT NULL,
  `nim_wakil` int(11) DEFAULT NULL,
  `nama_wakil` varchar(255) DEFAULT NULL,
  `visi` longtext DEFAULT NULL,
  `misi` longtext DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `stts` varchar(50) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `create` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paslon`
--

INSERT INTO `paslon` (`id`, `nim_presiden`, `nama_presiden`, `nim_wakil`, `nama_wakil`, `visi`, `misi`, `image`, `stts`, `urutan`, `create`) VALUES
(4575, 13649, 'tes3', 84684, 'tes1', '<p>af</p>', '<p>asdf</p>', NULL, 'Panding', 0, ' 2022-Jan-20 04:25:54 PM');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `dec` text DEFAULT NULL,
  `file` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `title`, `dec`, `file`) VALUES
(2, 'dasdf', 'fasdf', '1642672960_f71663c849d6a09672e9.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `ques`
--

CREATE TABLE `ques` (
  `id` int(11) NOT NULL,
  `id_paslon` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `soal` text DEFAULT NULL,
  `stts` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ques_stts`
--

CREATE TABLE `ques_stts` (
  `id` int(11) NOT NULL,
  `id_paslon` int(11) DEFAULT NULL,
  `stts` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ques_stts`
--

INSERT INTO `ques_stts` (`id`, `id_paslon`, `stts`) VALUES
(12, 4574, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `nim`, `token`) VALUES
(2, '1222211111', 'f6-ksiLRQNSIraAJ-kUHGO:APA91bGcvBWBUPXy3c95wb6eWnBd9QrlYgCiSOS5_KLKHD6DFkvn0xWtCDT7fa2HIhJ_-tQH2Pa8El8F7pzzzsXWdFVsxGVRcRXYln2jLULecAp_1Mcki6EPl7Z6rQrpaKFdCjOdXGny');

-- --------------------------------------------------------

--
-- Table structure for table `user_app`
--

CREATE TABLE `user_app` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nim` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_phone` varchar(255) DEFAULT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `enable_login` int(11) DEFAULT NULL,
  `stts` varchar(100) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `update_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_app`
--

INSERT INTO `user_app` (`id`, `name`, `nim`, `email`, `no_phone`, `prodi`, `password`, `image`, `enable_login`, `stts`, `created_by`, `update_by`) VALUES
(105, 'tes1', 84684, 'tes1@gmail.com', '09754691', '', '$2y$10$WPg05BixbAyMPardIx.Ey.tED02J5T62QtLupDE.7WkP2nuZ.Mu0u', 'user.png', 1, 'mahasiswa', 'tes1 2021-Dec-22 11:28:46 AM', NULL),
(106, 'tes2', 1233, 'tes2@gmail.com', '08862', '', '$2y$10$nfvq.bUBdKveMSoN/4fK9OBkQhD8EFBiKJJR85vxMR8xX2VG1Hl2C', 'user.png', 1, 'mahasiswa', 'tes2 2021-Dec-22 11:33:03 AM', NULL),
(107, 'tes3', 13649, 'tes3@gmail.com', '9484', '', '$2y$10$LzLNXvQLbiH1XHPifkJTwOUZSSD08OqBNJrCsBuQHigrxt82nVg5q', 'user.png', 1, 'mahasiswa', 'tes3 2022-Jan-05 10:49:04 AM', NULL),
(108, 'tes4', 94649, 'tes4@gmail.com', '84649', '', '$2y$10$JUoDVUUPMmn0u50MEFVcYufie8elyNWyrjdsdn.m9GjKBl00Y/SSu', 'user.png', 1, 'mahasiswa', 'tes4 2022-Jan-05 10:49:30 AM', NULL),
(109, 'yuni sarah', 1222211111, 'yunisarah@gmail.com', '0822846211123123', 'tif', '$2y$10$.4bdLYVr3KJ4hmWOMgxRpe/LgcGbuy5ML0b3sgm/XJ3.Ht.GANlkW', 'user.png', 1, 'mahasiswa', 'yuni sarah 2022-Jan-14 09:26:24 AM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nomor_calon` int(11) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_web`
--
ALTER TABLE `admin_web`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_paslon`
--
ALTER TABLE `file_paslon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mas_aksesmenu`
--
ALTER TABLE `mas_aksesmenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `mas_menu`
--
ALTER TABLE `mas_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `mas_submenu`
--
ALTER TABLE `mas_submenu`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `menu_id` (`menu_id`) USING BTREE;

--
-- Indexes for table `paslon`
--
ALTER TABLE `paslon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_presiden` (`nim_presiden`) USING BTREE,
  ADD KEY `id_wakil` (`nim_wakil`) USING BTREE;

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ques`
--
ALTER TABLE `ques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ques_stts`
--
ALTER TABLE `ques_stts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD UNIQUE KEY `token` (`token`) USING HASH;

--
-- Indexes for table `user_app`
--
ALTER TABLE `user_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `file_paslon`
--
ALTER TABLE `file_paslon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `mas_aksesmenu`
--
ALTER TABLE `mas_aksesmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mas_menu`
--
ALTER TABLE `mas_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mas_submenu`
--
ALTER TABLE `mas_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `paslon`
--
ALTER TABLE `paslon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4576;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ques`
--
ALTER TABLE `ques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ques_stts`
--
ALTER TABLE `ques_stts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_app`
--
ALTER TABLE `user_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

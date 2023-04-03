-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 03:28 PM
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
-- Database: `kamal`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `aid` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`aid`, `judul`, `isi`, `created_at`, `updated_at`) VALUES
(1, 'Coba ya gan', 'nyoba lagi nih gan', '2021-11-09 06:39:48', NULL),
(3, 'fdsafjdasfklj afdkjfalkdsfjasdklf dkfjakl', '<p>jfaskdljfakdsl dkasjfklasjf kdasjflkadsj fjfakldsjfalskdf adlkfjalkdj fkasjfklasdj f</p>', '2021-11-09 13:41:23', NULL),
(4, 'Betapa tidak berharganya waktu di Indonesia', '<p style=\"box-sizing: border-box; margin: 15px 0px 0px; padding: 0px; font-family: Nunito, sans-serif; font-size: 20px;\">Saat kuliah di Jerman, jika ingin ngobrol sesuatu dengan professor, saya harus membooking waktunya. Harus tepat hingga menit kesekian. Bukan jam 5, tapi jam 5:15 misalnya. Saat dosennya tidak hadir, kita juga akan mendapat email sebelum berangkat ke kampus.</p>\r\n<p style=\"box-sizing: border-box; margin: 15px 0px 0px; padding: 0px; font-family: Nunito, sans-serif; font-size: 20px;\">Saya stres saat mendengar, beberapa teman dan keluarga yang kuliah di Indonesia, sering saat ke kampus tidak ada kabar dari dosennya. Kalau mereka sakit atau berhalangan hadir, baru tahu saat sudah jauh-jauh datang ke sana.</p>', '2021-11-09 14:13:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `cid` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `isi` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `aid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`cid`, `uid`, `isi`, `created_at`, `aid`) VALUES
(1, 1, 'Halo gan', '2021-11-09 12:34:56', 2),
(2, 2, 'lagi yaa', '2021-11-09 12:35:14', 1),
(3, 4, 'nyoba', '2021-11-09 14:23:00', 0),
(4, 4, 'coba', '2021-11-09 14:24:11', 0),
(5, 4, 'nyoba yaa', '2021-11-09 14:27:21', 0),
(6, 4, 'nyoba lagi deh', '2021-11-09 14:27:57', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` char(1) NOT NULL DEFAULT 'U',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'nyobagan', 'nyobaaja', 'A', '2021-11-09 06:49:59'),
(2, 'royalgenetic', '$2y$10$LrjAQGqOtvbKSRkTmJCa3.Dhr82ZaksNFw5V6QxqJyShwBpJp5vU2', 'U', '2021-11-09 07:59:10'),
(3, 'royalgenetic', '$2y$10$tp0AfPIQvm0qZC9eYQH75OBjgclHIbt3KyGM4wAgheM53R1.ZMZXi', 'U', '2021-11-09 08:07:14'),
(4, 'apartment', '$2y$10$lso.QVGmoyPydWJkdn4nju.Cl0bSmziJAKIpGddBBNzXTMdkAZCmG', 'A', '2021-11-09 12:54:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `aid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `cid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

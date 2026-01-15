-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql300.infinityfree.com
-- Generation Time: Jan 14, 2026 at 07:45 PM
-- Server version: 11.4.9-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40861238_flowerdreams`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Mawar', 'Mawar adalah simbol universal dari cinta, keindahan, dan kasih sayang.', 'mawar.jpg', '2025-12-09 12:19:03', 'admin'),
(2, 'Tulip', 'Tulip adalah bunga elegan khas musim semi yang tumbuh dengan kelopak sederhana.', 'tulip.jpg', '2025-12-09 12:25:32', 'admin'),
(3, 'Anggrek', 'Anggrek dikenal sebagai bunga tropis yang eksotis dan mewah.', 'anggrek.jpg', '2025-12-09 12:28:02', 'admin'),
(4, 'Sunflower', 'Sunflower dikenal dengan kelopaknya yang cerah menghadap matahari.', 'matahari.jpg', '2025-12-09 12:28:51', 'admin'),
(5, 'Sakura', 'Sakura adalah bunga ikonik Jepang yang mekar singkat.', 'sakura.jpg', '2025-12-09 12:29:53', 'admin'),
(6, 'Daisy', 'Daisy memiliki pesona yang sederhana namun menyegarkan.', 'daisy.jpg', '2025-12-09 12:30:43', 'admin'),
(8, 'Pretty', 'Cantik seperti bunga tulip', '20251211095948.jpg', '2025-12-11 09:59:48', 'admin'),
(10, 'tia', 'bunga', '20260115073715.jpg', '2026-01-15 07:37:15', 'admin'),
(12, 'Nature', 'Indah', '20260115073821.jpg', '2026-01-15 07:38:21', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gambar`, `tanggal`, `Judul`, `Keterangan`) VALUES
(1, 'bunga1.jpg', '2026-01-15 07:42:23', 'Tiara', 'Cantik'),
(2, 'bunga2.jpg', '2026-01-15 07:41:58', 'Anggrek', 'Bunga'),
(3, '20260115071350.jpg', '2026-01-15 07:41:21', 'Pinky', 'Lucu'),
(4, '20260115071601.png', '2026-01-15 07:40:48', 'Cat', 'Meow'),
(6, '20260115072709.jpg', '2026-01-15 07:40:18', 'Tia', 'Cantik'),
(7, '20260115071740.jpg', '2026-01-15 07:41:02', 'Sweet', 'Yeay'),
(8, '20260115071755.jpg', '2026-01-15 07:40:33', 'Flower', 'Sun');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '20260115020816.jpg'),
(2, 'danny', '21232f297a57a5a743894a0e4a801fc3', '20260115020757.jpg'),
(4, 'tia', 'd41d8cd98f00b204e9800998ecf8427e', '20260115064547.jpg'),
(5, 'cinnamon', '827ccb0eea8a706c4c34a16891f84e7b', '20260115064708.jpg'),
(6, 'nadin', '827ccb0eea8a706c4c34a16891f84e7b', '20260115064821.jpg'),
(7, 'baskara', '827ccb0eea8a706c4c34a16891f84e7b', '20260115065033.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
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
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

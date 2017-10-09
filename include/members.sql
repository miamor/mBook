-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2017 at 08:55 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(255) NOT NULL,
  `username` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'abc123',
  `first_name` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://localhost/mRoom/data/img/anonymous.jpeg',
  `submissions` int(255) NOT NULL,
  `rank` int(255) NOT NULL,
  `score` float NOT NULL,
  `total_tests` int(255) NOT NULL,
  `AC` int(255) NOT NULL COMMENT 'Accepted (Correct)',
  `WA` int(255) NOT NULL COMMENT 'Wrong answer (Unmatch output)',
  `RTE` int(255) NOT NULL COMMENT 'Runtime error',
  `DQ` int(255) NOT NULL COMMENT 'Disqualified',
  `online` int(1) NOT NULL COMMENT '1:online|0:away|-1:offline',
  `modlv` int(1) NOT NULL,
  `modlv_chat` int(1) NOT NULL COMMENT '2:Mod|1:normal',
  `is_admin` int(1) NOT NULL,
  `is_mod` int(1) NOT NULL,
  `time` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `first_name`, `last_name`, `avatar`, `submissions`, `rank`, `score`, `total_tests`, `AC`, `WA`, `RTE`, `DQ`, `online`, `modlv`, `modlv_chat`, `is_admin`, `is_mod`, `time`, `created`, `modified`) VALUES
(1, 'admin', 'abc123', 'Admin', 'The', 'http://localhost/mRoom/data/img/1.jpg', 0, 2, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13'),
(2, 'tunguyen', 'abc123', 'Tú', 'Nguyễn', 'http://localhost/mRoom/data/img/2.jpg', 3, 1, 100, 23, 23, 0, 0, 0, 1, 0, 0, 1, 1, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13'),
(3, 'chiennguyen', 'abc123', 'Chiến', 'Nguyễn', 'http://localhost/mRoom/data/img/anonymous.jpeg', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13'),
(4, 'linhvu', 'abc123', 'Linh', 'Vũ', 'http://localhost/mRoom/data/img/anonymous.jpeg', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13'),
(5, 'luantran', 'abc123', 'Luận', 'Trần', 'http://localhost/mRoom/data/img/anonymous.jpeg', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13'),
(6, 'hoangdinh', 'abc123', 'Hoàng', 'Đình', 'http://localhost/mRoom/data/img/anonymous.jpeg', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13'),
(7, 'hoangluong', 'abc123', 'Hoàng', 'Lương', 'http://localhost/mRoom/data/img/anonymous.jpeg', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13'),
(8, 'hanguyen', 'abc123', 'Hà', 'Nguyễn', 'http://localhost/mRoom/data/img/anonymous.jpeg', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13'),
(9, 'ngocnguyen', 'abc123', 'Ngọc', 'Nguyễn', 'http://localhost/mRoom/data/img/anonymous.jpeg', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13'),
(10, 'thanhnguyen', 'abc123', 'Thành', 'Nguyễn', 'http://localhost/mRoom/data/img/anonymous.jpeg', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13'),
(11, 'locdo', 'abc123', 'Lộc', 'Đỗ', 'http://localhost/mRoom/data/img/anonymous.jpeg', 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2016-05-24 23:19:13', '2016-05-24 16:19:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

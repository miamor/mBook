-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 18, 2017 at 03:05 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mBook`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `uid` int(255) NOT NULL,
  `type` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `iid` int(255) NOT NULL,
  `ilink` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `bid` int(255) NOT NULL,
  `gid` int(255) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `likes` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dislikes` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `type`, `iid`, `ilink`, `bid`, `gid`, `content`, `likes`, `dislikes`, `created`, `modified`) VALUES
(1, 2, 'review', 1, '', 0, 0, '', '', '', '2017-05-19 00:52:40', '2017-05-19 00:52:40'),
(2, 3, 'review', 2, '', 0, 0, '', '', '', '2017-05-25 10:09:27', '2017-05-25 10:09:27'),
(4, 2, 'chapter', 0, 'chapter-5', 3, 0, '', '', '', '2017-05-25 10:21:20', '2017-05-25 10:21:20'),
(5, 3, 'chapter-w', 0, 'thien-dinh-bao-binh', 8, 0, '', '', '', '2017-05-31 02:14:30', '2017-05-31 02:14:30'),
(6, 2, '', 0, '', 0, 0, 'hello #readingchallenge #reading;challenge hehe', '[2]', '', '2017-05-31 07:27:25', '2017-05-31 07:27:25'),
(7, 0, 'addbookbox', 6, '', 1, 0, '', '', '', '2017-06-02 08:48:56', '2017-06-02 08:48:56'),
(8, 2, '', 0, '', 0, 0, 'hello #readingchallenge #365daysofreading hehe', '[12]', '', '2017-05-31 07:27:25', '2017-05-31 07:27:25'),
(9, 2, 'review', 3, '', 0, 0, '', '', '', '2017-06-06 09:22:48', '2017-06-06 09:22:48'),
(11, 2, '', 0, '', 0, 1, 'hehe', '[12]', '', '2017-06-09 08:46:48', '2017-06-09 08:46:48'),
(12, 12, 'review', 4, '', 0, 0, '', '', '', '2017-06-10 05:40:00', '2017-06-10 05:40:00'),
(13, 12, 'review', 5, '', 0, 0, '', '', '', '2017-06-10 17:42:51', '2017-06-10 17:42:51'),
(14, 12, 'review', 6, '', 0, 0, '', '', '', '2017-06-10 17:55:51', '2017-06-10 17:55:51'),
(18, 14, '', 0, '', 0, 0, 'sắp tới nhà mình đi du lịch còn mình đi làm k có thời gian chăm nên mình cần gửi chó khoảng 10 ngày...chó nhà mình là phú quốc khá dữ vs người lạ nhưng cho nó ăn 2-4 hôm vuốt ve chơi cùng tí là hết chảnh chó ngay...nó tên Jet biết ngồi,nằm,sủa,nhảy nhưng ban đầu chắc nó chưa nghe ngay đâu ạ.bạn nào thực sự muốn nuôi và có thể chăm sóc thì pm mình nhé.trước khi giao em nó mình sẽ gửi 1 túi thức ăn (nhưng nó chỉ thích ăn cơm thôi ????‍♂️) và khi đón em về mình sẽ mời bạn trông hộ 1 bữa buffet or có mong muốn gì bạn cứ bảo mình ạ.\r\n❗️lưu ý thời gian đầu nó sẽ gầm gừ ko cho chạm vào vuốt nên bạn kiên nhẫn dụ nó = thức ăn nhé !\r\n❗️trong quá trình nuôi nếu có khó khăn gì cứ liên hệ vs mình nhé !\r\n✴︎kích thước nó như sau????', '[12],[2]', '', '2017-06-14 02:48:53', '2017-06-14 02:48:53'),
(20, 12, 'chapter-w', 0, 'bai-viet-1', 1004, 0, '', '', '', '2017-06-14 07:43:12', '2017-06-14 07:43:12'),
(40, 0, 'addbox', 2, '', 0, 0, '', '', '', '2017-06-17 16:08:55', '2017-06-17 16:08:55'),
(44, 2, 'review', 7, '', 0, 0, '', '', '', '2017-06-20 14:39:26', '2017-06-20 14:39:26'),
(45, 2, 'chapter', 0, 'new-chapter', 3, 0, '', '', '', '2017-06-20 15:06:08', '2017-06-20 15:06:08'),
(46, 12, 'review', 8, '', 0, 0, '', '', '', '2017-06-20 15:11:04', '2017-06-20 15:11:04'),
(47, 15, '', 0, '', 0, 0, 'post as page', '', '', '2017-06-20 15:13:13', '2017-06-20 15:13:13'),
(48, 0, 'addbox', 4, '', 0, 0, '', '', '', '2017-06-20 16:17:33', '2017-06-20 16:17:33'),
(49, 0, 'addbookbox', 10, '', 1, 0, '', '', '', '2017-06-20 16:21:51', '2017-06-20 16:21:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

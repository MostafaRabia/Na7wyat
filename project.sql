-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2018 at 12:40 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(3) DEFAULT NULL,
  `dateFrom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateTo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timeFrom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timeTo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rand` int(1) DEFAULT NULL,
  `showDegree` int(1) DEFAULT NULL,
  `avil` int(10) NOT NULL,
  `isTime` int(2) DEFAULT NULL,
  `isPage` int(2) DEFAULT NULL,
  `quesToShow` int(10) DEFAULT NULL,
  `sections` int(3) DEFAULT NULL,
  `isBack` int(2) DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isUser` int(1) DEFAULT NULL,
  `sora` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fromAya` int(10) DEFAULT NULL,
  `toAya` int(10) DEFAULT NULL,
  `owner` int(2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) NOT NULL,
  `id_member` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(10) NOT NULL,
  `id_exam` int(10) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `complete` int(10) NOT NULL,
  `finish` int(10) NOT NULL,
  `ban` int(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ques`
--

CREATE TABLE `ques` (
  `id` int(10) NOT NULL,
  `id_exam` int(10) DEFAULT NULL,
  `id_que` int(10) DEFAULT NULL,
  `ques` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sora` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fromAya` int(2) NOT NULL,
  `toAya` int(2) NOT NULL,
  `degree` float DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ques`
--

INSERT INTO `ques` (`id`, `id_exam`, `id_que`, `ques`, `sora`, `fromAya`, `toAya`, `degree`, `updated_at`, `created_at`) VALUES
(1, NULL, NULL, '1', 'سورة البقرة', 260, 270, 2, '2018-04-25 09:26:46', '2018-04-25 09:26:46'),
(2, NULL, NULL, '2', 'سورة البقرة', 260, 270, 2, '2018-04-25 09:26:50', '2018-04-25 09:26:50'),
(3, NULL, NULL, '3', 'سورة البقرة', 260, 270, 3, '2018-04-27 12:22:20', '2018-04-25 09:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) NOT NULL,
  `id_exam` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `question` int(10) DEFAULT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` int(10) DEFAULT NULL,
  `degree` float DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soras`
--

CREATE TABLE `soras` (
  `id` int(11) NOT NULL,
  `sora` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soras`
--

INSERT INTO `soras` (`id`, `sora`) VALUES
(1, 'سورة الفاتحة'),
(2, 'سورة البقرة'),
(3, 'سورة آل عمران'),
(4, 'سورة النساء'),
(5, 'سورة المائدة'),
(6, 'سورة الأنعام'),
(7, 'سورة الأعراف'),
(8, 'سورة الأنفال'),
(9, 'سورة التوبة'),
(10, 'سورة يونس'),
(11, 'سورة هود'),
(12, 'سورة يوسف'),
(13, 'سورة الرعد'),
(14, 'سورة ابراهيم'),
(15, 'سورة الحجر'),
(16, 'سورة النحل'),
(17, 'سورة الإسراء'),
(18, 'سورة الكهف'),
(19, 'سورة مريم'),
(20, 'سورة طه'),
(21, 'سورة الأنبياء'),
(22, 'سورة الحج'),
(23, 'سورة المؤمنون'),
(24, 'سورة النور'),
(25, 'سورة الفرقان'),
(26, 'سورة الشعراء'),
(27, 'سورة النمل'),
(28, 'سورة القصص'),
(29, 'سورة العنكبوت'),
(30, 'سورة الروم'),
(31, 'سورة لقمان'),
(32, 'سورة السجدة'),
(33, 'سورة الأحزاب'),
(34, 'سورة سبإ'),
(35, 'سورة فاطر'),
(36, 'سورة يس'),
(37, 'سورة الصافات'),
(38, 'سورة ص'),
(39, 'سورة الزمر'),
(40, 'سورة غافر'),
(41, 'سورة فصلت'),
(42, 'سورة الشورى'),
(43, 'سورة الزخرف'),
(44, 'سورة الدخان'),
(45, 'سورة الجاثية'),
(46, 'سورة الأحقاف'),
(47, 'سورة محمد'),
(48, 'سورة الفتح'),
(49, 'سورة الحجرات'),
(50, 'سورة ق'),
(51, 'سورة الذاريات'),
(52, 'سورة الطور'),
(53, 'سورة النجم'),
(54, 'سورة القمر'),
(55, 'سورة الرحمن'),
(56, 'سورة الواقعة'),
(57, 'سورة الحديد'),
(58, 'سورة المجادلة'),
(59, 'سورة الحشر'),
(60, 'سورة الممتحنة'),
(61, 'سورة الصف'),
(62, 'سورة الجمعة'),
(63, 'سورة المنافقون'),
(64, 'سورة التغابن'),
(65, 'سورة الطلاق'),
(66, 'سورة التحريم'),
(67, 'سورة الملك'),
(68, 'سورة القلم'),
(69, 'سورة الحاقة'),
(70, 'سورة المعارج'),
(71, 'سورة نوح'),
(72, 'سورة الجن'),
(73, 'سورة المزمل'),
(74, 'سورة المدثر'),
(75, 'سورة القيامة'),
(76, 'سورة الانسان'),
(77, 'سورة المرسلات'),
(78, 'سورة النبإ'),
(79, 'سورة النازعات'),
(80, 'سورة عبس'),
(81, 'سورة التكوير'),
(82, 'سورة الإنفطار'),
(83, 'سورة المطففين'),
(84, 'سورة الإنشقاق'),
(85, 'سورة البروج'),
(86, 'سورة الطارق'),
(87, 'سورة الأعلى'),
(88, 'سورة الغاشية'),
(89, 'سورة الفجر'),
(90, 'سورة البلد'),
(91, 'سورة الشمس'),
(92, 'سورة الليل'),
(93, 'سورة الضحى'),
(94, 'سورة الشرح'),
(95, 'سورة التين'),
(96, 'سورة العلق'),
(97, 'سورة القدر'),
(98, 'سورة البينة'),
(99, 'سورة الزلزلة'),
(100, 'سورة العاديات'),
(101, 'سورة القارعة'),
(102, 'سورة التكاثر'),
(103, 'سورة العصر'),
(104, 'سورة الهمزة'),
(105, 'سورة الفيل'),
(106, 'سورة قريش'),
(107, 'سورة الماعون'),
(108, 'سورة الكوثر'),
(109, 'سورة الكافرون'),
(110, 'سورة النصر'),
(111, 'سورة المسد'),
(112, 'سورة الإخلاص'),
(113, 'سورة الفلق'),
(114, 'سورة الناس');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_user`, `username`, `gender`, `remember_token`, `admin`, `created_at`, `updated_at`) VALUES
(2, 410586719353986, 'Mostafa Rabia', 'male', 'QQ60CRwoJ1dWaWS7vFiJDaoIHXzF4TLcCCIdfWB11iTToPpxfxRrQKUmDGsh', 1, '2018-04-28 10:35:44', '2018-04-26 12:12:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_exam` (`id_exam`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `ques`
--
ALTER TABLE `ques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_exam` (`id_exam`),
  ADD KEY `id_que` (`id_que`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_exam` (`id_exam`,`id_user`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `question` (`question`);

--
-- Indexes for table `soras`
--
ALTER TABLE `soras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ques`
--
ALTER TABLE `ques`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soras`
--
ALTER TABLE `soras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `id_exam1` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ques`
--
ALTER TABLE `ques`
  ADD CONSTRAINT `id_exam3` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `id_exam` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question` FOREIGN KEY (`question`) REFERENCES `ques` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

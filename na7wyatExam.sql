-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 10 مايو 2018 الساعة 21:38
-- إصدار الخادم: 10.1.31-MariaDB
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
-- Database: `na7wyatExam`
--

-- --------------------------------------------------------

--
-- بنية الجدول `exams`
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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `members`
--

CREATE TABLE `members` (
  `id` int(10) NOT NULL,
  `id_member` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `permission`
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
-- بنية الجدول `ques`
--

CREATE TABLE `ques` (
  `id` int(10) NOT NULL,
  `id_exam` int(10) DEFAULT NULL,
  `id_que` int(10) DEFAULT NULL,
  `ques` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ans1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ans2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ans3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ans4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ans5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ans6` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ans7` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ans8` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct` int(2) DEFAULT NULL,
  `degree` float DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `results`
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
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  ADD KEY `id_que` (`id_que`),
  ADD KEY `id_que_2` (`id_que`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_exam` (`id_exam`,`id_user`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `question` (`question`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `id_exam1` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `ques`
--
ALTER TABLE `ques`
  ADD CONSTRAINT `id_exam3` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `id_exam` FOREIGN KEY (`id_exam`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ques` FOREIGN KEY (`question`) REFERENCES `ques` (`id_que`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 03, 2018 at 10:58 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `takeyourtime`
--

-- --------------------------------------------------------

--
-- Table structure for table `achieved`
--

DROP TABLE IF EXISTS `achieved`;
CREATE TABLE IF NOT EXISTS `achieved` (
  `user_ID` int(5) DEFAULT NULL,
  `ach_ID` int(5) DEFAULT NULL,
  `date_achieved` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `user_ID` (`user_ID`),
  KEY `ach_ID` (`ach_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `achieved`
--

INSERT INTO `achieved` (`user_ID`, `ach_ID`, `date_achieved`) VALUES
(1, 1, '2018-10-05 12:29:02'),
(1, 2, '2018-10-05 12:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

DROP TABLE IF EXISTS `achievements`;
CREATE TABLE IF NOT EXISTS `achievements` (
  `ach_ID` int(5) NOT NULL AUTO_INCREMENT,
  `ach_name` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `exp_value` int(5) DEFAULT '0',
  `description` varchar(500) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`ach_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`ach_ID`, `ach_name`, `exp_value`, `description`) VALUES
(1, 'Noob', 1000, 'Here&#039;s an achievement badge for you for creating your account. Don&#039;t worry. Everyone starts as a noob, anyways. :D\r\nP.S. A thousand XP headstart for ya&#039;!'),
(2, 'FIRST FOOTSTEP', 1, 'Congratulations on walking your first step!\r\nMay this footstep reach the summit of the mountain someday :)');

-- --------------------------------------------------------

--
-- Table structure for table `breakdown`
--

DROP TABLE IF EXISTS `breakdown`;
CREATE TABLE IF NOT EXISTS `breakdown` (
  `task_ID1` int(5) DEFAULT NULL,
  `task_ID2` int(5) DEFAULT NULL,
  KEY `task_ID1` (`task_ID1`),
  KEY `task_ID2` (`task_ID2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `breakdown`
--

INSERT INTO `breakdown` (`task_ID1`, `task_ID2`) VALUES
(1, 7),
(1, 13),
(1, 14),
(1, 15),
(1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `done`
--

DROP TABLE IF EXISTS `done`;
CREATE TABLE IF NOT EXISTS `done` (
  `task_ID` int(5) DEFAULT NULL,
  `timer_ID` int(5) DEFAULT NULL,
  KEY `task_ID` (`task_ID`),
  KEY `timer_ID` (`timer_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `done`
--

INSERT INTO `done` (`task_ID`, `timer_ID`) VALUES
(1, 1),
(1, 2),
(7, 3),
(7, 4),
(7, 0),
(7, 0),
(7, 0),
(7, 5),
(7, 6),
(7, 7),
(10, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(9, 16),
(11, 17),
(11, 18),
(11, 19),
(11, 20),
(13, 21),
(14, 22),
(15, 23),
(16, 24);

--
-- Triggers `done`
--
DROP TRIGGER IF EXISTS `update_time_spent`;
DELIMITER $$
CREATE TRIGGER `update_time_spent` AFTER INSERT ON `done` FOR EACH ROW BEGIN

  UPDATE Tasks SET time_spent=time_spent+ 
  (SELECT duration FROM Timer WHERE Timer.timer_ID=NEW.timer_ID) WHERE Tasks.task_ID=NEW.task_ID AND time_spent IS NOT NULL;
  UPDATE Tasks SET time_spent=
  (SELECT duration FROM Timer WHERE Timer.timer_ID=NEW.timer_ID) WHERE Tasks.task_ID=NEW.task_ID AND time_spent IS NULL;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `user_ID` int(5) DEFAULT NULL,
  `label_ID` int(5) DEFAULT NULL,
  KEY `user_ID` (`user_ID`),
  KEY `label_ID` (`label_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`user_ID`, `label_ID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

DROP TABLE IF EXISTS `labels`;
CREATE TABLE IF NOT EXISTS `labels` (
  `label_ID` int(5) NOT NULL AUTO_INCREMENT,
  `label_name` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `time_spent` text COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`label_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`label_ID`, `label_name`, `date_created`, `time_spent`) VALUES
(1, 'CS165', '2018-10-05 09:50:39', NULL),
(2, 'H10', '2018-10-05 12:34:54', NULL),
(3, 'CS198', '2018-10-05 12:35:12', NULL),
(4, 'CS131', '2018-10-05 12:35:19', NULL),
(5, 'CS173', '2018-10-05 12:35:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `label_ID` int(5) DEFAULT NULL,
  `task_ID` int(5) DEFAULT NULL,
  KEY `label_ID` (`label_ID`),
  KEY `task_ID` (`task_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`label_ID`, `task_ID`) VALUES
(1, 1),
(1, 7),
(1, 12),
(1, 13),
(2, 5),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `task_ID` int(5) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_520_ci DEFAULT '0',
  `priority` varchar(10) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` timestamp NULL DEFAULT NULL,
  `time_spent` text COLLATE utf8mb4_unicode_520_ci,
  `time_needed` text COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`task_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_ID`, `task_name`, `status`, `priority`, `start_date`, `due_date`, `time_spent`, `time_needed`) VALUES
(1, 'CS 165 Phase 3', '1', NULL, '2018-10-04 03:59:00', '2018-10-05 15:59:00', '1449', '10:00'),
(2, 'Atomic Bomb Essay', '1', NULL, '2018-10-04 03:59:53', '2018-10-08 16:00:00', NULL, '5:00'),
(3, 'PWA Report', '1', NULL, '2018-10-04 04:01:01', '2018-10-09 16:00:00', NULL, '10:00'),
(4, 'Show&Tell Poster', '1', NULL, '2018-10-04 04:01:56', '2018-10-10 16:00:00', NULL, '5:00'),
(5, 'H10 Project Meeting ', '1', NULL, '2018-10-04 04:02:18', '2018-10-08 16:00:00', NULL, '2:00'),
(6, 'H10 Journal Updates', '1', NULL, '2018-10-04 04:02:40', '2018-10-05 16:00:00', NULL, '5:00'),
(7, 'CS165 Boxes', '1', NULL, '2018-10-04 04:03:18', '2018-10-04 16:00:00', '74', '5:00'),
(8, 'H10 LE2', '1', NULL, '2018-10-04 04:04:04', '2018-10-05 16:04:00', NULL, '5:00'),
(9, 'Follow-up Schedule', '1', NULL, '2018-10-05 06:59:32', '2018-10-04 16:00:00', '134', '1:00'),
(10, 'Drink Water', '1', NULL, '2018-10-05 07:30:40', '2018-10-04 16:00:00', '431', '01:00'),
(11, 'Create To-Do-List', '1', NULL, '2018-10-05 07:44:56', '2018-10-04 16:00:00', '799', '00:15'),
(12, 'Submission', '1', NULL, '2018-10-05 09:07:46', '2018-10-05 14:00:00', NULL, '01:00'),
(13, 'Labels', '1', NULL, '2018-10-05 09:43:54', '2018-10-05 10:30:00', '1675', '00:30'),
(14, 'Breakdown', '1', NULL, '2018-10-05 10:13:36', '2018-10-05 11:30:00', '522', '01:00'),
(15, 'Achievements', '1', NULL, '2018-10-05 10:14:21', '2018-10-05 13:00:00', '1009', '01:00'),
(16, 'Populating DB', '1', NULL, '2018-10-05 12:32:01', '2018-10-05 13:00:00', '336', '0:15'),
(17, 'Phase 5', '0', NULL, '2018-12-02 14:43:42', '2018-12-03 15:59:00', NULL, '36000'),
(18, 'CS 165 Vid', '0', NULL, '2018-12-03 08:30:16', '2018-12-03 13:00:00', NULL, '7200');

-- --------------------------------------------------------

--
-- Table structure for table `timer`
--

DROP TABLE IF EXISTS `timer`;
CREATE TABLE IF NOT EXISTS `timer` (
  `timer_ID` int(5) NOT NULL AUTO_INCREMENT,
  `time_start` timestamp NULL DEFAULT NULL,
  `time_end` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `duration` text COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`timer_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `timer`
--

INSERT INTO `timer` (`timer_ID`, `time_start`, `time_end`, `duration`) VALUES
(1, '2018-10-05 06:51:58', '2018-10-05 06:52:03', '4'),
(2, '2018-10-05 07:13:08', '2018-10-05 07:15:45', '153'),
(3, '2018-10-05 07:21:14', '2018-10-05 07:21:31', '18'),
(4, '2018-10-05 07:22:24', '2018-10-05 07:22:51', '27'),
(5, '2018-10-05 07:26:25', '2018-10-05 07:26:37', '12'),
(6, '2018-10-05 07:27:00', '2018-10-05 07:27:10', '11'),
(7, '2018-10-05 07:28:57', '2018-10-05 07:29:02', '6'),
(8, '2018-10-05 07:32:41', '2018-10-05 07:39:52', '431'),
(9, '2018-10-05 08:09:24', '2018-10-05 08:30:29', '1253'),
(10, '2018-10-05 08:39:02', '2018-10-05 08:39:14', '12'),
(11, '2018-10-05 08:40:02', '2018-10-05 08:40:05', '4'),
(12, '2018-10-05 08:43:59', '2018-10-05 08:44:02', '4'),
(13, '2018-10-05 08:46:00', '2018-10-05 08:46:05', '5'),
(14, '2018-10-05 08:50:00', '2018-10-05 08:50:10', '10'),
(15, '2018-10-05 08:53:10', '2018-10-05 08:53:14', '4'),
(16, '2018-10-05 09:12:02', '2018-10-05 09:14:15', '134'),
(17, '2018-10-05 09:20:04', '2018-10-05 09:20:45', '41'),
(18, '2018-10-05 09:20:56', '2018-10-05 09:24:54', '228'),
(19, '2018-10-05 09:25:44', '2018-10-05 09:26:00', '16'),
(20, '2018-10-05 09:28:10', '2018-10-05 09:36:51', '514'),
(21, '2018-10-05 10:07:53', '2018-10-05 10:10:56', '1675'),
(22, '2018-10-05 12:02:57', '2018-10-05 12:12:11', '522'),
(23, '2018-10-05 12:12:25', '2018-10-05 12:31:37', '1009'),
(24, '2018-10-05 12:32:11', '2018-10-05 12:37:56', '336'),
(25, '2018-12-02 14:43:09', '2018-12-02 14:43:11', '2');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `user_ID` int(5) DEFAULT NULL,
  `task_ID` int(5) DEFAULT NULL,
  KEY `user_ID` (`user_ID`),
  KEY `task_ID` (`task_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`user_ID`, `task_ID`) VALUES
(1, 9),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 10),
(1, 11),
(1, 0),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_ID` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `rank` varchar(10) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `user_name`, `password`, `rank`) VALUES
(1, 'Dindin', 'c79bab4465cbe63ace925ffc63542b6d38f289888da525ef9a2a459c725105d0c661c23e6f5a427c33447eba128a2f9329f348a1990e8a76355be3f24570b559', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achieved`
--
ALTER TABLE `achieved`
  ADD CONSTRAINT `achievedwhat` FOREIGN KEY (`ach_ID`) REFERENCES `achievements` (`ach_ID`),
  ADD CONSTRAINT `achievedwho` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `breakdown`
--
ALTER TABLE `breakdown`
  ADD CONSTRAINT `task1` FOREIGN KEY (`task_ID1`) REFERENCES `tasks` (`task_ID`),
  ADD CONSTRAINT `task2` FOREIGN KEY (`task_ID2`) REFERENCES `tasks` (`task_ID`);

--
-- Constraints for table `done`
--
ALTER TABLE `done`
  ADD CONSTRAINT `task` FOREIGN KEY (`task_ID`) REFERENCES `tasks` (`task_ID`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`label_ID`) REFERENCES `labels` (`label_ID`),
  ADD CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`label_ID`) REFERENCES `labels` (`label_ID`),
  ADD CONSTRAINT `tag_ibfk_2` FOREIGN KEY (`task_ID`) REFERENCES `tasks` (`task_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

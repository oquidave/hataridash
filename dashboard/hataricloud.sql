-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2015 at 07:47 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hataricloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `company` varchar(140) DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  `plan` varchar(50) NOT NULL,
  `acc_status` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `company`, `domain`, `plan`, `acc_status`, `created_on`) VALUES
(2, 'HatariCloud LTD', 'dignited.com', 'Copper', 1, '2015-09-19 12:59:44'),
(3, 'OldTomslens LTD', 'oldtomslens.com', 'Copper', 0, '2015-09-19 12:59:44'),
(4, 'Obilotong', 'www.obilotong.com', 'Copper', 0, '2015-09-19 12:59:44'),
(5, 'Africell LTD', 'www.jane.com', 'Aluminium', 0, '2015-09-19 12:59:44'),
(8, 'OJ LTD', 'www.oj.com', 'Copper', 0, '2015-09-19 12:59:44'),
(9, 'Victor Civil Consults LTD', 'www.kyobeconsults.com', 'Tungsten', 0, '2015-09-19 12:59:44'),
(10, 'Abaho and Sons LTD', 'www.abahoivan.com', 'Tungsten', 0, '2015-09-19 12:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `client_users`
--

CREATE TABLE IF NOT EXISTS `client_users` (
  `user_id` int(25) NOT NULL,
  `client_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='map users to particular clients ';

--
-- Dumping data for table `client_users`
--

INSERT INTO `client_users` (`user_id`, `client_id`) VALUES
(3, 3),
(6, 4),
(5, 2),
(7, 5),
(8, 6),
(9, 7),
(10, 8),
(11, 9),
(12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(50) NOT NULL,
  `domain` varchar(140) NOT NULL,
  `amount` int(10) NOT NULL,
  `plan` varchar(50) NOT NULL,
  `paid_by` int(50) NOT NULL,
  `date_paid` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `client_id`, `domain`, `amount`, `plan`, `paid_by`, `date_paid`) VALUES
(1, '4', 'www.obilotong.com', 350, 'Copper', 0, '2015-09-19 12:59:44'),
(2, '5', 'www.jane.com', 780, 'Aluminium', 0, '2015-09-19 12:59:44'),
(3, '6', 'www.konsults.com', 350, 'Aluminium', 0, '2015-09-19 12:59:44'),
(4, '7', 'www.patadvovates.com', 350, 'Aluminium', 0, '2015-09-19 12:59:44'),
(5, '8', 'www.oj.com', 170, 'Copper', 0, '2015-09-19 12:59:44'),
(6, '9', 'www.kyobeconsults.com', 780, 'Tungsten', 0, '2015-09-19 12:59:44'),
(7, '10', 'www.abahoivan.com', 780, 'Tungsten', 0, '2015-09-19 12:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, '2/OMAvCqTgvxKP2Osp2cku', 1268889823, 1442663485, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(3, '127.0.0.1', '', '$2y$08$FSq.cQTvutp.QX501fJS/OgzYBSrbrOkEJj9r1IEGUFDlzNi0221i', NULL, 'eristaus@gmail.com', NULL, NULL, NULL, NULL, 1442302859, NULL, 1, 'Onyait', 'Odeke', 'OldTomsLens', '0791040262'),
(5, '127.0.0.1', '', '$2y$08$7d1lfKrMtnFv7dQgtA9vGO8A6NHSoHVlLfK3peWX/JU28YhIBUiaS', NULL, 'oquidave@gmail.com', NULL, NULL, NULL, NULL, 1442666411, NULL, 1, 'David', 'Okwii', 'HatariCloud LTD', '256791040262'),
(6, '127.0.0.1', '', '$2y$08$1/pbV.y6nxkP8AfrWjbhpuP6.JOLGMailqgKH8dLV6x43XAkGYA0e', NULL, 'tim@gmail.com', NULL, NULL, NULL, NULL, 1442675018, NULL, 1, 'Tim', 'katuramu', 'Obilotong', '256792516933'),
(7, '127.0.0.1', '', '$2y$08$bcweDW1pxBOuk0xg7za1g.6FGoDnCOdE/QV2BvhVAnLVbJWWef7AC', NULL, 'jane@gmail.com', NULL, NULL, NULL, NULL, 1442676549, NULL, 1, 'Jane', 'Wambi', 'Africell LTD', '256791098345'),
(8, '127.0.0.1', '', '$2y$08$WJP7F4I4.BoWSCsdOLFPruGN83RLlsb4ffHAp3Dd2zvLK3lhGYsna', NULL, 'peter.muhanguzi@gmail.com', NULL, NULL, NULL, NULL, 1442677007, NULL, 1, 'Peter', 'Muhanguzi', 'Konsults LTD', '256791457689'),
(9, '127.0.0.1', '', '$2y$08$yu7/DWYdZsbNZAOvtC9U4uwo1pXfvJG0ZZiSYQdBldOaM2RbCIvZG', NULL, 'patrick@gmail.com', NULL, NULL, NULL, NULL, 1442677165, NULL, 1, 'Patrick', 'Wanyama', 'Patrick Advocates', '256782345697'),
(10, '127.0.0.1', '', '$2y$08$BRPWMeH3Oq8ua5sDpBAXpO.vFltL6nTOHQe9Ux36VOAvGc8dlAO0a', NULL, 'oj@gmail.com', NULL, NULL, NULL, NULL, 1442677513, NULL, 1, 'Ojirot', 'Patrick', 'OJ LTD', '256791987234'),
(11, '127.0.0.1', '', '$2y$08$9Dc73X2d.B4gKiImEttY2ObsXSvNalqpsAnD7/QaDKqNjnYmTj2wW', NULL, 'victor@yahoo.com', NULL, NULL, NULL, NULL, 1442677773, NULL, 1, 'Kyobe', 'Victor', 'Victor Civil Consults LTD', '256791987234'),
(12, '127.0.0.1', '', '$2y$08$zRaxTB7Jct37T4ElLInzX.IPTphqSBGvOhtvCv5QpAF26UoVGVvoi', NULL, 'abaho.ivan@yahoo.com', NULL, NULL, NULL, NULL, 1442677921, NULL, 1, 'Ivan', 'Abaho', 'Abaho and Sons LTD', '256782456987');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 3, 2),
(8, 5, 2),
(9, 6, 2),
(10, 7, 2),
(11, 8, 2),
(12, 9, 2),
(13, 10, 2),
(14, 11, 2),
(15, 12, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

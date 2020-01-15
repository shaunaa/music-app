-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2019 at 09:29 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music_app_2019`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertIntoPayments` (IN `cardAndUserId` INT, IN `songId` INT, IN `dateAndTime` DATETIME, IN `paidMoney` VARCHAR(10))  BEGIN 
	
    INSERT INTO payments(cardAndUserId,songId,dateAndTime,paidMoney)
    VALUE (cardAndUserId,songId,dateAndTime,paidMoney);

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `cardAndUserId` int(11) NOT NULL,
  `iban` char(18) NOT NULL,
  `expDate` char(5) NOT NULL,
  `cvv` char(3) NOT NULL,
  `paidMoney` decimal(10,0) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`cardAndUserId`, `iban`, `expDate`, `cvv`, `paidMoney`, `userId`) VALUES
(17, 'dk1234567890123421', '11/11', '111', '400', 55),
(18, 'dk1234567890123458', '11/11', '111', '212', 55),
(19, 'dk1234567890123451', '11/11', '111', '272', 56),
(20, 'dk1234567890123451', '11/11', '111', '100', 57),
(21, 'dk1234567890123458', '11/11', '111', '100', 57),
(22, 'dk1234567890123421', '11/11', '111', '100', 59),
(23, 'dk1234567890153421', '11/11', '111', '100', 59),
(24, 'dk1234563390123458', '11/11', '111', '212', 56),
(25, 'dk1234567890123458', '11/11', '111', '12', 56),
(26, 'dk1234567890123454', '11/11', '111', '12', 56),
(28, 'dk1234567890123458', '11/11', '111', '12', 56);

--
-- Triggers `cards`
--
DELIMITER $$
CREATE TRIGGER `deleteCard` AFTER DELETE ON `cards` FOR EACH ROW INSERT INTO card_audit VALUES('delete',CURRENT_USER(),NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertCard` AFTER INSERT ON `cards` FOR EACH ROW INSERT INTO card_audit VALUES('insert',CURRENT_USER(),NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateCard` BEFORE UPDATE ON `cards` FOR EACH ROW INSERT INTO card_audit VALUES('update',CURRENT_USER(),NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `card_audit`
--

CREATE TABLE `card_audit` (
  `auditAction` varchar(30) NOT NULL,
  `ModifiedBy` varchar(30) NOT NULL,
  `ModifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_audit`
--

INSERT INTO `card_audit` (`auditAction`, `ModifiedBy`, `ModifiedDate`) VALUES
('insert', 'root@localhost', '2019-12-02 18:47:32'),
('delete', 'root@localhost', '2019-12-02 18:48:33'),
('update', 'root@localhost', '2019-12-02 18:49:38'),
('update', 'root@localhost', '2019-12-02 21:11:11'),
('update', 'root@localhost', '2019-12-02 21:11:36'),
('update', 'root@localhost', '2019-12-02 21:13:31'),
('insert', 'root@localhost', '2019-12-09 16:06:22'),
('insert', 'root@localhost', '2019-12-09 16:06:46'),
('insert', 'root@localhost', '2019-12-09 16:07:48'),
('insert', 'root@localhost', '2019-12-09 16:07:56'),
('insert', 'root@localhost', '2019-12-09 16:08:44'),
('insert', 'root@localhost', '2019-12-09 16:08:51'),
('insert', 'root@localhost', '2019-12-09 16:10:34'),
('insert', 'root@localhost', '2019-12-09 16:10:41'),
('insert', 'root@localhost', '2019-12-09 16:11:21'),
('insert', 'root@localhost', '2019-12-09 16:11:27'),
('insert', 'root@localhost', '2019-12-10 21:33:01'),
('update', 'root@localhost', '2019-12-10 21:34:18'),
('insert', 'root@localhost', '2019-12-10 21:35:28'),
('insert', 'root@localhost', '2019-12-10 21:42:58'),
('insert', 'root@localhost', '2019-12-10 21:43:19'),
('update', 'root@localhost', '2019-12-10 21:45:20'),
('update', 'root@localhost', '2019-12-10 21:47:36'),
('update', 'root@localhost', '2019-12-10 22:05:13'),
('update', 'root@localhost', '2019-12-10 22:07:13'),
('update', 'root@localhost', '2019-12-10 22:07:33'),
('update', 'root@localhost', '2019-12-10 22:10:32'),
('update', 'root@localhost', '2019-12-10 22:11:24'),
('update', 'root@localhost', '2019-12-10 22:12:17'),
('update', 'root@localhost', '2019-12-10 22:15:23'),
('insert', 'root@localhost', '2019-12-10 22:17:10'),
('update', 'root@localhost', '2019-12-10 22:17:16'),
('update', 'root@localhost', '2019-12-10 22:18:00'),
('insert', 'root@localhost', '2019-12-10 22:23:30'),
('delete', 'root@localhost', '2019-12-10 22:23:54'),
('delete', 'root@localhost', '2019-12-10 22:23:54'),
('insert', 'root@localhost', '2019-12-10 22:24:00'),
('update', 'root@localhost', '2019-12-10 22:25:14'),
('update', 'root@localhost', '2019-12-10 22:25:37'),
('update', 'root@localhost', '2019-12-10 22:26:37'),
('insert', 'root@localhost', '2019-12-10 22:26:44'),
('update', 'root@localhost', '2019-12-10 22:27:06'),
('insert', 'root@localhost', '2019-12-10 22:29:37'),
('update', 'root@localhost', '2019-12-10 22:29:58'),
('insert', 'root@localhost', '2019-12-10 22:31:33'),
('insert', 'root@localhost', '2019-12-10 22:31:52'),
('insert', 'root@localhost', '2019-12-10 22:33:06'),
('insert', 'root@localhost', '2019-12-10 22:33:56'),
('insert', 'root@localhost', '2019-12-10 22:34:40'),
('update', 'root@localhost', '2019-12-10 22:35:05'),
('update', 'root@localhost', '2019-12-12 17:04:01'),
('update', 'root@localhost', '2019-12-14 21:58:52'),
('update', 'root@localhost', '2019-12-14 22:03:56'),
('update', 'root@localhost', '2019-12-14 22:04:09'),
('update', 'root@localhost', '2019-12-14 22:04:26'),
('update', 'root@localhost', '2019-12-14 22:12:40'),
('update', 'root@localhost', '2019-12-14 22:22:48'),
('update', 'root@localhost', '2019-12-14 22:23:06'),
('insert', 'root@localhost', '2019-12-14 23:08:29'),
('insert', 'root@localhost', '2019-12-14 23:08:32'),
('insert', 'root@localhost', '2019-12-14 23:14:11'),
('insert', 'root@localhost', '2019-12-16 20:49:21'),
('insert', 'root@localhost', '2019-12-16 20:50:25'),
('insert', 'root@localhost', '2019-12-16 20:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `cardAndUserId` int(11) NOT NULL,
  `songId` int(11) NOT NULL,
  `dateAndTime` datetime NOT NULL,
  `paidMoney` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`cardAndUserId`, `songId`, `dateAndTime`, `paidMoney`) VALUES
(17, 36, '2019-12-10 10:24:00', '100'),
(17, 36, '2019-12-10 10:26:37', '100'),
(18, 36, '2019-12-10 10:26:44', '100'),
(18, 36, '2019-12-10 10:27:06', '100'),
(18, 36, '2019-12-12 05:04:01', '12'),
(19, 36, '2019-12-10 10:29:37', '100'),
(19, 36, '2019-12-10 10:29:58', '100'),
(19, 36, '2019-12-14 10:04:09', '12'),
(19, 36, '2019-12-14 10:04:26', '12'),
(19, 36, '2019-12-14 10:12:40', '12'),
(19, 36, '2019-12-14 10:23:06', '12'),
(20, 36, '2019-12-10 10:31:33', '100'),
(21, 36, '2019-12-10 10:31:52', '100'),
(22, 39, '2019-12-10 10:33:06', '100'),
(23, 39, '2019-12-10 10:33:56', '100'),
(24, 36, '2019-12-10 10:34:40', '100'),
(24, 36, '2019-12-10 10:35:05', '100'),
(24, 36, '2019-12-14 10:22:48', '12'),
(25, 36, '2019-12-14 11:08:29', '12'),
(26, 36, '2019-12-14 11:08:32', '12');

--
-- Triggers `payments`
--
DELIMITER $$
CREATE TRIGGER `deletePayment` AFTER DELETE ON `payments` FOR EACH ROW INSERT INTO payment_audit VALUES('delete',CURRENT_USER(),NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertPayment` AFTER INSERT ON `payments` FOR EACH ROW INSERT INTO payment_audit VALUES('insert',CURRENT_USER(),NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updatePayment` AFTER UPDATE ON `payments` FOR EACH ROW INSERT INTO payment_audit VALUES('update',CURRENT_USER(),NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_audit`
--

CREATE TABLE `payment_audit` (
  `auditAction` varchar(30) NOT NULL,
  `ModifiedBy` varchar(30) NOT NULL,
  `ModifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_audit`
--

INSERT INTO `payment_audit` (`auditAction`, `ModifiedBy`, `ModifiedDate`) VALUES
('insert', 'root@localhost', '2019-12-02 18:54:10'),
('update', 'root@localhost', '2019-12-02 18:57:48'),
('insert', 'root@localhost', '2019-12-02 21:11:11'),
('insert', 'root@localhost', '2019-12-02 21:11:36'),
('insert', 'root@localhost', '2019-12-02 21:13:31'),
('insert', 'root@localhost', '2019-12-09 16:06:22'),
('insert', 'root@localhost', '2019-12-09 16:06:46'),
('insert', 'root@localhost', '2019-12-09 16:07:48'),
('insert', 'root@localhost', '2019-12-09 16:07:56'),
('insert', 'root@localhost', '2019-12-09 16:08:44'),
('insert', 'root@localhost', '2019-12-09 16:08:51'),
('insert', 'root@localhost', '2019-12-09 16:10:34'),
('insert', 'root@localhost', '2019-12-09 16:10:41'),
('insert', 'root@localhost', '2019-12-09 16:11:21'),
('insert', 'root@localhost', '2019-12-09 16:11:27'),
('insert', 'root@localhost', '2019-12-10 21:33:01'),
('insert', 'root@localhost', '2019-12-10 21:34:18'),
('insert', 'root@localhost', '2019-12-10 21:35:28'),
('insert', 'root@localhost', '2019-12-10 21:45:20'),
('insert', 'root@localhost', '2019-12-10 21:47:36'),
('insert', 'root@localhost', '2019-12-10 22:05:13'),
('insert', 'root@localhost', '2019-12-10 22:07:13'),
('insert', 'root@localhost', '2019-12-10 22:07:33'),
('insert', 'root@localhost', '2019-12-10 22:10:32'),
('insert', 'root@localhost', '2019-12-10 22:11:24'),
('insert', 'root@localhost', '2019-12-10 22:12:17'),
('insert', 'root@localhost', '2019-12-10 22:15:23'),
('insert', 'root@localhost', '2019-12-10 22:17:10'),
('insert', 'root@localhost', '2019-12-10 22:17:16'),
('insert', 'root@localhost', '2019-12-10 22:18:00'),
('insert', 'root@localhost', '2019-12-10 22:23:30'),
('insert', 'root@localhost', '2019-12-10 22:24:00'),
('insert', 'root@localhost', '2019-12-10 22:26:37'),
('insert', 'root@localhost', '2019-12-10 22:26:44'),
('insert', 'root@localhost', '2019-12-10 22:27:06'),
('insert', 'root@localhost', '2019-12-10 22:29:37'),
('insert', 'root@localhost', '2019-12-10 22:29:58'),
('insert', 'root@localhost', '2019-12-10 22:31:33'),
('insert', 'root@localhost', '2019-12-10 22:31:52'),
('insert', 'root@localhost', '2019-12-10 22:33:06'),
('insert', 'root@localhost', '2019-12-10 22:33:56'),
('insert', 'root@localhost', '2019-12-10 22:34:40'),
('insert', 'root@localhost', '2019-12-10 22:35:05'),
('insert', 'root@localhost', '2019-12-12 17:04:01'),
('insert', 'root@localhost', '2019-12-14 22:04:09'),
('insert', 'root@localhost', '2019-12-14 22:04:26'),
('insert', 'root@localhost', '2019-12-14 22:12:40'),
('insert', 'root@localhost', '2019-12-14 22:22:48'),
('insert', 'root@localhost', '2019-12-14 22:23:06'),
('insert', 'root@localhost', '2019-12-14 23:08:29'),
('insert', 'root@localhost', '2019-12-14 23:08:32'),
('insert', 'root@localhost', '2019-12-14 23:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `musicianId` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `duration` char(5) NOT NULL,
  `year` char(4) NOT NULL,
  `genre` varchar(70) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `songFile` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `musicianId`, `title`, `duration`, `year`, `genre`, `price`, `songFile`) VALUES
(36, 60, 'now', '02:03', '1999', 'rock', '12', '5dee5ba5537eb.mp3'),
(37, 60, 'now', '02:21', '1995', 'rock', '12', '5dee5c0697057.mp3'),
(39, 61, 'noww', '06:03', '1987', 'classical', '12', '5dee5d767e421.mp3'),
(40, 61, 'now', '02:32', '2019', 'classical', '12', '5dee5db37c5db.mp3'),
(41, 62, 'now', '04:12', '2014', 'funky', '12', '5dee5e3a5ee92.mp3'),
(42, 62, 'now', '05:22', '2009', 'rock', '12', '5dee5e646f5cf.mp3'),
(43, 62, 'now', '02:32', '1992', 'rock', '12', '5dee5eb7c41be.mp3'),
(44, 62, 'now', '02:08', '2005', 'rock', '12', '5dee5ed36b35a.mp3'),
(45, 61, 'now', '01:03', '2011', 'metal', '12', '5dee5f7accc66.mp3'),
(46, 61, 'now', '01:12', '2009', 'funky', '12', '5dee5fd58bfa9.mp3'),
(47, 61, 'now', '02:33', '2016', 'rock', '12', '5dee5ff419b2b.mp3'),
(48, 61, 'now', '02:32', '1998', 'rock', '12', '5dee612a15de5.mp3'),
(49, 61, 'now', '03:20', '2008', 'rock', '12', '5dee6151ce927.mp3'),
(50, 61, 'let', '02:30', '2019', 'rock', '12', '5dee617c6f477.mp3'),
(51, 61, 'now', '05:02', '2011', 'rock', '12', '5dee6194cf556.mp3'),
(52, 61, 'now', '01:34', '1999', 'rock', '12', '5dee61b2cb5ad.mp3'),
(53, 61, 'now', '04:19', '2012', 'funky', '12', '5dee61d793eb0.mp3'),
(54, 61, 'now', '02:42', '2017', 'rock', '12', '5dee61f42a284.mp3'),
(55, 61, 'now', '02:33', '1987', 'rock', '12', '5dee62279bebf.mp3'),
(56, 61, 'now', '01:19', '2013', 'rock', '12', '5dee62493c995.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(70) NOT NULL,
  `password` varchar(75) NOT NULL,
  `dateOfCreation` datetime NOT NULL,
  `address` varchar(500) NOT NULL,
  `phoneNumber` char(8) NOT NULL,
  `dateOfCancelation` datetime NOT NULL,
  `CPR` char(11) NOT NULL,
  `isMusician` tinyint(1) NOT NULL,
  `paidMoney` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `firstName`, `lastName`, `password`, `dateOfCreation`, `address`, `phoneNumber`, `dateOfCancelation`, `CPR`, `isMusician`, `paidMoney`) VALUES
(55, 'user1', 'user1@u.com', 'user', 'one', '1c31e98345a1c6b7c39cf7f0e1ff3ef2', '2019-12-09 03:17:01', 'Copenhagen', '21023309', '0000-00-00 00:00:00', '240691-3341', 0, '2512'),
(56, 'user2', 'user2@u.coms', 'user', 'two', '35314df2291a7ba05851ec60beef5a35', '2019-12-09 03:18:51', 'Aalborg', '50129032', '0000-00-00 00:00:00', '200289-3678', 0, '708'),
(57, 'user3', 'user3@u.com', 'user', 'three', '35314df2291a7ba05851ec60beef5a35', '2019-12-09 03:20:40', 'Odense', '21128039', '0000-00-00 00:00:00', '111102-1111', 0, '600'),
(58, 'user4', 'user4@u.com', 'user', 'foour', '35314df2291a7ba05851ec60beef5a35', '2019-12-09 03:21:48', 'Lygten 13, Copenhagen', '50998099', '0000-00-00 00:00:00', '101102-1111', 0, '200'),
(59, 'user5', 'user5@u.com', 'user', 'five', '35314df2291a7ba05851ec60beef5a35', '2019-12-09 03:26:20', 'Copenhagen', '50121122', '0000-00-00 00:00:00', '101202-1111', 0, '600'),
(60, 'musician1', 'musicia1@m.com', 'musician', 'one', '35314df2291a7ba05851ec60beef5a35', '2019-12-09 03:29:14', 'Copenhagen', '41128039', '0000-00-00 00:00:00', '111102-1131', 1, '0'),
(61, 'musician2', 'musicia2@m.com', 'musician', 'two', '35314df2291a7ba05851ec60beef5a35', '2019-12-09 03:39:48', 'Aalborg Kastevej 12', '50215039', '0000-00-00 00:00:00', '101102-4355', 1, '0'),
(62, 'musician3', 'musicia3@m.com', 'musician', 'three', '35314df2291a7ba05851ec60beef5a35', '2019-12-09 03:45:41', 'Kastevej Copenhagen', '50121919', '0000-00-00 00:00:00', '091102-1141', 1, '0');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `deleteUser` AFTER DELETE ON `users` FOR EACH ROW INSERT INTO user_audit VALUES('delete',CURRENT_USER(),NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertUser` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO user_audit VALUES('insert',CURRENT_USER(),NOW())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateUser` AFTER UPDATE ON `users` FOR EACH ROW INSERT INTO user_audit VALUES('update',CURRENT_USER(),NOW())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_audit`
--

CREATE TABLE `user_audit` (
  `auditAction` varchar(30) NOT NULL,
  `modifiedBy` varchar(30) NOT NULL,
  `modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_audit`
--

INSERT INTO `user_audit` (`auditAction`, `modifiedBy`, `modifiedDate`) VALUES
('insert', 'myname', '2019-12-02 18:21:24'),
('insert', 'root@localhost', '2019-12-02 18:34:20'),
('insert', 'root@localhost', '2019-12-02 18:34:40'),
('insert', 'root@localhost', '2019-12-02 18:35:31'),
('delete', 'root@localhost', '2019-12-02 18:40:32'),
('update', 'root@localhost', '2019-12-02 18:41:27'),
('update', 'root@localhost', '2019-12-02 21:11:11'),
('update', 'root@localhost', '2019-12-02 21:11:36'),
('update', 'root@localhost', '2019-12-02 21:13:31'),
('insert', 'root@localhost', '2019-12-09 14:29:08'),
('insert', 'root@localhost', '2019-12-09 15:17:01'),
('insert', 'root@localhost', '2019-12-09 15:18:51'),
('insert', 'root@localhost', '2019-12-09 15:20:40'),
('insert', 'root@localhost', '2019-12-09 15:21:48'),
('insert', 'root@localhost', '2019-12-09 15:26:20'),
('insert', 'root@localhost', '2019-12-09 15:29:14'),
('insert', 'root@localhost', '2019-12-09 15:39:48'),
('insert', 'root@localhost', '2019-12-09 15:45:41'),
('update', 'root@localhost', '2019-12-09 16:06:22'),
('update', 'root@localhost', '2019-12-09 16:06:46'),
('update', 'root@localhost', '2019-12-09 16:07:48'),
('update', 'root@localhost', '2019-12-09 16:07:56'),
('update', 'root@localhost', '2019-12-09 16:08:44'),
('update', 'root@localhost', '2019-12-09 16:08:51'),
('update', 'root@localhost', '2019-12-09 16:10:34'),
('update', 'root@localhost', '2019-12-09 16:10:41'),
('update', 'root@localhost', '2019-12-09 16:11:21'),
('update', 'root@localhost', '2019-12-09 16:11:27'),
('update', 'root@localhost', '2019-12-09 16:28:20'),
('update', 'root@localhost', '2019-12-10 21:33:01'),
('update', 'root@localhost', '2019-12-10 21:34:18'),
('update', 'root@localhost', '2019-12-10 21:35:28'),
('update', 'root@localhost', '2019-12-10 21:42:58'),
('update', 'root@localhost', '2019-12-10 21:43:19'),
('update', 'root@localhost', '2019-12-10 21:45:20'),
('update', 'root@localhost', '2019-12-10 21:47:36'),
('update', 'root@localhost', '2019-12-10 22:05:13'),
('update', 'root@localhost', '2019-12-10 22:07:13'),
('update', 'root@localhost', '2019-12-10 22:07:33'),
('update', 'root@localhost', '2019-12-10 22:10:32'),
('update', 'root@localhost', '2019-12-10 22:11:24'),
('update', 'root@localhost', '2019-12-10 22:12:17'),
('update', 'root@localhost', '2019-12-10 22:15:23'),
('update', 'root@localhost', '2019-12-10 22:17:10'),
('update', 'root@localhost', '2019-12-10 22:17:16'),
('update', 'root@localhost', '2019-12-10 22:18:00'),
('update', 'root@localhost', '2019-12-10 22:23:30'),
('update', 'root@localhost', '2019-12-10 22:24:00'),
('update', 'root@localhost', '2019-12-10 22:25:14'),
('update', 'root@localhost', '2019-12-10 22:25:37'),
('update', 'root@localhost', '2019-12-10 22:26:37'),
('update', 'root@localhost', '2019-12-10 22:26:44'),
('update', 'root@localhost', '2019-12-10 22:27:06'),
('update', 'root@localhost', '2019-12-10 22:29:37'),
('update', 'root@localhost', '2019-12-10 22:29:58'),
('update', 'root@localhost', '2019-12-10 22:31:33'),
('update', 'root@localhost', '2019-12-10 22:31:52'),
('update', 'root@localhost', '2019-12-10 22:33:06'),
('update', 'root@localhost', '2019-12-10 22:33:56'),
('update', 'root@localhost', '2019-12-10 22:34:40'),
('update', 'root@localhost', '2019-12-10 22:35:05'),
('update', 'root@localhost', '2019-12-11 19:28:09'),
('insert', 'root@localhost', '2019-12-11 19:28:44'),
('update', 'root@localhost', '2019-12-11 19:28:57'),
('update', 'root@localhost', '2019-12-12 17:04:01'),
('insert', 'root@localhost', '2019-12-13 20:32:06'),
('insert', 'root@localhost', '2019-12-13 23:41:43'),
('insert', 'root@localhost', '2019-12-13 23:42:38'),
('insert', 'root@localhost', '2019-12-13 23:42:44'),
('insert', 'root@localhost', '2019-12-13 23:43:02'),
('insert', 'root@localhost', '2019-12-13 23:43:20'),
('insert', 'root@localhost', '2019-12-13 23:44:34'),
('insert', 'root@localhost', '2019-12-13 23:48:11'),
('insert', 'root@localhost', '2019-12-13 23:59:54'),
('insert', 'root@localhost', '2019-12-14 00:11:45'),
('insert', 'root@localhost', '2019-12-14 00:12:58'),
('insert', 'root@localhost', '2019-12-14 00:17:40'),
('update', 'root@localhost', '2019-12-14 13:23:21'),
('update', 'root@localhost', '2019-12-14 13:24:39'),
('update', 'root@localhost', '2019-12-14 13:24:40'),
('update', 'root@localhost', '2019-12-14 13:34:47'),
('update', 'root@localhost', '2019-12-14 13:35:02'),
('update', 'root@localhost', '2019-12-14 13:35:03'),
('update', 'root@localhost', '2019-12-14 13:35:28'),
('insert', 'root@localhost', '2019-12-14 19:05:29'),
('update', 'root@localhost', '2019-12-14 21:58:52'),
('update', 'root@localhost', '2019-12-14 22:03:56'),
('update', 'root@localhost', '2019-12-14 22:04:09'),
('update', 'root@localhost', '2019-12-14 22:04:26'),
('update', 'root@localhost', '2019-12-14 22:12:40'),
('update', 'root@localhost', '2019-12-14 22:22:48'),
('update', 'root@localhost', '2019-12-14 22:23:06'),
('update', 'root@localhost', '2019-12-14 23:08:29'),
('update', 'root@localhost', '2019-12-14 23:08:32'),
('insert', 'root@localhost', '2019-12-14 23:14:05'),
('update', 'root@localhost', '2019-12-14 23:14:11'),
('insert', 'root@localhost', '2019-12-16 16:43:52'),
('insert', 'root@localhost', '2019-12-16 20:50:19'),
('insert', 'root@localhost', '2019-12-17 21:24:36'),
('update', 'root@localhost', '2019-12-17 21:28:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`cardAndUserId`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`cardAndUserId`,`dateAndTime`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `cardAndUserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

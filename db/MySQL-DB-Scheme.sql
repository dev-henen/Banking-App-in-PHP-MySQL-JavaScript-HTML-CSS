-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2023 at 04:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `MidleName` varchar(30) DEFAULT NULL,
  `LastName` varchar(30) NOT NULL,
  `Gender` enum('female','male','other','') NOT NULL DEFAULT 'other',
  `Birthday` varchar(30) NOT NULL,
  `Address` text NOT NULL,
  `AccountNumber` int(10) UNSIGNED ZEROFILL NOT NULL,
  `Balance` varchar(255) NOT NULL DEFAULT '0',
  `CheckingBalance` varchar(255) DEFAULT '0',
  `Rewards` varchar(255) DEFAULT '0',
  `Phone` varchar(30) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(300) NOT NULL,
  `PIN` int(4) UNSIGNED ZEROFILL NOT NULL,
  `Type` enum('client','admin','agent','') NOT NULL DEFAULT 'client',
  `Status` enum('active','blocked','pending','locked') NOT NULL DEFAULT 'pending',
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `UserName`, `FirstName`, `MidleName`, `LastName`, `Gender`, `Birthday`, `Address`, `AccountNumber`, `Balance`, `CheckingBalance`, `Rewards`, `Phone`, `Email`, `Password`, `PIN`, `Type`, `Status`, `RegDate`) VALUES
(5, 'admin', 'BankProject', NULL, 'admin', 'other', '', '', 1110000000, '99999996444', '0', '0', '08032112285', 'admin@bankproject.com', '$2y$10$QAMLbousCzS.ZM5YGyu03.heY8S2XXZo3mg.PBZaOrlsVbyBLMeuy', 0000, 'admin', 'active', '2023-08-29 05:11:23'),
(15, 'john', 'John', NULL, 'Doe', 'male', '', '', 1692600731, '1.1', '0', '0', '08032112285', 'johndeo@gmail.com', '$2y$09$S694YUg4eKhphuPasZ1U0.eteWJY2KpVd4YbCydbLseKZ/VUY99/q', 2002, 'client', 'active', '2023-08-26 19:32:49'),
(16, 'jane', 'Jane', NULL, 'Doe', 'female', '27-05-2003', '', 1692602235, '554.8', '0', '0', '07017440088', 'janedoe@gmail.com', '$2y$10$/fo3OuJ7emTwxi0hDcKs1exeKPY2/19A/uX1nTF1mEeshZchjqKCu', 2002, 'client', 'active', '2023-08-26 19:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `bank_history`
--

CREATE TABLE `bank_history` (
  `ID` bigint(20) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `Body` tinytext NOT NULL,
  `RecieveDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bank_history`
--

INSERT INTO `bank_history` (`ID`, `CustomerID`, `Body`, `RecieveDate`) VALUES
(3, 14, 'You tranfered USD 1.2 to 1692602425, on Saturday, 26 Aug, 2023, at 22:52', '2023-08-26 20:52:42'),
(4, 14, 'You tranfered 0.5 USD to 1692602425, on Saturday, 26 Aug, 2023, at 21:11', '2023-08-26 19:11:04'),
(5, 14, 'You tranfered 2 USD to 1692600731, on Saturday, 26 Aug, 2023, at 21:22', '2023-08-26 19:22:32'),
(6, 15, 'You tranfered 1.9 USD to 1692595917, on Saturday, 26 Aug, 2023, at 21:23', '2023-08-26 19:23:48'),
(7, 14, 'You tranfered 2 USD to 1692600731, on Saturday, 26 Aug, 2023, at 21:28', '2023-08-26 19:28:27'),
(8, 15, 'You\'ve revieve 2 USD from 1692595917, on Saturday, 26 Aug, 2023, at 21:28', '2023-08-26 19:28:27'),
(9, 15, 'You tranfered 1 USD to 1692602235, on Saturday, 26 Aug, 2023, at 21:32', '2023-08-26 19:32:50'),
(10, 16, 'You revieve 1 USD from 1692600731, on Saturday, 26 Aug, 2023, at 21:32', '2023-08-26 19:32:50'),
(11, 5, 'You tranfered 150 USD to 1692602235, on Saturday, 26 Aug, 2023, at 21:43', '2023-08-26 19:43:19'),
(12, 5, 'You tranfered 6 USD to 1692602235, on Saturday, 26 Aug, 2023, at 21:47', '2023-08-26 19:47:26'),
(13, 16, 'You revieve 6 USD from 1110000000, on Saturday, 26 Aug, 2023, at 21:47', '2023-08-26 19:47:26'),
(14, 16, 'You tranfered 1 USD to 1111111111, on Saturday, 26 Aug, 2023, at 21:08', '2023-08-26 19:08:19'),
(15, 16, 'You tranfered 1.2 USD to 1692595917, on Saturday, 26 Aug, 2023, at 21:14. <br/><b>Bank:</b> this', '2023-08-26 19:14:13'),
(16, 14, 'You revieve 1.2 USD from 1692602235, on Saturday, 26 Aug, 2023, at 21:14. <br/><b>Bank:</b> BankProject', '2023-08-26 19:14:13'),
(17, 14, 'You tranfered 10 USD to 7025044730, on Tuesday, 29 Aug, 2023, at 06:55', '2023-08-29 04:55:02'),
(18, 5, 'You tranfered 2000 USD to 1692595917, on Tuesday, 29 Aug, 2023, at 07:11', '2023-08-29 05:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `bank_notifications`
--

CREATE TABLE `bank_notifications` (
  `ID` int(11) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `Body` tinytext NOT NULL,
  `RecieveDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bank_notifications`
--

INSERT INTO `bank_notifications` (`ID`, `CustomerID`, `Body`, `RecieveDate`) VALUES
(1, 0, 'Welcome to online banking.', '2023-08-29 04:21:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `AccountNumber` (`AccountNumber`),
  ADD UNIQUE KEY `UserName` (`UserName`,`Phone`,`Email`);

--
-- Indexes for table `bank_history`
--
ALTER TABLE `bank_history`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `bank_history` ADD FULLTEXT KEY `Body` (`Body`);

--
-- Indexes for table `bank_notifications`
--
ALTER TABLE `bank_notifications`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `bank_notifications` ADD FULLTEXT KEY `Body` (`Body`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bank_history`
--
ALTER TABLE `bank_history`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `bank_notifications`
--
ALTER TABLE `bank_notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

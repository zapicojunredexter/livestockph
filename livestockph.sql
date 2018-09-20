-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2018 at 04:32 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livestockph`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `AccountId` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `AccountType` varchar(100) NOT NULL,
  `AccountStatus` int(11) NOT NULL DEFAULT '1',
  `OwnerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`AccountId`, `Username`, `Password`, `AccountType`, `AccountStatus`, `OwnerId`) VALUES
(1, 'junre', 'junre', 'Subscriber', 1, 1),
(2, 'dexter', 'dexter', 'Customer', 1, 1),
(3, 'dexter', 'dexter', 'Customer', 1, 2),
(4, 'jurne1', 'junre1', 'Subscriber', 1, 2),
(5, 'jurne1', 'junre', 'Subscriber', 1, 3),
(6, 'jurne1s', 'jurne1s', 'Subscriber', 1, 4),
(7, '', '', 'Subscriber', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `breeds`
--

CREATE TABLE `breeds` (
  `BreedId` int(11) NOT NULL,
  `BreedDescription` varchar(100) NOT NULL,
  `CategoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breeds`
--

INSERT INTO `breeds` (`BreedId`, `BreedDescription`, `CategoryId`) VALUES
(1, 'Local C', 1),
(2, 'Imported C', 1),
(3, 'Local Chicken', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryId` int(11) NOT NULL,
  `CategoryDescription` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryId`, `CategoryDescription`) VALUES
(1, 'Cow'),
(2, 'Chicken');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `CertificateNo` int(11) NOT NULL,
  `CertificateName` varchar(100) NOT NULL,
  `IssuedBy` varchar(100) DEFAULT NULL,
  `DateIssued` varchar(100) DEFAULT NULL,
  `Expiration` varchar(100) DEFAULT NULL,
  `SupplierNo` int(11) NOT NULL,
  `FileName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`CertificateNo`, `CertificateName`, `IssuedBy`, `DateIssued`, `Expiration`, `SupplierNo`, `FileName`) VALUES
(3, 'tes', 'tes', '2018-09-16', '2018-09-16', 1, '1-1537132612.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeNo` int(11) NOT NULL,
  `EmpFName` varchar(100) NOT NULL,
  `EmpLName` varchar(100) NOT NULL,
  `AcctStatus` int(11) NOT NULL DEFAULT '1',
  `SupplierNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeNo`, `EmpFName`, `EmpLName`, `AcctStatus`, `SupplierNo`) VALUES
(1, 'Junre', 'Zapico', 1, 1),
(2, 'junre1', 'junre1', 1, 1),
(3, 'junre1', 'junre', 1, 1),
(4, 'junres', 'juren', 1, 1),
(5, '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `livestockbuyers`
--

CREATE TABLE `livestockbuyers` (
  `BuyerNo` int(11) NOT NULL,
  `BuyerFName` varchar(100) NOT NULL,
  `BuyerLName` varchar(100) NOT NULL,
  `ContactNo` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Province` varchar(100) NOT NULL,
  `Street` varchar(100) NOT NULL,
  `ZipCode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livestockbuyers`
--

INSERT INTO `livestockbuyers` (`BuyerNo`, `BuyerFName`, `BuyerLName`, `ContactNo`, `City`, `Province`, `Street`, `ZipCode`) VALUES
(1, 'Dexter', 'Zapico', '123', 'Cebu', 'Cebu', 'Cebu', '6000'),
(2, 'Dexter', 'Zapico', '1234', 'Cebu', 'Cebu', 'Isagani', '6000');

-- --------------------------------------------------------

--
-- Table structure for table `livestocksuppliers`
--

CREATE TABLE `livestocksuppliers` (
  `SupplierNo` int(11) NOT NULL,
  `SupplierName` varchar(100) NOT NULL,
  `ContactNo` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Province` varchar(100) NOT NULL,
  `Street` varchar(100) NOT NULL,
  `ZipCode` varchar(100) NOT NULL,
  `AccountExpiry` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL DEFAULT '',
  `DeliveryFee` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livestocksuppliers`
--

INSERT INTO `livestocksuppliers` (`SupplierNo`, `SupplierName`, `ContactNo`, `City`, `Province`, `Street`, `ZipCode`, `AccountExpiry`, `Email`, `DeliveryFee`) VALUES
(1, 'Junre Inc', '123', 'Cebu', 'Cebu', 'Cebu', '6000', '2019-04-01', 'junre@gmail.com', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `obbatches`
--

CREATE TABLE `obbatches` (
  `BatchId` int(11) NOT NULL,
  `OwnerBreedId` int(11) NOT NULL,
  `Stock` int(11) NOT NULL,
  `AverageWeight` decimal(10,2) NOT NULL,
  `PricePerKilo` decimal(10,2) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `Description` varchar(512) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obbatches`
--

INSERT INTO `obbatches` (`BatchId`, `OwnerBreedId`, `Stock`, `AverageWeight`, `PricePerKilo`, `DOB`, `Description`) VALUES
(1, 1, 0, '12.00', '12.00', '2017-08-16', 'hehehe'),
(2, 1, 10, '13.00', '12.00', '2018-09-16', '-'),
(3, 1, 12, '12.50', '12.12', '2018-09-16', '-'),
(4, 1, 119, '12.52', '12.12', '2018-09-16', '-'),
(5, 1, 2, '2.20', '2.20', '2018-09-16', '-'),
(6, 3, 3, '33.33', '33.33', '2018-09-16', '-'),
(7, 2, 2, '12.00', '12.40', '2018-09-16', '-'),
(8, 3, 12, '12.00', '12.00', '2018-09-17', '-');

-- --------------------------------------------------------

--
-- Table structure for table `ownerbreeds`
--

CREATE TABLE `ownerbreeds` (
  `OwnerBreedId` int(11) NOT NULL,
  `SupplierNo` int(11) NOT NULL,
  `BreedId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ownerbreeds`
--

INSERT INTO `ownerbreeds` (`OwnerBreedId`, `SupplierNo`, `BreedId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reservationdetails`
--

CREATE TABLE `reservationdetails` (
  `ReservDetailNo` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `BatchId` int(11) NOT NULL,
  `OrderNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservationdetails`
--

INSERT INTO `reservationdetails` (`ReservDetailNo`, `Quantity`, `BatchId`, `OrderNo`) VALUES
(1, 1, 1, 0),
(2, 1, 1, 1),
(3, 1, 1, 2),
(4, 2, 1, 0),
(5, 1, 2, 0),
(6, 2, 1, 0),
(7, 1, 2, 0),
(8, 1, 1, 0),
(9, 0, 2, 0),
(10, 1, 1, 3),
(11, 0, 2, 3),
(12, 1, 1, 0),
(13, 0, 2, 0),
(14, 1, 1, 4),
(15, 0, 2, 4),
(16, 2, 1, 5),
(17, 0, 2, 5),
(18, 1, 1, 6),
(19, 1, 4, 7),
(20, 1, 4, 8),
(21, 1, 4, 9),
(22, 0, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ReservationNo` int(11) NOT NULL,
  `DateReserved` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int(11) NOT NULL DEFAULT '0',
  `BuyerNo` int(11) NOT NULL,
  `ToBeDelivered` int(100) NOT NULL DEFAULT '0',
  `ExpectedAmount` decimal(10,2) NOT NULL,
  `ActualAmount` decimal(10,2) DEFAULT NULL,
  `SupplierNo` int(11) NOT NULL,
  `ReservationDescription` varchar(300) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ReservationNo`, `DateReserved`, `Status`, `BuyerNo`, `ToBeDelivered`, `ExpectedAmount`, `ActualAmount`, `SupplierNo`, `ReservationDescription`) VALUES
(1, '2018-09-18 01:34:13', 1, 1, 0, '111.00', '45.00', 1, ''),
(2, '2018-09-18 01:36:31', 0, 1, 0, '111.00', NULL, 1, ''),
(3, '2018-09-18 20:37:28', 0, 1, 1, '244.00', NULL, 1, ''),
(4, '2018-09-18 20:38:53', 0, 1, 0, '144.00', NULL, 1, ''),
(5, '2018-09-18 20:58:21', 0, 1, 0, '288.00', NULL, 1, ''),
(6, '2018-09-18 21:22:26', 0, 1, 1, '244.00', NULL, 1, ''),
(7, '2018-09-18 21:26:42', 0, 1, 0, '151.74', NULL, 1, 'dis my orders'),
(8, '2018-09-18 21:27:15', 0, 1, 0, '151.74', NULL, 1, 'dis my orders'),
(9, '2018-09-18 21:27:55', 0, 1, 0, '151.74', NULL, 1, ''),
(10, '2018-09-18 21:29:29', 0, 1, 0, '0.00', NULL, 1, 'zz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`AccountId`);

--
-- Indexes for table `breeds`
--
ALTER TABLE `breeds`
  ADD PRIMARY KEY (`BreedId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`CertificateNo`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeNo`);

--
-- Indexes for table `livestockbuyers`
--
ALTER TABLE `livestockbuyers`
  ADD PRIMARY KEY (`BuyerNo`);

--
-- Indexes for table `livestocksuppliers`
--
ALTER TABLE `livestocksuppliers`
  ADD PRIMARY KEY (`SupplierNo`);

--
-- Indexes for table `obbatches`
--
ALTER TABLE `obbatches`
  ADD PRIMARY KEY (`BatchId`);

--
-- Indexes for table `ownerbreeds`
--
ALTER TABLE `ownerbreeds`
  ADD PRIMARY KEY (`OwnerBreedId`);

--
-- Indexes for table `reservationdetails`
--
ALTER TABLE `reservationdetails`
  ADD PRIMARY KEY (`ReservDetailNo`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ReservationNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `AccountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `breeds`
--
ALTER TABLE `breeds`
  MODIFY `BreedId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `CertificateNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `livestockbuyers`
--
ALTER TABLE `livestockbuyers`
  MODIFY `BuyerNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `livestocksuppliers`
--
ALTER TABLE `livestocksuppliers`
  MODIFY `SupplierNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `obbatches`
--
ALTER TABLE `obbatches`
  MODIFY `BatchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ownerbreeds`
--
ALTER TABLE `ownerbreeds`
  MODIFY `OwnerBreedId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservationdetails`
--
ALTER TABLE `reservationdetails`
  MODIFY `ReservDetailNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ReservationNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2026 at 11:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrentalsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclass`
--

CREATE TABLE `carclass` (
  `ClassID` smallint(6) NOT NULL,
  `ClassName` varchar(6) NOT NULL,
  `Description` varchar(25) NOT NULL,
  `MonthlyRate` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `PlateNo` varchar(12) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `Model` varchar(25) NOT NULL,
  `Year` smallint(6) NOT NULL,
  `Status` varchar(1) NOT NULL,
  `CarClassID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customerrates`
--

CREATE TABLE `customerrates` (
  `CustomerRateID` tinyint(4) NOT NULL,
  `RatingScore` tinyint(4) DEFAULT NULL,
  `Discount` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` smallint(6) NOT NULL,
  `CorporateName` varchar(25) NOT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Phone` varchar(12) DEFAULT NULL,
  `CustomerRate` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `InvoiceID` smallint(6) NOT NULL,
  `RentID` smallint(6) NOT NULL,
  `Amount` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentreceipts`
--

CREATE TABLE `paymentreceipts` (
  `PaymentID` smallint(6) NOT NULL,
  `InvoiceID` smallint(6) NOT NULL,
  `Amount` decimal(8,2) NOT NULL,
  `PaymentDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentalcars`
--

CREATE TABLE `rentalcars` (
  `RentID` smallint(6) NOT NULL,
  `PlateNo` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `RentID` smallint(6) NOT NULL,
  `CustomerID` smallint(6) NOT NULL,
  `StartDate` date NOT NULL,
  `FinishDate` date DEFAULT NULL,
  `Status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclass`
--
ALTER TABLE `carclass`
  ADD PRIMARY KEY (`ClassID`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`PlateNo`),
  ADD KEY `FK_Cars_CarClass` (`CarClassID`);

--
-- Indexes for table `customerrates`
--
ALTER TABLE `customerrates`
  ADD PRIMARY KEY (`CustomerRateID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD KEY `FK_Customers_CustomerRates` (`CustomerRate`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`InvoiceID`),
  ADD KEY `FK_Invoices_Rentals` (`RentID`);

--
-- Indexes for table `paymentreceipts`
--
ALTER TABLE `paymentreceipts`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `FK_PaymentReceipts_Invoices` (`InvoiceID`);

--
-- Indexes for table `rentalcars`
--
ALTER TABLE `rentalcars`
  ADD PRIMARY KEY (`RentID`,`PlateNo`),
  ADD KEY `FK_RentalCars_Cars` (`PlateNo`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`RentID`),
  ADD KEY `FK_Rentals_Customers` (`CustomerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclass`
--
ALTER TABLE `carclass`
  MODIFY `ClassID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerrates`
--
ALTER TABLE `customerrates`
  MODIFY `CustomerRateID` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `InvoiceID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentreceipts`
--
ALTER TABLE `paymentreceipts`
  MODIFY `PaymentID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rentalcars`
--
ALTER TABLE `rentalcars`
  MODIFY `RentID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `RentID` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `FK_Cars_CarClass` FOREIGN KEY (`CarClassID`) REFERENCES `carclass` (`ClassID`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `FK_Customers_CustomerRates` FOREIGN KEY (`CustomerRate`) REFERENCES `customerrates` (`CustomerRateID`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `FK_Invoices_Rentals` FOREIGN KEY (`RentID`) REFERENCES `rentals` (`RentID`);

--
-- Constraints for table `paymentreceipts`
--
ALTER TABLE `paymentreceipts`
  ADD CONSTRAINT `FK_PaymentReceipts_Invoices` FOREIGN KEY (`InvoiceID`) REFERENCES `invoices` (`InvoiceID`);

--
-- Constraints for table `rentalcars`
--
ALTER TABLE `rentalcars`
  ADD CONSTRAINT `FK_RentalCars_Cars` FOREIGN KEY (`PlateNo`) REFERENCES `cars` (`PlateNo`),
  ADD CONSTRAINT `FK_RentalCars_Rentals` FOREIGN KEY (`RentID`) REFERENCES `rentals` (`RentID`);

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `FK_Rentals_Customers` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2026 at 11:49 AM
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

--
-- Dumping data for table `carclass`
--

INSERT INTO `carclass` (`ClassID`, `ClassName`, `Description`, `MonthlyRate`) VALUES
(1, 'LUX', 'Luxury Car', 800.00),
(2, 'SUV', 'Sport Utility Vehicle', 500.00),
(3, 'reg', 'regular car', 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `PlateNo` varchar(12) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `Model` varchar(25) NOT NULL,
  `YearManufactured` smallint(6) DEFAULT NULL,
  `Status` varchar(1) NOT NULL,
  `carClass` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`PlateNo`, `Brand`, `Model`, `YearManufactured`, `Status`, `carClass`) VALUES
('12-d-1223', 'Ferrari', 'F20', 2010, 'A', 'SUV'),
('12-d-22', 'Ferrari', 'F20', 2010, 'N', 'LUX'),
('12-d-32', 'Ferrari', 'F20', 2010, 'A', 'LUX'),
('12-d-44', 'Ferrari', 'F20', 2010, 'A', 'LUX'),
('13-d-2323232', 'Ferrari', 'F20', 2010, 'A', 'REG'),
('13-d-44', 'Ferrari', 'F20', 2010, 'A', 'REG'),
('17-d-2323', 'renault', 'F20', 2010, 'A', 'REG');

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
  `Phone` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `CorporateName`, `Email`, `Phone`) VALUES
(1, 'google', 'skdsk@fm.com', '849384');

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
  ADD PRIMARY KEY (`ClassID`),
  ADD UNIQUE KEY `ClassName` (`ClassName`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`PlateNo`),
  ADD KEY `FK_Cars_CarClass` (`carClass`);

--
-- Indexes for table `customerrates`
--
ALTER TABLE `customerrates`
  ADD PRIMARY KEY (`CustomerRateID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`InvoiceID`),
  ADD KEY `FK_Invoices_Rentals` (`RentID`);

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
  MODIFY `ClassID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customerrates`
--
ALTER TABLE `customerrates`
  MODIFY `CustomerRateID` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `InvoiceID` smallint(6) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `FK_Cars_ClassName` FOREIGN KEY (`carClass`) REFERENCES `carclass` (`ClassName`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `FK_Invoices_Rentals` FOREIGN KEY (`RentID`) REFERENCES `rentals` (`RentID`);

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

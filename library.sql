-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2024 at 01:36 PM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Anuj Kumar', 'admin@gmail.com', 'admin', 'f925916e2754e5e03f75dd58a5733251', '2024-01-20 06:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Anuj kumar', '2024-01-25 07:23:03', '2024-02-04 06:34:19'),
(2, 'Chetan Bhagatt', '2024-01-25 07:23:03', '2024-02-04 06:34:26'),
(3, 'Anita Desai', '2024-01-25 07:23:03', '2024-02-04 06:34:26'),
(4, 'HC Verma', '2024-01-25 07:23:03', '2024-02-04 06:34:26'),
(5, 'R.D. Sharma ', '2024-01-25 07:23:03', '2024-02-04 06:34:26'),
(9, 'fwdfrwer', '2024-01-25 07:23:03', '2024-02-04 06:34:26'),
(10, 'Dr. Andy Williams', '2024-01-25 07:23:03', '2024-02-04 06:34:26'),
(11, 'Kyle Hill', '2024-01-25 07:23:03', '2024-02-04 06:34:26'),
(12, 'Robert T. Kiyosak', '2024-01-25 07:23:03', '2024-02-04 06:34:26'),
(13, 'Kelly Barnhill', '2024-01-25 07:23:03', '2024-02-04 06:34:26'),
(14, 'Herbert Schildt', '2024-01-25 07:23:03', '2024-02-04 06:34:26'),
(16, 'Jessi Hugo', '2024-04-16 21:33:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` varchar(25) DEFAULT NULL,
  `BookPrice` int(100) DEFAULT NULL,
  `bookImage` varchar(250) NOT NULL,
  `isIssued` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `bookImage`, `isIssued`, `RegDate`, `UpdationDate`) VALUES
(1, 'PHP And MySql programming', 5, 9, '222333', 20, '1efecc0ca822e40b7b673c0d79ae943f.jpg', 1, '2024-01-30 07:23:03', '2024-04-08 10:49:46'),
(3, 'physics', 6, 4, '1111', 15, 'dd8267b57e0e4feee5911cb1e1a03a79.jpg', 1, '2024-01-30 07:23:03', '2024-04-24 01:59:36'),
(5, 'Murach\'s MySQL', 5, 1, '9350237695', 455, '5939d64655b4d2ae443830d73abc35b6.jpg', 1, '2024-01-30 07:23:03', '2024-02-04 06:34:11'),
(6, 'WordPress for Beginners 2022: A Visual Step-by-Step Guide to Mastering WordPress', 5, 10, 'B019MO3WCM', 100, '144ab706ba1cb9f6c23fd6ae9c0502b3.jpg', 1, '2024-01-30 07:23:03', '2024-04-24 04:46:06'),
(7, 'WordPress Mastery Guide:', 5, 11, 'B09NKWH7NP', 53, '90083a56014186e88ffca10286172e64.jpg', 1, '2024-01-30 07:23:03', '2024-04-27 23:40:57'),
(8, 'Rich Dad Poor Dad: What the Rich Teach Their Kids About Money That the Poor and Middle Class Do Not', 8, 12, 'B07C7M8SX9', 120, '52411b2bd2a6b2e0df3eb10943a5b640.jpg', NULL, '2024-01-30 07:23:03', '2024-02-04 06:34:11'),
(9, 'The Girl Who Drank the Moon', 8, 13, '1848126476', 200, 'f05cd198ac9335245e1fdffa793207a7.jpg', NULL, '2024-01-30 07:23:03', '2024-02-04 06:34:11'),
(10, 'C++: The Complete Reference, 4th Edition', 5, 14, '007053246X', 142, '36af5de9012bf8c804e499dc3c3b33a5.jpg', 1, '2024-01-30 07:23:03', '2024-04-23 18:19:40'),
(11, 'ASP.NET Core 5 for Beginners', 9, 11, 'GBSJ36344563', 422, 'b1b6788016bbfab12cfd2722604badc9.jpg', 0, '2024-01-30 07:23:03', '2024-02-04 06:34:11'),
(14, 'Jessica', 4, 16, '110202', NULL, '410d743ebdffaf3f72746420a5270214.jpg', 0, '2024-04-16 21:42:26', '2024-04-24 05:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(4, 'Romantic', 1, '2024-01-31 07:23:03', '2024-02-04 06:33:43'),
(5, 'Technology', 1, '2024-01-31 07:23:03', '2024-02-04 06:33:51'),
(6, 'Science', 1, '2024-01-31 07:23:03', '2024-02-04 06:33:51'),
(7, 'Management', 1, '2024-01-31 07:23:03', '2024-02-04 06:33:51'),
(8, 'General', 1, '2024-01-31 07:23:03', '2024-02-04 06:33:51'),
(9, 'Programming', 1, '2024-01-31 07:23:03', '2024-02-04 06:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `RetrunStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`) VALUES
(14, 10, '2021-25647', '2024-04-08 10:48:55', '2024-04-16 03:06:44', 1, 500),
(16, 10, '2021', '2024-04-23 18:19:40', '2024-04-24 16:00:00', NULL, NULL),
(17, 3, '2021', '2024-04-24 01:59:36', '2024-04-24 16:00:00', NULL, NULL),
(18, 6, '2021', '2024-04-24 04:46:06', '2024-04-23 16:00:00', NULL, NULL),
(19, 7, '2021', '2024-04-24 05:01:58', '2024-04-24 05:26:49', 1, 200),
(20, 14, '2021', '2024-04-24 05:03:23', '2024-04-24 05:05:40', 1, 200),
(21, 7, '2021', '2024-04-24 07:22:53', '2024-04-24 08:06:08', 1, 100),
(22, 7, '2021', '2024-04-27 23:40:57', '2024-04-28 16:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsection`
--

CREATE TABLE `tblsection` (
  `id` int(11) NOT NULL,
  `section_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `StudentId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(17, '2021-25647', 'Jessica Hugo', 'jessicahugo78@gmail.com', '9465209147', '01fff2ef1ce8881908fac918feca78bf', 1, '2024-04-06 12:12:53', NULL),
(18, '2021-25160', 'Eva Mae Arpon', 'evamaearpon@gmail.com', '946520914', 'e305dc8fb13a30da449162f2c72678cc', 0, '2024-04-17 03:09:53', '2024-04-21 08:07:03'),
(19, '2021', 'matthew solar', 'matthewsolar@gmail.com', '09921', '1a8a1a2a5da9cecb9bd0d0fa3c31b95f', 1, '2024-04-23 15:09:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblauthors`
--
ALTER TABLE `tblauthors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsection`
--
ALTER TABLE `tblsection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `StudentId` (`StudentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblsection`
--
ALTER TABLE `tblsection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 12:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freshcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Huzaifa', 'huzaifa@gmail.com', 'huzaifa123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryDate` date NOT NULL,
  `categoryDesc` text NOT NULL,
  `categoryStatus` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `categoryDate`, `categoryDesc`, `categoryStatus`, `icon`) VALUES
(2, 'Bakery & Buiscuits', '2023-05-24', 'All bakery items are added in this category.', 1, 'bakery.svg'),
(3, 'Pet Food', '2023-05-09', 'Pet foods are in this Category.', 0, 'petfoods.svg'),
(8, 'Fruits', '2023-05-29', 'All fruits.', 1, 'fruit.svg'),
(9, 'Dairy', '2023-05-30', 'Dairy Items.', 0, 'dairy.svg'),
(10, 'Snacks', '2023-05-22', 'Snacks and Munchies. ', 1, 'snacks.svg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `proID` int(11) NOT NULL,
  `proName` varchar(255) NOT NULL,
  `proDesc` text NOT NULL,
  `catID` int(11) NOT NULL,
  `proStatus` int(11) NOT NULL,
  `proPrice` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `proImg` varchar(255) NOT NULL,
  `inStock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`proID`, `proName`, `proDesc`, `catID`, `proStatus`, `proPrice`, `createdAt`, `proImg`, `inStock`) VALUES
(1, '5 Star Chocolate', '5 Star Chocolate of Dairy Milk Company.', 2, 1, 5, '2023-05-30 08:47:01', 'product-img-3.jpg', 1),
(2, 'Butter', 'Amul Butter.', 9, 1, 10, '2023-05-30 08:49:22', 'product-img-10.jpg', 0),
(3, 'Corn Flakes', 'Corn Flakess.', 10, 1, 13, '2023-06-03 11:27:18', 'product-img-8.jpg', 1),
(4, 'Popcorn', 'Popcorns.', 10, 0, 5, '2023-05-30 09:05:09', 'product-img-5.jpg', 1),
(5, 'Pineapple', 'Fresh Pineapples.', 8, 1, 15, '2023-05-30 09:05:54', 'product-img-13.jpg', 1),
(6, 'Cheese', 'Cheese.', 9, 1, 22, '2023-06-03 11:27:44', 'product-img-7.jpg', 0),
(8, 'Apples', 'Apples.', 8, 1, 20, '2023-06-03 16:11:40', 'product-img-15.jpg', 1),
(9, 'Yougart', 'Greek Yougart.', 9, 1, 30, '2023-06-03 16:31:50', 'product-img-6.jpg', 1),
(10, 'Cat Food', 'pet Foods.', 3, 0, 30, '2023-06-04 16:04:39', 'product-img-11.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userID` int(11) NOT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_lname` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userID`, `user_fname`, `user_lname`, `userEmail`, `userPassword`, `picture`) VALUES
(5, 'Abdul', 'Raffay', 'raffay@gmail.com', '$2y$10$j8Uwnbl7iYFgZ5Y/uwujy.K6XuJ.DStHEPdv.MnbS61q/chHgP9oa', 'alex-suprun-ZHvM3XIOHoE-unsplash.jpg'),
(6, 'Muhammad', 'Uzair', 'uzair@gmail.com', '$2y$10$Fr6PTkoV30RdPCvIg3nl8Ow86ubGeELhJIpbgn9H4dOz2OHRl.G7G', 'christian-buehner-DItYlc26zVI-unsplash.jpg'),
(7, 'Uzair', 'Hashmi', 'hashmi@gmail.com', '$2y$10$GfBjk64UCgHJmQvLOf6u5uZ1A48IYX.lu/jU4swMc73mFt/gav52q', 'foto-sushi-6anudmpILw4-unsplash.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`proID`),
  ADD KEY `products_ibfk_1` (`catID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `proID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`catID`) REFERENCES `categories` (`categoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

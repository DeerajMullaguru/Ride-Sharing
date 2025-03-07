-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2023 at 08:51 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_ride`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ride_id` int(11) NOT NULL,
  `total_tickets` int(11) NOT NULL,
  `payment_type` enum('upi','cash') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_review` tinyint(4) NOT NULL,
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `ride_id`, `total_tickets`, `payment_type`, `status`, `is_review`, `booked_at`) VALUES
(1, 2, 1, 1, 'cash', 1, 0, '2023-04-10 08:05:58'),
(2, 3, 1, 2, 'upi', 1, 0, '2023-04-10 08:07:10'),
(3, 5, 1, 1, 'cash', 0, 0, '2023-04-10 08:08:22'),
(4, 6, 1, 1, 'cash', 1, 1, '2023-04-10 08:15:47'),
(6, 7, 2, 1, 'upi', 1, 0, '2023-04-10 11:06:32'),
(7, 9, 5, 1, 'cash', 1, 0, '2023-04-10 19:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact` char(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `message_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `booking_id`, `rating`, `review`, `at`) VALUES
(1, 4, 4, 'Good Experienec....', '2023-04-11 06:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE `rides` (
  `id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `pickup_location` varchar(50) NOT NULL,
  `drop_location` varchar(50) NOT NULL,
  `total_passenger` int(11) NOT NULL,
  `pickup_time` time NOT NULL,
  `drop_time` time NOT NULL,
  `schedule_date` datetime NOT NULL,
  `cost` decimal(10,0) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `available_seats` int(11) NOT NULL,
  `published_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`id`, `added_by`, `pickup_location`, `drop_location`, `total_passenger`, `pickup_time`, `drop_time`, `schedule_date`, `cost`, `status`, `available_seats`, `published_at`) VALUES
(1, 4, 'Coober Pedy', 'Adelaide', 4, '17:30:00', '21:00:00', '2023-04-10 00:00:00', '139', 2, 0, '2023-04-10 07:56:37'),
(2, 4, 'Melbourne', 'Adelaide', 4, '10:00:00', '12:30:00', '2023-04-15 00:00:00', '159', 1, 3, '2023-04-10 07:58:20'),
(4, 8, 'Perth', 'Broome', 4, '15:30:00', '19:00:00', '2023-04-13 00:00:00', '169', 1, 4, '2023-04-10 18:17:56'),
(5, 7, 'Brisbane', 'Sydney', 4, '15:15:00', '18:40:00', '2023-04-16 00:00:00', '130', 1, 3, '2023-04-10 18:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact` char(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `car` varchar(50) DEFAULT NULL,
  `car_no` varchar(10) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `contact`, `email`, `password`, `address`, `role`, `status`, `car`, `car_no`, `registered_at`) VALUES
(1, 'Admin', '070 0046 3624', 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', '82 Berkeley Rd STRATHTAY PH9 3ZU', 'admin', 1, NULL, NULL, '2023-04-09 09:10:32'),
(2, 'Scott Doyle', '077 3213 4463', 'ScottDoyle@rhyta.com', '25d55ad283aa400af464c76d713c07ad', '39 Shore Street STOCKTO HR6 9QE', 'user', 1, 'Swift', 'XYZ 58 DW', '2023-04-09 09:12:43'),
(3, 'Jacob Pottinger', '(07) 4556 2631', 'JacobPottinger@jourrapide.com', '25d55ad283aa400af464c76d713c07ad', '51 Cunningham Street\r\nDRILLHAM SOUTH QLD 4424', 'user', 1, 'Nissan Navara', 'FCQ 8900', '2023-04-09 18:13:46'),
(4, 'Finn Lowe', '(02) 4021 2008', 'FinnLowe@rhyta.com', '25d55ad283aa400af464c76d713c07ad', '26 Amiens Road\r\nGULGAMREE NSW 2850', 'user', 1, 'Toyota Kluger', 'TFS 676', '2023-04-09 18:16:58'),
(5, 'Gabriel Rowlandson', '(08) 8368 8195', 'GabrielRowlandson@dayrep.com', '25d55ad283aa400af464c76d713c07ad', '81 Souttar Terrace\r\nWOODLANDS WA 6018', 'user', 1, NULL, NULL, '2023-04-09 18:18:12'),
(6, 'Seth Dedman', '(03) 5302 7004', 'SethDedman@dayrep.com', '25d55ad283aa400af464c76d713c07ad', '54 Little Myers Street\r\nMOUNT DORAN VIC 3334', 'user', 1, NULL, NULL, '2023-04-10 08:11:58'),
(7, 'Xavier Sinnett', '(02) 4003 2824', 'XavierSinnett@jourrapide.com', '25d55ad283aa400af464c76d713c07ad', '82 Weemala Avenue\r\nNANAMI NSW 2806', 'user', 1, 'Ford Ranger', 'UXP 936', '2023-04-10 10:49:48'),
(8, 'Aidan Robinson', '(08) 9076 8362', 'AidanRobinson@teleworm.us', '25d55ad283aa400af464c76d713c07ad', '64 Baker Street\r\nWILLYUNG WA 6330', 'user', 1, 'Holden Colorado', 'BSW 987', '2023-04-10 10:51:28'),
(9, 'Daniel Stretch', '(03) 5392 0941', 'DanielStretch@armyspy.com', '25d55ad283aa400af464c76d713c07ad', '51 Shell Road\r\nAIRE VALLEY VIC 3237', 'user', 1, NULL, NULL, '2023-04-10 19:04:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 09:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES
(2, 'vinayak', '1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(10) NOT NULL,
  `family_count` int(3) NOT NULL,
  `contact` char(10) DEFAULT NULL,
  `city` varchar(20) NOT NULL,
  `password` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `name`, `color`, `family_count`, `contact`, `city`, `password`) VALUES
(1, 'saish', 'white', 4, '98989898', 'kopargoan', '1'),
(2, 'sanket', 'orange', 3, '78787878', 'gadchiroli', NULL),
(4, 'aditya', 'yellow', 5, '15151515', 'karjat', NULL),
(5, 'kishor', 'white', 5, '23232323', 'shirdi', NULL),
(9, 'manoj', 'orange', 5, '89878787', 'ahmednagar', NULL),
(10, 'pratik', 'white', 5, '898989', 'pune', NULL),
(12, 'xyz', 'orange', 5, '65656524', 'hvgv', NULL),
(22, 'Utsab', 'yellow', 5, '5789234758', 'Bangalore', 'Hello'),
(23, 'ketan', 'white', 4, '9898989898', 'nagar', NULL),
(54, 'sumit', 'white', 10, '1234567890', 'karjat', NULL),
(75, 'Yogesh', 'orange', 4, '8197310214', 'Bangalore', NULL),
(100, 'Suprit', 'orange', 5, '8197211818', 'Kathmandu', '2'),
(101, 'Ashish', 'white', 5, '9999999999', 'dffd', NULL),
(178, 'Neups', 'orange', 5, '1000000000', 'DhorPatan', '1'),
(566, 'Vinayak', 'orange', 5, '1111111111', 'Bangalore', '1'),
(781, 'Madi', 'orange', 4, '8197310215', 'Bangalore', 'kl'),
(788, 'yogesh', 'yellow', 54, '5444555444', 'ygoesh', 'yogesh'),
(1022, 'Rishi', 'yellow', 4, '5647586756', 'Karnataka', 'karna'),
(7182, 'madi', 'yellow', 3, '4232432433', 'Kathmandu', '12345'),
(7665, 'yogesh2', 'yellow', 2, '1234567899', 'patan', 'patan'),
(22534, 'Pratyush', 'yellow', 4, '5789234758', 'Bangalore', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `bill_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `bill_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`bill_id`, `customer_id`, `order_id`, `total_amount`, `bill_date`) VALUES
(1, 1, 2, 1500.00, '2024-02-27'),
(2, 1, 3, 1670.00, '2024-02-27'),
(3, 1, 4, 1500.00, '2024-02-27'),
(4, 1, 5, 1500.00, '2024-02-27'),
(5, 1, 6, 2250.00, '2024-02-27'),
(6, 1, 12, 780.00, '2024-02-27'),
(7, 7182, 13, 0.00, '2024-02-27'),
(8, 7182, 30, 0.00, '2024-02-27'),
(9, 178, 31, 75.00, '2024-02-27'),
(10, 178, 32, 70.00, '2024-02-28'),
(11, 178, 35, 20.00, '2024-02-28'),
(12, 781, 38, 120.00, '2024-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `order_released`
--

CREATE TABLE `order_released` (
  `order_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_released`
--

INSERT INTO `order_released` (`order_id`, `stock_id`) VALUES
(31, 1),
(32, 1),
(34, 1),
(35, 1),
(37, 1),
(13, 2),
(27, 2),
(30, 9),
(16, 10),
(17, 10),
(18, 10),
(19, 10),
(20, 10),
(21, 10),
(22, 10),
(23, 10),
(25, 10),
(26, 10),
(28, 10);

--
-- Triggers `order_released`
--
DELIMITER $$
CREATE TRIGGER `update_remain_stock` AFTER INSERT ON `order_released` FOR EACH ROW BEGIN
    UPDATE remain_stock
    SET rice = rice - (SELECT rice_kg FROM orders WHERE order_id = NEW.order_id),
        wheat = wheat - (SELECT wheat_kg FROM orders WHERE order_id = NEW.order_id),
        sugar = sugar - (SELECT sugar_kg FROM orders WHERE order_id = NEW.order_id)
    WHERE id = NEW.stock_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `order_view`
-- (See below for the actual view)
--
CREATE TABLE `order_view` (
`order_id` int(11)
,`rice_kg` decimal(5,2)
,`wheat_kg` decimal(5,2)
,`sugar_kg` decimal(5,2)
,`order_state` varchar(10)
,`order_date` timestamp
,`customer_name` varchar(50)
,`customer_city` varchar(20)
,`customer_contact` char(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `color` varchar(10) NOT NULL,
  `rice` int(3) NOT NULL,
  `wheat` int(3) NOT NULL,
  `sugar` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`color`, `rice`, `wheat`, `sugar`) VALUES
('orange', 5, 5, 5),
('white', 10, 10, 10),
('yellow', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchased`
--

CREATE TABLE `purchased` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rice_kg` decimal(5,2) NOT NULL,
  `wheat_kg` decimal(5,2) NOT NULL,
  `sugar_kg` decimal(5,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_state` varchar(10) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchased`
--

INSERT INTO `purchased` (`order_id`, `customer_id`, `rice_kg`, `wheat_kg`, `sugar_kg`, `order_date`, `order_state`) VALUES
(1, 22534, 5.00, 5.00, 5.00, '2024-02-26 10:24:37', 'Confirmed'),
(2, 1, 50.00, 50.00, 50.00, '2024-02-26 10:40:59', 'Confirmed'),
(3, 1, 62.00, 55.00, 50.00, '2024-02-26 10:41:24', 'Confirmed'),
(4, 1, 50.00, 50.00, 50.00, '2024-02-26 10:41:28', 'Confirmed'),
(5, 1, 50.00, 50.00, 50.00, '2024-02-26 10:41:44', 'Confirmed'),
(6, 1, 70.00, 75.00, 80.00, '2024-02-26 10:41:50', 'Confirmed'),
(7, 1, 33.00, 33.00, 33.00, '2024-02-26 10:43:29', 'Confirmed'),
(8, 1, 40.00, 40.00, 55.00, '2024-02-26 17:03:43', 'Confirmed'),
(9, 1, 3.00, 3.00, 3.00, '2024-02-26 17:11:58', 'Confirmed'),
(10, 1, 4.00, 4.00, 4.00, '2024-02-26 17:12:00', 'Cancelled'),
(11, 1, 15.00, 15.00, 15.00, '2024-02-26 17:12:03', 'Cancelled'),
(12, 1, 28.00, 25.00, 25.00, '2024-02-26 17:12:05', 'Confirmed'),
(13, 7182, 15.00, 15.00, 15.00, '2024-02-27 10:43:09', 'Confirmed'),
(14, 7182, 12.00, 12.00, 12.00, '2024-02-27 10:43:21', 'Cancelled'),
(15, 7182, 17.00, 15.00, 66.00, '2024-02-27 10:43:25', 'Confirmed'),
(16, 7182, 78.00, 76.00, 56.00, '2024-02-27 10:43:29', 'Confirmed'),
(17, 7182, 88.00, 98.00, 56.00, '2024-02-27 10:43:32', 'Confirmed'),
(18, 7182, 12.00, 66.00, 56.00, '2024-02-27 10:43:35', 'Confirmed'),
(19, 7182, 21.00, 21.00, 21.00, '2024-02-27 11:16:28', 'Confirmed'),
(20, 7182, 23.00, 23.00, 21.00, '2024-02-27 11:16:33', 'Confirmed'),
(21, 7182, 54.00, 32.00, 12.00, '2024-02-27 11:16:39', 'Confirmed'),
(22, 7182, 12.00, 12.00, 12.00, '2024-02-27 11:21:43', 'Confirmed'),
(23, 7182, 43.00, 34.00, 54.00, '2024-02-27 11:21:49', 'Confirmed'),
(24, 7182, 65.00, 34.00, 65.00, '2024-02-27 11:21:54', 'Cancelled'),
(25, 7182, 65.00, 34.00, 32.00, '2024-02-27 11:22:00', 'Confirmed'),
(26, 7182, 67.00, 11.00, 11.00, '2024-02-27 11:22:05', 'Confirmed'),
(27, 7182, 15.00, 14.00, 14.00, '2024-02-27 11:30:26', 'Confirmed'),
(28, 7182, 12.00, 12.00, 12.00, '2024-02-27 11:30:29', 'Confirmed'),
(29, 7182, 151.00, 15.00, 15.00, '2024-02-27 11:30:32', 'Cancelled'),
(30, 7182, 12.00, 12.00, 12.00, '2024-02-27 11:32:33', 'Confirmed'),
(31, 178, 5.00, 5.00, 5.00, '2024-02-27 15:57:32', 'Confirmed'),
(32, 178, 4.00, 5.00, 5.00, '2024-02-28 02:09:41', 'Confirmed'),
(33, 178, 50.00, 55.00, 30.00, '2024-02-28 02:09:51', 'Cancelled'),
(34, 178, 1.00, 1.00, 4.00, '2024-02-28 02:09:57', 'Confirmed'),
(35, 178, 2.00, 1.00, 1.00, '2024-02-28 02:51:44', 'Confirmed'),
(36, 178, 5.00, 5.00, 5.00, '2024-02-28 02:55:59', 'Cancelled'),
(37, 178, 10.00, 10.00, 15.00, '2024-02-28 02:56:04', 'Confirmed'),
(38, 781, 5.00, 5.00, 14.00, '2024-03-05 12:46:19', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `stock_left`
--

CREATE TABLE `stock_left` (
  `id` int(3) NOT NULL,
  `rice` int(3) NOT NULL,
  `wheat` int(3) NOT NULL,
  `sugar` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_left`
--

INSERT INTO `stock_left` (`id`, `rice`, `wheat`, `sugar`) VALUES
(1, 39, 39, 32),
(2, 91, 92, 92),
(5, 10, 10, 10),
(9, 100, 100, 100),
(10, 638, 694, 770),
(12, 6, 6, 6),
(13, 4, 4, 4),
(23, 15, 15, 15),
(54, 300, 5, 34522),
(79, 50, 50, 50),
(99, 66, 66, 66),
(500, 10, 10, 10);

-- --------------------------------------------------------

--
-- Structure for view `order_view`
--
DROP TABLE IF EXISTS `order_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_view`  AS SELECT `purchased`.`order_id` AS `order_id`, `purchased`.`rice_kg` AS `rice_kg`, `purchased`.`wheat_kg` AS `wheat_kg`, `purchased`.`sugar_kg` AS `sugar_kg`, `purchased`.`order_state` AS `order_state`, `purchased`.`order_date` AS `order_date`, `customer_details`.`name` AS `customer_name`, `customer_details`.`city` AS `customer_city`, `customer_details`.`contact` AS `customer_contact` FROM (`purchased` join `customer_details` on(`purchased`.`customer_id` = `customer_details`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `color` (`color`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_released`
--
ALTER TABLE `order_released`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `stock_id` (`stock_id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`color`);

--
-- Indexes for table `purchased`
--
ALTER TABLE `purchased`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `stock_left`
--
ALTER TABLE `stock_left`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25437;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchased`
--
ALTER TABLE `purchased`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `stock_left`
--
ALTER TABLE `stock_left`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD CONSTRAINT `customer_details_ibfk_1` FOREIGN KEY (`color`) REFERENCES `price` (`color`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_details` (`id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `purchased` (`order_id`);

--
-- Constraints for table `order_released`
--
ALTER TABLE `order_released`
  ADD CONSTRAINT `fk_dispatched_order` FOREIGN KEY (`order_id`) REFERENCES `purchased` (`order_id`),
  ADD CONSTRAINT `fk_dispatched_stock` FOREIGN KEY (`stock_id`) REFERENCES `stock_left` (`id`);

--
-- Constraints for table `purchased`
--
ALTER TABLE `purchased`
  ADD CONSTRAINT `purchased_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_details` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

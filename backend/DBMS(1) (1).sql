-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2022 at 06:22 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES
(1, 'harsh', 'pande');



CREATE TABLE `customer_info` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(10) NOT NULL,
  `family_count` int(3) NOT NULL,
  `contact` char(10) DEFAULT NULL,
  `city` varchar(20) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `customer_info` (`id`, `name`, `color`, `family_count`, `contact`, `city`) VALUES
(1, 'saish', 'white', 4, '98989898', 'kopargoan'),
(2, 'sanket', 'orange', 3, '78787878', 'gadchiroli'),
(3, 'yashodeep', 'yellow', 4, '12121212', 'shrirampur'),
(4, 'aditya', 'yellow', 5, '15151515', 'karjat'),
(5, 'kishor', 'white', 5, '23232323', 'shirdi'),
(9, 'manoj', 'orange', 5, '89878787', 'ahmednagar'),
(10, 'pratik', 'white', 5, '898989', 'pune'),
(12, 'xyz', 'orange', 5, '65656524', 'hvgv'),
(23, 'ketan', 'white', 4, '9898989898', 'nagar'),
(54, 'sumit', 'white', 10, '1234567890', 'karjat'),
(101, 'Ashish', 'white', 5, '9999999999', 'dffd');



CREATE TABLE `history` (
  `id` int(3) NOT NULL,
  `date` date NOT NULL,
  `rice` int(3) NOT NULL,
  `wheat` int(3) NOT NULL,
  `sugar` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `history` (`id`, `date`, `rice`, `wheat`, `sugar`) VALUES
(3, '2022-12-05', 3, 3, 3),
(3, '2022-12-05', 2, 2, 2),
(5, '2022-11-15', 1, 1, 1),
(5, '2022-11-15', 1, 1, 1),
(2, '2022-11-15', 2, 2, 2),
(1, '2022-11-15', 1, 1, 1),
(1, '2022-11-15', 2, 2, 1),
(4, '2022-12-05', 4, 4, 4),
(3, '2022-12-05', 12, 12, 12),
(54, '2022-12-05', 1, 1, 1),
(54, '2022-12-05', 40, 15, 10);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `color` varchar(10) NOT NULL,
  `rice` int(3) NOT NULL,
  `wheat` int(3) NOT NULL,
  `sugar` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`color`, `rice`, `wheat`, `sugar`) VALUES
('yellow', 0, 0, 0),
('orange', 5, 5, 5),
('white', 10, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `stock_left`
--

CREATE TABLE `stock_left` (
  `id` int(3) NOT NULL,
  `rice` int(3) NOT NULL,
  `wheat` int(3) NOT NULL,
  `sugar` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_left`
--

INSERT INTO `stock_left` (`id`, `rice`, `wheat`, `sugar`) VALUES
(1, 4, 4, 5),
(2, 6, 6, 6),
(3, -7, -7, -7),
(5, 21, 21, 21),
(9, 12, 12, 12),
(10, 1113, 1113, 1113),
(12, 6, 6, 6),
(13, 4, 4, 4),
(23, 15, 15, 15),
(54, 300, 5, 34522),
(99, 66, 66, 66);


-- CREATE TABLE `invoice` (
--   `bill_id` int(11) NOT NULL,
--   `customer_id` int(11) NOT NULL,
--   `order_id` int(11) NOT NULL,
--   `total_amount` decimal(10,2) NOT NULL,
--   `bill_date` date NOT NULL,
--   FOREIGN KEY (customer_id) references customer_info(customer_id),
--   FOREIGN KEY (order_id) references purchased (order_id)
-- );
--

-- CREATE TABLE `order_released` (
--   `order_id` int(11) NOT NULL,
--   `stock_id` int(11) NOT NULL,
--   PRIMARY KEY (`order_id`),
--   KEY `stock_id` (`stock_id`),
--   CONSTRAINT `fk_dispatched_order` FOREIGN KEY (`order_id`) REFERENCES `purchased` (`order_id`),
--   CONSTRAINT `fk_dispatched_stock` FOREIGN KEY (`stock_id`) REFERENCES `stock_left` (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25436;

--
-- AUTO_INCREMENT for table `stock_left`
--
ALTER TABLE `stock_left`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;


--   CREATE VIEW order_view AS
-- SELECT
--   purchased.order_id,
--   purchased.rice_kg,
--   purchased.wheat_kg,
--   purchased.sugar_kg,
--   purchased.order_state,
--   purchased.order_date,
--   customer_info.name AS customer_name,
--   customer_info.city AS customer_city,
--   customer_info.contact AS customer_contact
-- FROM purchased
-- JOIN customer_info ON purchased.customer_id = customer_info.id;


-- DELIMITER //

-- CREATE TRIGGER after_dispatched_insert
-- AFTER INSERT ON order_released
-- FOR EACH ROW
-- BEGIN
--     UPDATE stock_left
--     SET rice = rice - (SELECT rice_kg FROM purchased WHERE order_id = NEW.order_id),
--         wheat = wheat - (SELECT wheat_kg FROM purchased WHERE order_id = NEW.order_id),
--         sugar = sugar - (SELECT sugar_kg FROM purchased WHERE order_id = NEW.order_id)
--     WHERE id = NEW.stock_id;
-- END;
-- //

-- DELIMITER ;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


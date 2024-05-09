-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 02:29 PM
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
-- Database: `rmo`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `id`, `product_id`) VALUES
(3, 23, 45),
(23, 28, 47),
(25, 28, 45),
(37, 29, 49),
(38, 29, 45);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_description` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `meal_type` varchar(100) NOT NULL,
  `product_image` varchar(300) NOT NULL,
  `release_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `price`, `meal_type`, `product_image`, `release_date`) VALUES
(45, 'Chai labann', 'Later on', 5.5, 'drinks', 'uploads/chai_laban.jpg', '2024-04-27 00:00:00'),
(46, 'Coffee', 'I will write a recipe for my special coffee later bardo', 7, 'drinks', 'uploads/coffee.jpeg', '2024-04-27 00:00:00'),
(47, 'Honey', '=Rayan', 100.99, 'desserts', 'uploads/IMG_20230111_152257.jpg', '2024-04-27 00:00:00'),
(48, 'Tea', 'later ', 5, 'drinks', 'uploads/tea.jpeg', '2024-04-27 17:09:15'),
(49, 'Basbosa', 'Later (price per kilogram)', 15.5, 'desserts', 'uploads/basbosa.jpeg', '2024-04-27 17:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(23, 'osman', 'osman@gmail.com', 'e456a1b084d6503f370a1ba125aca107', 'user'),
(24, 'Rayan Osman', 'rayyan@gmail.com', '99124e7b6df335122ef80fce55ac35dd', 'admin'),
(26, 'enaam ', 'enaam@gmail.com', 'bb48de9bf8b634378a7163d8ffdc37dd', 'user'),
(27, 'migdad Osman', 'migdad@gmail.com', 'b68bca2b7357d1ce6ac6e711f5c426dd', 'user'),
(28, 'jihad Osman', 'jihad@gmail.com', 'f9de355bf863eb260029c916bbf66148', 'user'),
(29, 'rawan Osman', 'rawan@gmail.com', '3badb5049fd11f3152ba40ab0f6402f6', 'user'),
(30, 'eman osman', 'eman@gmail.com', '532eca5d2b91dd0641b445cb502836e0', 'user'),
(31, 'sara', 'sara@gmail.com', '8bb9625b94d15055350b9f2f69213739', 'user'),
(32, 'ahmed', 'eman@gmail.com', '742b2d78f6b5eee3da0dd9558eb32132', 'user'),
(33, 'almostafa', 'almostafa@gmail.com', 'c14d10b771c502f3de40773fbfb7b131', 'user'),
(35, 'khalid', 'khalid@gmail.com', 'd813b4c9d643b7821f215281bed0bea0', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `id` (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

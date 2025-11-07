-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2025 at 03:25 PM
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
-- Database: `maidenhome_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Storage & Organization'),
(2, 'Beds & Mattresses'),
(3, 'Table & Chairs'),
(4, 'Sofas & Armchair'),
(5, 'Home Decorations'),
(6, 'Light Fixtures'),
(7, 'Office Furniture'),
(8, 'Outdoor Furniture');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(40) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stocks` int(11) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_overview` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_id`, `sub_name`, `category_id`) VALUES
(1, 'Bookcases & Shelving Units', 1),
(2, 'Chests of drawers & drawer units', 1),
(3, 'Cabinets & Cupboards', 1),
(4, 'TV & media furniture', 1),
(5, 'Wardrobes & Closet Systems', 1),
(6, 'Beds', 2),
(7, 'Beddings and Pillows', 2),
(8, 'Mattresses', 2),
(9, 'Under bed storage', 2),
(10, 'Headboards', 2),
(11, 'Dining Tables', 3),
(12, 'Dining Chairs & Benches', 3),
(13, 'Coffee & End Tables', 3),
(14, 'Bar & Counter Stools', 3),
(15, 'Specialty Seating', 3),
(16, 'Sofas & Couches', 4),
(17, 'Armchairs', 4),
(18, 'Sofabeds', 4),
(19, 'Ottomans, footstools & pouffes', 4),
(20, 'Cushions', 4),
(21, 'Wall Décor & Mirrors', 5),
(22, 'Vases, Planters & Greenery', 5),
(23, 'Decorative Accents', 5),
(24, 'Rugs & Floor Coverings', 5),
(25, 'Seasonal', 5),
(26, 'Ceiling Lights & Pendants', 6),
(27, 'Floor Lamps', 6),
(28, 'Table & Desk Lamps', 6),
(29, 'Wall & Vanity Lights', 6),
(30, 'Outdoor Lighting', 6),
(31, 'Desks & Work Surfaces', 7),
(32, 'Office & Task Chairs', 7),
(33, 'Home Office Sets', 7),
(34, 'Gaming Furniture', 7),
(35, 'Filing & Office Storage', 7),
(36, 'Outdoor Lounge & Seating', 8),
(37, 'Outdoor Dining & Bar Sets', 8),
(38, 'Umbrellas, Pergolas & Shade', 8),
(39, 'Outdoor Storage', 8),
(40, 'Outdoor Décor & Accents', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `user_pass`, `user_email`, `role`) VALUES
(1, 'clarence', '$2y$10$/dWiLGL4tf01A2423JxWwuxKhlSbPw.g9Io/NxS26U8/BYVJ8wsxu', 'jhonrickparica@gmail.com', 'admin'),
(2, 'Pat', '$2y$10$00T1t37wtqkYTBJOQ7bPQuznPrJ97gCTXmJcd9TRmARPMUyZVDvzm', 'dumpacclngtouy@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `furniture_id` (`category_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `furniture_id` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_category` (`sub_id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

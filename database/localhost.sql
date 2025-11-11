-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 12:49 PM
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
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(100) UNSIGNED NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_midname` varchar(50) DEFAULT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `street_name` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `building_no` varchar(50) DEFAULT NULL,
  `house_no` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addtocart`
--

CREATE TABLE `addtocart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(100) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `sizes` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addtocart`
--

INSERT INTO `addtocart` (`cart_id`, `user_id`, `product_id`, `quantity`, `color`, `material`, `sizes`, `created_at`) VALUES
(5, 1, 4, 13, '', '', '', '2025-11-09 07:50:16'),
(20, 1, 1, 3, 'Navy', 'Solid & Manufactured Wood Frame', '40x40x180', '2025-11-11 09:56:26'),
(21, 1, 1, 3, 'Sage', 'Oak Top', '40x40x180', '2025-11-11 10:19:59'),
(22, 1, 1, 3, 'Charcoal', 'Oak Top', '180x80x22.5', '2025-11-11 10:25:02'),
(23, 1, 2, 3, '', '', '', '2025-11-11 10:28:31'),
(24, 1, 1, 3, 'Charcoal', 'Oak Top', '80x33x195', '2025-11-11 10:32:59');

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
(2, 'Beds & Mattresses'),
(5, 'Home Decorations'),
(6, 'Light Fixtures'),
(7, 'Office Furniture'),
(8, 'Outdoor Furniture'),
(4, 'Sofas & Armchair'),
(1, 'Storage & Organization'),
(3, 'Table & Chairs');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(100) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `total_order` int(11) NOT NULL,
  `payment` enum('Ewallet','Cod','Bank') NOT NULL,
  `payment_status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `order_status` enum('order placed','shipped','delivered') NOT NULL,
  `oder_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `product_img2` varchar(255) NOT NULL,
  `product_img3` varchar(255) NOT NULL,
  `product_img4` varchar(255) NOT NULL,
  `product_img5` varchar(255) NOT NULL,
  `product_img_hover` varchar(255) NOT NULL,
  `category_id` int(10) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `size1` varchar(255) NOT NULL,
  `size2` varchar(255) NOT NULL,
  `size3` varchar(255) NOT NULL,
  `mat1` varchar(255) NOT NULL,
  `mat2` varchar(255) NOT NULL,
  `mat3` varchar(255) NOT NULL,
  `color1` varchar(255) NOT NULL,
  `color2` varchar(255) NOT NULL,
  `color3` varchar(255) NOT NULL,
  `color1_img` varchar(255) NOT NULL,
  `color2_img` varchar(255) NOT NULL,
  `color3_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `stocks`, `product_img`, `product_img2`, `product_img3`, `product_img4`, `product_img5`, `product_img_hover`, `category_id`, `category_name`, `sub_id`, `sub_name`, `product_description`, `size1`, `size2`, `size3`, `mat1`, `mat2`, `mat3`, `color1`, `color2`, `color3`, `color1_img`, `color2_img`, `color3_img`, `created_at`) VALUES
(1, 'Farrow Large Bookcase', 16290.00, 200, 'Farrow_Large_Bookcase.png', 'Farrow_Large_Bookcase_Angle1.png', 'Farrow_Large_Bookcase_Angle2.png', 'Farrow_Large_Bookcase_Angle3.png', 'Farrow_Large_Bookcase_Angle4.png', 'Farrow_Large_Bookcase_Hover.png', 1, 'Storage & Organization', 1, 'Bookcases & Shelving Units', 'The Farrow Large Bookcase provides exceptional display opportunities with its six generous fixed shelves. This substantial piece offers ample space for books, photographs, ornaments, plants, and decorative items while maintaining the organised, sophisticated appearance that makes living spaces feel curated and welcoming.\r\n\r\nThe distinctive panelled back design adds visual texture and depth, creating an attractive backdrop for your displays while maintaining the clean, country-inspired aesthetic that defines the Farrow collection.', '180x80x22.5', '40x40x180', '80x33x195', 'Solid & Manufactured Wood Frame', 'Oak Top', 'Oak Veneer', 'Navy', 'Charcoal', 'Sage', 'Farrow_Large_Bookcase_Navy.png', 'Farrow_Large_Bookcase_Charcoal.png', 'Farrow_Large_Bookcase_Sage.png', '2025-11-10 14:16:57'),
(2, 'Colette 4 Over 6 Chest Of Drawers', 41114.00, 200, 'Colette_4_Over_6_Chest_Of_Drawers.png', 'Colette_4_Over_6_Chest_Of_Drawers_Angle1.png', 'Colette_4_Over_6_Chest_Of_Drawers_Angle2.png', 'Colette_4_Over_6_Chest_Of_Drawers_Angle3.png', 'Colette_4_Over_6_Chest_Of_Drawers_Angle4.png', 'Colette_4_Over_6_Chest_Of_Drawers_Hover.png', 1, 'Storage & Organization', 2, 'Chests of drawers & drawer units', 'The Colette 4 over 6 Chest of Drawers combines classic design with exceptional storage capacity, making it a centerpiece for any bedroom. Its clean lines are enhanced by an elegant crown top and a sturdy plinth base with a subtle curved cutout, creating a timeless look that complements various interior styles.\r\n\r\nWhether your decor is traditional, coastal, or modern farmhouse, this dresser effortlessly integrates while providing abundant storage for even the most extensive wardrobes.', '15.5x63x29', '13.5x29x29', '', 'Pine ', 'Manufactured Wood', '', 'Cream', 'Warm White', 'Grey', 'Colette_4_Over_6_Chest_Of_Drawers_Cream.png', 'Colette_4_Over_6_Chest_Of_Drawers_Warm_White.png', 'Colette_4_Over_6_Chest_Of_Drawers_Grey.png', '2025-11-10 14:37:02'),
(3, 'Farrow Cupboard', 10011.00, 200, 'Farrow_Cupboard.png', 'Farrow_Cupboard_Angle1.png', 'Farrow_Cupboard_Angle2.png', 'Farrow_Cupboard_Angle3.png', 'Farrow_Cupboard_Angle4.png', 'Farrow_Cupboard_Hover.png', 1, 'Storage & Organization', 3, 'Cabinets & Cupboards', 'The Farrow Cupboard brings practical storage solutions to any space in your home. This versatile 2-door unit features a large interior compartment with fixed internal shelving, making it perfect for hallways, bathrooms, bedrooms, or living areas. The generous interior keeps items neatly organised while the clean exterior design ensures it complements rather than clutters your space.', '26.5x61x29', '75x75x33.5', '', 'Solid & Manufactured Wood Frame', 'Oak Veneer', 'Metal', 'Grey', 'Cream', 'Charcoal', 'Farrow_Cupboard_Grey.png', 'Farrow_Cupboard_Cream.png', 'Farrow_Cupboard_Charcoal.png', '2025-11-10 14:48:15');

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
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `addtocart`
--
ALTER TABLE `addtocart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `unique_cart` (`user_id`,`product_id`,`color`,`material`,`sizes`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `furniture_id` (`category_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `category_name` (`category_name`),
  ADD KEY `sub_name` (`sub_name`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_id`),
  ADD UNIQUE KEY `sub_name` (`sub_name`),
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
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addtocart`
--
ALTER TABLE `addtocart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_name`) REFERENCES `category` (`category_name`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`sub_name`) REFERENCES `sub_category` (`sub_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

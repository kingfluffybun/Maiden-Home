-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 01:24 PM
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
(24, 1, 1, 3, 'Charcoal', 'Oak Top', '80x33x195', '2025-11-11 10:32:59'),
(25, 1, 7, 4, 'Navy', 'Cotton Fiber', '40x62x1', '2025-11-11 12:23:57');

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
(1, 'Farrow Large Bookcase', 16290.00, 200, 'Farrow_Large_Bookcase.png', 'Farrow_Large_Bookcase_Angle1.png', 'Farrow_Large_Bookcase_Angle2.png', 'Farrow_Large_Bookcase_Angle3.png', 'Farrow_Large_Bookcase_Angle4.png', 'Farrow_Large_Bookcase_Hover.png', 1, '', 1, '', 'The Farrow Large Bookcase provides exceptional display opportunities with its six generous fixed shelves. This substantial piece offers ample space for books, photographs, ornaments, plants, and decorative items while maintaining the organised, sophisticated appearance that makes living spaces feel curated and welcoming.\r\n\r\nThe distinctive panelled back design adds visual texture and depth, creating an attractive backdrop for your displays while maintaining the clean, country-inspired aesthetic that defines the Farrow collection.', '180x80x22.5', '40x40x180', '80x33x195', 'Solid & Manufactured Wood Frame', 'Oak Top', 'Oak Veneer', 'Navy', 'Charcoal', 'Sage', 'Farrow_Large_Bookcase_Navy.png', 'Farrow_Large_Bookcase_Charcoal.png', 'Farrow_Large_Bookcase_Sage.png', '2025-11-10 14:16:57'),
(2, 'Colette 4 Over 6 Chest Of Drawers', 41114.00, 200, 'Colette_4_Over_6_Chest_Of_Drawers.png', 'Colette_4_Over_6_Chest_Of_Drawers_Angle1.png', 'Colette_4_Over_6_Chest_Of_Drawers_Angle2.png', 'Colette_4_Over_6_Chest_Of_Drawers_Angle3.png', 'Colette_4_Over_6_Chest_Of_Drawers_Angle4.png', 'Colette_4_Over_6_Chest_Of_Drawers_Hover.png', 1, '', 2, '', 'The Colette 4 over 6 Chest of Drawers combines classic design with exceptional storage capacity, making it a centerpiece for any bedroom. Its clean lines are enhanced by an elegant crown top and a sturdy plinth base with a subtle curved cutout, creating a timeless look that complements various interior styles.\r\n\r\nWhether your decor is traditional, coastal, or modern farmhouse, this dresser effortlessly integrates while providing abundant storage for even the most extensive wardrobes.', '15.5x63x29', '13.5x29x29', '', 'Pine ', 'Manufactured Wood', '', 'Cream', 'Warm White', 'Grey', 'Colette_4_Over_6_Chest_Of_Drawers_Cream.png', 'Colette_4_Over_6_Chest_Of_Drawers_Warm_White.png', 'Colette_4_Over_6_Chest_Of_Drawers_Grey.png', '2025-11-10 14:37:02'),
(3, 'Farrow Cupboard', 10011.00, 200, 'Farrow_Cupboard.png', 'Farrow_Cupboard_Angle1.png', 'Farrow_Cupboard_Angle2.png', 'Farrow_Cupboard_Angle3.png', 'Farrow_Cupboard_Angle4.png', 'Farrow_Cupboard_Hover.png', 1, '', 3, '', 'The Farrow Cupboard brings practical storage solutions to any space in your home. This versatile 2-door unit features a large interior compartment with fixed internal shelving, making it perfect for hallways, bathrooms, bedrooms, or living areas. The generous interior keeps items neatly organised while the clean exterior design ensures it complements rather than clutters your space.', '26.5x61x29', '75x75x33.5', '', 'Solid & Manufactured Wood Frame', 'Oak Veneer', 'Metal', 'Grey', 'Cream', 'Charcoal', 'Farrow_Cupboard_Grey.png', 'Farrow_Cupboard_Cream.png', 'Farrow_Cupboard_Charcoal.png', '2025-11-10 14:48:15'),
(4, 'Farrow Corner TV Stand', 11635.00, 200, 'Farrow_Corner_TV_Stand.png', 'Farrow_Corner_TV_Stand_Angle1.png', 'Farrow_Corner_TV_Stand_Angle2.png', 'Farrow_Corner_TV_Stand_Angle3.png', 'Farrow_Corner_TV_Stand_Angle4.png', 'Farrow_Corner_TV_Stand_Hover.png', 1, '', 4, '', 'The Farrow Corner TV Unit transforms unused corner space into a stylish media centre. At 90cm wide, this cleverly designed unit accommodates televisions up to 40 inches while providing essential storage for media devices, gaming consoles, and accessories.\r\n\r\nThe open shelf offers easy access to your everyday electronics, while the deep drawer keeps remotes, cables, and other items neatly organised.', '48x90x44', '', '', 'Oak Top', 'Oak Veneer', 'Solid & Manufactured Wood Frame ', 'Cream', 'Charcoal', 'Sage', 'Farrow_Corner_TV_Stand_Cream.png', 'Farrow_Corner_TV_Stand_Charcoal.png', 'Farrow_Corner_TV_Stand_Sage.png', '2025-11-11 03:50:53'),
(5, 'Farrow Triple Wardrobe with Drawers', 46657.00, 200, 'Farrow_Triple_Wardrobe_with_Drawers.png', 'Farrow_Triple_Wardrobe_with_Drawers_Angle1.png', 'Farrow_Triple_Wardrobe_with_Drawers_Angle2.png', 'Farrow_Triple_Wardrobe_with_Drawers_Angle3.png', 'Farrow_Triple_Wardrobe_with_Drawers_Angle4.png', 'Farrow_Triple_Wardrobe_with_Drawers_Hover.png', 1, '', 5, '', 'The Farrow Triple Wardrobe provides the ultimate bedroom storage solution with its three generous hanging compartments and two deep drawers below. The spacious hanging areas accommodate full-length garments, suits, and dresses, while the substantial drawers offer perfect storage for folded items, linens, and seasonal clothing.\r\n\r\nThis impressive piece ensures you can organise extensive wardrobes with ease, keeping everything accessible while maintaining the sophisticated appearance that makes bedrooms feel luxurious and well-appointed.', '183x130x52', '', '', 'Oak Veneer ', 'Oak Top', 'olid & Manufactured Wood Frame', 'Grey', 'Cream', 'Navy', 'Farrow_Triple_Wardrobe_with_Drawers_Grey.png', 'Farrow_Triple_Wardrobe_with_Drawers_Cream.png', 'Farrow_Triple_Wardrobe_with_Drawers_Navy.png', '2025-11-11 03:57:50'),
(6, 'Trent Ottoman Storage Bed Frame', 34660.00, 200, 'Trent_Ottoman_Storage_Bed_Frame.png', 'Trent_Ottoman_Storage_Bed_Frame_Angle1.png', 'Trent_Ottoman_Storage_Bed_Frame_Angle2.png', 'Trent_Ottoman_Storage_Bed_Frame_Angle3.png', 'Trent_Ottoman_Storage_Bed_Frame_Angle4.png', 'Trent_Ottoman_Storage_Bed_Frame_Hover.png', 2, '', 6, '', 'Are you looking for a modern, comfortable storage bed, perfect for saving space?\r\n\r\nStylish and amazingly practical, the Trent Ottoman Bed offers elegance and practicality for any bedroom setting. The slatted headboard and low foot end mean this bed can go with most styles of dÃ©cor.\r\n\r\nThis is an exemplary ottoman bed designed with powerful hydraulic pistons that grant easy access to the spacious storage hidden beneath. The storage is split into three sections and is accessible from the foot-end. A very solid and durable bed.\r\n\r\nChoose from 3 finishes: white or grey painted, or oak stain. These neutral options are adaptable for various interior styles.\r\n\r\nThe Trent Ottoman Bed is perfect for young adults and couples alike as the excellent under bed storage makes it just perfect for storing those bulky items like your winter duvets, blankets, spare sheets and pillows and comes in a choice of sizes to suit your needs.', '106x136x210', '106x166x220.5', '', 'Rubberwood Frame', ' Pine Slats', '', 'Grey', 'Oak', '', 'Trent_Ottoman_Storage_Bed_Frame_Grey.png', 'Trent_Ottoman_Storage_Bed_Frame_Oak.png', '', '2025-11-11 04:21:04'),
(7, 'Pillow Hotel', 2999.00, 200, 'Pillow.png', 'pillow_Angle1.png', 'pillow_Angle2.png', 'Pillow_Angle3.png', 'Pillow_Angle4.jpg', 'Pillow_Hover.png', 2, '', 7, '', 'Pillow Hotel is a soft cushion, typically cloth-filled with feathers, down, or synthetic fibers, designed to support the head and neck during sleep, but also used for comfort, therapy, or decoration. They come in various shapes, sizes, and firmness levels to suit different needs, and can be used for more than just sleeping, such as for supporting the body while sitting or for aesthetic purposes on furniture.  ', '48x74x1', '40x62x1', '', 'Cotton Fiber', 'Polyfiber+Antibacterial Fiber', 'Cotton Polyurethane', 'Middle Brown', 'Light Gray', 'Navy', 'Pillow_Middle_Brown.png', 'Pillow_Light_Gray.png', 'Pillow_Navy.png', '2025-11-11 05:59:22'),
(9, 'Stratford Memory Coil Quilted Mattress', 14021.00, 200, 'Stratford_Memory_Coil_Quilted_Mattress.png', 'Stratford_Memory_Coil_Quilted_Mattress_Angle1.png', 'Stratford_Memory_Coil_Quilted_Mattress_Angle2.png', 'Stratford_Memory_Coil_Quilted_Mattress_Angle3.png', 'Stratford_Memory_Coil_Quilted_Mattress_Angle4.png', 'Stratford_Memory_Coil_Quilted_Mattress_Hover.png', 2, '', 8, '', 'Maiden Home Sleep is proud to offer the Stratford Memory Coil Mattress, available in multiple sizes. This luxurious 13.5g coil sprung 25cm deep mattress offers incredible value. With vertical border design in grey, polyester fillings, air vents and luxurious stretch fabric & Visco memory foam this hand-tufted mattress will certainly give you a gorgeous nights sleep even on a budget. Delivery Info with 1 year guarantee!', '25.4x75x190', '25.4x180x200', '', 'Foam Mattress', '', '', 'White', '', '', 'Stratford_Memory_Coil_Quilted_Mattress_White.png', '', '', '2025-11-11 06:27:24'),
(10, 'Huxley Triple Wardrobe with Open Shelves', 29350.00, 150, 'Huxley-Triple-Wardrobe-With-Shelves-Oak-Cashmere.jpg', 'Huxley-Triple-Wardrobe-With-Shelves-Oak-Cashmere-Angle1.jpg', 'Huxley-Triple-Wardrobe-With-Shelves-Oak-Cashmere-Angle2.jpg', 'Huxley-Triple-Wardrobe-With-Shelves-Oak-Cashmere-Angle3.jpg', 'Huxley-Triple-Wardrobe-With-Shelves-Oak-Cashmere-Angle4.jpg', 'Huxley-Triple-Wardrobe-With-Shelves-Oak-Cashmere-Hover.jpg', 1, '', 1, '', 'Crafted and fully assembled in the UK, the Huxley Triple Wardrobe is an impressive, stylish, and robust storage solution designed for larger rooms, offering extensive capacity with its triple-width configuration featuring dual full-height hanging compartments and six central open shelves for convenient display and easy access, all while channeling a bold Scandinavian design aesthetic with clean lines, semi-circular black handles, and three sophisticated finish combinations (oak/graphite, oak/cashmere, or pure cashmere) on its scratch-resistant melamine exterior for lasting beauty and stability.', '196x111x53', '75x140x70', '220x80x60', 'Manufactured Wood', 'Melamine Chipboard', '', 'Oak & Cashmere', 'Oak & Graphite', 'Cashmere', 'Huxley-Triple-Wardrobe-With-Shelves-Oak-Cashmere.jpg', 'Huxley-Triple-Wardrobe-With-Shelves-Oak-Graphite.jpg', 'Huxley-Triple-Wardrobe-With-Shelves-Cashmere.jpg', '2025-11-11 06:41:52'),
(11, 'Francis Premier Velvet Ottoman Storage B', 34941.00, 200, 'Francis_Premier_Velvet_Ottoman_Storage_Bed_Frame.png', 'Francis_Premier_Velvet_Ottoman_Storage_Bed_Frame_Angle1.png', 'Francis_Premier_Velvet_Ottoman_Storage_Bed_Frame_Angle2.png', 'Francis_Premier_Velvet_Ottoman_Storage_Bed_Frame_Angle3.png', 'Francis_Premier_Velvet_Ottoman_Storage_Bed_Frame_Angle4.png', 'Francis_Premier_Velvet_Ottoman_Storage_Bed_Frame_Hover.png', 2, '', 9, '', 'The Francis Velvet Ottoman Bed comes with an elegant, luxurious look and a high-quality build, crafted with a solid wood frame and upholstered in a gorgeous heavy-weight velvet fabric and is button tufted by hand.\r\n\r\nA deep headboard and thick side rails add to the stability and durability of this stunning bed frame, while there is the addition of two-foot options - light or dark wood - simply fit whichever style you prefer during assembly.\r\n\r\nAn end-opening gas lift mechanism securely raises the base of the bed, creating additional storage space for your bedroom - perfect for keeping blankets and bedding or simple to keep your bedroom clutter-free.', '164x149x210', '164x164x218', '164x194x218', 'Solid Wooden Frame', '', '', 'Ink', 'Silver', 'Steel', 'Francis_Premier_Velvet_Ottoman_Storage_Bed_Frame_Ink.png', 'Francis_Premier_Velvet_Ottoman_Storage_Bed_Frame_Silver.png', 'Francis_Premier_Velvet_Ottoman_Storage_Bed_Frame_Steel.png', '2025-11-11 06:49:49'),
(12, 'Farrow 2 Over 3 Chest Of Drawers', 20125.00, 326, 'Farrow-White-2-over-3-Chest.jpg', 'Farrow-White-2-over-3-Chest-Angle1.jpg', 'Farrow-White-2-over-3-Chest-Angle2.jpg', 'Farrow-White-2-over-3-Chest-Angle3.jpg', 'Farrow-White-Angle4.jpg', 'Farrow-Oak-2_3-Chest-White-Hover.jpg', 1, '', 2, '', 'The Farrow Drawer Chest is a fully assembled, solid wood piece boasting sophisticated modern country character with clean angled edges and a distinctive two-tone design, where a genuine oak topâ€”either natural oak with a clear lacquer or a softer washed oak (for Coconut White and Sage finishes)â€”contrasts with a range of matt painted colors; this versatile chest offers intelligent storage with two smaller top drawers for accessories and three larger drawers below for bulkier items, featuring coordinating polished chrome or a choice between natural wooden knobs and brushed chrome handles depending on the color finish.', '12x32x31.5', '90x85x36', '15x69x31.5', 'Oak Top', 'Oak Veneer', 'Solid & Manufactured Wood Frame', 'Cream', 'Sage', 'Navy', 'Farrow-Cream-2-over-3-Chest-Cream.jpg', 'Farrow-2-Over-3-Drawer-Chest-Washed-Oak-Sage.jpg', 'Farrow-Navy-2-over-3-Chest-Navy.jpg', '2025-11-11 07:10:58'),
(13, 'Oskar Extending Dining Table', 15171.00, 200, 'Oskar_Extending_Dining_Table.png', 'Oskar_Extending_Dining_Table_Angle1.png', 'Oskar_Extending_Dining_Table_Angle2.png', 'Oskar_Extending_Dining_Table_Angle3.png', 'Oskar_Extending_Dining_Table_Angle4.png', 'Oskar_Extending_Dining_Table_Hover.png', 3, '', 11, '', 'Fill your home with furniture that catches the eye but also keeps your space feeling relaxed and uncluttered. The Oskar Extending Dining Table is coated in a rich walnut stain that protects and colours the wood without hiding the natural beauty of the grain. To create a contrast, soft wooden legs produce an on-trend, statement finish.\r\n\r\nThis extendable dining table is ideal for maximising space, and accommodating additional guests by way of its butterfly leaf extension mechanism which means this stylish table is suitable for up to 6 people.\r\n\r\nCombining mid-century modern with a Scandinavian feel, our Oskar furniture range is effortlessly elegant. Crafted from durable acacia wood this range offers a contemporary-retro look that will bring a timeless feel to your home.', '76.5x120x85', '76.5x165x85', '', 'Manufactured Wood', '', '', 'Oak', '', '', 'Oskar_Extending_Dining_Table_Oak.png', '', '', '2025-11-11 07:11:12'),
(14, 'Henshaw 3 Drawer Chest', 17415.00, 98, 'Henshaw-3-Drawer-Chest-White.jpg', 'Henshaw-3-Drawer-Chest-White-Angle1.jpg', 'Henshaw-3-Drawer-Chest-White-Angle2.jpg', 'Henshaw-3-Drawer-Chest-White-Angle3.jpg', 'Henshaw-3-Drawer-Chest-White-Angle4.jpg', 'Henshaw-3-Drawer-Chest-White-Hover.jpg', 1, '', 2, '', 'The Henshaw Drawer Chest is a versatile, fully assembled storage solution made in the UK, featuring three generous drawers on smooth metal runners with faux linen interiors and sleek recessed handles for a minimalist look, constructed from durable, scratch-resistant manufactured wood with a melamine chipboard exterior, and available in a sophisticated matt Dusk Grey finish or White and White Gloss & Oak options with glossy drawer fronts.', '70x74x39', '16x68x33x', '', 'Vinyl', 'Manufactured Wood', 'Melamine Chipboard', 'White', 'Grey', 'White Oak', 'Henshaw-3-Drawer-Chest-White.jpg', 'Henshaw-3-Drawer-Chest-Dusk-Grey.jpg', 'Henshaw-3-Drawer-Chest-White-Oak.jpg', '2025-11-11 07:21:09'),
(15, 'Jakob Oak Curved Dining Chair', 3093.00, 200, 'Jakob_Oak_Curved_Dining_Chair.png', 'Jakob_Oak_Curved_Dining_Chair_Angle1.png', 'Jakob_Oak_Curved_Dining_Chair_Angle2.png', 'Jakob_Oak_Curved_Dining_Chair_Angle3.png', 'Jakob_Oak_Curved_Dining_Chair_Angle4.png', 'Jakob_Oak_Curved_Dining_Chair_Hover.png', 3, '', 12, '', 'Manufactured WoodAdd this retro dining chair to an existing dining table to freshen up your look. With a simple, curvilinear design with curved back support and tapered legs, this chair will add a pleasant vibe and a touch of personality to the dining area.\r\n\r\nOur Jakob furniture collection, which combines mid-century contemporary style with a Nordic design, exudes effortless elegance. This collection, which is made from rubberwood, oak effect veneers, and manufactured wood, gives a modern-retro design that will give your home a timeless vibe.\r\n\r\nFinished in a stunning oak effect, the Jakob is ideal for anyone who desires the appearance and feel of real oak furniture without the high cost and upkeep needs.\r\n', '88x45x51', '', '', 'Manufactured Wood', '', '', 'Oak', '', '', 'Jakob_Oak_Curved_Dining_Chair_Oak.png', '', '', '2025-11-11 07:24:57'),
(16, 'Milo Mango & Marble Fluted Side Table wi', 12784.00, 200, 'Milo_Mango___Marble_Fluted_Side_Table_with_Door.png', 'Milo_Mango___Marble_Fluted_Side_Table_with_Door_Angle1.png', 'Milo_Mango___Marble_Fluted_Side_Table_with_Door_Angle2.png', 'Milo_Mango___Marble_Fluted_Side_Table_with_Door_Angle3.png', 'Milo_Mango___Marble_Fluted_Side_Table_with_Door_Angle4.png', 'Milo_Mango___Marble_Fluted_Side_Table_with_Door_Hover.png', 3, '', 13, '', 'We love the bold, clean and modern look of the Milo side table! The flutes sides of this occasional table are crafted from quality mango wood finished in a striking matt black or warm walnut stain.\r\n\r\nThe top is made from stunning Calacatta Marble. Marble can contain minerals, including quartz, graphite, pyrite, and iron oxides. Depending on where the marble is quarried, these minerals can give marble a pink, brown, grey, green, or variegated coloration.\r\n\r\nDue to the natural veins and markings this material offers, every single piece is unique, meaning no two items are the same and such a beautiful material really adds to the character of this piece.\r\n\r\nOur Milo range of wood and marble furniture is perfect if you\'re looking to create a modern and stylish interior space. The clean lines of the fluted wood offer real character to the range and the rich matt black or warm walnut finish are perfect if you\'re looking for an on-trend home.', '45x33x33', '', '', 'Mango Wood Base', '', '', 'Matt Black', '', '', 'Milo_Mango___Marble_Fluted_Side_Table_with_Door_Matt_Black.png', '', '', '2025-11-11 07:29:47'),
(17, 'Geo 4 Drawer Chest with Gold Hairpin Leg', 24400.00, 213, 'geo-4-drawer-chest-white.jpg', 'geo-4-drawer-chest-white-angle1.jpg', 'geo-white-drawer-angle2.jpg', 'geo-white-drawer-angle3.jpg', 'geo-grey-hairpin-leg-angle4.jpg', 'geo-4-drawer-chest-white-hover.jpg', 1, '', 2, '', 'The Geo Drawer Chest is a fully assembled, made-to-order piece crafted in the UK that provides stylish and convenient storage with four drawers on smooth metal runners, featuring a durable, scratch-resistant matt white base contrasted by on-trend gold hairpin legs and matching gold metal handles; the chest is distinguished by an embossed diamond design on the drawer fronts, which can be a white/gold combination or accented with navy blue, pink, or grey, and all drawers include a luxurious linen-effect lining.', '91x76.5x39.5', '', '', 'Manufactured Wood', '', '', 'White', 'Navy', 'Pink', 'geo-4-drawer-chest-white.jpg', 'geo-4-drawer-chest-white-navy.jpg', 'geo-4-drawer-chest-white-pink.jpg', '2025-11-11 07:31:43'),
(18, 'Mendez Faux Leather Bar Stool', 5810.00, 200, 'Mendez_Faux_Leather_Bar_Stool.png', 'Mendez_Faux_Leather_Bar_Stool_Angle1.png', 'Mendez_Faux_Leather_Bar_Stool_Angle2.png', 'Mendez_Faux_Leather_Bar_Stool_Angle3.png', 'Mendez_Faux_Leather_Bar_Stool_Angle4.png', 'Mendez_Faux_Leather_Bar_Stool_Hover.png', 3, '', 14, '', 'This striking modern Mendez bar stool, with its comfortable leather-like upholstered material and stunning steel base, is the lease of life every kitchen needs. With adjustable height and swivel features, this stool caters for all needs and would fit in well with its bold, industrial edge style and armless design, quickly becoming an essential to any kitchen dining area.\r\n\r\nAdditional features include zippers on the rear and underside for easy attachment of the seat.', '87x50x45', '108x50x45', '', 'Steel', '', '', 'Charcoal Grey', '', '', 'Mendez_Faux_Leather_Bar_Stool_Charcoal_Grey.png', '', '', '2025-11-11 07:34:43'),
(19, 'Farrow Low Bookcase', 8120.00, 314, 'Farrow-White-Low-Bookcase.jpg', 'Farrow-White-Low-Bookcase-Angle1.jpg', 'farrow-white-low-bookcase-Angle2.jpg', 'farrow-white-low-bookcase-Angle3.jpg', 'farrow-white-low-bookcase-Angle4.jpg', 'Farrow-Low-Bookcase-White-Hover.jpg', 1, '', 1, '', 'The Farrow Low Bookcase is a highly useful addition to the home, part of the best-selling Farrow furniture range, featuring three fixed shelves perfect for books, photos, or ornaments, and crafted with a solid wood base in a range of stunning matt painted finishes complemented by a stylish, lacquered oak contrasting top and polished metal handles to achieve a beautiful modern country aesthetic at extraordinary value.', '82x70x22.5', '19.5x56x20', '', 'Oak Top', 'Oak Veneer', 'Solid & Manufactured Wood Frame', 'Cream', 'Grey', 'Navy', 'Farrow-Cream-Low-Bookcase-Cream.jpg', 'Farrow-Grey-Painted-Low-Bookcase-Grey.jpg', 'Farrow-Navy-Low-Bookcase-Navy.jpg', '2025-11-11 07:51:01'),
(20, 'Alfie Armchair', 28634.00, 200, 'Alfie_Armchair.png', 'Alfie_Armchair_Angle1.png', 'Alfie_Armchair_Angle2.png', 'Alfie_Armchair_Angle3.png', 'Alfie_Armchair_Angle4.png', 'Alfie_Armchair_Hover.png', 4, '', 17, '', 'The Alfie Armchair is built for luxurious comfort. Tailored back cushions sculpted to seat cushions and piped finish, pocket sprung seats, and domed fibre pillow top seat cushions create a soft premium experience. You\'ll love the feels-like-down back cushions for added cloud-like luxury that comforts and supports your body.\r\n\r\nWith sturdy solid wood frames, s-sprung bases, and an included scatter cushion for superior comfort, this sofa offers excellent weight support and durability.', '93x97x91', '', '', 'Chenille', 'Woven Fabric Cover', '', 'Blush Chenille', 'Charcoal Chenille', 'Cream Woven', 'Alfie_Armchair_Blush_Chenille.png', 'Alfie_Armchair_Charcoal_Chenille.png', 'Alfie_Armchair_Cream_Woven.png', '2025-11-11 07:52:58'),
(21, 'Thalia Velvet Corner Sofa Bed', 85133.00, 200, 'Thalia_Velvet_Corner_Sofa_Bed.png', 'Thalia_Velvet_Corner_Sofa_Bed_Angle1.png', 'Thalia_Velvet_Corner_Sofa_Bed_Angle2.png', 'Thalia_Velvet_Corner_Sofa_Bed_Angle3.png', 'Thalia_Velvet_Corner_Sofa_Bed_Angle4.png', 'Thalia_Velvet_Corner_Sofa_Bed_Hover.png', 4, '', 18, '', 'The Thalia 3 seater velvet chaise sofa is a practical way to bring an additional bed into the home and is perfect for occasional use when you have guests over to stay, extending in to a wide, comfy sofa bed, maximising your space whilst never compromising on style.\r\n\r\nUpholstered in sumptuous, smooth velvet fabric with a piped edge design, it comes in a choice of lavish colours, ideal for matching a desired colour scheme or adding a pop of colour to your interior.\r\n\r\nThe chaise section of the sofa also lifts up, providing convenient storage space for the spare sheets and blankets you will need for visitors. It also can be assembled to suit your room in either a left facing or right facing position.\r\n\r\nRest assured, the high quality, deeply padded foam filling ensures supreme comfort and will look great in any contemporary home dÃ©cor.', '48x184x108', '', '', 'Metal Frame', '', '', 'Burnt Orange', 'Grey', '', 'Thalia_Velvet_Corner_Sofa_Bed_Burnt_Orange.png', 'Thalia_Velvet_Corner_Sofa_Bed_Grey.png', '', '2025-11-11 08:01:25'),
(22, 'Beckett Gloss Tall Shelving Unit', 18825.00, 156, 'Beckett-White-Oak-Tall-Shelving-Unit.jpg', 'Beckett-White-Oak-Tall-Shelving-Unit-Angle1.jpg', 'Beckett-White-Oak-Tall-Shelving-Unit-Angle2.jpg', 'Beckett-White-Oak-Tall-Shelving-Unit-Angle3.jpg', 'Beckett-White-Oak-Tall-Shelving-Unit-Angle4.jpg', 'Beckett-White-Oak-Tall-Shelving-Unit-Hover.jpg', 1, '', 1, '', 'The Beckett Gloss Tall Shelving Unit is a fully assembled, made-to-order piece crafted in the UK, featuring a durable, scratch-resistant vinyl construction with a sleek gloss finish and eight open storage compartments; part of the Beckett range, this unit showcases clean, modern panels, bow-shaped countertops, and is available in cream, white, black, or a white and light wood finish, making it a stylish and elegant addition to any living room or bedroom.', '197x76x53', '', '', 'Manufactured Wood', 'Metal', 'Faux Linen', 'White', 'Cream', 'Black', 'Beckett-White-Tall-Shelving-Unit-White.jpg', 'Beckett-Cream-Tall-Shelving-Unit-Cream.jpg', 'Beckett-Black-Tall-Shelving-Unit-Black.jpg', '2025-11-11 08:06:46'),
(23, 'Bianca Linen Armchair', 18587.00, 200, 'Bianca_Linen_Armchair.png', 'Bianca_Linen_Armchair_Angle1.png', 'Bianca_Linen_Armchair_Angle2.png', 'Bianca_Linen_Armchair_Angle3.png', 'Bianca_Linen_Armchair_Angle4.png', 'Bianca_Linen_Armchair_Hover.png', 4, '', 17, '', 'This classic Bianca armchair is a must-have addition to both modern and traditional living rooms alike. With its button tufted back and opulently padded seat cushion, it\'s every bit as comfortable as it is stylish and timeless.\r\n\r\nUpholstered with a blended fabric to give an authentic linen look and feel (available in a choice of colours), this stunning chair features striking natural wooden legs. It\'s a fantastic addition to the home for both everyday and occasional use.', '84x68x81', '', '', 'Solid Wood Frame', '', '', 'Grey', 'Charcoal', '', 'Bianca_Linen_Armchair_Grey.png', 'Bianca_Linen_Armchair_Charcoal.png', '', '2025-11-11 08:20:16'),
(24, 'Ashbury Snuggle Chair', 33287.00, 200, 'Ashbury_Snuggle_Chair.png', 'Ashbury_Snuggle_Chair_Angle1.png', 'Ashbury_Snuggle_Chair_Angle2.png', 'Ashbury_Snuggle_Chair_Angle3.png', 'Ashbury_Snuggle_Chair_Angle4.png', 'Ashbury_Snuggle_Chair_Hover.png', 4, '', 17, '', 'The Ashbury Snuggle Chair offers a delightful middle ground between an armchair and a loveseat, creating the perfect spot for relaxation. With its generously oversized proportions, this chair provides ample space to curl up with a good book or accommodate a parent and child for story time.\r\n\r\nThe sumptuously soft Chenille fabric creates a cosy, inviting texture that makes every moment spent in this chair a comfortable retreat from the bustle of daily life.', '46x58x81', '', '', 'henille Polyester Fabric', 'Hardwood', '', 'Moss', 'Anthracite', 'Beige', 'Ashbury_Snuggle_Chair_Moss.png', 'Ashbury_Snuggle_Chair_Anthracite.png', 'Ashbury_Snuggle_Chair_Beige.png', '2025-11-11 08:33:44'),
(25, 'Karla Boucle Armchair', 37168.00, 200, 'Karla_Boucle_Armchair.png', 'Karla_Boucle_Armchair_Angle1.png', 'Karla_Boucle_Armchair_Angle2.png', 'Karla_Boucle_Armchair_Angle3.png', 'Karla_Boucle_Armchair_Angle4.jpg', 'Karla_Boucle_Armchair_Hover.png', 4, '', 17, '', 'The Karla Armchair makes a bold statement with its generous contemporary proportions and sophisticated material combination. Available in two stunning colourwaysâ€”rich Ruby and versatile Natural boucleâ€”this substantial accent chair brings both comfort and visual impact to modern living spaces.\r\n\r\nThe distinctive chunky padded arms create an inviting, embracing silhouette that defines contemporary luxury seating. This means the Karla works beautifully in spaces where comfort and style are equally important, from reading nooks to formal living areas.', '43.5x55x60', '', '', 'Boucle', 'Oak Wood', '', 'Ruby', '', '', 'Karla_Boucle_Armchair_Ruby.png', '', '', '2025-11-11 08:42:24'),
(26, 'Hudson Tall Open Shelf Unit', 21000.00, 221, 'Hudson-Tall-Open-Shelf-Unit-White.jpg', 'Hudson-Tall-Open-Shelf-Unit-White-Angle1.jpg', 'Hudson-Tall-Open-Shelf-Unit-White-Angle2.jpg', 'Hudson-Tall-Open-Shelf-Unit-White-Angle3.jpg', 'Hudson-Tall-Open-Shelf-Unit-White-Angle4.jpg', 'Hudson-Tall-Open-Shelf-Unit-White-Hover.jpg', 1, '', 1, '', 'The Hudson Open Shelf Unit is a fully assembled, made-to-order combination wardrobe crafted in the UK from durable, scratch-resistant manufactured wood, featuring a straight, clean-line contemporary design in solid color optionsâ€”grey, white, olive, or blackâ€”and offering versatile storage with five tiered open shelves and a full-height hanging compartment, while also being part of a range that includes storage drawers with linen-effect lining and smooth metal runners.', '197x76.5x53', '', '', 'Manufactured Wood', '', '', 'Grey', 'Black', 'Olive', 'Hudson-Tall-Open-Shelf-Unit-Grey.jpg', 'Hudson-Tall-Open-Shelf-Unit-Black.jpg', 'Hudson-Tall-Open-Shelf-Unit-Olive.jpg', '2025-11-11 08:42:29'),
(27, 'Bletchley Jumbo Cord Swivel Chair', 40639.00, 200, 'Bletchley_Jumbo_Cord_Swivel_Chair.png', 'Bletchley_Jumbo_Cord_Swivel_Chair_Angle1.png', 'Bletchley_Jumbo_Cord_Swivel_Chair_Angle2.png', 'Bletchley_Jumbo_Cord_Swivel_Chair_Angle3.png', 'Bletchley_Jumbo_Cord_Swivel_Chair_Angle4.png', 'Bletchley_Jumbo_Cord_Swivel_Chair_Hover.png', 4, '', 17, '', 'Make your living room an inviting place to settle in with this fantastic Bletchley Swivel Chair. This chunky circular lounge seat is designed to be a welcoming, and practical addition to your home. The thick-lined jumbo corduroy cover adds texture and depth to your living space and is available in a choice of rich colours for you to match to your home dÃ©cor.\r\n\r\nThis quality chair is made from strong and sturdy hardwood & OSB wooden frame, upholstered in hardwearing and comfortable fabric for you to sit back and relax, paired with soft scatter cushions and deep sprung seating.\r\n', '40x60x95', '', '', 'Hardwood', 'Jumbo Cord Fabric', 'Fibre Back Filling ', 'Chocolate', 'Black', 'Charcoal', 'Bletchley_Jumbo_Cord_Swivel_Chair_Chocolate.png', 'Bletchley_Jumbo_Cord_Swivel_Chair_Black.png', 'Bletchley_Jumbo_Cord_Swivel_Chair_Charcoal.png', '2025-11-11 09:00:20'),
(28, 'Natural Wood Veneer Teardrop Shaped Mirr', 9862.00, 200, 'Natural_Wood_Veneer_Teardrop_Shaped_Mirror.png', 'Natural_Wood_Veneer_Teardrop_Shaped_Mirror_Angle1.png', 'Natural_Wood_Veneer_Teardrop_Shaped_Mirror_Angle2.png', 'Natural_Wood_Veneer_Teardrop_Shaped_Mirror_Angle3.png', 'Natural_Wood_Veneer_Teardrop_Shaped_Mirror_Angle4.png', 'Natural_Wood_Veneer_Teardrop_Shaped_Mirror_Hover.png', 5, '', 21, '', 'Whether you\'re decorating your living room, bedroom, or hallway, this teardrop-shaped mirror will complement any dÃ©cor style.\r\n\r\nIts unique shape and natural wood finish make it a versatile piece that can enhance both modern and traditional spaces. Hang it alone or create an eye-catching gallery wall with multiple mirrors.\r\n\r\nPlease Note: This mirror is not suitable for bathrooms', '90x7x33', '', '', 'Manufactured Wood', 'Mirror', '', 'Medium Oak Wax', '', '', 'Natural_Wood_Veneer_Teardrop_Shaped_Mirror_Medium_Oak_Wax.png', '', '', '2025-11-11 09:18:27'),
(29, 'Natural Wood Veneer Round Wall Mirror', 13157.00, 200, 'Natural_Wood_Veneer_Round_Wall_Mirror.png', 'Natural_Wood_Veneer_Round_Wall_Mirror_Angle1.png', 'Natural_Wood_Veneer_Round_Wall_Mirror_Angle2.png', 'Natural_Wood_Veneer_Round_Wall_Mirror_Angle3.png', 'Natural_Wood_Veneer_Round_Wall_Mirror_Angle4.png', 'Natural_Wood_Veneer_Round_Wall_Mirror_Hover.png', 5, '', 21, '', 'The Natural Wood Veneer Round Wall Mirror combines function and style, featuring a natural wood veneer frame encasing smooth glass, creating a minimalist and modern aesthetic perfect for any wall.\r\n\r\nWith a design that blends style and purpose, this mirror adds a decorative touch while serving a functional purpose, enhancing the ambiance with its natural, minimalist appearance.\r\n\r\nPlease note: This mirror is not suitable for bathrooms', '74x7x74', '', '', 'Manufactured Wood', 'Mirror', '', 'Medium Oak Wax', '', '', 'Natural_Wood_Veneer_Round_Wall_Mirror_Medium_Oak_Wax.png', '', '', '2025-11-11 09:25:25'),
(30, 'Christmas Led Ornaments', 1290.00, 200, 'CHRISTMAS_LED_ORNAMENTS.png', 'CHRISTMAS_LED_ORNAMENTS_Angle1.png', 'CHRISTMAS_LED_ORNAMENTS_Angle2.png', 'CHRISTMAS_LED_ORNAMENTS_Angle3.png', 'CHRISTMAS_LED_ORNAMENTS_Angle4.png', 'CHRISTMAS_LED_ORNAMENTS_Hover.png', 5, '', 25, '', 'This simple tree can be enjoyed throughout the fall and winter seasons by simply changing the ornaments.\r\nDecorate your room with ornaments that reflect the changing seasons.\r\nThe built-in LED light can also be used as indirect lighting.\r\nNo need to turn the power on/off; the automatic on/off timer turns the light on for approximately 6 hours, then automatically shuts off after 18 hours.', '11 x 11 x 40.3', '', '', 'Polyethylene vinyl copper', '', '', 'White', '', '', 'CHRISTMAS_LED_ORNAMENTS_White.png', '', '', '2025-11-11 09:53:01'),
(31, 'Christmas Ornament', 399.00, 200, 'CHRISTMAS_ORNAMENT.png', 'CHRISTMAS_ORNAMENT_Angle1.png', 'CHRISTMAS_ORNAMENT_Angle2.png', 'CHRISTMAS_ORNAMENT_Angle3.png', 'CHRISTMAS_ORNAMENT_Angle4.png', 'CHRISTMAS_ORNAMENT_Hover.jpg', 5, '', 25, '', 'These charming accents are the delightful finishing touch for your holiday decor, perfect for adorning Christmas trees, garlands, and seasonal centerpieces.\r\nLike snowflakes, each piece possesses a unique beauty. Due to the meticulous manufacturing process, you may observe subtle variations in appearance, which contribute to the bespoke character of your decoration.\r\nWe recommend tender handling to maintain their pristine quality. Given the inherent characteristics of the material, gentle care is advised, as color fading or transfer may occur. Furthermore, please be mindful that some small decorative elements may occasionally come loose.', '7x7x10', '', '', 'Polyethylene', '', '', 'White', '', '', 'CHRISTMAS_ORNAMENT_white.png', '', '', '2025-11-11 10:04:13'),
(32, 'Christmas Ornament BR-F90406 N4BT', 449.00, 200, 'CHRISTMAS_ORNAMENT_BR-F90406_N4BT.png', 'CHRISTMAS_ORNAMENT_BR-F90406_N4BT_Angle1.png', 'CHRISTMAS_ORNAMENT_BR-F90406_N4BT_Angle2.png', 'CHRISTMAS_ORNAMENT_BR-F90406_N4BT_Angle3.png', 'CHRISTMAS_ORNAMENT_BR-F90406_N4BT_Angle4.png', 'CHRISTMAS_ORNAMENT_BR-F90406_N4BT_Hover.jpg', 5, '', 25, '', 'This decorative piece is the perfect addition to elevate any room, bringing charm and character to your living space, bedroom, or office.\r\n\r\nEach accent is crafted with a meticulous approach, meaning subtle variations in appearance are a natural outcome of the manufacturing method, lending a unique quality to every item. We recommend handling your decoration with gentle care. Due to the inherent characteristics of the material, please be aware that color fading or transfer may occur, particularly if exposed to harsh conditions or friction.', '24.5 x11x1.8', '', '', 'wood fibre', '', '', 'White', '', '', 'CHRISTMAS_ORNAMENT_BR-F90406_N4BT_White.png', '', '', '2025-11-11 10:21:03'),
(33, 'Christmas Ornament Glass Tree', 1290.00, 200, 'CHRISTMAS_ORNAMENT_GLASS_TREE.png', 'CHRISTMAS_ORNAMENT_GLASS_TREE_Angle1.png', 'CHRISTMAS_ORNAMENT_GLASS_TREE_Angle2.png', 'CHRISTMAS_ORNAMENT_GLASS_TREE_Angle3.png', 'CHRISTMAS_ORNAMENT_GLASS_TREE_Angle4.png', 'CHRISTMAS_ORNAMENT_GLASS_TREE_Hover.png', 5, '', 25, '', 'This beautiful accent is designed to be the perfect captivating focal point for decorating and elevating any room in your home.\r\n\r\nEach piece carries a unique signature; subtle variations in appearance are a natural testament to the specialized manufacturing process, ensuring your accent is truly one-of-a-kind.\r\n\r\nPlease treat this item with extreme care as it is inherently fragile. Due to the artistic design, please note that the piece features sharp glass points; handle cautiously during placement and cleaning. Furthermore, be aware that minor color fading or transfer may occur as a characteristic of the materials used in the manufacturing process.', '8.5x8.5x17.3', '', '', 'Glass', '', '', 'Clear Glass', '', '', 'CHRISTMAS_ORNAMENT_GLASS_TREE_clear_glass.png', '', '', '2025-11-11 10:31:07'),
(34, 'Alfie 4 Seater Sofa', 50350.00, 255, 'Alfie-4-Seater-Sofa-Charcoal.jpg', 'Alfie-4-Seater-Sofa-Charcoal-Angle1.jpg', 'Alfie-Armchair-Charcoal-Angle2.jpg', 'Alfie-Armchair-Charcoal-Angle3.jpg', 'Alfie-Charcoal-Angle4.jpg', 'Alfie-4-Seater-Sofa-Charcoal-Hover.jpg', 4, '', 16, '', 'The Alfie 4 Seater Sofa is a fully assembled, luxurious piece built for premium comfort and durability, featuring a solid wood frame with an s-sprung base, pocket-sprung seats, tailored back cushions, and domed fiber pillow top seat cushions for a soft, cloud-like experience, all upholstered in a durable fabric, and finished with a sophisticated sock arm design and contrasting oak-finish wooden legs, making it a versatile addition to transitional interiors.', '93x212x91', '', '', 'Chenille Cover', 'Woven Fabric Cover', '', 'Gold', 'Navy', 'Plum', 'Alfie-4-Seater-Sofa-Gold.jpg', 'Alfie-4-Seater-Sofa-Navy.jpg', 'Alfie-4-Seater-Sofa-Plum.jpg', '2025-11-11 10:33:22'),
(35, 'Christmas Mini Ornaments', 329.00, 200, 'CHRISTMAS_MINI_ORNAMENTS.png', 'CHRISTMAS_MINI_ORNAMENTS_Angle1.png', 'CHRISTMAS_MINI_ORNAMENTS_Angle2.png', 'CHRISTMAS_MINI_ORNAMENTS_Angle3.png', 'CHRISTMAS_MINI_ORNAMENTS_Angle4.png', 'CHRISTMAS_MINI_ORNAMENTS_Hover.png', 5, '', 25, '', 'This set of 10 beautiful ornaments is the quintessential collection for adding sparkling, festive elegance to your Christmas tree, wreaths, and holiday displays.\r\n\r\nEach ornament is crafted with a dedicated process, resulting in subtle, unique variations in appearance across the set, giving your collection a bespoke, artisanal feel.\r\n\r\nPlease be advised that glitter (lame) may naturally detach or shed from the ornaments. Handle gently to minimize this effect.', '14x3.3x17', '', '', 'Polystyrene', '', '', 'Yellow', 'Green', 'Red', 'CHRISTMAS_MINI_ORNAMENTS_Yellow.png', 'CHRISTMAS_MINI_ORNAMENTS_Green.png', 'CHRISTMAS_MINI_ORNAMENTS_Red.png', '2025-11-11 10:44:37'),
(36, 'Alfie Large Corner Sofa', 85230.00, 75, 'Alfie-Large-Corner-Sofa-Ice.jpg', 'Alfie-Large-Corner-Sofa-Ice-Angle1.jpg', 'Alfie-2-3-4-C-Seater-Sofa-Ice-Angle2.jpg', 'Alfie-2-3-4-C-Seater-Sofa-Ice-Angle3.jpg', 'Alfie-Ice-Angle4.jpg', 'Alfie-Large-Corner-Sofa-Ice-Hover.jpg', 4, '', 16, '', 'The Alfie Large Sofa is a fully assembled, durable, and stylish seating option built for luxurious comfort, featuring a solid wood frame with an s-sprung base, pocket-sprung seats, tailored back cushions, and soft, fiber pillow-top seat cushions that provide a premium, cloud-like experience; upholstered in a hard-wearing fabric with a sophisticated sock arm design and contrasting oak-finish wooden legs, this sofa is part of a collection that includes multiple formats and is ideal for bringing a chic, transitional look to any living space.', '93x232x91', '', '', 'Chenille Cover', 'Woven Fabric Cover', '', 'Gold', 'Navy', 'Plum', 'Alfie-Large-Corner-Sofa-Gold.jpg', 'Alfie-Large-Corner-Sofa-Navy.jpg', 'Alfie-Large-Corner-Sofa-Plum.jpg', '2025-11-11 10:52:57'),
(37, 'Ashbury 4 Seater Sofa', 58110.00, 67, 'Ashbury-4-Seater-Sofa-Moss.jpg', 'Ashbury-4-Seater-Sofa-Moss-Angle1.jpg', 'Ashbury-Moss-Angle2.jpg', 'Ashbury-Moss-Angle3.jpg', 'Moss-Sofa-Swatch-Angle4.jpg', 'Ashbury-4-Seater-Sofa-Moss-Hover.jpg', 4, '', 16, '', 'The Ashbury 4 Seater Sofa is a spacious, made-to-order piece, fully assembled for convenience, that comfortably seats four adults, making it ideal for larger living spaces; built on a solid hardwood frame with supportive foam seat cushions and plush fiber-filled back cushions, its design features a classic silhouette with rolled sock arms, elegant piping details, and light curved wooden feet, and is upholstered in a luxurious, soft Chenille fabric in six designer colors, complete with multiple matching accent cushions for enhanced comfort and a sophisticated look.', '90x212x89', '', '', 'Chenille Polyester Fabric', '', '', 'Steel', 'Terra', 'Beige', 'Ashbury-4-Seater-Sofa-Steel.jpg', 'Ashbury-4-Seater-Sofa-Terra.jpg', 'Ashbury-4-Seater-Sofa-Beige.jpg', '2025-11-11 11:02:35'),
(38, 'Maze Pulse Corner Dining Set with Square', 232206.00, 255, 'Maze-Pulse-Square-Corner-Dining-Set-Fire-Pit-Product-Image.webp', 'Maze-Pulse-Square-Corner-Dining-Set-Fire-Pit-Angle-1.webp', 'Maze-Pulse-Square-Corner-Dining-Set-Fire-Pit-Angle-2.png', 'Maze-Pulse-Square-Corner-Dining-Set-Fire-Pit-Angle-3-.png', 'Maze-Pulse-Square-Corner-Dining-Set-Fire-Pit-Angle-4.png', 'Maze-Pulse-Square-Corner-Dining-Set-Fire-Pit-Product-Image-hover.webp', 8, '', 36, '', 'Experience luxurious outdoor dining with this elegant corner dining set, crafted for both style and durability. Featuring La Vita high-performance, UV-resistant fabric with quick-dry foam and breathable, mould-resistant cushions, it ensures lasting comfort in any weather. The sturdy powder-coated aluminium frame provides exceptional stability, while the 120cm square spray stone glass top fire pit dining table adds a touch of sophistication. Complete with a protective glass surround and lava rocks, this all-weather set offers easy-care convenience and timeless appeal for any outdoor space.\r\n', '295cm x 295cm', '', '', 'La Vita High-Performance Fabric', 'Powder-Coated Aluminium', 'Spray Stone Glass', 'Flanelle', 'Oatmeal', '', 'Maze-Pulse-Square-Corner-Dining-Set-Fire-Pit-Color-Flanelle.webp', 'Maze-Pulse-Square-Corner-Dining-Set-Fire-Pit-Color-Oatmeal.webp', '', '2025-11-11 11:06:54'),
(39, 'Justin 4 Seater Sofa', 49360.00, 116, 'Justin-Charcoal-4Seater-Sofa.jpg', 'Justin-Charcoal-4Seater-Sofa-Angle1.jpg', 'Justin-Charcoal-4Seater-Sofa-Angle2.jpg', 'Justin-Charcoal-4Seater-Sofa-Angle3.jpg', 'Justin-Charcoal-4Seater-Sofa-Angle4.jpg', 'Justin-Charcoal-4Seater-Sofa-Hover.jpg', 4, '', 16, '', 'The Justin 4 Seater Sofa is a traditional, compact, and stylish piece featuring a timeless design with chunky tapered arms and light stained, short mid-century modern legs; built for high comfort with a strong hardwood and OSB wooden frame, it boasts thick, plush foam seat cushions and a pinched fiber-filled backrest with traditional tufting, all upholstered in a durable, beautifully soft textured weave fabric available in a choice of calming neutral colors, and is backed by a 10-year manufacturer guarantee.', '89x220x80', '', '', 'Textured Weave Fabric', '', '', 'Oatmeal', 'Silver', 'Sage', 'Justin-Oatmeal-4Seater-Oatmeal.jpg', 'Justin-Silver-4Seater-Silver.jpg', 'Justin-4-Seater-Sage-Sage.jpg', '2025-11-11 11:14:01'),
(40, 'Birchley 4 Seater Sofa', 72055.00, 89, 'Birchley-Soft-Chenille-4-Seater-Sofa-Ice.jpg', 'Birchley-Soft-Chenille-4-Seater-Sofa-Ice-Angle1.jpg', 'Birchley-Soft-Chenille-Ice-Angle2.jpg', 'Birchley-Soft-Chenille-Ice-Angle3.jpg', 'Ice-Swatch-Angle4.jpg', 'Birchley-Soft-Chenille-4-Seater-Sofa-Ice-Hover.jpg', 4, '', 16, '', 'The Birchley 4-Seater Sofa is a fully assembled, made-to-order piece designed for larger living spaces, featuring a grand, expansive size with clean lines and a contemporary silhouette; built for supreme comfort and durability with a robust hardwood frame, it boasts generous removable foam seat cushions, fiber-filled back cushions, and matching scatter cushions, all upholstered in a velvety soft chenille fabric available in many sophisticated colors, and is finished with light wooden block feet that add a touch of natural warmth and elegance.', '98x296x92', '', '', 'Chenille Polyester Fabric', '', '', 'Linen', 'Mink', 'Heather', 'Birchley-Soft-Chenille-4-Seater-Sofa-Linen.jpg', 'Birchley-Soft-Chenille-4-Seater-Sofa-Mink.jpg', 'Birchley-Soft-Chenille-4-Seater-Sofa-Heather.jpg', '2025-11-11 11:28:41'),
(41, 'Flower Vase Cylinder', 240.00, 255, 'FLOWER_VASE_CYLINDER.png', 'FLOWER_VASE_CYLINDER_Angle1.png', 'FLOWER_VASE_CYLINDER_Angle2.png', 'FLOWER_VASE_CYLINDER_Angle3.png', 'FLOWER_VASE_CYLINDER_Angle4.png', 'FLOWER_VASE_CYLINDER_Hover.jpg', 5, '', 22, '', 'This versatile and beautifully crafted clear glass cylinder vase is an essential piece for any home or event, perfect for showcasing floral arrangements, decorative fillers, or pillar candles.\r\n\r\nCrafted from quality glass, this vase is designed for both beauty and practicality, providing a stable base and ample height for a variety of decorative purposes.', '9 x 9 x 20', '', '', 'Glass', '', '', 'Clear', '', '', 'FLOWER_VASE_CYLINDER_Clear.png', '', '', '2025-11-11 11:33:38'),
(42, 'Sword Grass in Cement Pot', 719.00, 200, 'SWORD_GRASS_IN_CEMENT_POT.png', 'SWORD_GRASS_IN_CEMENT_POT_Angle1.png', 'SWORD_GRASS_IN_CEMENT_POT_Angle2.png', 'SWORD_GRASS_IN_CEMENT_POT_Angle3.png', 'SWORD_GRASS_IN_CEMENT_POT_Angle4.png', 'SWORD_GRASS_IN_CEMENT_POT_Hover.png', 5, '', 22, '', 'Bring a touch of maintenance-free greenery into your space with this charming artificial Sword Grass plant. The realistic foliage features spiky leaves in vibrant shades of green and subtle rustic orange/brown tips. The plant is set in a small, stylish white cement pot with an attractive black marble-like veining pattern, finished with small decorative pebbles around the base. This compact, decorative piece is perfect for desks, shelves, or small accent tables, instantly adding texture and color without the need for watering.', '16x16x23', '', '', 'Polyethylene Cement', '', '', 'White', '', '', 'SWORD_GRASS_IN_CEMENT_POT_White.png', '', '', '2025-11-11 11:43:16');

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
  ADD KEY `sub_id` (`sub_id`);

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `sub_category` (`sub_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

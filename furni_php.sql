-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 08:34 AM
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
-- Database: `furni_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_cat` int(100) NOT NULL,
  `name_cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_cat`, `name_cat`) VALUES
(1, 'Armchair'),
(2, 'Chair'),
(3, 'Couch'),
(4, 'Shelf'),
(5, 'Table'),
(6, 'Wardrobe');

-- --------------------------------------------------------

--
-- Table structure for table `cat_img`
--

CREATE TABLE `cat_img` (
  `id_ci` int(100) NOT NULL,
  `id_cat` int(100) NOT NULL,
  `id_image` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cat_img`
--

INSERT INTO `cat_img` (`id_ci`, `id_cat`, `id_image`) VALUES
(1, 1, 56),
(2, 2, 57),
(3, 3, 58),
(4, 4, 59),
(5, 5, 60),
(6, 6, 61);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id_city` int(100) NOT NULL,
  `name_city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id_city`, `name_city`) VALUES
(32, 'Albuquerque'),
(48, 'Arlington'),
(38, 'Atlanta'),
(11, 'Austin'),
(30, 'Baltimore'),
(21, 'Boston'),
(15, 'Charlotte'),
(3, 'Chicago'),
(49, 'Cleveland'),
(14, 'Columbus'),
(9, 'Dallas'),
(19, 'Denver'),
(24, 'Detroit'),
(22, 'El Paso'),
(13, 'Fort Worth'),
(34, 'Fresno'),
(4, 'Houston'),
(17, 'Indianapolis'),
(12, 'Jacksonville'),
(37, 'Kansas City'),
(27, 'Las Vegas'),
(39, 'Long Beach'),
(2, 'Los Angeles'),
(29, 'Louisville'),
(28, 'Memphis'),
(36, 'Mesa'),
(42, 'Miami'),
(31, 'Milwaukee'),
(44, 'Minneapolis'),
(23, 'Nashville'),
(47, 'New Orleans'),
(1, 'New York City'),
(43, 'Oakland'),
(25, 'Oklahoma City'),
(40, 'Omaha'),
(6, 'Philadelphia'),
(5, 'Phoenix'),
(26, 'Portland'),
(41, 'Raleigh'),
(35, 'Sacramento'),
(7, 'San Antonio'),
(8, 'San Diego'),
(16, 'San Francisco'),
(10, 'San Jose'),
(18, 'Seattle'),
(50, 'Tampa'),
(33, 'Tucson'),
(45, 'Tulsa'),
(20, 'Washington'),
(46, 'Wichita');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id_color` int(100) NOT NULL,
  `name_color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id_color`, `name_color`) VALUES
(7, 'Black'),
(3, 'Blue'),
(1, 'Brown'),
(8, 'Deep Blue'),
(14, 'Deep Brown'),
(12, 'Deep Gray'),
(11, 'Deep Green'),
(13, 'Deep Orange'),
(9, 'Gray'),
(10, 'Multicolor'),
(2, 'Orange'),
(6, 'Pink'),
(5, 'White'),
(4, 'Yellow');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id_image` int(255) NOT NULL,
  `name_image` varchar(255) NOT NULL,
  `path_image` varchar(255) NOT NULL,
  `date_upload_image` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id_image`, `name_image`, `path_image`, `date_upload_image`) VALUES
(1, 'Elegance Luxe', 'assets/images/armchair/1x/Elegance Luxe.png', '2024-05-09 21:50:11'),
(2, 'random-armchair', 'assets/images/armchair/1x/random-armchair.jpeg', '2024-05-09 21:52:50'),
(3, 'Velvet Vista', 'assets/images/armchair/1x/Velvet Vista.png', '2024-03-12 16:02:07'),
(4, 'Serenity Sculpt', 'assets/images/armchair/1x/Serenity Sculpt.png', '2024-03-12 16:02:07'),
(5, 'Opulent Oasis', 'assets/images/armchair/1x/Opulent Oasis.png', '2024-03-12 16:02:07'),
(6, 'Tranquil Tides - White', 'assets/images/armchair/1x/Tranquil Tides White.png', '2024-03-12 16:02:07'),
(7, 'Tranquil Tides - Blue', 'assets/images/armchair/1x/Tranquil Tides Blue.png', '2024-03-12 16:02:07'),
(8, 'Tranquil Tides - Pink', 'assets/images/armchair/1x/Tranquil Tides Pink.png', '2024-03-12 16:02:07'),
(10, 'Luna Loom', 'assets/images/chair/1x/Luna Loom.png', '2024-03-12 16:02:07'),
(11, 'Refined Radiance', 'assets/images/chair/1x/Refined Radiance.png', '2024-03-12 16:02:07'),
(12, 'Graceful Grove', 'assets/images/chair/1x/Graceful Grove.png', '2024-03-12 16:02:07'),
(13, 'Essence Eclipse', 'assets/images/chair/1x/Essence Eclipse.png', '2024-03-12 16:02:07'),
(14, 'Symphony Seating', 'assets/images/chair/1x/Symphony Seating.png', '2024-03-12 16:02:07'),
(15, 'Urban Utopia', 'assets/images/chair/1x/Urban Utopia.png', '2024-03-12 16:02:07'),
(16, 'Zenith Zen', 'assets/images/chair/1x/Zenith Zen.png', '2024-03-12 16:02:07'),
(17, 'Coastal Crest', 'assets/images/chair/1x/Coastal Crest.png', '2024-03-12 16:02:07'),
(18, 'Upper Town', 'assets/images/chair/1x/Upper Town.png', '2024-03-12 16:02:07'),
(19, 'Luxe Lounge', 'assets/images/couch/1x/Luxe Lounge.png', '2024-03-12 16:02:07'),
(20, 'Serene Sway', 'assets/images/couch/1x/Serene Sway.png', '2024-03-12 16:02:07'),
(21, 'Urban Bedtopia', 'assets/images/couch/1x/Urban Bedtopia.png', '2024-03-12 16:02:07'),
(22, 'Bliss Burst', 'assets/images/couch/1x/Bliss Burst.png', '2024-03-12 16:02:07'),
(23, 'Stellar Stream', 'assets/images/couch/1x/Stellar Stream.png', '2024-03-12 16:02:07'),
(24, 'Cosmo Craze', 'assets/images/couch/1x/Cosmo Craze.png', '2024-03-12 16:02:07'),
(25, 'Haven Hues', 'assets/images/couch/1x/Haven Hues.png', '2024-03-12 16:02:07'),
(26, 'Picosa Picasa', 'assets/images/couch/1x/Picosa Picasa.png', '2024-03-12 16:02:07'),
(27, 'Buffalo', 'assets/images/couch/1x/Buffalo.png', '2024-03-12 16:02:07'),
(28, 'Vintage Woodcraft', 'assets/images/shelf/1x/Vintage Woodcraft.png', '2024-03-12 16:02:07'),
(29, 'Modern Minimalist Shelf', 'assets/images/shelf/1x/Modern Minimalist Shelf.png', '2024-03-12 16:02:07'),
(30, 'Dragon Bianco', 'assets/images/shelf/1x/Dragon Bianco.png', '2024-03-12 16:02:07'),
(31, 'Artisanal Essence', 'assets/images/shelf/1x/Artisanal Essence.png', '2024-03-12 16:02:07'),
(32, 'Metropolitan Muse', 'assets/images/shelf/1x/Metropolitan Muse.png', '2024-03-12 16:02:07'),
(33, 'Contemporary Charm', 'assets/images/shelf/1x/Contemporary Charm.png', '2024-03-12 16:02:07'),
(34, 'Bohemian Bliss', 'assets/images/shelf/1x/Bohemian Bliss.png', '2024-03-12 16:02:07'),
(35, 'Zen Harmony', 'assets/images/shelf/1x/Zen Harmony.png', '2024-03-12 16:02:07'),
(36, 'Regal Oak Dining', 'assets/images/table/1x/Regal Oak Dining.png', '2024-03-12 16:02:07'),
(37, 'Zenith Marble Coffee', 'assets/images/table/1x/Zenith Marble Coffee.png', '2024-03-12 16:02:07'),
(38, 'Coastal Breeze', 'assets/images/table/1x/Coastal Breeze.png', '2024-03-12 16:02:07'),
(39, 'Metropolitan Extendable', 'assets/images/table/1x/Metropolitan Extendable.png', '2024-03-12 16:02:07'),
(40, 'Artisanal Craftsman', 'assets/images/table/1x/Artisanal Craftsman.png', '2024-03-12 16:02:07'),
(41, 'Artisanal Craftsman Mini', 'assets/images/table/1x/Artisanal Craftsman Mini.png', '2024-03-12 16:02:07'),
(42, 'Vintage Vineyard Side', 'assets/images/table/1x/Vintage Vineyard Side.png', '2024-03-12 16:02:07'),
(43, 'Nordic Elegance End', 'assets/images/table/1x/Nordic Elegance End.png', '2024-03-12 16:02:07'),
(44, 'Harmony Glass-Top', 'assets/images/table/1x/Harmony Glass-Top.png', '2024-03-12 16:02:07'),
(45, 'Sleek Urban Bar', 'assets/images/table/1x/Sleek Urban Bar.png', '2024-03-12 16:02:07'),
(46, 'Farmhouse Fusion Dining', 'assets/images/table/1x/Farmhouse Fusion Dining.png', '2024-03-12 16:02:07'),
(47, 'Versatile Veneer Study', 'assets/images/table/1x/Versatile Veneer Study.png', '2024-03-12 16:02:07'),
(48, 'Majestic Maple', 'assets/images/wardrobe/1x/Majestic Maple.png', '2024-03-12 16:02:07'),
(50, 'Aurora Mirrored', 'assets/images/wardrobe/1x/Aurora Mirrored.png', '2024-03-12 16:02:07'),
(51, 'Urban Loft Sliding Closet', 'assets/images/wardrobe/1x/Urban Loft Sliding Closet.png', '2024-03-12 16:02:07'),
(52, 'Renaissance Oak', 'assets/images/wardrobe/1x/Renaissance Oak.png', '2024-03-12 16:02:07'),
(53, 'Zen Zenith', 'assets/images/wardrobe/1x/Zen Zenith.png', '2024-03-12 16:02:07'),
(54, 'Nordic Elegance', 'assets/images/wardrobe/1x/Nordic Elegance.png', '2024-03-12 16:02:07'),
(55, 'Vintage Vogue', 'assets/images/wardrobe/1x/Vintage Vogue.png', '2024-03-12 16:02:07'),
(56, 'Armchair Category', 'assets/images/armchair/SVG/armchair2-cat.svg', '2024-04-04 21:11:29'),
(57, 'Chair Category', 'assets/images/chair/SVG/chair2-cat.svg', '2024-04-04 21:11:29'),
(58, 'Couch Category', 'assets/images/couch/SVG/couch2-cat.svg', '2024-04-04 21:11:29'),
(59, 'Shelf Category', 'assets/images/shelf/SVG/shelf2-cat.svg', '2024-04-04 21:11:29'),
(60, 'Table Category', 'assets/images/table/SVG/table2-cat.svg', '2024-04-04 21:11:29'),
(61, 'Wardrobe Category', 'assets/images/wardrobe/SVG/wardrobe2-cat.svg', '2024-04-04 21:11:29'),
(65, 'kevin-thomas', 'assets/images/profile/kevin-thomas.jpg', '2024-05-06 20:06:10'),
(82, 'aleksa-subasic', 'assets/images/profile/aleksa-subasic.png', '2024-05-09 19:35:13'),
(83, 'Cosmo Comfort 2', 'assets/images/armchair/1x/Cosmo Comfort 2.png', '2024-05-10 13:27:00'),
(84, 'Harmony Haven', 'assets/images/armchair/1x/Harmony Haven.png', '2024-05-10 13:29:54'),
(85, 'Royal Furni - Gold', 'assets/images/armchair/1x/Royal Furni - Gold.png', '2024-05-10 16:41:01'),
(86, 'Royal Furni - Red_Gold', 'assets/images/armchair/1x/Royal Furni - Red_Gold.png', '2024-05-10 16:54:21'),
(87, 'Elezia - Green', 'assets/images/chair/1x/Elezia - Green.png', '2024-05-10 16:57:07'),
(88, 'programmer', 'assets/images/profile/programmer.png', '2025-03-08 06:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_msg` int(100) NOT NULL,
  `fn_msg` varchar(255) NOT NULL,
  `ln_msg` varchar(255) NOT NULL,
  `email_msg` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_msg`, `fn_msg`, `ln_msg`, `email_msg`, `msg`) VALUES
(1, 'John', 'Doe', 'johndoe@example.com', 'This is a test message created from DB.'),
(2, 'Aleksa', 'Subasic', 'subasicaleksa@gmail.com', 'Lorem ipsum test test test 13'),
(3, 'Pera', 'Peric', 'pera.peric@gmail.com', 'Iskreno nije los sajt, ali moze to bolje kolega.'),
(4, 'Aleksa', 'Subasic', 'subasicaleksa@gmail.com', 'Test 123 123 123');

-- --------------------------------------------------------

--
-- Table structure for table `nav`
--

CREATE TABLE `nav` (
  `id_nav` int(100) NOT NULL,
  `name_nav` varchar(255) NOT NULL,
  `path_nav` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nav`
--

INSERT INTO `nav` (`id_nav`, `name_nav`, `path_nav`) VALUES
(1, 'Home', 'index.php'),
(2, 'Shop', 'shop.php'),
(3, 'About Us', 'about.php'),
(4, 'Services', 'services.php'),
(5, 'Contact Us', 'contact.php'),
(6, 'Admin Panel', 'adminPanel.php');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `total_price_customer` float NOT NULL DEFAULT 0,
  `status_order` varchar(20) NOT NULL DEFAULT 'pending',
  `created_at_customer` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at_customer` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `total_price_customer`, `status_order`, `created_at_customer`, `modified_at_customer`) VALUES
(4, 14, 444.35, 'completed', '2024-04-18 21:06:09', '2024-04-22 20:01:26'),
(5, 17, 244.97, 'completed', '2024-04-22 19:56:18', '2024-04-22 19:58:40'),
(6, 13, 1314.97, 'completed', '2024-04-24 22:03:15', '2024-04-24 22:03:35'),
(7, 13, 1514.96, 'completed', '2024-04-29 18:08:20', '2024-04-29 18:08:25'),
(8, 13, 414.97, 'completed', '2024-04-29 18:08:54', '2024-04-29 18:08:57'),
(9, 18, 1334.9, 'completed', '2024-05-13 23:43:22', '2024-05-13 23:44:16'),
(10, 13, 934.95, 'completed', '2024-05-15 15:05:46', '2024-05-15 22:25:04'),
(11, 13, 0, 'pending', '2024-05-15 22:26:19', '0000-00-00 00:00:00'),
(12, 18, 824.96, 'completed', '2024-05-16 17:07:03', '2024-05-16 17:07:16'),
(13, 20, 249.97, 'completed', '2025-02-27 14:39:03', '2025-02-27 10:09:45'),
(14, 20, 1914.89, 'completed', '2025-02-27 14:41:45', '2025-02-27 10:11:54'),
(15, 20, 249.97, 'completed', '2025-03-08 06:45:36', '2025-03-08 02:15:49'),
(16, 20, 0, 'rejected', '2025-03-08 06:45:59', '2025-03-08 06:56:00'),
(17, 20, 334.98, 'completed', '2025-03-08 06:56:35', '2025-03-08 02:26:40'),
(18, 20, 214.98, 'completed', '2025-03-08 06:56:45', '2025-03-08 02:26:52'),
(19, 20, 564.97, 'completed', '2025-03-08 07:07:23', '2025-03-08 02:43:17'),
(20, 20, 334.98, 'completed', '2025-03-08 07:15:35', '2025-03-08 02:45:38'),
(21, 20, 1494.96, 'rejected', '2025-03-08 07:21:29', '2025-03-08 07:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `id_o_item` int(100) NOT NULL,
  `id_order` int(100) NOT NULL,
  `id_product` int(100) NOT NULL,
  `quantity_o_item` int(100) NOT NULL DEFAULT 1,
  `subtotal_o_item` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`id_o_item`, `id_order`, `id_product`, `quantity_o_item`, `subtotal_o_item`) VALUES
(16, 5, 27, 1, 39.99),
(17, 5, 3, 1, 189.99),
(18, 4, 35, 1, 129.99),
(19, 4, 43, 3, 299.37),
(20, 6, 20, 2, 1299.98),
(21, 7, 19, 3, 1499.97),
(22, 8, 39, 2, 399.98),
(23, 9, 27, 3, 119.97),
(24, 9, 36, 1, 189.99),
(25, 9, 54, 2, 559.98),
(26, 9, 12, 1, 49.99),
(27, 9, 5, 2, 399.98),
(28, 10, 2, 2, 539.98),
(29, 10, 3, 2, 379.98),
(31, 11, 47, 1, 249.99),
(32, 11, 54, 1, 279.99),
(33, 11, 50, 2, 439.98),
(35, 12, 51, 3, 809.97),
(36, 13, 3, 1, 189.99),
(37, 13, 29, 1, 44.99),
(38, 14, 3, 10, 1899.9),
(39, 15, 3, 1, 189.99),
(40, 15, 29, 1, 44.99),
(41, 16, 2, 1, 269.99),
(42, 17, 4, 1, 319.99),
(43, 18, 5, 1, 199.99),
(44, 19, 2, 1, 269.99),
(45, 19, 54, 1, 279.99),
(46, 20, 4, 1, 319.99),
(47, 21, 39, 1, 199.99),
(48, 21, 54, 1, 279.99),
(49, 21, 65, 1, 999.99);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(100) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `desc_product` varchar(255) NOT NULL,
  `price_product` float NOT NULL,
  `availability_product` int(255) NOT NULL,
  `created_at_p` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at_p` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_cat` int(100) NOT NULL,
  `id_color` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name_product`, `desc_product`, `price_product`, `availability_product`, `created_at_p`, `modified_at_p`, `id_cat`, `id_color`) VALUES
(1, 'Cosmo Comfort 2', 'Introducing the Cosmo Comfort Couch - a stylish retreat for your living space. With plush upholstery, modern elegance, and cozy seating, this couch offers a perfect blend of comfort and sophistication.', 249.99, 15, '2024-03-02 17:55:31', '2024-05-09 18:58:45', 1, 4),
(2, 'Elegance Luxe', 'Indulge in the epitome of sophistication with our Elegance Luxe Armchair. Crafted with meticulous attention to detail, this armchair seamlessly blends luxury and comfort, elevating the ambiance of any space.', 269.99, 8, '2024-03-02 18:24:51', '2024-05-09 21:50:11', 1, 1),
(3, 'Harmony Haven', 'Harmony Haven Armchair in captivating orange exudes warmth and style, creating a cozy haven in your space. With its inviting design and comfort, this armchair brings both aesthetic appeal and relaxation.', 189.99, 25, '2024-03-02 18:24:51', '2024-05-09 21:50:44', 1, 2),
(4, 'Opulent Oasis', 'Opulent Oasis in White: This standard armchair is a beacon of comfort and style, offering a timeless design that enhances the ambiance of any space with its elegant charm.', 319.99, 5, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 1, 5),
(5, 'Serenity Sculpt', 'Inspired by graceful curvy lines, this armchair radiates a sense of serenity. The yellow color adds vibrancy, making it a stylish and comfortable accent piece for any contemporary space.', 199.99, 25, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 1, 4),
(6, 'Tranquil Tides - Blue', 'Dive into relaxation with Tranquil Tides Blue. Its calming blue hue and ergonomic design create a serene escape, making it perfect for moments of unwinding.', 149.99, 10, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 1, 8),
(7, 'Tranquil Tides - Pink', 'Experience blissful comfort with Tranquil Tides Pink. The playful pink hue adds a touch of joy, turning your space into a lively retreat that combines style with a cozy atmosphere.', 149.99, 15, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 1, 6),
(8, 'Tranquil Tides - White', 'Embrace tranquility with Tranquil Tides White. The pristine white exudes sophistication, offering a minimalist haven for your space, where comfort meets timeless elegance.', 149.99, 5, '2024-03-02 18:24:51', '2024-05-08 22:08:39', 1, 5),
(9, 'Velvet Vista', 'Elevate your lounging experience with this exquisite piece that seamlessly combines style and coziness, making every moment a luxurious retreat.', 279.99, 7, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 1, 8),
(10, 'Coastal Crest', 'It\'a bar chair, what did you expect?', 79.49, 13, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 2, 7),
(11, 'Essence Eclipse', 'Kitchen/Dinning chair.', 39.99, 20, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 2, 4),
(12, 'Graceful Grove', 'The curves and high-quality materials make these chairs a perfect addition to any refined interior.', 49.99, 25, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 2, 9),
(13, 'Luna Loom', 'Luna Loom chairs redefine contemporary comfort with their innovative design and ergonomic structure. Crafted for both style and relaxation, these chairs bring a touch of modern artistry to your living space', 95.89, 10, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 2, 12),
(14, 'Refined Radiance', 'Outdoor seating solution that seamlessly combines elegance and durability. Designed to withstand the elements, this chair invites you to embrace the beauty of nature.', 84.89, 9, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 2, 5),
(15, 'Symphony Seating', 'Kitchen/Dinning chair.', 124.49, 0, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 2, 7),
(16, 'Upper Town', 'It\'a bar chair number 2, what did you expect?', 39.99, 15, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 2, 4),
(17, 'Urban Utopia', 'Contemporary chair that harmoniously blends natural elements with modern design. Crafted from quality wood and adorned with chic fabric.', 84.99, 0, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 2, 8),
(18, 'Zenith Zen', 'Kitchen/Dinning chair.', 24.99, 45, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 2, 4),
(19, 'Bliss Burst', 'Indulge in the luxurious comfort of the Deep Green Elegance couch. Crafted with fine fabric and featuring a deep green hue, this couch exudes sophistication.', 499.99, 14, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 3, 11),
(20, 'Buffalo', 'Experience the rustic charm of the Buffalo Brown bed, designed for the living room. Its warm brown hue and sturdy metal construction bring a touch of coziness and durability to your space, creating an inviting atmosphere for relaxation and rest.', 649.99, 5, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 3, 1),
(21, 'Cosmo Craze', 'Indulge in the luxury of the Cosmo Craze premium bed, designed to elevate your living room with a touch of vintage style. The sophisticated gray color adds a sense of modern elegance, while the premium craftsmanship ensures both comfort and durability.', 799.99, 5, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 3, 9),
(22, 'Luxe Lounge', 'Experience the epitome of comfort and style with the Luxe Lounge spacious bed, a fusion of 70s futuristic design and modern elegance. The multicolor palette adds a vibrant touch to your living room, while the sleek metal construction ensures durability.', 899.99, 15, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 3, 10),
(23, 'Picosa Picasa', 'Indulge in the opulence of the Picosa Picasa premium bed, an embodiment of vintage Spanish style. The rich multicolor palette of red, brown, and golden hues exudes warmth and sophistication, adding a touch of timeless elegance to your living room.', 749.99, 3, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 3, 10),
(24, 'Serene Sway', 'Indulge in the luxurious comfort of the Deep Green Elegance couch. Crafted with fine fabric and featuring a deep green hue, this couch exudes sophistication.', 629.79, 13, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 3, 11),
(25, 'Stellar Stream', 'Indulge in the luxury of the Stellar Stream, designed to elevate your living room with a touch of vintage style. The sophisticated gray color adds a sense of modern elegance, while the premium craftsmanship ensures both comfort and durability.', 549.99, 7, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 3, 9),
(26, 'Urban Bedtopia', 'Adorned in a pristine white hue, brings a sense of tranquility to your living room. Embrace simplicity and style as you unwind in this sleek and sophisticated addition to your home.', 679.49, 50, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 3, 5),
(27, 'Artisanal Essence', 'A classic choice for organizing your cherished books.', 39.99, 15, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 4, 1),
(28, 'Bohemian Bliss', 'Inspired by a ladder, it blends utility with style, offering a unique storage solution for your cherished belongings.', 55.79, 12, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 4, 5),
(29, 'Contemporary Charm', 'Crafted with a fusion of warm wood and sleek golden metal, it exudes modern sophistication. This versatile piece not only serves as a functional storage solution but also adds a touch of contemporary elegance to your surroundings.', 44.99, 5, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 4, 10),
(30, 'Dragon Bianco', 'Dragon Bianco, a distinctive bookshelf in rich brown. Inspired by the mythical dragon, this piece combines fantasy and function.', 29.59, 9, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 4, 14),
(31, 'Metropolitan Muse', 'A classic choice for organizing your cherished books.', 69.95, 16, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 4, 14),
(32, 'Modern Minimalist Shelf', ' With a rich brown wood finish, this shelf seamlessly blends into any modern decor.', 49.79, 55, '2024-03-02 18:24:51', '0000-00-00 00:00:00', 4, 1),
(33, 'Vintage Woodcraft', 'A classic choice for organizing your cherished books in vintage style.', 34.99, 5, '2024-03-02 18:37:54', '0000-00-00 00:00:00', 4, 14),
(34, 'Zen Harmony', 'A classic choice for organizing your cherished books in zen-japanese style.', 59.89, 15, '2024-03-02 18:37:54', '0000-00-00 00:00:00', 4, 4),
(35, 'Artisanal Craftsman Mini', 'Meet the Artisanal Craftsman Mini Table, an exquisite blend of craftsmanship and style. The sleek black color adds a touch of sophistication to any room, while the hourglass-inspired stand enhances its unique charm.', 129.99, 13, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 7),
(36, 'Artisanal Craftsman', 'Big Brother of the Artisanal Craftsman Mini Table but in brown color.', 189.99, 14, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 1),
(37, 'Coastal Breeze', 'Ride the wave of style with Coastal Breeze – a spacious low table inspired by the freedom and flow of surfing. With its brown wood color, this table captures the essence of coastal living, creating a relaxed and inviting atmosphere in your home.', 89.99, 8, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 1),
(38, 'Farmhouse Fusion Dining', 'Simple dining table for kitchen.', 59.99, 5, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 1),
(39, 'Harmony Glass - Top', 'Crafted with precision using metal and featuring a sleek glass top, this premium table brings a touch of sophistication to any space.', 199.99, 25, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 5),
(40, 'Metropolitan Extendable', 'Experience the perfect fusion of style and functionality with the Metropolitan Extendable Dining Table. This versatile piece allows you to adapt to various occasions with its extendable design, ensuring you\'re always ready to accommodate guests.', 119.99, 7, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 10),
(41, 'Nordic Elegance End', 'The deep brown color exudes warmth, while its design pays homage to Nordic simplicity.', 169.99, 15, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 14),
(42, 'Regal Oak Dining', 'A stunning centerpiece for your dining space. Crafted with regal elegance and a rich oak finish, this table brings a touch of sophistication to your dining experience.', 139.89, 7, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 14),
(43, 'Sleek Urban Bar', 'A low coffee table that exudes modernity and style. Crafted for both aesthetics and functionality, this table adds a touch of urban sophistication to your space.', 99.79, 32, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 10),
(44, 'Versatile Veneer Study', 'Create a cozy and functional haven in your bedroom with this versatile table. Ideal for reading, drawing, or studying, its compact design makes it a perfect fit for your personal space.', 49.99, 50, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 5),
(45, 'Vintage Vineyard Side', 'Transform your outdoor space with the Vintage Vineyard Side Table – a perfect blend of functionality and Italian-inspired charm. Crafted with a vintage touch.', 189.99, 13, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 14),
(46, 'Zenith Marble Coffee', 'The sleek black base, coupled with a glass top, creates a luxurious and sophisticated aesthetic.', 159.49, 15, '2024-03-02 18:45:32', '0000-00-00 00:00:00', 5, 7),
(47, 'Aurora Mirrored', 'Elevate your bedroom with the Aurora Mirrored Wardrobe, a stunning blend of metal, glass, and wood. This wardrobe not only offers ample storage space but also adds a touch of modern elegance to your room.', 249.99, 13, '2024-03-02 18:49:34', '0000-00-00 00:00:00', 6, 5),
(48, 'Coastal Charm 2', 'Embrace the allure of Greece with the Coastal Charm furniture collection. Inspired by the coastal beauty of Greece, this collection features elegant designs and a serene color palette.', 189.99, 12, '2024-03-02 18:49:34', '2024-05-09 19:28:35', 6, 10),
(49, 'Majestic Maple', 'Majestic Maple, a simple wood wardrobe in a brown color, combines functionality with timeless design.', 299.99, 11, '2024-03-02 18:49:34', '0000-00-00 00:00:00', 6, 1),
(50, 'Nordic Elegance', 'Nordic Elegance, inspired by Nordic design principles, features a harmonious blend of black and silver metals. This wardrobe embodies simplicity and functionality, bringing a touch of Scandinavian elegance to your living space.', 219.99, 9, '2024-03-02 18:49:34', '0000-00-00 00:00:00', 6, 7),
(51, 'Renaissance Oak', 'Renaissance Oak, a simple wood wardrobe in a deep brown color, combines functionality with timeless design.', 269.99, 8, '2024-03-02 18:49:34', '0000-00-00 00:00:00', 6, 14),
(52, 'Urban Loft Sliding Closet', 'Urban Loft Sliding Closet combines urban sophistication with practical design. Crafted from sturdy wood, its sliding doors feature elegant white transparent glass, adding a contemporary touch to your bedroom.', 349.79, 6, '2024-03-02 18:49:34', '0000-00-00 00:00:00', 6, 10),
(53, 'Vintage Vogue', 'Vintage Vogue seamlessly blends the charm of a vintage 50s era with modern functionality. This wardrobe, with its timeless design and intricate details, adds a touch of vintage elegance to your space.', 199.89, 4, '2024-03-02 18:49:34', '0000-00-00 00:00:00', 6, 10),
(54, 'Zen Zenith', 'Zen Zenith brings the tranquility of Zen philosophy into your living space. Crafted from quality wood, this wardrobe combines minimalist design with functional excellence.', 279.99, 10, '2024-03-02 18:49:34', '0000-00-00 00:00:00', 6, 7),
(57, 'Novi Proizvod', 'Novi Proizvod 3 desc', 124.99, 15, '2024-03-13 00:38:51', '2024-05-09 21:45:06', 1, 1),
(62, 'Novi Proizvod Harmony', 'Novi Proizvod Harmony 9/3 desc', 123, 12, '2024-03-13 00:55:19', '2024-05-10 13:29:54', 1, 2),
(65, 'Royal Furni - Gold', 'The Royal Armchair is a luxurious and elegant seating option featuring plush cushioning, ornate design, and rich upholstery. Its sturdy wooden frame and intricate detailing make it a standout piece in any room.', 999.99, 25, '2024-05-10 16:41:01', '0000-00-00 00:00:00', 1, 4),
(66, 'Royal Furni - Red/Gold', 'The Royal Armchair is a luxurious and elegant seating option featuring plush cushioning, ornate design, and rich upholstery. Its sturdy wooden frame and intricate detailing make it a standout piece in any room.', 999.99, 25, '2024-05-10 16:54:21', '0000-00-00 00:00:00', 1, 10),
(67, 'Elezia - Green', 'Elezia combines sleek design with exceptional craftsmanship. Its minimalist silhouette, premium materials, and ergonomic construction offer unparalleled comfort and style.', 239.99, 17, '2024-05-10 16:57:07', '0000-00-00 00:00:00', 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `prod_img`
--

CREATE TABLE `prod_img` (
  `id_pi` int(100) NOT NULL,
  `id_product` int(100) NOT NULL,
  `id_image` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prod_img`
--

INSERT INTO `prod_img` (`id_pi`, `id_product`, `id_image`) VALUES
(1, 36, 40),
(2, 35, 41),
(3, 27, 31),
(4, 47, 50),
(5, 19, 22),
(6, 28, 34),
(7, 20, 27),
(8, 37, 38),
(10, 10, 17),
(11, 29, 33),
(13, 21, 24),
(14, 30, 30),
(15, 2, 1),
(16, 11, 13),
(17, 38, 46),
(18, 12, 12),
(19, 39, 44),
(20, 3, 84),
(21, 13, 10),
(22, 22, 19),
(23, 49, 48),
(24, 40, 39),
(25, 31, 32),
(26, 32, 29),
(27, 50, 54),
(28, 41, 43),
(29, 4, 5),
(30, 23, 26),
(31, 14, 11),
(32, 42, 36),
(33, 51, 52),
(34, 24, 20),
(35, 5, 4),
(36, 43, 45),
(37, 25, 23),
(38, 15, 14),
(39, 6, 7),
(40, 7, 8),
(41, 8, 6),
(42, 16, 18),
(43, 26, 21),
(44, 52, 51),
(45, 17, 15),
(46, 9, 3),
(47, 44, 47),
(48, 45, 42),
(49, 53, 55),
(50, 33, 28),
(51, 34, 35),
(52, 46, 37),
(53, 18, 16),
(54, 54, 53),
(57, 57, 1),
(58, 62, 84),
(61, 65, 85),
(62, 66, 86),
(63, 67, 87);

-- --------------------------------------------------------

--
-- Table structure for table `role_nav`
--

CREATE TABLE `role_nav` (
  `id_rn` int(100) NOT NULL,
  `id_nav` int(100) NOT NULL,
  `id_role` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_nav`
--

INSERT INTO `role_nav` (`id_rn`, `id_nav`, `id_role`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2),
(5, 5, 2),
(6, 1, 1),
(7, 2, 1),
(8, 3, 1),
(9, 4, 1),
(10, 5, 1),
(11, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `fn_user` varchar(255) NOT NULL,
  `ln_user` varchar(255) NOT NULL,
  `username_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `pass_user` varchar(255) NOT NULL,
  `address_user` varchar(255) NOT NULL,
  `phone_user` varchar(255) NOT NULL,
  `id_city` int(100) NOT NULL,
  `id_role` int(100) NOT NULL,
  `created_at_user` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at_user` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fn_user`, `ln_user`, `username_user`, `email_user`, `pass_user`, `address_user`, `phone_user`, `id_city`, `id_role`, `created_at_user`, `modified_at_user`) VALUES
(10, 'Test', 'Testovic', 'test.242', 'test.test@gmail.com', '$2y$10$DrPcpe7yizMc6jXadxdNFe4FQS6gSPA.Fog14bdFoRKj.iUX8KX6e', 'Test Ulica 12', '1+123-111-2222', 32, 2, '2024-03-11 21:20:42', '0000-00-00 00:00:00'),
(11, 'Admin', 'Admin', 'root.admin', 'admin@example.com', '$2y$10$razmbBJClR/rehnoQ94DiuWC8u9aFRujBJrWbrAlLVLoGPToRSx5O', '456 Park Avenue, New York', '1+000-000-0000', 1, 1, '2024-03-11 23:47:31', '0000-00-00 00:00:00'),
(12, 'John', 'Doe', 'john.doe', 'john.doe@gmail.com', '$2y$10$Ik4GUvUMD/eJOrKLKMYjQORtZCnDuZRtbSF8Qy3JCFKxhugSzwhRa', '457 Park Avenue, New York', '1+111-111-1111', 1, 2, '2024-03-11 23:54:27', '0000-00-00 00:00:00'),
(13, 'Aleksa', 'Subasic', 'aleksa.subasic', 'aleksa.subasic@gmail.com', '$2y$10$7/wyInZYSzDzeF8muwRto.MT.rPfv/r..WFMq94P/trFevMj23yMm', '5h Avenue, New York', '1+062-490-9545', 1, 2, '2024-03-13 15:22:26', '2024-05-09 19:35:13'),
(14, 'Kevin', 'Thomas', 'kevin.thomas', 'kevin.thomas@gmail.com', '$2y$10$YFtcjL1RycZNp8HmjLwXT.yHQ.3hSFrnS2YK8BwpFluuySSF.tYQG', '6010 Park Manor Dr, Texas', '1+123-123-2222', 9, 2, '2024-04-18 18:12:08', '0000-00-00 00:00:00'),
(15, 'Sarah', 'Mills', 'sarah.mills', 'sarah.mills@gmail.com', '$2y$10$GZgwmF04XvWib9vkkKaLpOLmQiAC/NgcLGK3Gj/N.evcQY7vm12K6', '7827 N Paw Paw Pike, Indiana', '1+123-124-2222', 19, 2, '2024-04-18 18:13:50', '0000-00-00 00:00:00'),
(16, 'Dillon', 'Grant', 'dillon.grant', 'dillon.grant@gmail.com', '$2y$10$5fllt2zgx2736hrmm/T5OOkopvQczHA7UEcn3GPC/suaHhP4Ii3DO', '5304 Hartwick Rd, Texas', '1+123-125-2222', 4, 2, '2024-04-18 18:15:33', '0000-00-00 00:00:00'),
(17, 'Alicia', 'Adams', 'alicia.adams', 'alicia.adams@yahoo.com', '$2y$10$86.yaTlgSDxM.TgbIia64.aEaGCRo3NhJfZIigJwBkj13Cs8LijrK', '5304 Hartwick Rd, Texas', '1+123-126-2222', 4, 2, '2024-04-18 18:17:02', '0000-00-00 00:00:00'),
(18, 'Dummy', 'Dum', 'dummy123', 'dummy@gmail.com', '$2y$10$dirh5Ehcfv9Npfmt964kCOozTpAq7Gl3Esti2BRbnNNsKkudNl/HC', 'Dummy Street', '+1-123-321-1234', 32, 2, '2024-05-13 23:37:21', '0000-00-00 00:00:00'),
(19, 'Nick', 'Lucas', 'nick.lucas', 'nick.lucas@live.com', '$2y$10$kFojdKVxDwvktsY79K7uIO7TKV8V7QZC8oVk9txtA2V/xKyAF.Thi', 'Atlanta Street 7', '+1-998-763-0894', 38, 2, '2024-05-17 10:58:50', '0000-00-00 00:00:00'),
(20, 'Varun', 'Dhavan', 'Varun123', 'test@gmail.com', '$2y$10$razmbBJClR/rehnoQ94DiuWC8u9aFRujBJrWbrAlLVLoGPToRSx5O', 'airoli', '+1-789-789-4561', 1, 2, '2025-02-27 14:27:00', '2025-03-08 02:27:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_img`
--

CREATE TABLE `user_img` (
  `id_user_img` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `id_image` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_img`
--

INSERT INTO `user_img` (`id_user_img`, `id_user`, `id_image`) VALUES
(2, 14, 65),
(15, 13, 82),
(16, 20, 88);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(100) NOT NULL,
  `name_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `name_role`) VALUES
(1, 'admin'),
(4, 'default'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_cat`),
  ADD UNIQUE KEY `name_cat` (`name_cat`);

--
-- Indexes for table `cat_img`
--
ALTER TABLE `cat_img`
  ADD PRIMARY KEY (`id_ci`),
  ADD KEY `id_cat` (`id_cat`),
  ADD KEY `id_image` (`id_image`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id_city`),
  ADD UNIQUE KEY `name_city` (`name_city`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id_color`),
  ADD UNIQUE KEY `name_color` (`name_color`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`),
  ADD UNIQUE KEY `name_image` (`name_image`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_msg`);

--
-- Indexes for table `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`id_nav`),
  ADD UNIQUE KEY `name_nav` (`name_nav`),
  ADD UNIQUE KEY `path_nav` (`path_nav`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_customer` (`id_user`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id_o_item`),
  ADD KEY `id_orders` (`id_order`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `name_product` (`name_product`),
  ADD KEY `id_cat` (`id_cat`),
  ADD KEY `id_color` (`id_color`);

--
-- Indexes for table `prod_img`
--
ALTER TABLE `prod_img`
  ADD PRIMARY KEY (`id_pi`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_image` (`id_image`);

--
-- Indexes for table `role_nav`
--
ALTER TABLE `role_nav`
  ADD PRIMARY KEY (`id_rn`),
  ADD KEY `id_nav` (`id_nav`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email_user` (`email_user`),
  ADD UNIQUE KEY `username_user` (`username_user`),
  ADD UNIQUE KEY `phone_user` (`phone_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_city` (`id_city`);

--
-- Indexes for table `user_img`
--
ALTER TABLE `user_img`
  ADD PRIMARY KEY (`id_user_img`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_img` (`id_image`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `name_role` (`name_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_cat` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cat_img`
--
ALTER TABLE `cat_img`
  MODIFY `id_ci` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id_city` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id_color` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_msg` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nav`
--
ALTER TABLE `nav`
  MODIFY `id_nav` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id_o_item` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `prod_img`
--
ALTER TABLE `prod_img`
  MODIFY `id_pi` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `role_nav`
--
ALTER TABLE `role_nav`
  MODIFY `id_rn` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_img`
--
ALTER TABLE `user_img`
  MODIFY `id_user_img` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cat_img`
--
ALTER TABLE `cat_img`
  ADD CONSTRAINT `cat_img_ibfk_1` FOREIGN KEY (`id_image`) REFERENCES `image` (`id_image`),
  ADD CONSTRAINT `cat_img_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id_cat`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD CONSTRAINT `orders_item_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_item_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`id_color`) REFERENCES `color` (`id_color`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prod_img`
--
ALTER TABLE `prod_img`
  ADD CONSTRAINT `prod_img_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_img_ibfk_2` FOREIGN KEY (`id_image`) REFERENCES `image` (`id_image`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_nav`
--
ALTER TABLE `role_nav`
  ADD CONSTRAINT `role_nav_ibfk_1` FOREIGN KEY (`id_nav`) REFERENCES `nav` (`id_nav`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_nav_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_city`) REFERENCES `city` (`id_city`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_img`
--
ALTER TABLE `user_img`
  ADD CONSTRAINT `user_img_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_img_ibfk_2` FOREIGN KEY (`id_image`) REFERENCES `image` (`id_image`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2024 at 09:15 PM
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
-- Database: `ck_beauty_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(32, 0, 0, 'MAFUTA TANGAWIZI  ', '43000 ', '1', 'IMG-20240325-WA0025.jpg '),
(33, 0, 0, 'BODY SPRAY ', '10000 ', '1', 'IMG-20240325-WA0041.jpg '),
(34, 0, 0, 'MAFUTA YA KIARABU ', '10000 ', '1', 'IMG-20240325-WA0023.jpg '),
(35, 0, 0, 'DOVE BODY WASH ', '12000 ', '1', 'IMG-20240325-WA0012.jpg '),
(36, 0, 0, 'PERFUME ', '12000 ', '1', 'IMG-20240325-WA0035.jpg '),
(37, 0, 0, 'FACE WASH ', '43000 ', '1', 'IMG-20240325-WA0019.jpg '),
(38, 0, 3, 'LOTION ZA NIVEA ', '4000 ', '1', 'IMG-20240325-WA0024.jpg '),
(39, 0, 5, 'SABUNI YA TETIMOSOL ', '13000 ', '1', 'IMG-20240325-WA0022.jpg '),
(40, 0, 0, 'PORTIA BODY CREAM ', '12000 ', '1', 'IMG-20240325-WA0020.jpg '),
(41, 0, 0, 'PAPAYA BADY AND HAND LOTION ', '13000 ', '1', 'IMG-20240325-WA0016.jpg ');

-- --------------------------------------------------------

--
-- Table structure for table `featured_products`
--

CREATE TABLE `featured_products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product_detail` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featured_products`
--

INSERT INTO `featured_products` (`id`, `name`, `price`, `product_detail`, `image`) VALUES
(1, 'PERFUME', '12000', 'perfume nzuri kwa mvuto mzuri ', 'IMG-20240325-WA0035.jpg'),
(2, 'MAFUTA YA DOVE', '13000', 'Mafuta Mazuri Kwa ngozi yako Na afya kwa ujumla ', 'IMG-20240325-WA0012.jpg'),
(3, 'LOTION ZA NIVEA', '4000', 'Lotion nzuri kwaajili ya kulainisha ngozi yako na kuifanya isipate ukavu ', 'IMG-20240325-WA0024.jpg'),
(4, 'MAFUTA TANGAWIZI ', '43000', 'Mafuta yaliyotengenezwa kwa vitu vya asili kama mdarasini na tangawizi furahia vitu vya asili kwa ngozi yako ', 'IMG-20240325-WA0025.jpg'),
(5, 'SABUNI YA TETIMOSOL', '13000', 'Tumia sabuni ya tetimosal kuua vijidudu na bakteria kwa afya ya mwili wako ', 'IMG-20240325-WA0022.jpg'),
(6, 'MAFUTA YA KIARABU', '10000', 'Mafuta mazuri kwa ngozi yako yanayoipa ngozi yako uzuri na marashi kutoka uarabuni ', 'IMG-20240325-WA0023.jpg'),
(7, 'BODY SPRAY', '10000', 'Nukia kila sehemu unayokwenda kwa kutumia body spray hizi na kuwa gumzo kila utapopita ', 'IMG-20240325-WA0041.jpg'),
(8, 'DEODORANT', '4000', 'Tumia bidhaa nzuri kuepuka jasho na kukupa uhuru bila kuwaza kuhusu kunuka jasho ', 'IMG-20240325-WA0042.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(1, 0, 'shukrani', 'shukrani@gmail.com ', '07378947', 'hellow'),
(2, 0, 'kelvin', 'kelvin@gmail.com ', '0745983046', 'thanks'),
(3, 0, 'anna', 'anna@gmail.com ', '079377748', 'good products');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `placed_on` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product_detail` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `product_detail`, `image`) VALUES
(1, 'DOVE BODY WASH', '12000', 'Body wash to naurish your skin become very genuinly by applying that product from trusted brand. Become unbeatable in world of smart people. Do not settle for little but go extra miles.  ', 'IMG-20240325-WA0012.jpg'),
(2, 'AMARA LOTION FOR MEN', '43000', 'Body wash to naurish your skin become very genuinly by applying that product from trusted brand. Become unbeatable in world of smart people. Do not settle for little but go extra miles.   ', 'IMG-20240325-WA0014.jpg'),
(3, 'JOHSON BODY WASH', '12000', 'Body wash to naurish your skin become very genuinly by applying that product from trusted brand. Become unbeatable in world of smart people. Do not settle for little but go extra miles.   ', 'IMG-20240325-WA0015.jpg'),
(4, 'PAPAYA BADY AND HAND LOTION', '13000', 'Body wash to naurish your skin become very genuinly by applying that product from trusted brand. Become unbeatable in world of smart people. Do not settle for little but go extra miles.   ', 'IMG-20240325-WA0016.jpg'),
(5, 'MAFUTA YA MOVIT', '12000', 'Body wash to naurish your skin become very genuinly by applying that product from trusted brand. Become unbeatable in world of smart people. Do not settle for little but go extra miles.   ', 'IMG-20240325-WA0017.jpg'),
(6, 'RIJU CREAM', '43000', 'Body wash to naurish your skin become very genuinly by applying that product from trusted brand. Become unbeatable in world of smart people. Do not settle for little but go extra miles.   ', 'IMG-20240325-WA0018.jpg'),
(7, 'FACE WASH', '43000', 'Body wash to naurish your skin become very genuinly by applying that product from trusted brand. Become unbeatable in world of smart people. Do not settle for little but go extra miles.   ', 'IMG-20240325-WA0019.jpg'),
(8, 'PORTIA BODY CREAM', '12000', 'Body wash to naurish your skin become very genuinly by applying that product from trusted brand. Become unbeatable in world of smart people. Do not settle for little but go extra miles.   ', 'IMG-20240325-WA0020.jpg'),
(11, 'DEODORANT', '4000', 'Tumia Bidhaa Nzuri Kuepuka Jasho Na Kukupa Uhuru Bila Kuwaza Kuhusu Kunuka Jasho ', 'IMG-20240325-WA0042.jpg'),
(12, 'PERFUME', '12000', 'Perfume Nzuri Kwa Mvuto Mzuri ', 'IMG-20240325-WA0035.jpg'),
(13, 'MAFUTA TANGAWIZI ', '43000', 'Mafuta Yaliyotengenezwa Kwa Vitu Vya Asili Kama Mdarasini Na Tangawizi Furahia Vitu Vya Asili Kwa Ngozi Yako ', 'IMG-20240325-WA0025.jpg'),
(14, 'LOTION ZA NIVEA', '4000', 'Lotion Nzuri Kwaajili Ya Kulainisha Ngozi Yako Na Kuifanya Isipate Ukavu ', 'IMG-20240325-WA0024.jpg'),
(15, 'SABUNI YA TETIMOSOL', '13000', 'Tumia Sabuni Ya Tetimosal Kuua Vijidudu Na Bakteria Kwa Afya Ya Mwili Wako ', 'IMG-20240325-WA0022.jpg'),
(16, 'MAFUTA YA KIARABU', '10000', 'Mafuta Mazuri Kwa Ngozi Yako Yanayoipa Ngozi Yako Uzuri Na Marashi Kutoka Uarabuni ', 'IMG-20240325-WA0023.jpg'),
(17, 'BODY SPRAY', '10000', 'Nukia Kila Sehemu Unayokwenda Kwa Kutumia Body Spray Hizi Na Kuwa Gumzo Kila Utapopita ', 'IMG-20240325-WA0041.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(1, 'sameja', 'sameja@gmail.com', '$2y$10$TAZixvtBnOMGdh1pHa/pSObmmTNzhJ2.sWcpSrZtXDczkz8JaizKW', 'admin'),
(2, 'kelvin', 'kelvin@gmail.com', '$2y$10$tbLJICa2KD4e24QQGHmWwu.M4tpjicvj1mqQbTH1HdEpWXsrSpemu', 'user'),
(3, 'sam', 'sam@gmail.com', '$2y$10$gCcwQnqaso4H9S8DqpnC6Ojd6K13ThyHX9r7Q.7H8OE7m7OhkM5qW', 'user'),
(4, 'anna', 'anna@gmail.com', '$2y$10$1nk3OGvPnmK7OCebJPOvZ.SipYOAlAT6QJz/QJ4DA7cy/ksoMqI32', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured_products`
--
ALTER TABLE `featured_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `featured_products`
--
ALTER TABLE `featured_products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

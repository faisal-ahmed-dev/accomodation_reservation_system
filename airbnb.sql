-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 02:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airbnb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'FaisalAhmed', '356a192b7913b04c54574d18c28d46e6395428ab');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `pid` int(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `seller_id` text DEFAULT NULL,
  `checkin` text DEFAULT NULL,
  `checkout` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `c_id` int(11) NOT NULL,
  `customer` text DEFAULT NULL,
  `seller` text DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`c_id`, `customer`, `seller`, `seller_id`, `user_id`, `time`) VALUES
(1, 'Hello', '', 5, 8, ''),
(2, '', 'How can I help You? and What Services You want', 5, 8, ''),
(3, 'How long is your vacation package?', '', 5, 8, ''),
(4, 'And which which more facilities you have?', '', 5, 8, ''),
(5, 'and what', '', 5, 8, ''),
(13, 'Hi', '', 5, 6, ''),
(14, '', 'wifi', 5, 8, '2023-11-04 16:33'),
(15, '', 'ac', 5, 8, '2023-11-04 16:35'),
(16, '', 'internet', 5, 8, '2023-11-04 16:36'),
(17, '', 'food', 5, 8, '2023-11-04 16:40'),
(18, '', 'waiter', 5, 8, '2023-11-04 16:40'),
(19, '', 'sdfsda', 5, 8, '2023-11-04 16:41'),
(20, '', 'dasd', 5, 8, '2023-11-04 16:46'),
(21, '', 'sadf', 5, 8, '2023-11-04 16:46'),
(22, '', 'asdasd', 5, 8, '2023-11-04 16:49'),
(23, '', 'sdfsdf', 5, 8, '2023-11-04 16:51'),
(24, '', 'asdas', 5, 8, '2023-11-04 16:52'),
(25, '', 'asdasd', 5, 8, '2023-11-04 16:56'),
(26, 'fsdfsd', '', 5, 8, ''),
(27, '', 'asda', 5, 8, '2023-11-04 17:23'),
(28, '', 'How can I help You? and What Services You want', 5, 8, '2023-11-04 17:26'),
(29, '', 'asdasd', 5, 8, '2023-11-04 17:28'),
(30, 'hlw', '', 5, 6, '2023-11-13 10:59'),
(31, '', 'hello sir', 5, 6, '2023-11-13 10:59'),
(32, 'hi', '', 7, 8, '2023-11-18 09:21'),
(33, '', 'sfaasdf', 5, 8, '2023-11-18 10:43'),
(34, '', 'sfaasdfsadf', 5, 8, '2023-11-18 10:43'),
(35, '123', '', 7, 8, '2023-11-18 10:59'),
(36, 'hey whatsup', '', 6, 8, '2023-11-18 11:02'),
(37, '', 'im good what about u', 6, 8, '2023-11-18 11:09'),
(38, 'im also good\n', '', 6, 8, '2023-11-18 11:10'),
(39, 'asdas', '', 6, 8, '2023-11-18 11:10'),
(40, '', 'sadfas', 6, 8, '2023-11-18 11:11'),
(41, 'Hello', '', 5, 45, '2023-11-19 17:51');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  `seller_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`, `seller_id`) VALUES
(3, 6, 'rifat', 'rifat@gmail.com', '123213', '1321321321', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `number` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `place_name` text DEFAULT NULL,
  `total_price` int(100) DEFAULT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `seller_id` text DEFAULT NULL,
  `checkin` text DEFAULT NULL,
  `checkout` text DEFAULT NULL,
  `payment_name` text DEFAULT NULL,
  `cardnumber` text DEFAULT NULL,
  `p_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `pid`, `place_name`, `total_price`, `placed_on`, `payment_status`, `seller_id`, `checkin`, `checkout`, `payment_name`, `cardnumber`, `p_address`) VALUES
(18, 6, 'Khan', '4575', 'a@gmail.com', 'paypal', 'flat no. 20, 77, Dhaka, Dhaka, Bangladesh - 2000', 47, 'Green Home', 2000, '2023-11-13', 'pending', '5', '23-11-2023', '27-11-2023', 'Faisal Ahmed', '3566 0020 2036 0505', ''),
(21, 8, 'Faisal Ahmed', '0179708996', 'faisalksabd999@gmail.com', 'paypal', 'flat no. House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 49, 'Room in Lyon, France', 10000, '2023-11-18', 'rejected', '5', '18-11-2023', '22-11-2023', 'Faisal Ahmed', '6200 0000 0000 0005', ''),
(22, 8, 'Faisal Ahmed', '0179708996', 'faisalksabd999@gmail.com', 'paytm', 'flat no. House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 50, 'Room in Greater London', 6000, '2023-11-18', 'completed', '6', '22-11-2023', '25-11-2023', 'Faisal Ahmed', '4000 0566 5566 5356', ''),
(24, 8, 'Faisal        Ahmed', '0179708996', 'faisalksabd999@gmail.com', 'paypal', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 50, 'The Chapters\r\n', 6000, '2023-11-19', 'rejected', '6', '29-11-2023', '05-12-2023', 'Faisal Ahmed', '6011 0009 9013 9424', ''),
(25, 8, 'Faisal Ahmed', '123', 'faisalksabd999@gmail.com', 'paypal', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 54, 'Green Room', 4000, '2023-11-19', 'pending', '7', '22-11-2023', '28-11-2023', 'Faisal Ahmed', '5200 8282 8282 8210', ''),
(26, 8, 'Faisal Ahmed', '1231231231', 'faisalksabd999@gmail.com', 'paypal', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 75, 'City View', 8500, '2023-11-19', 'pending', '5', '22-11-2023', '23-11-2023', 'Faisal Ahmed', '5200 8283 8282 8210', ''),
(27, 8, 'Faisal Ahmed', '1231231231', 'faisalksabd999@gmail.com', 'paypal', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 75, 'City View', 8500, '2023-11-19', 'pending', '5', '24-11-2023', '27-11-2023', 'Faisal Ahmed', '3056 930902 5904', ''),
(28, 8, 'Faisal Ahmed', '1231231231', 'faisalksabd999@gmail.com', 'paypal', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 54, 'Green Room', 4000, '2023-11-19', 'pending', '7', '19-11-2023', '21-11-2023', 'Faisal Ahmed', '6011 0009 9013 9456', ''),
(29, 8, 'Faisal Ahmed', '1840756899', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 82, 'Home', 12000, '2023-11-19', 'pending', '6', '21-11-2023', '24-11-2023', 'Faisal Ahmed', '6011 0009 9013 9424', ''),
(32, 45, 'Faisal Ahmed', '1797089958', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 47, 'Green Home', 2000, '2023-11-19', 'pending', '5', '19-12-2023', '22-12-2023', 'Faisal Ahmed', '5200 8282 8282 8210', ''),
(33, 45, 'Faisal Ahmed', '1840675674', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 47, 'Green Home', 2000, '2023-11-19', 'pending', '5', '12-12-2023', '15-12-2023', 'Faisal Ahmed', '6200 0000 0000 0005', ''),
(34, 45, 'Faisal Ahmed', '1756756755', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 47, 'Green Home', 2000, '2023-11-19', 'pending', '5', '01-12-2023', '03-12-2023', 'Faisal Ahmed', '3714 496353 98431', ''),
(35, 45, 'Faisal Ahmed', '1757656754', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 47, 'Green Home', 2000, '2023-11-19', 'pending', '5', '25-12-2023', '29-12-2023', 'Faisal Ahmed', '3714 496353 98431', ''),
(36, 45, 'Faisal Ahmed', '0175665656', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 47, 'Green Home', 2000, '2023-11-20', 'pending', '5', '04-12-2023', '08-12-2023', 'Faisal Ahmed', '6011 0009 9013 9424', ''),
(37, 45, 'Faisal Ahmed', '1643534532', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 49, 'Orchard ', 10000, '2023-11-20', 'pending', '5', '04-12-2023', '08-12-2023', 'Faisal Ahmed', '3714 496353 98431', ''),
(38, 45, 'Faisal Ahmed', '0176676676', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 49, 'Orchard ', 10000, '2023-11-20', 'pending', '5', '09-12-2023', '12-12-2023', 'Faisal Ahmed', '6200 0000 0000 0005', ''),
(39, 45, 'Faisal Ahmed', '1631231227', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 49, 'Orchard ', 10000, '2023-11-20', 'pending', '5', '03-12-2023', '04-12-2023', 'Faisal Ahmed', '3714 496353 98431', ''),
(40, 45, 'Faisal Ahmed', '1644564563', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 47, 'Green Home', 2000, '2023-11-20', 'pending', '5', '09-12-2023', '11-12-2023', 'Faisal Ahmed', '3056 930902 5904', ''),
(41, 45, 'Faisal Ahmed', '0178678678', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 47, 'Green Home', 2000, '2023-11-20', 'pending', '5', '16-12-2023', '18-12-2023', 'Faisal Ahmed', '6011 0009 9013 9424', ''),
(42, 52, 'Faisal Ahmed', '0179666666', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 47, 'Green Home', 2000, '2023-11-20', 'pending', '5', '14-01-2024', '18-01-2024', 'Faisal Ahmed', '3566 0020 2036 0505', ''),
(43, 51, 'Faisal Ahmed', '0179708996', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 52, 'Elm Villa\r\n', 12000, '2023-11-23', 'completed', '6', '23-11-2023', '27-11-2023', 'Faisal Ahmed', '5200 8282 8282 8210', ''),
(44, 51, 'Faisal Ahmed', '0175675675', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 54, 'Green Room', 4000, '2023-11-23', 'pending', '7', '29-11-2023', '02-12-2023', 'Faisal Ahmed', '3056 930902 5904', ''),
(45, 51, 'Faisal Ahmed', '0174564564', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 52, 'Elm Villa\r\n', 12000, '2023-11-23', 'pending', '6', '11-12-2023', '16-12-2023', 'Faisal Ahmed', '6759 6498 2643 8453', ''),
(46, 51, 'Faisal Ahmed', '2015645645', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 56, 'Room Blue', 14500, '2023-11-23', 'pending', '7', '28-11-2023', '29-11-2023', 'Faisal Ahmed', '5200 8282 8282 8210', ''),
(47, 51, 'Faisal Ahmed', '0179656454', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 56, 'Room Blue', 14500, '2023-11-23', 'pending', '7', '23-11-2023', '24-11-2023', 'Faisal Ahmed', '5200 8282 8282 8210', ''),
(48, 51, 'Faisal Ahmed', '0176454564', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 75, 'City View', 8500, '2023-11-23', 'pending', '5', '29-11-2023', '30-11-2023', 'Faisal Ahmed', '3056 930902 5904', ''),
(49, 51, 'Faisal Ahmed', '0178343534', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 60, 'City White', 45665, '2023-11-23', 'pending', '8', '26-11-2023', '29-11-2023', 'Faisal Ahmed', '4000 0566 5566 5556', ''),
(50, 51, 'Faisal Ahmed', '0165655655', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 54, 'Green Room', 4000, '2023-11-23', 'pending', '7', '13-12-2023', '15-12-2023', 'Faisal Ahmed', '5200 8282 8282 8210', ''),
(51, 51, 'Faisal Ahmed', '1745645644', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 62, 'Camping', 1000, '2023-11-23', 'pending', '5', '07-12-2023', '11-12-2023', 'Faisal Ahmed', '6011 0009 9013 9424', ''),
(52, 51, 'Faisal Ahmed', '0185675675', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 76, 'Camping', 15000, '2023-11-23', 'pending', '5', '29-11-2023', '30-11-2023', 'Faisal Ahmed', '6011 0009 9013 9424', ''),
(53, 51, 'Faisal Ahmed', '1867678677', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 78, 'Hill side train tour', 2500, '2023-11-23', 'pending', '5', '24-11-2023', '26-11-2023', 'Faisal Ahmed', '6759 6498 2643 8453', ''),
(54, 51, 'Faisal Ahmed', '0187566767', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 63, 'Hill Tour', 1500, '2023-11-23', 'pending', '5', '04-01-2024', '06-01-2024', 'Faisal Ahmed', '5200 8282 8282 8210', ''),
(55, 51, 'Faisal Ahmed', '1797089959', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 74, 'City Green', 5800, '2023-11-23', 'completed', '6', '25-11-2023', '28-11-2023', 'Faisal Ahmed', '4000 0566 5566 5556', ''),
(56, 51, 'Faisal Ahmed', '1835345344', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 75, 'City View', 8500, '2023-11-23', 'pending', '5', '01-12-2023', '04-12-2023', 'Faisal Ahmed', '6200 0000 0000 0005', ''),
(57, 51, 'Faisal Ahmed', '0168545454', 'faisalprince248@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 54, 'Green Room', 4000, '2023-11-24', 'pending', '7', '03-12-2023', '06-12-2023', 'Faisal Ahmed', '6759 6498 2643 8453', ''),
(58, 51, 'Faisal Ahmed', '0187345345', 'faisalprince248@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 56, 'Room Blue', 14500, '2023-11-24', 'pending', '7', '01-02-2024', '03-02-2024', 'Faisal Ahmed', '3714 496353 98431', ''),
(59, 51, 'Faisal Ahmed', '0174545645', 'faisalprince248@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 67, 'Papillon', 7000, '2023-11-24', 'pending', '6', '04-01-2024', '10-01-2024', 'Faisal Ahmed', '3056 930902 5904', ''),
(60, 51, 'Faisal Ahmed', '0174564564', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 67, 'Papillon', 7000, '2023-11-24', 'rejected', '6', '01-12-2023', '06-12-2023', 'Faisal Ahmed', '5200 8282 8282 8210', ''),
(61, 51, 'Faisal Ahmed', '0186565565', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 71, 'Boat Tour', 25000, '2023-11-24', 'pending', '8', '04-01-2024', '07-01-2024', 'Faisal Ahmed', '3056 930902 5904', ''),
(62, 51, 'Faisal Ahmed', '0194564564', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 52, 'Elm Villa\r\n', 12000, '2023-11-24', 'pending', '6', '08-12-2023', '10-12-2023', 'Faisal Ahmed', '3056 930902 5904', ''),
(63, 51, 'Faisal Ahmed', '0184564564', 'faisalprince248@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 65, 'Castel', 1000, '2023-11-24', 'pending', '6', '24-11-2023', '27-11-2023', 'Faisal Ahmed', '3714 496353 98431', ''),
(64, 53, 'Faisal Ahmed', '0196575675', 'faisalprince248@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 58, 'Monacizzo', 1000, '2023-11-24', 'pending', '7', '07-12-2023', '10-12-2023', 'Faisal Ahmed', '6200 0000 0000 0005', ''),
(65, 53, 'Faisal Ahmed', '0183453453', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 51, ' Cottage\r\n', 5001, '2023-11-24', 'pending', '6', '08-12-2023', '11-12-2023', 'Faisal Ahmed', '6011 0009 9013 9424', ''),
(66, 53, 'Faisal Ahmed', '0177834534', 'faisalprince248@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 50, 'The Chapters\r\n', 6000, '2023-11-24', 'completed', '6', '09-12-2023', '11-12-2023', 'Faisal Ahmed', '3566 0020 2036 0505', ''),
(67, 53, 'Faisal Ahmed', '1823423422', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 54, 'Green Room', 4000, '2023-11-24', 'pending', '7', '17-12-2023', '19-12-2023', 'Faisal Ahmed', '3056 930902 5904', ''),
(68, 53, 'Faisal Ahmed', '0174645645', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 49, 'Orchard ', 10000, '2023-11-24', 'pending', '5', '22-12-2023', '24-12-2023', 'Faisal Ahmed', '3714 496353 98431', ''),
(69, 53, 'Faisal Ahmed', '1867867867', 'faisalksabd999@gmail.com', '', 'House-124, T.i.c Colony road, Faidabad, Azampur, Uttara,Bangladesh - 1230', 58, 'Monacizzo', 1000, '2023-11-24', 'pending', '7', '12-12-2023', '20-12-2023', 'Faisal Ahmed', '6200 0000 0000 0005', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `details` varchar(500) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `image_01` varchar(100) DEFAULT NULL,
  `image_02` varchar(100) DEFAULT NULL,
  `image_03` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `p_person` int(11) DEFAULT NULL,
  `p_bedroom` int(11) DEFAULT NULL,
  `p_bed` int(11) DEFAULT NULL,
  `p_bath` int(11) DEFAULT NULL,
  `p_checkin` text DEFAULT NULL,
  `p_checkout` text DEFAULT NULL,
  `p_country` text DEFAULT NULL,
  `p_state` text DEFAULT NULL,
  `p_city` text DEFAULT NULL,
  `p_address` text DEFAULT NULL,
  `seller_id` text DEFAULT NULL,
  `p_status` text DEFAULT NULL,
  `p_facility` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `category`, `p_person`, `p_bedroom`, `p_bed`, `p_bath`, `p_checkin`, `p_checkout`, `p_country`, `p_state`, `p_city`, `p_address`, `seller_id`, `p_status`, `p_facility`) VALUES
(47, 'Green Home', 'One small single bedroom/ box room.\r\nIt is a cosy bedroom in a family home.\r\nDecor....shabby chic...we have a dog and 2 cats \r\n. We are a very friendly family.\r\nMortlake is lovely.\r\nRichmond park and the river are nearby.', 2000, 'istanbul-GettyImages-911747276.jpg', 'amsterdam-windows-1200x675.jpg', '3f3d795b-9d56-4869-a3df-41ef5412bb71.webp', 'room', 2, 2, 2, 1, '11-10-2023', '12-10-2023', 'Turkey', 'İstanbul', 'Adalar', 'One small single bedroom/ box room.\r\nIt is a cosy bedroom in a family home.\r\nDecor....shabby chic...we have a dog and 2 cats \r\n. We are a very friendly family.\r\nMortlake is lovely.\r\nRichmond park and the river are nearby.', '5', '', 'wifi'),
(48, 'Home Forest', 'ZenDacha Luxury Retreat, nestled in an elevated private community, bordered by untouched nature. Designed by award-winning architect, providing expansive indoor/outdoor living, with up to six bedroom (by prior agreement), each with en-suite facilities.', 3000, 'Screenshot 2023-10-11 000705.png', '326475643.jpg', '293131467.jpg', 'room', 1, 2, 2, 1, '11-10-2023', '20-10-2023', 'Egypt', 'Port Said', 'Port Said', '', '5', '', ''),
(49, 'Orchard ', 'In this naturally cool apartment in summer, enjoying a private garden of absolute calm (except for birdsong!!!), easy to park, in the heart of Lyon, I would love to welcome you. You can discover our wonderful Croix Rousse hill: as mythical as it is surprising. Welcome to Lyon!!!', 10000, '1ec076bb-c192-4926-bf6c-ec67c87be358.jpg', 'flat-interior-designing-500x500 (1).webp', 'hdb-living-room-jl.jpg', 'room', 3, 2, 2, 2, '20-10-2023', '25-10-2023', 'France', 'Corse', 'Amphoe Lap Lae', 'Room in Lyon, France', '5', '', ''),
(50, 'The Chapters\n', 'One small single bedroom/ box room.\r\nIt is a cosy bedroom in a family home.\r\nDecor....shabby chic...we have a dog and 2 cats \r\n. We are a very friendly family.\r\nMortlake is lovely.\r\nRichmond park and the river are nearby.', 6000, '0c4409b8-a06b-4d57-837d-d026d0bd0413.jpg', '382727110.jpg', 'blueground-apartment-2-2-2.webp', 'room', 2, 1, 1, 1, '01-10-2023', '01-11-2023', 'Haiti', 'Ouest', 'Arrondissement de Léogâne', 'One small single bedroom/ box room.\r\nIt is a cosy bedroom in a family home.\r\nDecor....shabby chic...we have a dog and 2 cats \r\n. We are a very friendly family.\r\nMortlake is lovely.\r\nRichmond park and the river are nearby.', '6', '', ''),
(51, ' Cottage\n', 'we are in a building of from the 1800&#39;s, in a quiet street but in the heart of historic Turin. to 10 min. the biggest square in Europe &#34;Piazza Vittorio&#34; where ther&#39;s the night life. Convenient to all services. In the district you can find every day a local market with fresh produce, but there are also different supermarket. The small electric bus &#34;Star1&#34; near the house will lead you under the &#34;Mole Antonelliana&#34; with the Cinema museum, also Egyptian Museum or even', 5001, '220406150109-skinniest-skyscraper-new-york-city.jpg', '008899-01-Suite12-Park Hyatt New York.jpg', '906248bbf7cc2a61de8b78e67e907443.jpg', 'room', 5, 2, 2, 2, '2-10-2023', '5-11-2023', 'United States', 'Vermont', 'Charlotte', 'USA', '6', '', ''),
(52, 'Elm Villa\n', 'Newly renovated luxury apartment, taking care of all the details. It is located in the heart of Madrid, next to the Plaza de Ópera and the Royal Palace (metro lines 2 and 5).\r\n  The room is bright and interior, spacious and silent. The bathroom is spacious and very comfortable.', 12000, 'hdb-living-room-jl.jpg', 'ef5464ea-5eb8-426a-a097-a4ed7a395610.jpg', '9c3fbba1-0581-4baa-b77a-a34ec7f5d476.webp', 'room', 6, 3, 3, 2, '18-10-2023', '7-11-2023', 'Spain', 'Madrid', 'Ajalvir', 'Spain', '6', '', ''),
(54, 'Green Room', 'High-end private villa with two bedrooms, a kitchen, and a pool is available. A chic and comfortable setting for your vacation on a paradise island.', 4000, 'DSCF0866_7_8_easyHDR.jpg', 'flat-interior-designing-500x500 (1).webp', 'ef5464ea-5eb8-426a-a097-a4ed7a395610.jpg', 'room', 3, 1, 1, 1, '8-10-2023', '5-10-2023', 'Austria', 'Carinthia', 'Dellach im Drautal', '', '7', '', ''),
(56, 'Room Blue', 'Our castle villa is located in an incredible area with its unique nature location, located in the luxury area of ​​Kaş.Our castle is fully equipped.There is 1 pool and a private beach to the property.6 Bedrooms , 6 Queen Bed , 4 Livingroom , 5 Bathroom.All of the Bedrooms have A/C.', 14500, 'Superior-Two-Bedroom-Apartment-with-Street-View003-1366x768-fp_mm-fpoff_0_0.webp', 'ab35b186c319cadb902e88ac22d25b86-p_e.jpg', '478850786.jpg', 'room', 5, 3, 3, 3, '4-10-2023', '9-11-2023', 'Morocco', 'Larache', 'Dellach im Drautal', '', '7', '', ''),
(58, 'Monacizzo', 'A luxurious apartment reminiscent of a castle, made available to let you spend a special holiday.\r\nThe building, located about 100 meters from the wetland, offers a panoramic view of the entire coast, is surrounded by green areas, typical of the Mediterranean scrub. The beach is free and sandy, the seabed is low and crystal clear, suitable for little ones. A few minutes from the hotel are all the essential services: bars, pizzerias, pharmacy, ', 1000, '382727110.jpg', 'doing-business-hongkong.jpg', 'amsterdam-windows-1200x675.jpg', 'room', 5, 4, 3, 3, '1-10-2023', '11-10-2023', 'Japan', 'Kyōto Prefecture', 'Maizuru', 'Japan', '7', '', ''),
(59, 'sea view', 'A luxurious apartment reminiscent of a castle, made available to let you spend a special holiday.', 22344, '02e73190-bfbd-46d6-8df8-c74d3296b416.webp', '5bd2057e1e8927ce.jpg', '5ecd9c46f504581043ee18fd_Playa-Paraiso-Tulum.jpeg', 'beach', 3, 2, 2, 2, '14-10-2023', '18-12-2023', 'Australia', 'Australian Capital Territory', 'Barton', 'A luxurious apartment reminiscent of a castle, made available to let you spend a special holiday.', '8', '', ''),
(60, 'City White', 'From our spacious balcony you can enjoy a unique view of Burj Khalifa and the magic fountains. Enjoy breakfast in the morning at our cozy dining table overlooking Dubai&#39;s old town or layback at night in our comfortable lounge seats - enjoying Burj Khalifa&#39;s video and laser shows! ', 45665, '3f248131-26e1-4a87-a932-7a279351a1d2.jpeg', '008899-01-Suite12-Park Hyatt New York.jpg', '3f3d795b-9d56-4869-a3df-41ef5412bb71.webp', 'city', 5, 3, 3, 2, '1-10-2023', '1-11-2023', 'United Arab Emirates', 'Dubai', 'Dubai', 'Entire rental unit in Dubai, United Arab Emirates\r\n', '8', '', ''),
(61, 'Beach view', 'Beach view', 12000, 'Best-Beachfront-Hotels-in-Los-Angeles-32489b7d21bd4dedb7aa26ee440bd41e.jpg', '29911-1-hotel_carousel_large.jpg', '449548108.jpg', 'beach', 3, 2, 2, 2, '01-10-2023', '11-12-2023', 'Guatemala', 'Huehuetenango Department', 'San Gaspar Ixchil', 'Beach view', '8', '', ''),
(62, 'Camping', 'Camping', 1000, 'camping-ideas-1561136670.jpg', '283776014.jpg', 'bali-jungle-camping.jpg', 'camping', 2, 1, 1, 1, '1-10-2023', '1-11-2023', 'Algeria', 'Chlef', 'Abou el Hassan', '', '5', '', ''),
(63, 'Hill Tour', 'Hill Tour', 1500, 'p0b3r55l.jpg', 'classical-swiss-banner.jpg', 'hmh-above.jpg', 'hill', 2, 1, 1, 1, '11-10-2023', '01-11-2023', 'Cyprus', 'Paphos District (Pafos)', 'Pólis', 'Hill Tour', '5', '', ''),
(64, 'Boat', 'Boat tour', 5000, '118207719.jpg', '63791082.jpg', '118207719.jpg', 'boat', 1, 2, 1, 2, '01-10-2023', '01-11-2023', 'Austria', 'Burgenland', 'Deutschkreutz', 'Boat tour', '5', '', ''),
(65, 'Castel', 'Castel', 1000, '88df343d-4632-4015-ae74-b2c5c322ab45-13091-rome-castel-sant-angelo-skip-the-line-tickets-04.webp', 'CA_201_A1-904x600.jpg', 'Castel_Nuovo_-_Naples,_Italy_-_panoramio.jpg', 'castle', 2, 2, 2, 2, '01-11-2023', '01-12-2023', 'France', 'Provence-Alpes-Côte-d’Azur', 'Aubignan', 'Castel', '6', '', ''),
(66, 'Golf', 'Golf club', 2000, 'RMUGH-P0100-Hotel-Exterior-Aerial-Pools-Golf-Course-Mountains.16x9.webp', 'USE_fincacort-17-mountain-cloud.jpg', 'Black-Mountain-Golf-Club-Hua-Hin.jpg', 'golf', 1, 1, 1, 1, '1-10-2023', '1-11-2023', 'Germany', 'Bremen', 'Replot', 'Germany', '6', '', ''),
(67, 'Papillon', 'Apartment 2 room', 7000, '382727110.jpg', '383834719.jpg', 'blueground-apartment-2-2-2.webp', 'apartment', 4, 2, 1, 2, '1-10-2023', '1-12-2023', 'Morocco', 'Bremen', 'Replot', 'Morocco', '6', '', ''),
(68, 'Tower', 'Reset and rejuvenate at the Clark Farm Silos! Our thoughtfully designed, unique metal structures are equipped with a fully functional kitchenette, private bathroom and spacious loft bedroom with gorgeous mountain views. Start your days sipping coffee while drinking in the fresh mountain air. Relax after a day of adventure under the starry sky next to the crackling sounds of your personal campfire. Centrally located so you can enjoy all that the Flathead Valley has to offer.', 1255, '0a48fde5-f580-4ebe-8871-530d7dd4ebaa.webp', '2b2a11af-0de7-4629-a9fc-87e9d73feeb1.webp', 'ebf2b288-1a6a-47ae-90e8-4e892f5b810e.webp', 'tower', 2, 1, 1, 1, '01-10-2023', '01-12-2023', 'Angola', 'Cuando Cubango Province', 'Menongue', 'Iceland', '7', '', 'Wifi – 33 Mbps, Free street parking'),
(69, 'Car', '4 seater jeep', 5000, '31542278-8885-47ec-afd0-5fca45985766.webp', '2b2a11af-0de7-4629-a9fc-87e9d73feeb1.webp', '2b2a11af-0de7-4629-a9fc-87e9d73feeb1.webp', 'tower', 1, 1, 1, 1, '01-10-2023', '01-11-2023', 'Antigua And Barbuda', 'Saint Paul Parish', 'Liberta', 'Japan', '7', '', 'Wifi – 33 Mbps, Free street parking'),
(70, 'Beach Hotel', 'Beach Hotel', 5998, 'Jumeirah-Beach-Hotel11-1920x1164.jpg', '455471727.jpg', '29911-1-hotel_carousel_large.jpg', 'beach', 3, 2, 2, 2, '15-10-2023', '1-12-2023', 'Algeria', 'Chlef', 'Abou el Hassan', '', '7', '', ''),
(71, 'Boat Tour', 'Boat tour', 25000, 'image.jpg', '20116061.jpg', '121320807_20210326134854_20230203123252.jpg', 'boat', 3, 2, 2, 2, '01-10-2023', '01-11-2023', 'Ireland', 'Leinster', 'An Muileann gCearr', 'Boat tour', '8', '', ''),
(72, 'Blue Beach ', 'Beach view', 35000, '456a84994ba2cd3090a7f43278372181.jpg', '492641173.jpg', '492641173.jpg', 'beach', 2, 1, 1, 1, '12-10-2023', '15-11-2023', 'Algeria', 'Chlef', 'Abou el Hassan', '', '8', '', ''),
(73, 'NYC Park View', 'Park View', 5600, '220406150109-skinniest-skyscraper-new-york-city.jpg', 'amsterdam-windows-1200x675.jpg', 'doing-business-hongkong.jpg', 'city', 3, 2, 3, 2, '1-12-2023', '20-11-2023', 'Algeria', 'Chlef', 'Abou el Hassan', '', '8', '', ''),
(74, 'City Green', 'City view', 5800, '14658257525_39e6950564_k.jpg', '46f549e6-1806-40fc-aa22-b6bc30c4b2eb.webp', 'State-Historical-Museum-Moscow.jpg', 'city', 3, 1, 2, 2, '19-11-2023', '1-12-2023', 'Italy', 'Campania', 'Paolisi', 'Italy', '6', '', ''),
(75, 'City View', 'City View', 8500, '3f248131-26e1-4a87-a932-7a279351a1d2.jpeg', '14658257525_39e6950564_k.jpg', 'download.webp', 'room', 2, 2, 2, 2, '2023-10-12', '2023-10-27', 'United States', 'Howland Island', 'Ajalvir', 'USA', '5', '', ''),
(76, 'Camping', 'Camping', 15000, 'kabaceira-glamping-atalaia-lisbon-photo-1.jpeg', 'camping-ideas-1561136670.jpg', 'camping-ideas-1561136670.jpg', 'camping', 2, 1, 1, 0, '12-10-2023', '02-11-2023', 'Australia', 'Western Australia', 'Bedford', 'Camping', '5', '', ''),
(77, 'Camping', 'Camping', 3500, 'x1ymbdka89r11.jpg', 'camping-ideas-1561136670.jpg', 'camping-ideas-1561136670.jpg', 'camping', 1, 1, 1, 1, '11-10-2023', '01-11-2023', 'Kuwait', 'Mubarak Al-Kabeer', 'Şabāḩ as Sālim', 'Camping', '5', '', ''),
(78, 'Hill side train tour', 'Hill view train tour', 2500, 'hmh-above.jpg', 'Hall-of-Mosses-Trail-Hoh-Rain-Forest-2.jpg', 'Lysefjord-pulpit-rock-cruise-topp-1024x682.jpg', 'hill', 0, 0, 0, 0, '11-10-2023', '08-11-2023', 'Haiti', 'Ouest', 'Arrondissement de Léogâne', 'Hill view train tour', '5', '', ''),
(82, 'Home', 'ZenDacha Luxury Retreat, nestled in an elevated private community, bordered by untouched nature. Designed by award-winning architect, providing expansive indoor/outdoor living, with up to six bedroom (by prior agreement), each with en-suite facilities.', 12000, 'flat-interior-designing-500x500.webp', 'modern-living-room-wallpaper-1656391070.jpg', 'ef5464ea-5eb8-426a-a097-a4ed7a395610.jpg', 'room', 0, 2, 2, 1, '15-11-2023', '01-12-2023', 'Egypt', 'Qalyubia', 'Banhā', '20', '6', '', 'What this place offers: Wifi – 33 Mbps, Free street parking'),
(83, 'Forest home', '36 km beyond Darjeeling, a peaceful stay amid the serene location. Trouvaille farm is a farmstay run by passionate nature lovers. The farm is an ideal place to rejoice, meditate or simply sit back and absorb the nature’s magnificence. The homegrown food and warm hospitality will make you feel at home all along.\r\nA warm scenic homestay where guests can enjoy nature to its fullest. A contribution in farm activities like cooking or milking a cow is always appreciated and welcomed.', 12000, 'Wilderness-hotels-resorts-accommodations-Nandini-Jungle-Resort-and-Spa-Bali.jpg', '326475643.jpg', '54758dc1adee67c3c8689c4e59f8e70e.jpeg', 'forest', 2, 2, 1, 1, '16-11-2023', '14-12-2023', 'India', 'West Bengal', 'Darjeeling', 'Darjeeling, India', '6', 'not', 'Wifi – 33 Mbps, Free street parking'),
(84, 'Small home', 'Located 2 hours and 40 minutes from Pai & 24 minutes to Pang Oung, we invite you to relax in our authentic & traditional Chinese homestay design with a gorgeous view of the village and tea farm, 5-min walk to the lake.\r\n\r\nEnjoy the sounds of nature when you stay in this unique place. This homestay room (with fans) will make you feel like you&#39;re in another world&#34;! This sleepy village is famous for its breathtaking views and tea cultivation and is one of the coolest lake homestays in Mae H', 25000, '293131467.jpg', '326475643.jpg', 'Flat-Country-credit-Cascadia-Wildlands-DSC_4323.jpeg', 'forest', 2, 1, 1, 1, '13-11-2023', '06-12-2023', 'Thailand', 'Surat Thani', 'Amphoe Phrasaeng', 'Thiland', '6', 'not', 'Wifi – 33 Mbps, Free street parking'),
(85, 'Historical Castle', 'Wimsbach Castle is in a scenically and culturally exceptional location. Guests enjoy nearly six acres (over 2 hectares) of private park as well as the area&#39;s outstanding cultural treasures and proximity to Austria&#39;s lake district. The village is embedded in a nature reserve, offering guests endless local walking and biking opportunities. ', 1000, 'photo-1601136800312-d4dc1f50554b.jpeg', 'neuschwanstein-castle-autumn-sunset-europe-15235426.jpg.webp', 'val-di-non---tassullo---castel-valer_37789.jpg', 'castle', 4, 2, 2, 2, '22-11-2023', '08-12-2023', 'Australia', 'Queensland', 'Annandale', 'Australia', '6', 'not', 'Wifi – 33 Mbps, Free street parking, Security cameras on property'),
(86, 'Golf house', 'Golf club house', 2000, 'Black-Mountain-Golf-Club-Hua-Hin.jpg', 'facade-golf-court-lily-country-club.jpg', 'POR_VIL_1511WebOriginalCompressed.webp', 'golf', 4, 2, 2, 2, '23-11-2023', '28-12-2023', 'Poland', 'Greater Poland Voivodeship', 'Chocz', 'Poland', '7', 'not', 'Wifi – 33 Mbps, Free street parking');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id` int(100) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `username` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `f_language` text DEFAULT NULL,
  `s_language` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `name`, `password`, `username`, `email`, `phone`, `f_language`, `s_language`, `description`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', 'admin', '', '', '', '', ''),
(5, 'Rifat', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin', 'a@gmail.com', '01523102013', 'English', 'French', 'Been traveling around the world for the past few years.  Love Country and its people. Now that we understand safety and comfort are important for all travellers and we would do what we can to provide that.'),
(6, 'Faisal', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'faisal', 'faisal@gmail.com', '11654646', 'English', 'French', 'Hi i am faisal.'),
(7, 'tahmid', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'tahmid', 'tahmid@gmail.com', '01523102013', 'English', 'French', 'Hi i am tahmid'),
(8, 'touhid', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'touhid', 'touhid@gmail.com', '01523102013', 'English', 'German', 'Hi I am touhid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(6, 'john', 'a@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(7, 'tahmid', 'igfiafgiag@gamil.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(8, 'Faisal Ahmed', 'faisalksabd999@gmail.com', 'da4b9237bacccdf19c0760cab7aec4a8359010b0'),
(9, 'sadas', 'asd@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab'),
(11, 'FAISALAHMED', 'asdas@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(14, 'rifat', 'rifat@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(45, 'rifat123', 'rifatceh@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab'),
(52, 'Touhid', 'tauhidprohob@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab'),
(53, 'FaisalAhmed', 'faisalprince248@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `pid` int(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `seller_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`, `seller_id`) VALUES
(32, 6, 51, 'Room in Torino', 5001, '220406150109-skinniest-skyscraper-new-york-city.jpg', '5'),
(34, 6, 56, 'Room Blue', 14500, 'Superior-Two-Bedroom-Apartment-with-Street-View003-1366x768-fp_mm-fpoff_0_0.webp', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`c_id`);

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
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 10:12 PM
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
-- Database: `community`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `user_id`, `balance`) VALUES
(1, 4, 12000),
(2, 5, 57000);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `created_at`) VALUES
(2, 'Exhibition', 'Exhibition Exhibition Exhibition', '2024-07-01 16:50:01'),
(3, 'Comedy', 'Comedy Comedy Comedy', '2024-07-01 16:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `center_id` int(11) NOT NULL,
  `flyer` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `title`, `description`, `category_id`, `date`, `time`, `center_id`, `flyer`, `user_id`, `created_at`, `status`) VALUES
(9, 'Laughter Night Live!', 'Join us for an unforgettable night of stand-up comedy featuring some of the funniest comedians in the business.', 3, '2024-07-31', '23:24:00', 3, '1721341531_pexels-wendywei-1190297.jpg', 5, '2024-07-19 00:25:31', 'Upcoming'),
(10, 'Naming Ceremony', 'Join us for an unforgettable night of stand-up comedy featuring some of the funniest comedians in the business.', 2, '2024-07-31', '23:42:00', 1, '1721342533_pexels-asadphoto-169198.jpg', 5, '2024-07-19 00:42:13', 'Upcoming'),
(11, 'Burial Ceremony', 'Join us for an unforgettable night of stand-up comedy featuring some of the funniest comedians in the business.', 2, '2024-07-31', '23:42:00', 3, '1721342595_pexels-teddy-2263436.jpg', 5, '2024-07-19 00:43:15', 'Upcoming');

-- --------------------------------------------------------

--
-- Table structure for table `event_center`
--

CREATE TABLE `event_center` (
  `center_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `capacity` int(20) NOT NULL,
  `charge` int(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_center`
--

INSERT INTO `event_center` (`center_id`, `name`, `description`, `address`, `capacity`, `charge`, `image`, `user_id`, `created_at`, `updated_on`) VALUES
(1, 'Bolvin 1', 'nxcbnc xbnnbcx nxcnbcx bnxbcx', 'Behind Oyo State', 5000, 3000300, '1719593402_IMG-20210821-WA0007.jpg', 3, '2024-06-28 18:50:02', '2024-06-28 17:50:02'),
(3, 'Alagbado Joint', 'bool      noop       blaop mmmmm', 'Behind Oyo State', 50000, 750000, '1719612670_IMG-20230428-WA0014.jpg', 3, '2024-06-28 22:28:49', '2024-06-28 21:28:49'),
(5, 'Alagbado Joint 1', 'bool pool cool loop', 'Behind Oyo State', 50000, 750000, '1719615629_IMG-20211113-WA0026.jpg', 4, '2024-06-29 01:00:29', '2024-06-29 00:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message`, `receiver_id`, `sender_id`, `date`) VALUES
(1, 'You are cordially invited', 6, 5, '2024-07-12 08:11:50'),
(2, 'You are cordially invited', 6, 5, '2024-07-12 08:11:50'),
(3, 'Event Title : Carol pool<br>Event Date : 2024-09-20<br>You are invited', 6, 5, '2024-07-12 08:22:01'),
(4, 'Event Title : Carol pool<br>Event Date : 2024-09-20<br>You are invited', 6, 5, '2024-07-12 08:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `price_id` int(11) NOT NULL,
  `regular` int(11) NOT NULL,
  `vip` int(11) NOT NULL,
  `vvip` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`price_id`, `regular`, `vip`, `vvip`, `event_id`) VALUES
(6, 4000, 6000, 12000, 9);

-- --------------------------------------------------------

--
-- Table structure for table `rsvp`
--

CREATE TABLE `rsvp` (
  `rsvp_id` int(11) NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `ticket_id` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `event_id` int(11) NOT NULL,
  `planner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rsvp`
--

INSERT INTO `rsvp` (`rsvp_id`, `ticket_price`, `ticket_id`, `email`, `event_id`, `planner_id`) VALUES
(1, 12000, '669106b2e46f3', 'user@gmail.com', 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `charge` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `name`, `description`, `charge`, `created_at`, `user_id`) VALUES
(2, 'Decoration noop', 'nooooooop', '3000543', '2024-06-28 16:47:44', 3),
(4, 'Decoration', 'pool zoo loom mop milk', '5000', '2024-07-02 15:44:59', 3);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `title`, `about`, `logo`) VALUES
(1, 'ComEve', 'At ComEve, we are a team of passionate event enthusiasts and customer service experts committed to transforming the event planning process. Our mission is to empower event planners, organizers, and hosts with an intuitive and powerful platform that simplifies the complexities of event management.', '1720779492_logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_role` varchar(50) NOT NULL DEFAULT 'normal_member',
  `created_at` datetime NOT NULL,
  `token` varchar(100) NOT NULL,
  `token_expired` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `email`, `phone`, `password`, `image`, `user_role`, `created_at`, `token`, `token_expired`) VALUES
(3, 'Rhoda', 'Gift', 'vendor23', 'vendor@gmail.com', '08000000000', 'e43389629c27c5019803f2abe679dae26d188e90', '1720779341_1689174237_profile-1.jpg', 'vendor_member', '2024-06-28 12:30:54', '', '2024-07-12 10:15:41.726362'),
(4, 'admin', 'admin', 'admin123', 'admin@gmail.com', '09022222222', 'f865b53623b121fd34ee5426c792e5c33af8c227', '1720779358_1689174147_profile-3.jpg', 'super_admin_member', '2024-06-29 00:37:43', '', '2024-07-12 10:15:58.734050'),
(5, 'Bolu Jacob', 'Adejare', 'planner', 'planner@gmail.com', '09022222225', 'e43389629c27c5019803f2abe679dae26d188e90', '1720779390_1689086510_profile-2.jpg', 'planner_member', '2024-06-29 01:02:55', '', '2024-07-12 10:16:30.648393'),
(6, 'Toyosi', 'Teru', 'toyosiTeru', 'toyosi@gmail.com', '07085438771', 'e43389629c27c5019803f2abe679dae26d188e90', '1721340564_IMG-20240718-WA0009.jpg', 'normal_member', '2024-07-02 15:54:01', '', '2024-07-18 22:09:24.599592');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_center`
--
ALTER TABLE `event_center`
  ADD PRIMARY KEY (`center_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `rsvp`
--
ALTER TABLE `rsvp`
  ADD PRIMARY KEY (`rsvp_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `event_center`
--
ALTER TABLE `event_center`
  MODIFY `center_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rsvp`
--
ALTER TABLE `rsvp`
  MODIFY `rsvp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

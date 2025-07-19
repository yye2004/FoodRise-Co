-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 04:16 PM
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
-- Database: `foodrise1`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactform`
--

CREATE TABLE `contactform` (
  `contactform_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `enquiry_type` varchar(50) NOT NULL,
  `message_details` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactform`
--

INSERT INTO `contactform` (`contactform_id`, `email`, `name`, `enquiry_type`, `message_details`, `submitted_at`) VALUES
(1, 'yinger@gmail.com', 'Yinger', 'others', 'I would like to be a part of FoodRise Co.\'s admin. How can I join the team?', '2024-12-11 05:41:50'),
(2, 'briank@gmail.com', 'Brian', 'events', 'Hello, May I know can I park my car inside the Sunway Pinnacle Tower for AGM 2025?', '2024-12-14 23:50:16'),
(3, 'sjin@gmail.com', 'Jin', 'food', 'Hi, I would like to know more about the arrangement of food donation logistic issue as I am from different state.', '2024-12-15 21:25:47'),
(4, 'sjin@gmail.com', 'Jin', 'food', 'Hi, I would like to know more about the arrangement of food donation logistic issue as I am from different state.', '2024-12-15 22:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `description`, `date`, `time`, `location`, `created_at`, `updated_at`) VALUES
(3, 'Back-to-School Food Bank', 'Food bank for the needy especially children who are expecting to back to school in summer.', '2024-06-29', '08:00:00', 'Sunway University Foyer', '2024-12-06 07:23:32', '2024-12-09 05:47:50'),
(5, 'Chinese New Year Food Bank', 'food bank for cny 2025', '2025-02-07', '18:00:00', 'Sunway University', '2024-12-08 09:44:24', '2024-12-08 09:44:24'),
(6, 'Halloween Food Drive', 'halloween 2024', '2024-10-31', '17:00:00', 'Sunway Geo Avenue', '2024-12-08 09:45:29', '2024-12-09 05:43:03'),
(7, 'Mid-Autumn Donation Drive', 'Join us to celebrate mid-autumn festival by spreading love to families who are suffering through hunger,', '2024-09-14', '19:00:00', 'Sunway Pyramid, CP3', '2024-12-08 09:58:52', '2024-12-08 09:58:52'),
(8, 'Summer Food Drive', 'Summer is back!', '2024-06-22', '16:00:00', 'Sunway Geo Avenue', '2024-12-08 11:14:45', '2024-12-09 05:45:58'),
(9, 'Deepavali Food Drive', 'Happy Deepavali', '2024-11-02', '10:00:00', 'Sunway Pyramid, Blue Atrium', '2024-12-08 11:16:57', '2024-12-09 13:51:39'),
(10, 'Happy Children Day Donation Drive', 'Spread The Love; Spread Your Heart', '2024-11-20', '12:00:00', 'Sunway Mentari', '2024-12-08 11:18:44', '2024-12-09 13:53:45'),
(11, 'November Charity Run', 'Run for fun!', '2024-12-04', '07:00:00', 'Kompleks BRT Sunway', '2024-12-08 11:18:57', '2024-12-09 13:54:38'),
(12, 'Autumn Drive: Falling Food', 'Distributing food together to the orphanage home!', '2024-11-02', '08:00:00', 'House Of Joy, Puchong', '2024-12-08 11:19:07', '2024-12-11 05:50:51'),
(13, 'Annual General Meeting 2025', 'Yearly meeting between executive comittees and fellow volunteering members where we gather to review financial statements and discuss future events.', '2025-03-01', '09:00:00', 'Sunway Clio Hotel, Level 8.', '2024-12-08 11:20:35', '2024-12-15 02:06:39'),
(15, 'Prosperity Box: New Begin', 'Begin your prosperous new year by distributing our Prosperity Box containing food essentials to the needy!', '2025-01-11', '12:00:00', 'PPR Pinggiran Bukit Jalil', '2024-12-08 11:21:10', '2024-12-11 05:59:36'),
(17, 'New Year Eve Food Bank', 'Happy New Year!', '2024-12-30', '09:00:00', 'Blue Atrium, Sunway Pyramid', '2024-12-08 11:22:57', '2024-12-08 11:29:09'),
(18, 'Merrier December Drive', 'Back to december! It\'s the merry season', '2024-12-22', '20:00:00', 'Boulevard Sunway College', '2024-12-08 11:23:09', '2024-12-15 15:45:27'),
(20, 'Winter Solstice Food Drive', 'Let\'s distribute food in this upcoming winter solstice festival together!', '2024-12-21', '16:00:00', 'Taman Subang Mewah', '2024-12-15 15:08:12', '2024-12-15 15:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `food_donations`
--

CREATE TABLE `food_donations` (
  `fooddonation_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `food_type` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `manufactured_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `details` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','confirmed','rejected') DEFAULT 'pending',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_donations`
--

INSERT INTO `food_donations` (`fooddonation_id`, `email`, `food_type`, `quantity`, `manufactured_date`, `expiry_date`, `details`, `submitted_at`, `status`, `user_id`) VALUES
(1, 'potato@gmail.com', 'meat', 20, '2024-12-01', '2025-10-01', 'Tuna fish, Ayam Brands', '2024-12-10 18:46:58', 'confirmed', NULL),
(2, 'potato123@gmail.com', 'grains', 60, '2024-08-01', '2026-06-01', 'Kokocrunch Nestle', '2024-12-11 08:29:42', 'confirmed', 0),
(3, 'potato123@gmail.com', 'grains', 200, '2024-11-02', '2025-12-02', 'Tuna Chunks, TC Boy', '2024-12-11 08:57:26', 'confirmed', 0),
(4, 'banana@gmail.com', 'other', 100, '2024-12-11', '2025-04-11', '100 litre of Dutch Lady UHT Full Cream Milk', '2024-12-11 09:10:29', 'pending', 8),
(5, 'yeapyinger916@gmail.com', 'other', 300, '2024-12-11', '2025-04-11', '300 litre of Farm Fresh UHT Full Cream Milk', '2024-12-11 09:11:24', 'confirmed', 9),
(6, 'potato@gmail.com', 'meat', 20, '2024-12-21', '2024-12-31', 'test', '2024-12-11 12:45:15', 'pending', 1),
(7, 'yeapyinger916@gmail.com', 'meat', 100, '2024-11-01', '2026-06-01', 'Tuna Flakes Chunks, Ayam Brands', '2024-12-11 22:16:09', 'confirmed', 9),
(8, 'avocado123@gmail.com', 'meat', 200, '2024-12-01', '2026-12-01', 'Tuna Fish Mayonaise Flakes 200g', '2024-12-14 22:05:06', 'confirmed', 7),
(9, 'yeapyinger916@gmail.com', 'grains', 200, '2024-12-07', '2025-05-07', 'Nestle Kokorunch 1kg pack', '2024-12-15 21:01:46', 'pending', 9),
(10, 'yeapyinger916@gmail.com', 'grains', 200, '2024-12-01', '2025-03-14', 'hahahaahah', '2024-12-16 15:07:35', 'pending', 9);

-- --------------------------------------------------------

--
-- Table structure for table `money_donations`
--

CREATE TABLE `money_donations` (
  `money_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `donor_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reference_id` varchar(12) NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `money_donation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `money_donations`
--

INSERT INTO `money_donations` (`money_id`, `amount`, `donor_name`, `email`, `reference_id`, `receipt`, `money_donation_date`) VALUES
(1, 20.00, 'Yinger', 'yeapyinger916@gmail.com', '100100100100', 'upload.jpg', '2024-12-11 12:22:03'),
(3, 20.00, 'Anonymous', '22086193@imail.sunway.edu.my', '112112112112', 'upload.jpg', '2024-12-11 12:26:50'),
(4, 30.00, 'Yea', '22086193@imail.sunway.edu.my', '112112112112', 'uploads/line-5.svg', '2024-12-11 12:26:50'),
(5, 50.00, 'Ban', 'bananana@gmail.com', '112112112112', 'upload.jpg', '2024-12-11 12:27:56'),
(6, 50.00, 'Butter', 'bananana@gmail.com', '112112112112', 'upload.jpg', '2024-12-11 12:27:56'),
(7, 100.00, 'Anonymous', 'yeapyinger916@gmail.com', '112112112112', 'upload.jpg', '2024-12-11 12:30:24'),
(8, 20.00, 'Anonymous', 'yeapyinger916@gmail.com', '112112112112', 'upload.jpg', '2024-12-11 12:30:24'),
(9, 50.00, 'Butter', 'bananana@gmail.com', '112112112113', 'upload.jpg', '2024-12-11 12:34:14'),
(10, 20.00, 'Anonymous', 'bananana@gmail.com', '112112112113', 'upload.jpg', '2024-12-11 12:34:14'),
(11, 20.00, 'yeap', 'yeapyinger916@gmail.com', '112112112112', 'upload.jpg', '2024-12-11 12:36:19'),
(15, 50.00, 'Potato', 'potato@gmail.com', '112112112113', 'upload.jpg', '2024-12-11 12:38:39'),
(21, 100.00, 'Anonymous', 'yeapyinger916@gmail.com', '109109109109', 'upload.jpg', '2024-12-11 12:40:55'),
(25, 20.00, 'Anonymous', 'yeapyinger916@gmail.com', '112112112133', 'upload.jpg', '2024-12-11 13:02:35'),
(26, 20.00, 'Anonymous', 'avocado123@gmail.com', '123456123456', 'upload.jpg', '2024-12-14 23:47:31'),
(27, 100.00, 'Anonymous', 'yeapyinger916@gmail.com', '100100100100', 'upload.jpg', '2024-12-15 21:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `posted_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `event_id`, `title`, `content`, `posted_date`) VALUES
(1, 8, 'Summer Food Drive', 'Over 1,200 individuals and families facing food insecurity were served through this year’s extraordinarily successful Summer Food Drive. This all would not be possible without the steadfast support and generosity of our amazing community, committed volunteers, and kind donors.<br><br>Together, we distributed over 25,000 meals during the drive, thanks to your food donations, volunteer hours, and monetary contributions. Every dollar donated was turned into at least three meals for food-insecure people in our neighborhoods, fighting hunger in our community.<br><br>It’s genuinely exciting to see our community rallying to support families in need during especially difficult times. By doing so, we put hope and relief in the hands of those who are most in need by filling up empty plates. Stories from recipients prove how much each effort matters — like the single parent who didn’t have to choose between paying bills and feeding their children.<br><br>This project proves the impact of collective effort. Thank you for truly changing so many lives — for why you did it from the bottom of our hearts. Continue working together with us to end hunger and create a culturally appropriate supportive community for everyone.', '2024-06-23'),
(2, 3, 'Back-to-School Food Bank', 'No student must return to school hungry. So, as the new school year approached, we developed an initiative to help fight hunger in our community one meal at a time: The Back-to-School Food Bank. That meant this year, with your amazing generosity, we distributed upwards of 800 backpacks that were packed with basic needs and school tools for families.\r\n<br><br>\r\nThe backpacks included not only healthy, non-perishable items to last at least 14 days but guidance for preparing affordable and balanced meals. These resources have been helping families create meals from basic ingredients, promoting sustainable and nutritious healthy eating habits.\r\n<br><br>\r\nThis effort helped over 500 school-aged youth who were able to return to school with the energy and confidence to succeed. Parents thanked us for lifting a significant burden and enabling them to concentrate on their children’s education and well-being.\r\n<br><br>\r\nThis program not only addressed immediate needs but helped to instill empowerment and hope. Together, we are not only addressing hunger but also building a better, healthier future for future generations. We appreciate you for being a part of this critical mission. You’re changing lives — one backpack, one family at a time.', '2024-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ref` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `amount`, `transaction_date`, `ref`) VALUES
(1, 2, 200.00, '2024-12-06 07:22:16', 2147483647),
(2, 9, 50.00, '2024-12-02 02:20:00', 102),
(4, 2, 20.00, '2024-12-09 06:58:45', 12),
(5, 9, 75.20, '2024-12-05 10:25:00', 105),
(6, 7, 130.30, '2024-12-06 05:00:00', 106),
(7, 8, 60.00, '2024-12-07 03:15:00', 107),
(8, 9, 150.50, '2024-12-08 12:30:00', 108),
(9, 9, 95.40, '2024-12-09 00:45:00', 109),
(10, 9, 120.00, '2024-12-10 04:00:00', 110),
(15, 11111119, 100.00, '2024-12-15 07:49:01', 2147483647),
(17, 0, 700.00, '2024-12-16 08:01:41', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(0, 'admin1', 'admin1@gmail.com', '$2y$10$Gz6eGPR7Fs7ZH9r1bIBkD.vIioGNVrQCRawDD1xzb2pLkz6ho7J.y', 'admin', '2024-12-10 07:20:44', '2024-12-10 08:38:40'),
(1, 'admin', 'admin@foodrise.com', '0000', 'admin', '2024-12-06 07:20:43', '2024-12-10 00:54:05'),
(2, 'john_doe', 'john@example.com', '$2y$10$hashedpassword456', 'user', '2024-12-06 07:20:43', '2024-12-06 07:20:43'),
(7, 'avocado123', 'avocado123@gmail.com', '$2y$10$Q17flxoohGpqBmMM4mJgvONwPctTvqg4H7tykBHJdv5i8RQXBR8Q6', 'user', '2024-12-08 12:08:54', '2024-12-09 01:24:33'),
(8, 'banana', 'banana@gmail.com', '$2y$10$Ha0yEoflI5M/NQLKZl0lJeqiSIY3XRXFy4QyP2apPxg1WhDVb2vZq', 'user', '2024-12-08 12:09:42', '2024-12-09 01:25:59'),
(9, 'potato123', 'yeapyinger916@gmail.com', '$2y$10$sBUlfcU5.hLLX96WMN4B5ejeB7k/Lpbjvjx/zgRkAwkV/u/y57UgG', 'user', '2024-12-09 01:21:34', '2024-12-16 09:46:03'),
(10, 'hamburger', 'hamburger@gmail.com', '$2y$10$SRjXeG0h.QoJJ/slxjcNK.W3YE6Xq0YOtwsLdd.KW9kaH70yzfjki', 'user', '2024-12-09 01:49:18', '2024-12-09 01:49:39'),
(11, 'chocolate88', 'chocolate@gmail.com', '$2y$10$3BKZB/A/OK9SNDMDXE4RTOzhtpoJXSFnm86w4xw2JrAqf37/8Vxky', 'user', '2024-12-10 00:07:47', '2024-12-15 08:42:17'),
(15, 'espresso', 'espresso@gmail.com', '$2y$10$8CAWpyg8t7xEqYuG77CC5erCBwwbZoEQwNy7fIpHAHTLS/Cpt.nme', 'user', '2024-12-10 08:37:39', '2024-12-10 08:38:55'),
(11111118, 'lily1117', 'lily1117@gmail.com', '$2y$10$bx7R7oD3GvP/Tbu8U68GdOA2DXLRzCJIj76sLLPSJKcVsnpF4XLNS', 'user', '2024-12-14 12:35:49', '2024-12-14 12:35:49'),
(11111119, 'jykoo98', 'jykoo98@gmail.com', '$2y$10$u0cR59WrysJSjGPKRiUBeeux6mDs5jQgdX9wLpWxb2Z.QDI0bMdxC', 'user', '2024-12-14 23:58:35', '2024-12-14 23:58:35'),
(11111120, 'bbbb2222', 'bbbb2222@gmail.com', '$2y$10$g1omcV5hDoACk5Wo8eZ5kOwIB9p89yt1SIBfWklBkZFZ4XDi7bstO', 'user', '2024-12-15 18:35:32', '2024-12-15 18:35:32'),
(11111122, 'yinger1234', 'yinger@gmail.com', '$2y$10$d5/6BwYs8XlXh0HhylZS/O5P9.E.TDZtf5u3yjy7Pyoi8xhZ/AM6S', 'user', '2024-12-16 14:49:03', '2024-12-16 14:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_event`
--

CREATE TABLE `user_event` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_event`
--

INSERT INTO `user_event` (`user_id`, `event_id`, `registration_date`) VALUES
(0, 18, '2024-12-14 12:52:04'),
(2, 3, '2024-06-01 01:15:23'),
(2, 6, '2024-10-15 11:40:21'),
(2, 8, '2024-06-20 02:50:35'),
(7, 10, '2024-11-15 04:00:00'),
(7, 20, '2024-12-15 22:15:44'),
(8, 5, '2024-12-01 00:45:56'),
(8, 7, '2024-09-10 03:25:10'),
(9, 6, '2024-10-21 07:47:18'),
(9, 11, '2024-12-01 23:55:44'),
(9, 15, '2024-12-16 09:49:24'),
(9, 17, '2024-12-09 15:08:47'),
(9, 18, '2024-12-11 04:31:31'),
(10, 6, '2024-10-20 07:47:18'),
(10, 9, '2024-10-25 02:20:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactform`
--
ALTER TABLE `contactform`
  ADD PRIMARY KEY (`contactform_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `food_donations`
--
ALTER TABLE `food_donations`
  ADD PRIMARY KEY (`fooddonation_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `money_donations`
--
ALTER TABLE `money_donations`
  ADD PRIMARY KEY (`money_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_event`
--
ALTER TABLE `user_event`
  ADD PRIMARY KEY (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactform`
--
ALTER TABLE `contactform`
  MODIFY `contactform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `food_donations`
--
ALTER TABLE `food_donations`
  MODIFY `fooddonation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `money_donations`
--
ALTER TABLE `money_donations`
  MODIFY `money_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11111123;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_donations`
--
ALTER TABLE `food_donations`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_donations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_event`
--
ALTER TABLE `user_event`
  ADD CONSTRAINT `user_event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_event_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

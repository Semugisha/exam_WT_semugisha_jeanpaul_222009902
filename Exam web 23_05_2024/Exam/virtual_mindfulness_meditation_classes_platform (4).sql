-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 10:38 PM
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
-- Database: `virtual_mindfulness_meditation_classes_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` enum('registered','attended','cancelled') DEFAULT 'registered',
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`id`, `profile_id`, `class_id`, `status`, `registered_at`) VALUES
(1, 1, 1, 'registered', '2024-05-17 18:01:11'),
(2, 2, 2, 'attended', '2024-05-17 18:01:11'),
(3, 3, 3, 'cancelled', '2024-05-17 18:01:11'),
(4, 4, 4, 'registered', '2024-05-17 18:01:11'),
(5, 5, 5, 'attended', '2024-05-17 18:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `scheduled_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `instructor_id`, `title`, `description`, `scheduled_at`) VALUES
(1, 1, 'Morning Meditation', 'Start your day with a calm mind.', '2024-06-01 06:00:00'),
(2, 2, 'Evening Relaxation', 'Wind down and relax.', '2024-06-01 16:00:00'),
(3, 3, 'Stress Relief', 'Techniques for stress relief.', '2024-06-02 13:00:00'),
(4, 4, 'Focus Meditation', 'Improve your focus and concentration.', '2024-06-03 08:00:00'),
(5, 5, 'Mindfulness Basics', 'Introduction to mindfulness.', '2024-06-04 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `profile_id`, `class_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 1, 5, 'Great session!', '2024-05-17 18:01:12'),
(2, 2, 2, 4, 'Very relaxing.', '2024-05-17 18:01:12'),
(3, 3, 3, 3, 'It was okay.', '2024-05-17 18:01:12'),
(4, 4, 4, 5, 'Loved it!', '2024-05-17 18:01:12'),
(5, 5, 5, 4, 'Good introduction to mindfulness.', '2024-05-17 18:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `name`, `email`, `bio`, `created_at`) VALUES
(1, 'Instructor One', 'inst1@example.com', 'Bio of Instructor One', '2024-05-17 18:01:11'),
(2, 'Instructor Two', 'inst2@example.com', 'Bio of Instructor Two', '2024-05-17 18:01:11'),
(3, 'Instructor Three', 'inst3@example.com', 'Bio of Instructor Three', '2024-05-17 18:01:11'),
(4, 'Instructor Four', 'inst4@example.com', 'Bio of Instructor Four', '2024-05-17 18:01:11'),
(5, 'Instructor Five', 'inst5@example.com', 'Bio of Instructor Five', '2024-05-17 18:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('completed','pending','failed') DEFAULT 'completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `profile_id`, `amount`, `payment_date`, `status`) VALUES
(1, 1, 19.99, '2024-05-01 08:00:00', 'completed'),
(2, 2, 199.99, '2024-01-01 07:00:00', 'completed'),
(3, 3, 19.99, '2024-06-01 06:00:00', 'completed'),
(4, 4, 19.99, '2024-05-15 09:00:00', 'completed'),
(5, 5, 199.99, '2024-03-01 08:30:00', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `created_at`) VALUES
(1, 'john_doe', 'john.doe@example.com', 'password123', 'John', 'Doe', '2024-05-17 18:01:11'),
(2, 'jane_smith', 'jane.smith@example.com', 'password456', 'Jane', 'Smith', '2024-05-17 18:01:11'),
(3, 'alice_jones', 'alice.jones@example.com', 'password789', 'Alice', 'Jones', '2024-05-17 18:01:11'),
(4, 'bob_brown', 'bob.brown@example.com', 'password101', 'Bob', 'Brown', '2024-05-17 18:01:11'),
(5, 'charlie_clark', 'charlie.clark@example.com', 'password202', 'Charlie', 'Clark', '2024-05-17 18:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `resource_name` varchar(100) DEFAULT NULL,
  `resource_type` varchar(50) DEFAULT NULL,
  `resource_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `class_id`, `resource_name`, `resource_type`, `resource_url`) VALUES
(1, 1, 'Introduction Video', 'video', 'http://example.com/video1'),
(2, 2, 'Meditation Guide', 'document', 'http://example.com/guide2'),
(3, 3, 'Stress Relief Audio', 'audio', 'http://example.com/audio3'),
(4, 4, 'Focus Tips', 'document', 'http://example.com/tips4'),
(5, 5, 'Mindfulness Handbook', 'document', 'http://example.com/handbook5');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `class_id`, `day_of_week`, `start_time`, `end_time`, `created_at`) VALUES
(1, 1, 'Monday', '08:00:00', '09:00:00', '2024-05-17 18:01:12'),
(2, 2, 'Wednesday', '18:00:00', '19:00:00', '2024-05-17 18:01:12'),
(3, 3, 'Friday', '15:00:00', '16:00:00', '2024-05-17 18:01:12'),
(4, 4, 'Tuesday', '10:00:00', '11:00:00', '2024-05-17 18:01:12'),
(5, 5, 'Thursday', '09:00:00', '10:00:00', '2024-05-17 18:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `plan` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `profile_id`, `plan`, `start_date`, `end_date`, `created_at`) VALUES
(1, 1, 'Monthly', '2024-05-01', '2024-05-31', '2024-05-17 18:01:12'),
(2, 2, 'Annual', '2024-01-01', '2024-12-31', '2024-05-17 18:01:12'),
(3, 3, 'Monthly', '2024-06-01', '2024-06-30', '2024-05-17 18:01:12'),
(4, 4, 'Monthly', '2024-05-15', '2024-06-14', '2024-05-17 18:01:12'),
(5, 5, 'Annual', '2024-03-01', '2025-02-28', '2024-05-17 18:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profile_id` (`profile_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `attendees_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`);

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

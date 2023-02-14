-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 14 Φεβ 2023 στις 20:39:40
-- Έκδοση διακομιστή: 10.4.22-MariaDB
-- Έκδοση PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `hotel`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `total_price` int(10) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `booking`
--

INSERT INTO `booking` (`booking_id`, `user_id`, `room_id`, `check_in_date`, `check_out_date`, `total_price`, `created_time`, `updated_time`) VALUES
(1, 1, 1, '2022-07-01', '2022-08-10', 100, '2023-01-15 12:58:32', '2023-01-15 12:58:32'),
(2, 1, 2, '2022-08-09', '2022-08-23', 400, '2023-01-15 12:58:32', '2023-01-15 14:29:50'),
(7, 30, 1, '2022-08-09', '2022-08-13', 1400, '2023-02-02 21:54:20', '2023-02-02 21:54:20'),
(9, 30, 3, '2023-02-17', '2023-02-25', 3360, '2023-02-02 22:06:31', '2023-02-02 22:06:31'),
(10, 30, 6, '2023-02-12', '2023-02-18', 1920, '2023-02-05 21:17:22', '2023-02-05 21:17:22'),
(16, 30, 6, '2023-05-01', '2023-05-03', 640, '2023-02-13 18:49:37', '2023-02-13 18:49:37');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `favorite`
--

CREATE TABLE `favorite` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `favorite`
--

INSERT INTO `favorite` (`user_id`, `room_id`, `created_time`, `updated_time`) VALUES
(30, 1, '2023-02-08 20:22:41', '2023-02-08 20:22:41'),
(30, 3, '2023-02-12 10:01:16', '2023-02-12 10:01:16'),
(30, 5, '2023-02-13 18:32:31', '2023-02-13 18:32:31'),
(30, 6, '2023-02-05 21:17:55', '2023-02-05 21:17:55');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `review`
--

CREATE TABLE `review` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `rate` int(10) UNSIGNED NOT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `review`
--

INSERT INTO `review` (`review_id`, `room_id`, `user_id`, `rate`, `comment`, `created_time`, `updated_time`) VALUES
(1, 2, 30, 4, 'Vivamus congue, augue non efficitur imperdiet, risus justo egestas dolor, ut faucibus augue risus et nulla. Cras finibus ipsum in ex rhoncus rhoncus. Mauris hendrerit nisi gravida, malesuada ipsum mattis, facilisis felis. Proin blandit libero enim,', '2023-01-31 21:47:28', '2023-02-01 19:15:48'),
(2, 2, 2, 3, 'Vivamus congue, augue non efficitur imperdiet, risus justo egestas dolor, ut faucibus augue risus et nulla. Cras finibus ipsum in ex rhoncus rhoncus. Mauris hendrerit nisi gravida, malesuada ipsum mattis, ', '2023-02-01 19:16:59', '2023-02-01 19:17:14'),
(3, 2, 30, 3, 'TEst review From Form', '2023-02-01 19:33:42', '2023-02-01 19:33:42'),
(15, 2, 30, 1, 'TEst review From Form for Updating Average', '2023-02-01 20:26:45', '2023-02-01 20:26:45'),
(16, 1, 30, 3, 'Test Review from Form', '2023-02-02 18:52:42', '2023-02-02 18:52:42'),
(18, 1, 30, 2, 'Second Test Review with Synch update', '2023-02-05 18:06:04', '2023-02-05 18:06:04'),
(19, 6, 30, 3, 'Quicktest review', '2023-02-05 21:17:52', '2023-02-05 21:17:52'),
(24, 1, 30, 4, 'tEST', '2023-02-08 22:21:15', '2023-02-08 22:21:15'),
(27, 1, 30, 3, 'Ajax Test', '2023-02-08 22:35:24', '2023-02-08 22:35:24'),
(28, 1, 30, 4, 'Ajax Test 2', '2023-02-08 22:36:17', '2023-02-08 22:36:17'),
(29, 3, 30, 4, 'Network Test', '2023-02-09 21:33:11', '2023-02-09 21:33:11'),
(30, 1, 30, 3, 'CSRF Test', '2023-02-11 12:05:42', '2023-02-11 12:05:42'),
(32, 1, 30, 3, 'Test Injection <script>alert(\'Test Injection\');</script>', '2023-02-11 12:18:51', '2023-02-11 12:18:51'),
(33, 3, 30, 4, 'ANother test', '2023-02-11 14:05:25', '2023-02-11 14:05:25'),
(34, 3, 30, 4, 'Another nother test', '2023-02-11 14:09:53', '2023-02-11 14:09:53'),
(35, 5, 30, 3, 'Finale Test Review', '2023-02-13 18:32:48', '2023-02-13 18:32:48');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `room`
--

CREATE TABLE `room` (
  `room_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `city` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `photo_url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `count_of_guests` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `address` varchar(250) CHARACTER SET utf8 NOT NULL,
  `location_lat` decimal(10,7) NOT NULL,
  `location_long` decimal(10,7) NOT NULL,
  `description_short` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description_long` text COLLATE utf8_unicode_ci NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `wifi` tinyint(1) NOT NULL,
  `pet_friendly` tinyint(1) NOT NULL,
  `avg_reviews` decimal(10,7) DEFAULT NULL,
  `count_reviews` int(10) UNSIGNED DEFAULT 0,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `room`
--

INSERT INTO `room` (`room_id`, `type_id`, `name`, `city`, `area`, `photo_url`, `count_of_guests`, `price`, `address`, `location_lat`, `location_long`, `description_short`, `description_long`, `parking`, `wifi`, `pet_friendly`, `avg_reviews`, `count_reviews`, `created_time`, `updated_time`) VALUES
(1, 1, 'Hilton Hotel', 'Athens', 'Zwgrafou', 'room-1.jpg', 1, 350, 'Vasilis Sofeias 38', '37.9767030', '23.7504170', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n\r\nVestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.', 1, 1, 0, '3.1429000', 7, '2020-05-28 20:15:36', '2023-02-11 12:16:45'),
(2, 2, 'Megali Vretania Hotel', 'Athens', 'Syntagma', 'room-2.jpg', 2, 500, 'Vasilis Olgas, 115', '37.9765250', '23.7353970', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 0, '2.7500000', 4, '2020-05-28 20:15:36', '2023-02-01 20:26:45'),
(3, 3, 'Apollo Hotel', 'Athens', 'Kentro', 'room-3.jpg', 3, 420, 'Achilleos 10', '37.9853780', '23.7199320', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 1, '4.0000000', 3, '2020-05-28 20:15:36', '2023-02-11 14:09:53'),
(4, 2, 'Oscar Hotel', 'Athens', 'Kentro', 'room-4.jpg', 2, 250, 'Filadelfias 25', '37.9973410', '23.7219820', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 0, 1, 0, NULL, 0, '2020-05-28 20:15:36', '2020-05-28 20:15:36'),
(5, 2, 'Anatolia Hotel', 'Thessaloniki', 'Kentro', 'room-5.jpg', 2, 400, 'Lagkada 13', '40.6477560', '22.9342730', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 1, '3.0000000', 1, '2020-05-28 20:15:36', '2023-02-13 18:32:48'),
(6, 3, 'Nea Metropolis Hotel', 'Thessaloniki', 'Kentro', 'room-6.jpg', 3, 320, 'Siggrou 22', '40.6446290', '22.9409210', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 0, 1, 0, '3.0000000', 1, '2020-05-28 20:15:36', '2023-02-05 21:17:52'),
(7, 2, 'Airotel Galaxy Hotel', 'Kavala', 'Kentro', 'room-7.jpg', 2, 170, 'El. Venizelou 27', '40.9431210', '24.4100360', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 1, NULL, 0, '2020-05-28 20:15:36', '2020-05-28 20:15:36'),
(8, 4, 'Egnatia City Hotel', 'Kavala', 'Kentro', 'room-8.jpg', 4, 280, '7is Merarchias 139', '40.9479970', '24.3874950', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.', 1, 1, 0, NULL, 0, '2020-05-28 20:15:36', '2020-05-28 20:15:36'),
(9, 2, 'Villa Manos Hotel Santorini', 'Santorini', 'Xwra', 'room-9.jpg', 2, 300, 'Karterados', '36.4131770', '25.4478070', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.', 0, 1, 0, NULL, 0, '2020-05-28 20:15:36', '2020-05-28 20:15:36'),
(10, 3, 'Volcano View Hotel Santorini', 'Santorini', 'Xwra', 'room-10.jpg', 3, 410, 'Fira', '36.4006410', '25.4377640', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 0, NULL, 0, '2020-05-28 20:15:36', '2020-05-28 20:15:36');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `room_type`
--

CREATE TABLE `room_type` (
  `type_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `room_type`
--

INSERT INTO `room_type` (`type_id`, `title`) VALUES
(1, 'Single Room'),
(2, 'Double Room'),
(3, 'Triple Room'),
(4, 'Fourfold Room');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `created_time`, `updated_time`) VALUES
(1, 'hotel_admin', 'hotel_admin@collegelink.gr', '', '2020-05-28 20:15:35', '2020-05-28 20:15:35'),
(2, 'hotel_user', 'hotel_pwruser@gmail.com', 'PASSWORD', '2022-12-28 20:47:59', '2022-12-28 20:56:23'),
(5, 'Example-User', 'eg@example.com', 'asdfasdf1234', '2023-01-12 19:48:22', '2023-01-12 19:48:22'),
(7, 'Hash-Example-User', 'hasheg@example.com', '$2y$10$jtGpZMWyY/T3CPNBGQoN1.gotGlcvaK5rWYzd4xU4HWKSGX8SW7di', '2023-01-12 20:03:20', '2023-01-12 20:03:20'),
(30, 'ShockRates', 'blackhound55@gmail.com', '$2y$10$HgpTdbQxAL0nSJ1Bv3a5eODWq1K7n0rTKL3cbkc.eQupVZOmiZ1tS', '2023-01-31 20:29:09', '2023-01-31 20:29:09'),
(31, 'test', 'test@test.com', '$2y$10$MpH0SFreGjIyJuTSYF.WaORAGIUm0yfpEh3XGuWdbKPTpKdf25gUe', '2023-02-11 15:29:00', '2023-02-11 15:29:00');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_booking__room_idx` (`room_id`),
  ADD KEY `fk_booking__user_idx` (`user_id`);

--
-- Ευρετήρια για πίνακα `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`user_id`,`room_id`),
  ADD KEY `fk_favorite__room_idx` (`room_id`);

--
-- Ευρετήρια για πίνακα `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_review__room_idx` (`room_id`),
  ADD KEY `fk_review__user_idx` (`user_id`);

--
-- Ευρετήρια για πίνακα `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `fk_room__room_type_idx` (`type_id`);

--
-- Ευρετήρια για πίνακα `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Ευρετήρια για πίνακα `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT για πίνακα `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT για πίνακα `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `room_type`
--
ALTER TABLE `room_type`
  MODIFY `type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_favorite__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_favorite__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room__room_type` FOREIGN KEY (`type_id`) REFERENCES `room_type` (`type_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

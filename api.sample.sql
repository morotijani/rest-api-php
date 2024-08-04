-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 06:53 PM
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
-- Database: `api..sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_users`
--

CREATE TABLE `api_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `api_users`
--

INSERT INTO `api_users` (`id`, `name`, `username`, `password_hash`, `api_key`) VALUES
(1, 'tijani babson', 'priest', '$2y$10$E8It2CKus0uyav45JUD7quFhQAM.Kgc2s.afZmHU/G46ysMeK0Q.y', '');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` bigint(20) NOT NULL,
  `house_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `house_name` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `house_id`, `user_id`, `house_name`, `createdAt`, `updatedAt`, `status`) VALUES
(1, '61e354b8-e738-4732-9901-34e55b277b54', '182a7193-fc47-401e-a106-1e4f90361a9f', 'VK', '2024-08-02 20:23:56', '2024-08-02 20:45:05', 0),
(2, 'ba84d2b3-50e9-4a0e-8739-080ce4a1ed3b', '182a7193-fc47-401e-a106-1e4f90361a9f', 'GOT', '2024-08-02 20:34:13', NULL, 0),
(3, '04c0bd39-7005-480c-85b2-4bf10b88f171', '182a7193-fc47-401e-a106-1e4f90361a9f', 'HOD', '2024-08-02 22:38:10', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `refresh_token`
--

CREATE TABLE `refresh_token` (
  `token_hash` varchar(255) NOT NULL,
  `expires_at` int(128) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refresh_token`
--

INSERT INTO `refresh_token` (`token_hash`, `expires_at`) VALUES
('084ad586cb7e383585a7fc0832da9b3c0ebae03e357a2bd816fc8907bd6ea3aa', 1722982388),
('321710c9fc9b0bbcbfcb1ca28b96205d57120eb079e6574a862db5f99caa2ae7', 1722984373),
('620e63e5b6b9ee5043915a963e93b850ac0af8aa264db9d0f9b163c27c7f418f', 1722983322),
('67d974929328086e2bf3bd9efc94397a117f40a37e820b943a9bf24bc7e84a81', 1722987146),
('78ed9af1e6b79c45a39e44fa014209c81ae8f101b6576c8f63d97169b901e442', 1722984385),
('7f4b82549cfba5b99d0bbf4bd3b53fe6b257e356b13e9463ad270b8d88144313', 1722954177),
('a2e11f2016b26c786cca64b16a5aea4c4beb31c50230ab86570f34f8e2c22111', 1722954566);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(300) DEFAULT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(50) DEFAULT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_gender` varchar(200) NOT NULL,
  `user_country` varchar(255) DEFAULT NULL,
  `user_state` varchar(225) DEFAULT NULL,
  `user_city` varchar(225) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_address2` varchar(255) NOT NULL,
  `user_postcode` varchar(50) NOT NULL,
  `user_company` varchar(255) NOT NULL,
  `user_verified` tinyint(1) NOT NULL DEFAULT 0,
  `user_vericode` varchar(50) NOT NULL,
  `user_joined_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_last_login` datetime DEFAULT NULL,
  `user_trash` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_fullname`, `user_email`, `user_phone`, `user_password`, `user_gender`, `user_country`, `user_state`, `user_city`, `user_address`, `user_address2`, `user_postcode`, `user_company`, `user_verified`, `user_vericode`, `user_joined_date`, `user_last_login`, `user_trash`) VALUES
(4, '2b5c1bd5-3e2a-4e6a-b9de-910695014618', 'priest1', 'tj@email.com', NULL, '$2y$10$kGwusAg1CFnfZtBpKNoKE.k94Z3YkGcLMToffglhnRmE49fbHI09S', '', NULL, NULL, NULL, NULL, '', '', '', 1, '0934e04483188fb8a5ef0c4036f8ba2d', '2024-06-29 09:32:23', NULL, 0),
(7, '182a7193-fc47-401e-a106-1e4f90361a9f', 'tijani', 'tjhackx111@gmail.com', NULL, '$2y$10$ikZZDgf0YC0bYuZhaOWEmOoGSjTVAHdsReCuREebOOK8Y/f.AUIUq', '', NULL, NULL, NULL, NULL, '', '', '', 1, '1e7336b36d2204a7511f75911b1f4b87', '2024-07-04 15:08:22', NULL, 0),
(42, '121212', 'tanko', 'va@gmail.com', NULL, 'wkefnk', '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '2024-07-30 18:22:40', NULL, 0),
(43, '56df2c2a-9ce2-4d2c-a292-c6f004e4d03e', 'wknfw', 'wqwq@wfwe.com', NULL, 'wkefnk', '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '2024-07-30 18:33:35', NULL, 0),
(44, 'cd0a71ce-9ce0-40b8-af24-3a46d946a185', 'udated username', 'email@email.com', NULL, 'wkefnk', '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '2024-07-30 18:56:32', NULL, 0),
(65, 'e176da93-3503-4df8-b1a9-f097b668efff', 'priest', 'tijanimoro0684@outlok.com', NULL, 'password', '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '2024-08-01 22:09:04', NULL, 0),
(67, '121bb616-05f3-41bc-8c85-910edcf0dfff', 'priest3', 't@jmail.com', NULL, 'password', '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '2024-08-01 23:23:22', NULL, 0),
(68, 'f8608d89-9eb7-4726-bd4d-2b72ed62aafd', 'priest', 'user@email.com', NULL, '12345', '', NULL, NULL, NULL, NULL, '', '', '', 0, '', '2024-08-02 16:48:06', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_users`
--
ALTER TABLE `api_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refresh_token`
--
ALTER TABLE `refresh_token`
  ADD PRIMARY KEY (`token_hash`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_phone` (`user_phone`),
  ADD KEY `user_country` (`user_country`),
  ADD KEY `user_state` (`user_state`),
  ADD KEY `user_trash` (`user_trash`),
  ADD KEY `user_fullname` (`user_fullname`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `user_postcode` (`user_postcode`),
  ADD KEY `user_company` (`user_company`),
  ADD KEY `user_city` (`user_city`) USING BTREE,
  ADD KEY `user_gender` (`user_gender`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_users`
--
ALTER TABLE `api_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

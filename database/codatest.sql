-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2022 at 05:51 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codatest`
--

-- --------------------------------------------------------

--
-- Table structure for table `mia_active`
--

CREATE TABLE `mia_active` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `token` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mia_item_role`
--

CREATE TABLE `mia_item_role` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `item_id` bigint(20) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `type` int(2) NOT NULL DEFAULT 0,
  `permission_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mia_log`
--

CREATE TABLE `mia_log` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `type_id` int(3) NOT NULL DEFAULT 0,
  `item_id` bigint(20) NOT NULL DEFAULT 0,
  `data` text DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mia_permission`
--

CREATE TABLE `mia_permission` (
  `id` int(11) NOT NULL,
  `title` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mia_recovery`
--

CREATE TABLE `mia_recovery` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `token` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mia_role`
--

CREATE TABLE `mia_role` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mia_role`
--

INSERT INTO `mia_role` (`id`, `title`, `parent_id`) VALUES
(1, 'Admin', NULL),
(2, 'Editor', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mia_role_access`
--

CREATE TABLE `mia_role_access` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mia_user`
--

CREATE TABLE `mia_user` (
  `id` bigint(20) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `photo` text DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `facebook_id` varchar(100) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `password` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `is_notification` int(1) NOT NULL DEFAULT 0,
  `caption` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mia_user`
--

INSERT INTO `mia_user` (`id`, `firstname`, `lastname`, `email`, `photo`, `phone`, `facebook_id`, `role`, `created_at`, `updated_at`, `deleted`, `password`, `status`, `is_notification`, `caption`) VALUES
(1, 'empty', '', 'matias@agencycoda.com', '', '', NULL, 0, '2021-07-27 12:32:21', '2022-02-09 12:32:21', 0, '$2y$10$giSRwmR8uCrRLRupj8GYT.riEOH1GdF7xfGpn7kM9OjAc1DZ0Trgy', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mia_active`
--
ALTER TABLE `mia_active`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mia_item_role`
--
ALTER TABLE `mia_item_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mia_log`
--
ALTER TABLE `mia_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mia_permission`
--
ALTER TABLE `mia_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mia_recovery`
--
ALTER TABLE `mia_recovery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mia_role`
--
ALTER TABLE `mia_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mia_role_access`
--
ALTER TABLE `mia_role_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mia_user`
--
ALTER TABLE `mia_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_user_idx` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mia_active`
--
ALTER TABLE `mia_active`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mia_item_role`
--
ALTER TABLE `mia_item_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mia_log`
--
ALTER TABLE `mia_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mia_permission`
--
ALTER TABLE `mia_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mia_recovery`
--
ALTER TABLE `mia_recovery`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mia_role`
--
ALTER TABLE `mia_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mia_role_access`
--
ALTER TABLE `mia_role_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mia_user`
--
ALTER TABLE `mia_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_user` FOREIGN KEY (`user_id`) REFERENCES `mia_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

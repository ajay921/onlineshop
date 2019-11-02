-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2019 at 07:09 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cias`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `isDeleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 for inactive 1 for active',
  `createdBy` int(11) DEFAULT NULL,
  `createdDtm` datetime DEFAULT NULL COMMENT 'CURRENT_TIMESTAMP',
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `name`, `slug`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'Samsung', 'samsung', '0', NULL, '2019-10-31 18:25:34', NULL, '2019-10-31 22:55:34'),
(2, 'Nokia', 'nokia', '0', NULL, '2019-11-02 06:08:59', NULL, '2019-11-02 10:38:59'),
(3, 'Oppoo', 'oppo', '0', NULL, '2019-11-02 06:09:11', 10, '2019-11-02 07:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(1, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-29 22:48:22'),
(2, 10, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Ajay Gupta\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-29 23:56:21'),
(3, 10, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Ajay Gupta\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-29 23:57:52'),
(4, 10, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Ajay Gupta\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-30 21:48:41'),
(5, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Gupta\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-30 21:51:34'),
(6, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Gupta\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-30 22:56:10'),
(7, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Gupta\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-30 23:02:02'),
(8, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Gupta\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-30 23:02:59'),
(9, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Gupta\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-30 23:08:03'),
(10, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Gupta\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-30 23:08:12'),
(11, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-30 23:10:57'),
(12, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-30 23:11:21'),
(13, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-30 23:43:50'),
(14, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-31 21:35:46'),
(15, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-10-31 22:09:35'),
(16, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-11-01 21:08:03'),
(17, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-11-02 00:55:30'),
(18, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-11-02 10:17:21'),
(19, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-11-02 11:57:35'),
(20, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-11-02 11:58:24'),
(21, 10, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"Ajay Kumar\"}', '::1', 'Chrome 77.0.3865.120', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 'Windows 10', '2019-11-02 21:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(100) NOT NULL,
  `product_image` varchar(250) DEFAULT NULL,
  `isDeleted` enum('0','1') NOT NULL DEFAULT '0',
  `createdBy` int(11) DEFAULT NULL,
  `createdDtm` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `category_id`, `product_name`, `description`, `slug`, `product_image`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 1, 'Dsfsfsdfsdfsdfsd', 'sdfssdfsdfdsfdfs', 'dsf', '01aa187410f7d14b5cba803653efda8a.jpeg', '0', NULL, '2019-11-01 19:03:24', NULL, '2019-11-01 23:33:24'),
(2, 1, 'Dsf', 'sdfsvxcvxc', 'dsf-1', '', '0', NULL, '2019-11-01 19:29:40', NULL, '2019-11-01 23:59:40'),
(3, 1, 'Dsf', 'sdfssdsdfsd', 'dsf-1', '', '0', NULL, '2019-11-01 19:30:22', NULL, '2019-11-02 00:00:22'),
(4, 1, 'Dsf', 'sdfs', 'dsf-1', '', '0', NULL, '2019-11-01 19:30:56', 10, '2019-11-01 19:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reset_password`
--

INSERT INTO `tbl_reset_password` (`id`, `email`, `activation_id`, `agent`, `client_ip`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'ajay@gmail.com', 'qDln0mgpeyNRwGu', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-10-30 19:02:36', NULL, NULL),
(2, 'ajay@gmail.com', '8OM3Eqf9lHiNaBn', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-10-30 19:02:46', NULL, NULL),
(3, 'ajaycool.gupta9@gmail.com', 'ditZUC9zh6PFOna', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:40:51', NULL, NULL),
(4, 'ajaycool.gupta9@gmail.com', '53u98B2UqpkKQAG', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:44:11', NULL, NULL),
(5, 'ajaycool.gupta9@gmail.com', 'Xug0yUaGD4wcQNP', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:45:48', NULL, NULL),
(6, 'ajaycool.gupta9@gmail.com', 'A4EbOUzZJiFkISt', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:46:13', NULL, NULL),
(7, 'ajaycool.gupta9@gmail.com', 'A15PSFYc9HaxB4L', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:46:50', NULL, NULL),
(8, 'ajaycool.gupta9@gmail.com', 'NAxCKmRUk43GbVg', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:47:29', NULL, NULL),
(9, 'ajaycool.gupta9@gmail.com', 'YRVfsrmCu2jlBF7', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:54:55', NULL, NULL),
(10, 'ajaycool.gupta9@gmail.com', 'VkhGz9WYpOACb8c', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:55:47', NULL, NULL),
(11, 'ajaycool.gupta9@gmail.com', 'VGaEYmNyZM9h4W5', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:56:10', NULL, NULL),
(12, 'aj.gupta452@gmail.com', 'zqC2s3fkZipyeQA', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:58:13', NULL, NULL),
(13, 'aj.gupta452@gmail.com', 'HqI3LojyNz1mBGh', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 18:59:31', NULL, NULL),
(14, 'aj.gupta452@gmail.com', 'FmizuTgG3vlPWR5', 'Chrome 77.0.3865.120', '::1', 0, 1, '2019-11-02 19:00:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Manager'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `oauth_provider` enum('','facebook','google') DEFAULT NULL,
  `oauth_uid` varchar(100) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `address` text,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) DEFAULT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `oauth_provider`, `oauth_uid`, `gender`, `picture`, `link`, `mobile`, `roleId`, `address`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@example.com', '$2y$10$6NOKhXKiR2SAgpFF2WpCkuRgYKlSqFJaqM0NgIM3PT1gKHEM5/SM6', 'System Administrator', NULL, NULL, NULL, NULL, NULL, '9890098900', 1, NULL, 0, 0, '2015-07-01 18:56:49', 1, '2018-01-05 05:56:34'),
(2, 'manager@example.com', '$2y$10$quODe6vkNma30rcxbAHbYuKYAZQqUaflBgc4YpV9/90ywd.5Koklm', 'Manager', NULL, NULL, NULL, NULL, NULL, '9890098900', 2, NULL, 0, 1, '2016-12-09 17:49:56', 1, '2018-01-12 07:22:11'),
(3, 'employee@example.com', '$2y$10$UYsH1G7MkDg1cutOdgl2Q.ZbXjyX.CSjsdgQKvGzAgl60RXZxpB5u', 'Employee', NULL, NULL, NULL, NULL, NULL, '9890098900', 3, NULL, 0, 1, '2016-12-09 17:50:22', 3, '2018-01-04 07:58:28'),
(10, 'ajay@gmail.com', '$2y$10$B2gjBx0DxJ2BZeA3EXQ2uulh8MdQq/7c7Geq5wDZoDGdU9hJhCjie', 'Ajay Kumar', NULL, NULL, NULL, NULL, NULL, '9988188921', 1, 'test', 0, NULL, '2019-10-29 19:25:55', 10, '2019-10-30 18:40:46'),
(12, 'akhil@gmail.com', '$2y$10$zIgUoREQjV3mC59nMRUmsOPS4kLZUn3pJNrxFZfS3I45hrWyc1P2K', 'Akhil', NULL, NULL, NULL, NULL, NULL, '3453453454', 3, NULL, 0, 10, '2019-10-30 18:45:58', NULL, NULL),
(13, 'aj.gupta452@gmail.com', '', 'Ajay Gupta', 'facebook', '2512556882169534', NULL, 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2512556882169534&height=50&width=50&ext=1575306376&hash=AeTkw7f9eCfmswKT', NULL, NULL, 1, NULL, 0, NULL, '2019-11-02 17:58:55', NULL, '2019-11-02 18:06:16'),
(15, 'karan@gmail.com', '$2y$10$gTuQEdHVHnal7DH.w3Mg/u5e81aZ5I.yf4f5Y0H45QgCczss8Fmhu', 'Karan', NULL, NULL, NULL, NULL, NULL, '9988188921', 2, 'hhgjh', 0, NULL, '2019-11-02 18:27:38', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

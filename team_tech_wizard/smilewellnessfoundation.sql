-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2024 at 06:01 AM
-- Server version: 5.7.44-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smilewellnessfoundation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `admin_role_type` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `Mno` bigint(11) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_creation_time` datetime NOT NULL,
  `token_email` varchar(255) NOT NULL,
  `verification_status` int(1) NOT NULL DEFAULT '0',
  `password_code` int(11) NOT NULL,
  `password_token` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `login_attempts` int(11) NOT NULL DEFAULT '0',
  `disabled_account` int(11) NOT NULL DEFAULT '1',
  `account_created_by` varchar(255) NOT NULL,
  `visibility` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `full_name`, `admin_role_type`, `email_id`, `Mno`, `police_station`, `gender`, `password`, `account_creation_time`, `token_email`, `verification_status`, `password_code`, `password_token`, `ip_address`, `login_attempts`, `disabled_account`, `account_created_by`, `visibility`) VALUES
(1, 'Ritwik Dalmia', 'admin', 'dalmiaritwik@gmail.com', 9971655508, 'Rajasthan Police', 'male', '$2y$10$H4KOdxp4RzpZ/heslec8Ku1F/KW19xSTB92.ZwpALexNesa4f2xZa', '2023-12-18 13:18:50', '0', 1, 1, 'fb385c91ee9b798abf5d1f90675efc', '223.190.84.200', 0, 1, '', ''),
(2, 'Somya Raghav', 'station-admin', 'ritwik.esports@gmail.com', 9971655501, 'sadar_bazaar2@gmail.com', 'female', '$2y$10$QEfVtzQNFm9gbs72bfEyI.1pfGacwVWEq5vNUGMS8dbb3kCyavQCG', '2023-12-20 14:11:32', '0', 1, 0, '', '223.190.80.75', 0, 1, 'dalmiaritwik@gmail.com', ''),
(3, 'ritika kumar', 'moderator', 'codingwithdalmia@gmail.com', 9971655212, 'sadar_bazaar2@gmail.com', 'female', '$2y$10$QEfVtzQNFm9gbs72bfEyI.1pfGacwVWEq5vNUGMS8dbb3kCyavQCG', '2023-12-20 14:11:32', '0', 1, 0, '', '223.190.80.75', 0, 1, 'dalmiaritwik@gmail.com', ''),
(4, 'isha', 'feedback', 'ritikadalmia16@gmail.com', 9971655222, 'sadar_bazaar2@gmail.com', 'female', '$2y$10$suSv2WobGNoPOWKpvlAjGukpJrGJtTWUIGwevx0c3eUVvPxkyvvLW', '2024-01-14 19:57:34', '0', 1, 0, '', '223.190.86.115', 0, 1, 'ritwik.esports@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_change_address`
--

CREATE TABLE `admin_change_address` (
  `address_id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `issue_addressed_by` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_change_address`
--

INSERT INTO `admin_change_address` (`address_id`, `email_id`, `address`, `state`, `city`, `zip`, `police_station`, `file_upload`, `comment`, `issue_addressed_by`, `permission`) VALUES
(1, 'dalmiaritwik@gmail.com', '1321', 'Haryanaa', 'Gurugramm', 122002, '', 'users_images/1705253538_bt 1111.pdf', 'approved', 'dalmiaritwik@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile`
--

CREATE TABLE `admin_profile` (
  `admin_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `Mno` bigint(10) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT 'NULL',
  `state` varchar(255) NOT NULL DEFAULT 'NULL',
  `city` varchar(255) NOT NULL DEFAULT 'NULL',
  `zip` int(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_profile`
--

INSERT INTO `admin_profile` (`admin_id`, `full_name`, `email_id`, `Mno`, `police_station`, `gender`, `address`, `state`, `city`, `zip`) VALUES
(1, 'ritwik dalmia', 'dalmiaritwik@gmail.com', 9971155508, 'rajasthan police', 'male', '1320', 'maruti vihar', 'gurugram', 122002),
(2, 'somya raghav', 'ritwik.esports@gmail.com', 9971655501, 'sadar_bazaar2@gmail.com', 'female', '1320-A', 'Maruti vihar', 'gurugram', 122002),
(3, 'ritika kumar', 'codingwithdalmia@gmail.com', 9971655212, 'sadar_bazaar2@gmail.com', 'female', '1320-B', 'maruti vihar', 'gurugram', 122002),
(4, 'isha', 'ritikadalmia16@gmail.com', 9971655222, 'sadar_bazaar2@gmail.com', 'female', '1320-c', 'Maruti vihar', 'gurugram', 122002);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `admin_role_id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `admin_role_type` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `role_available` varchar(255) NOT NULL DEFAULT 'available',
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`admin_role_id`, `email_id`, `admin_role_type`, `description`, `role_available`, `create_datetime`) VALUES
(1, 'dalmiaritwik@gmail.com', 'admin', 'administration power', 'not available', '2023-12-18 00:13:12'),
(2, 'dalmiaritwik@gmail.com', 'moderator', 'Moderator power', 'available', '2023-12-18 00:13:12'),
(3, 'dalmiaritwik@gmail.com', 'feedback', 'feedback power', 'available', '2023-12-18 00:13:12'),
(4, 'dalmiaritwik@gmail.com', 'station-admin', 'station incharge admin power', 'available', '2023-12-18 22:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `application_request`
--

CREATE TABLE `application_request` (
  `complaint_id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL DEFAULT '2',
  `full_name` varchar(255) NOT NULL,
  `Mno` bigint(11) NOT NULL,
  `incident_date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `police_station_user` varchar(255) NOT NULL,
  `complaint_date` date NOT NULL,
  `registered_by` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `description_complaint` longtext NOT NULL,
  `complaint_assigned_to` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `shareability` varchar(3) NOT NULL,
  `feedback_permission` int(11) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `email_sent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application_request`
--

INSERT INTO `application_request` (`complaint_id`, `email_id`, `permission`, `full_name`, `Mno`, `incident_date`, `address`, `state`, `city`, `zip`, `police_station`, `police_station_user`, `complaint_date`, `registered_by`, `ip_address`, `description_complaint`, `complaint_assigned_to`, `feedback`, `shareability`, `feedback_permission`, `user_rating`, `email_sent`) VALUES
(55, 'dalmiaritwik@gmail.com', 0, 'Ritwik Dalmia', 9971655508, '2024-01-11', '1320', 'Haryana', 'Gurugram', 122002, 'sadar_bazaar2@gmail.com', 'sadar bazaar 122002', '2024-01-17', '', '103.255.11.205', 'robbery', 'ritika kumari', '', '', 0, 0, 1),
(56, 'dalmiaritwik@gmail.com', 0, 'Ritwik Dalmia', 9971655508, '2024-01-15', '1320', 'Haryana', 'Gurugram', 122002, 'sadar_bazaar2@gmail.com', 'sadar bazaar 122002', '2024-01-17', '', '103.255.11.205', 'murder\r\n', 'ritika kumari', 'good', 'no', 1, 4, 0),
(57, 'dalmiaritwik12@gmail.com', 1, 'ritika dalmia', 9971655534, '2024-01-16', '1320-A', 'haryana', 'Gurugram', 122002, 'sadar_bazaar2@gmail.com', 'sadar bazaar 122002', '2024-01-17', 'dalmiaritwik@gmail.com', '103.255.11.205', 'murder', 'rohan kumar', 'bad', 'yes', 1, 3, 0),
(58, 'dalmiaritwik@gmail.com', 2, 'Ritwik Dalmia', 9971655508, '2024-01-12', '1320', 'Haryana', 'Gurugram', 122002, 'sadar_bazaar2@gmail.com', 'sadar bazaar 122002', '2024-01-17', '', '103.255.11.205', 'bike stolen', '', '', '', 0, 0, 0),
(59, 'dalmiaritwik122@gmail.com', 2, 'ritika', 9971615154, '2024-01-13', '1320-H', 'Haryana', 'Gurugram', 122002, 'sadar_bazaar2@gmail.com', 'sadar bazaar 122002', '2024-01-17', 'dalmiaritwik@gmail.com', '103.255.11.205', 'robbery diamond', '', '', '', 0, 0, 0),
(60, 'codingwithdalmia@gmail.com', 0, 'isha', 2345612345, '2024-01-13', '1320-B', 'Haryana', 'Gurugram', 122002, 'sadar_bazaar2@gmail.com', 'sadar bazaar 122002', '2024-01-17', 'dalmiaritwik@gmail.com', '103.255.11.205', 'killed cat', 'mohan singh', 'nice ', 'yes', 1, 5, 0),
(61, 'ritwik.esports@gmail.com', 1, 'ritwik dalmia', 9971655501, '2024-01-10', '1320-A', 'haryana', 'gurugram', 122002, 'sadar_bazaar1@gmail.com', 'sadar bazaar 122001', '2024-01-17', '', '103.255.11.205', 'murder', 'ritika kumari', '', '', 0, 0, 0),
(62, 'ritwik.esports@gmail.com', 0, 'ritwik dalmia', 9971655501, '2024-01-16', '1320-A', 'haryana', 'gurugram', 122002, 'sadar_bazaar1@gmail.com', 'sadar bazaar 122001', '2024-01-17', '', '103.255.11.205', 'murder', 'rohan kumar', 'excellent', 'yes', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `change_address`
--

CREATE TABLE `change_address` (
  `address_id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `new_police_station` varchar(255) NOT NULL,
  `file_upload` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `issue_addressed_by` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `change_address`
--

INSERT INTO `change_address` (`address_id`, `email_id`, `address`, `state`, `city`, `zip`, `police_station`, `new_police_station`, `file_upload`, `comment`, `issue_addressed_by`, `permission`) VALUES
(2, 'dalmiaritwik@gmail.com', '1320', 'haryana', 'gurugram', 122002, 'sadar_bazaar1@gmail.com', 'sadar_bazaar1@gmail.com', 'users_images/1705153876_resume.pdf', 'wrong file updated', 'dalmiaritwik@gmail.com', 2),
(4, 'ritwik.esports@gmail.com', '1320-A', 'haryana', 'gurugram', 122002, 'sadar_bazaar2@gmail.com', 'sadar_bazaar2@gmail.com', 'users_images/1705153876_ritwik_dalmia.pdf', 'approved', 'dalmiaritwik@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `police_station_list`
--

CREATE TABLE `police_station_list` (
  `police_station_id` int(11) NOT NULL,
  `police_station_name` varchar(255) NOT NULL,
  `police_station_address` varchar(255) NOT NULL,
  `police_station_pincode` int(6) NOT NULL,
  `police_station_incharge` varchar(255) NOT NULL,
  `police_station_number` bigint(11) NOT NULL,
  `emergency_no` bigint(11) NOT NULL,
  `head_of_station` varchar(255) NOT NULL,
  `police_email_id` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `police_station_list`
--

INSERT INTO `police_station_list` (`police_station_id`, `police_station_name`, `police_station_address`, `police_station_pincode`, `police_station_incharge`, `police_station_number`, `emergency_no`, `head_of_station`, `police_email_id`, `email_id`) VALUES
(7, 'sadar bazaar', 'gaali number 1 sadar bazaar police station', 122002, 'ritwik dalmia', 1234567890, 1234321245, 'ritwik dalmia', 'sadar_bazaar2@gmail.com', 'dalmiaritwik@gmail.com'),
(8, 'sadar bazaar', 'gaali number 2 sadar bazaar police station', 122001, 'ritwik singh', 1234567891, 1234321221, 'raghav kumar', 'sadar_bazaar1@gmail.com', 'dalmiaritwik@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `Mno` bigint(11) NOT NULL,
  `age` int(11) NOT NULL,
  `aadhar_card` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL DEFAULT 'NULL',
  `police_station` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT 'NULL',
  `state` varchar(255) NOT NULL DEFAULT 'NULL',
  `city` varchar(255) NOT NULL DEFAULT 'NULL',
  `zip` int(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `full_name`, `email_id`, `Mno`, `age`, `aadhar_card`, `gender`, `police_station`, `address`, `state`, `city`, `zip`) VALUES
(5, 'Ritwik Dalmia', 'dalmiaritwik@gmail.com', 9971655508, 21, '9160 9600 9807 ', 'male', 'sadar_bazaar2@gmail.com', '1320', 'Haryana', 'Gurugram', 122002),
(10, 'ritwik dalmia', 'ritwik.esports@gmail.com', 9971655501, 12, '9160 9600 9801 ', 'female', 'sadar_bazaar1@gmail.com', '1320-A', 'haryana', 'gurugram', 122002);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `Mno` bigint(15) NOT NULL,
  `age` int(11) NOT NULL,
  `parrent_email_id` varchar(255) NOT NULL,
  `aadhar_card` varchar(255) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `parrent_status` int(11) NOT NULL DEFAULT '1',
  `parrent_token` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` int(6) NOT NULL,
  `create_account_time` varchar(255) NOT NULL,
  `verification_status` int(11) NOT NULL DEFAULT '1',
  `password_token` varchar(255) NOT NULL,
  `password_code` int(11) NOT NULL,
  `login_attempts` int(11) NOT NULL DEFAULT '0',
  `disabled_account` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email_id`, `Mno`, `age`, `parrent_email_id`, `aadhar_card`, `police_station`, `parrent_status`, `parrent_token`, `ip_address`, `password`, `token`, `create_account_time`, `verification_status`, `password_token`, `password_code`, `login_attempts`, `disabled_account`) VALUES
(15, 'Ritwik Dalmia', 'dalmiaritwik@gmail.com', 9971655508, 21, 'none@gmail.com', '9160 9600 9807 ', 'sadar_bazaar2@gmail.com', 1, '', '223.190.81.67', '$2y$10$qhsOH2Jo2Pdhxk0x6bMLVOJxkCp4Fi0s6/Sc3vVtgZx8H0kazSC0W', 0, '2023-12-17 14:08:02', 1, '1ba19775c307fb0567649f22b6bba0', 0, 0, 1),
(24, 'ritika dalmia', 'ritwik.esports@gmail.com', 9971655508, 21, 'none@gmail.com', '9160 9600 9801', 'sadar_bazaar1@gmail.com', 1, '', '223.190.81.67', '$2y$10$H4KOdxp4RzpZ/heslec8Ku1F/KW19xSTB92.ZwpALexNesa4f2xZa', 0, '2023-12-17 14:08:02', 1, '1ba19775c307fb0567649f22b6bba0', 0, 0, 1),
(29, 'Ritwik Dalmia', 'dalmiaritwik1@gmail.com', 9971155508, 21, 'none@gmail.com', '9160 9600 9854', 'sadar_bazaar2@gmail.com', 1, '', '223.190.81.67', '$2y$10$qhsOH2Jo2Pdhxk0x6bMLVOJxkCp4Fi0s6/Sc3vVtgZx8H0kazSC0W', 0, '2023-12-17 14:08:02', 0, '1ba19775c307fb0567649f22b6bba0', 0, 0, 1),
(30, 'somya', 'ritwik.esports1@gmail.com', 9971655508, 21, 'none@gmail.com', '9160 9600 9878', 'sadar_bazaar1@gmail.com', 1, '', '223.190.81.67', '$2y$10$H4KOdxp4RzpZ/heslec8Ku1F/KW19xSTB92.ZwpALexNesa4f2xZa', 0, '2023-12-17 14:08:02', 1, '1ba19775c307fb0567649f22b6bba0', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `Mno` (`Mno`),
  ADD UNIQUE KEY `admin_role_type` (`admin_role_type`,`email_id`);

--
-- Indexes for table `admin_change_address`
--
ALTER TABLE `admin_change_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `admin_profile`
--
ALTER TABLE `admin_profile`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`admin_role_id`),
  ADD UNIQUE KEY `admin_role_type` (`admin_role_type`);

--
-- Indexes for table `application_request`
--
ALTER TABLE `application_request`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `change_address`
--
ALTER TABLE `change_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `police_station_list`
--
ALTER TABLE `police_station_list`
  ADD PRIMARY KEY (`police_station_id`),
  ADD UNIQUE KEY `email_id` (`police_email_id`),
  ADD UNIQUE KEY `emergency` (`emergency_no`),
  ADD UNIQUE KEY `police_station_number` (`police_station_number`),
  ADD UNIQUE KEY `police_station_address` (`police_station_address`),
  ADD UNIQUE KEY `emergency_no` (`emergency_no`),
  ADD UNIQUE KEY `uk_police_station` (`police_station_name`,`police_station_pincode`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD UNIQUE KEY `email_id` (`email_id`,`Mno`,`aadhar_card`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_id` (`email_id`,`Mno`),
  ADD UNIQUE KEY `Aadhar_card` (`aadhar_card`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `admin_change_address`
--
ALTER TABLE `admin_change_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_profile`
--
ALTER TABLE `admin_profile`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `admin_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `application_request`
--
ALTER TABLE `application_request`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `change_address`
--
ALTER TABLE `change_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `police_station_list`
--
ALTER TABLE `police_station_list`
  MODIFY `police_station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

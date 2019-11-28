-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2019 at 11:23 PM
-- Server version: 10.1.40-MariaDB-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wuhsinfo_verify`
--

-- --------------------------------------------------------

--
-- Table structure for table `device_config`
--

CREATE TABLE `device_config` (
  `id` int(11) NOT NULL,
  `config` text NOT NULL,
  `hash_encode` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_config`
--

INSERT INTO `device_config` (`id`, `config`, `hash_encode`) VALUES
(1, 'a:23:{s:10:\"email_user\";s:9:\"fd@hf.com\";s:22:\"device_android_version\";s:1:\"9\";s:18:\"device_android_sdk\";i:28;s:13:\"device_secure\";b:1;s:9:\"bluetooth\";b:0;s:3:\"ncf\";b:0;s:3:\"gps\";b:0;s:12:\"wifi_hostpot\";b:0;s:10:\"power_save\";b:1;s:13:\"airplane_mode\";b:0;s:15:\"voice_assistant\";s:117:\"ComponentInfo{com.google.android.googlequicksearchbox/com.google.android.voiceinteraction.GsaVoiceInteractionService}\";s:13:\"touched_sound\";b:0;s:15:\"haptic_feedback\";b:0;s:18:\"lock_screen_sounds\";b:1;s:18:\"screen_off_timeout\";i:30000;s:18:\"text_show_password\";N;s:17:\"lock_screen_after\";i:5000;s:11:\"device_name\";s:8:\"SM-A730F\";s:14:\"bluetooth_name\";s:17:\"Galaxy A8+ (2018)\";s:9:\"dhcp_info\";s:135:\"ipaddr 192.168.100.4 gateway 192.168.100.1 netmask 0.0.0.0 dns1 200.32.248.1 dns2 8.8.8.8 DHCP server 192.168.100.1 lease 86400 seconds\";s:11:\"hash_encode\";s:4:\"lflt\";s:12:\"created_date\";s:19:\"2019-11-27 23:16:56\";s:12:\"updated_date\";s:19:\"2019-11-27 23:16:56\";}', 'lflt'),
(2, '{\"email_user\":\"fd@hf.com\",\"device_android_version\":\"9\",\"device_android_sdk\":28,\"device_secure\":true,\"bluetooth\":false,\"ncf\":false,\"gps\":false,\"wifi_hostpot\":false,\"power_save\":true,\"airplane_mode\":false,\"voice_assistant\":\"ComponentInfo{com.google.android.googlequicksearchbox\\/com.google.android.voiceinteraction.GsaVoiceInteractionService}\",\"touched_sound\":false,\"haptic_feedback\":false,\"lock_screen_sounds\":true,\"screen_off_timeout\":30000,\"text_show_password\":null,\"lock_screen_after\":5000,\"device_name\":\"SM-A730F\",\"bluetooth_name\":\"Galaxy A8+ (2018)\",\"dhcp_info\":\"ipaddr 192.168.100.4 gateway 192.168.100.1 netmask 0.0.0.0 dns1 200.32.248.1 dns2 8.8.8.8 DHCP server 192.168.100.1 lease 86400 seconds\",\"hash_encode\":\"lflu\",\"created_date\":\"2019-11-27 23:17:29\",\"updated_date\":\"2019-11-27 23:17:29\"}', 'lflu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device_config`
--
ALTER TABLE `device_config`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device_config`
--
ALTER TABLE `device_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

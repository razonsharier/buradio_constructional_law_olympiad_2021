-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2021 at 08:19 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olympiad_cons_law`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(255) NOT NULL,
  `que` text NOT NULL,
  `option1` varchar(222) NOT NULL,
  `option2` varchar(222) NOT NULL,
  `option3` varchar(222) NOT NULL,
  `option4` varchar(222) NOT NULL,
  `userans` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quizallans`
--

CREATE TABLE `quizallans` (
  `id` int(11) NOT NULL,
  `ar1` text NOT NULL,
  `ar2` text NOT NULL,
  `ar3` text NOT NULL,
  `ar4` text NOT NULL,
  `ar5` text NOT NULL,
  `ar6` text NOT NULL,
  `ar7` text NOT NULL,
  `ar8` text NOT NULL,
  `ar9` text NOT NULL,
  `ar10` text NOT NULL,
  `ar11` text NOT NULL,
  `ar12` text NOT NULL,
  `ar13` text NOT NULL,
  `ar14` text NOT NULL,
  `ar15` text NOT NULL,
  `ar16` text NOT NULL,
  `ar17` text NOT NULL,
  `ar18` text NOT NULL,
  `ar19` text NOT NULL,
  `ar20` text NOT NULL,
  `ar21` text NOT NULL,
  `ar22` text NOT NULL,
  `ar23` text NOT NULL,
  `ar24` text NOT NULL,
  `ar25` text NOT NULL,
  `ar26` text NOT NULL,
  `ar27` text NOT NULL,
  `ar28` text NOT NULL,
  `ar29` text NOT NULL,
  `ar30` text NOT NULL,
  `ar31` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizans`
--

CREATE TABLE `quizans` (
  `id` int(11) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `a1` text NOT NULL,
  `a2` text NOT NULL,
  `a3` text NOT NULL,
  `a4` text NOT NULL,
  `a5` text NOT NULL,
  `a6` text NOT NULL,
  `a7` text NOT NULL,
  `a8` text NOT NULL,
  `a9` text NOT NULL,
  `a10` text NOT NULL,
  `a11` text NOT NULL,
  `a12` text NOT NULL,
  `a13` text NOT NULL,
  `a14` text NOT NULL,
  `a15` text NOT NULL,
  `a16` text NOT NULL,
  `a17` text NOT NULL,
  `a18` text NOT NULL,
  `a19` text NOT NULL,
  `a20` text NOT NULL,
  `a21` text NOT NULL,
  `a22` text NOT NULL,
  `a23` text NOT NULL,
  `a24` text NOT NULL,
  `a25` text NOT NULL,
  `a26` text NOT NULL,
  `a27` text NOT NULL,
  `a28` text NOT NULL,
  `a29` text NOT NULL,
  `a30` text NOT NULL,
  `a31` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `id` int(11) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `totalmarks` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recov_pass_request`
--

CREATE TABLE `recov_pass_request` (
  `id` int(11) NOT NULL,
  `request_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `email` varchar(300) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `datetime` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `id` int(11) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `university` varchar(200) NOT NULL,
  `dept` varchar(200) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `step1` varchar(10) NOT NULL,
  `marks1` int(10) NOT NULL,
  `selectionround2` varchar(10) NOT NULL,
  `topic` varchar(300) NOT NULL,
  `status` varchar(10) NOT NULL,
  `marks2` int(10) NOT NULL,
  `selectionround3` varchar(10) NOT NULL,
  `time` varchar(50) NOT NULL,
  `link` mediumtext NOT NULL,
  `marks3` int(10) NOT NULL,
  `questart` varchar(20) NOT NULL,
  `quend` varchar(20) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `studentID` varchar(200) NOT NULL,
  `proPic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `sw_type` varchar(100) NOT NULL,
  `switch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sw_type`, `switch`) VALUES
(1, 'result_publish', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `timer`
--

CREATE TABLE `timer` (
  `id` int(11) NOT NULL,
  `timer` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `option 1` (`option1`);

--
-- Indexes for table `quizallans`
--
ALTER TABLE `quizallans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizans`
--
ALTER TABLE `quizans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recov_pass_request`
--
ALTER TABLE `recov_pass_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timer`
--
ALTER TABLE `timer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizallans`
--
ALTER TABLE `quizallans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizans`
--
ALTER TABLE `quizans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recov_pass_request`
--
ALTER TABLE `recov_pass_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reg`
--
ALTER TABLE `reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timer`
--
ALTER TABLE `timer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

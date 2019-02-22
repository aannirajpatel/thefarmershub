-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2019 at 11:34 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thefarmershub`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `uid` int(10) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phoneNumber` int(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `language` varchar(40) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `village` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`uid`, `email`, `phoneNumber`, `password`, `language`, `fname`, `lname`, `village`, `dist`, `state`) VALUES
(26, '', 0, 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', ''),
(27, '', 0, 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', ''),
(28, '', 0, 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', ''),
(29, '', 0, 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', ''),
(30, '', 0, 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', ''),
(31, 'vishvapatel652@gmail.com', 2147483647, '5f4dcc3b5aa765d61d8327deb882cf99', 'India', 'Vishva', 'Patel', '', 'cs', 'Gujarat'),
(32, 'vishvapatel652@gmail.com', 2147483647, 'password', 'India', 'Vishva', 'Patel', '', 'cs', 'Gujarat'),
(33, '17BIT0940@email.com', 2147483647, 'password', 'India', 'jlk', 'hkjhj', '', 'dgfgf', 'Gujarat'),
(34, '17BIT0940@email.com', 2147483647, 'password', 'India', 'jlk', 'hkjhj', '', 'dgfgf', 'Gujarat'),
(35, '', 0, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `qno` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `atext` text NOT NULL,
  `atimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `aupcount` int(255) NOT NULL,
  `adowncount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `uid` int(10) NOT NULL,
  `articleid` int(10) NOT NULL,
  `text` text NOT NULL,
  `topic` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `upcount` int(255) NOT NULL,
  `downcount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `uid` int(10) NOT NULL,
  `articleid` int(10) NOT NULL,
  `ctext` text NOT NULL,
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cupcount` int(255) NOT NULL,
  `cdowncount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `uid` int(10) NOT NULL,
  `qno` int(10) NOT NULL,
  `qtext` text NOT NULL,
  `qtimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qupcount` int(255) NOT NULL,
  `qdowncount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`uid`,`phoneNumber`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleid`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`qno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `articleid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `qno` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

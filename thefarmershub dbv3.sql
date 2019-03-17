-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2019 at 11:07 AM
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
  `username` varchar(50) NOT NULL,
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

INSERT INTO `account` (`uid`, `username`, `email`, `phoneNumber`, `password`, `language`, `fname`, `lname`, `village`, `dist`, `state`) VALUES
(57, 'patelaan13', 'patelaan13@gmail.com', 2147483647, '7431ba62766576c4fd14ad1711dba272', 'Hindi', 'Aan', 'Patel', 'Manjalpur', 'Vadodara', 'Gujarat');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `qno` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `atext` longtext NOT NULL,
  `atimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `aupcount` int(255) NOT NULL,
  `adowncount` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`qno`, `uid`, `atext`, `atimestamp`, `aupcount`, `adowncount`) VALUES
(16, 1, 'That should be done 3 times a day, which makes it 21 times a week for barley.', '2019-03-13 19:30:31', 0, 0),
(19, 57, 'It would be great if you can use Sunflower brand. They are cheap and give strong harvest.', '2019-03-13 20:54:02', 0, 0),
(18, 57, 'You should use no more than 500g of Nitrogen fertilizer every week.', '2019-03-13 20:59:17', 0, 0),
(16, 57, 'That should be done 3 times a day, which makes it 21 times a week for barley.', '2019-03-13 21:02:04', 0, 0),
(16, 57, 'And keep the water flow slow.', '2019-03-13 21:02:49', 0, 0),
(19, 57, 'You should not use ABC companys seeds. They are bad.', '2019-03-14 05:41:03', 0, 0);

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
  `qtimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `qupcount` int(11) NOT NULL DEFAULT '0',
  `qdowncount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`uid`, `qno`, `qtext`, `qtimestamp`, `qupcount`, `qdowncount`) VALUES
(57, 2, 'How often should wheat crops be watered in a week?', '2019-02-28 06:22:12', 0, 0),
(57, 16, 'How often should barley crops be watered in a week?', '2019-02-28 13:15:05', 0, 0),
(57, 18, 'How much fertilizer should I use for Wheat crops?', '2019-03-14 01:16:42', 0, 0),
(57, 19, 'Which company\'s seeds should I use for best harvest of Wheat?', '2019-03-14 02:23:27', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `qupdown`
--

CREATE TABLE `qupdown` (
  `uid` int(11) NOT NULL,
  `qno` int(11) NOT NULL,
  `ud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `ahi` double NOT NULL,
  `qhi` double NOT NULL,
  `arhi` double NOT NULL,
  `comhi` double NOT NULL,
  `totusers` int(11) DEFAULT NULL,
  `stimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `statid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`uid`,`phoneNumber`),
  ADD UNIQUE KEY `username` (`username`);

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
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`statid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `articleid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `qno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `statid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2015 at 08:30 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `closeup`
--

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE IF NOT EXISTS `episodes` (
  `id` int(11) NOT NULL,
  `episodenumber` varchar(10) NOT NULL DEFAULT '0',
  `numberofquestions` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Created List of Episodes';

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL,
  `socid` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(500) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `team` varchar(10) DEFAULT NULL,
  `age` varchar(2) DEFAULT NULL,
  `episdoesanswered` varchar(100) NOT NULL DEFAULT '0',
  `dnt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='List of members who applied';

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `socid`, `name`, `email`, `phone`, `state`, `sex`, `team`, `age`, `episdoesanswered`, `dnt`) VALUES
(1, '1', 'Ewere', 'boya360@yahoo.com', '08066194746', 'Ed', 'Male', 'A', '25', '', '2015-08-13 11:11:12'),
(2, '2', 'Ayeni Abies', 'ayeniomoneh@yahoo.com', '07060495588', 'Ed', 'Female', 'B', '22', '', '2015-08-24 09:03:43'),
(3, '3', 'Ayeni Bami', 'ayenibamidele@yahoo.com', '08055199525', 'Ed', 'Male', 'A', '22', '', '2015-08-24 09:03:43'),
(4, '4', 'Ayo Diagboya', 'ayo2kool@yahoo.com', '08062286816', 'Ed', 'Female', 'B', '22', '', '2015-08-24 09:03:43'),
(11, '586199110', 'Ewere Diagboya', 'boya360@yahoo.com', '08066194746', 'Edo', 'Male', 'A', '25', '0', '2015-08-25 14:45:28'),
(12, '10206456465363731', 'Esan Temitope Joseph', 'esantj@gmail.com', '08039447753', 'Lagos', 'Male', 'A', '67', '', '2015-08-25 15:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(500) DEFAULT NULL,
  `episodeid` varchar(10) DEFAULT NULL,
  `options` text,
  `answer` varchar(200) DEFAULT NULL,
  `file` text,
  `points` varchar(5) DEFAULT NULL,
  `done` varchar(5) DEFAULT '0',
  `dnt` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date and Time'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='List of Questions to be asked';

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `episodeid`, `options`, `answer`, `file`, `points`, `done`, `dnt`) VALUES
(1, 'Who is buhari', '1', 'M,B,C', 'Naira', NULL, '1', '1', '2015-08-25 11:13:50'),
(2, 'Who is Obasanjo', '1', NULL, 'Naira', NULL, '1', '1', '2015-08-25 11:13:50'),
(3, 'Who is buhari', '2', NULL, 'Naira', NULL, '1', '1', '2015-08-25 11:13:50'),
(5, 'Who is buhari', '2', NULL, 'Naira', NULL, '1', '1', '2015-08-25 11:13:50'),
(6, 'Who is buhari', '3', NULL, 'Naira', NULL, '1', '0', '2015-08-25 11:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `useranswers`
--

CREATE TABLE IF NOT EXISTS `useranswers` (
  `id` int(11) NOT NULL,
  `userid` varchar(200) NOT NULL DEFAULT '0',
  `teamid` varchar(10) NOT NULL DEFAULT '0',
  `qid` varchar(10) NOT NULL DEFAULT '0',
  `episodeid` varchar(10) NOT NULL DEFAULT '0',
  `answer` varchar(200) NOT NULL DEFAULT '0',
  `point` double NOT NULL,
  `dnt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='Answer given by a User';

--
-- Dumping data for table `useranswers`
--

INSERT INTO `useranswers` (`id`, `userid`, `teamid`, `qid`, `episodeid`, `answer`, `point`, `dnt`) VALUES
(1, '586199110', '0', '1', '1', 'B', 0, '2015-08-25 15:02:14'),
(2, '586199110', '0', '2', '1', 'the former president', 0, '2015-08-25 15:02:14'),
(3, '10206456465363731', '0', '6', '1', 'My daddy', 0, '2015-08-25 15:17:20'),
(4, '586199110', 'A', '1', '1', 'C', 0, '2015-08-25 15:25:00'),
(5, '586199110', 'A', '2', '1', 'the king of nigeria', 0, '2015-08-25 15:25:00'),
(6, '586199110', 'A', '1', '1', 'B', 0, '2015-08-25 15:29:45'),
(7, '586199110', 'A', '2', '1', 'this is my answer', 0, '2015-08-25 15:29:45'),
(8, '10206456465363731', 'A', '3', '2', 'A man of the people', 0, '2015-08-26 07:07:13'),
(9, '10206456465363731', 'A', '5', '2', 'Former military ', 0, '2015-08-26 07:07:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useranswers`
--
ALTER TABLE `useranswers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `useranswers`
--
ALTER TABLE `useranswers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2013 at 11:27 AM
-- Server version: 5.5.34
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_log`
--

CREATE TABLE IF NOT EXISTS `booking_log` (
  `status` enum('agreed','coming','done','canceled') NOT NULL DEFAULT 'agreed',
  `plan_id` int(10) NOT NULL,
  `sid` int(10) NOT NULL,
  `time_from` tinyint(4) NOT NULL,
  `time_to` tinyint(4) NOT NULL,
  PRIMARY KEY (`plan_id`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_plan`
--

CREATE TABLE IF NOT EXISTS `booking_plan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tid` int(10) NOT NULL,
  `date` date NOT NULL,
  `max_num` int(11) NOT NULL DEFAULT '1',
  `time_from` tinyint(4) NOT NULL,
  `time_to` tinyint(4) NOT NULL,
  `type` enum('asked','free') NOT NULL DEFAULT 'free',
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `data` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `defaults`
--

CREATE TABLE IF NOT EXISTS `defaults` (
  `tid` int(10) NOT NULL,
  `type` enum('free','asked') NOT NULL DEFAULT 'free',
  `note` text,
  `display_time_from` tinyint(4) NOT NULL DEFAULT '0',
  `display_time_to` tinyint(4) NOT NULL DEFAULT '68',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `student` (
  `sid` int(10) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `college` varchar(40) NOT NULL,
  `specialty` varchar(40) NOT NULL,
  `realname` varchar(20) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `tid` int(10) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `college` varchar(40) NOT NULL,
  `location` varchar(40) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `job` varchar(20) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  `usertype` enum('teacher','student') NOT NULL,
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

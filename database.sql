-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2013 at 09:44 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wip`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `password` char(64) NOT NULL,
  `username` varchar(20) NOT NULL,
  `join_date` datetime NOT NULL,
  `last_seen` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `email_2` (`email`),
  KEY `password` (`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `email`, `password`, `username`, `join_date`, `last_seen`) VALUES
(13, 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 'test', '2013-11-05 16:33:58', '2013-11-08 11:42:22'),
(14, 'test2@test.com', '098f6bcd4621d373cade4e832627b4f6', 'test2', '2013-11-08 11:53:03', '2013-11-10 15:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `member_id`, `name`, `description`, `creation_date`, `public`) VALUES
(9, 13, 'Pumpkin Carving', 'Who knowz rite?', '2013-11-08 11:16:46', 0),
(10, 14, 'Casino simulations', 'Rollin in the dough', '2013-11-08 11:58:13', 0),
(11, 14, 'Fun Songs', 'You know', '2013-11-08 12:07:18', 0),
(12, 14, 'Art Projects', 'Big Deal', '2013-11-08 12:09:33', 0),
(13, 14, 'Space with a space', 'space testing', '2013-11-08 12:13:36', 0),
(14, 14, 'space test 2', 'what to do with white space too yo', '2013-11-08 13:28:19', 0),
(15, 14, 'Space test 3', 'What you want from me yo three free trees for the benefit of me', '2013-11-08 13:29:19', 0),
(16, 14, 'Bug Database', 'Big Daddy', '2013-11-08 16:58:17', 0),
(17, 14, 'Leaves and Branches', 'Trees bees and steeds', '2013-11-08 17:04:07', 0),
(18, 14, 'Literature and poetry', 'Its the body bag bitch, why you callin?', '2013-11-08 17:15:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portfolio_id` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2011 at 02:24 PM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `SSI`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'DM510e', 'dm510 part groupe'),
(2, 'AM3', 'am cube part group'),
(3, 'FOO', 'BAR'),
(4, 'BIZ', 'BAZ');

-- --------------------------------------------------------

--
-- Table structure for table `group_item_mapping`
--

CREATE TABLE IF NOT EXISTS `group_item_mapping` (
  `group_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_item_mapping`
--

INSERT INTO `group_item_mapping` (`group_id`, `item_id`) VALUES
(2, 6),
(1, 9),
(1, 3),
(1, 4),
(1, 6),
(2, 5),
(1, 1),
(1, 2),
(3, 9),
(4, 10),
(3, 10),
(2, 10),
(1, 10),
(4, 14),
(2, 14),
(3, 15),
(4, 15),
(1, 16),
(2, 16),
(1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `part_code` varchar(255) NOT NULL,
  `part_description` varchar(255) NOT NULL,
  `part_supplier_id` int(10) NOT NULL,
  `supplier_part_code` varchar(255) NOT NULL,
  `loc` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `unit_cost` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `part_code`, `part_description`, `part_supplier_id`, `supplier_part_code`, `loc`, `qty`, `unit_cost`) VALUES
(18, '', '', -1, '', '', 0, 0),
(16, 'DM_65406', 'Look ma a airplane', 3, 'ARROW - 46506', 'W', 12, 55.55),
(17, 'DM_510e', 'hella descriptions', 3, '90210', 'w', 99, 12.5),
(14, 'DM_1', 'No Description 1', -1, '', 'A', 99, 14.98);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `description`, `email`, `telephone`, `fax`, `url`, `contact_name`) VALUES
(1, 'Edge Elec', 'this is a description field.', 'name@email.com', '5551234567', '5551234567', 'http://dryermaster.com/', 'John Smith'),
(2, 'Carsan', 'this is a description field.', 'name@email.com', '5551234567', '5551234567', 'http://dryermaster.com/', 'haha hu'),
(3, 'Arrow', 'this is a description field.', 'name@email.com', '465461321032', '5551234567', 'http://dryermaster.com/', 'John Smith'),
(4, 'Profom', 'this is a description field.', 'name@email.com', '5551234567', '5551234567', 'http://dryermaster.com/', 'John Smith');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('default','admin','owner') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
-- All passwords set to `7658`

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'rlemon', 'e77910ebb93b511588557806310f78f1', 'owner'),
(2, 'wks', 'e77910ebb93b511588557806310f78f1', 'admin'),
(3, 'jmk', 'e77910ebb93b511588557806310f78f1', 'default');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

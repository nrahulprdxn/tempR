-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 19, 2013 at 11:08 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webvantage`
--

-- --------------------------------------------------------

--
-- Table structure for table `in_measurementcriteria`
--

CREATE TABLE IF NOT EXISTS `in_measurementcriteria` (
  `mc_Id` int(11) NOT NULL AUTO_INCREMENT,
  `mcName` varchar(255) NOT NULL,
  `mcDiscription` varchar(255) NOT NULL,
  PRIMARY KEY (`mc_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `in_measurementcriteria`
--

INSERT INTO `in_measurementcriteria` (`mc_Id`, `mcName`, `mcDiscription`) VALUES
(1, 'MC-1', 'DEMO MC-1'),
(2, 'MC-2', 'DEMO MC-2'),
(3, 'MC-3', 'DEMO MC-3'),
(4, 'MC-4', 'DEMO MC-4'),
(5, 'MC-5', 'DEMO MC-5'),
(6, 'MC-6', 'DEMO MC-6');

-- --------------------------------------------------------

--
-- Table structure for table `in_recommentations`
--

CREATE TABLE IF NOT EXISTS `in_recommentations` (
  `re_Id` int(11) NOT NULL AUTO_INCREMENT,
  `reCase` varchar(255) NOT NULL,
  `mc_Id` varchar(255) NOT NULL,
  `reDescription` varchar(255) NOT NULL,
  PRIMARY KEY (`re_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `in_resultlog`
--

CREATE TABLE IF NOT EXISTS `in_resultlog` (
  `rel_Id` int(11) NOT NULL AUTO_INCREMENT,
  `u_Id` int(11) DEFAULT NULL,
  `site_Id` int(11) DEFAULT NULL,
  `mc` varchar(255) DEFAULT NULL,
  `points` varchar(255) DEFAULT NULL,
  `recomentations` varchar(255) DEFAULT NULL,
  `outoff` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rel_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `in_resultlog`
--

INSERT INTO `in_resultlog` (`rel_Id`, `u_Id`, `site_Id`, `mc`, `points`, `recomentations`, `outoff`, `status`) VALUES
(1, 3, 1, ' MC-1 ,MC-2  ', '3,2,', 'cool work', NULL, '-1'),
(2, 3, 2, ' MC-1 ,MC-2 ,MC-3  ', '4,5,5,', 'Good work', NULL, '-1'),
(3, 6, 2, ' MC-1 ,MC-2 ,MC-3  ', '0,0,0,', NULL, NULL, '1'),
(4, 3, 3, ' MC-1 ,MC-2 ,MC-3  ', '2,3,1,', 'average work...', NULL, '-1'),
(5, 6, 3, ' MC-1 ,MC-2 ,MC-3  ', '0,0,0,', NULL, NULL, '1'),
(6, 6, 4, ' MC-1 ,MC-2 ,MC-3  ', '3,4,5,', 'Ok site', NULL, '-1'),
(7, 3, 5, ' MC-1 ,MC-3 ,MC-4 ,MC-6  ', '4,2,5,4,', 'Well designed', NULL, '-1'),
(8, 3, 7, ' MC-2,MC-3 ', '4,5,', 'Good one', NULL, '-1');

-- --------------------------------------------------------

--
-- Table structure for table `in_results`
--

CREATE TABLE IF NOT EXISTS `in_results` (
  `result_Id` int(11) NOT NULL AUTO_INCREMENT,
  `resultdata` varchar(255) NOT NULL,
  `rel_Id` int(11) DEFAULT NULL,
  `sitename` varchar(255) NOT NULL,
  `lastdate` varchar(50) DEFAULT NULL,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`result_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `in_results`
--

INSERT INTO `in_results` (`result_Id`, `resultdata`, `rel_Id`, `sitename`, `lastdate`, `status`) VALUES
(1, '', 1, '', '1391299200', '1'),
(2, '', 23, '', '1374710400', '1'),
(3, '', 45, '', '1372723200', '1'),
(4, '', 6, '', '1372377600', '1'),
(5, '', 7, '', '1372204800', '1'),
(6, '', 8, '', '1386547200', '1');

-- --------------------------------------------------------

--
-- Table structure for table `in_sitelog`
--

CREATE TABLE IF NOT EXISTS `in_sitelog` (
  `site_Id` int(11) NOT NULL AUTO_INCREMENT,
  `u_Id` int(11) NOT NULL,
  `result_Id` varchar(50) DEFAULT NULL,
  `sitename` varchar(255) NOT NULL,
  `mcselected` varchar(255) NOT NULL,
  `anselected` varchar(255) DEFAULT NULL,
  `note` varchar(255) NOT NULL,
  `resultdate` varchar(50) DEFAULT NULL,
  `lastdate` varchar(50) DEFAULT NULL,
  `crosssite` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL,
  `adminstatus` varchar(25) NOT NULL,
  PRIMARY KEY (`site_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `in_sitelog`
--

INSERT INTO `in_sitelog` (`site_Id`, `u_Id`, `result_Id`, `sitename`, `mcselected`, `anselected`, `note`, `resultdate`, `lastdate`, `crosssite`, `status`, `adminstatus`) VALUES
(1, 4, 'd', 'www.google.com', 'MC-1 ,MC-2 ', '3,', '', '1372032000', '1391299200', 'null', 'Deactive', 'Active'),
(2, 4, 'd', 'www.facebook.com', 'MC-1 ,MC-2 ,MC-3 ', '6,', '', '1372032000', '1374710400', '', 'Progress', 'Active'),
(3, 4, 'd', 'www.new.com', 'MC-1 ,MC-2 ,MC-3 ', '3,6,', '', '1372032000', '1372723200', '', 'Progress', 'Active'),
(4, 4, 'd', 'www.abhisoft.com', 'MC-1 ,MC-2 ,MC-3 ', '6,', '', '1372032000', '1372377600', '', 'Progress', 'Active'),
(5, 4, 'd', 'www.bhagya.com', 'MC-1 ,MC-3 ,MC-4 ,MC-6 ', '3,', '', '1372118400', '1372204800', 'null', 'Progress', 'Active'),
(6, 4, 'a', 'swiss-property.onlinehost.ch', 'MC-1,MC-2,MC-3,MC-4', NULL, '', '1372636800', NULL, '', 'Request', 'Active'),
(7, 4, 'd', 'www', 'MC-2,MC-3', '3,', '', '1374019200', '1386547200', '', 'Progress', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `in_users`
--

CREATE TABLE IF NOT EXISTS `in_users` (
  `u_Id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `slant` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`u_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `in_users`
--

INSERT INTO `in_users` (`u_Id`, `FirstName`, `LastName`, `email`, `password`, `Address`, `role`, `slant`, `status`) VALUES
(1, 'super', 'admin', 's@a.com', 'cbbc0da85c4a9d4acebc3c4080913b06', '', 'superadmin', '4Oe', 'active'),
(2, 'demo', 'admin', 'ad@a.com', 'ee26f3fba090f48c6a9cb6bb946e9aaa', '', 'Admin', 'dmq', 'active'),
(3, 'demo', 'analyst', 'an@a.com', '3117014ea407c2308678ce85044170a0', '', 'Analyst', 'ABT', 'active'),
(4, 'demo', 'user', 'u@a.com', '80b54c5e343046db7f58a249764b70f2', '', 'User', '9xL', 'active'),
(5, 'demo', 'editor', 'e@a.com', '1166d7225eea696a63a50d83a5567060', '', 'Editor', 'tUv', 'active'),
(6, 'one', 'user', 'o@a.com', '1771a832c73b90081cb74ba9bb0e0e97', '', 'Analyst', 'Ypd', 'active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 02, 2012 at 05:59 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cakebootstrap`
--

-- --------------------------------------------------------

--
-- Table structure for table `cb_configurations`
--

CREATE TABLE IF NOT EXISTS `cb_configurations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `type` enum('text','boolean','json','email','url','tel','date','time','emaillist','urllist','datelist','tellist','datelist','textlist') NOT NULL,
  `allowedvalues` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cb_configurations`
--


-- --------------------------------------------------------

--
-- Table structure for table `cb_providers`
--

CREATE TABLE IF NOT EXISTS `cb_providers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cb_providers`
--

INSERT INTO `cb_providers` (`id`, `name`, `url`, `created`, `modified`) VALUES
(1, 'Facebook', 'http://facebok.com', '2012-09-09 19:06:29', NULL),
(2, 'Twitter', 'http://twitter.com', NULL, NULL),
(3, 'Google Plus', 'http://plus.google.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cb_shares`
--

CREATE TABLE IF NOT EXISTS `cb_shares` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `url` bigint(20) unsigned NOT NULL,
  `provider_id` int(11) unsigned NOT NULL,
  `user_login_id` bigint(20) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `photo_id` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Product Rating Details' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cb_shares`
--

INSERT INTO `cb_shares` (`id`, `user_id`, `url`, `provider_id`, `user_login_id`, `created`, `modified`) VALUES
(1, 3, 2, 2, 1, '2012-09-09 20:03:23', NULL),
(2, 3, 2, 1, 1, '2012-09-09 20:03:23', NULL),
(3, 4, 1, 3, 4, NULL, NULL),
(4, 4, 1, 2, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cb_social_details`
--

CREATE TABLE IF NOT EXISTS `cb_social_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `provider_id` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cb_social_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `cb_ticketcategories`
--

CREATE TABLE IF NOT EXISTS `cb_ticketcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cb_ticketcategories`
--

INSERT INTO `cb_ticketcategories` (`id`, `name`, `parent_id`, `created`, `modified`) VALUES
(1, 'Product', 0, '2012-08-19 18:06:13', '2012-08-19 18:06:13'),
(2, 'User', 0, '2012-08-19 18:06:29', '2012-08-19 18:06:29'),
(3, 'Login', 2, '2012-08-19 18:14:49', '2012-08-19 18:14:49'),
(4, 'Forgot Password', 3, '2012-08-19 18:34:37', '2012-08-19 18:34:37'),
(5, 'Sap', 1, '2012-10-02 17:50:11', '2012-10-02 17:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `cb_ticketcomments`
--

CREATE TABLE IF NOT EXISTS `cb_ticketcomments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `ticket_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL,
  `clientip` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cb_ticketcomments`
--

INSERT INTO `cb_ticketcomments` (`id`, `description`, `ticket_id`, `user_id`, `clientip`, `created`, `modified`) VALUES
(1, 'cool', 1, 3, '127.0.0.1', '2012-08-19 20:52:37', '2012-08-19 20:52:37'),
(2, 'hiiiiiiiiiiiiiiiii', 1, 4, '127.0.0.1', '2012-08-26 12:01:24', '2012-08-26 12:01:24'),
(3, '1	SELECT `Ticketcategory`.`id`, `Ticketcategory`.`name` FROM `reviewengine`.`re_ticketcategories` AS `Ticketcategory` WHERE 1 = 1		4	4	0\r\n2	SELECT COUNT(*) AS `count` FROM `reviewengine`.`re_tickets` AS `Ticket` WHERE `Ticket`.`id` = 1		1	1	0\r\n3	SELECT `Ticket`.`id`, `Ticket`.`description`, `Ticket`.`ticketcategory_id`, `Ticket`.`ticketstatus`, `Ticket`.`tickettype`, `Ticket`.`email`, `Ticket`.`assignee_id`, `Ticket`.`created`, `Ticket`.`modified`, `Ticketcategory`.`id`, `Ticketcategory`.`name`, `Ticketcategory`.`parent_id`, `Ticketcategory`.`created`, `Ticketcategory`.`modified`, `User`.`id`, `User`.`user_type_id`, `User`.`username`, `User`.`email`, `User`.`password`, `User`.`status`, `User`.`user_login_count`, `User`.`user_like_count`, `User`.`user_share_count`, `User`.`user_view_count`, `User`.`user_comment_count`, `User`.`user_rating_count`, `User`.`created`, `User`.`modified`, `Assignee`.`id`, `Assignee`.`user_type_id`, `Assignee`.`username`, `Assignee`.`email`, `Assignee`.`password`, `Assignee`.`status`, `Assignee`.`user_login_count`, `Assignee`.`user_like_count`, `Assignee`.`user_share_count`, `Assignee`.`user_view_count`, `Assignee`.`user_comment_count`, `Assignee`.`user_rating_count`, `Assignee`.`created`, `Assignee`.`modified` FROM `reviewengine`.`re_tickets` AS `Ticket` LEFT JOIN `reviewengine`.`re_ticketcategories` AS `Ticketcategory` ON (`Ticket`.`ticketcategory_id` = `Ticketcategory`.`id`) LEFT JOIN `reviewengine`.`re_users` AS `User` ON (`User`.`email` = `Ticket`.`email` AND `Ticket`.`email` = `User`.`id`) LEFT JOIN `reviewengine`.`re_users` AS `Assignee` ON (`Ticket`.`assignee_id` = `Assignee`.`id`) WHERE `Ticket`.`id` = 1 LIMIT 1		1	1	1\r\n4	SELECT `Ticketcomment`.`id`, `Ticketcomment`.`description`, `Ticketcomment`.`ticket_id`, `Ticketcomment`.`user_id`, `Ticketcomment`.`clientip`, `Ticketcomment`.`created`, `Ticketcomment`.`modified` FROM `reviewengine`.`re_ticketcomments` AS `Ticketcomment` WHERE `Ticketcomment`.`ticket_id` = (1)		2	2	0\r\n5	SELECT `User`.`id`, `User`.`user_type_id`, `User`.`username`, `User`.`email`, `User`.`password`, `User`.`status`, `User`.`user_login_count`, `User`.`user_like_count`, `User`.`user_share_count`, `User`.`user_view_count`, `User`.`user_comment_count`, `User`.`user_rating_count`, `User`.`created`, `User`.`modified` FROM `reviewengine`.`re_users` AS `User` WHERE `User`.`id` = 3		1	1	0\r\n6	SELECT `User`.`id`, `User`.`user_type_id`, `User`.`username`, `User`.`email`, `User`.`password`, `User`.`status`, `User`.`user_login_count`, `User`.`user_like_count`, `User`.`user_share_count`, `User`.`user_view_count`, `User`.`user_comment_count`, `User`.`user_rating_count`, `User`.`created`, `User`.`modified` FROM `reviewengine`.`re_users` AS `User` WHERE `User`.`id` = 4		1	1	0', 1, 3, '127.0.0.1', '2012-09-08 20:46:50', '2012-09-08 20:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `cb_tickets`
--

CREATE TABLE IF NOT EXISTS `cb_tickets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` text,
  `ticketcategory_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ticketstatus` enum('new','resolved','duplicate','invalid','hold','in_progress') DEFAULT 'new',
  `tickettype` enum('help','bug') NOT NULL DEFAULT 'help',
  `email` varchar(255) NOT NULL,
  `assignee_id` int(11) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cb_tickets`
--

INSERT INTO `cb_tickets` (`id`, `description`, `ticketcategory_id`, `ticketstatus`, `tickettype`, `email`, `assignee_id`, `created`, `modified`) VALUES
(1, 'blue beder blue beder blue &nbsp; beder blue beder &nbsp; blue beder blue beder blue beder', 2, 'hold', 'help', 'iprathik+user@gmail.com', 2, '2012-09-09 01:15:14', '2012-09-08 21:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `cb_users`
--

CREATE TABLE IF NOT EXISTS `cb_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type_id` int(5) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive','deleted','passwordchange','suspended') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `user_login_count` int(11) DEFAULT NULL,
  `user_share_count` int(11) DEFAULT NULL,
  `user_view_count` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_type_id` (`user_type_id`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Details' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cb_users`
--

INSERT INTO `cb_users` (`id`, `user_type_id`, `username`, `email`, `password`, `status`, `user_login_count`, `user_share_count`, `user_view_count`, `created`, `modified`) VALUES
(2, 1, 'admin', 'ip+admin@gmail.com', '237c9c9e45dbcc546f262769aeb612ce6a96e8a9', 'active', NULL, NULL, NULL, NULL, '2012-08-11 21:41:34'),
(4, 6, 'operator', 'ip+operator@gmail.com', '237c9c9e45dbcc546f262769aeb612ce6a96e8a9', 'active', NULL, NULL, NULL, '2012-08-12 03:14:26', '2012-08-12 03:14:34'),
(3, 4, 'user', 'ip+user@gmail.com', '237c9c9e45dbcc546f262769aeb612ce6a96e8a9', 'active', NULL, NULL, NULL, '2012-08-12 03:14:26', '2012-08-12 03:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `cb_user_logins`
--

CREATE TABLE IF NOT EXISTS `cb_user_logins` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(30) DEFAULT NULL,
  `referer` varchar(255) DEFAULT NULL,
  `user_agent` text,
  `operating_system` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT 'site',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cb_user_logins`
--

INSERT INTO `cb_user_logins` (`id`, `user_id`, `ip_address`, `referer`, `user_agent`, `operating_system`, `browser`, `city`, `country`, `provider`, `created`, `modified`) VALUES
(1, 2, '127.0.0.1', 'http://localhost/cakebootstrap/users/login/', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.79 Safari/537.4', NULL, ' ', NULL, NULL, 'site', '2012-10-02 16:43:01', '2012-10-02 16:43:01'),
(2, 2, '127.0.0.1', 'http://localhost/cakebootstrap/users/login', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.79 Safari/537.4', NULL, ' ', NULL, NULL, 'site', '2012-10-02 17:57:28', '2012-10-02 17:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `cb_user_types`
--

CREATE TABLE IF NOT EXISTS `cb_user_types` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Type Details' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cb_user_types`
--

INSERT INTO `cb_user_types` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Admin', NULL, NULL),
(3, 'Pro', NULL, NULL),
(4, 'Normal', NULL, NULL),
(5, 'Support', NULL, NULL),
(9, 'Dev', NULL, NULL);

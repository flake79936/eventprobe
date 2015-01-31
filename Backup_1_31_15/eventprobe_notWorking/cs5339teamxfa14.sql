SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `cs5339team9fa14` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cs5339team9fa14`;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `first` varchar(15) NOT NULL,
  `last` varchar(15) NOT NULL,
  `title` varchar(15) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `friend_requests`;
CREATE TABLE IF NOT EXISTS `friend_requests` (
  `frequest_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_from` varchar(25) NOT NULL,
  `user_id_to` varchar(25) NOT NULL,
  `request_date` date NOT NULL,
  `request_confirm_date` date NOT NULL,
  `request_status` enum('0','1','-1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`frequest_id`),
  KEY `user_id_from` (`user_id_from`,`user_id_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

INSERT INTO `friend_requests` (`frequest_id`, `user_id_from`, `user_id_to`, `request_date`, `request_confirm_date`, `request_status`) VALUES
(1, 'hima', 'madhu', '2014-11-25', '2014-11-25', '1'),
(2, 'mike', 'hima', '0000-00-00', '2014-12-04', '-1'),
(3, 'hari', 'hima', '2014-12-02', '2014-12-04', '1'),
(4, 'hima', 'siri', '2014-12-03', '0000-00-00', '0'),
(5, 'ecorral2', 'siri', '2014-12-03', '0000-00-00', '0'),
(6, 'hima', 'ecorral2', '2014-12-03', '0000-00-00', '0'),
(7, 'hari', 'ecorral2', '2014-12-03', '0000-00-00', '0'),
(8, 'ecorral2', 'mike', '2014-12-03', '0000-00-00', '0');

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(15) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `item_pic` varchar(30) NOT NULL,
  `pymt_method` text NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `items` (`item_id`, `category`, `product_name`, `description`, `quantity`, `price`, `item_pic`) VALUES
(1, 'apparel', 'UTEP T-Shirt', 'This is a T-shirt very comfortable', 15, '11.99', 'utep_shirt.jpg');

DROP TABLE IF EXISTS `master`;
CREATE TABLE IF NOT EXISTS `master` (
  `master_id` int(11) NOT NULL AUTO_INCREMENT,
  `academicyear` varchar(30) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `last` varchar(30) DEFAULT NULL,
  `first` varchar(30) DEFAULT NULL,
  `major` varchar(30) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `degree` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`master_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_body` longtext,
  `msg_by` varchar(25) NOT NULL,
  `msg_to` varchar(25) NOT NULL,
  `date_added` date NOT NULL,
  `msg_status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

INSERT INTO `messages` (`msg_id`, `msg_body`, `msg_by`, `msg_to`, `date_added`, `msg_status`) VALUES
(1, '', '0', '0', '2014-12-02', '0'),
(2, '', '0', '0', '2014-12-02', '0'),
(3, '', '0', '0', '2014-12-02', '0'),
(4, '', '0', '0', '2014-12-02', '0'),
(5, '', '0', '0', '2014-12-02', '0'),
(6, '', '0', '0', '2014-12-02', '0'),
(7, '', '0', '0', '2014-12-02', '0'),
(8, 'cxc', '0', '0', '2014-12-02', '0'),
(9, 'helllo test', 'hima', 'priya', '2014-12-02', '0'),
(10, 'hello ', 'hima', 'priya', '2014-12-02', '0'),
(11, 'hi ', 'hima', 'priya', '2014-12-02', '0'),
(12, 'hiiii', 'hima', 'madhu', '2014-12-02', '0'),
(13, 'hi priya this is my first message from madhu', 'madhu', 'priya', '2014-12-02', '0'),
(14, 'hi..from priya', 'hima', 'madhu', '2014-12-02', '0'),
(15, 'hiii from priya.....correct', 'hima', 'madhu', '2014-12-02', '0'),
(16, 'hello this is hima how are you?', 'hima', 'priya', '2014-12-03', '0');

DROP TABLE IF EXISTS `privacy`;
CREATE TABLE IF NOT EXISTS `privacy` (
  `privacy_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `property_name` varchar(30) NOT NULL,
  `property_value` varchar(30) NOT NULL,
  `hide_status` enum('on','off') NOT NULL DEFAULT 'off',
  `privacy_field_status` enum('0','1') NOT NULL DEFAULT '0',
  `date_updated` date DEFAULT NULL,
  PRIMARY KEY (`privacy_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

INSERT INTO `privacy` (`privacy_id`, `user_id`, `user_name`, `property_name`, `property_value`, `hide_status`, `privacy_field_status`, `date_updated`) VALUES
(1, 0, 'hima', 'Email', 'htest@test.com', 'off', '1', '2014-12-04'),
(2, 0, 'hima', 'fname', 'Hima', 'off', '0', '2014-12-02'),
(3, 0, 'hima', 'lname', 'Kondepati', 'off', '0', '2014-12-02'),
(4, 0, 'hima', 'title', 'Miss', 'off', '0', '2014-12-02'),
(5, 0, 'hima', 'Gender', 'f', 'on', '1', '2014-12-04'),
(6, 0, 'hima', 'City', 'el paso', 'off', '1', '2014-12-04'),
(7, 0, 'hima', 'Address', '1700 utep', 'off', '0', '2014-12-04'),
(8, 0, 'hima', 'bio_data', 'hi welcome to my profile', 'off', '0', '2014-12-02'),
(9, 0, 'hima', 'employeement', 'n', 'off', '0', '2014-12-02'),
(10, 7, 'ecorral2', 'Email', 'htest@test.com', 'off', '1', '2014-12-04'),
(11, 7, 'ecorral2', 'fname', 'Hima', 'off', '0', '2014-12-02'),
(12, 7, 'ecorral2', 'lname', 'Kondepati', 'off', '0', '2014-12-02'),
(13, 7, 'ecorral2', 'title', 'Miss', 'off', '0', '2014-12-02'),
(14, 7, 'ecorral2', 'Gender', 'f', 'on', '1', '2014-12-04'),
(15, 7, 'ecorral2', 'City', 'el paso', 'off', '1', '2014-12-04'),
(16, 7, 'ecorral2', 'Address', '1700 utep', 'off', '0', '2014-12-04'),
(17, 7, 'ecorral2', 'bio_data', 'hi welcome to my profile', 'off', '0', '2014-12-02'),
(18, 7, 'ecorral2', 'employeement', 'n', 'off', '0', '2014-12-02'),
(19, 9, 'gerardo', 'Email', 'htest@test.com', 'off', '1', '2014-12-04'),
(20, 9, 'gerardo', 'fname', 'Hima', 'off', '0', '2014-12-02'),
(21, 9, 'gerardo', 'lname', 'Kondepati', 'off', '0', '2014-12-02'),
(22, 9, 'gerardo', 'title', 'Miss', 'off', '0', '2014-12-02'),
(23, 9, 'gerardo', 'Gender', 'f', 'on', '1', '2014-12-04'),
(24, 9, 'gerardo', 'City', 'el paso', 'off', '1', '2014-12-04'),
(25, 9, 'gerardo', 'Address', '1700 utep', 'off', '0', '2014-12-04'),
(26, 9, 'gerardo', 'bio_data', 'hi welcome to my profile', 'off', '0', '2014-12-02'),
(27, 9, 'gerardo', 'employeement', 'n', 'off', '0', '2014-12-02');

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `title` enum('Mr','Ms','Mis') DEFAULT NULL,
  `gender` enum('f','m','u') NOT NULL DEFAULT 'u',
  `city` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `bio_data` text,
  `employed` enum('y','n','u') NOT NULL DEFAULT 'u',
  `profile_pic` varchar(50) NULL,
  `last_login` date DEFAULT NULL,
  `profile_added` date DEFAULT NULL,
  `active_status` enum('0','1') NOT NULL DEFAULT '0',
  `friend_count` int(11) DEFAULT NULL,
  `friend_array` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `first`, `last`, `title`, `gender`, `city`, `address`, `bio_data`, `employed`, `profile_pic`, `last_login`, `profile_added`, `active_status`, `friend_count`, `friend_array`) VALUES
(1, 'hima', md5(1), 'htest@test.com', 'Hima', 'Kalagara', 'Mis', 'f', 'el paso', '1700 utep', 'hi welcome to my profile', 'n', '', '2014-11-25', '2014-11-25', '1', NULL, NULL),
(2, 'priya', md5(1), 'priya@test.com', 'priyafname', 'plastname', 'Ms', 'f', 'hyderabd', 'india', 'hi my name is priya', 'u', NULL, '2014-11-25', '2014-11-25', '0', NULL, NULL),
(3, 'madhu', md5(1), 'm@test.com', 'mfirst', 'mlast', 'Mr', 'f', 'el paso', '1700 utep', 'hi this is madhu welcome to my page', 'u', NULL, '2014-12-01', '2014-12-01', '0', NULL, NULL),
(4, 'hari', md5(1), 'ha@test.com', 'hfirst', 'hlast', 'Mr', 'f', 'el paso', '1700', 'hi this is hari', 'u', NULL, '2014-12-01', '2014-12-01', '0', NULL, NULL),
(5, 'siri', md5(1), 's@test.com', 'stest', 'slast', 'Ms', 'f', 'el paso', '1700', 'siri''s profile', 'u', NULL, '2014-12-01', '2014-12-01', '0', NULL, NULL),
(6, 'mike', md5(1), 'mike@test.com', 'mfirst', 'mlast', NULL, 'm', 'el paso', '1700 utep', 'test', 'u', NULL, NULL, NULL, '0', NULL, NULL),
(7, 'ecorral2', md5(1), 'ecorral2@test.com', 'Eduardo', 'Corral', NULL, 'm', 'el paso', '1 utep', 'test', 'u', NULL, NULL, NULL, '0', NULL, NULL),
(8, 'chad', md5(1), 'chad@test.com', 'Chad', 'Doe', NULL, 'm', 'el paso', '1 utep', 'test', 'u', NULL, NULL, NULL, '0', NULL, NULL),
(9, 'gerardo', md5(1), 'gerardo@test.com', 'Gerardo', 'Carbajal', NULL, 'm', 'el paso', '1 utep', 'test', 'u', NULL, NULL, NULL, '0', NULL, NULL);

DROP TABLE IF EXISTS `user_posts`;
CREATE TABLE IF NOT EXISTS `user_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_body` longtext,
  `added_by` varchar(25) NOT NULL,
  `added_to` varchar(25) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `user_posts` (`post_id`, `post_body`, `added_by`, `added_to`, `date_added`) VALUES
(1, 'hi this is my first post', 'hima', 'hima', '2014-11-25'),
(2, 'hello', 'hima', 'hima', '2014-12-02'),
(3, 'hi...', 'hima', 'madhu', '2014-12-02'),
(4, 'hello', 'hima', 'hari', '2014-12-04'),
(5, 'hi this is my first post', 'ecorral2', 'hima', '2014-11-25');
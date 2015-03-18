CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(200) NOT NULL DEFAULT '0',
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `firstname`, `lastname`, `email`) VALUES
(1, 'Manuel', 'Chang', 'exampleemailone@yahoo.com'),
(2, 'Akmal', 'Abadillah', 'emailexampletwo@yahoo.com'),
(3, 'Emanuela', 'Nero', 'examplethree@yahoo.com');
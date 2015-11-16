--
-- Database: `npetty2014`
--

-- --------------------------------------------------------

--
-- Table structure for table `WALL`
--

CREATE TABLE IF NOT EXISTS `WALL` (
  `USER_USERNAME` varchar(16) NOT NULL,
  `STATUS_TEXT` varchar(140) NOT NULL,
  `STATUS_TITLE` varchar(140) NOT NULL,
  `IMAGE_NAME` varchar(50) NOT NULL,
  `FILTER` varchar(32) DEFAULT NULL,
  `TIME_STAMP` varchar(50) NOT NULL,
  PRIMARY KEY (`TIME_STAMP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2016 at 10:29 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cmsdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `ID` varchar(5) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `Name`, `Description`) VALUES
('C0101', 'Data Structure & Algorithm', 'This is a difficult course'),
('C0102', 'Interactive Web Design', 'This is kinda easy for me'),
('C0103', 'Android Mobile Development', 'This is a cool stuff for mobile app developers'),
('C0104', 'Database Engineering', 'This course is taught by Mr.Sonn'),
('C0105', 'Programming Framework ', 'This is Mrs. Jaya Course'),
('C0106', 'Development  Framework', 'What is this that you are doing here'),
('C0107', 'Phonegap Mobile Development', 'I like phonegap desktop development so much'),
('C0108', 'HTML & CSS Advance', 'This is from the begining'),
('C0109', 'Application Development Methodology', 'My name is Eric Avong Alexander'),
('C0110', 'Research Methodology and Application', 'Advance research courses and deep findings'),
('C0111', 'Artificial Intelligence', 'This my not be my dream career but it is so cool'),
('C0112', 'Discrete Mathematics', 'This is a very difficult course. Complex logic and actions. Hahahahaha'),
('C0113', 'Business Management', 'This is an international business oriented course.'),
('C0114', 'Enterprise Web ', 'Enterprise Web Development');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'eavong', 'password', 'admin'),
(2, 'eric', 'password', 'pvc'),
(3, 'shequeri', 'password', 'pvc'),
(4, 'tukson', '2ksons', 'pvc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `Name` (`Name`), ADD UNIQUE KEY `Name_2` (`Name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: mysql.cms.gre.ac.uk
-- Generation Time: Apr 14, 2016 at 08:27 AM
-- Server version: 5.5.46
-- PHP Version: 5.5.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mdb_aa9625f`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicyear`
--

CREATE TABLE IF NOT EXISTS `academicyear` (
  `acyearID` int(11) NOT NULL AUTO_INCREMENT,
  `Year` varchar(50) NOT NULL,
  PRIMARY KEY (`acyearID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `academicyear`
--

INSERT INTO `academicyear` (`acyearID`, `Year`) VALUES
(1, '2013-2014'),
(2, '2014-2015'),
(3, '2015-2016'),
(4, '2016-2017');

-- --------------------------------------------------------

--
-- Table structure for table `assigntbl`
--

CREATE TABLE IF NOT EXISTS `assigntbl` (
  `assignid` int(11) NOT NULL AUTO_INCREMENT,
  `courseid` varchar(50) DEFAULT NULL,
  `academicyear` varchar(50) NOT NULL,
  `courseleader` int(50) DEFAULT NULL,
  `coursemoderator` int(50) DEFAULT NULL,
  PRIMARY KEY (`assignid`),
  KEY `course_fka` (`courseid`),
  KEY `userfk_cl` (`courseleader`),
  KEY `userfk_cm` (`coursemoderator`),
  KEY `academicyear` (`academicyear`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `assigntbl`
--

INSERT INTO `assigntbl` (`assignid`, `courseid`, `academicyear`, `courseleader`, `coursemoderator`) VALUES
(1, 'C0100', '4', 5, 6),
(5, 'C0102', '4', 5, 6),
(6, 'C0104', '4', 5, 6),
(7, 'C0101', '4', 5, 6),
(8, 'C0103', '1', 5, 6),
(9, 'C0105', '3', 5, 6),
(12, 'C0106', '4', 13, 6),
(14, 'C0115', '4', 13, 14),
(15, 'C0116', '4', 5, 6),
(19, 'C0109', '4', 5, 14),
(24, 'C0119', '4', 55, 56);

-- --------------------------------------------------------

--
-- Table structure for table `cmrtbl`
--

CREATE TABLE IF NOT EXISTS `cmrtbl` (
  `cmrID` int(11) NOT NULL AUTO_INCREMENT,
  `assignid` int(50) DEFAULT NULL,
  `studentcount` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'CREATED',
  `approvedate` date DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `meancw1` decimal(11,0) NOT NULL,
  `meancw2` decimal(11,0) NOT NULL,
  `meancw3` decimal(11,0) NOT NULL,
  `meanexam` decimal(11,0) NOT NULL,
  `mediancw1` decimal(11,0) NOT NULL,
  `mediancw2` decimal(11,0) NOT NULL,
  `mediancw3` decimal(11,0) NOT NULL,
  `medianexam` decimal(11,0) NOT NULL,
  `sdcw1` decimal(11,0) NOT NULL,
  `sdcw2` decimal(11,0) NOT NULL,
  `sdcw3` decimal(11,0) NOT NULL,
  `sdexam` decimal(11,0) NOT NULL,
  `cw1039` decimal(11,0) NOT NULL,
  `cw14059` decimal(11,0) NOT NULL,
  `cw16079` decimal(11,0) NOT NULL,
  `cw180above` decimal(11,0) NOT NULL,
  `cw2039` decimal(11,0) NOT NULL,
  `cw24059` decimal(11,0) NOT NULL,
  `cw26079` decimal(11,0) NOT NULL,
  `cw280above` decimal(11,0) NOT NULL,
  `cw3039` decimal(11,0) NOT NULL,
  `cw34059` decimal(11,0) NOT NULL,
  `cw36079` decimal(11,0) NOT NULL,
  `cw380above` decimal(11,0) NOT NULL,
  `exam039` decimal(11,0) NOT NULL,
  `exam4059` decimal(11,0) NOT NULL,
  `exam6079` decimal(11,0) NOT NULL,
  `exam80above` decimal(11,0) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `path` varchar(250) NOT NULL,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`cmrID`),
  KEY `assign_fk` (`assignid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `cmrtbl`
--

INSERT INTO `cmrtbl` (`cmrID`, `assignid`, `studentcount`, `status`, `approvedate`, `duedate`, `meancw1`, `meancw2`, `meancw3`, `meanexam`, `mediancw1`, `mediancw2`, `mediancw3`, `medianexam`, `sdcw1`, `sdcw2`, `sdcw3`, `sdexam`, `cw1039`, `cw14059`, `cw16079`, `cw180above`, `cw2039`, `cw24059`, `cw26079`, `cw280above`, `cw3039`, `cw34059`, `cw36079`, `cw380above`, `exam039`, `exam4059`, `exam6079`, `exam80above`, `filename`, `path`, `size`) VALUES
(1, 1, 2, 'Approved', '2016-04-13', '2016-04-27', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '22', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', 'dummy_content.xml', 'upload/dummy_content.xml', 260161),
(2, 5, 3, 'Approved', '2016-04-13', '2016-04-27', '3', '3', '3', '3', '3', '3', '323', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '33', '3', '3', '3', '3', '3', '3', '3', '3', 'PROJECT PROPOSAL.docx', 'upload/PROJECT PROPOSAL.docx', 21503),
(3, 6, 2, 'Approved', '2016-04-13', '2016-04-27', '6', '6', '8', '5', '4', '4', '45', '45', '3', '6', '4', '46', '3', '57', '3', '7', '7', '4', '4', '4', '4', '4', '4', '4', '4', '4', '4', '4', 'Java Printing.pdf', 'upload/Java Printing.pdf', 178548),
(5, 7, 8, 'Approved', '2016-04-13', '2016-04-27', '8', '8', '8', '8', '8', '8', '8', '8', '88', '8', '8', '88', '8', '8', '8', '88', '8', '8', '8', '88', '8', '8', '88', '8', '88', '8', '8', '8', 'authenticate.php', 'upload/authenticate.php', 1076),
(9, 12, 32, 'Approved', '2016-04-13', '2016-04-27', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', 'Question Dec 2014.docx', 'upload/Question Dec 2014.docx', 13595),
(31, 15, 81, 'Approved', '2016-04-13', '2016-04-27', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '4', '3', 'Extra Question.docx', 'upload/Extra Question.docx', 14443),
(35, 24, 50, 'Approved', '2016-04-13', '2016-04-27', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '55', '5', '5', '5', '5', '5', '5', '5', '5', '55', '5', '5', '5', '5', '5', '55', '5', 'course_details.sql', 'upload/course_details.sql', 1356);

-- --------------------------------------------------------

--
-- Table structure for table `commenttbl`
--

CREATE TABLE IF NOT EXISTS `commenttbl` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `cmrid` int(11) DEFAULT NULL,
  `comment` varchar(250) NOT NULL,
  `dateofcomment` date NOT NULL,
  PRIMARY KEY (`commentid`),
  KEY `cmrid_fk` (`cmrid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `commenttbl`
--

INSERT INTO `commenttbl` (`commentid`, `cmrid`, `comment`, `dateofcomment`) VALUES
(4, 1, 'this is my first comment as a dlt. thanks for the good job', '2016-04-09'),
(5, 2, 'rgywyufdudfjggjghh heu hhsh ush uhey bgsebe rg', '2016-04-10'),
(7, 5, 'good job, cm need to approve cmr on time', '2016-04-11'),
(8, 5, 'great result, keep it up', '2016-04-11'),
(15, 35, 'This is a good report. the email notification is really working good. Thanks ', '2016-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `coursestbl`
--

CREATE TABLE IF NOT EXISTS `coursestbl` (
  `courseID` varchar(5) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Aim` text NOT NULL,
  `FacultyID` int(11) DEFAULT NULL,
  PRIMARY KEY (`courseID`),
  UNIQUE KEY `courseID` (`courseID`),
  KEY `fac_fk` (`FacultyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursestbl`
--

INSERT INTO `coursestbl` (`courseID`, `Name`, `Description`, `Aim`, `FacultyID`) VALUES
('C0100', 'English Education', 'This is a course description for English Education', 'This is a course aim for English Education because anything is possible', 9),
('C0101', 'Mechanical', 'This is a course description for mechanical course of engineering faculty', 'This is a course aim for mechanical course of engineering faculty', 10),
('C0102', 'Linguistic', 'This is the course description for the Linguistic course of education faculty', 'This is the course aim for the Linguistic course of education faculty', 9),
('C0103', 'Criminology', 'This course deals with the human minds ', 'This is a course aim for criminology course of Law faculty', 8),
('C0104', 'Economic', 'uhnhrtycxauy hncgycrutgchrhogyixtr', 'rigrbrgbirgbig  uigggh wuhgui wgwg u', 11),
('C0105', 'political science', 'this deals with science of politics', 'This is a course aim for mechanical course of engineering faculty', 11),
('C0106', 'Electrical Engineering', 'this course deals with the electrical part of engineering', 'This is a course aim for electrical course of engineering faculty', 10),
('C0109', 'Microbiology', 'it deals with with human life and plant', 'To discuss about human life', 6),
('C0115', 'Chemistry', 'jjkksb jbfywbw', 'jhjiedhi', 6),
('C0116', 'International Law', 'This is a course description for international law course in the faculty', 'This is a course aim for international law course in the faculty', 8),
('C0118', 'Software Engineering', 'This is a course description for software engineering of the engineering faculty', 'This is a course aim for software engineering of the engineering faculty', 10),
('C0119', 'Mathematics', 'This is a course description for mathematics in the science faculty', 'This is a course aim for mathematics in the science faculty', 6),
('C1120', 'Computer Engineering', 'it deals with manufacture and repairing computer', 'this is to impact knowledge on how to repair  computer', 10);

-- --------------------------------------------------------

--
-- Table structure for table `facultytbl`
--

CREATE TABLE IF NOT EXISTS `facultytbl` (
  `FacultyID` int(11) NOT NULL AUTO_INCREMENT,
  `FacultyName` varchar(50) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pvc` int(11) DEFAULT NULL,
  `dlt` int(11) DEFAULT NULL,
  PRIMARY KEY (`FacultyID`),
  UNIQUE KEY `FacultyName` (`FacultyName`),
  KEY `userfk_1` (`pvc`),
  KEY `userfk_2` (`dlt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `facultytbl`
--

INSERT INTO `facultytbl` (`FacultyID`, `FacultyName`, `contact`, `address`, `pvc`, `dlt`) VALUES
(6, 'Science', 'science@cmruni.com', 'Vuetna Block 23,24 Lane', 2, 7),
(8, 'Law', 'law@crmuni.com', 'Hanoi Le Hacinco', 3, 9),
(9, 'Education', 'education@cmruni.com', 'B27 Zico Street Romi', 2, 9),
(10, 'Engineering', 'eng@cmruni.com', 'Fpt University Detech', 4, 9),
(11, 'Social Sciences', 'socials@cmruni.com', 'Pham Van Dung Street Da Nang', 3, 7),
(12, 'Health', 'health@cmruni.com', 'Shehu Idris Health college', 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `roletbl`
--

CREATE TABLE IF NOT EXISTS `roletbl` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) NOT NULL,
  PRIMARY KEY (`roleid`),
  UNIQUE KEY `rolename` (`rolename`),
  UNIQUE KEY `rolename_2` (`rolename`),
  UNIQUE KEY `rolename_3` (`rolename`),
  UNIQUE KEY `rolename_4` (`rolename`),
  UNIQUE KEY `rolename_5` (`rolename`),
  UNIQUE KEY `rolename_6` (`rolename`),
  UNIQUE KEY `rolename_7` (`rolename`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `roletbl`
--

INSERT INTO `roletbl` (`roleid`, `rolename`) VALUES
(1, 'Administrator'),
(2, 'Course Leader'),
(3, 'Course Moderator'),
(4, 'Director of Learning and Quality'),
(6, 'Guest'),
(5, 'Pro-Vice Chancellor');

-- --------------------------------------------------------

--
-- Table structure for table `userstbl`
--

CREATE TABLE IF NOT EXISTS `userstbl` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `roleid` int(100) NOT NULL,
  `email` varchar(225) NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_roleid` (`roleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `userstbl`
--

INSERT INTO `userstbl` (`userid`, `username`, `password`, `roleid`, `email`, `id`) VALUES
(2, 'pvc1', '1a1dc91c907325c69271ddf0c944bc72', 5, 'pvc1@cmruni.com', 0),
(3, 'pvc2', '1a1dc91c907325c69271ddf0c944bc72', 5, 'pvc2@cmruni.com', 0),
(4, 'pvc3', '1a1dc91c907325c69271ddf0c944bc72', 5, 'pvc3@cmruni.com', 0),
(5, 'staff1', '1a1dc91c907325c69271ddf0c944bc72', 2, 'staff1@cmruni.com', 0),
(6, 'staff2', '1a1dc91c907325c69271ddf0c944bc72', 3, 'staff2@cmruni.com', 0),
(7, 'dlt1', '1a1dc91c907325c69271ddf0c944bc72', 4, 'onlinebowow@yahoo.com', 0),
(9, 'dlt2', '1a1dc91c907325c69271ddf0c944bc72', 4, 'dlt2@cmruni.com', 0),
(12, 'admin1', '1a1dc91c907325c69271ddf0c944bc72', 1, 'admin1@cmruni.com', 0),
(13, 'shequeri', '1a1dc91c907325c69271ddf0c944bc72', 2, 'shequeri@ymail.com', 0),
(14, 'tukson', '1a1dc91c907325c69271ddf0c944bc72', 3, 'wallaceafam@gmail.com', 0),
(15, 'garus', '1a1dc91c907325c69271ddf0c944bc72', 1, 'garus@cmruni.com', 0),
(16, 'pvc4', '1a1dc91c907325c69271ddf0c944bc72', 5, 'pvc4@cmruni.com', 0),
(55, 'user1', '1a1dc91c907325c69271ddf0c944bc72', 2, 'eeeavong@live.com', 0),
(56, 'user2', '1a1dc91c907325c69271ddf0c944bc72', 3, 'eeavong@gmail.com', 0),
(57, 'user3', '1a1dc91c907325c69271ddf0c944bc72', 4, 'eavong@ymail.com', 0),
(58, 'user4', '1a1dc91c907325c69271ddf0c944bc72', 5, 'avonggt00517@fpt.edu.vn', 0),
(59, 'user5', '1a1dc91c907325c69271ddf0c944bc72', 6, 'guest@cmruni.com', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigntbl`
--
ALTER TABLE `assigntbl`
  ADD CONSTRAINT `course_fka` FOREIGN KEY (`courseid`) REFERENCES `coursestbl` (`courseID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `userfk_cl` FOREIGN KEY (`courseleader`) REFERENCES `userstbl` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `userfk_cm` FOREIGN KEY (`coursemoderator`) REFERENCES `userstbl` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cmrtbl`
--
ALTER TABLE `cmrtbl`
  ADD CONSTRAINT `assign_fk` FOREIGN KEY (`assignid`) REFERENCES `assigntbl` (`assignid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `commenttbl`
--
ALTER TABLE `commenttbl`
  ADD CONSTRAINT `cmrid_fk` FOREIGN KEY (`cmrid`) REFERENCES `cmrtbl` (`cmrID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `coursestbl`
--
ALTER TABLE `coursestbl`
  ADD CONSTRAINT `fac_fk` FOREIGN KEY (`FacultyID`) REFERENCES `facultytbl` (`FacultyID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `facultytbl`
--
ALTER TABLE `facultytbl`
  ADD CONSTRAINT `userfk_1` FOREIGN KEY (`pvc`) REFERENCES `userstbl` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `userfk_2` FOREIGN KEY (`dlt`) REFERENCES `userstbl` (`userid`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `userstbl`
--
ALTER TABLE `userstbl`
  ADD CONSTRAINT `fk_roleid` FOREIGN KEY (`roleid`) REFERENCES `roletbl` (`roleid`);

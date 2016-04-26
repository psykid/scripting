-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2016 at 06:07 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `answerId` int(11) NOT NULL DEFAULT '0',
  `text` varchar(100) DEFAULT NULL,
  `questionId` int(11) DEFAULT NULL,
  `isCorrect` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`answerId`),
  KEY `questionId` (`questionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `optionstype`
--

CREATE TABLE IF NOT EXISTS `optionstype` (
  `typeId` int(11) NOT NULL DEFAULT '0',
  `negative_marks` int(11) DEFAULT NULL,
  `positive_marks` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`typeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `questionId` int(11) NOT NULL DEFAULT '0',
  `quizId` int(11) DEFAULT NULL,
  `typeId` int(11) DEFAULT NULL,
  `question` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`questionId`),
  KEY `quizId` (`quizId`),
  KEY `typeId` (`typeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `quizId` int(11) NOT NULL DEFAULT '0',
  `dateOfCreation` date DEFAULT NULL,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `duration` int(11) NOT NULL COMMENT 'in minutes',
  `title` varchar(40) NOT NULL,
  `description` varchar(200) NOT NULL,
  `maxScore` decimal(4,3) DEFAULT NULL,
  PRIMARY KEY (`quizId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_students`
--

CREATE TABLE IF NOT EXISTS `quiz_students` (
  `selectionId` int(11) NOT NULL DEFAULT '0',
  `quizzId` int(11) DEFAULT NULL,
  `studentId` int(11) DEFAULT NULL,
  `questionId` int(11) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  PRIMARY KEY (`selectionId`),
  KEY `quizzId` (`quizzId`),
  KEY `studentId` (`studentId`),
  KEY `questionId` (`questionId`),
  KEY `answer` (`answer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `sId` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`sId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `questions` (`questionId`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`quizId`) REFERENCES `quizzes` (`quizId`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`typeId`) REFERENCES `optionstype` (`typeId`);

--
-- Constraints for table `quiz_students`
--
ALTER TABLE `quiz_students`
  ADD CONSTRAINT `quiz_students_ibfk_1` FOREIGN KEY (`quizzId`) REFERENCES `quizzes` (`quizId`),
  ADD CONSTRAINT `quiz_students_ibfk_2` FOREIGN KEY (`studentId`) REFERENCES `students` (`sId`),
  ADD CONSTRAINT `quiz_students_ibfk_3` FOREIGN KEY (`questionId`) REFERENCES `questions` (`questionId`),
  ADD CONSTRAINT `quiz_students_ibfk_4` FOREIGN KEY (`answer`) REFERENCES `answers` (`answerId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

 <?php
 // DB connection info
/* $host = "ap-cdbr-azure-southeast-b.cloudapp.net";
 $user = "ba6c086e8940fd";
 $pwd = "a5c3978a";
 $db = "oneschool";
 try{
    $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
     
    $sql = "-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2017 at 04:10 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = `NO_AUTO_VALUE_ON_ZERO`;
SET time_zone = `+00:00`;

DROP DATABASE IF EXISTS `oneschool';
CREATE DATABASE `oneschool`;

USE `oneschool`;


--
-- Database: `oneschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `dhx_data`
--

CREATE TABLE `dhx_data` (
  `sheetid` varchar(255) NOT NULL,
  `columnid` int(11) NOT NULL,
  `rowid` int(11) NOT NULL,
  `data` varchar(255) DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `parsed` varchar(255) DEFAULT NULL,
  `calc` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dhx_data`
--

INSERT INTO `dhx_data` (`sheetid`, `columnid`, `rowid`, `data`, `style`, `parsed`, `calc`) VALUES
('1', 5, 4, '85', '0;0;000000;ffffff;left;none;0', '85', '85'),
('1', 4, 4, '88', '0;0;000000;ffffff;left;none;0', '88', '88'),
('1', 2, 4, '98', '0;0;000000;ffffff;left;none;0', '98', '98'),
('1', 3, 4, '89', '0;0;000000;ffffff;left;none;0', '89', '89'),
('1', 2, 3, 'Mother Tongue', '0;0;000000;ffffff;left;none;0', 'Mother Tongue', 'Mother Tongue');

-- --------------------------------------------------------

--
-- Table structure for table `dhx_header`
--

CREATE TABLE `dhx_header` (
  `sheetid` varchar(255) NOT NULL,
  `columnid` int(11) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `width` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dhx_header`
--  

INSERT INTO `dhx_header` (`sheetid`, `columnid`, `label`, `width`) VALUES
('1', 2, 'B', 164);

-- --------------------------------------------------------

--
-- Table structure for table `dhx_sheet`
--

CREATE TABLE `dhx_sheet` (
  `sheetid` varchar(255) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `cfg` varchar(512) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dhx_sheet`
--

INSERT INTO `dhx_sheet` (`sheetid`, `userid`, `name`, `key`, `cfg`) VALUES
('demo_sheet', NULL, NULL, 'any_key', NULL),
('1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dhx_triggers`
--

CREATE TABLE `dhx_triggers` (
  `id` int(11) NOT NULL,
  `sheetid` varchar(255) DEFAULT NULL,
  `trigger` varchar(10) DEFAULT NULL,
  `source` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dhx_user`
--

CREATE TABLE `dhx_user` (
  `userid` int(11) NOT NULL,
  `apikey` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `secret` varchar(64) DEFAULT NULL,
  `pass` varchar(64) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grade analysis`
--

CREATE TABLE `grade_analysis` (
  `subject` varchar(255) NOT NULL,
  `average` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentgrades`
--

CREATE TABLE `studentgrades` (
  `idnum` int(11) NOT NULL,
  `gradingper` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `firstgr` int(11) NOT NULL,
  `secondgr` int(11) NOT NULL,
  `thirdgr` int(11) NOT NULL,
  `fourthgr` int(11) NOT NULL,
  `GRADE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentgrades`
--

INSERT INTO `studentgrades` (`idnum`, `gradingper`, `subject`, `firstgr`, `secondgr`, `thirdgr`, `fourthgr`, `GRADE_ID`) VALUES
(1401334, 1, 'Mother Tongue', 85, 89, 88, 89, 1),
(14101334, 1, 'Filipino', 93, 89, 88, 91, 2),
(14101334, 1, 'English', 90, 87, 89, 90, 3),
(1401334, 1, 'Mathematics', 95, 94, 91, 95, 4),
(14101334, 1, 'Science', 87, 92, 94, 96, 5),
(1401334, 1, 'Araling Panlipunan', 93, 90, 88, 92, 6),
(1401334, 1, 'Edukasyon sa Pagpakatao', 91, 91, 91, 91, 7),
(14101334, 1, 'Music', 90, 90, 90, 90, 8),
(14101334, 1, 'Arts', 91, 91, 91, 91, 9),
(14101334, 1, 'Physical Education', 90, 91, 92, 93, 10),
(14101334, 1, 'Health', 92, 92, 92, 92, 11),
(14101334, 1, 'Edukasyong Pantahanan at Pangkabuhayan', 89, 83, 84, 78, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dhx_data`
--
ALTER TABLE `dhx_data`
  ADD PRIMARY KEY (`sheetid`,`columnid`,`rowid`);

--
-- Indexes for table `dhx_header`
--
ALTER TABLE `dhx_header`
  ADD PRIMARY KEY (`sheetid`,`columnid`);

--
-- Indexes for table `dhx_sheet`
--
ALTER TABLE `dhx_sheet`
  ADD PRIMARY KEY (`sheetid`);

--
-- Indexes for table `dhx_triggers`
--
ALTER TABLE `dhx_triggers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dhx_user`
--
ALTER TABLE `dhx_user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `studentgrades`
--
ALTER TABLE `studentgrades`
  ADD PRIMARY KEY (`GRADE_ID`),
  ADD KEY `idnum` (`idnum`),
  ADD KEY `gradingper` (`gradingper`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dhx_triggers`
--
ALTER TABLE `dhx_triggers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dhx_user`
--
ALTER TABLE `dhx_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `studentgrades`
--
ALTER TABLE `studentgrades`
  MODIFY `GRADE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
";
    $result = $conn->query($sql);

 }
 catch(Exception $e){
     die(print_r($e));
 }
 echo "<h3>Table created.</h3>";
 ?>
-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2018 at 08:39 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.2.9-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `video`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `exam_dt`
--

CREATE TABLE `exam_dt` (
  `id` int(11) NOT NULL,
  `course` varchar(200) NOT NULL,
  `session` varchar(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `finish_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_dt`
--

INSERT INTO `exam_dt` (`id`, `course`, `session`, `date`, `start_time`, `finish_time`) VALUES
(1, 'MTH 101', '2017/2018', '2017-09-03', '16:21:00', '16:22:00'),
(2, 'com212', '2017/2018', '2017-09-03', '15:05:00', '16:57:00'),
(3, 'cmp 501', '2017/2018', '2017-09-14', '10:47:00', '11:52:00'),
(4, 'cmp 5000', '2017/2018', '2017-09-15', '03:09:00', '03:10:00'),
(5, 'CHM 1022', '2017/2018', '2017-09-15', '03:31:00', '03:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  `session` varchar(20) NOT NULL,
  `question_id` varchar(20) NOT NULL,
  `question_option` varchar(255) NOT NULL,
  `correct` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `course`, `session`, `question_id`, `question_option`, `correct`) VALUES
(1, 'MTH 101', '2017/2018', 'MTH1011', '1', '0'),
(2, 'MTH 101', '2017/2018', 'MTH1011', '2', '1'),
(3, 'MTH 101', '2017/2018', 'MTH1011', '3', '0'),
(4, 'MTH 101', '2017/2018', 'MTH1011', '4', '0'),
(5, 'MTH 101', '2017/2018', 'MTH1012', '2', '0'),
(6, 'MTH 101', '2017/2018', 'MTH1012', '-2', '1'),
(7, 'com212', '2017/2018', 'com2121', 'machine', '0'),
(8, 'com212', '2017/2018', 'com2121', 'electronic', '1'),
(9, 'com212', '2017/2018', 'com2121', 'device', '0'),
(10, 'com212', '2017/2018', 'com2121', 'motor', '0'),
(11, 'cmp 501', '2017/2018', 'cmp5011', '1', '0'),
(12, 'cmp 501', '2017/2018', 'cmp5011', '2', '1'),
(13, 'cmp 5000', '2017/2018', 'cmp50001', '1', '0'),
(14, 'cmp 5000', '2017/2018', 'cmp50001', '2', '0'),
(15, 'cmp 5000', '2017/2018', 'cmp50001', '3', '0'),
(16, 'cmp 5000', '2017/2018', 'cmp50001', '25', '1'),
(17, 'CHM 1022', '2017/2018', 'CHM10221', '1', '1'),
(18, 'CHM 1022', '2017/2018', 'CHM10221', '2', '0'),
(19, 'CHM 1022', '2017/2018', 'CHM10221', '3', '0'),
(20, 'CHM 1022', '2017/2018', 'CHM10221', '4', '0');

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE `Questions` (
  `id` int(11) NOT NULL,
  `question_id` varchar(20) NOT NULL,
  `session` varchar(10) NOT NULL,
  `course` varchar(200) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Questions`
--

INSERT INTO `Questions` (`id`, `question_id`, `session`, `course`, `question`) VALUES
(1, 'MTH1011', '2017/2018', 'MTH 101', '1+1=?'),
(2, 'MTH1012', '2017/2018', 'MTH 101', '2-4=?'),
(3, 'com2121', '2017/2018', 'com212', 'what is computer?'),
(4, 'cmp5011', '2017/2018', 'cmp 501', '2/6=?'),
(5, 'cmp50001', '2017/2018', 'cmp 5000', '5*5=?'),
(6, 'CHM10221', '2017/2018', 'CHM 1022', '3/3=?');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `session` varchar(20) NOT NULL,
  `course` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `tq` tinyint(4) NOT NULL,
  `ta` tinyint(4) NOT NULL,
  `video` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `regno`, `session`, `course`, `score`, `tq`, `ta`, `video`) VALUES
(1, '001', '2017/2018', 'MTH 101', 1, 2, 1, '001MTH10120170903.webm'),
(4, '614', '2017/2018', 'com212', 1, 1, 1, '614com21220170903.webm'),
(6, '001', '2017/2018', 'cmp 501', 1, 1, 1, '001cmp50120170914.webm'),
(7, '001', '2017/2018', 'cmp 5000', 1, 1, 1, '001cmp500020170915.webm'),
(8, '001', '2017/2018', 'CHM 1022', 1, 1, 1, '001CHM102220170915.webm');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(20) NOT NULL,
  `course` varchar(100) NOT NULL,
  `session` varchar(20) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `matric_no` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'dummy',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `matric_no`, `name`, `phone`, `image`, `password`) VALUES
(1, '001', 'Chukwudi Akam', '08133323773', '001.jpg', 'e193a01ecf8d30ad0affefd332ce934e32ffce72'),
(2, '614', 'Akam', '07035476900', 'dummy', '1bdf1a2fc92382e70ba7d9f31ae616547c06f2b2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`username`);

--
-- Indexes for table `exam_dt`
--
ALTER TABLE `exam_dt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Questions`
--
ALTER TABLE `Questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `question_id` (`question_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Matric_no` (`matric_no`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `exam_dt`
--
ALTER TABLE `exam_dt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `Questions`
--
ALTER TABLE `Questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

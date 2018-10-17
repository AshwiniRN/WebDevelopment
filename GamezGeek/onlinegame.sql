-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2017 at 06:17 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamezgeek`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `sno` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password_original` varchar(100) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `membership` varchar(50) NOT NULL,
  `register_date` varchar(20) NOT NULL,
  `status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`sno`, `username`, `password`, `password_original`, `emailid`, `fullname`, `membership`, `register_date`, `status`) VALUES
(1, 'rawee', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'mail@mail.com', '', 'user', '', 0),
(2, 'raweee', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'masil@mail.com', '123456', '5', '', 1),
(3, 'rawees', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'maidl@mail.com', '123456', '5', '', 1),
(5, 'test', '5f4dcc3b5aa765d61d8327deb882cf99', 'password', 'test@tess.com', 'password', '5', '', 1),
(6, 'user1', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'abc@abc.com', '123456', '5', '2017-06-18 08:54:33', 1),
(7, '123456', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'maffil@mail.com', '123456', '5', '2017-06-18 09:23:48', 1),
(8, 'ashwini', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'ash@ash.com', '123456', '5', '2017-06-18 09:45:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gamezgeeks`
--

CREATE TABLE `gamezgeeks` (
  `sno` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password_original` varchar(100) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `rolename` varchar(50) NOT NULL,
  `status` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gamezgeeks`
--

INSERT INTO `gamezgeeks` (`sno`, `username`, `password`, `password_original`, `emailid`, `rolename`, `status`) VALUES
(1, 'rawee', 'd2b0214c9aced3b346343a19767252cd', '123456', 'mail@mail.com', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `gamezgeeks`
--
ALTER TABLE `gamezgeeks`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `gamezgeeks`
--
ALTER TABLE `gamezgeeks`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

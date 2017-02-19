-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2017 at 09:52 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mist_hptb`
--

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `rDt` varchar(30) NOT NULL,
  `tDtTm` varchar(30) NOT NULL,
  `client` varchar(255) NOT NULL,
  `clientRef` varchar(32) NOT NULL,
  `crDt` varchar(30) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `meRef` varchar(32) NOT NULL,
  `mrDt` varchar(30) NOT NULL,
  `pumpType` varchar(30) NOT NULL,
  `pipeDia` int(11) NOT NULL,
  `discharge` int(11) NOT NULL,
  `head` int(11) NOT NULL,
  `pumpSn` varchar(50) NOT NULL,
  `motorSn` varchar(50) NOT NULL,
  `testData` mediumtext NOT NULL,
  `author` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `rDt`, `tDtTm`, `client`, `clientRef`, `crDt`, `supplier`, `meRef`, `mrDt`, `pumpType`, `pipeDia`, `discharge`, `head`, `pumpSn`, `motorSn`, `testData`, `author`) VALUES
(1, '445', '44', 'ddf', '33', '09-Feb-2017', 'asfd', 'asdf', 'adsf', 'Centrifugal Pump', 8, 0, 0, '', '', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(2, '45', 'wer', 'ytrt', 'ghj', 'ghf', 'bndgh', 'hgkjg', 'sdfg', 'Centrifugal Pump', 3, 7, 7, 'er', 'rfd', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(3, '46', '10-Feb-2017@3:00 PM', 'ytrt', 'ghj', 'ghf', 'bndgh', 'hgkjg', 'sdfg', 'Centrifugal Pump', 3, 7, 7, 'er', 'rfd', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', 'ttt'),
(4, '47', 'wer@3:30 PM', 'ytrt', 'ghj', 'ghf', 'bndgh', 'hgkjg', 'sdfg', 'Centrifugal Pump', 3, 7, 7, 'er', 'rfd', '[{"vo":3,"sp":3,"dp":3,"frm":3,"fru":3,"men":3,"mfq":3},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":55.5,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(5, '48', '09-Feb-2017@2:45 PM', 'ytrt', 'ghj', 'ghf', 'bndgh', 'hgkjg', 'sdfg', 'Centrifugal Pump', 3, 7, 7, 'er', 'rfd', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', 'Aman Ullah\nAutomation'),
(15, '06-February-2017', '', 'Sincos', '44554455', '06-February-2017', 'mist', 'm45566', '06-February-2017', 'Centrifugal Pump', 0, 100, 100, 'kd88d88dfuf8f8', '8f88f8gg88hh8h8', '', ''),
(18, '08-February-2017', '', '', '', '', '', '', '06-February-2017', 'Centrifugal Pump', 0, 0, 0, '', '', '', ''),
(19, '08-February-2017', '', '', '', '', '', '', '06-February-2017', 'Centrifugal Pump', 0, 0, 0, '', '', '', ''),
(20, '02-February-2017', '@', 'Sincos Automation Technologies Limited.', 'SATL-45201776', '01-February-2017', 'Siemens Bangladesh Limited', 'MEHPTBMIST201730009', '07-February-2017', 'Centrifugal Pump', 3, 40, 100, 'DS900000987M567', 'MD79986543PR2017', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(21, '01-February-2017', '', '', '', '', '', '', '07-February-2017', 'Submersible Pump', 0, 0, 0, '', '', '', ''),
(22, '16-Feb-2017', '@2:45 PM', 'WASA', '3456', '', '', '9876', '07-February-2017', 'Submersible Pump', 6, 200, 56, '345345', '43564356', '', ''),
(24, '14-February-2017', '', '', '', '', '', '', '08-February-2017', 'Centrifugal Pump', 4, 0, 0, '', '', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(25, '15-Feb-2017', '', 'Sincos automobile limited', '', '', '', '', '08-February-2017', 'Centrifugal Pump', 4, 0, 0, '', '', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(28, '05-February-2017', '12-Feb-2017@10:45 AM', 'Bangla Pump Company', 'BPC2314532009', '04-February-2017', 'BPMC Bangladesh Limited', 'ME3426754678', '12-February-2017', 'Centrifugal Pump', 8, 60, 135, 'BM568877654676544', 'MSN789654300', '[{"vo":30,"sp":2,"dp":8,"frm":40,"fru":41,"men":60,"mfq":50},{"vo":35,"sp":2.2,"dp":7.5,"frm":45,"fru":46,"men":59,"mfq":50},{"vo":40,"sp":2.4,"dp":7,"frm":50,"fru":51,"men":58,"mfq":50},{"vo":45,"sp":2.6,"dp":6.5,"frm":55,"fru":56,"men":57,"mfq":50},{"vo":50,"sp":2.8,"dp":6,"frm":60,"fru":61,"men":56,"mfq":50},{"vo":55,"sp":3,"dp":5.5,"frm":65,"fru":66,"men":55,"mfq":50},{"vo":60,"sp":3.2,"dp":5,"frm":70,"fru":71,"men":54,"mfq":50},{"vo":65,"sp":3.4,"dp":4.5,"frm":75,"fru":76,"men":53,"mfq":50},{"vo":70,"sp":3.6,"dp":4,"frm":80,"fru":81,"men":52,"mfq":50},{"vo":75,"sp":3.8,"dp":3.5,"frm":85,"fru":86,"men":51,"mfq":50}]', ''),
(29, '13-February-2017', '13-Feb-2017@2:45 PM', 'WASA2', '56567', '08-February-2017', 'Siemens', '456456', '13-February-2017', 'Submersible Pump', 6, 45, 56, 'ftyty', 'fdghfdhg', '[{"vo":50,"sp":56,"dp":70,"frm":56,"fru":67,"men":56,"mfq":50},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', 'Alamgir\nKSJKDH');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `accesskey` varchar(32) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobilenumner` varchar(15) NOT NULL,
  `userlevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

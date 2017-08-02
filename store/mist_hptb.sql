-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2017 at 06:30 AM
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
(3, '46', '10-Feb-2017@3:00 PM', 'ytrt', 'ghj', 'ghf', 'bndgh', 'hgkjg', 'sdfg', 'Centrifugal Pump', 3, 7, 7, 'er', 'rfd', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', 'ttt'),
(4, '47', '02-Apr-2017@3:30 PM', 'ytrt', 'ghj', 'ghf', 'bndgh', 'hgkjg', 'sdfg', 'Centrifugal Pump', 3, 7, 7, 'er', 'rfd', '[{"vo":3,"sp":3,"dp":3,"frm":3,"fru":3,"men":3,"mfq":3},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":55.5,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', 'ddd'),
(5, '48', '09-Feb-2017@2:45 PM', 'ytrt', 'ghj', 'ghf', 'bndgh', 'hgkjg', 'sdfg', 'Centrifugal Pump', 3, 7, 7, 'er', 'rfd', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', 'Aman Ullah\nAutomation'),
(15, '06-February-2017', '@9:45 AM', 'Sincos', '44554455', '06-February-2017', 'mist', 'm45566', '06-February-2017', 'Centrifugal Pump', 3, 100, 100, 'kd88d88dfuf8f8', '8f88f8gg88hh8h8', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(18, '08-February-2017', '@9:45 AM', '', '', '', '', '', '06-February-2017', 'Centrifugal Pump', 3, 0, 0, '', '', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(19, '08-February-2017', '@9:45 AM', '', '', '', '', '', '06-February-2017', 'Centrifugal Pump', 3, 0, 0, '', '', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(20, '02-February-2017', '08-April-2017@3:00 PM', 'Sincos Automation Technologies Limited.', 'SATL-45201776', '01-February-2017', 'Siemens Bangladesh Limited', 'MEHPTBMIST201730009', '07-February-2017', 'Centrifugal Pump', 3, 40, 100, 'DS900000987M567', 'MD79986543PR2017', '[{"vo":68,"sp":7,"dp":8,"frm":1,"fru":5,"men":1,"mfq":0}]', 'sss\n<&>\naaa'),
(21, '01-February-2017', '@9:45 AM', '', '', '', '', '', '07-February-2017', 'Submersible Pump', 3, 0, 0, '', '', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(22, '16-Feb-2017', '@2:45 PM', 'WASA', '3456', '', '', '9876', '07-February-2017', 'Submersible Pump', 6, 200, 56, '345345', '43564356', '[{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', ''),
(24, '01-June-2017', '05-June-2017@10:00 PM', 'SINCOS', '170038MTD', '01-June-2017', 'Siemens Bangladesh', 'ME179876', '01-June-2017', 'Submersible Pump', 6, 100, 125, '16000200', '52154724942', '[{"vo":null,"sp":0,"dp":3.6177,"frm":175.5,"fru":175.5,"men":60.8,"mfq":50},{"vo":null,"sp":0,"dp":5.304,"frm":164.7,"fru":164.7,"men":60.1,"mfq":50},{"vo":null,"sp":0,"dp":6.9119,"frm":153.2,"fru":153.2,"men":59.7,"mfq":50},{"vo":null,"sp":0,"dp":8.7256,"frm":140.7,"fru":140.7,"men":59.2,"mfq":50},{"vo":null,"sp":0,"dp":10.8924,"frm":124.4,"fru":124.4,"men":58.9,"mfq":50},{"vo":null,"sp":0,"dp":12.7159,"frm":108.7,"fru":108.7,"men":58.6,"mfq":50},{"vo":null,"sp":0,"dp":13.5493,"frm":100.8,"fru":100.8,"men":58.3,"mfq":50},{"vo":null,"sp":0,"dp":14.1082,"frm":93,"fru":93,"men":57.9,"mfq":50},{"vo":null,"sp":0,"dp":14.4611,"frm":88.5,"fru":88.5,"men":57.6,"mfq":50}]', ''),
(28, '05-February-2017', '12-Feb-2017@10:45 AM', 'Bangla Pump Company', 'BPC2314532009', '04-February-2017', 'BPMC Bangladesh Limited', 'ME3426754678', '12-February-2017', 'Centrifugal Pump', 8, 60, 135, 'BM568877654676544', 'MSN789654300', '[{"vo":30,"sp":2,"dp":8,"frm":32,"fru":41,"men":60,"mfq":50},{"vo":35,"sp":2.2,"dp":7.5,"frm":80,"fru":46,"men":59,"mfq":50},{"vo":40,"sp":2.4,"dp":7,"frm":95,"fru":51,"men":58,"mfq":50},{"vo":45,"sp":2.6,"dp":6.5,"frm":112,"fru":56,"men":57,"mfq":50},{"vo":50,"sp":2.8,"dp":6,"frm":150,"fru":61,"men":56,"mfq":50},{"vo":55,"sp":3,"dp":5.5,"frm":170,"fru":66,"men":55,"mfq":50},{"vo":60,"sp":3.2,"dp":5,"frm":190,"fru":71,"men":54,"mfq":50},{"vo":65,"sp":3.4,"dp":4.5,"frm":192,"fru":76,"men":53,"mfq":50},{"vo":70,"sp":3.6,"dp":4,"frm":200,"fru":81,"men":52,"mfq":50},{"vo":75,"sp":3.8,"dp":3.5,"frm":85,"fru":86,"men":51,"mfq":50}]', ''),
(29, '13-February-2017', '13-Feb-2017@2:45 PM', 'WASA2', '56567', '08-February-2017', 'Siemens', '456456', '13-February-2017', 'Submersible Pump', 6, 45, 56, 'ftyty', 'fdghfdhg', '[{"vo":50,"sp":56,"dp":70,"frm":56,"fru":67,"men":56,"mfq":50},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null},{"vo":null,"sp":null,"dp":null,"frm":null,"fru":null,"men":null,"mfq":null}]', 'Alamgir\nKSJKDH'),
(30, '13-February-2017', '', 'WASA2', '56567R1', '08-February-2017', 'Siemens', '456456', '13-February-2017', 'Submersible Pump', 6, 45, 56, 'ftyty', 'fdghfdhg', '', ''),
(31, '13-February-2017', '', 'WASA2', '56567', '08-February-2017', 'Siemens', '456456', '13-February-2017', 'Submersible Pump', 6, 45, 56, 'ftyty', 'fdghfdhg', '', ''),
(32, '13-February-2017', '', 'WASA2', '56567', '08-February-2017', 'Siemens', '456456R1', '13-February-2017', 'Submersible Pump', 6, 45, 56, 'ftyty', 'fdghfdhg', '', '');

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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `accesskey`, `fullname`, `designation`, `email`, `mobilenumner`, `userlevel`) VALUES
(1, 'admin', 'admin', 'Administrator', 'admin', 'postmaster@localhost.com', '01823022586', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

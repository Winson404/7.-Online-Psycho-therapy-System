-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2022 at 05:13 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `psycho_therapy_revised`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`admin_Id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_registered` date NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `dob`, `age`, `address`, `email`, `contact`, `password`, `image`, `date_registered`, `user_type`) VALUES
(1, 'Erwin', 'Cabag', 'Son', '', 'Male', '2022-04-06', 23, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'admin@gmail.com', '09359428963', '21232f297a57a5a743894a0e4a801fc3', 'minimalism-1644666519306-6515.jpg', '2022-04-17', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_payment`
--

CREATE TABLE IF NOT EXISTS `admin_payment` (
`admin_payment_Id` int(11) NOT NULL,
  `admin_payment_patient_Id` int(11) NOT NULL,
  `admin_payment_therapist_Id` int(11) NOT NULL,
  `admin_payment_admin_Id` int(11) NOT NULL,
  `OR_num` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `admin_payment`
--

INSERT INTO `admin_payment` (`admin_payment_Id`, `admin_payment_patient_Id`, `admin_payment_therapist_Id`, `admin_payment_admin_Id`, `OR_num`) VALUES
(44, 43, 25, 1, '2022-0000001'),
(45, 43, 25, 1, '2022-0000001'),
(46, 43, 25, 1, '2022-0000002'),
(47, 44, 25, 1, '2022-0000002'),
(48, 43, 27, 1, '2022-0000003'),
(49, 43, 25, 1, '2022-0000001'),
(50, 36, 26, 1, '2022-0000002'),
(51, 43, 27, 1, '2022-0000003');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
`appointment_Id` int(11) NOT NULL,
  `appointment_patient_Id` int(11) NOT NULL,
  `appointment_therapist_Id` int(11) NOT NULL,
  `appointment_consultancy_fee_Id` int(11) NOT NULL,
  `no_of_hours` int(11) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(255) NOT NULL,
  `appointment_status` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_Id`, `appointment_patient_Id`, `appointment_therapist_Id`, `appointment_consultancy_fee_Id`, `no_of_hours`, `total_amount`, `appointment_date`, `appointment_time`, `appointment_status`) VALUES
(22, 42, 25, 7, 1, '5000', '2022-06-09', '23:31', 'Approved'),
(24, 43, 25, 7, 2, '10000', '2022-07-14', '12:49', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `consultancy_fee`
--

CREATE TABLE IF NOT EXISTS `consultancy_fee` (
`consult_fee_Id` int(11) NOT NULL,
  `consult_fee_therapist_Id` int(11) NOT NULL,
  `consult_fee` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `consultancy_fee`
--

INSERT INTO `consultancy_fee` (`consult_fee_Id`, `consult_fee_therapist_Id`, `consult_fee`) VALUES
(6, 27, '312'),
(7, 25, '5000'),
(8, 26, '600');

-- --------------------------------------------------------

--
-- Table structure for table `credential`
--

CREATE TABLE IF NOT EXISTS `credential` (
`credential_Id` int(11) NOT NULL,
  `therapist_Id` int(11) NOT NULL,
  `credential_images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`msg_Id` int(11) NOT NULL,
  `msg_therapist_Id` int(11) NOT NULL,
  `msg_patient_Id` int(11) NOT NULL,
  `msg_comment` text NOT NULL,
  `msg_date_added` varchar(255) NOT NULL,
  `msg_read` int(11) NOT NULL DEFAULT '0' COMMENT '0=Unread, 1=Read',
  `therapist_reply` text NOT NULL,
  `therapist_date_replied` varchar(255) NOT NULL,
  `reply_read` varchar(255) NOT NULL DEFAULT '0' COMMENT '0=unread. 1=read',
  `patient_delete` int(11) NOT NULL DEFAULT '0' COMMENT '0=Not deleted, 1=Deleted',
  `therapist_delete` int(11) NOT NULL DEFAULT '0' COMMENT '0=Not deleted, 1=Deleted'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_Id`, `msg_therapist_Id`, `msg_patient_Id`, `msg_comment`, `msg_date_added`, `msg_read`, `therapist_reply`, `therapist_date_replied`, `reply_read`, `patient_delete`, `therapist_delete`) VALUES
(46, 25, 44, 'haha', '2022-08-02', 0, 'r 1', '2022-08-02', '0', 1, 0),
(47, 25, 44, '1', '2022-08-02', 1, 'he', '2022-08-02', '1', 0, 0),
(48, 25, 44, 'da', '2022-08-02', 1, 'hu', '2022-08-02', '1', 0, 0),
(49, 25, 44, 'gig', '2022-08-02', 0, 'gag', '2022-08-02', '0', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `new_appointment`
--

CREATE TABLE IF NOT EXISTS `new_appointment` (
`appointment_Id` int(11) NOT NULL,
  `appointment_patient_Id` int(11) NOT NULL,
  `appointment_therapist_Id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(255) NOT NULL,
  `appointment_status` varchar(100) NOT NULL DEFAULT 'Pending',
  `admin_confirmation` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `new_appointment`
--

INSERT INTO `new_appointment` (`appointment_Id`, `appointment_patient_Id`, `appointment_therapist_Id`, `appointment_date`, `appointment_time`, `appointment_status`, `admin_confirmation`) VALUES
(30, 43, 25, '2022-08-09', '12:41', 'Pending', 'Pending'),
(31, 43, 27, '2022-08-10', '13:42', 'Done', 'Confirmed'),
(33, 43, 27, '2022-08-04', '23:15', 'Pending', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `new_payment`
--

CREATE TABLE IF NOT EXISTS `new_payment` (
`new_payment_Id` int(11) NOT NULL,
  `OR_num` varchar(255) NOT NULL,
  `new_payment_admin_Id` int(11) NOT NULL,
  `new_payment_patient_Id` int(11) NOT NULL,
  `new_payment_therapist_Id` int(11) NOT NULL,
  `new_payment_consultancy_fee_Id` int(11) NOT NULL,
  `no_of_hours` int(11) NOT NULL,
  `total_amount_payable` varchar(100) NOT NULL,
  `total_amount_to_paid` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `date_paid` varchar(255) NOT NULL,
  `admin_commission` varchar(255) NOT NULL,
  `therapist_commission` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `new_payment`
--

INSERT INTO `new_payment` (`new_payment_Id`, `OR_num`, `new_payment_admin_Id`, `new_payment_patient_Id`, `new_payment_therapist_Id`, `new_payment_consultancy_fee_Id`, `no_of_hours`, `total_amount_payable`, `total_amount_to_paid`, `balance`, `date_paid`, `admin_commission`, `therapist_commission`) VALUES
(72, '2022-0000001', 1, 43, 25, 7, 1, '5000', '5000', '0', '2022-08-08', '2000', '3000'),
(73, '2022-0000002', 0, 36, 26, 8, 1, '600', '600', '0', '2022-08-08', '', ''),
(74, '2022-0000003', 0, 43, 27, 6, 1, '312', '312', '0', '2022-08-08', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
`patient_Id` int(11) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `patient_firstname` varchar(255) NOT NULL,
  `patient_middlename` varchar(255) NOT NULL,
  `patient_lastname` varchar(255) NOT NULL,
  `patient_suffix` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `disease_type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_registered` date NOT NULL,
  `patient_status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_Id`, `nationality`, `patient_firstname`, `patient_middlename`, `patient_lastname`, `patient_suffix`, `gender`, `dob`, `age`, `address`, `email`, `contact`, `password`, `disease_type`, `image`, `date_registered`, `patient_status`) VALUES
(36, 'Filipino', 'Erwin', 'Cabag', 'Son', '', 'Male', '2022-05-19', 32, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'patient@gmail.com', '9359428963', '21232f297a57a5a743894a0e4a801fc3', 'fds', 'Screenshot (2).png', '2022-05-20', 'Confirmed'),
(37, '', 'ss', 'ss', 'ss', '', 'Female', '2022-05-17', 3, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sss@gmail.com', '9359428963', '21232f297a57a5a743894a0e4a801fc3', '', 'Screenshot (2).png', '2022-05-21', 'Pending'),
(38, '', 's', 's', 's', '', 'Male', '2022-05-06', 23, 'ss', 'samplesad@gmail.com', '432', 'ss', '', 'minimalism-1644666519306-6515.jpg', '2022-05-22', 'Pending'),
(39, '', 'Erwin', 'Cabag', 'Son1', '', 'Male', '2022-05-11', 21, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin1s2@gmail.com', '09359428963', '21232f297a57a5a743894a0e4a801fc3', '', '4297150.jpg', '2022-05-23', 'Confirmed'),
(40, '', 'fds', 'fds', 'dfs', '', 'Male', '2022-06-15', 2, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin12dsfsf@gmail.com', '09359428963', '3691308f2a4c2f6983f2880d32e29c84', '', 'minimalism-1644666519306-6515.jpg', '2022-06-03', 'Pending'),
(42, '', 'SAMPLE', 'SAMPLE', 'SAMPLE', '', 'Female', '2022-05-31', 1, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin12@gmail.com', '09359428963', '21232f297a57a5a743894a0e4a801fc3', '', '4297150.jpg', '2022-06-07', 'Confirmed'),
(43, 'Filipino', 'Erwin', 'Cabag', 'Son', '', 'Male', '2022-07-13', 12, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'ad@gmail.com', '9359428963', '21232f297a57a5a743894a0e4a801fc3', '2343fsdgfd', 'Screenshot (158).png', '2022-07-29', 'Confirmed'),
(44, '', 'Danilo', 'Cabag', 'Nicolas', '', 'Male', '2022-08-02', 1, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'danilo@gmail.com', '9359428963', '21232f297a57a5a743894a0e4a801fc3', 'Covid', 'Screenshot (158).png', '2022-08-02', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`payment_Id` int(11) NOT NULL,
  `payment_admin_Id` int(11) NOT NULL,
  `payment_patient_Id` int(11) NOT NULL,
  `payment_therapist_Id` int(11) NOT NULL,
  `total_payable` varchar(255) NOT NULL,
  `amount_paid` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `admin_commission` varchar(255) NOT NULL,
  `therapist_commission` varchar(255) NOT NULL,
  `date_paid` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_Id`, `payment_admin_Id`, `payment_patient_Id`, `payment_therapist_Id`, `total_payable`, `amount_paid`, `balance`, `admin_commission`, `therapist_commission`, `date_paid`) VALUES
(2, 1, 36, 253, '30000', '30000', '0', '12000', '18000', '2022-05-28'),
(4, 1, 37, 26, '600', '600', '0', '240', '360', '2022-05-28'),
(5, 1, 42, 252, '10000', '10000', '0', '2000', '6000', '2022-06-29'),
(7, 1, 43, 25, '10000', '123', '9877', '49.2', '73.8', '2022-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `therapist`
--

CREATE TABLE IF NOT EXISTS `therapist` (
`therapist_Id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `therapist_email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `availability` varchar(255) NOT NULL DEFAULT 'Available',
  `credential_image` varchar(255) NOT NULL,
  `date_registered` date NOT NULL,
  `nationality` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `therapist`
--

INSERT INTO `therapist` (`therapist_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `dob`, `age`, `address`, `therapist_email`, `contact`, `password`, `image`, `status`, `availability`, `credential_image`, `date_registered`, `nationality`) VALUES
(25, 'Robin', 'C', 'Duterte', '', 'Male', '2022-05-04', 24, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'therapist@gmail.com', '9359428963', '21232f297a57a5a743894a0e4a801fc3', 'male.jpg', 'Confirmed', 'Available', 'Screenshot (159).png', '2022-05-20', 'Filipino'),
(26, 'Kimberly Xyle', '', 'Ortiz', '', 'Female', '2022-05-25', 32, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin12@gmail.com', '9359428963', '21232f297a57a5a743894a0e4a801fc3', 'art-hauntington-jzY0KRJopEI-unsplash.jpg', 'Confirmed', 'Available', '', '2022-05-21', ''),
(27, 'dada', 'dada', 'dada', 'dada', 'Male', '2022-08-03', 12, 'dada', 'dada@gmail.com', '9359428963', '21232f297a57a5a743894a0e4a801fc3', 'default.png', 'Confirmed', 'Available', 'Screenshot (158).png', '2022-08-08', 'dad');

-- --------------------------------------------------------

--
-- Table structure for table `therapist_reply`
--

CREATE TABLE IF NOT EXISTS `therapist_reply` (
`reply_Id` int(11) NOT NULL,
  `reply_msg_Id` int(11) NOT NULL,
  `reply_therapist_Id` int(11) NOT NULL,
  `reply_patient_Id` int(11) NOT NULL,
  `reply_messge` text NOT NULL,
  `reply_date_added` varchar(255) NOT NULL,
  `reply_read` int(11) NOT NULL DEFAULT '0' COMMENT '0=Unread, 1=Read'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_Id`);

--
-- Indexes for table `admin_payment`
--
ALTER TABLE `admin_payment`
 ADD PRIMARY KEY (`admin_payment_Id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
 ADD PRIMARY KEY (`appointment_Id`);

--
-- Indexes for table `consultancy_fee`
--
ALTER TABLE `consultancy_fee`
 ADD PRIMARY KEY (`consult_fee_Id`);

--
-- Indexes for table `credential`
--
ALTER TABLE `credential`
 ADD PRIMARY KEY (`credential_Id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`msg_Id`);

--
-- Indexes for table `new_appointment`
--
ALTER TABLE `new_appointment`
 ADD PRIMARY KEY (`appointment_Id`);

--
-- Indexes for table `new_payment`
--
ALTER TABLE `new_payment`
 ADD PRIMARY KEY (`new_payment_Id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
 ADD PRIMARY KEY (`patient_Id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`payment_Id`);

--
-- Indexes for table `therapist`
--
ALTER TABLE `therapist`
 ADD PRIMARY KEY (`therapist_Id`);

--
-- Indexes for table `therapist_reply`
--
ALTER TABLE `therapist_reply`
 ADD PRIMARY KEY (`reply_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_payment`
--
ALTER TABLE `admin_payment`
MODIFY `admin_payment_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
MODIFY `appointment_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `consultancy_fee`
--
ALTER TABLE `consultancy_fee`
MODIFY `consult_fee_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `credential`
--
ALTER TABLE `credential`
MODIFY `credential_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `msg_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `new_appointment`
--
ALTER TABLE `new_appointment`
MODIFY `appointment_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `new_payment`
--
ALTER TABLE `new_payment`
MODIFY `new_payment_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
MODIFY `patient_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `payment_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `therapist`
--
ALTER TABLE `therapist`
MODIFY `therapist_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `therapist_reply`
--
ALTER TABLE `therapist_reply`
MODIFY `reply_Id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

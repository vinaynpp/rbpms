-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2020 at 04:24 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(100) NOT NULL,
  `c_email` tinytext NOT NULL,
  `c_name` tinytext NOT NULL DEFAULT 'company',
  `c_password` tinytext NOT NULL DEFAULT '********',
  `c_contact` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `c_email`, `c_name`, `c_password`, `c_contact`) VALUES
(1, 'vinay@vinay', 'intuitioneers', 'qwerqwr', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `c_key_e` int(11) NOT NULL,
  `m_key_e` int(11) NOT NULL,
  `p_key_e` int(11) DEFAULT NULL,
  `e_email` tinytext NOT NULL,
  `e_name` tinytext NOT NULL,
  `e_password` tinytext NOT NULL,
  `e_contact` int(12) NOT NULL,
  `primary_skill` int(11) DEFAULT NULL,
  `secondary_skill` int(11) DEFAULT NULL,
  `extra_skill` int(11) DEFAULT NULL,
  `e_rating` int(10) NOT NULL DEFAULT 10,
  `e_comment` text NOT NULL DEFAULT 'noice employee',
  `e_salary` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `c_key_e`, `m_key_e`, `p_key_e`, `e_email`, `e_name`, `e_password`, `e_contact`, `primary_skill`, `secondary_skill`, `extra_skill`, `e_rating`, `e_comment`, `e_salary`) VALUES
(1, 1, 1, 1, 'employee@employee.com', 'employee', '12345678', 12345678, 0, 1, 1, 10, '\'noice employee\'', 122222),
(2, 1, 1, 1, 'one@one.com', 'one', 'one', 12134213, 1, 0, 1, 10, '\'noice employee\'', 123214),
(3, 1, 1, 2, 'two@two.com', 'two', 'two', 31241342, 0, 1, 0, 10, '\'noice employee\'', 12321312);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `manager_id` int(11) NOT NULL,
  `c_key_m` int(11) NOT NULL,
  `m_email` tinytext NOT NULL,
  `m_name` tinytext NOT NULL DEFAULT 'manager',
  `m_password` text NOT NULL DEFAULT '********',
  `m_contact` int(12) NOT NULL,
  `m_rating` int(10) NOT NULL DEFAULT 10,
  `m_comment` text NOT NULL DEFAULT 'noice manager',
  `m_salary` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_id`, `c_key_m`, `m_email`, `m_name`, `m_password`, `m_contact`, `m_rating`, `m_comment`, `m_salary`) VALUES
(1, 1, 'manager@manager.com', 'manager', '12345678', 0, 10, '\'noice manager\'', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `c_key_p` int(11) NOT NULL,
  `m_key_p` int(11) NOT NULL,
  `p_title` tinytext NOT NULL,
  `p_detail` longtext NOT NULL DEFAULT current_timestamp(),
  `budget` int(11) NOT NULL DEFAULT 0,
  `p_status` tinyint(100) DEFAULT 0,
  `skill_req_1` int(11) DEFAULT NULL,
  `skill_req_2` int(11) DEFAULT NULL,
  `skill_req_3` int(11) DEFAULT NULL,
  `time_req` int(11) DEFAULT 0,
  `min_e_req` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `c_key_p`, `m_key_p`, `p_title`, `p_detail`, `budget`, `p_status`, `skill_req_1`, `skill_req_2`, `skill_req_3`, `time_req`, `min_e_req`) VALUES
(1, 1, 1, 'first project', '123123', 2147483647, 0, 0, 0, 1, 11, 2),
(2, 1, 1, 'second project', 'drtujsdfgjudfgj', 223455, 1, 0, 1, 0, 22, 2);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skills_id` int(11) NOT NULL,
  `skill` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skills_id`, `skill`) VALUES
(0, 'cool'),
(1, 'cool');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `c_email` (`c_email`) USING HASH;

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `e_email` (`e_email`) USING HASH,
  ADD UNIQUE KEY `e_name` (`e_name`) USING HASH,
  ADD KEY `employee_ibfk_4` (`primary_skill`),
  ADD KEY `employee_ibfk_5` (`secondary_skill`),
  ADD KEY `extra_skill` (`extra_skill`),
  ADD KEY `p_key_e` (`p_key_e`) USING BTREE,
  ADD KEY `m_key_e` (`m_key_e`) USING BTREE,
  ADD KEY `c_key_e` (`c_key_e`) USING BTREE;

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`),
  ADD UNIQUE KEY `m_email` (`m_email`) USING HASH,
  ADD KEY `c_key_m` (`c_key_m`) USING BTREE;

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`) USING BTREE,
  ADD KEY `skill_req_1` (`skill_req_1`),
  ADD KEY `skill_req_2` (`skill_req_2`),
  ADD KEY `skill_req_3` (`skill_req_3`),
  ADD KEY `c_key_p` (`c_key_p`) USING BTREE,
  ADD KEY `m_key_p` (`m_key_p`) USING BTREE;

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skills_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`c_key_e`) REFERENCES `company` (`company_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`m_key_e`) REFERENCES `manager` (`manager_id`),
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`p_key_e`) REFERENCES `project` (`project_id`),
  ADD CONSTRAINT `employee_ibfk_4` FOREIGN KEY (`primary_skill`) REFERENCES `skills` (`skills_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_5` FOREIGN KEY (`secondary_skill`) REFERENCES `skills` (`skills_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_6` FOREIGN KEY (`extra_skill`) REFERENCES `skills` (`skills_id`);

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`c_key_m`) REFERENCES `company` (`company_id`) ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`c_key_p`) REFERENCES `company` (`company_id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`m_key_p`) REFERENCES `manager` (`manager_id`),
  ADD CONSTRAINT `project_ibfk_3` FOREIGN KEY (`skill_req_1`) REFERENCES `skills` (`skills_id`),
  ADD CONSTRAINT `project_ibfk_4` FOREIGN KEY (`skill_req_2`) REFERENCES `skills` (`skills_id`),
  ADD CONSTRAINT `project_ibfk_5` FOREIGN KEY (`skill_req_3`) REFERENCES `skills` (`skills_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 06:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

CREATE DATABASE IF NOT EXISTS `db_uppercase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_uppercase`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uppercase`
--

-- --------------------------------------------------------

--
-- Table structure for table `blank`
--

CREATE TABLE `blank` (
  `ID` int(11) NOT NULL,
  `ORDERS` int(11) DEFAULT NULL,
  `CODE` varchar(5) DEFAULT NULL,
  `NAME` varchar(60) DEFAULT NULL,
  `NAME_US` varchar(60) DEFAULT NULL,
  `WORKSTATUS` varchar(2) DEFAULT NULL,
  `DATE_STARTS` datetime NOT NULL DEFAULT current_timestamp(),
  `DATE_UPDATE` datetime DEFAULT NULL,
  `USER_STARTS` int(11) DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `REMARK_DELETE` text DEFAULT NULL,
  `STATUS_OFFVIEW` varchar(1) DEFAULT NULL COMMENT '1=off',
  `STATUS` varchar(1) NOT NULL DEFAULT '1' COMMENT '1=on'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='table standard';

--
-- Dumping data for table `blank`
--

INSERT INTO `blank` (`ID`, `ORDERS`, `CODE`, `NAME`, `NAME_US`, `WORKSTATUS`, `DATE_STARTS`, `DATE_UPDATE`, `USER_STARTS`, `USER_UPDATE`, `REMARK_DELETE`, `STATUS_OFFVIEW`, `STATUS`) VALUES
(1, NULL, NULL, 'data blank1', NULL, NULL, '2023-01-21 15:19:40', '2023-06-25 21:12:15', 1, 1, NULL, '1', '1'),
(2, NULL, 'A002', 'data blank2', 'english data 2', '1', '2023-02-26 16:20:29', '2023-06-25 18:34:43', 1, 1, 'das', NULL, '1'),
(3, NULL, 'A003', 'data blank3', NULL, '2', '2023-01-11 13:20:54', NULL, 1, NULL, NULL, NULL, '1'),
(4, NULL, 'A004', 'data blank4', NULL, '3', '2023-03-26 15:20:54', NULL, 1, NULL, NULL, NULL, '1'),
(5, NULL, 'A005', 'data blank5', NULL, '4', '2023-04-30 08:20:54', '2023-06-26 01:14:09', 1, 1, NULL, NULL, '1'),
(6, NULL, 'A006', 'delete', NULL, '4', '2023-05-30 09:20:54', NULL, 1, NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='data session system';

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('3kgudeiv9t28n8n5cte3bkdine9p1lir', '127.0.0.1', 1718809040, 0x5f5f63695f6c6173745f726567656e65726174657c693a313731383830393033363b757365725f636f64657c733a313a2231223b757365725f656d707c733a313a2230223b757365725f6e616d657c733a363a2261646d696e20223b6465706172746d656e747c4e3b6465706172746d656e745f69647c4e3b73656374696f6e7c4e3b73656374696f6e5f69647c4e3b617574686f72697a6174696f6e7c733a3133323a2265794a30655841694f694a4b563151694c434a68624763694f694a49557a49314e694a392e65794a7a6447466d5a6c39705a434936496a45694c434a4255456c6656456c4e525349364d5463784f4467774f5441304d48302e73776e73356762722d38424f33554c646c7746372d7165776b524844524f4a797469574431437655435445223b);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `ID` int(11) NOT NULL,
  `ORDERS` int(11) DEFAULT NULL,
  `NAME` varchar(25) DEFAULT NULL,
  `DATE_STARTS` timestamp NOT NULL DEFAULT current_timestamp(),
  `DATE_UPDATE` datetime DEFAULT NULL,
  `USER_STARTS` int(11) DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `STATUS_OFFVIEW` char(1) DEFAULT NULL COMMENT '1=off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='user department';

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `CODE` varchar(20) DEFAULT NULL,
  `PREFIX` varchar(30) DEFAULT NULL,
  `NAME` varchar(40) DEFAULT NULL,
  `LASTNAME` varchar(40) DEFAULT NULL,
  `NAME_US` varchar(40) DEFAULT NULL,
  `LASTNAME_US` varchar(40) DEFAULT NULL,
  `MARRIED` varchar(1) DEFAULT NULL COMMENT '1=แต่งงานแล้ว',
  `EMAIL` varchar(60) DEFAULT NULL,
  `POSITION` varchar(60) DEFAULT NULL,
  `DEPARTMENT` varchar(60) DEFAULT NULL,
  `SECTION` varchar(60) DEFAULT NULL,
  `DATE_START` datetime NOT NULL DEFAULT current_timestamp(),
  `DATE_UPDATE` datetime DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `STATUS` varchar(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='data employee';

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `CODE`, `PREFIX`, `NAME`, `LASTNAME`, `NAME_US`, `LASTNAME_US`, `MARRIED`, `EMAIL`, `POSITION`, `DEPARTMENT`, `SECTION`, `DATE_START`, `DATE_UPDATE`, `USER_UPDATE`, `STATUS`) VALUES
(0, NULL, NULL, 'admin', NULL, 'bdminsss', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-01 14:20:00', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(40) DEFAULT NULL,
  `EMAIL` varchar(60) DEFAULT NULL,
  `POSITION` varchar(60) DEFAULT NULL,
  `DEPARTMENT` varchar(60) DEFAULT NULL,
  `SECTION` varchar(60) DEFAULT NULL,
  `DATE_START` datetime NOT NULL DEFAULT current_timestamp(),
  `DATE_UPDATE` datetime DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `STATUS` varchar(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='data member';

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `ID` int(11) NOT NULL,
  `SORT` tinyint(4) DEFAULT NULL,
  `CODE` varchar(25) DEFAULT NULL,
  `NAME` varchar(45) DEFAULT NULL,
  `NAME_US` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='menu system';

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`ID`, `SORT`, `CODE`, `NAME`, `NAME_US`) VALUES
(1, 2, 'dashboard', 'แดชบอร์ด', 'dashboard'),
(2, 1, 'quotation', 'ใบเสนอราคา', 'quotation'),
(3, 3, 'bill', 'ใบขอรับบริการ', 'bill'),
(4, 4, 'workorder', 'work order', 'work order'),
(5, 2, 'instrument', 'เครื่องมือ', 'instrument'),
(6, 2, 'stdinstrument', 'เครื่องมือมาตรฐาน', 'standard instrument');

-- --------------------------------------------------------

--
-- Table structure for table `permit`
--

CREATE TABLE `permit` (
  `ID` int(11) NOT NULL,
  `SORT` tinyint(4) DEFAULT NULL,
  `CODE` varchar(50) DEFAULT NULL,
  `NAME` varchar(45) DEFAULT NULL,
  `NAME_US` varchar(45) DEFAULT NULL,
  `MENUS_ID` int(11) DEFAULT NULL,
  `MENUS_CODE` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='data permit';

--
-- Dumping data for table `permit`
--

INSERT INTO `permit` (`ID`, `SORT`, `CODE`, `NAME`, `NAME_US`, `MENUS_ID`, `MENUS_CODE`) VALUES
(1, 1, 'dashboard.role', 'ข้อมูลแดชบอร์ด', 'dashboard', 1, 'dashboard'),
(2, 1, 'quotation.view', 'ดู ใบเสนอราคา', 'view quotation', 2, 'quotation'),
(3, 2, 'quotation.insert', 'เพิ่ม ใบเสนอราคา', 'add quotation', 2, 'quotation'),
(4, 3, 'quotation.edit', 'แก้ไข ใบเสนอราคา', 'edit quotation', 2, 'quotation'),
(5, 4, 'quotation.delete', 'ลบ ใบเสนอราคา', 'delete quotation', 2, 'quotation'),
(6, 1, 'bill.view', 'ดู ใบขอรับบริการ', 'view bill', 3, 'bill'),
(7, 2, 'bill.insert', 'เพิ่ม ใบขอรับบริการ', 'add bill', 3, 'bill'),
(8, 3, 'bill.edit', 'แก้ไข ใบขอรับบริการ', 'edit bill', 3, 'bill'),
(9, 4, 'bill.delete', 'ลบ ใบขอรับบริการ', 'delete bill', 3, 'bill'),
(10, 5, 'bill.approve', 'อนุมัติ ใบขอรับบริการ', 'approve bill', 3, 'bill'),
(11, 6, 'bill.revise', 'revise ใบขอรับบริการ', 'revise bill', 3, 'bill'),
(12, 1, 'workorder.view', 'ดู work order', 'view work order', 4, 'workorder'),
(13, 2, 'workorder.insert', 'เพิ่ม work order', 'add work order', 4, 'workorder'),
(14, 3, 'workorder.edit', 'แก้ไข work order', 'edit work order', 4, 'workorder'),
(15, 4, 'workorder.delete', 'ลบ work order', 'delete work order', 4, 'workorder'),
(16, 5, 'workorder.approve', 'อนุมัติ work order', 'approve work order', 4, 'workorder'),
(17, 1, 'instrument.view', 'ดู เครื่องมือ', 'view instrument', 5, 'instrument'),
(18, 2, 'instrument.insert', 'เพิ่ม เครื่องมือ', 'add instrument', 5, 'instrument'),
(19, 3, 'instrument.edit', 'แก้ไข เครื่องมือ', 'edit instrument', 5, 'instrument'),
(20, 4, 'instrument.delete', 'ลบ เครื่องมือ', 'delete instrument', 5, 'instrument'),
(21, 1, 'instrumentstd.view', 'ดู เครื่องมือมาตรฐาน', 'view standard instrument', 6, 'standard instrument'),
(22, 2, 'instrumentstd.insert', 'เพิ่ม เครื่องมือมาตรฐาน', 'add standard instrument', 6, 'standard instrument'),
(23, 3, 'instrumentstd.edit', 'แก้ไข เครื่องมือมาตรฐาน', 'edit standard instrument', 6, 'standard instrument'),
(24, 4, 'instrumentstd.delete', 'ลบ เครื่องมือมาตรฐาน', 'delete standard instrument', 6, 'standard instrument');

-- --------------------------------------------------------

--
-- Table structure for table `permit_control`
--

CREATE TABLE `permit_control` (
  `ID` int(11) NOT NULL,
  `STAFF_ID` int(11) DEFAULT NULL,
  `ROLES_ID` int(11) DEFAULT NULL,
  `PERMIT_ID` int(11) DEFAULT NULL,
  `ARIA` varchar(8) DEFAULT NULL COMMENT 'ประเภทการตั้งระยะเวลา ban,assign',
  `PERIOD_BEGIN` datetime DEFAULT NULL COMMENT 'ระยะเวลาเริ่มต้น',
  `PERIOD_END` datetime DEFAULT NULL COMMENT 'ระยะเวลาสิ้นสุด',
  `DATE_STARTS` timestamp NOT NULL DEFAULT current_timestamp(),
  `DATE_UPDATE` datetime DEFAULT NULL,
  `USER_STARTS` int(11) DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `STATUS_OFFVIEW` char(1) DEFAULT NULL COMMENT '1=off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='user permission';

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `NAME` varchar(80) NOT NULL,
  `TITLE_NAME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='data project';

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`NAME`, `TITLE_NAME`) VALUES
('theme', 'ระบบ backend <br> codeigniter 3');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `CODE` varchar(45) DEFAULT NULL,
  `NAME` varchar(45) DEFAULT NULL,
  `NAME_US` varchar(45) DEFAULT NULL,
  `DESCRIPTION` text DEFAULT NULL,
  `DESCRIPTION_US` text DEFAULT NULL,
  `DATE_STARTS` timestamp NOT NULL DEFAULT current_timestamp(),
  `DATE_UPDATE` datetime DEFAULT NULL,
  `USER_STARTS` int(11) DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `NOEDIT` int(11) DEFAULT NULL COMMENT '1=not edit data',
  `STATUS_OFFVIEW` varchar(1) DEFAULT NULL COMMENT '1=off',
  `REMARK_DELETE` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='data roles';

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`ID`, `CODE`, `NAME`, `NAME_US`, `DESCRIPTION`, `DESCRIPTION_US`, `DATE_STARTS`, `DATE_UPDATE`, `USER_STARTS`, `USER_UPDATE`, `NOEDIT`, `STATUS_OFFVIEW`, `REMARK_DELETE`) VALUES
(1, 'administrator', 'admin', 'admin', NULL, NULL, '2023-11-27 01:08:52', NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles_control`
--

CREATE TABLE `roles_control` (
  `ID` int(11) NOT NULL,
  `ROLES_ID` int(11) DEFAULT NULL,
  `ROLES_ID_CHILD` int(11) DEFAULT NULL COMMENT 'id roles child',
  `PERMIT_ID` int(11) DEFAULT NULL,
  `ARIA` varchar(8) DEFAULT NULL COMMENT 'ประเภทการตั้งระยะเวลา ban,assign	',
  `PERIOD_BEGIN` datetime DEFAULT NULL COMMENT 'ระยะเวลาเริ่มต้น',
  `PERIOD_END` datetime DEFAULT NULL COMMENT 'ระยะเวลาสิ้นสุด',
  `DATE_STARTS` timestamp NOT NULL DEFAULT current_timestamp(),
  `DATE_UPDATE` datetime DEFAULT NULL,
  `USER_STARTS` int(11) DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `STATUS_OFFVIEW` char(1) DEFAULT NULL COMMENT '1=off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='data role RBAC';

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `ID` int(11) NOT NULL,
  `ORDERS` int(11) DEFAULT NULL,
  `NAME` varchar(25) DEFAULT NULL,
  `DATE_STARTS` timestamp NOT NULL DEFAULT current_timestamp(),
  `DATE_UPDATE` datetime DEFAULT NULL,
  `USER_STARTS` int(11) DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `STATUS_OFFVIEW` char(1) DEFAULT NULL COMMENT '1=off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='data sections';

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`ID`, `ORDERS`, `NAME`, `DATE_STARTS`, `DATE_UPDATE`, `USER_STARTS`, `USER_UPDATE`, `STATUS_OFFVIEW`) VALUES
(1, NULL, 'ฝ่าย CMK', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(2, NULL, 'ฝ่ายเบเกอรี่', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(3, NULL, 'ฝ่ายโชคชัยสเต็คเฮ้าส์ฟาร์', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(4, NULL, 'ฝ่ายโชคชัยสเต็คเฮ้าส์รังส', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(5, NULL, 'ฝ่ายโรงงานนม', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(6, NULL, 'ฝ่ายกฎหมาย', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(7, NULL, 'ฝ่ายการเงิน', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(8, NULL, 'ฝ่ายการตลาด', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(9, NULL, 'ฝ่ายขาย', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(10, NULL, 'ฝ่ายจัดซื้อ', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(11, NULL, 'ฝ่ายดูแลทรัพย์สินส่วนตัว', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(12, NULL, 'ฝ่ายท่องเที่ยว', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(13, NULL, 'ฝ่ายบริการเครื่องกลเกษตร', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(14, NULL, 'ฝ่ายบริหารบุคคล', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(15, NULL, 'ฝ่ายบัญชี', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(16, NULL, 'ฝ่ายปศุสัตว์', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(17, NULL, 'ฝ่ายพืชสวนไม้ผล', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(18, NULL, 'ฝ่ายพืชอาหารสัตว์', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(19, NULL, 'ฝ่ายวิศวกรรม', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(20, NULL, 'ฝ่ายสำนักงาน', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(21, NULL, 'ฝ่ายสำนักงานฟาร์ม', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL),
(22, NULL, 'ศูนย์ฝึกสุนัขโชคชัย', '2023-07-04 01:21:44', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `USERNAME` varchar(12) NOT NULL,
  `PASSWORD` text NOT NULL,
  `ARIA` varchar(8) DEFAULT NULL COMMENT 'ประเภทการตั้งระยะเวลา ban,assign	',
  `PROFILE_IMG_PATH` text DEFAULT NULL COMMENT 'ที่อยู่รูปโปรไฟล์',
  `PERIOD_BEGIN` datetime DEFAULT NULL COMMENT 'ระยะเวลาเริ่มต้น',
  `PERIOD_END` datetime DEFAULT NULL COMMENT 'ระยะเวลาสิ้นสุด',
  `DATE_STARTS` datetime NOT NULL DEFAULT current_timestamp(),
  `DATE_UPDATE` datetime DEFAULT NULL,
  `USER_STARTS` int(11) DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `VERIFY` varchar(5) DEFAULT NULL COMMENT 'staff id',
  `STATUS` varchar(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='data users';

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`ID`, `EMPLOYEE_ID`, `USERNAME`, `PASSWORD`, `ARIA`, `PROFILE_IMG_PATH`, `PERIOD_BEGIN`, `PERIOD_END`, `DATE_STARTS`, `DATE_UPDATE`, `USER_STARTS`, `USER_UPDATE`, `VERIFY`, `STATUS`) VALUES
(1, 0, 'madmin', '157e0d1fecf41286b7e09898311c68d9', NULL, NULL, NULL, NULL, '2023-01-31 08:56:02', '2023-01-31 13:04:05', NULL, 1, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `status_alias`
--

CREATE TABLE `status_alias` (
  `ID` int(11) NOT NULL,
  `ORDERS` int(11) DEFAULT NULL,
  `NAME` varchar(25) DEFAULT NULL,
  `NAME_US` varchar(25) DEFAULT NULL,
  `ALIAS` varchar(15) DEFAULT NULL COMMENT 'ประเภทสถานะ',
  `DATE_STARTS` timestamp NOT NULL DEFAULT current_timestamp(),
  `DATE_UPDATE` datetime DEFAULT NULL,
  `USER_STARTS` int(11) DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `STATUS` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='data status system';

--
-- Dumping data for table `status_alias`
--

INSERT INTO `status_alias` (`ID`, `ORDERS`, `NAME`, `NAME_US`, `ALIAS`, `DATE_STARTS`, `DATE_UPDATE`, `USER_STARTS`, `USER_UPDATE`, `STATUS`) VALUES
(1, NULL, 'รอ', 'pending', 'document', '2023-02-06 07:05:17', NULL, 1, NULL, 1),
(2, NULL, 'กำลัง', 'process', 'document', '2023-02-06 07:05:17', NULL, 1, NULL, 1),
(3, NULL, 'สำเร็จ', 'success', 'document', '2023-02-06 07:05:17', NULL, 1, NULL, 1),
(4, NULL, 'ยกเลิก', 'cancel', 'document', '2023-02-06 07:05:17', NULL, 1, NULL, 1),
(5, NULL, 'ลบ', 'delete', 'document', '2023-02-06 07:05:17', NULL, 1, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blank`
--
ALTER TABLE `blank`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_STARTS` (`USER_STARTS`),
  ADD KEY `USER_UPDATE` (`USER_UPDATE`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_UPDATE` (`USER_UPDATE`),
  ADD KEY `USER_STARTS` (`USER_STARTS`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_UPDATE` (`USER_UPDATE`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_UPDATE` (`USER_UPDATE`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `menus` ADD FULLTEXT KEY `CODE` (`CODE`);

--
-- Indexes for table `permit`
--
ALTER TABLE `permit`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MENUS_ID` (`MENUS_ID`);
ALTER TABLE `permit` ADD FULLTEXT KEY `MENUS_CODE` (`MENUS_CODE`);

--
-- Indexes for table `permit_control`
--
ALTER TABLE `permit_control`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `STAFF_ID` (`STAFF_ID`),
  ADD KEY `ROLES_ID` (`ROLES_ID`),
  ADD KEY `PERMIT_ID` (`PERMIT_ID`),
  ADD KEY `USER_STARTS` (`USER_STARTS`),
  ADD KEY `USER_UPDATE` (`USER_UPDATE`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`NAME`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_STARTS` (`USER_STARTS`),
  ADD KEY `USER_UPDATE` (`USER_UPDATE`);

--
-- Indexes for table `roles_control`
--
ALTER TABLE `roles_control`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ROLES_ID` (`ROLES_ID`),
  ADD KEY `PERMIT_ID` (`PERMIT_ID`),
  ADD KEY `ROLES_ID_CHILD` (`ROLES_ID_CHILD`),
  ADD KEY `USER_STARTS` (`USER_STARTS`),
  ADD KEY `USER_UPDATE` (`USER_UPDATE`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_STARTS` (`USER_STARTS`),
  ADD KEY `USER_UPDATE` (`USER_UPDATE`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EMPLOYEE_ID` (`EMPLOYEE_ID`),
  ADD KEY `USER_STARTS` (`USER_STARTS`),
  ADD KEY `USER_UPDATE` (`USER_UPDATE`);

--
-- Indexes for table `status_alias`
--
ALTER TABLE `status_alias`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_STARTS` (`USER_STARTS`),
  ADD KEY `USER_UPDATE` (`USER_UPDATE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blank`
--
ALTER TABLE `blank`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permit`
--
ALTER TABLE `permit`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `permit_control`
--
ALTER TABLE `permit_control`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles_control`
--
ALTER TABLE `roles_control`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status_alias`
--
ALTER TABLE `status_alias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blank`
--
ALTER TABLE `blank`
  ADD CONSTRAINT `blank_ibfk_1` FOREIGN KEY (`USER_STARTS`) REFERENCES `staff` (`ID`),
  ADD CONSTRAINT `blank_ibfk_2` FOREIGN KEY (`USER_UPDATE`) REFERENCES `staff` (`ID`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`USER_STARTS`) REFERENCES `staff` (`ID`),
  ADD CONSTRAINT `department_ibfk_2` FOREIGN KEY (`USER_UPDATE`) REFERENCES `staff` (`ID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`USER_UPDATE`) REFERENCES `staff` (`ID`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`USER_UPDATE`) REFERENCES `staff` (`ID`);

--
-- Constraints for table `permit`
--
ALTER TABLE `permit`
  ADD CONSTRAINT `permit_ibfk_1` FOREIGN KEY (`MENUS_ID`) REFERENCES `menus` (`ID`);

--
-- Constraints for table `permit_control`
--
ALTER TABLE `permit_control`
  ADD CONSTRAINT `permit_control_ibfk_1` FOREIGN KEY (`PERMIT_ID`) REFERENCES `permit` (`ID`),
  ADD CONSTRAINT `permit_control_ibfk_2` FOREIGN KEY (`ROLES_ID`) REFERENCES `roles` (`ID`),
  ADD CONSTRAINT `permit_control_ibfk_3` FOREIGN KEY (`STAFF_ID`) REFERENCES `staff` (`ID`),
  ADD CONSTRAINT `permit_control_ibfk_4` FOREIGN KEY (`USER_STARTS`) REFERENCES `staff` (`ID`),
  ADD CONSTRAINT `permit_control_ibfk_5` FOREIGN KEY (`USER_UPDATE`) REFERENCES `staff` (`ID`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`USER_STARTS`) REFERENCES `staff` (`ID`),
  ADD CONSTRAINT `roles_ibfk_2` FOREIGN KEY (`USER_UPDATE`) REFERENCES `staff` (`ID`);

--
-- Constraints for table `roles_control`
--
ALTER TABLE `roles_control`
  ADD CONSTRAINT `roles_control_ibfk_1` FOREIGN KEY (`PERMIT_ID`) REFERENCES `permit` (`ID`),
  ADD CONSTRAINT `roles_control_ibfk_2` FOREIGN KEY (`ROLES_ID`) REFERENCES `roles` (`ID`),
  ADD CONSTRAINT `roles_control_ibfk_3` FOREIGN KEY (`ROLES_ID_CHILD`) REFERENCES `roles` (`ID`),
  ADD CONSTRAINT `roles_control_ibfk_4` FOREIGN KEY (`USER_STARTS`) REFERENCES `staff` (`ID`),
  ADD CONSTRAINT `roles_control_ibfk_5` FOREIGN KEY (`USER_UPDATE`) REFERENCES `staff` (`ID`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`USER_STARTS`) REFERENCES `staff` (`ID`),
  ADD CONSTRAINT `section_ibfk_2` FOREIGN KEY (`USER_UPDATE`) REFERENCES `staff` (`ID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`USER_STARTS`) REFERENCES `staff` (`ID`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`USER_UPDATE`) REFERENCES `staff` (`ID`),
  ADD CONSTRAINT `staff_ibfk_3` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`ID`);

--
-- Constraints for table `status_alias`
--
ALTER TABLE `status_alias`
  ADD CONSTRAINT `status_alias_ibfk_1` FOREIGN KEY (`USER_STARTS`) REFERENCES `staff` (`ID`),
  ADD CONSTRAINT `status_alias_ibfk_2` FOREIGN KEY (`USER_UPDATE`) REFERENCES `staff` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

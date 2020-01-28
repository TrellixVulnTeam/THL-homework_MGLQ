-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-01-14 17:18:14
-- 服务器版本： 10.4.6-MariaDB
-- PHP 版本： 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `parkinglot_manager`
--

-- --------------------------------------------------------

--
-- 表的结构 `car_owner_info`
--

CREATE TABLE `car_owner_info` (
  `ownerID` int(11) NOT NULL,
  `Owner_name` varchar(45) NOT NULL,
  `car_id` varchar(20) NOT NULL,
  `car_Brand` varchar(45) DEFAULT NULL,
  `car_color` varchar(45) DEFAULT NULL,
  `Owner_tele` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `car_owner_info`
--

INSERT INTO `car_owner_info` (`ownerID`, `Owner_name`, `car_id`, `car_Brand`, `car_color`, `Owner_tele`) VALUES
(3, 'Jack Ma', 'AA001', 'Toyota', 'white', '139757849'),
(32, 'Mai', 'AA022', 'Toyota', 'white', '1397578491'),
(11, 'John', 'AA111', 'FORD', 'white', '13534561112'),
(112, 'Jack', 'AB111', 'FORD', 'white', '13534561134'),
(113, 'Lee', 'AC111', 'FORD', 'white', '13534561123'),
(114, 'Liu', 'AD111', 'Mazda', 'white', '13534561156'),
(115, 'Ma', 'AE111', 'Mazda', 'white', '13534561167'),
(116, 'Li', 'AF111', 'Mazda', 'white', '13534561198'),
(118, 'Wang', 'AG111', 'Mazda', 'white', '13534561125'),
(117, 'Hou', 'AH111', 'Mazda', 'white', '13534561136'),
(110, 'Ao', 'AY111', 'Mazda', 'white', '13534561184'),
(6666, 'xiaotian', 'cv1232', 'bmw', 'dsds', '1234353223'),
(333, 'dsad', 'dsadas', 'dasda', 'dasdas', '43123213'),
(386, 'Yuri', 'ZZ110', 'LAMBO', 'Orange', '15812334450'),
(76, 'Bai', 'ZZ111', 'LAMBO', 'Orange', '15812334451'),
(388, 'Sa', 'ZZ112', 'LAMBO', 'Orange', '15812334452'),
(389, 'He', 'ZZ113', 'LAMBO', 'Orange', '15812334453'),
(380, 'Wei', 'ZZ114', 'LAMBO', 'Orange', '15812334454'),
(381, 'Liu', 'ZZ115', 'LAMBO', 'Orange', '15812334455'),
(382, 'Pu', 'ZZ116', 'LAMBO', 'Orange', '15812334456'),
(383, 'Wang', 'ZZ117', 'LAMBO', 'Orange', '15812334457'),
(384, 'Gui', 'ZZ118', 'LAMBO', 'Orange', '15812334458'),
(385, 'Wu', 'ZZ119', 'LAMBO', 'Orange', '15812334459');

-- --------------------------------------------------------

--
-- 表的结构 `current_parkinglot`
--

CREATE TABLE `current_parkinglot` (
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(45) DEFAULT NULL,
  `car_id` varchar(20) NOT NULL,
  `car_Brand` varchar(45) DEFAULT NULL,
  `car_color` varchar(45) DEFAULT NULL,
  `owner_tele` varchar(45) DEFAULT NULL,
  `position` varchar(20) DEFAULT NULL,
  `in_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `current_parkinglot`
--

INSERT INTO `current_parkinglot` (`owner_id`, `owner_name`, `car_id`, `car_Brand`, `car_color`, `owner_tele`, `position`, `in_time`) VALUES
(11, 'John', 'AA111', 'FORD', 'white', '13534561112', '123', '2020-01-13 20:39:22'),
(112, 'Jack', 'AB111', 'FORD', 'white', '13534561134', '234', '2020-01-13 20:39:34'),
(113, 'Lee', 'AC111', 'FORD', 'white', '13534561123', '154', '2020-01-13 20:39:45'),
(114, 'Liu', 'AD111', 'Mazda', 'white', '13534561156', '168', '2020-01-13 20:39:53'),
(115, 'Ma', 'AE111', 'Mazda', 'white', '13534561167', '195', '2020-01-13 20:40:03'),
(116, 'Li', 'AF111', 'Mazda', 'white', '13534561198', '278', '2020-01-09 11:34:27'),
(118, 'Wang', 'AG111', 'Mazda', 'white', '13534561125', '032', '2020-01-13 20:40:19'),
(119, 'Steven', 'AT111', 'Mazda', 'white', '13534561148', '277', '2020-01-09 11:35:23'),
(76, 'Bai', 'ZZ111', 'LAMBO', 'Orange', '15812334451', '231', '2020-01-11 21:15:36'),
(388, 'Sa', 'ZZ112', 'LAMBO', 'Orange', '15812334452', '115', '2020-01-10 23:04:30'),
(389, 'He', 'ZZ113', 'LAMBO', 'Orange', '15812334453', '014', '2020-01-11 17:04:52'),
(380, 'Wei', 'ZZ114', 'LAMBO', 'Orange', '15812334454', '176', '2020-01-11 21:11:21'),
(381, 'Liu', 'ZZ115', 'LAMBO', 'Orange', '15812334455', '121', '2020-01-11 20:14:21'),
(383, 'Wang', 'ZZ117', 'LAMBO', 'Orange', '15812334457', '111', '2020-01-11 16:25:55');

-- --------------------------------------------------------

--
-- 表的结构 `manager`
--

CREATE TABLE `manager` (
  `id` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `manager`
--

INSERT INTO `manager` (`id`, `password`) VALUES
('AAAAAA1', 'Password'),
('qqq123', '123456'),
('qqq12356', '1234567'),
('qqqq123', '123456'),
('qsxdsb123', '111111'),
('qwer123', '123456'),
('USER123', '123456'),
('USER231', '123456');

-- --------------------------------------------------------

--
-- 表的结构 `parking_history`
--

CREATE TABLE `parking_history` (
  `owner_id` int(11) DEFAULT NULL,
  `owner_name` varchar(45) DEFAULT NULL,
  `car_id` varchar(20) DEFAULT NULL,
  `car_Brand` varchar(45) DEFAULT NULL,
  `car_color` varchar(45) DEFAULT NULL,
  `owner_tele` varchar(45) DEFAULT NULL,
  `position` varchar(20) DEFAULT NULL,
  `in_time` timestamp NULL DEFAULT current_timestamp(),
  `out_time` timestamp NULL DEFAULT current_timestamp(),
  `stamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `parking_history`
--

INSERT INTO `parking_history` (`owner_id`, `owner_name`, `car_id`, `car_Brand`, `car_color`, `owner_tele`, `position`, `in_time`, `out_time`, `stamp`) VALUES
(999, 'Jacky Chen', 'HH999', 'RR', 'RR', '178282817', '111', '2020-01-04 13:43:59', '2020-01-04 13:44:02', 1),
(999, 'Jacky Chen', 'HH999', 'RR', 'RR', '178282817', '111', '2020-01-04 13:44:08', '2020-01-04 13:44:10', 2),
(999, 'Jacky Chen', 'HH999', 'RR', 'RR', '178282817', '111', '2020-01-04 13:44:16', '2020-01-04 13:44:19', 3),
(1, 'Jack Ma', 'AA001', 'Toyota', 'Toyota', '139757899', '002', '2020-01-04 13:40:40', '2020-01-05 10:12:43', 14),
(999, 'Jacky Chen', 'HH999', 'RR', 'RR', '178282817', '134', '2020-01-04 14:59:29', '2020-01-07 17:30:50', 17),
(117, 'Hou', 'AH111', 'Mazda', 'Mazda', '13534561136', '111', '2020-01-09 11:35:13', '2020-01-09 18:17:24', 21),
(879578, 'QSXSWE', 'ACR', 'BICYCLE', 'BICYCLE', '1234667', '231', '2020-01-09 18:29:01', '2020-01-09 18:29:24', 22),
(117, 'Hou', 'AH111', 'Mazda', 'Mazda', '13534561136', '088', '2020-01-09 18:17:48', '2020-01-09 18:46:01', 25),
(110, 'Ao', 'AY111', 'Mazda', 'Mazda', '13534561184', '231', '2020-01-09 11:35:32', '2020-01-09 19:05:55', 26),
(115, 'Ma', 'AE111', 'Mazda', 'Mazda', '13534561167', '012', '2020-01-09 11:34:12', '2020-01-10 09:39:46', 33),
(118, 'Wang', 'AG111', 'Mazda', 'Mazda', '13534561125', '231', '2020-01-09 11:33:56', '2020-01-10 09:39:54', 34),
(114, 'Liu', 'AD111', 'Mazda', 'Mazda', '13534561156', '231', '2020-01-09 11:33:45', '2020-01-10 09:40:17', 35),
(113, 'Lee', 'AC111', 'FORD', 'FORD', '13534561123', '231', '2020-01-09 11:33:35', '2020-01-10 09:40:53', 36),
(11, 'John', 'AA111', 'FORD', 'FORD', '13534561112', '156', '2020-01-09 11:33:01', '2020-01-10 09:46:04', 38),
(77733, 'Obama', 'HH888', 'volks vegen', 'volks vegen', '178651364', '156', '2020-01-08 21:18:13', '2020-01-10 09:48:02', 39),
(76, 'Bai', 'ZZ111', 'LAMBO', 'LAMBO', '15812334451', '123', '2020-01-10 23:03:28', '2020-01-10 23:36:06', 44),
(383, 'Wang', 'ZZ117', 'LAMBO', 'LAMBO', '15812334457', '245', '2020-01-10 23:19:50', '2020-01-11 16:16:10', 47),
(383, 'Wang', 'ZZ117', 'LAMBO', 'LAMBO', '15812334457', '111', '2020-01-11 16:19:10', '2020-01-11 16:22:50', 48);

--
-- 转储表的索引
--

--
-- 表的索引 `car_owner_info`
--
ALTER TABLE `car_owner_info`
  ADD UNIQUE KEY `car_id_UNIQUE` (`car_id`);

--
-- 表的索引 `current_parkinglot`
--
ALTER TABLE `current_parkinglot`
  ADD PRIMARY KEY (`car_id`),
  ADD UNIQUE KEY `position` (`position`);

--
-- 表的索引 `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `parking_history`
--
ALTER TABLE `parking_history`
  ADD PRIMARY KEY (`stamp`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `parking_history`
--
ALTER TABLE `parking_history`
  MODIFY `stamp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

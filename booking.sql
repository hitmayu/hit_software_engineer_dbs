-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 12 月 21 日 23:43
-- 服务器版本: 5.5.34
-- PHP 版本: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `booking`
--

-- --------------------------------------------------------

--
-- 表的结构 `booking_log`
--

CREATE TABLE IF NOT EXISTS `booking_log` (
  `status` enum('agreed','coming','done','canceled') NOT NULL DEFAULT 'agreed',
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `sid` int(10) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `plan_id` int(10) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `booking_log`
--

INSERT INTO `booking_log` (`status`, `log_id`, `sid`, `time_from`, `time_to`, `plan_id`) VALUES
('agreed', 1, 28, '19:00:00', '20:00:00', 23);

-- --------------------------------------------------------

--
-- 表的结构 `booking_plan`
--

CREATE TABLE IF NOT EXISTS `booking_plan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tid` int(10) NOT NULL,
  `date` date NOT NULL,
  `max_num` int(11) NOT NULL DEFAULT '1',
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `type` enum('asked','free') NOT NULL DEFAULT 'free',
  `location` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `data` (`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- 转存表中的数据 `booking_plan`
--

INSERT INTO `booking_plan` (`id`, `tid`, `date`, `max_num`, `time_from`, `time_to`, `type`, `location`, `note`) VALUES
(17, 22, '2013-12-21', 48, '16:30:00', '20:00:00', 'asked', '风格沙发噶发', '二维个为人父'),
(21, 26, '2013-12-11', 1, '17:45:00', '19:45:00', 'free', '', ''),
(22, 26, '2013-12-19', 1, '18:00:00', '20:15:00', 'free', '', '软件工程答疑开始啦！'),
(23, 26, '2013-12-20', 5, '18:30:00', '20:45:00', 'free', '', '今天只接受2班答疑！'),
(24, 26, '2013-12-21', 1, '19:00:00', '21:00:00', 'asked', '', '需要确认哦！'),
(25, 26, '2013-12-26', 1, '18:00:00', '20:00:00', 'free', '', '将来的事将来再说！'),
(26, 32, '2013-12-19', 2, '17:15:00', '19:30:00', 'free', '', '今天是个好日子'),
(27, 33, '2013-12-19', 2, '18:00:00', '19:45:00', 'free', '', '第一次答疑！'),
(28, 33, '2013-12-20', 40, '18:15:00', '20:30:00', 'asked', '', '第二次答疑！'),
(30, 35, '2013-12-22', 4, '18:00:00', '20:30:00', 'free', '', '第一次答疑！'),
(31, 35, '2013-12-23', 40, '17:00:00', '20:00:00', 'asked', '正心楼', '第二次答疑！');

-- --------------------------------------------------------

--
-- 表的结构 `defaults`
--

CREATE TABLE IF NOT EXISTS `defaults` (
  `tid` int(10) NOT NULL,
  `type` enum('free','asked') NOT NULL DEFAULT 'free',
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `display_time_from` tinyint(4) NOT NULL DEFAULT '0',
  `display_time_to` tinyint(4) NOT NULL DEFAULT '68',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `sid` int(10) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `college` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `specialty` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `realname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`sid`, `phone`, `college`, `specialty`, `realname`) VALUES
(1, '18246049342', '11', '11', '马鱼'),
(2, '18246049342', '计算机', '计算机', '马与'),
(3, '18246049342', '11', '11', '34'),
(4, '18246049342', '11', '11', '11111'),
(5, '18246049342', '11 ', '11', '11111'),
(6, '18246049342', '11 ', '11', '11111'),
(7, '18246049342', '11', '11', '123'),
(8, '18246049342', '11', '11', '11'),
(9, '18246049342', '44', '44', '11111666'),
(11, '18246049342', '1', '1', '1111155'),
(12, '18246049342', '1', '1', '33'),
(13, '18246049342', '1', '1', '333'),
(14, '18246049342', '11', '1', '1'),
(15, '18246049342', '11', '11', '11'),
(16, '18246049342', '11', '1', '11'),
(17, '18246032107', '11', '11', '466'),
(19, '18246032107', '计算机', '计算机', '李靖宇'),
(21, '18345153181', '22', '11', '63443'),
(23, '18246049521', '计院', '计科', '马钰'),
(24, '11', '22', '22', '11'),
(27, '18246032109', '计算机学院', '计算机', '陈波波'),
(28, '18246049342', '计算机学院', '计算机', '马钰'),
(31, '13624617320', '计算机学院', '计算机', '李靖宇'),
(34, '18246032109', '计算机学院', '计算机', '俞琳琳'),
(36, '18246032109', '计算机学院', '计算机', '陈波宇');

-- --------------------------------------------------------

--
-- 表的结构 `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `tid` int(10) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `college` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `realname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `job` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `teacher`
--

INSERT INTO `teacher` (`tid`, `phone`, `college`, `location`, `realname`, `job`) VALUES
(21, '111', '11', '4555', 'mayu', '11'),
(22, '18246049521', '计科', '学院楼', '陈波宇', '助教'),
(25, '22', '11', '11', '11', '11'),
(26, '18246032109', '计算机学院', '综合楼', '王忠杰', '教授'),
(29, '13624617320', '计算机学院', '综合楼', '战德臣', '教授'),
(32, '13624617320', '计算机', '综合楼', '李志军', '教授'),
(33, '13624617320', '计算机学院', '综合楼', '刘晓燕', '教授'),
(35, '13624617320', '计算机学院', '综合楼', '史先俊', '教授');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `usertype` enum('teacher','student') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `passwd`, `usertype`) VALUES
(1, '222333', '11', 'teacher'),
(2, '马与', '123', 'student'),
(3, '11111', '11', 'student'),
(4, '22', '22', 'student'),
(5, '1122', '11', 'student'),
(6, '222', '222', 'student'),
(7, '1133', '11', 'student'),
(8, '1144', '11', 'student'),
(9, '1155', '1155', 'student'),
(10, '1177', '11', 'teacher'),
(11, '1188', '11', 'student'),
(12, '3344', '33', 'student'),
(13, '55', '11', 'student'),
(14, '1199', '11', 'student'),
(15, '4455', '11', 'student'),
(16, '111666', '11', 'student'),
(17, '99', '99', 'student'),
(18, 'bobo', '11', 'student'),
(19, '7788', '11', 'student'),
(21, '9988', '11', 'student'),
(22, 'ozp', '121', 'teacher'),
(23, 'ozzzp', '121', 'student'),
(24, '11144', '11', 'student'),
(25, '22233', '11', 'teacher'),
(26, 'wangzhongjie', '1122', 'teacher'),
(27, 'chenbobo', '11', 'student'),
(28, 'mayu', '1122', 'student'),
(29, 'zhandechen', '1122', 'teacher'),
(30, 'lijingyu', '1122', 'student'),
(31, '李靖宇', '1122', 'student'),
(32, 'lizhijun', '1122', 'teacher'),
(33, 'liuxiaoyan', '1122', 'teacher'),
(34, 'yulinlin', '1122', 'student'),
(35, 'shixianjun', '1122', 'teacher'),
(36, 'chenboyu', '1122', 'student');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

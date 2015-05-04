-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2015 年 05 月 04 日 11:48
-- 伺服器版本: 5.5.42-1
-- PHP 版本： 5.6.7-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `lotto`
--

-- --------------------------------------------------------

--
-- 資料表結構 `game`
--

CREATE TABLE IF NOT EXISTS `game` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `num1` int(11) NOT NULL,
  `num2` int(11) NOT NULL,
  `num3` int(11) NOT NULL,
  `num4` int(11) NOT NULL,
  `num5` int(11) NOT NULL,
  `num6` int(11) NOT NULL,
  `num7` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `game`
--

INSERT INTO `game` (`id`, `date`, `num1`, `num2`, `num3`, `num4`, `num5`, `num6`, `num7`) VALUES
(1, '2015-04-30', 22, 23, 38, 8, 44, 45, 19),
(2, '2015-05-01', 0, 0, 0, 0, 0, 0, 0),
(3, '2015-05-02', 0, 0, 0, 0, 0, 0, 0),
(4, '2015-05-03', 0, 0, 0, 0, 0, 0, 0),
(5, '2015-05-04', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `number1` int(11) NOT NULL,
  `number2` int(11) NOT NULL,
  `number3` int(11) NOT NULL,
  `number4` int(11) NOT NULL,
  `number5` int(11) NOT NULL,
  `number6` int(11) NOT NULL,
  `number7` int(11) NOT NULL,
  `result` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `orders`
--

INSERT INTO `orders` (`id`, `gameid`, `number1`, `number2`, `number3`, `number4`, `number5`, `number6`, `number7`, `result`) VALUES
(1, 1, 2, 3, 5, 8, 4, 6, 7, 5),
(2, 1, 32, 45, 44, 20, 16, 11, 19, 3),
(3, 1, 22, 23, 45, 29, 28, 16, 14, 4),
(4, 2, 33, 39, 38, 7, 45, 11, 2, 0),
(5, 2, 7, 10, 3, 4, 19, 13, 17, 0),
(6, 2, 14, 15, 44, 33, 43, 23, 20, 0);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `game`
--
ALTER TABLE `game`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`), ADD KEY `gameid` (`gameid`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `game`
--
ALTER TABLE `game`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- 使用資料表 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`gameid`) REFERENCES `game` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

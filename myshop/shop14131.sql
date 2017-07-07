-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-06-18 04:01:38
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop14131`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `adminID` smallint(5) UNSIGNED NOT NULL,
  `admin` varchar(20) NOT NULL,
  `pwd` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`adminID`, `admin`, `pwd`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `ID` int(10) UNSIGNED NOT NULL,
  `merID` smallint(5) UNSIGNED DEFAULT NULL,
  `user` varchar(20) NOT NULL,
  `count` smallint(6) NOT NULL,
  `createTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `cateID` smallint(5) UNSIGNED NOT NULL,
  `category` varchar(30) NOT NULL,
  `parentID` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`cateID`, `category`, `parentID`) VALUES
(1, '球队', 0),
(2, '湖人队', 1),
(3, '马刺队', 1),
(4, '年份', 0),
(5, '1995', 4),
(6, '1993', 4),
(8, '退役球衣', 0),
(9, '乔丹退役球衣', 8),
(10, '骑士队', 1),
(11, '勇士队', 1),
(12, '快船队', 1),
(13, '雷霆队', 1),
(14, '火箭队', 1),
(23, '爵士队', 1),
(25, '雄鹿队', 1),
(26, '太阳队', 1),
(27, '国王队', 1),
(28, '76人队', 1),
(29, '凯尔特人队', 1),
(30, '森林狼队', 1),
(31, '奇才队', 1),
(32, '小牛队', 1),
(33, '球星球衣', 0),
(34, '乔丹', 33),
(35, '科比', 33),
(36, '詹姆斯', 33),
(37, '艾佛森', 33),
(38, '麦迪', 33),
(39, '姚明', 33),
(40, '库里', 33),
(41, '邓肯', 33),
(42, '韦德', 33),
(43, '哈登', 33),
(44, '保罗.乔治', 33),
(45, '莱昂那德', 33),
(46, '全明星球衣', 0),
(47, '2001年西部全明星', 46),
(48, '2001年东部全明星', 46),
(49, '2017年西部全明星', 46),
(50, '2017年东部全明星', 46),
(51, '姚明退役球衣', 8),
(52, '奥尼尔退役球衣', 8),
(53, '1998', 4),
(54, '1999', 4),
(55, '2017', 4);

-- --------------------------------------------------------

--
-- 表的结构 `merchandise`
--

CREATE TABLE `merchandise` (
  `merID` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL COMMENT '球衣名称',
  `team` varchar(20) NOT NULL COMMENT '球衣所属队伍',
  `price` decimal(7,2) UNSIGNED NOT NULL,
  `discount` decimal(3,2) UNSIGNED NOT NULL,
  `cover` varchar(50) DEFAULT NULL COMMENT '商品图片的URL',
  `year` varchar(20) NOT NULL COMMENT '球衣被使用的年份',
  `type` varchar(20) NOT NULL COMMENT '球衣的款式',
  `introduction` varchar(300) DEFAULT NULL COMMENT '球衣简介',
  `inventory` smallint(5) UNSIGNED NOT NULL COMMENT '库存'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `merchandise`
--

INSERT INTO `merchandise` (`merID`, `name`, `team`, `price`, `discount`, `cover`, `year`, `type`, `introduction`, `inventory`) VALUES
(1, '湖人队科比24号球衣', '湖人队', '299.00', '0.89', 'images/merchandise/2017061005062747.jpg', '2007', 'v型领背心', '湖人队巨星科比经典的24号球衣，材质为纯棉，颜色有紫色，白色，黄色。', 1000),
(3, '最新骑士队詹姆斯23号球衣', '骑士队', '349.00', '0.78', 'images/merchandise/2017061006060084.jpg', '2016', 'V领短袖型', '骑士队詹姆斯2016夺冠球衣，纯棉材质，最新短袖设计，轻薄吸汗，目前只有黑色款式。', 1000),
(6, '公牛队乔丹经典球衣', '公牛队', '439.00', '0.85', 'images/merchandise/2017061105064759.jpg', '1993', '圆领背心', '经典的乔丹红色公牛战袍，圆领背心，混合材质，轻薄吸汗，宽松舒适。', 1000),
(7, '火箭队麦迪1号球衣', '火箭队', '299.00', '0.88', 'images/merchandise/2017061105068338.jpg', '2007', 'V领背心', '火箭队麦迪1号球衣,V领背心,混合材质，轻薄吸汗，宽松舒适，麦迪35秒13分神迹战袍。', 1000),
(8, '火箭队中国赛12号球衣', '火箭队', '399.00', '0.95', 'images/merchandise/2017061105063271.jpg', '2017', 'V领短袖型', '火箭队中国赛纪念版12号球衣,V领短袖型,混合材质，轻薄吸汗，宽松舒适。', 999),
(9, '火箭队哈登13号复古版球衣', '火箭队', '259.00', '0.89', 'images/merchandise/2017061105062355.jpg', '2017', 'V领背心', '火箭队哈登13号复古版球衣,V领背心,混合材质，轻薄吸汗，宽松舒适，火箭队核心领袖哈登的复古战袍。', 999),
(10, '火箭队姚明11号球衣', '火箭队', '459.00', '0.87', 'images/merchandise/2017061105069109.jpg', '2008', '圆领背心', '火箭队姚明11号球衣，圆领背心，混合材质，轻薄吸汗，宽松舒适，小巨人姚明经典战袍。', 999),
(11, '马刺队邓肯21号最新球衣', '马刺队', '399.00', '0.88', 'images/merchandise/2017061105066322.jpg', '2017', 'V领背心', '马刺队邓肯21号最新球衣，V领背心，混合材质，轻薄吸汗，宽松舒适，石佛邓肯的灰色战袍。', 1000),
(12, '小牛队诺维茨基41号球衣', '小牛队', '389.00', '0.78', 'images/merchandise/2017061105069422.jpg', '2010', 'V领背心', '小牛队诺维茨基41号球衣，V领背心，混合材质，轻薄吸汗，宽松舒适，德国战车的经典战袍。', 999),
(13, '凯尔特人加内特5号经典球衣', '凯尔特人', '299.00', '0.98', 'images/merchandise/2017061105062172.jpg', '2008', '圆领背心', '凯尔特人加内特5号经典球衣，圆领背心，混合材质，轻薄吸汗，宽松舒适，老狼王的凯尔特人冠军球衣。', 998),
(14, '76人队传奇巨星艾佛森3号球衣', '76人', '599.00', '0.87', 'images/merchandise/2017061105069948.jpg', '2001', 'V领背心', '76人队传奇巨星艾佛森3号球衣，V领背心，混合材质，轻薄吸汗，宽松舒适，传奇巨星答案的3号战袍。', 1000),
(15, '雷霆队杜兰特最新款深蓝35号球衣', '雷霆队', '359.00', '0.77', 'images/merchandise/2017061105061196.jpg', '2015', '圆领背心', '雷霆队杜兰特最新款深蓝35号球衣，圆领背心，混合材质，轻薄吸汗，宽松舒适，雷霆当家巨星杜兰特的35号战袍。', 1000),
(16, '快船队保罗3号球衣', '快船队', '399.00', '0.89', 'images/merchandise/2017061105067781.jpg', '2015', 'V领背心', '快船队保罗3号球衣,V领背心,混合材质，轻薄吸汗，宽松舒适，快船队核心人物保罗的3号战袍。', 1000),
(17, '勇士队库里30号最新球衣', '勇士队', '399.00', '0.78', 'images/merchandise/2017061111062400.jpg', '2017', 'V领背心', '勇士队库里30号最新球衣，V领背心，混合材质，轻薄吸汗，宽松舒适，库里主场白色战袍。', 999),
(18, '马刺队邓肯21号最新球衣', '马刺队', '344.00', '0.90', 'images/merchandise/2017061312064098.jpg', '2014', 'V领背心', '马刺队邓肯21号最新球衣，V领背心，混合材质，轻薄吸汗，宽松舒适，石佛邓肯的灰色战袍。', 991),
(19, '湖人队科比24号球衣', '湖人队', '455.00', '0.89', 'images/merchandise/2017061305066653.jpg', '2011', 'V领背心', '湖人队巨星科比经典的24号球衣，材质为纯棉，颜色有紫色，白色，黄色。', 997);

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `orderID` int(10) UNSIGNED NOT NULL,
  `userID` smallint(5) UNSIGNED NOT NULL,
  `address` varchar(40) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `deliverMode` varchar(25) NOT NULL,
  `paymentMode` varchar(25) NOT NULL,
  `createTime` datetime NOT NULL,
  `orderState` varchar(10) NOT NULL DEFAULT '待审核'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `suborders`
--

CREATE TABLE `suborders` (
  `suborderID` int(10) UNSIGNED NOT NULL,
  `merID` smallint(6) NOT NULL,
  `count` smallint(6) NOT NULL,
  `orderID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `userID` smallint(5) UNSIGNED NOT NULL,
  `user` varchar(20) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `phone` char(11) NOT NULL,
  `address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `merID` (`merID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cateID`);

--
-- Indexes for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD PRIMARY KEY (`merID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `suborders`
--
ALTER TABLE `suborders`
  ADD PRIMARY KEY (`suborderID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `cateID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- 使用表AUTO_INCREMENT `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `merID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `suborders`
--
ALTER TABLE `suborders`
  MODIFY `suborderID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `userID` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 限制导出的表
--

--
-- 限制表 `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`merID`) REFERENCES `merchandise` (`merID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `suborders`
--
ALTER TABLE `suborders`
  ADD CONSTRAINT `suborders_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

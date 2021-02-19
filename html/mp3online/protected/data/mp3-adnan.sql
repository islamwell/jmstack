-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2016 at 04:57 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mp3-adnan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL COMMENT '1: admin 0:customer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'syed77adnan', '21232f297a57a5a743894a0e4a801fc3', 1),
(3, 'nqadminas', '21232f297a57a5a743894a0e4a801fc3', 1),
(4, 'nqadminis', '21232f297a57a5a743894a0e4a801fc3', 1),
(5, 'nqadminsj', '21232f297a57a5a743894a0e4a801fc3', 1),
(6, 'nqadminsn', '21232f297a57a5a743894a0e4a801fc3', 1),
(7, 'nqadminrk', '21232f297a57a5a743894a0e4a801fc3', 1),
(8, 'nqadminaap1', '21232f297a57a5a743894a0e4a801fc3', 1),
(9, 'nqadminapp2', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(255) DEFAULT NULL,
  `album_img` text,
  `category_id` int(11) DEFAULT NULL COMMENT 'FOREIGN KEY (category_id)REFERENCES category(category_id)',
  `number_song` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `order_number` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `album_name`, `album_img`, `category_id`, `number_song`, `create_date`, `order_number`, `status`) VALUES
(12, 'Naats', '1463629795.jpg', NULL, NULL, NULL, 1, 1),
(15, 'test scroll', '1434657389123456987.jpg', NULL, NULL, NULL, 0, 1),
(16, 'Faith', '1463630933.jpg', NULL, NULL, NULL, 0, 1),
(17, 'Day of Judgment', '1463132623.jpg', NULL, NULL, NULL, 0, 1),
(18, 'DuraQuran 2014 Series', '1463133968.jpg', NULL, NULL, NULL, 99, 1),
(19, 'Mishary Rashid Alafasy', '1463148044.png', NULL, NULL, NULL, 0, 1),
(20, 'Protection from Evil', '1463208467.jpg', NULL, NULL, NULL, 0, 1),
(21, 'test 18 mai', '1463581844.jpg', NULL, NULL, NULL, 0, 1),
(22, 'ISLAH UL QULOOB', '1463644461.png', NULL, NULL, NULL, 0, 1),
(23, 'ISLAMIC MONTHS', '1463644504.png', NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(255) NOT NULL,
  `author_img` text,
  `profile` text,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_name`, `author_img`, `profile`, `status`) VALUES
(1, 'Rodrigo Cadiz ', '1432180643download (1).jpg', ' Rodrigo Cadiz is an American singer, songwriter, actress, and businesswoman. She achieved popularity by pushing the boundaries of lyrical content in mainstream popular music and imagery in her music videos, ', 1),
(2, 'Linkin Park', '1415758506f47fe8534f68254cc04d91e75d595e53_1332585127.jpg', 'LINKIN PARK will be headlining Summerfest in Milwaukee, WI on June 30, 2015.    LP Underground pre-sale begins on November 19 at 10 am CST. Stay tuned for more pre-sale info.   Tickets go on-sale to the public November 21st at 12pm CST. ', 0),
(3, 'Diana Burrell', '1433476347download (7).jpg', 'American singer, songwriter, and actress. Born and raised on Long Island, New York, Carey came to prominence after releasing her self-titled debut studio album Mariah Carey in 1990; it went multiplatinum', 1),
(4, 'Michael Jackson', '1415758698a7f3d5a06940bf15e6b44a788fee7123_1341065342.jpg', 'Michael Joseph Jackson[2][3] (August 29, 1958 – June 25, 2009) was an American singer, songwriter, dancer, and actor. Called the King of Pop,[4][5] his contributions to music and dance, along with his publicized personal life, made him a global figure in ', 0),
(6, 'Christiane Eiben', '', '', 1),
(7, 'Eminem', '1415758836a0538a67982e1ef3e3bd2922cb6dd9ce_1383013435.jpg', 'Marshall Bruce Mathers III (born October 17, 1972),[1] better known by his stage name Eminem and by his alter ego Slim Shady, is an American rapper, record producer, songwriter, and actor. In addition to his solo career, Eminem is a member of the group D1', 0),
(8, 'Sample composer', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `content`, `image`, `url`, `type`, `status`) VALUES
(2, 'youtube', '<p>https://www.youtube.com/</p>\r\n', '1463636321.png', 'http://islamWEll.com', 0, 1),
(3, 'What use is the title?', '<p>http://mp3.zing.vn/</p>\r\n', '1463636247.png', 'NRQ.no', 0, 1),
(4, 'ProjecTemplate', '<p>http://projectemplate.com/</p>\r\n', '1461730007.png', 'http://projectemplate.com/', 0, 1),
(5, 'bis', '', '1462445040.png', 'http://nurulquran.com/', 0, 1),
(6, 'Remainder Calendar 2016', NULL, '1463209115.jpg', 'http://www.nq-international.com/education/nurulquran-calendar-2016', 0, 1),
(8, 'Mixlr', NULL, '1464069074.jpg', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_img` text,
  `parentId` int(11) DEFAULT '0',
  `status` int(1) DEFAULT NULL,
  `level` int(11) DEFAULT '0',
  `order_number` int(11) DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_img`, `parentId`, `status`, `level`, `order_number`) VALUES
(2, 'No one worthy of worship except Allah', '1463131653.png', 0, 1, 1, 0),
(3, 'Parents', '1463133725.jpg', 13, 1, 2, 1),
(13, 'Quran - القرآن الكريم', '1433595214quran.jpg', 0, 1, 1, 0),
(14, 'cat2', '', 13, 1, 2, 0),
(31, 'Family', '1463630705.jpg', 0, 1, 1, 0),
(32, 'qirat', '1462223312.jpg', 31, 1, 2, 0),
(33, 'main - hvoed', '1462443570.jpg', 0, 1, 1, 0),
(34, 'sub 1', '1462443609.jpg', 33, 1, 2, 0),
(35, 'sub 2 ', '1462443669.jpg', 34, 1, 3, 0),
(36, 'sub 3', '1462443732.jpg', 35, 1, 4, 0),
(37, 'sub 3.1', '1462443814.jpg', 35, 1, 4, 0),
(38, 'sub4', NULL, 36, 1, 5, 0),
(39, 'Qari', '1463148809.jpg', 0, 1, 1, 0),
(40, 'Hani ar-Rifai sub 1', '1463148962.jpg', 39, 1, 2, 0),
(41, 'Surah An-Nasr sub 2', '1463149074.png', 40, 1, 3, 0),
(42, 'sub 3', '1463149138.jpg', 41, 1, 4, 0),
(43, 'sub 4', '1463149610.jpg', 42, 1, 5, 0),
(44, 'DQ', '1463196597.png', 0, 1, 1, 0),
(45, 'Dawrah e Quran', '1463206708.jpg', 0, 1, 1, 0),
(46, 'sub 4 - test', '1463233961.png', 42, 1, 5, 1),
(47, 'Surah Mulk ', NULL, 0, 1, 1, 0),
(48, 'cat test 18 mai', '1463582633.jpg', 0, 1, 1, 0),
(49, 'category test', '1463626803.jpeg', 48, 1, 2, 0),
(50, 'category sub2', '1463626895.jpeg', 49, 1, 3, 0),
(51, 'category sub3', '1463626938.png', 49, 1, 3, 0),
(52, 'Surahs', '1463631181.jpg', 0, 1, 1, 0),
(53, 'AL QURAN', '1463644266.png', 0, 1, 1, 0),
(54, 'SEERAH', '1463644293.png', 0, 1, 1, 0),
(55, 'ISLAMIC MONTHS', '1463644323.png', 0, 1, 1, 0),
(56, 'test 19 mai', '1463690939.jpg', 0, 1, 1, 0),
(57, '19 mai sub 1', '1463691008.png', 56, 1, 2, 0),
(58, '19 mai sub 2', '1463691068.jpg', 57, 1, 3, 0),
(59, '19 mai sub 3', '1463691104.png', 58, 1, 4, 0),
(60, '19 mai sub 4', '1463691143.png', 59, 1, 5, 0),
(61, 'Prophets', '1464035683.jpg', 0, 1, 1, 0),
(62, 'Moses', NULL, 61, 1, 2, 0),
(63, 'ISLAMIC MONTHS', '1463895595.png', 0, 1, 1, 0),
(64, 'Muharram', '1463895731.png', 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gcm_id` varchar(255) DEFAULT NULL,
  `ime` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `gcm_id`, `ime`, `type`, `status`, `dateCreated`) VALUES
(2, '9d4ab5d4dfe6422774fbad3bd27ac93c8f57c044a9222c6072e0fb2806fcd2d2', '9d4ab5d4dfe6422774fbad3bd27ac93c8f57c044a9222c6072e0fb2806fcd2d2', 2, 1, '2016-04-26 15:54:52'),
(3, 'eY-KVEad-n4:APA91bGHBCl5Aw_VWO5QNcx18tyoQLXYEv9GQUVjymZG9GMpRYNrC1YFBaB7qC3UYX0hygL-tfWcKeqObVPq9mLwgkTDuv7SyoiDOndORFAGbSaEFmye8B1ajiUSi_BQAb8pVf2Fp_pM', '357865051525413', 1, 1, '2016-04-26 16:38:34'),
(4, 'dguXp8_lp8o:APA91bHZpuVkoWQ37mrmxyn7JvGaUHe9l45WNh4CNz2tvZCTdgkNnJ64V9QIYMkYqIrLqcmwLqv750uzbyt27wUxk5FJje6vFsvjoYgDCaCcvkT81xy8-HM-965DzN9k49rLCE44vlCU', '351904051342317', 1, 1, '2016-04-27 15:02:28'),
(5, 'cmJxhPyQw3Y:APA91bGfaqe-aB9f0IPo6SRwU03BJqzigNA3-hcSJWkbhv3-1nDaPtlgToZpZonMe9pCZH6AtyAF8BtOdAUVIn1Nn5E6Em4j0J6OEJl5bKOI9EXKOkndpD_83L0pIi9vyPRvTNEm9e89', '355677064659804', 1, 1, '2016-04-28 14:51:24'),
(6, '0424cf6fa481e147de41b1bd375e7bac76cde7c3dde64d8d2748847961a5533c', '0424cf6fa481e147de41b1bd375e7bac76cde7c3dde64d8d2748847961a5533c', 2, 1, '2016-05-09 16:14:52'),
(7, 'cPlZQYoxAOY:APA91bHn0a_1Gdr5Huy4vBalYKYNYOjtCrRCuGk7VoVwLfffxdqtPJoSyLW06YkKYxWSkAUFYSrXW79kNcqe-rpTHTx7jq3VRlfjGjBL20N2PRRKh0WgwLfbj4-QgRm2xlmiMs7EpjiG', '359844061506588', 1, 1, '2016-05-09 16:58:56'),
(8, 'fU1P5WTYqS4:APA91bFc5I9CpT7e7GiyozATJpgbZzjX8TX5mQgLpLEdSOWofYmlolEm0J2wU2PG-akuSRFbqwJxOZi7Bap4T0qhALdWHtb3g4zLBOAJWXMrcPCRaf3rA5TcfYA8DQSxGURv96z560Tc', '359871041937021', 1, 1, '2016-05-09 17:13:58'),
(9, '20ccee8b651c8e64183612e8868ded65797d200dda749c2263b64037b8a90fab', '20ccee8b651c8e64183612e8868ded65797d200dda749c2263b64037b8a90fab', 2, 1, '2016-05-11 13:43:57'),
(10, 'dMs6L_zfurs:APA91bHKpufuEONiCT891OqzEAb1za-bmEfx0N4_VckBy05TAMLhc_7OKKKiPIYxYHkiFjWzxqWFWe2doV4yxrotMC0pyaeYfuHjIJmg8LA6OEolXsjcVo353khvbCvuG47Fa5LAdDQ2', '353967070014181', 1, 1, '2016-05-11 18:29:55'),
(11, 'af2269ae36b737599f01d425668161ba292dc776ebe73e997a3a2aa08a2a94ce', 'af2269ae36b737599f01d425668161ba292dc776ebe73e997a3a2aa08a2a94ce', 2, 1, '2016-05-12 14:46:34'),
(12, 'ea73f086ffb5e2f3932e550cd728ef98021822f05a967ec683bfd71313df39b5', 'ea73f086ffb5e2f3932e550cd728ef98021822f05a967ec683bfd71313df39b5', 2, 1, '2016-05-13 08:17:40'),
(13, 'c623eb6559e31b64ccd6dfd5207652fc545a01d537c868068291f0aa7e93ef3d', 'c623eb6559e31b64ccd6dfd5207652fc545a01d537c868068291f0aa7e93ef3d', 2, 1, '2016-05-13 09:45:59'),
(14, '4849a4cbfc65b7109ac2de89c7d4bb518c7cae01f4a8d203571ea90461280810', '4849a4cbfc65b7109ac2de89c7d4bb518c7cae01f4a8d203571ea90461280810', 2, 1, '2016-05-13 09:55:26'),
(15, '2f6d78a16ba64cfe5378aa01854cf0f1e42987c0bf8b0811063483e4ee035d26', '2f6d78a16ba64cfe5378aa01854cf0f1e42987c0bf8b0811063483e4ee035d26', 2, 1, '2016-05-13 09:58:38'),
(16, '913355c65649d1eec48ce3bd595947115219de6ad566d03b40fb308fe1f5c593', '913355c65649d1eec48ce3bd595947115219de6ad566d03b40fb308fe1f5c593', 2, 1, '2016-05-13 10:04:21'),
(17, '45e34f76f61658f3f50b04b5298d6f73d2825bd0c8b81e7896bd8e969e98904f', '45e34f76f61658f3f50b04b5298d6f73d2825bd0c8b81e7896bd8e969e98904f', 2, 1, '2016-05-13 14:34:58'),
(18, '7e9105b3d59c0c26e1a722392bcb565b09b66a56521822bb34a500339e27af71', '7e9105b3d59c0c26e1a722392bcb565b09b66a56521822bb34a500339e27af71', 2, 1, '2016-05-13 15:13:08'),
(19, '92e32101df8848a9f84e64db31517b887e4f152231c01e84119b79f5a9592245', '92e32101df8848a9f84e64db31517b887e4f152231c01e84119b79f5a9592245', 2, 1, '2016-05-13 16:32:39'),
(20, '5f6ffd84987742e6d9b617e89adb8f5f6fbc2c16ea4880aeb82f6e02f6a798d2', '5f6ffd84987742e6d9b617e89adb8f5f6fbc2c16ea4880aeb82f6e02f6a798d2', 2, 1, '2016-05-16 08:09:49'),
(21, '949149a2ed65cda7ef3095448180701351826a756a77788117f62c628a03bf73', '949149a2ed65cda7ef3095448180701351826a756a77788117f62c628a03bf73', 2, 1, '2016-05-16 08:27:49'),
(22, 'e8311379d341cadb4be34256fcc00bd449cdac6e75e8fd46108e8c5b70ffa03a', 'e8311379d341cadb4be34256fcc00bd449cdac6e75e8fd46108e8c5b70ffa03a', 2, 1, '2016-05-16 09:07:54'),
(23, 'a5a473cffd4b3b87dd16107d67a211ec3eba4aa21c7c682a903c1baae4f1f266', 'a5a473cffd4b3b87dd16107d67a211ec3eba4aa21c7c682a903c1baae4f1f266', 2, 1, '2016-05-16 09:33:14'),
(24, '5c61c9032e9d0df8fb41bddbe22181142fd638babbcfcbe05f6f3893f3624308', '5c61c9032e9d0df8fb41bddbe22181142fd638babbcfcbe05f6f3893f3624308', 2, 1, '2016-05-16 09:37:14'),
(25, 'af1293f282d82ec44569df7743397861e292f41496fd02f71e59fc3847c54ea9', 'af1293f282d82ec44569df7743397861e292f41496fd02f71e59fc3847c54ea9', 2, 1, '2016-05-16 09:49:05'),
(26, '237e128f92a4a6ffe32fdc47c9717e956817d8708eaedf6131499538eefbbcea', '237e128f92a4a6ffe32fdc47c9717e956817d8708eaedf6131499538eefbbcea', 2, 1, '2016-05-16 09:55:10'),
(27, '6a0cf836047f45fc0bb4ce3e9126cbe85bc36dc371e4766b55796ce3242c5d4b', '6a0cf836047f45fc0bb4ce3e9126cbe85bc36dc371e4766b55796ce3242c5d4b', 2, 1, '2016-05-16 09:56:55'),
(28, 'c040f99440287c08ab2b5d8f10f4110f2c8ccc24a54b682777b2c8ce08bc4ace', 'c040f99440287c08ab2b5d8f10f4110f2c8ccc24a54b682777b2c8ce08bc4ace', 2, 1, '2016-05-16 10:24:46'),
(29, '92cd7b5c87333ed28df92b77dbd124cfc3956ee108aa1a4a76de7c47a28fd0fb', '92cd7b5c87333ed28df92b77dbd124cfc3956ee108aa1a4a76de7c47a28fd0fb', 2, 1, '2016-05-16 14:46:03'),
(30, '071f12ee072989facbd4ff3845c70dc93d2a0fad40d77fdb4da68c1983019dae', '071f12ee072989facbd4ff3845c70dc93d2a0fad40d77fdb4da68c1983019dae', 2, 1, '2016-05-16 17:29:09'),
(31, '2931fb866c57c279cf209230ff64627bc39a388df28ca6c7a75c1b52a3203993', '2931fb866c57c279cf209230ff64627bc39a388df28ca6c7a75c1b52a3203993', 2, 1, '2016-05-17 15:59:28'),
(32, 'e2b9c797b76264010be48ade3b152a987642c62573fb7c43d8cd32e2e8474c36', 'e2b9c797b76264010be48ade3b152a987642c62573fb7c43d8cd32e2e8474c36', 2, 1, '2016-05-18 10:49:38'),
(33, 'd7c3b06306d6221be5d1949b8be68d08cc45c13653a075be7202fff403da9f16', 'd7c3b06306d6221be5d1949b8be68d08cc45c13653a075be7202fff403da9f16', 2, 1, '2016-05-18 14:04:00'),
(34, '7f79b4c87c27f281773bac14cb427bf15650f1a2ed0bdd6f3935cd79ac83fd24', '7f79b4c87c27f281773bac14cb427bf15650f1a2ed0bdd6f3935cd79ac83fd24', 2, 1, '2016-05-18 14:08:42'),
(35, '37a97b21e637cf443f97e59c1cf12f73d8f1a33f009a050bb62af37e0922f7f9', '37a97b21e637cf443f97e59c1cf12f73d8f1a33f009a050bb62af37e0922f7f9', 2, 1, '2016-05-18 14:12:39'),
(36, 'd09d7e246b4f0807ba0d3bba51710268a64857f7c375f625e6b285f8cc1f8647', 'd09d7e246b4f0807ba0d3bba51710268a64857f7c375f625e6b285f8cc1f8647', 2, 1, '2016-05-18 14:51:21'),
(37, '910667b76f02e52ea3234f661b3693dcd6943839c7625df349e9bc54a138ea4d', '910667b76f02e52ea3234f661b3693dcd6943839c7625df349e9bc54a138ea4d', 2, 1, '2016-05-20 16:18:16'),
(38, '46c063ba008fbe3dcdbbbc2d14d273cdc23766f96b8c819576aaf3daa66ccb15', '46c063ba008fbe3dcdbbbc2d14d273cdc23766f96b8c819576aaf3daa66ccb15', 2, 1, '2016-05-20 16:19:35'),
(39, '565b31f510865d0b48a20354ff1f72aa2d4ce37c4fe9adc39bed46628373578f', '565b31f510865d0b48a20354ff1f72aa2d4ce37c4fe9adc39bed46628373578f', 2, 1, '2016-05-20 16:53:50'),
(40, '59400b0b7f01cb78eb42300e2a6ccc431522a1008aa2f5389db617eac10918f0', '59400b0b7f01cb78eb42300e2a6ccc431522a1008aa2f5389db617eac10918f0', 2, 1, '2016-05-20 17:38:08'),
(41, 'c411f62d8a4be897f39669a442cb1b1c9bd01865e41749b26c343ecc638cd9e3', 'c411f62d8a4be897f39669a442cb1b1c9bd01865e41749b26c343ecc638cd9e3', 2, 1, '2016-05-23 08:33:10'),
(42, '8256ffe160ce14bbc43704a14119ea27009440db53449ff1f1770ee355afb6fc', '8256ffe160ce14bbc43704a14119ea27009440db53449ff1f1770ee355afb6fc', 2, 1, '2016-05-23 08:34:37'),
(43, '8d22e55925f053781c0366555f608a9c20eba5e26ce6ff6833b27ba5c743eb94', '8d22e55925f053781c0366555f608a9c20eba5e26ce6ff6833b27ba5c743eb94', 2, 1, '2016-05-23 09:03:54'),
(44, 'cdKk9GN9VDM:APA91bGWXERZaTcQsWLYIKGmfLAAbBCpgr3-6NrFwGwgIyRu6vrd9OhqvUzC50HpnRw_xsMSiPwjy4YqKvGQYF_R6UCUwNNTYat3Xt1fTJzNp42AxVwmy2zfm0tGEszD8VH75IyOZUvd', '355782052668112', 1, 1, '2016-05-23 09:13:26'),
(45, 'd8f40dce3125d55ebd99822cf75379f54177c1e6ed8b907c539cc94bc37ba463', 'd8f40dce3125d55ebd99822cf75379f54177c1e6ed8b907c539cc94bc37ba463', 2, 1, '2016-05-23 11:43:41'),
(46, '516265ad6a332a3fcf135d835d8701df02c84431d82502fbbdbf9296bec12826', '516265ad6a332a3fcf135d835d8701df02c84431d82502fbbdbf9296bec12826', 2, 1, '2016-05-23 14:03:43'),
(47, 'bc6f1c43d6ab8f89957f72814d56ac7d3804db3179fc5e6ec6d261e0ce4dc72d', 'bc6f1c43d6ab8f89957f72814d56ac7d3804db3179fc5e6ec6d261e0ce4dc72d', 2, 1, '2016-05-23 15:30:32'),
(48, 'bc6f1c43d6ab8f89957f72814d56ac7d3804db3179fc5e6ec6d261e0ce4dc72d', 'bc6f1c43d6ab8f89957f72814d56ac7d3804db3179fc5e6ec6d261e0ce4dc72d', 2, 1, '2016-05-23 15:30:32'),
(49, '83cac999aac36dc3f9d9c0ce080446eae35d866187b067ce0997949b279e5c1d', '83cac999aac36dc3f9d9c0ce080446eae35d866187b067ce0997949b279e5c1d', 2, 1, '2016-05-23 16:08:01'),
(50, '299622338e7f08d8389c672530bbbc87431be229213fa37ba76f0eb10a852bfd', '299622338e7f08d8389c672530bbbc87431be229213fa37ba76f0eb10a852bfd', 2, 1, '2016-05-24 08:26:35'),
(51, 'fe717f55128499abfd9a0cfa26890709cddc4eb068cd29a7469caaf74bdf95bf', 'fe717f55128499abfd9a0cfa26890709cddc4eb068cd29a7469caaf74bdf95bf', 2, 1, '2016-05-24 09:22:03'),
(52, '61e7ed8d15d0328896b21e7157946a16b3004c047c5c85d8015fd4139bc869e6', '61e7ed8d15d0328896b21e7157946a16b3004c047c5c85d8015fd4139bc869e6', 2, 1, '2016-05-24 15:47:43'),
(53, 'chIKOTleaNs:APA91bErYIm9TINkGktzmw1m-o5NGYUYJaimaz8NzpkmHxShaNhwQw5k-fONFi3gz6joCSrDECKBoMu1EW_bKmvkDMPoHi3mfD56ZP84dl4zoz3YVGEetdlSPSZCtf2MuMOblqq0mLAx', '359492061275836', 1, 1, '2016-05-24 18:23:07'),
(54, 'a754cf060e88966919cade6a3f6b2f438eecd074bf31a2b5b8805c15b681c45f', 'a754cf060e88966919cade6a3f6b2f438eecd074bf31a2b5b8805c15b681c45f', 2, 1, '2016-05-25 09:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `radio`
--

CREATE TABLE IF NOT EXISTS `radio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `mixlr` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `radio`
--

INSERT INTO `radio` (`id`, `name`, `link`, `mixlr`, `type`, `status`) VALUES
(1, 'Radio', 'http://sunehreharoof.com/stream/urdu/nq.m3u', 'http://mixlr.com/nqlive/', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metaKey` varchar(255) DEFAULT NULL,
  `metaValue` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `metaKey`, `metaValue`) VALUES
(1, 'MAIL_SEND_GRID', 'immrhy@gmail.com'),
(2, 'GOOGLE_API_KEY', 'AIzaSyCXb-7uIMI32EMW5YR9rCHSwHj7RUDkz28'),
(3, 'PEM_FILE', '1463450923.pem');

-- --------------------------------------------------------

--
-- Table structure for table `singer`
--

CREATE TABLE IF NOT EXISTS `singer` (
  `singer_id` int(11) NOT NULL AUTO_INCREMENT,
  `singer_name` varchar(255) NOT NULL,
  `singer_img` text,
  `profile` text,
  `order_number` int(11) DEFAULT '0',
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`singer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `singer`
--

INSERT INTO `singer` (`singer_id`, `singer_name`, `singer_img`, `profile`, `order_number`, `status`) VALUES
(2, 'Mariah Carey', '14157599275e9228a226baf71430428de40b220cc3_1400574169.jpg', 'Mariah Carey (born March 27, 1969 or 1970)[3] is an American singer, songwriter, and actress. Born and raised on Long Island, New York, Carey came to prominence after releasing her self-titled debut studio album Mariah Carey in 1990; it went multiplatinum', 4, NULL),
(3, 'Celine Dion', '1415760097a8e9e45eedda280e4214fd74b54dcef1_1383627207.gif', 'Céline Marie Claudette Dion, CC OQ ChLD (/ˈdiːɒn/;[5] French: [selin djɔ̃] ( listen); born 30 March 1968) is a Canadian singer. Born into a large family from Charlemagne, Quebec,[6] Dion emerged as a teen star in the French-speaking world after her manage', 3, 1),
(4, 'Rihanna', '1415760175220px-Rihanna_2012_(Cropped).jpg', 'Robyn Rihanna Fenty (born February 20, 1988), better known by her stage name Rihanna (/riˈænə/ ree-AN-ə),[3][4] is a Barbadian singer, actress, and fashion designer. Born in Saint Michael, Barbados, her career began upon meeting record producer Evan Roger', 2, 0),
(5, 'Eminem', '1415760267a0538a67982e1ef3e3bd2922cb6dd9ce_1383013435.jpg', 'Marshall Bruce Mathers III (born October 17, 1972),[1] better known by his stage name Eminem and by his alter ego Slim Shady, is an American rapper, record producer, songwriter, and actor. In addition to his solo career, Eminem is a member of the group D1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE IF NOT EXISTS `song` (
  `song_id` int(11) NOT NULL AUTO_INCREMENT,
  `stt` int(11) DEFAULT NULL,
  `song_name` varchar(255) NOT NULL,
  `description` text,
  `lyrics` text,
  `link` text,
  `singer_id` int(11) DEFAULT NULL COMMENT 'FOREIGN KEY (singer_id)REFERENCES singer(singer_id)',
  `listen` int(11) DEFAULT '0',
  `album_id` int(11) DEFAULT NULL COMMENT 'FOREIGN KEY (album_id)REFERENCES album(album_id)',
  `create_date` date DEFAULT NULL,
  `download` int(11) DEFAULT '0',
  `hot` tinyint(4) DEFAULT NULL,
  `new` tinyint(4) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `link_app` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `isTopsong` int(11) DEFAULT '0',
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `isTop` int(11) DEFAULT NULL,
  `order_number` int(11) DEFAULT '0',
  `modified` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`song_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 ROW_FORMAT=COMPACT AUTO_INCREMENT=135 ;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`song_id`, `stt`, `song_name`, `description`, `lyrics`, `link`, `singer_id`, `listen`, `album_id`, `create_date`, `download`, `hot`, `new`, `status`, `link_app`, `image`, `isTopsong`, `author_id`, `category_id`, `isTop`, `order_number`, `modified`) VALUES
(20, NULL, 'AlRahman', NULL, NULL, '143359534258.mp3', NULL, 171, NULL, NULL, 80, NULL, NULL, 1, NULL, '143359534279.jpg', 1, NULL, 13, NULL, 0, NULL),
(21, NULL, 'Test Upload Song 10 MB', NULL, NULL, '143361893733.mp3', NULL, 187, NULL, NULL, 422, NULL, NULL, 1, NULL, '', 1, NULL, 13, NULL, 0, NULL),
(30, NULL, 'Surah 114', '<p>det er en test for surah 114</p>\r\n', NULL, '146244405717.mp3', NULL, 74, NULL, NULL, 17, NULL, NULL, 1, NULL, '146244405772.jpg', 0, NULL, 36, NULL, 0, NULL),
(39, NULL, 'Chuyện như chưa bắt đầu', '', NULL, '146310732633.mp3', NULL, 10, 15, NULL, 8, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(44, NULL, 'Anh', '<p>HQH</p>\r\n', NULL, '146310793980.mp3', NULL, 14, 15, NULL, 7, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(45, NULL, 'dasds', '<p>dsadsa</p>\r\n', NULL, '146310801244.mp3', NULL, 0, NULL, NULL, 5, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(46, NULL, 'xZXZ', '<p>case</p>\r\n', NULL, '14631081635.mp3', NULL, 3, NULL, NULL, 3, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(47, NULL, 'dsadsaff', '<p>defqfef</p>\r\n', NULL, '14631083371.mp3', NULL, 2, NULL, NULL, 7, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(48, NULL, 'dsa', '<p>das</p>\r\n', NULL, '146310898961.mp3', NULL, 1, NULL, NULL, 4, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(49, NULL, 'fads', '<p>fed</p>\r\n', NULL, '146311067234.mp3', NULL, 0, NULL, NULL, 2, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(50, NULL, 'dasddsadasdsa', '<p>dead</p>\r\n', NULL, '146313191555.mp3', NULL, 4, NULL, NULL, 6, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(51, NULL, '11111', '<p>1111</p>\r\n', NULL, '146313196840.mp3', NULL, 5, NULL, NULL, 3, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(52, NULL, 'dasdasasdasdsad', '<p>dasds</p>\r\n', NULL, '146313206542.mp3', NULL, 11, NULL, NULL, 4, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(53, NULL, 'asaxxcx', '<p>asas</p>\r\n', NULL, '146313216432.mp3', NULL, 11, NULL, NULL, 4, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(54, NULL, 'Al-Fatiha', '<p>Mishary bin Rashid</p>\r\n', NULL, '146314822060.mp3', NULL, 15, 19, NULL, 0, NULL, NULL, 1, NULL, '146314822027.png', 0, NULL, 0, NULL, 1, NULL),
(55, NULL, 'Surah An-Nasr', '<p>Mishary bin Rashid</p>\r\n', NULL, '146314828189.mp3', NULL, 9, 19, NULL, 1, NULL, NULL, 1, NULL, '146314828124.png', 0, NULL, 0, NULL, 110, NULL),
(56, NULL, 'Surah An-Nas', '<p>Mishary bin Rashid</p>\r\n', NULL, '146314839442.mp3', NULL, 10, 19, NULL, 0, NULL, NULL, 1, NULL, '146314839483.png', 0, NULL, 0, NULL, 114, NULL),
(57, NULL, 'An-Nasr', '<p>test sub 2</p>\r\n', NULL, '146314926380.mp3', NULL, 92, NULL, NULL, 12, NULL, NULL, 1, NULL, '14631492630.jpg', 1, NULL, 42, NULL, 0, NULL),
(58, NULL, 'Time management resized 1', '', NULL, '146319340977.mp3', NULL, 21, NULL, NULL, 5, NULL, NULL, 1, NULL, '146319340969.png', 1, NULL, 0, NULL, 0, NULL),
(59, NULL, 'dq 15 original', '', NULL, '146319677850.mp3', NULL, 33, NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, 0, NULL, 44, NULL, 0, NULL),
(60, NULL, 'link audio test', '', NULL, 'http://nurulquran.com/Audios/Books/FainniQareeb/FIQ_Dua01.mp3', NULL, 19, NULL, NULL, 2, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(65, NULL, 'Ayat Ul Kursi - Shytaan say Panah', '<p>Shytaan Mardood say Panah&nbsp;</p>\r\n', NULL, '14632087061.mp3', NULL, 114, 20, NULL, 12, NULL, NULL, 1, NULL, '146320870639.jpg', 1, NULL, 0, NULL, 0, NULL),
(86, NULL, 'Large Bold Font', '<p>Bismillah - Smaller font different Color</p>\r\n', NULL, '146363446073.mp3', NULL, 45, 21, NULL, 0, NULL, NULL, 1, NULL, '146363446022.png', 0, NULL, 36, NULL, 0, NULL),
(104, NULL, 'Series Nasheed 1', '<p>Remember the blessings of Allah - My Master is enough for me.</p>\r\n', NULL, '146363051379.mp3', NULL, 12, 12, NULL, 6, NULL, NULL, 1, NULL, '146363051394.jpg', 1, NULL, 10, NULL, 0, NULL),
(108, NULL, 'test file 18 mai', '<p>det er en test som fortok den 18 mai</p>\r\n', NULL, '146358202352.mp3', NULL, 4, 21, NULL, 0, NULL, NULL, 1, NULL, '146358202366.jpg', 1, NULL, 0, NULL, 1, NULL),
(109, NULL, 'test file 18 mai', '<p>test fullf&oslash;rt 18 mai</p>\r\n', NULL, '146358254674.mp3', NULL, 4, 21, NULL, 1, NULL, NULL, 1, NULL, '146358254616.jpg', 1, NULL, 0, NULL, 1, NULL),
(110, NULL, 'Surah Mulk ', '', NULL, '146358275539.mp3', NULL, 16, 15, NULL, 2, NULL, NULL, 1, NULL, '146358275517.jpg', 0, NULL, 47, NULL, 0, NULL),
(111, NULL, 'Time management resized 2', '', NULL, '146362593697.mp3', NULL, 1, NULL, NULL, 0, NULL, NULL, 1, NULL, '14636259363.png', 0, NULL, 2, NULL, 0, NULL),
(112, NULL, 'Time management resized 3', '<p>The time managment series is resized please download</p>\r\n', NULL, '146362656853.mp3', NULL, 0, NULL, NULL, 0, NULL, NULL, 1, NULL, '146362656816.png', 0, NULL, 2, NULL, 2, NULL),
(113, NULL, 'test sub cat', '', NULL, '14636272726.mp3', NULL, 9, 21, NULL, 1, NULL, NULL, 1, NULL, '146362727287.jpg', 0, NULL, 51, NULL, 0, NULL),
(114, NULL, 'Surah al-Mursalat - Nouman Ali Khan', '<p>Opening of&nbsp;Surah al-Mursalat - Nouman Ali Khan</p>\r\n\r\n<p><span class="marker">English</span></p>\r\n', NULL, '146363180577.mp3', NULL, 10, 21, NULL, 0, NULL, NULL, 1, NULL, '14636318056.jpg', 0, NULL, 52, NULL, 0, NULL),
(115, NULL, 'Ramadan', '<p>The Month of Hope Fear &amp; Mercy&nbsp;</p>\r\n', NULL, '14636447414.mp3', NULL, 13, 23, NULL, 9, NULL, NULL, 1, NULL, '146364474182.png', 1, NULL, 55, NULL, 0, NULL),
(116, NULL, 'SJ Para 1 Lesson 1 Translation', '<p>SJ-P1-L1-Trans</p>\r\n', NULL, 'http://nurulquran.com/Audios/QuranTafseer/SabeelUlJannah/Para-01/Lesson1/SJ-L1-Trans%26wordanalysis(a).mp3', NULL, 9, NULL, NULL, 1, NULL, NULL, 1, NULL, '146364528384.png', 1, NULL, 53, NULL, 0, NULL),
(117, NULL, 'SJ Para 1 Lesson 1 Tafseer (A) ', '<p>SJ-P1-L1-Taf-A</p>\r\n', NULL, 'http://nurulquran.com/Audios/QuranTafseer/SabeelUlJannah/Para-01/Lesson1/SJ-L1-Taf(a).mp3', NULL, 9, NULL, NULL, 3, NULL, NULL, 1, NULL, '146364551476.gif', 1, NULL, 53, NULL, 0, NULL),
(118, NULL, 'Ramadan Naikiyoon ka Mausam e Bahaar ', '<p>دعرمغنمنرمونن ورنمرومن ومرن نرومن ورمن رنو ورمنورن&nbsp;</p>\r\n', NULL, 'http://nurulquran.com/Audios/AssortedLectures/IslamicMonths/Ramadan/ramadan%20nyku%20ka%20mausam%20bhar.mp3', NULL, 9, NULL, NULL, 4, NULL, NULL, 1, NULL, NULL, 1, NULL, 55, NULL, 0, NULL),
(119, NULL, '14 Doors of Heart ', '', NULL, 'http://nurulquran.com/Audios/AssortedLectures/DawahTrip2008/14DoorsofHeart-Dars.mp3', NULL, 5, 22, NULL, 1, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(120, NULL, '14 Doors of Heart ', '<p>cxzcxzvxzcvxczv</p>\r\n', NULL, 'http://nurulquran.com/Audios/AssortedLectures/DawahTrip2008/14DoorsofHeart-Dars.mp3', NULL, 4, 22, NULL, 3, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, 0, NULL),
(121, NULL, 'surah 43 - 33MB', '<p>test surah size 33 mb</p>\r\n', NULL, '146366388428.mp3', NULL, 3, 21, NULL, 4, NULL, NULL, 1, NULL, '146366388452.png', 1, NULL, 0, NULL, 0, NULL),
(131, NULL, 'fgdgkhfkfk', '<p>tjđjgdjgdj</p>\r\n', NULL, '146397055450.mp3', NULL, 5, 15, NULL, 10, NULL, NULL, 1, NULL, '146397055470.jpg', 1, NULL, 0, NULL, 0, NULL),
(132, NULL, 'fgdgkhfkfk', '<p>tjđjgdjgdj</p>\r\n', NULL, '146397165025.mp3', NULL, 5, 15, NULL, 24, NULL, NULL, 1, NULL, '146397165010.jpg', 1, NULL, 0, NULL, 0, NULL),
(133, NULL, 'Betrayal', '', NULL, '146407903918.mp3', NULL, 8, 22, NULL, 14, NULL, NULL, 1, NULL, '146407903968.jpg', 0, NULL, 0, NULL, 0, NULL),
(134, NULL, 'An-Nasr', '', NULL, NULL, NULL, 1, NULL, NULL, 2, NULL, NULL, 1, NULL, NULL, 1, NULL, 43, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `translattions`
--

CREATE TABLE IF NOT EXISTS `translattions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `attribute` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `translattions`
--

INSERT INTO `translattions` (`id`, `table_name`, `model_id`, `attribute`, `lang`, `value`) VALUES
(22, 'song', 2, 'song_name', 'vi', ''),
(23, 'song', 2, 'lyrics', 'vi', ''),
(34, 'author', 3, 'author_name', 'vi', ''),
(35, 'author', 3, 'profile', 'vi', 'ca sĩ người Mỹ, nhạc sĩ, và nữ diễn viên. Sinh ra và lớn lên ở Long Island, New York, Carey đã mang đến nổi bật sau khi phát hành album đầu tay mang tên mình Mariah Carey vào năm 1990; '),
(42, 'song', 11, 'song_name', 'vi', ''),
(43, 'album', 8, 'album_name', 'vi', ''),
(47, 'album', 11, 'album_name', 'vi', ''),
(49, 'category', 16, 'category_name', 'vi', ''),
(50, 'category', 5, 'category_name', 'vi', ''),
(51, 'album', 12, 'album_name', 'vi', ''),
(53, 'singer', 5, 'singer_name', 'vi', ''),
(54, 'singer', 4, 'singer_name', 'vi', ''),
(55, 'singer', 3, 'singer_name', 'vi', ''),
(56, 'singer', 2, 'singer_name', 'vi', ''),
(57, 'album', 1, 'album_name', 'vi', ''),
(58, 'album', 2, 'album_name', 'vi', ''),
(59, 'album', 3, 'album_name', 'vi', ''),
(60, 'album', 4, 'album_name', 'vi', ''),
(61, 'album', 5, 'album_name', 'vi', ''),
(62, 'album', 7, 'album_name', 'vi', ''),
(63, 'album', 9, 'album_name', 'vi', ''),
(64, 'song', 7, 'song_name', 'vi', ''),
(65, 'song', 8, 'song_name', 'vi', ''),
(66, 'category', 3, 'category_name', 'vi', ''),
(67, 'album', 13, 'album_name', 'vi', ''),
(70, 'album', 15, 'album_name', 'vi', ''),
(71, 'album', 16, 'album_name', 'vi', ''),
(72, 'category', 18, 'category_name', 'vi', ''),
(74, 'song', 14, 'song_name', 'vi', ''),
(75, 'song', 13, 'song_name', 'vi', ''),
(76, 'song', 9, 'song_name', 'vi', ''),
(77, 'song', 1, 'song_name', 'vi', ''),
(78, 'category', 14, 'category_name', 'vi', ''),
(79, 'song', 15, 'song_name', 'vi', ''),
(80, 'song', 6, 'song_name', 'vi', ''),
(81, 'category', 2, 'category_name', 'vi', ''),
(82, 'song', 22, 'song_name', 'vi', ''),
(83, 'category', 19, 'category_name', 'vi', ''),
(84, 'category', 20, 'category_name', 'vi', ''),
(85, 'category', 21, 'category_name', 'vi', ''),
(86, 'category', 22, 'category_name', 'vi', ''),
(87, 'category', 23, 'category_name', 'vi', ''),
(88, 'category', 24, 'category_name', 'vi', ''),
(89, 'category', 25, 'category_name', 'vi', ''),
(93, 'category', 29, 'category_name', 'vi', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Трв 29 2015 р., 14:03
-- Версія сервера: 5.1.73
-- Версія PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `project`
--

-- --------------------------------------------------------

--
-- Структура таблиці `form_data_table`
--

CREATE TABLE IF NOT EXISTS `form_data_table` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `eMail` varchar(255) CHARACTER SET utf8 NOT NULL,
  `homePage` varchar(255) CHARACTER SET utf8 NOT NULL,
  `message` varchar(255) CHARACTER SET utf8 NOT NULL,
  `fileName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8 NOT NULL,
  `browser` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dataStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Дамп даних таблиці `form_data_table`
--

INSERT INTO `form_data_table` (`id`, `userName`, `eMail`, `homePage`, `message`, `fileName`, `ip`, `browser`, `dataStamp`) VALUES
(1, 'Anton', 'zvarych.anton@gmail.com', '', 'Yep-yep!', '546c9617104600f62d61d47f543ae746.jpg', '10.185.209.57', 'Firefox', '2015-05-29 14:02:13');

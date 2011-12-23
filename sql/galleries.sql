-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 28 Paź 2011, 23:07
-- Wersja serwera: 5.1.41
-- Wersja PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `namurzyn_deltus`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(3) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Zrzut danych tabeli `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `label`, `description`, `status`, `created`, `modified`, `title`, `content`) VALUES
(1, 'Opel Signum_gallery', '', '', 0, '2011-10-06 10:12:21', '0000-00-00 00:00:00', '', ''),
(2, 'audi_a3_gallery', '', '', 0, '2011-10-06 13:33:24', '2011-10-26 20:54:49', '', ''),
(3, 'Audi A3_gallery', '', '', 0, '2011-10-06 16:12:34', '0000-00-00 00:00:00', '', ''),
(4, 'Duzo itemow_gallery', '', '', 0, '2011-10-06 16:13:13', '0000-00-00 00:00:00', '', ''),
(5, 'honda_n200_gallery', '', '', 0, '2011-10-06 16:39:25', '2011-10-28 23:06:20', '', ''),
(6, 'alfa_romeo_spark_gallery', '', '', 0, '2011-10-21 08:23:34', '0000-00-00 00:00:00', '', ''),
(7, 'Nowa oferta_gallery', '', '', 0, '2011-10-28 20:21:23', '2011-10-28 20:21:23', '', ''),
(8, 'Nowa oferta_gallery', '', '', 0, '2011-10-28 20:23:34', '2011-10-28 20:23:34', '', ''),
(9, 'Audi A3_gallery', '', '', 0, '2011-10-28 20:23:49', '2011-10-28 20:23:49', '', ''),
(10, 'Opel Signum 2_gallery', '', '', 0, '2011-10-28 20:27:21', '2011-10-28 20:27:21', '', ''),
(11, 'Opel Signum_gallery', '', '', 0, '2011-10-28 20:41:40', '2011-10-28 20:41:40', '', ''),
(12, 'Opel Signum_gallery', '', '', 0, '2011-10-28 20:42:39', '2011-10-28 20:42:39', '', ''),
(13, 'Audi A3_gallery', '', '', 0, '2011-10-28 21:44:03', '2011-10-28 21:44:03', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

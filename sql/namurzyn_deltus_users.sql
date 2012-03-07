-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 07 Mar 2012, 12:50
-- Wersja serwera: 5.1.41
-- Wersja PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `namurzyn_deltus_users`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `ci_sessions`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `divisions`
--

CREATE TABLE IF NOT EXISTS `divisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `permissions` text NOT NULL,
  `configurations` text NOT NULL,
  `contents` text NOT NULL,
  `widgets` text NOT NULL,
  `layout` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `divisions`
--

INSERT INTO `divisions` (`id`, `url`, `permissions`, `configurations`, `contents`, `widgets`, `layout`, `name`, `label`, `description`, `status`) VALUES
(4, 'panel-administracyjny', '', '', 'backend/backend/index->-|&checkers[check_full_access_special:t,t;]->lang[english]->box[CONTENT:0]->loading_order[0]|-|', 'start/start/index->-|&checkers[check_full_access_special:t,t;]->lang[english]->box[SIDEBAR:0]->loading_order[0]|-|start/start/index->-|&checkers[check_full_access_special:t,t;]->lang[english]->box[MENU:0]->loading_order[0]|-|', 'admin_theme/admin_theme/index->parametr1-|parametr2-|&', 'panel-administracyjny', 'panel-administracyjny', 'panel-administracyjny', 1),
(5, 'samochody-z-niemiec', '', ';', 'frontend/frontend/index->-|&checkers[check_full_access_special:t,t;]->lang[english]->box[CONTENT:0]->loading_order[0]|-|', 'start/start/index->-|&checkers[check_full_access_special:t,t;]->lang[english]->box[SIDEBAR:0]->loading_order[0]|-|start/start/index->-|&checkers[check_full_access_special:t,t;]->lang[english]->box[MENU:0]->loading_order[0]|-|', 'pati_theme/pati_theme/index->parametr1-|parametr2-|&', 'frontend auto-pati', 'frontend auto-pati', 'samochody-z-niemiec', 1),
(6, 'test', 's:CONTENT.START.START.SDO,n:null=a(s:check_full_access=>b:false);s:CONTENT.START.START.SDO,n:null=a(s:check_full_access=>b:false);\r\ns:MODULE.ROLE.CONTENT.EDIT,n:null=a(s:check_full_access=>b:true);', 'index_single=s#data from division - single index;index1,index2=i#4;type_float,index2=f#4.1;second_index,first_index=s#from division two dimension;test_config_index=s#from division single index;deltus_language=s#english;', 'lab/lab/index->-|&checkers[check_full_access_special:t,t;]->lang[english]->box[CONTENT:0]->loading_order[1]|-|', 'start/start/index->-|&checkers[check_full_access_special:t,t;]->lang[english]->box[SIDEBAR:0]->loading_order[0]|-|start/start/index->-|&checkers[check_full_access_special:t,t;]->lang[english]->box[MENU:0]->loading_order[0]|-|role/role_w/filter->-|&checkers[check_full_access_special:t,t;]->lang[english]->box[WIDGET:0]->loading_order[2]|-|', 'lab_theme/lab_theme/index->parametr1-|parametr2-|&', 'test name', 'test label', 'test description', 1),
(7, 'ttp', '', '', '', '', 'ttp_theme/ttp_theme/index->parametr1-|parametr2-|&', 'ttp name', 'ttp label', 'ttp', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `foos`
--

CREATE TABLE IF NOT EXISTS `foos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `foos`
--

INSERT INTO `foos` (`id`, `name`) VALUES
(1, 'Wacław'),
(2, 'Hildegarda');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `label`, `description`, `status`, `created`, `modified`, `title`, `content`) VALUES
(1, 'test_gallery', '', '', 0, '2011-11-15 07:35:17', '2011-11-15 07:35:17', '', ''),
(3, 'offer_gallery', '', '', 0, '2011-11-15 07:42:32', '2011-11-22 21:53:27', '', ''),
(4, 'Opel Vectra GTS_gallery', '', '', 0, '2011-11-15 07:54:02', '2011-11-22 21:54:09', '', ''),
(5, 'Strona Kontakt_gallery', '', '', 0, '2011-11-15 08:41:35', '2011-11-15 08:41:35', '', ''),
(6, 'Strona O firmie_gallery', '', '', 0, '2011-11-15 08:43:06', '2011-11-15 08:43:06', '', ''),
(7, 'Oferta Auto-pati.pl_gallery', '', '', 0, '2011-11-15 08:44:08', '2011-11-15 08:44:08', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `galleries_pages`
--

CREATE TABLE IF NOT EXISTS `galleries_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallerydm_id` int(11) NOT NULL,
  `pagedm_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `galleries_pages`
--

INSERT INTO `galleries_pages` (`id`, `gallerydm_id`, `pagedm_id`) VALUES
(2, 5, 2),
(3, 6, 3),
(4, 7, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `galleries_simpleoffers`
--

CREATE TABLE IF NOT EXISTS `galleries_simpleoffers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallerydm_id` int(11) NOT NULL,
  `simpleofferdm_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `galleries_simpleoffers`
--

INSERT INTO `galleries_simpleoffers` (`id`, `gallerydm_id`, `simpleofferdm_id`) VALUES
(1, 3, 1),
(2, 4, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `login_attempts`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `pagecategories`
--

CREATE TABLE IF NOT EXISTS `pagecategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL DEFAULT '#',
  `status` tinyint(5) NOT NULL DEFAULT '1',
  `family_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `islast` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`link`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `pagecategories`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `pagecategories_pages`
--

CREATE TABLE IF NOT EXISTS `pagecategories_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagedm_id` int(11) NOT NULL,
  `pagecategorydm_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `pagecategories_pages`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(3) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `pages`
--

INSERT INTO `pages` (`id`, `name`, `label`, `link`, `description`, `content`, `status`, `created`, `modified`) VALUES
(2, 'Strona Kontakt', 'Kontakt', 'kontakt', '', '<h2>Śr&oacute;dtytuł</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>', 1, '2011-11-15 08:41:35', '2011-11-15 09:15:04'),
(3, 'Strona O firmie', 'O Firmie ', 'o-firmie', 'O Firmie', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>', 1, '2011-11-15 08:43:06', '2011-11-15 09:02:13'),
(4, 'Oferta Auto-pati.pl', 'Oferta', 'oferta', 'Oferta Auto-pati.pl', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>', 1, '2011-11-15 08:44:08', '2011-11-15 09:03:12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `include` tinyint(3) NOT NULL DEFAULT '1' COMMENT 'Opisuje sposób agregacji uzytkownikaów -  czy grupa włącza (1) czy wyłącza (0) użytkowników',
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Przechowuje grupy uzytkowników' AUTO_INCREMENT=27 ;

--
-- Zrzut danych tabeli `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `include`, `status`, `created`, `modified`) VALUES
(2, 'editor', 'description for editor', 1, 1, '0000-00-00 00:00:00', '2011-12-28 23:28:14'),
(12, 'administrator', '', 1, 1, '2011-12-28 23:39:58', '2011-12-28 23:40:02'),
(14, 'user_blog', 'user_blog', 1, 0, '2011-12-29 01:28:49', '2011-12-29 01:28:49'),
(15, 'role1', 'role1', 1, 0, '2011-12-30 01:46:25', '2011-12-30 01:46:25'),
(22, 'role2', 'role2_d', 1, 1, '2012-01-26 19:31:49', '2012-01-26 19:31:49'),
(23, 'role3', 'role3_d', 1, 1, '2012-01-26 19:33:18', '2012-01-26 19:33:18'),
(24, 'role4', 'role4_d', 1, 1, '2012-01-26 19:33:27', '2012-01-26 19:33:27'),
(25, 'kozik', 'kozik opsi', 1, 1, '2012-03-06 13:13:48', '2012-03-06 13:13:48'),
(26, 'filip', 'filip', 1, 1, '2012-03-06 13:14:01', '2012-03-06 13:14:01');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `roles_users`
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userdm_id` int(11) NOT NULL,
  `roledm_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Zrzut danych tabeli `roles_users`
--

INSERT INTO `roles_users` (`id`, `userdm_id`, `roledm_id`) VALUES
(3, 1, 12),
(7, 5, 12),
(23, 2, 12),
(25, 4, 12),
(27, 10, 12),
(29, 15, 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `simpleoffers`
--

CREATE TABLE IF NOT EXISTS `simpleoffers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(3) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `extra_table` varchar(255) DEFAULT NULL,
  `so_model` varchar(255) NOT NULL,
  `so_color` varchar(255) NOT NULL,
  `so_capacity` int(11) NOT NULL,
  `so_registered` varchar(255) NOT NULL,
  `so_production` int(11) NOT NULL,
  `so_power` int(11) NOT NULL,
  `so_price` float NOT NULL,
  `so_engine` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `simpleoffers`
--

INSERT INTO `simpleoffers` (`id`, `name`, `label`, `link`, `description`, `content`, `status`, `created`, `modified`, `extra_table`, `so_model`, `so_color`, `so_capacity`, `so_registered`, `so_production`, `so_power`, `so_price`, `so_engine`) VALUES
(1, 'Opel Signum 2005', 'Opel Signum 2005', 'limuzyna', 'Czarna limuzyna dla wymagających. Świetnie trzyma sie drogi.', '<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 1, '2011-11-15 07:42:31', '2011-11-15 08:05:18', NULL, 'Opel Signum', 'czarny metallic', 1900, 'Tak(opłacony)', 2004, 150, 31900, 'Diesel'),
(2, 'Opel Vectra GTS', 'Opel Vectra GTS 2003 1.9 diesel', 'arystokrata', 'Zielony arystokrata szos na wyciągnięcie ręki. Gwarantujemy zadowolenie.', '<p>Zielony arystokrata szos na wyciągnięcie ręki. Gwarantujemy zadowolenie. Zielony arystokrata szos na wyciągnięcie ręki. Gwarantujemy zadowolenie. Zielony arystokrata szos na wyciągnięcie ręki. Gwarantujemy zadowolenie. Zielony arystokrata szos na wyciągnięcie ręki. Gwarantujemy zadowolenie. Zielony arystokrata szos na wyciągnięcie ręki. Gwarantujemy zadowolenie.</p>', 1, '2011-11-15 07:54:02', '2011-11-15 07:56:44', NULL, 'Opel Vectra GTS', 'czarny', 1900, 'Tak(opłacony)', 2003, 110, 25900, 'Diesel');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `simpleoffers_socategories`
--

CREATE TABLE IF NOT EXISTS `simpleoffers_socategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `simpleofferdm_id` int(11) NOT NULL,
  `socategorydm_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `simpleoffers_socategories`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `socategories`
--

CREATE TABLE IF NOT EXISTS `socategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL DEFAULT '#',
  `extra_table` varchar(255) DEFAULT NULL,
  `status` tinyint(5) NOT NULL DEFAULT '1',
  `family_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `islast` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Zrzut danych tabeli `socategories`
--

INSERT INTO `socategories` (`id`, `name`, `label`, `link`, `extra_table`, `status`, `family_id`, `parent_id`, `level`, `order`, `islast`) VALUES
(1, 'osobowe', 'Auta osobowe', 'auta-osobowe', NULL, 1, 0, 0, 0, 0, 0),
(2, 'Opel', 'Opel', 'opel', NULL, 1, 1, 1, 1, 0, 0),
(3, 'Signum', 'Signum', 'signum', NULL, 1, 1, 2, 2, 0, 1),
(4, 'Nowa', 'nowa kategoria', 'nowa-kategoria', NULL, 1, 0, 0, 0, 0, 0),
(5, 'used_cars', 'samochody uzywane', 'used-cars', NULL, 1, 0, 0, 0, 0, 0),
(6, 'used-opels', 'ople uzywane', 'used-opels', NULL, 1, 5, 5, 1, 0, 0),
(7, 'used-signums', 'uzywane signumy', 'used-signums', NULL, 1, 5, 6, 2, 0, 0),
(8, 'used_vectras', 'uzywane vectry', 'used-vectras', NULL, 1, 5, 6, 2, 0, 1),
(9, 'used_merivas', 'uzywane merivy', 'used_merivas', NULL, 1, 5, 6, 2, 0, 1),
(10, 'xxxx', 'xxxx', 'xxxx', NULL, 1, 5, 7, 3, 0, 0),
(20, 'yyyy', 'yyyy', 'yyyy', NULL, 1, 5, 10, 4, 0, 1),
(21, 'volkswagen', 'volkswagen', 'volkswagen', NULL, 1, 1, 1, 1, 0, 0),
(22, 'audi', 'audi', 'audi', NULL, 1, 1, 1, 1, 0, 1),
(23, 'samochody_nowe', 'samochody nowe', 'samochody-nowe', NULL, 1, 0, 0, 0, 0, 1),
(25, 'opel_pozostale', 'pozostałe', 'pozostale', NULL, 1, 1, 2, 2, 0, 1),
(26, 'audi-a8', 'audi-a8', 'audi-a8', NULL, 1, 0, 0, 0, 0, 1),
(30, 'golf', 'golf', 'golf', NULL, 1, 1, 21, 2, 0, 0),
(31, 'vectra', 'vectra', 'vectra', NULL, 1, 1, 2, 2, 0, 1),
(32, 'insignia', 'insignia', 'insignia', NULL, 1, 1, 2, 2, 0, 1),
(33, 'audi-a4', 'audi-a4', 'audi-a4', NULL, 1, 0, 0, 0, 0, 1),
(35, 'golf-3', 'golf-3', 'golf-3', NULL, 1, 1, 30, 3, 0, 1),
(36, 'subnowa_kategoria', 'subnowa kategoria', 'subnowa-kategoria', NULL, 1, 4, 4, 1, 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `tempimages`
--

CREATE TABLE IF NOT EXISTS `tempimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tempfilename` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `tempimages`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `tempimages_users`
--

CREATE TABLE IF NOT EXISTS `tempimages_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tempimagedm_id` int(11) NOT NULL,
  `userdm_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `tempimages_users`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username_2` (`username`),
  UNIQUE KEY `username_3` (`username`),
  UNIQUE KEY `username_4` (`username`),
  UNIQUE KEY `username_5` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 'thiede', '$P$BtgjMG7AH4vcHtSMC/J.//b0cQY5680', 'thiede@promo-expo.pl', 1, 0, NULL, NULL, NULL, NULL, 'f3a971f1edc23a890f62b161c1417927', '127.0.0.1', '2012-03-06 23:24:32', '2011-09-26 15:25:22', '2012-03-06 23:24:08'),
(2, 'kako', '$P$BgHKLOyeQiYFi71upw4tSd7W4uPMtZ/', 'thiede@targipracy.gdansk.pl', 1, 1, NULL, '76594b6b0a92dff47f8a0c30b85191a6', '2012-03-03 17:40:45', NULL, 'd2a330aba72c28255744a66dfa6b62ac', '127.0.0.1', '0000-00-00 00:00:00', '2011-11-22 20:29:44', '2012-03-03 17:57:54'),
(4, 'ania', '$P$BsruRwXG4G1Uu7P3Hg1NC3ibTF9Ibe1', 'akorsak@wp.pl', 1, 1, NULL, NULL, NULL, NULL, '6b0e441f41d1704301dc21b4f02feffb', '127.0.0.1', '2012-03-03 17:59:12', '2011-12-18 13:18:08', '2012-03-03 19:20:49'),
(5, 'test_user', '$P$Bqb0FvTmFM.teDReZXeLqlLXow4w2X1', 'reklama@targipracy.gdansk.pl', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2012-01-31 16:59:53', '2012-01-31 16:57:32', '2012-01-31 16:59:29'),
(10, 'polak', '$P$BhEMKJq.qL3tBs8QAUFqZ.frQa2uQI.', 'polak@polak.pl', 1, 1, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2012-03-03 19:21:35', '2012-03-03 19:21:55'),
(15, 'edi', '$P$Bxag8iFpuHAz97k8cFSDRKupZzFKF0.', 'edi@edi.pl', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2012-03-07 00:24:48', '0000-00-00 00:00:00', '2012-03-07 00:24:24');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `user_autologin`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Zrzut danych tabeli `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`) VALUES
(1, 5, NULL, NULL),
(2, 6, NULL, NULL),
(3, 7, NULL, NULL),
(4, 8, NULL, NULL),
(5, 9, NULL, NULL),
(6, 10, NULL, NULL),
(7, 11, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

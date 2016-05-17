-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 17 Maj 2016, 23:19
-- Wersja serwera: 5.5.49-0ubuntu0.14.04.1
-- Wersja PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `rokitnica`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `id_building` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `id_village` int(11) NOT NULL,
  PRIMARY KEY (`id_building`),
  KEY `id_village` (`id_village`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `building`
--

INSERT INTO `building` (`id_building`, `type`, `level`, `name`, `id_village`) VALUES
(1, 5, 10, 'Spichlerz', 1),
(2, 7, 9, 'Zagroda', 1),
(3, 10, 4, 'Tartak', 1),
(4, 3, 6, 'Huta', 1),
(5, 2, 6, 'Cegielnia', 1),
(6, 5, 3, 'Spichlerz', 2),
(7, 7, 3, 'Zagroda', 2),
(8, 10, 3, 'Tartak', 2),
(9, 3, 3, 'Huta', 2),
(10, 2, 3, 'Cegielnia', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `event_building`
--

CREATE TABLE IF NOT EXISTS `event_building` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `event_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_building` int(11) NOT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `event_squad`
--

CREATE TABLE IF NOT EXISTS `event_squad` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `event_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `position_start` int(11) NOT NULL,
  `position_end` int(11) NOT NULL,
  `id_squad` int(11) NOT NULL,
  PRIMARY KEY (`id_event`),
  KEY `id_squad` (`id_squad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `event_upgrade`
--

CREATE TABLE IF NOT EXISTS `event_upgrade` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `id_upgrade` int(11) NOT NULL,
  `event_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_event`),
  KEY `id_upgrade` (`id_upgrade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `market`
--

CREATE TABLE IF NOT EXISTS `market` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `food` int(11) NOT NULL,
  `wood` int(11) NOT NULL,
  `iron` int(11) NOT NULL,
  `clay` int(11) NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `market`
--

INSERT INTO `market` (`id_order`, `owner`, `food`, `wood`, `iron`, `clay`) VALUES
(2, 2, 100, -100, -100, 100);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `squad`
--

CREATE TABLE IF NOT EXISTS `squad` (
  `id_squad` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_village` int(11) NOT NULL COMMENT 'pozycja',
  `status` varchar(10) NOT NULL COMMENT 'training/standby/moving',
  `pikeman` int(11) NOT NULL,
  `axeman` int(11) NOT NULL,
  PRIMARY KEY (`id_squad`),
  KEY `id_user` (`id_user`),
  KEY `id_village` (`id_village`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `squad`
--

INSERT INTO `squad` (`id_squad`, `id_user`, `id_village`, `status`, `pikeman`, `axeman`) VALUES
(1, 1, 1, 'training', 20, 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `upgrade`
--

CREATE TABLE IF NOT EXISTS `upgrade` (
  `id_upgrade` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id_upgrade`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `name`) VALUES
(1, 'user1', 'passwd1', 'Użytkownik 1'),
(2, 'user2', 'passwd2', 'Użytkownik 2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `village`
--

CREATE TABLE IF NOT EXISTS `village` (
  `id_village` int(11) NOT NULL AUTO_INCREMENT,
  `food` float NOT NULL,
  `wood` float NOT NULL,
  `iron` float NOT NULL,
  `clay` float NOT NULL,
  `last_check` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_village`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `village`
--

INSERT INTO `village` (`id_village`, `food`, `wood`, `iron`, `clay`, `last_check`, `id_user`) VALUES
(1, 102400, 102400, 102400, 102400, '2016-05-17 20:14:38', 1),
(2, 1000, 1000, 1000, 1000, '2016-05-17 17:03:51', 2);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `building`
--
ALTER TABLE `building`
  ADD CONSTRAINT `building_ibfk_1` FOREIGN KEY (`id_village`) REFERENCES `village` (`id_village`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `event_squad`
--
ALTER TABLE `event_squad`
  ADD CONSTRAINT `event_squad_ibfk_1` FOREIGN KEY (`id_squad`) REFERENCES `squad` (`id_squad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `event_upgrade`
--
ALTER TABLE `event_upgrade`
  ADD CONSTRAINT `event_upgrade_ibfk_1` FOREIGN KEY (`id_upgrade`) REFERENCES `upgrade` (`id_upgrade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `market`
--
ALTER TABLE `market`
  ADD CONSTRAINT `market_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `village` (`id_village`);

--
-- Ograniczenia dla tabeli `squad`
--
ALTER TABLE `squad`
  ADD CONSTRAINT `squad_ibfk_2` FOREIGN KEY (`id_village`) REFERENCES `village` (`id_village`),
  ADD CONSTRAINT `squad_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ograniczenia dla tabeli `upgrade`
--
ALTER TABLE `upgrade`
  ADD CONSTRAINT `upgrade_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `village`
--
ALTER TABLE `village`
  ADD CONSTRAINT `village_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

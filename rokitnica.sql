-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Kwi 2016, 12:46
-- Wersja serwera: 5.5.42
-- Wersja PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `rokitnica`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `id_building` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `id_village` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `building`
--

INSERT INTO `building` (`id_building`, `type`, `level`, `name`, `id_village`) VALUES
(1, 5, 4, 'Spichlerz', 1),
(2, 7, 8, 'Zagroda', 1),
(3, 10, 5, 'Tartak', 1),
(4, 3, 5, 'Huta', 1),
(5, 2, 4, 'Cegielnia', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `event_building`
--

CREATE TABLE IF NOT EXISTS `event_building` (
  `id_event` int(11) NOT NULL,
  `event_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_building` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `event_squad`
--

CREATE TABLE IF NOT EXISTS `event_squad` (
  `id_event` int(11) NOT NULL,
  `event_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `position_start` int(11) NOT NULL,
  `position_end` int(11) NOT NULL,
  `id_squad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `event_upgrade`
--

CREATE TABLE IF NOT EXISTS `event_upgrade` (
  `id_event` int(11) NOT NULL,
  `id_upgrade` int(11) NOT NULL,
  `event_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `squad`
--

CREATE TABLE IF NOT EXISTS `squad` (
  `id_squad` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_village` int(11) NOT NULL COMMENT 'pozycja',
  `status` varchar(10) NOT NULL COMMENT 'training/standby/moving',
  `pikeman` int(11) NOT NULL,
  `axeman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `upgrade`
--

CREATE TABLE IF NOT EXISTS `upgrade` (
  `id_upgrade` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'user1', 'passwd1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `village`
--

CREATE TABLE IF NOT EXISTS `village` (
  `id_village` int(11) NOT NULL,
  `food` float NOT NULL,
  `wood` float NOT NULL,
  `iron` float NOT NULL,
  `clay` float NOT NULL,
  `last_check` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `village`
--

INSERT INTO `village` (`id_village`, `food`, `wood`, `iron`, `clay`, `last_check`, `id_user`) VALUES
(1, 1600, 1600, 1600, 1600, '2016-04-27 08:53:38', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`id_building`),
  ADD KEY `id_village` (`id_village`);

--
-- Indexes for table `event_building`
--
ALTER TABLE `event_building`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `event_squad`
--
ALTER TABLE `event_squad`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_squad` (`id_squad`);

--
-- Indexes for table `event_upgrade`
--
ALTER TABLE `event_upgrade`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_upgrade` (`id_upgrade`);

--
-- Indexes for table `squad`
--
ALTER TABLE `squad`
  ADD PRIMARY KEY (`id_squad`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_village` (`id_village`);

--
-- Indexes for table `upgrade`
--
ALTER TABLE `upgrade`
  ADD PRIMARY KEY (`id_upgrade`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`id_village`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `building`
--
ALTER TABLE `building`
  MODIFY `id_building` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `event_building`
--
ALTER TABLE `event_building`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `event_squad`
--
ALTER TABLE `event_squad`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `event_upgrade`
--
ALTER TABLE `event_upgrade`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `squad`
--
ALTER TABLE `squad`
  MODIFY `id_squad` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `upgrade`
--
ALTER TABLE `upgrade`
  MODIFY `id_upgrade` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `village`
--
ALTER TABLE `village`
  MODIFY `id_village` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
-- Ograniczenia dla tabeli `squad`
--
ALTER TABLE `squad`
  ADD CONSTRAINT `squad_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

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

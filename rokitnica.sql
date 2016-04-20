-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Kwi 2016, 14:13
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
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `building`
--

INSERT INTO `building` (`id_building`, `type`, `level`, `name`) VALUES
(1, 5, 2, 'Spichlerz'),
(2, 7, 3, 'Zagroda'),
(3, 10, 5, 'Tartak'),
(4, 3, 3, 'Huta'),
(5, 2, 2, 'Cegielnia');

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
  `last_check` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `village`
--

INSERT INTO `village` (`id_village`, `food`, `wood`, `iron`, `clay`, `last_check`) VALUES
(1, 400, 224, 256, 228, '2016-04-20 12:12:42');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`id_building`);

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`id_village`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `building`
--
ALTER TABLE `building`
  MODIFY `id_building` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `village`
--
ALTER TABLE `village`
  MODIFY `id_village` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

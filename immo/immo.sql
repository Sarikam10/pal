-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Jun 2016 um 12:58
-- Server-Version: 10.1.9-MariaDB
-- PHP-Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `immo`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(10) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `login`, `password`, `level`) VALUES
(1, 'tcs', '123', 'kunde'),
(2, 'otto', '456', 'makler'),
(3, 'max', '6666', 'admin'),
(5, 'xxx', '7777', 'kunde'),
(8, 'mw', 'asdf', 'makler'),
(9, 'css', '7777', 'kunde');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dokumente`
--

CREATE TABLE `dokumente` (
  `id` int(10) NOT NULL,
  `pdf` varchar(30) NOT NULL,
  `immob_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `dokumente`
--

INSERT INTO `dokumente` (`id`, `pdf`, `immob_id`) VALUES
(1, 'Haus1.pdf', 1),
(2, 'Haus2.pdf', 1),
(3, 'Wohnung1.pdf', 2),
(4, 'Wohnung2.pdf', 2),
(5, 'Grund1.pdf', 3),
(6, 'Grund2.pdf', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `immobilien`
--

CREATE TABLE `immobilien` (
  `id` int(10) NOT NULL,
  `art` varchar(20) NOT NULL,
  `p_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `immobilien`
--

INSERT INTO `immobilien` (`id`, `art`, `p_id`) VALUES
(1, 'Haus', 1),
(2, 'Wohnung', 2),
(3, 'Grund', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `person`
--

CREATE TABLE `person` (
  `id` int(10) NOT NULL,
  `vorname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `plz` varchar(6) NOT NULL,
  `ort` varchar(20) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `person`
--

INSERT INTO `person` (`id`, `vorname`, `name`, `adresse`, `plz`, `ort`, `datum`) VALUES
(1, 'T', 'A', 'B /5', 'A-8043', 'L', '2016-05-08'),
(2, 'O', 'A', 'B /16', 'A-8043', 'L', '2016-05-20'),
(3, 'M', 'AK', 'Wasserwerk 5', 'A-8020', 'G', '2016-05-24'),
(5, 'Kelly', 'Family', 'L', '8066', 'Liboch', '2015-06-20'),
(6, 'T', 'A', 'B /5', 'A-8043', 'L', '2016-05-08'),
(7, 'AAA', 'GGG', 'AD', '1235', 'L', '2016-05-18'),
(8, 'er', 'tt', 'er', '4563', 'e', '2011-01-01'),
(9, 'adad', 'as', 'asd', '9656', 'w', '2002-02-22'),
(10, 'm', 'w', 'ad', '4563', '', '2016-05-18'),
(11, 'm', 'w', 'as', '8043', '', '2016-05-06'),
(12, 'W', 'Ma', 'dca', '8023', '', '2016-05-18'),
(13, 'W', 'Ma', 'dca', '8023', 'MM', '2016-05-18'),
(14, 'H', 'S', 'asd', '8010', 'G', '2016-05-19'),
(15, 'CS', 'Simon', 'Obser', '8043', 'Leib', '2016-05-25'),
(16, 'CS', 'Simon', 'Obser', '8043', 'Leib', '2016-05-25'),
(17, 'T', 'A', 'B /5', 'A-8043', 'L', '2016-05-08');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indizes für die Tabelle `dokumente`
--
ALTER TABLE `dokumente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `immob_id` (`immob_id`);

--
-- Indizes für die Tabelle `immobilien`
--
ALTER TABLE `immobilien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indizes für die Tabelle `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT für Tabelle `dokumente`
--
ALTER TABLE `dokumente`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `immobilien`
--
ALTER TABLE `immobilien`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `person`
--
ALTER TABLE `person`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD CONSTRAINT `benutzer_ibfk_1` FOREIGN KEY (`id`) REFERENCES `person` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints der Tabelle `dokumente`
--
ALTER TABLE `dokumente`
  ADD CONSTRAINT `dokumente_ibfk_1` FOREIGN KEY (`immob_id`) REFERENCES `immobilien` (`id`);

--
-- Constraints der Tabelle `immobilien`
--
ALTER TABLE `immobilien`
  ADD CONSTRAINT `immobilien_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `person` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

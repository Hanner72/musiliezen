-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Nov 2020 um 16:27
-- Server-Version: 5.7.17
-- PHP-Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `wwzz`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ww_pruefberichte`
--

CREATE TABLE `ww_pruefberichte` (
  `ID` int(11) NOT NULL,
  `bericht_nr` varchar(45) DEFAULT NULL,
  `obergruppe` varchar(45) DEFAULT NULL,
  `elastik` varchar(10) DEFAULT NULL,
  `untergruppe` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `beschreibung` varchar(255) DEFAULT NULL,
  `berichtdatum` date DEFAULT NULL,
  `berichtsgueltigkeit_injahre` int(11) NOT NULL,
  `kategorie` varchar(100) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `archiv` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `ww_pruefberichte`
--

INSERT INTO `ww_pruefberichte` (`ID`, `bericht_nr`, `obergruppe`, `elastik`, `untergruppe`, `name`, `beschreibung`, `berichtdatum`, `berichtsgueltigkeit_injahre`, `kategorie`, `filename`, `archiv`) VALUES
(26, 'vcxyvcxy', '', '', '', '', '', '2018-11-09', 2, '', '1900170-15 MS Classic FE Strip SP 20B.pdf', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ww_user`
--

CREATE TABLE `ww_user` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `gruppe` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `ww_user`
--

INSERT INTO `ww_user` (`ID`, `username`, `password`, `email`, `role`, `gruppe`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'admin', 'baul'),
(2, 'user', 'user', 'user@user.com', 'user', ''),
(8, 'Hanner72', '70h4nn', '', 'superadmin', ''),
(9, 'superadmin', 'superadmin', '', 'superadmin', ''),
(48, 'polier', 'polier', 'polier@polier.at', 'polier', ''),
(49, 'monteur', 'monteur', 'monteur@monteur.at', 'monteur', '');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ww_pruefberichte`
--
ALTER TABLE `ww_pruefberichte`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `ww_user`
--
ALTER TABLE `ww_user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ww_pruefberichte`
--
ALTER TABLE `ww_pruefberichte`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT für Tabelle `ww_user`
--
ALTER TABLE `ww_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

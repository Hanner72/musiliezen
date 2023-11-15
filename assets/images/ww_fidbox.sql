-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Nov 2020 um 12:15
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
-- Tabellenstruktur für Tabelle `ww_fidbox`
--

CREATE TABLE `ww_fidbox` (
  `fb_id` int(11) NOT NULL,
  `fb_kst` varchar(45) DEFAULT NULL,
  `fb_bvh` varchar(100) DEFAULT NULL,
  `fb_cargennr` varchar(45) DEFAULT NULL,
  `fb_seriennr` varchar(45) DEFAULT NULL,
  `fb_position` varchar(100) DEFAULT NULL,
  `fb_planfoto` varchar(100) DEFAULT NULL,
  `fb_positionfoto` varchar(100) DEFAULT NULL,
  `fb_eingetragen` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `ww_fidbox`
--
ALTER TABLE `ww_fidbox`
  ADD PRIMARY KEY (`fb_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `ww_fidbox`
--
ALTER TABLE `ww_fidbox`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

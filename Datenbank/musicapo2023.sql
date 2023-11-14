-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 31. Mrz 2023 um 11:07
-- Server-Version: 5.6.41
-- PHP-Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `musicapo2023`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `funktionen`
--

CREATE TABLE `funktionen` (
  `fktid` int(11) NOT NULL,
  `fktbezeichnung` varchar(45) NOT NULL,
  `fktreihung` int(11) DEFAULT NULL,
  `mitglieder_mglid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `funktionen`
--

INSERT INTO `funktionen` (`fktid`, `fktbezeichnung`, `fktreihung`, `mitglieder_mglid`) VALUES
(0, '- KEINE -', 999999, NULL),
(1, 'Obmann', 1, 28),
(2, 'Obmann Stvtr.', 2, 10),
(3, 'Kassier', 3, 1003),
(4, 'Kassier Stvtr.', 4, 0),
(5, 'Schriftführer', 5, 1007),
(6, 'Schriftführer Stvtr.', 6, 27),
(7, 'Kapellmeister', 7, 1005),
(8, 'Kapellmeister Stvtr.', 8, 0),
(9, 'Stabführer', 9, 0),
(10, 'Stabführer Stvtr.', 10, 16),
(11, 'Internetbeauftragter', 20, 1002),
(12, 'Beirat 01', 30, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitglieder`
--

CREATE TABLE `mitglieder` (
  `mglid` int(11) NOT NULL,
  `mglvorname` varchar(45) DEFAULT NULL,
  `mglnachname` varchar(45) DEFAULT NULL,
  `mglgebdatum` date DEFAULT NULL,
  `mgladresse` varchar(255) DEFAULT NULL,
  `mglplz` varchar(45) DEFAULT NULL,
  `mglort` varchar(45) DEFAULT NULL,
  `mglmail` varchar(255) DEFAULT NULL,
  `mglaktiv` varchar(1) DEFAULT NULL,
  `mgl_aktiv_txt` varchar(45) DEFAULT NULL,
  `mglbeginn` date DEFAULT NULL,
  `mglende` date DEFAULT NULL,
  `mglbild` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `mitglieder`
--

INSERT INTO `mitglieder` (`mglid`, `mglvorname`, `mglnachname`, `mglgebdatum`, `mgladresse`, `mglplz`, `mglort`, `mglmail`, `mglaktiv`, `mgl_aktiv_txt`, `mglbeginn`, `mglende`, `mglbild`) VALUES
(0, '', '- KEINER -', '1901-01-01', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'leer.jpg'),
(10, 'Petrus', 'Zellhofer', '1969-01-01', NULL, NULL, NULL, NULL, '1', 'aktives Mitglied', NULL, NULL, 'leer.jpg'),
(16, 'Martin', 'Schagerl', NULL, NULL, NULL, NULL, NULL, '1', 'aktives Mitglied', NULL, NULL, 'leer.jpg'),
(18, 'Test', 'Ruhestand', NULL, NULL, NULL, NULL, NULL, '2', 'Mitglied in Ruhestand', NULL, NULL, 'leer.jpg'),
(20, 'Musikant', 'in Ruhestand', NULL, NULL, NULL, NULL, NULL, '2', 'Mitglied in Ruhestand', NULL, NULL, 'leer.jpg'),
(27, 'Doris', 'Danner', '1976-05-30', 'Untere Palfau 219', '8923', 'Landl', 'doris.danner1@gmail.com', '1', 'aktives Mitglied', '0000-00-00', '0000-00-00', 'leer.jpg'),
(28, 'Robert', 'Zellhofer', '1971-01-12', NULL, NULL, NULL, NULL, '1', 'aktives Mitglied', NULL, NULL, 'leer.jpg'),
(1002, 'Johann', 'Danner', '0000-00-00', 'Untere Palfau 219', '8923', 'Landl', 'johann.danner@gmail.com', '1', 'aktives Mitglied', '2020-06-01', '0000-00-00', 'leer.jpg'),
(1003, 'Johann', 'Hauss', '1970-01-01', 'Erlach', '3283', 'St. Anton/Jeßnitz', '', '1', 'aktives Mitglied', '0000-00-00', '0000-00-00', 'leer.jpg'),
(1005, 'Martin', 'Zellhofer', '0000-00-00', 'Am Schober', '3283', 'St. Anton/Jeßnitz', 'martin.zellhofer@mail.at', '1', 'aktives Mitglied', '1978-01-01', '0000-00-00', 'leer.jpg'),
(1007, 'Erna', 'Buchebner', '2020-06-01', 'Erlach', '3283', 'St. Anton/Jeßnitz', 'erni@test.at', '1', 'aktives Mitglied', '1990-01-01', '0000-00-00', 'leer.jpg'),
(1029, 'bbbbbbbbbb', 'bbbbbbbbbbbbbbb', '2023-03-24', '', '', '', 'bbbbb', '3', 'zahlendes Mitglied', '2020-07-03', '0000-00-00', 'bbbbbbbbbbbbbbb_bbbbbbbbbb_20200708-2157.jpg'),
(1030, 'Hansi', 'Danner', '2023-03-22', 'Untere Palfau 219', '8923', 'Landl', 'johann.danner@gmail.com', '1', 'aktives Mitglied', '1983-05-01', '0000-00-00', 'Danner_Hansi_20200708-2202.jpg'),
(1031, 'Undnu', 'Asoatest', '2023-03-23', '', '', '', 'mail@test.at', '1', 'aktives Mitglied', '2019-01-01', '0000-00-00', 'Asoatest_Undnu_20230208-2131.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `module`
--

CREATE TABLE `module` (
  `mod_modulegroupcode` varchar(25) NOT NULL,
  `mod_modulegroupname` varchar(50) NOT NULL,
  `mod_modulecode` varchar(25) NOT NULL,
  `mod_modulename` varchar(50) NOT NULL,
  `mod_modulegrouporder` int(3) NOT NULL,
  `mod_moduleorder` int(3) NOT NULL,
  `mod_modulepagename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `module`
--

INSERT INTO `module` (`mod_modulegroupcode`, `mod_modulegroupname`, `mod_modulecode`, `mod_modulename`, `mod_modulegrouporder`, `mod_moduleorder`, `mod_modulepagename`) VALUES
('ADMIN', 'Administration', 'ARCHIV', 'Archiv', 99, 1, 'archiv.php'),
('CHECKOUT', 'Checkout', 'PAYMENT', 'Payment', 3, 2, 'payment.php'),
('CHECKOUT', 'Checkout', 'SHIPPING', 'Shipping', 3, 1, 'shipping.php'),
('INVT', 'Inventory', 'PURCHASES', 'Purchases', 2, 1, 'purchases.php'),
('INVT', 'Inventory', 'STOCKS', 'Stocks', 2, 2, 'stocks.php'),
('VERW', 'Verwaltung', 'FUNKTIONEN', 'Funktionen', 1, 2, 'funktionen.php'),
('VERW', 'Verwaltung', 'INSTRUMENTE', 'Instrumente', 1, 3, 'instrumente.php'),
('VERW', 'Verwaltung', 'MITGLIEDER', 'Mitglieder', 1, 1, 'mitglieder.php');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE `role` (
  `role_rolecode` varchar(50) NOT NULL,
  `role_rolename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`role_rolecode`, `role_rolename`) VALUES
('ADMIN', 'Administrator'),
('SUPERADMIN', 'Super Admin'),
('USER', 'User');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role_rights`
--

CREATE TABLE `role_rights` (
  `rr_rolecode` varchar(50) NOT NULL,
  `rr_modulecode` varchar(25) NOT NULL,
  `rr_create` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_edit` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `rr_view` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `role_rights`
--

INSERT INTO `role_rights` (`rr_rolecode`, `rr_modulecode`, `rr_create`, `rr_edit`, `rr_delete`, `rr_view`) VALUES
('ADMIN', 'ARCHIV', 'yes', 'yes', 'no', 'yes'),
('ADMIN', 'FUNKTIONEN', 'yes', 'yes', 'no', 'yes'),
('ADMIN', 'INSTRUMENTE', 'yes', 'yes', 'no', 'yes'),
('ADMIN', 'MITGLIEDER', 'yes', 'yes', 'no', 'yes'),
('ADMIN', 'PAYMENT', 'no', 'no', 'no', 'yes'),
('ADMIN', 'PURCHASES', 'yes', 'yes', 'yes', 'yes'),
('ADMIN', 'SHIPPING', 'yes', 'yes', 'yes', 'yes'),
('ADMIN', 'STOCKS', 'no', 'no', 'no', 'yes'),
('SUPERADMIN', 'ARCHIV', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'FUNKTIONEN', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'INSTRUMENTE', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'MITGLIEDER', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'PAYMENT', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'PURCHASES', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'SHIPPING', 'yes', 'yes', 'yes', 'yes'),
('SUPERADMIN', 'STOCKS', 'yes', 'yes', 'yes', 'yes'),
('USER', 'ARCHIV', 'no', 'no', 'no', 'no'),
('USER', 'FUNKTIONEN', 'no', 'no', 'no', 'yes'),
('USER', 'INSTRUMENTE', 'no', 'no', 'no', 'yes'),
('USER', 'MITGLIEDER', 'no', 'no', 'no', 'yes');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `system_users`
--

CREATE TABLE `system_users` (
  `u_userid` int(11) NOT NULL,
  `u_username` varchar(100) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_rolecode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `system_users`
--

INSERT INTO `system_users` (`u_userid`, `u_username`, `u_password`, `u_rolecode`) VALUES
(3, 'Hanner72', '70h4nn', 'SUPERADMIN'),
(4, 'user', 'user', 'USER'),
(5, 'admin', 'admin', 'ADMIN'),
(6, 'superadmin', 'superadmin', 'SUPERADMIN');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `funktionen`
--
ALTER TABLE `funktionen`
  ADD PRIMARY KEY (`fktid`),
  ADD KEY `fk_funktionen_mitglieder1_idx` (`mitglieder_mglid`);

--
-- Indizes für die Tabelle `mitglieder`
--
ALTER TABLE `mitglieder`
  ADD PRIMARY KEY (`mglid`);

--
-- Indizes für die Tabelle `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`mod_modulegroupcode`,`mod_modulecode`),
  ADD UNIQUE KEY `mod_modulecode` (`mod_modulecode`);

--
-- Indizes für die Tabelle `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_rolecode`);

--
-- Indizes für die Tabelle `role_rights`
--
ALTER TABLE `role_rights`
  ADD PRIMARY KEY (`rr_rolecode`,`rr_modulecode`),
  ADD KEY `rr_modulecode` (`rr_modulecode`);

--
-- Indizes für die Tabelle `system_users`
--
ALTER TABLE `system_users`
  ADD PRIMARY KEY (`u_userid`),
  ADD KEY `u_rolecode` (`u_rolecode`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `funktionen`
--
ALTER TABLE `funktionen`
  MODIFY `fktid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `mitglieder`
--
ALTER TABLE `mitglieder`
  MODIFY `mglid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1032;

--
-- AUTO_INCREMENT für Tabelle `system_users`
--
ALTER TABLE `system_users`
  MODIFY `u_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `funktionen`
--
ALTER TABLE `funktionen`
  ADD CONSTRAINT `fk_funktionen_mitglieder1` FOREIGN KEY (`mitglieder_mglid`) REFERENCES `mitglieder` (`mglid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `role_rights`
--
ALTER TABLE `role_rights`
  ADD CONSTRAINT `role_rights_ibfk_1` FOREIGN KEY (`rr_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `role_rights_ibfk_2` FOREIGN KEY (`rr_modulecode`) REFERENCES `module` (`mod_modulecode`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `system_users`
--
ALTER TABLE `system_users`
  ADD CONSTRAINT `system_users_ibfk_1` FOREIGN KEY (`u_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

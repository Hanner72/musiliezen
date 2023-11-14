-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Nov 2023 um 23:01
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
-- Datenbank: `musiliezen`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `erforderliche_mitglieder`
--

CREATE TABLE `erforderliche_mitglieder` (
  `id` int(11) NOT NULL,
  `mitglied` varchar(100) DEFAULT NULL,
  `erforderliche_mitgliedercol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `funktionen`
--

CREATE TABLE `funktionen` (
  `fktid` int(11) NOT NULL,
  `fktname` varchar(45) NOT NULL,
  `fktreihung` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `funktionen`
--

INSERT INTO `funktionen` (`fktid`, `fktname`, `fktreihung`) VALUES
(0, '- KEINE -', 999999),
(1, 'Obmann', 1),
(2, 'Obmann Stvtr.', 2),
(3, 'Kassier', 3),
(4, 'Kassier Stvtr.', 4),
(5, 'Schriftführer', 5),
(6, 'Schriftführer Stvtr.', 6),
(7, 'Kapellmeister', 7),
(8, 'Kapellmeister Stvtr.', 8),
(9, 'Stabführer', 9),
(10, 'Stabführer Stvtr.', 10),
(11, 'Internetbeauftragter', 20),
(12, 'Beirat 01', 30);

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
  `mglbild` varchar(50) DEFAULT NULL,
  `register_regid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `mitglieder`
--

INSERT INTO `mitglieder` (`mglid`, `mglvorname`, `mglnachname`, `mglgebdatum`, `mgladresse`, `mglplz`, `mglort`, `mglmail`, `mglaktiv`, `mgl_aktiv_txt`, `mglbeginn`, `mglende`, `mglbild`, `register_regid`) VALUES
(0, '', '- KEINER -', '1901-01-01', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, 'leer.jpg', 0),
(10, 'Petrus', 'Zellhofer', '1969-01-01', NULL, NULL, NULL, 'petrus.zellhofer@strabag.com', '1', 'aktives Mitglied', NULL, NULL, 'leer.jpg', 6),
(16, 'Martin', 'Schagerl', NULL, NULL, NULL, NULL, NULL, '1', 'aktives Mitglied', NULL, NULL, 'leer.jpg', 2),
(18, 'Test', 'Ruhestand', NULL, NULL, NULL, NULL, NULL, '2', 'Mitglied in Ruhestand', NULL, NULL, 'leer.jpg', 0),
(20, 'Musikant', 'in Ruhestand', NULL, NULL, NULL, NULL, NULL, '2', 'Mitglied in Ruhestand', NULL, NULL, 'leer.jpg', 0),
(27, 'Doris', 'Danner', '1976-05-30', 'Untere Palfau 219', '8923', 'Landl', 'doris.danner1@gmail.com', '1', 'aktives Mitglied', '0000-00-00', '0000-00-00', 'leer.jpg', 3),
(28, 'Robert', 'Zellhofer', '1971-01-12', NULL, NULL, NULL, NULL, '1', 'aktives Mitglied', NULL, NULL, 'leer.jpg', 3),
(1002, 'Johann', 'Danner', '2023-04-06', 'Untere Palfau 219', '8923', 'Landl', 'johann.danner@gmail.com', '1', 'aktives Mitglied', '2020-06-01', '0000-00-00', 'leer.jpg', 2),
(1003, 'Johann', 'Hauss', '1970-01-01', 'Erlach', '3283', 'St. Anton/Jeßnitz', '', '1', 'aktives Mitglied', '0000-00-00', '0000-00-00', 'leer.jpg', 8),
(1005, 'Martin', 'Zellhofer', '2023-04-10', 'Am Schober', '3283', 'St. Anton/Jeßnitz', 'martin.zellhofer@mail.at', '1', 'aktives Mitglied', '1978-01-01', '0000-00-00', 'leer.jpg', 6),
(1007, 'Erna', 'Buchebner', '2020-06-01', 'Erlach', '3283', 'St. Anton/Jeßnitz', 'erni@test.at', '1', 'aktives Mitglied', '1990-01-01', '0000-00-00', 'leer.jpg', 5),
(1029, 'bbbbbbbbbb', 'bbbbbbbbbbbbbbb', '2023-03-24', '', '', '', 'bbbbb', '3', 'zahlendes Mitglied', '2020-07-03', '0000-00-00', 'bbbbbbbbbbbbbbb_bbbbbbbbbb_20200708-2157.jpg', 0),
(1030, 'Hansi', 'Danner', '2023-03-22', 'Untere Palfau 219', '8923', 'Landl', 'johann.danner@gmail.com', '1', 'aktives Mitglied', '1983-05-01', '0000-00-00', 'Danner_Hansi_20200708-2202.jpg', 2),
(1031, 'Undnu', 'Asoatest', '2023-03-23', '', '', '', 'mail@test.at', '1', 'aktives Mitglied', '2019-01-01', '0000-00-00', 'Asoatest_Undnu_20230208-2131.jpg', 1),
(1032, 'Julia', 'Schagerl', '2006-04-12', '', '3283', 'St. Anton an der Jeßnitz', 'julia.schagerl@gmail.com', '1', NULL, '2015-05-27', '0000-00-00', 'leer.jpg', 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitglieder_hat_funktionen`
--

CREATE TABLE `mitglieder_hat_funktionen` (
  `mitglieder_mglid` int(11) NOT NULL,
  `funktionen_fktid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `mitglieder_hat_funktionen`
--

INSERT INTO `mitglieder_hat_funktionen` (`mitglieder_mglid`, `funktionen_fktid`) VALUES
(28, 1),
(10, 2),
(1003, 3),
(1030, 6),
(1030, 11);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitglied_hat_termine`
--

CREATE TABLE `mitglied_hat_termine` (
  `termine_id` int(11) NOT NULL,
  `antwort` varchar(45) NOT NULL,
  `pinwandtext` mediumtext,
  `mitglieder_mglid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Tabellenstruktur für Tabelle `register`
--

CREATE TABLE `register` (
  `regid` int(11) NOT NULL,
  `reglangname` varchar(45) NOT NULL,
  `regkurzname` varchar(10) NOT NULL,
  `regsort` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `register`
--

INSERT INTO `register` (`regid`, `reglangname`, `regkurzname`, `regsort`) VALUES
(1, 'Trompeten', 'Trp', 4),
(2, 'Flügelhorn', 'Flgh', 3),
(3, 'Saxophon', 'Sax', 2),
(4, 'Querflöte', 'Qfl', 0),
(5, 'Klarinetten', 'Klar', 1),
(6, 'Tenorhorn', 'Thrn', 8),
(7, 'Horn', 'Horn', 6),
(8, 'Tuba', 'Tuba', 9),
(9, 'Posaune', 'Posn', 5),
(10, 'Schlagzeug', 'Schlzg', 7);

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
  `u_rolecode` varchar(50) NOT NULL,
  `mitglieder_mglid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `system_users`
--

INSERT INTO `system_users` (`u_userid`, `u_username`, `u_password`, `u_rolecode`, `mitglieder_mglid`) VALUES
(3, 'Hanner72', '70h4nn', 'SUPERADMIN', 1030),
(4, 'user', 'user', 'USER', 0),
(5, 'admin', 'admin', 'ADMIN', 0),
(6, 'superadmin', 'superadmin', 'SUPERADMIN', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `termine`
--

CREATE TABLE `termine` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `beschreibung` mediumtext,
  `wo` varchar(100) DEFAULT NULL,
  `vondatum` date DEFAULT NULL,
  `vonzeit` time DEFAULT NULL,
  `bisdatum` date DEFAULT NULL,
  `biszeit` time DEFAULT NULL,
  `treffpunkt` varchar(100) DEFAULT NULL,
  `cal_kategorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `termine`
--

INSERT INTO `termine` (`id`, `name`, `beschreibung`, `wo`, `vondatum`, `vonzeit`, `bisdatum`, `biszeit`, `treffpunkt`, `cal_kategorie_id`) VALUES
(1, 'Testname', 'Testbeschreibung Testbeschreibung Testbeschreibung Testbeschreibung Testbeschreibung Testbeschreibung ', 'Palfau Rüsthaus', '2023-06-10', '10:00:00', '2023-06-10', '16:00:00', 'Probelokal', 1),
(2, 'gestern', 'dfsgfdsgfds', 'gfdsgfds', '2023-06-13', '06:43:24', '2023-06-01', '11:43:25', 'gfdsg', 2),
(3, 'Testname', 'Testbeschreibung Testbeschreibung Testbeschreibung Testbeschreibung Testbeschreibung Testbeschreibung ', 'Palfau Rüsthaus', '2023-06-10', '11:00:00', '2023-06-10', '16:00:00', 'Probelokal', 3),
(4, 'Testname', 'Testbeschreibung Testbeschreibung Testbeschreibung Testbeschreibung Testbeschreibung Testbeschreibung ', 'Palfau Rüsthaus', '2023-06-10', '10:00:00', '2023-06-10', '16:00:00', 'Probelokal', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `termine_kat`
--

CREATE TABLE `termine_kat` (
  `id` int(11) NOT NULL,
  `katname` varchar(45) NOT NULL,
  `katfarbe` varchar(7) NOT NULL,
  `kathgfarbe` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `termine_kat`
--

INSERT INTO `termine_kat` (`id`, `katname`, `katfarbe`, `kathgfarbe`) VALUES
(1, 'eigene Veranstaltung', '#fff', '#7f0a0a'),
(2, 'Kirchliches', '#ed9595', '#000'),
(3, 'Konzertprobe', '#fff', '#2a7c11');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `termin_braucht_register`
--

CREATE TABLE `termin_braucht_register` (
  `register_regid` int(11) NOT NULL,
  `termine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `erforderliche_mitglieder`
--
ALTER TABLE `erforderliche_mitglieder`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `funktionen`
--
ALTER TABLE `funktionen`
  ADD PRIMARY KEY (`fktid`);

--
-- Indizes für die Tabelle `mitglieder`
--
ALTER TABLE `mitglieder`
  ADD PRIMARY KEY (`mglid`);

--
-- Indizes für die Tabelle `mitglieder_hat_funktionen`
--
ALTER TABLE `mitglieder_hat_funktionen`
  ADD PRIMARY KEY (`mitglieder_mglid`,`funktionen_fktid`),
  ADD KEY `fk_mitglieder_hat_funktionen_funktionen1_idx` (`funktionen_fktid`),
  ADD KEY `fk_mitglieder_hat_funktionen_mitglieder1_idx` (`mitglieder_mglid`);

--
-- Indizes für die Tabelle `mitglied_hat_termine`
--
ALTER TABLE `mitglied_hat_termine`
  ADD PRIMARY KEY (`termine_id`,`mitglieder_mglid`),
  ADD KEY `fk_system_users_hat_termine_termine1_idx` (`termine_id`),
  ADD KEY `fk_system_users_hat_termine_mitglieder1_idx` (`mitglieder_mglid`);

--
-- Indizes für die Tabelle `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`mod_modulegroupcode`,`mod_modulecode`),
  ADD UNIQUE KEY `mod_modulecode` (`mod_modulecode`);

--
-- Indizes für die Tabelle `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`regid`);

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
  ADD KEY `u_rolecode` (`u_rolecode`),
  ADD KEY `fk_system_users_mitglieder1_idx` (`mitglieder_mglid`);

--
-- Indizes für die Tabelle `termine`
--
ALTER TABLE `termine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_termine_cal_kategorie1_idx` (`cal_kategorie_id`);

--
-- Indizes für die Tabelle `termine_kat`
--
ALTER TABLE `termine_kat`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `termin_braucht_register`
--
ALTER TABLE `termin_braucht_register`
  ADD PRIMARY KEY (`register_regid`,`termine_id`),
  ADD KEY `fk_register_hat_termine_termine1_idx` (`termine_id`),
  ADD KEY `fk_register_hat_termine_register1_idx` (`register_regid`);

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
  MODIFY `mglid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1033;

--
-- AUTO_INCREMENT für Tabelle `register`
--
ALTER TABLE `register`
  MODIFY `regid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `system_users`
--
ALTER TABLE `system_users`
  MODIFY `u_userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `termine`
--
ALTER TABLE `termine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `termine_kat`
--
ALTER TABLE `termine_kat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `mitglieder_hat_funktionen`
--
ALTER TABLE `mitglieder_hat_funktionen`
  ADD CONSTRAINT `fk_mitglieder_hat_funktionen_funktionen1` FOREIGN KEY (`funktionen_fktid`) REFERENCES `funktionen` (`fktid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mitglieder_hat_funktionen_mitglieder1` FOREIGN KEY (`mitglieder_mglid`) REFERENCES `mitglieder` (`mglid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `mitglied_hat_termine`
--
ALTER TABLE `mitglied_hat_termine`
  ADD CONSTRAINT `fk_system_users_hat_termine_mitglieder1` FOREIGN KEY (`mitglieder_mglid`) REFERENCES `mitglieder` (`mglid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_system_users_hat_termine_termine1` FOREIGN KEY (`termine_id`) REFERENCES `termine` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_system_users_mitglieder1` FOREIGN KEY (`mitglieder_mglid`) REFERENCES `mitglieder` (`mglid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `system_users_ibfk_1` FOREIGN KEY (`u_rolecode`) REFERENCES `role` (`role_rolecode`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `termine`
--
ALTER TABLE `termine`
  ADD CONSTRAINT `fk_termine_cal_kategorie1` FOREIGN KEY (`cal_kategorie_id`) REFERENCES `termine_kat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `termin_braucht_register`
--
ALTER TABLE `termin_braucht_register`
  ADD CONSTRAINT `fk_register_hat_termine_register1` FOREIGN KEY (`register_regid`) REFERENCES `register` (`regid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_register_hat_termine_termine1` FOREIGN KEY (`termine_id`) REFERENCES `termine` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

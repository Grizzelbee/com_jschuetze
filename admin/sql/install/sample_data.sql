-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 22. Feb 2013 um 15:10
-- Server Version: 5.5.25a
-- PHP-Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `tzk`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `j25_jschuetze_auszeichnungen`
--

CREATE TABLE IF NOT EXISTS `j25_jschuetze_auszeichnungen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `ordering` smallint(6) NOT NULL,
  `published` smallint(6) NOT NULL,
  `zugkoenig` smallint(6) DEFAULT '0',
  `corpskoenig` smallint(6) DEFAULT '0',
  `bruderkoenig` smallint(6) DEFAULT '0',
  `pfand` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `j25_jschuetze_auszeichnungen`
--

INSERT INTO `j25_jschuetze_auszeichnungen` (`id`, `name`, `ordering`, `published`, `zugkoenig`, `corpskoenig`, `bruderkoenig`, `pfand`) VALUES
(1, 'Zugkönig "Treu zu Kaarst"', 1, 1, 1, 0, 0, 0),
(2, 'Zugsau', 2, 1, 0, 0, 0, 0),
(3, 'Joot Drupp', 3, 1, 0, 0, 0, 0),
(4, 'Pfand: Kopf', 4, 1, 0, 0, 0, 0),
(5, 'Pfand: Schweif', 5, 1, 0, 0, 0, 1),
(6, 'Pfand: linker Flügel', 6, 1, 0, 0, 0, 0),
(7, 'Pfand: rechter Flügel', 7, 1, 0, 0, 0, 0),
(8, 'Hubertuskönig', 8, 1, 0, 1, 0, 0),
(9, 'silbernes Verdienstkreuz', 9, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `j25_jschuetze_memberranks`
--

CREATE TABLE IF NOT EXISTS `j25_jschuetze_memberranks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_mitglied` int(11) DEFAULT NULL,
  `fk_funktion` int(11) DEFAULT NULL,
  `funktion_seit` date DEFAULT NULL,
  `funktion_bis` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `j25_jschuetze_memberranks`
--

INSERT INTO `j25_jschuetze_memberranks` (`id`, `fk_mitglied`, `fk_funktion`, `funktion_seit`, `funktion_bis`) VALUES
(1, 1, 1, '2012-04-01', '0000-00-00'),
(2, 2, 2, '2005-01-01', '0000-00-00'),
(3, 3, 1, '1996-01-01', '2012-03-30');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `j25_jschuetze_mitglieder`
--

CREATE TABLE IF NOT EXISTS `j25_jschuetze_mitglieder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `vorname` varchar(100) DEFAULT NULL,
  `geburtstag` date DEFAULT NULL,
  `strasse` varchar(64) DEFAULT NULL,
  `plz` int(11) DEFAULT NULL,
  `ort` varchar(32) DEFAULT NULL,
  `tel` varchar(32) DEFAULT NULL,
  `mobile` varchar(32) DEFAULT NULL,
  `email_priv` varchar(64) DEFAULT NULL,
  `foto_url` varchar(255) DEFAULT NULL,
  `religion` varchar(8) DEFAULT NULL,
  `beitritt` date DEFAULT NULL,
  `austritt` date DEFAULT NULL,
  `mitgliedsnr_bruder` int(11) DEFAULT NULL,
  `beitritt_bruder` date DEFAULT NULL,
  `austritt_bruder` date DEFAULT NULL,
  `eintritt_sch_wesen` date DEFAULT NULL,
  `fk_status` int(11) DEFAULT NULL,
  `fk_funktion` int(11) DEFAULT NULL,
  `fk_rang` int(11) DEFAULT NULL,
  `fk_lebenspartner` int(11) DEFAULT NULL,
  `ordering` smallint(6) NOT NULL,
  `published` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `j25_jschuetze_mitglieder`
--

INSERT INTO `j25_jschuetze_mitglieder` (`id`, `name`, `vorname`, `geburtstag`, `strasse`, `plz`, `ort`, `tel`, `mobile`, `email_priv`, `foto_url`, `religion`, `beitritt`, `austritt`, `mitgliedsnr_bruder`, `beitritt_bruder`, `austritt_bruder`, `eintritt_sch_wesen`, `fk_status`, `fk_funktion`, `fk_rang`, `fk_lebenspartner`, `ordering`, `published`) VALUES
(1, 'Hingsen', 'Hanjo', '1970-04-09', 'Jupiterstrasse 2', 41564, 'Kaarst', '0231 / 660254', '0163 / 6602860', 'hanjo@hingsen.de', 'images/stories/TzK_Mitglieder/Zug_Hanjo.png', 'ev', '2010-01-01', '0000-00-00', 1946, '2011-01-01', '0000-00-00', '2010-01-01', 4, 6, 1, 0, 1, 1),
(2, 'Nacken', 'Jürgen', '1970-01-17', 'Schwalbenstrasse 2d', 41564, 'Kaarst', '02131 / ...', '0177/...', 'juergen.nacken@axa.de', 'images/stories/TzK_Mitglieder/Zug_Juergen.png', 'rk', '2003-01-01', '0000-00-00', 1566, '0000-00-00', '0000-00-00', '0000-00-00', 4, 0, 2, 0, 2, 1),
(3, 'Karls', 'Martin', '0000-00-00', 'Eichendorff Strasse ', 41564, 'Kaarst', '', '', '', 'images/stories/TzK_Mitglieder/Zug_Martin.png', '', '1992-01-01', '2012-03-30', 0, '0000-00-00', '0000-00-00', '0000-00-00', 7, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `j25_jschuetze_mitgliedsausz`
--

CREATE TABLE IF NOT EXISTS `j25_jschuetze_mitgliedsausz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_mitglied` int(11) DEFAULT NULL,
  `fk_auszeichnung` int(11) DEFAULT NULL,
  `auszeichnungsdatum` date DEFAULT NULL,
  `periode` varchar(32) DEFAULT NULL,
  `foto_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `j25_jschuetze_mitgliedsausz`
--

INSERT INTO `j25_jschuetze_mitgliedsausz` (`id`, `fk_mitglied`, `fk_auszeichnung`, `auszeichnungsdatum`, `periode`, `foto_url`) VALUES
(1, 1, 1, '2012-03-28', 'Saison 2012/2013', 'images/stories/TzK_Mitglieder/Koenig_Hanjo.png'),
(2, 1, 1, '2011-04-30', 'Saison 2011/2012', 'images/stories/TzK_Mitglieder/Koenig_Hanjo.png'),
(3, 2, 8, '2011-10-22', 'Saison 2011/2012', NULL),
(4, 2, 4, '2012-04-30', 'Saison 2012/2013', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `j25_jschuetze_status`
--

CREATE TABLE IF NOT EXISTS `j25_jschuetze_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `ordering` smallint(6) NOT NULL,
  `published` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `j25_jschuetze_status`
--

INSERT INTO `j25_jschuetze_status` (`id`, `name`, `ordering`, `published`) VALUES
(1, 'Passives Mitglied', 4, 1),
(2, 'Gastmarschierer', 3, 1),
(3, 'Anwärter', 2, 1),
(4, 'Aktiver Schütze', 1, 1),
(5, 'Schülerschütze', 5, 1),
(6, 'Ehrenmitglied', 6, 1),
(7, 'Ehemaliges Mitglied', 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `j25_jschuetze_titel`
--

CREATE TABLE IF NOT EXISTS `j25_jschuetze_titel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `ordering` smallint(6) NOT NULL,
  `published` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `j25_jschuetze_titel`
--

INSERT INTO `j25_jschuetze_titel` (`id`, `name`, `rank`, `ordering`, `published`) VALUES
(1, 'Hauptmann', 1, 1, 1),
(2, 'Leutnant', 1, 2, 1),
(3, 'Spieß', 1, 3, 1),
(4, 'Kassierer', 1, 4, 1),
(5, 'Schütze', 1, 5, 1),
(6, 'Webmaster', 0, 6, 1),
(7, 'Feldkoch', 0, 7, 1),
(8, 'Sani', 0, 8, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

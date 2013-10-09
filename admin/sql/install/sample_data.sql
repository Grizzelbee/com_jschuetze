-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: wp274.webpack.hosteurope.de
-- Erstellungszeit: 05. März 2013 um 13:03
-- Server Version: 5.5.30
-- PHP-Version: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `db1001149-tzk`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `j25_jschuetze_auszeichnungen`
--

CREATE TABLE IF NOT EXISTS `j25_jschuetze_auszeichnungen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `zugkoenig` smallint(6) DEFAULT '0',
  `corpskoenig` smallint(6) DEFAULT '0',
  `bruderkoenig` smallint(6) DEFAULT '0',
  `pfand` smallint(6) DEFAULT '0',
  `ordering` smallint(6) NOT NULL,
  `published` smallint(6) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `j25_jschuetze_auszeichnungen`
--

INSERT INTO `j25_jschuetze_auszeichnungen` (`id`, `name`, `zugkoenig`, `corpskoenig`, `bruderkoenig`, `pfand`, `ordering`, `published`, `icon`) VALUES
(1, 'Zugkönig Treu-zu-Kaarst', 1, 0, 0, 0, 1, 1, 'images/krone.png'),
(2, 'Pfänder: Kopf', 0, 0, 0, 1, 2, 1, 'images/pfand_kopf.png'),
(3, 'Pfänder: Schweif', 0, 0, 0, 1, 3, 1, 'images/pfand_schweif.png'),
(4, 'Pfänder: linker Flügel', 0, 0, 0, 1, 4, 1, 'images/pfand_fluegel_links.png'),
(5, 'Pfänder: rechter Flügel', 0, 0, 0, 1, 5, 1, 'images/pfand_fluegel_rechts.png'),
(6, 'Hubertuskönig', 0, 1, 0, 0, 6, 1, 'images/krone.png'),
(7, 'Joot Drupp Orden', 0, 0, 0, 0, 7, 1, 'images/blank.png'),
(8, 'Schützenkönig', 0, 0, 1, 0, 8, 1, 'images/krone.png'),
(9, 'silbernes Verdienstkreuz', 0, 0, 0, 0, 9, 1, 'images/stories/wappen-bruderschaft.png'),
(10, 'Zugsau', 0, 0, 0, 1, 10, 1, 'images/zugsau.png');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Daten für Tabelle `j25_jschuetze_memberranks`
--

INSERT INTO `j25_jschuetze_memberranks` (`id`, `fk_mitglied`, `fk_funktion`, `funktion_seit`, `funktion_bis`) VALUES
(1, 1, 1, '2012-04-01', '0000-00-00'),
(2, 1, 7, '2010-01-01', '2012-03-30'),
(3, 2, 2, '2005-01-01', '0000-00-00'),
(4, 2, 7, '2003-01-01', '2005-01-01'),
(5, 5, 7, '2005-01-01', '0000-00-00'),
(6, 11, 7, '2012-09-01', '0000-00-00'),
(7, 10, 7, '2011-01-01', '0000-00-00'),
(8, 12, 7, '2012-09-01', '0000-00-00'),
(9, 9, 7, '2011-07-01', '0000-00-00'),
(10, 4, 7, '1992-01-01', '1996-01-01'),
(11, 4, 1, '1996-01-01', '2012-04-01'),
(12, 7, 7, '1998-01-01', '0000-00-00'),
(13, 8, 4, '2005-01-01', '0000-00-00'),
(14, 8, 7, '2005-01-01', '0000-00-00'),
(15, 14, 7, '2012-09-01', '0000-00-00'),
(16, 14, 11, '2012-09-01', '0000-00-00'),
(17, 13, 7, '2004-01-01', '2009-08-01'),
(18, 13, 3, '2009-09-01', '0000-00-00'),
(19, 4, 7, '2012-04-01', '0000-00-00');

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
  `fk_lebenspartner` int(11) DEFAULT NULL,
  `ordering` smallint(6) NOT NULL,
  `published` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Daten für Tabelle `j25_jschuetze_mitglieder`
--

INSERT INTO `j25_jschuetze_mitglieder` (`id`, `name`, `vorname`, `geburtstag`, `strasse`, `plz`, `ort`, `tel`, `mobile`, `email_priv`, `foto_url`, `religion`, `beitritt`, `austritt`, `mitgliedsnr_bruder`, `beitritt_bruder`, `austritt_bruder`, `eintritt_sch_wesen`, `fk_status`, `fk_funktion`, `fk_lebenspartner`, `ordering`, `published`) VALUES
(1, 'Hingsen', 'Hanjo', '1970-04-09', 'Jupiter', 41564, 'Kaarst', '02131/660254', '0163/6602860', 'hanjo@hingsen.de', 'images/stories/TzK_Mitglieder/Zug_Hanjo_2012.png', 'ev', '2010-01-01', '0000-00-00', 0, '2011-01-01', '0000-00-00', '2010-01-01', 1, 5, 24, 1, 1),
(2, 'Nacken', 'Jürgen', '1970-01-17', 'Schwalbenstrasse 2d', 41564, 'Kaarst', '02131 / 602493', '0177 / 2402053', 'juergen.nacken@axa.de', 'images/stories/TzK_Mitglieder/Zug_Juergen.png', 'rk', '2005-01-01', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, 0, 26, 2, 1),
(3, 'Ripiater', 'Jürgen', '0000-00-00', '', 41564, 'Kaarst', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 0, 0, 14, 0),
(4, 'Karls', 'Martin', '0000-00-00', '', 41564, 'Kaarst', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, 0, 0, 12, 0),
(5, 'Andringa', 'Marc', '1973-12-28', 'Am Hagelkreuz 7', 41564, 'Kaarst', '02131 / 516290', '0173 / 8780469', 'marcandringa@yahoo.de', 'images/stories/TzK_Mitglieder/Zug_Marc.png', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, 0, 0, 6, 1),
(6, 'Karls', 'Thomas', '0000-00-00', 'Kleinsiepstrasse', 41564, 'Kaarst', '', '', '', '', '', '1992-01-01', '2010-01-01', 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 0, 0, 13, 0),
(7, 'Nilgen', 'Klaus', '1969-05-22', 'Kaarster Strasse 47', 41564, 'Kaarst', '02131 / 7686140', '0157 / 76865946', 'bakica@ish.de', 'images/stories/TzK_Mitglieder/Zug_Klaus.png', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, 0, 27, 5, 1),
(8, 'Oltersdorf', 'Lars', '1976-10-14', 'Am Hoverkamp 43', 41564, 'Kaarst', '02131 / 176868', '0179 / 1263983', 'lars.oltersdorf@arcor.de', 'images/stories/TzK_Mitglieder/Zug_Lars_2012.png', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, 0, 28, 4, 1),
(9, 'Kaiser', 'Wolfgang', '1961-10-18', 'Neersener Strasse 27', 41564, 'Kaarst', '02131 / 606666', '0157 / 36128133', 'mia.san.mia@gmx.net', 'images/stories/TzK_Mitglieder/Zug_Wolfgang.png', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, 0, 25, 7, 1),
(10, 'Beyer', 'Michael', '1975-03-13', 'Hülser Weg 11', 41564, 'Kaarst', '02131 / 8429780', '0173 / 5211662', 'michaelbeyer75@gmx.de', 'images/stories/TzK_Mitglieder/Zug_Michael.png', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, 0, 22, 8, 1),
(11, 'Bauer', 'Nico', '1983-08-25', 'Herzogstr. 1b', 41468, 'Neuss', '02131 / 5248088', '0160 / 4728799', 'baunic@gmx.de', 'images/stories/TzK_Mitglieder/Zug_Nico.png', 'ohne', '2012-09-01', '0000-00-00', 0, '2013-01-01', '0000-00-00', '2012-09-01', 5, 0, 21, 11, 1),
(12, 'Einhirn', 'Patrick', '1978-12-09', 'Ludwig-Ehrhard-Str. 22', 41564, 'Kaarst', '02131 / 7395340', '0151 / 52552840', 'service@eingedeckt.de', 'images/stories/TzK_Mitglieder/Zug_Patrick.png', '', '2012-09-01', '0000-00-00', 0, '2013-01-01', '0000-00-00', '2012-09-01', 5, 0, 23, 10, 1),
(13, 'Stadler', 'Klaus', '1976-09-21', 'Danziger Strasse 13', 41564, 'Kaarst', '02131 / 3683157', '0178 / 6381916', 'klausi@treu-zu-kaarst.de', 'images/stories/TzK_Mitglieder/Zug_Klausi_2012.png', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, 0, 30, 3, 1),
(14, 'Schwedas', 'Gerd', '1972-10-15', 'Wimmersweg 70', 47807, 'Krefeld', '02151 / 391685', '0178 / 6165797', 'gerd.schwedas@hingsen.de', 'images/stories/TzK_Mitglieder/Zug_Gerd_Sani.png', '', '2012-01-01', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 1, 11, 29, 9, 1),
(15, 'Hüsen', 'Oliver', '0000-00-00', '', 0, 'Kaarst', '', '', '', '', '', '0000-00-00', '2011-01-01', 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 0, 0, 15, 0),
(16, 'Maksuti-Weitz', 'Smajl', '0000-00-00', '', 0, '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 0, 0, 16, 0),
(17, 'Wierichs', 'Markus', '0000-00-00', '', 0, '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 0, 0, 17, 0),
(18, 'Lorenz', 'Michael', '0000-00-00', '', 0, '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 0, 0, 18, 0),
(19, 'Vogel', 'Marcel', '0000-00-00', '', 0, '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 0, 0, 19, 0),
(20, 'Müller', 'René', '0000-00-00', '', 0, '', '', '', '', 'images/stories/TzK_Mitglieder/Zug_Rene.png', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 0, 0, 20, 0),
(21, 'Bauer', 'Sarah', '1984-12-08', 'Herzogstr. 1b', 41468, 'Neuss', '02131 / 5248088', '0176 / 48899792', 'mum1984@gmx.net', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 8, 0, 11, 21, 0),
(22, 'Hucke', 'Michaela', '1979-10-17', 'Hülser Weg 11', 41564, 'Kaarst', '02131 / 7429780', '0172 / 5468841', 'hucke.michaela@web.de', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 8, 0, 10, 22, 0),
(23, 'Einhirn', 'Yvonne', '1981-12-28', 'Ludwig-Ehrhard-Str. 22', 41564, 'Kaarst', '02131 / 7395340', '0157 / 78771699', 'yvonne.hornung@web.de', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 8, 0, 12, 23, 0),
(24, 'Hingsen', 'Nicole', '1972-09-10', 'Jupiterstrasse 2', 41564, 'Kaarst', '02131 / 660254', '0163 / 6602861', 'nicole@hingsen.de', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 8, 0, 1, 24, 0),
(25, 'Kaiser', 'Monika', '1961-03-01', 'Neersener Strasse 27', 41564, 'Kaarst', '02131 / 606666', '0160 / 8262284', 'wollemoni@arcor.de', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 8, 0, 9, 25, 0),
(26, 'Nacken', 'Gabi', '1970-08-09', 'Schwalbenstrasse 2d', 41564, 'Kaarst', '02131 / 602493', '0172 / 6787111', 'gabi-juergen@arcor.de', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 8, 0, 2, 26, 0),
(27, 'Nilgen', 'Jasna', '1972-07-07', 'Kaarster Strasse 47', 41564, 'Kaarst', '02131 / 7686140', '0162 / 6331178', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 8, 0, 7, 27, 0),
(28, 'Oltersdorf', 'Claudia', '1976-04-15', 'Am Hoverkamp 43', 41564, 'Kaarst', '02131 / 176868', '0160 / 96868348', 'claudia.oltersdorf@arcor.de', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 8, 0, 8, 28, 0),
(29, 'Schwedas', 'Claudia', '1972-05-03', 'Wimmersweg 70', 47807, 'Krefeld', '02151 / 391685', '0177 / 7995627', 'claudia.schwedas@hingsen.de', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 8, 0, 14, 29, 0),
(30, 'Stadler', 'Michaela', '1971-08-05', 'Danziger Strasse 13', 41564, 'Kaarst', '02131 / 3683157', '0177 / 7538897', 'michi58@t-online.de', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 8, 0, 13, 30, 0),
(31, 'KennIchNich', 'Thomas', '0000-00-00', '', 0, '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', '0000-00-00', 2, 0, 0, 31, 0);

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
  `titel` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Daten für Tabelle `j25_jschuetze_mitgliedsausz`
--

INSERT INTO `j25_jschuetze_mitgliedsausz` (`id`, `fk_mitglied`, `fk_auszeichnung`, `auszeichnungsdatum`, `periode`, `foto_url`, `titel`) VALUES
(1, 1, 1, '2012-04-28', 'Saison 2012 / 2013', 'images/stories/TzK_Mitglieder/Koenig_Hanjo.png', 'I.'),
(2, 2, 3, '2012-04-28', 'Saison 2012 / 2013', '', NULL),
(3, 13, 2, '2012-04-28', 'Saison 2012 / 2013', '', NULL),
(4, 8, 5, '2012-04-28', 'Saison 2012 / 2013', '', NULL),
(5, 7, 4, '2012-04-28', 'Saison 2012 / 2013', '', NULL),
(6, 1, 1, '2011-03-30', 'Saison 2011 / 2012', '', 'I.'),
(7, 2, 1, '2010-04-01', 'Saison 2010 / 2011', 'images/stories/TzK_Mitglieder/Koenig_Juergen.png', 'II.'),
(8, 2, 6, '2011-10-22', 'Saison 2011 / 2012', 'images/stories/TzK_Mitglieder/Hubi_Juergen.png', 'II.'),
(9, 4, 1, '2009-04-01', 'Saison 2009 / 2010', 'images/stories/TzK_Mitglieder/Koenig_Martin.png', 'I.'),
(10, 8, 1, '2008-04-01', 'Saison 2008 / 2009', 'images/stories/TzK_Mitglieder/Koenig_Lars.png', 'I.'),
(11, 15, 1, '2007-04-01', 'Saison 2007 / 2008', '', 'I.'),
(12, 20, 1, '2007-04-01', 'Saison 2006 / 2007', 'images/stories/TzK_Mitglieder/Koenig_Rene.png', 'I.'),
(13, 31, 1, '2005-04-01', 'Saison 2004 / 2005', '', 'II.'),
(14, 2, 1, '2003-04-01', 'Saison 2003 / 2004', 'images/stories/TzK_Mitglieder/Koenig_Juergen.png', 'II.'),
(15, 4, 1, '2002-04-01', 'Saison 2002 / 2003', 'images/stories/TzK_Mitglieder/Koenig_Martin.png', 'I.'),
(16, 16, 1, '2001-04-01', 'Saison 2001 / 2002', '', 'I.'),
(17, 4, 1, '2000-04-01', 'Saison 2000 / 2001', 'images/stories/TzK_Mitglieder/Koenig_Martin.png', 'I.'),
(18, 3, 1, '1999-04-01', 'Saison 1999 / 2000', '', 'I.'),
(19, 15, 1, '1998-04-01', 'Saison 1998 / 1999', '', 'I.'),
(20, 20, 1, '1997-04-01', 'Saison 1997 / 1998', 'images/stories/TzK_Mitglieder/Koenig_Rene.png', 'I.'),
(21, 17, 1, '1996-04-01', 'Saison 1996 / 1997', '', 'I.'),
(22, 18, 1, '1995-04-01', 'Saison 1995 / 1996', '', 'I.'),
(23, 19, 1, '1994-04-01', 'Saison 1994 / 1995', '', 'I.'),
(24, 6, 1, '1993-04-01', 'Saison 1993 / 1994', '', 'I.'),
(25, 4, 6, '2010-10-22', 'Saison 2010 / 2011', 'images/stories/TzK_Mitglieder/Hubi_Martin.png', 'I.'),
(26, 4, 6, '2002-10-21', 'Saison 2002 / 2003', 'images/stories/TzK_Mitglieder/Hubi_Martin.png', 'I.'),
(27, 20, 6, '2009-10-22', 'Saison 2009 / 2010', 'images/stories/TzK_Mitglieder/Hubi_Rene.png', 'I.'),
(34, 6, 1, '2005-04-20', 'Saison 2005 / 2006', '', 'I.'),
(38, 5, 10, '2012-06-12', 'Saison 2012 / 2013', '', ''),
(35, 20, 6, '2001-10-22', 'Saisin 2001 / 2002', 'images/stories/TzK_Mitglieder/Hubi_Rene.png', 'I.'),
(36, 13, 10, '2011-06-20', 'Saison 2011 / 2012', '', ''),
(37, 5, 10, '2012-06-20', 'Saison 2012 / 2013', '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `j25_jschuetze_status`
--

INSERT INTO `j25_jschuetze_status` (`id`, `name`, `ordering`, `published`) VALUES
(1, 'Aktiver Schütze', 1, 1),
(2, 'Ehemaliges Mitglied', 7, 1),
(3, 'Passives Mitglied', 5, 1),
(4, 'Gastmarschierer', 2, 1),
(5, 'Anwärter', 3, 1),
(6, 'Schülerschütze', 4, 1),
(7, 'Ehrenmitglied', 6, 1),
(8, 'Lebenspartner', 8, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `j25_jschuetze_titel`
--

INSERT INTO `j25_jschuetze_titel` (`id`, `name`, `rank`, `ordering`, `published`) VALUES
(1, 'Hauptmann', 1, 1, 1),
(2, 'Leutnant', 1, 2, 1),
(3, 'Spieß', 1, 3, 1),
(4, 'Kassierer', 1, 4, 1),
(5, 'Webmaster', 0, 6, 1),
(6, 'Corps Schatzmeister', 0, 11, 1),
(7, 'Schütze', 1, 5, 1),
(8, 'Corps Schützenmeister', 0, 10, 1),
(9, 'Corps Jungschützenmeister', 0, 9, 1),
(10, 'Feldkoch', 0, 7, 1),
(11, 'Sani', 0, 8, 1);

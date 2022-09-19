SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `%prefix%commonlinks` (
  `releaseid` varchar(255) NOT NULL,
  `formname` varchar(255) NOT NULL,
  `linkname` tinytext,
  `linkref` text,
  `linkdesc` text,
  `linktech` text,
  PRIMARY KEY (`releaseid`(100),`formname`(20))
) DEFAULT COLLATE=%collation%;

CREATE TABLE IF NOT EXISTS `%prefix%freesecs` (
  `releaseid` varchar(255) NOT NULL,
  `secpos` tinyint(4) NOT NULL,
  `seccontent` text,
  PRIMARY KEY (`releaseid`(100),`secpos`)
) DEFAULT COLLATE=%collation%;

CREATE TABLE IF NOT EXISTS `%prefix%hiddenrels` (
  `releaseid` varchar(255) NOT NULL,
  PRIMARY KEY (`releaseid`(100))
) DEFAULT COLLATE=%collation%;

CREATE TABLE IF NOT EXISTS `%prefix%linkforms` (
  `formname` varchar(255) NOT NULL,
  `formpos` int(11) NOT NULL,
  `commname` text,
  `commdesc` text,
  `commtech` text,
  PRIMARY KEY (`formname`(100)),
  UNIQUE KEY `formpos` (`formpos`)
) DEFAULT COLLATE=%collation%;

CREATE TABLE IF NOT EXISTS `%prefix%links` (
  `releaseid` varchar(255) NOT NULL,
  `linkpos` tinyint(3) unsigned NOT NULL,
  `linkname` tinytext,
  `linkref` text,
  `linkdesc` text,
  `linktech` text,
  PRIMARY KEY (`releaseid`(100),`linkpos`)
) DEFAULT COLLATE=%collation%;

CREATE TABLE IF NOT EXISTS `%prefix%releases` (
  `releaseid` varchar(255) NOT NULL,
  `releasename` text,
  `releasedate` date NOT NULL,
  `releasecover` text,
  `releasedesc` text,
  `releaseheader` text,
  PRIMARY KEY (`releaseid`(100))
) DEFAULT COLLATE=%collation%;

CREATE TABLE IF NOT EXISTS `%prefix%sections` (
  `releaseid` varchar(255) NOT NULL,
  `secpos` tinyint(3) unsigned NOT NULL,
  `sectitle` tinytext,
  `sectemplate` tinytext,
  PRIMARY KEY (`releaseid`(100),`secpos`)
) DEFAULT COLLATE=%collation%;

CREATE TABLE IF NOT EXISTS `%prefix%static` (
  `stid` varchar(255) NOT NULL,
  `stcontent` text,
  PRIMARY KEY (`stid`(100))
) DEFAULT COLLATE=%collation%;

CREATE TABLE IF NOT EXISTS `%prefix%staticsecs` (
  `releaseid` varchar(255) NOT NULL,
  `secpos` tinyint(4) NOT NULL,
  `stid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`releaseid`(100),`secpos`)
) DEFAULT COLLATE=%collation%;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

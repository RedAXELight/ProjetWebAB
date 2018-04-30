-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.17-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for snows
CREATE DATABASE IF NOT EXISTS `snows` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `snows`;

-- Dumping structure for table snows.tblclients
CREATE TABLE IF NOT EXISTS `tblclients` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nomClient` varchar(45) DEFAULT NULL,
  `prenomClient` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `passwd` varchar(45) DEFAULT NULL,
  `ville` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table snows.tblclients: ~4 rows (approximately)
/*!40000 ALTER TABLE `tblclients` DISABLE KEYS */;
INSERT INTO `tblclients` (`idClient`, `nomClient`, `prenomClient`, `login`, `passwd`, `ville`, `tel`) VALUES
	(1, 'Cover', 'Harry', 'Cover', '1234', 'Yverdon', '024 444 55 66'),
	(2, 'Quetting', 'Marc', 'Quetting', '2345', 'Lausanne', '021 111 22 33'),
	(3, 'Hatte', 'Tom', 'Hatte', '1122', 'Yverdon', '024 222 33 44'),
	(4, 'Zétofrey', 'Mélanie', 'Zéto', '2233', 'Yens', '021 456 78 90');
/*!40000 ALTER TABLE `tblclients` ENABLE KEYS */;

-- Dumping structure for table snows.tbldroits
CREATE TABLE IF NOT EXISTS `tbldroits` (
  `idDroit` int(11) NOT NULL AUTO_INCREMENT,
  `droits` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDroit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table snows.tbldroits: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbldroits` DISABLE KEYS */;
INSERT INTO `tbldroits` (`idDroit`, `droits`) VALUES
	(1, 'admin'),
	(2, 'vendeur');
/*!40000 ALTER TABLE `tbldroits` ENABLE KEYS */;

-- Dumping structure for table snows.tbllocations
CREATE TABLE IF NOT EXISTS `tbllocations` (
  `idLocation` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(45) DEFAULT NULL,
  `dateDebut` date NOT NULL,
  `idClient` int(11) NOT NULL,
  `idVendeur` int(11) NOT NULL,
  PRIMARY KEY (`idLocation`),
  KEY `fk_tbllocation_tblClient1` (`idClient`),
  KEY `fk_tbllocation_tblVendeurs1` (`idVendeur`),
  CONSTRAINT `fk_tbllocation_tblVendeurs1` FOREIGN KEY (`idVendeur`) REFERENCES `tblvendeurs` (`idVendeur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `test` FOREIGN KEY (`idClient`) REFERENCES `tblclients` (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Dumping data for table snows.tbllocations: ~4 rows (approximately)
/*!40000 ALTER TABLE `tbllocations` DISABLE KEYS */;
INSERT INTO `tbllocations` (`idLocation`, `statut`, `dateDebut`, `idClient`, `idVendeur`) VALUES
	(25, 'ouvert', '0000-00-00', 1, 5),
	(26, 'ouvert', '0000-00-00', 1, 5),
	(32, 'ouvert', '2015-01-13', 1, 5),
	(33, 'ouvert', '2015-11-03', 1, 5);
/*!40000 ALTER TABLE `tbllocations` ENABLE KEYS */;

-- Dumping structure for table snows.tbllocationsurf
CREATE TABLE IF NOT EXISTS `tbllocationsurf` (
  `idLocationSurf` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',
  `idsurf` varchar(10) NOT NULL,
  `idLocation` int(11) NOT NULL,
  `nbreJours` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `statut` varchar(20) DEFAULT 'sorti',
  PRIMARY KEY (`idLocationSurf`),
  KEY `fk_tblLocationSurf_tblsurf` (`idsurf`),
  KEY `fk_tblLocationSurf_tbllocation1` (`idLocation`),
  CONSTRAINT `fk_tblLocationSurf_tbllocation1` FOREIGN KEY (`idLocation`) REFERENCES `tbllocations` (`idLocation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tblLocationSurf_tblsurf` FOREIGN KEY (`idsurf`) REFERENCES `tblsurfs` (`idsurf`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snows.tbllocationsurf: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbllocationsurf` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbllocationsurf` ENABLE KEYS */;

-- Dumping structure for table snows.tblsurfs
CREATE TABLE IF NOT EXISTS `tblsurfs` (
  `idsurf` varchar(10) NOT NULL,
  `marque` varchar(45) DEFAULT NULL,
  `boots` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `disponibilite` int(11) DEFAULT NULL,
  `statut` varchar(20) NOT NULL,
  PRIMARY KEY (`idsurf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table snows.tblsurfs: ~8 rows (approximately)
/*!40000 ALTER TABLE `tblsurfs` DISABLE KEYS */;
INSERT INTO `tblsurfs` (`idsurf`, `marque`, `boots`, `type`, `disponibilite`, `statut`) VALUES
	('34', 'Burton 11h51', '34', '45', 10, ''),
	('B151', 'Burton', 'Regular', 'Alpin', 10, ''),
	('B326', 'Burton', 'Regular', 'Alpin', 1, ''),
	('B444', 'Burton', 'Regular', 'Alpin', 444, ''),
	('K266', 'K2', 'Regular', 'Soul Carve', 2, ''),
	('N100', 'Nidecker', 'Goofy', 'Soul Carve', 12, ''),
	('N754', 'Nidecker', 'Regular', 'Alpin', 98, ''),
	('P621', 'Prior', 'Regular', 'Alpin', 0, '');
/*!40000 ALTER TABLE `tblsurfs` ENABLE KEYS */;

-- Dumping structure for table snows.tblvendeurs
CREATE TABLE IF NOT EXISTS `tblvendeurs` (
  `idVendeur` int(11) NOT NULL AUTO_INCREMENT,
  `nomVendeur` varchar(45) DEFAULT NULL,
  `prenomVendeur` varchar(45) DEFAULT NULL,
  `login` varchar(45) NOT NULL,
  `passwd` varchar(45) NOT NULL,
  `idDroitsFK` int(11) NOT NULL,
  PRIMARY KEY (`idVendeur`),
  KEY `fk_tblVendeurs_tblDroits1` (`idDroitsFK`),
  CONSTRAINT `fk_tblVendeurs_tblDroits1` FOREIGN KEY (`idDroitsFK`) REFERENCES `tbldroits` (`idDroit`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table snows.tblvendeurs: ~5 rows (approximately)
/*!40000 ALTER TABLE `tblvendeurs` DISABLE KEYS */;
INSERT INTO `tblvendeurs` (`idVendeur`, `nomVendeur`, `prenomVendeur`, `login`, `passwd`, `idDroitsFK`) VALUES
	(1, 'Nemmard', 'Jean', 'jna', '1234', 1),
	(2, 'Javelle', 'Aude', 'Aude', '1234', 2),
	(3, 'Nonime', 'Anne', 'Anne', '1234', 1),
	(4, 'Arne', 'Luc', 'Luc', '1234', 2),
	(5, 'Site', 'Site', 'Site', '1234', 2);
/*!40000 ALTER TABLE `tblvendeurs` ENABLE KEYS */;

-- Dumping structure for table snows.utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `NomClient` varchar(45) DEFAULT NULL,
  `PrenomClient` varchar(45) DEFAULT NULL,
  `Adresse` varchar(45) DEFAULT NULL,
  `Ville` varchar(45) DEFAULT NULL,
  `NPA` int(11) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

-- Dumping data for table snows.utilisateur: ~8 rows (approximately)
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` (`idClient`, `NomClient`, `PrenomClient`, `Adresse`, `Ville`, `NPA`, `email`) VALUES
	(107, 'Acuna Ramirez', 'Camilo', 'Rue du Bugnon', 'Renens', 1020, 'camilo.ramirez@gmail.com'),
	(108, 'Silva', 'Fabio', 'Yverdon lac 45', 'Yverdon', 1033, 'f.silva@gmail.com'),
	(109, 'Pierre', 'Aloys', 'Rue de Geneve', 'Lausanne', 1018, 'a.pierre@gmail.com'),
	(110, 'Silva', 'Fabio', 'Yverdon lac 34', 'Yverdon', 1002, 'fabio.silva@cpnv.ch'),
	(111, 'Giordano', 'Antonio', 'Ste-Croix 33', 'Ste-Croix', 1552, 'g.anto@gmail.com'),
	(112, 'Perret', 'Yanick', 'Yverdon lac 33', 'Yverdon', 5562, 'Y.perret@gmail.com'),
	(113, 'Grisel', 'Saber', 'Chemain Porte 22 ', 'Lausanne', 1018, 's.grisel@gmail.com'),
	(114, 'Mond', 'Aless', 'Rue Ste-Croix 34', 'Ste-Croix', 5455, 'a.mon@cpnv.ch');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

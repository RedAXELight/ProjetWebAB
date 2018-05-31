-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 31 mai 2018 à 06:36
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cubesat`
--

-- --------------------------------------------------------

--
-- Structure de la table `battery`
--

DROP TABLE IF EXISTS `battery`;
CREATE TABLE IF NOT EXISTS `battery` (
  `idBattery` int(11) NOT NULL AUTO_INCREMENT,
  `BatterySpace` int(11) DEFAULT NULL,
  `Capacity` float DEFAULT NULL,
  `ChargingVoltage` float DEFAULT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`idBattery`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `battery_has_cubesat`
--

DROP TABLE IF EXISTS `battery_has_cubesat`;
CREATE TABLE IF NOT EXISTS `battery_has_cubesat` (
  `Battery_idBattery` int(11) NOT NULL,
  `CubeSat_idCubeSat` int(11) NOT NULL,
  PRIMARY KEY (`Battery_idBattery`,`CubeSat_idCubeSat`),
  KEY `fk_Battery_has_CubeSat_CubeSat1_idx` (`CubeSat_idCubeSat`),
  KEY `fk_Battery_has_CubeSat_Battery1_idx` (`Battery_idBattery`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contract`
--

DROP TABLE IF EXISTS `contract`;
CREATE TABLE IF NOT EXISTS `contract` (
  `idContract` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(150) DEFAULT NULL,
  `BeginDate` date DEFAULT NULL,
  `EndDate` varchar(45) DEFAULT NULL,
  `Statut_idStatut` int(11) NOT NULL,
  `Users_idUsers` int(11) NOT NULL,
  PRIMARY KEY (`idContract`),
  UNIQUE KEY `idContract_UNIQUE` (`idContract`),
  KEY `fk_Contract_Statut1_idx` (`Statut_idStatut`),
  KEY `fk_Contract_Users1_idx` (`Users_idUsers`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cubesat`
--

DROP TABLE IF EXISTS `cubesat`;
CREATE TABLE IF NOT EXISTS `cubesat` (
  `idCubeSat` int(11) NOT NULL AUTO_INCREMENT,
  `csName` varchar(45) DEFAULT NULL,
  `csMass` float DEFAULT NULL,
  `csPrice` float DEFAULT NULL,
  `SolarPanel` tinyint(1) DEFAULT NULL,
  `Height` int(11) DEFAULT NULL,
  `Width` int(11) DEFAULT NULL,
  `Length` int(11) DEFAULT NULL,
  `BatterySpace` int(11) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idCubeSat`),
  UNIQUE KEY `idCubeSat_UNIQUE` (`idCubeSat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cubesat_has_contract`
--

DROP TABLE IF EXISTS `cubesat_has_contract`;
CREATE TABLE IF NOT EXISTS `cubesat_has_contract` (
  `CubeSat_idCubeSat` int(11) NOT NULL,
  `Contract_idContract` int(11) NOT NULL,
  PRIMARY KEY (`CubeSat_idCubeSat`,`Contract_idContract`),
  KEY `fk_CubeSat_has_Contract_Contract1_idx` (`Contract_idContract`),
  KEY `fk_CubeSat_has_Contract_CubeSat1_idx` (`CubeSat_idCubeSat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cubesat_has_extensions`
--

DROP TABLE IF EXISTS `cubesat_has_extensions`;
CREATE TABLE IF NOT EXISTS `cubesat_has_extensions` (
  `CubeSat_idCubeSat` int(11) NOT NULL,
  `Extensions_idExtensions` int(11) NOT NULL,
  PRIMARY KEY (`CubeSat_idCubeSat`,`Extensions_idExtensions`),
  KEY `fk_CubeSat_has_Extensions_Extensions1_idx` (`Extensions_idExtensions`),
  KEY `fk_CubeSat_has_Extensions_CubeSat1_idx` (`CubeSat_idCubeSat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `extensions`
--

DROP TABLE IF EXISTS `extensions`;
CREATE TABLE IF NOT EXISTS `extensions` (
  `idExtensions` int(11) NOT NULL AUTO_INCREMENT,
  `extDescription` varchar(150) DEFAULT NULL,
  `Manufacturer` varchar(45) DEFAULT NULL,
  `extType` varchar(45) DEFAULT NULL,
  `extName` varchar(45) DEFAULT NULL,
  `extMass` float DEFAULT NULL,
  `extPrice` float DEFAULT NULL,
  `extStock` int(11) DEFAULT NULL,
  PRIMARY KEY (`idExtensions`),
  UNIQUE KEY `idExtensions_UNIQUE` (`idExtensions`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

DROP TABLE IF EXISTS `statut`;
CREATE TABLE IF NOT EXISTS `statut` (
  `idStatut` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(10) DEFAULT NULL,
  `Motif` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idStatut`),
  UNIQUE KEY `idStatut_UNIQUE` (`idStatut`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `userrole`
--

DROP TABLE IF EXISTS `userrole`;
CREATE TABLE IF NOT EXISTS `userrole` (
  `idUserRole` int(11) NOT NULL AUTO_INCREMENT,
  `UserRolecol` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idUserRole`),
  UNIQUE KEY `idUserRole_UNIQUE` (`idUserRole`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `userrole`
--

INSERT INTO `userrole` (`idUserRole`, `UserRolecol`) VALUES
(1, 'Administrateur'),
(2, 'Vendeur'),
(3, 'Client');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `usrSurname` varchar(50) DEFAULT NULL,
  `usrName` varchar(50) DEFAULT NULL,
  `usrAddress` varchar(50) DEFAULT NULL,
  `usrNPA` varchar(10) DEFAULT NULL,
  `usrlieu` varchar(60) DEFAULT NULL,
  `usrPassword` varchar(100) DEFAULT NULL,
  `UserRole_idUserRole` int(11) NOT NULL DEFAULT '3',
  `usrLogin` varchar(45) DEFAULT NULL,
  `usrMail` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`idUsers`),
  UNIQUE KEY `idUtilisateurs_UNIQUE` (`idUsers`),
  UNIQUE KEY `usrMail_UNIQUE` (`usrMail`),
  KEY `fk_Users_UserRole_idx` (`UserRole_idUserRole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUsers`, `usrSurname`, `usrName`, `usrAddress`, `usrNPA`, `usrlieu`, `usrPassword`, `UserRole_idUserRole`, `usrLogin`, `usrMail`) VALUES
(1, 'Baseia', 'Alexandre', 'Ch. de Penchèvre 35', '1350', 'Orbe', 'Pa$$w0rd', 1, 'RedAXELight', NULL),
(2, 'Rodrigues Fraga', 'Brian', 'Route de Mivelaz 3', '1562', 'Corcelles-près-Payerne', 'j\'aimelesgaufres', 1, 'HeavnWolf', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `battery_has_cubesat`
--
ALTER TABLE `battery_has_cubesat`
  ADD CONSTRAINT `fk_Battery_has_CubeSat_Battery1` FOREIGN KEY (`Battery_idBattery`) REFERENCES `battery` (`idBattery`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Battery_has_CubeSat_CubeSat1` FOREIGN KEY (`CubeSat_idCubeSat`) REFERENCES `cubesat` (`idCubeSat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `fk_Contract_Statut1` FOREIGN KEY (`Statut_idStatut`) REFERENCES `statut` (`idStatut`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Contract_Users1` FOREIGN KEY (`Users_idUsers`) REFERENCES `users` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `cubesat_has_contract`
--
ALTER TABLE `cubesat_has_contract`
  ADD CONSTRAINT `fk_CubeSat_has_Contract_Contract1` FOREIGN KEY (`Contract_idContract`) REFERENCES `contract` (`idContract`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CubeSat_has_Contract_CubeSat1` FOREIGN KEY (`CubeSat_idCubeSat`) REFERENCES `cubesat` (`idCubeSat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `cubesat_has_extensions`
--
ALTER TABLE `cubesat_has_extensions`
  ADD CONSTRAINT `fk_CubeSat_has_Extensions_CubeSat1` FOREIGN KEY (`CubeSat_idCubeSat`) REFERENCES `cubesat` (`idCubeSat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CubeSat_has_Extensions_Extensions1` FOREIGN KEY (`Extensions_idExtensions`) REFERENCES `extensions` (`idExtensions`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_Users_UserRole` FOREIGN KEY (`UserRole_idUserRole`) REFERENCES `userrole` (`idUserRole`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

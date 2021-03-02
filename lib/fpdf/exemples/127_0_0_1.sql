-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 13 Juin 2017 à 09:33
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `exposer`
--

-- --------------------------------------------------------

--
-- Structure de la table `exposer`
--

CREATE TABLE IF NOT EXISTS `exposer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MATRICULE` varchar(30) NOT NULL,
  `NOM` varchar(60) NOT NULL,
  `PRENOM` varchar(60) NOT NULL,
  `SEXE` varchar(15) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `AGE` int(11) NOT NULL,
  `LIEUXNAISSANCE` varchar(30) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `exposer`
--

INSERT INTO `exposer` (`ID`, `MATRICULE`, `NOM`, `PRENOM`, `SEXE`, `EMAIL`, `AGE`, `LIEUXNAISSANCE`, `DESCRIPTION`) VALUES
(1, '15Y50', 'NANA JOUNANG', 'ARNOLD', 'Homme', 'nanaarnold23@gmail.com', 22, 'BAFOUSSAM', 'simple a vivre et degager dans lensemble'),
(2, '15Y51', 'AWONO', 'PIERETTE', 'Femme', 'nanaarnold23@gmail.com', 23, 'YAOUNDEE', 'FREEE ET SIMPLE'),
(3, '15Y52', 'MARLENE', 'LADOUCE', 'Femme', '', 21, '', ''),
(4, '15Y53', 'FATIMA', 'HABOUBAKAR', 'Femme', 'fatima@gmail.com', 21, 'GAROUA', 'simple douce et cool');
--
-- Base de données :  `test`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

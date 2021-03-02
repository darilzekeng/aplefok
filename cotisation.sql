-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 17 Octobre 2020 à 12:12
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `aplefok`
--

-- --------------------------------------------------------

--
-- Structure de la table `cotisation`
--

CREATE TABLE IF NOT EXISTS `cotisation` (
  `id_cotisation` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `mois_annee` varchar(200) NOT NULL,
  `apperitif` int(11) NOT NULL,
  `secours` int(11) NOT NULL,
  `epargne` int(11) NOT NULL,
  `aide` int(11) NOT NULL,
  `fete` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `remboursement` int(11) NOT NULL,
  `observation` text NOT NULL,
  PRIMARY KEY (`id_cotisation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `cotisation`
--

INSERT INTO `cotisation` (`id_cotisation`, `id_membre`, `mois_annee`, `apperitif`, `secours`, `epargne`, `aide`, `fete`, `credit`, `remboursement`, `observation`) VALUES
(1, 1, 'Janvier-2020', 1000, 2000, 1000, 12, 12, 0, 0, ''),
(2, 1, 'Janvier-2020', 1000, 2000, 1000, 0, 0, 0, 0, ''),
(3, 3, 'Janvier-2020', 1000, 2000, 1000, 12, 12, 0, 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

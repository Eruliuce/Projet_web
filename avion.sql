-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 10 Février 2015 à 01:49
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `avion`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `NUMCLIENT` int(2) NOT NULL AUTO_INCREMENT,
  `LOGINCLIENT` varchar(535) NOT NULL,
  `PASSCLIENT` varchar(535) NOT NULL,
  `NOMCLIENT` varchar(255) DEFAULT NULL,
  `PRENOMCLIENT` varchar(255) DEFAULT NULL,
  `ADRESSECLIENT` varchar(255) DEFAULT NULL,
  `CPCLIENT` int(2) DEFAULT NULL,
  `TELCLIENT` char(10) DEFAULT NULL,
  `CBCLIENT` varchar(535) DEFAULT NULL,
  `DATEINSC` date NOT NULL,
  `BOOLADMIN` tinyint(1) NOT NULL,
  PRIMARY KEY (`NUMCLIENT`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`NUMCLIENT`, `LOGINCLIENT`, `PASSCLIENT`, `NOMCLIENT`, `PRENOMCLIENT`, `ADRESSECLIENT`, `CPCLIENT`, `TELCLIENT`, `CBCLIENT`, `DATEINSC`, `BOOLADMIN`) VALUES
(1, 'FsMz', 'ab764d7c8310f20655118aa8a0cde186', 'Pipino', 'Jérôme', 'Ici', 91300, '0618664943', '22975d8a5ed1b91445f6c55ac121505b', '2015-02-10', 1);

-- --------------------------------------------------------

--
-- Structure de la table `clientperso`
--

CREATE TABLE IF NOT EXISTS `clientperso` (
  `NUMCLIENT` int(11) NOT NULL,
  `NUMPRODUIT` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `NUMCOMMANDE` int(2) NOT NULL AUTO_INCREMENT,
  `NUMCLIENT` int(2) NOT NULL,
  `NUMETAT` int(2) NOT NULL,
  `DATECOMMANDE` date DEFAULT NULL,
  PRIMARY KEY (`NUMCOMMANDE`),
  KEY `FK_COMMANDE_CLIENT` (`NUMCLIENT`),
  KEY `FK_COMMANDE_ETAT` (`NUMETAT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `composition`
--

CREATE TABLE IF NOT EXISTS `composition` (
  `NUMPRODUIT` int(2) NOT NULL,
  `NUMOPTION` int(2) NOT NULL,
  PRIMARY KEY (`NUMPRODUIT`,`NUMOPTION`),
  KEY `FK_SE_COMPOSE_DE_INGREDIENT` (`NUMOPTION`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `composition`
--

INSERT INTO `composition` (`NUMPRODUIT`, `NUMOPTION`) VALUES
(1, 1),
(2, 1),
(2, 3),
(3, 1),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(5, 1),
(5, 4),
(5, 6),
(6, 1),
(6, 7);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
  `NUMETAT` int(2) NOT NULL AUTO_INCREMENT,
  `LIBELLEETAT` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`NUMETAT`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`NUMETAT`, `LIBELLEETAT`) VALUES
(1, 'En cours'),
(2, 'Travail terminé');

-- --------------------------------------------------------

--
-- Structure de la table `lignecommande`
--

CREATE TABLE IF NOT EXISTS `lignecommande` (
  `NUMPRODUIT` int(2) NOT NULL,
  `NUMCOMMANDE` int(2) NOT NULL,
  `QUANTITELC` int(2) DEFAULT NULL,
  PRIMARY KEY (`NUMPRODUIT`,`NUMCOMMANDE`),
  KEY `FK_LIGNECOMMANDE_COMMANDE` (`NUMCOMMANDE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `option`
--

CREATE TABLE IF NOT EXISTS `option` (
  `NUMOPTION` int(2) NOT NULL AUTO_INCREMENT,
  `NOMOPTION` varchar(255) DEFAULT NULL,
  `PRIXOPTION` double(5,2) DEFAULT NULL,
  `QUANTITEOPTION` int(6) DEFAULT NULL,
  PRIMARY KEY (`NUMOPTION`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `option`
--

INSERT INTO `option` (`NUMOPTION`, `NOMOPTION`, `PRIXOPTION`, `QUANTITEOPTION`) VALUES
(1, 'Siege', 20.00, 1),
(2, 'Soute', 999.99, 1),
(3, 'Soute à eau', 999.99, 1),
(4, 'Mitraillette', 500.00, 1),
(5, 'Lance-missiles', 999.99, 1),
(6, 'Furtivité', 999.99, 1),
(7, 'Moteur basculant', 999.99, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `NUMPRODUIT` int(2) NOT NULL AUTO_INCREMENT,
  `NUMPROMOTION` int(2) NOT NULL,
  `NUMRUBRIQUE` int(2) NOT NULL,
  `NOMPRODUIT` varchar(255) DEFAULT NULL,
  `PRIXPRODUIT` int(2) DEFAULT NULL,
  `URLPRODUIT` varchar(535) NOT NULL,
  `TAILLEPRODUIT` int(2) NOT NULL,
  `PLOMBE` tinyint(1) NOT NULL,
  `PERSO` tinyint(1) NOT NULL,
  PRIMARY KEY (`NUMPRODUIT`),
  KEY `FK_PRODUIT_PROMOTION` (`NUMPROMOTION`),
  KEY `FK_PRODUIT_RUBRIQUE` (`NUMRUBRIQUE`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`NUMPRODUIT`, `NUMPROMOTION`, `NUMRUBRIQUE`, `NOMPRODUIT`, `PRIXPRODUIT`, `URLPRODUIT`, `TAILLEPRODUIT`, `PLOMBE`, `PERSO`) VALUES
(1, 0, 1, 'Avion civile', 75000, 'images/avion.jpg', 1, 0, 0),
(2, 0, 1, 'Hydravion', 100000, 'images/hydravion.jpg', 1, 0, 0),
(3, 0, 1, 'Avion militaire', 2000000, 'images/militaire.jpg', 3, 0, 0),
(4, 0, 1, 'Avion de transport', 1000000, 'images/transport.jpg', 3, 0, 0),
(5, 0, 1, 'Aile volante', 5000000, 'images/ailevolante.jpg', 2, 0, 0),
(6, 0, 1, 'Avion à décollage vertical', 500000, 'images/vertical.jpg', 2, 0, 0),
(7, 0, 2, 'Kérosène Jet A', 400, '', 50, 1, 0),
(8, 0, 2, 'Kérosène Jet B', 500, '', 50, 1, 0),
(9, 0, 2, 'Kérosène JP-5', 1000, '', 50, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `NUMPROMOTION` int(2) NOT NULL,
  `TAUXREDUC` double(5,2) DEFAULT NULL,
  `DATEDEBUT` date DEFAULT NULL,
  `DATEFIN` date DEFAULT NULL,
  PRIMARY KEY (`NUMPROMOTION`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`NUMPROMOTION`, `TAUXREDUC`, `DATEDEBUT`, `DATEFIN`) VALUES
(1, 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

CREATE TABLE IF NOT EXISTS `rubrique` (
  `NUMRUBRIQUE` int(2) NOT NULL AUTO_INCREMENT,
  `NOMRUBRIQUE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`NUMRUBRIQUE`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `rubrique`
--

INSERT INTO `rubrique` (`NUMRUBRIQUE`, `NOMRUBRIQUE`) VALUES
(1, 'Avion'),
(2, 'Carburant');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

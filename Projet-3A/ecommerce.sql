-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 21 jan. 2021 à 16:00
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(250) NOT NULL,
  `description_produit` text NOT NULL,
  `image_produit` varchar(250) NOT NULL,
  `prix_produit` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `description_produit`, `image_produit`, `prix_produit`) VALUES
(1, 'Mac Book Air', 'Mac Book Air 15\"', 'img/macbook.jpg', '1199.99'),
(2, 'Horloge Vintage URSS', 'Horloge Vintage URSS\r\nSuperbe horloge russe des années 1980 en parfait état de marche. \r\nL’une de ses particularité, elle ne fait aucun bruit.\r\nQuelques traces du temps. Numérotée.', 'img/horloge.jpg', '100.00'),
(3, 'Mug Vintage CUBA', 'Mug Vintage CUBA\r\nUn mug qui vous donnera des envies de révolution...', 'img/mug.jpg', '14.99'),
(4, 'Cafetière italienne', 'Cafetière italienne, pour vous préparez un café de qualité', 'img/cafetiere.jpg', '29.99');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

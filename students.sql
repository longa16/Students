-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 10 déc. 2024 à 21:09
-- Version du serveur : 8.0.35
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `students`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `cours_id` int NOT NULL AUTO_INCREMENT,
  `cours_intitulé` varchar(25) NOT NULL,
  `cours_credits` int NOT NULL,
  PRIMARY KEY (`cours_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`cours_id`, `cours_intitulé`, `cours_credits`) VALUES
(1, 'Mathematiques', 6),
(2, 'Français', 4),
(4, 'Physique', 2),
(8, 'Informatique', 4);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `etu_id` int NOT NULL AUTO_INCREMENT,
  `etu_nom` varchar(25) NOT NULL,
  `etu_prenom` varchar(25) NOT NULL,
  `etu_date_naissance` date NOT NULL,
  PRIMARY KEY (`etu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`etu_id`, `etu_nom`, `etu_prenom`, `etu_date_naissance`) VALUES
(1, 'Yann', 'Ngassa', '2010-10-10'),
(3, 'Ismael', 'Naayif', '2010-06-16'),
(4, 'Sandrine', 'Ondo', '2013-06-01'),
(8, 'Billy', 'Milligan', '2013-10-17');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `inscription_id` int NOT NULL AUTO_INCREMENT,
  `etu_id` int NOT NULL,
  `cours_id` int NOT NULL,
  `note` float NOT NULL,
  PRIMARY KEY (`inscription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`inscription_id`, `etu_id`, `cours_id`, `note`) VALUES
(1, 1, 1, 15),
(29, 1, 2, 11),
(31, 3, 1, 10),
(32, 4, 1, 15);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_pseudo` varchar(25) NOT NULL,
  `user_mdp` varchar(145) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_pseudo`, `user_mdp`) VALUES
(3, 'admin@student.fr', 'f865b53623b121fd34ee5426c792e5c33af8c227');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

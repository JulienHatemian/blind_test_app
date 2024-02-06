-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 06 fév. 2024 à 05:19
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blindtest`
--
CREATE DATABASE IF NOT EXISTS `blindtest` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blindtest`;

-- --------------------------------------------------------

--
-- Structure de la table `gamemode`
--

DROP TABLE IF EXISTS `gamemode`;
CREATE TABLE IF NOT EXISTS `gamemode` (
  `idgamemode` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idgamemode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gamemode`
--

INSERT INTO `gamemode` (`idgamemode`, `libelle`, `active`) VALUES
(1, 'Classic', 0),
(2, 'Convention', 1);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `idgenre` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idgenre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`idgenre`, `libelle`, `filepath`, `active`) VALUES
(1, 'Anime', 'anime', 1),
(2, 'Video games', 'game', 1),
(4, 'Disney', 'disney', 0);

-- --------------------------------------------------------

--
-- Structure de la table `music`
--

DROP TABLE IF EXISTS `music`;
CREATE TABLE IF NOT EXISTS `music` (
  `idmusic` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link` longtext COLLATE utf8mb4_general_ci,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report` tinyint(1) NOT NULL DEFAULT '0',
  `idtype` int UNSIGNED NOT NULL,
  `idgenre` int UNSIGNED NOT NULL,
  `idserie` int UNSIGNED NOT NULL,
  PRIMARY KEY (`idmusic`),
  KEY `FK_TYPE_MUSIC` (`idtype`),
  KEY `FK_GENRE_MUSIC` (`idgenre`),
  KEY `FK_SERIE_MUSIC` (`idserie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `music`
--

INSERT INTO `music` (`idmusic`, `title`, `group`, `number`, `link`, `file`, `report`, `idtype`, `idgenre`, `idserie`) VALUES
(1, 'Idol', 'YOASOBI', 'Season 1 - OP 1', 'https://www.youtube.com/watch?v=PgBvV9ofjmA', NULL, 0, 1, 1, 1),
(2, 'Kien Romance', 'Akari Nanawo', 'Season 1 - OP 1', 'https://www.youtube.com/watch?v=VXEpLEK75V8', 'VXEpLEK75V8', 0, 1, 1, 2),
(3, 'Hana ni natte', 'Ryokuoushoku Shakai', 'Season 1 - OP 1', 'https://www.youtube.com/watch?v=z9JZB08qy44', 'z9JZB08qy44', 0, 1, 1, 3),
(4, 'Fight for the future', NULL, NULL, 'https://www.youtube.com/watch?v=5USJRH7RCpw', '5USJRH7RCpw', 0, 1, 2, 4),
(5, 'Itsu Aetara', 'Aiko', 'Season 1 - OP 1', 'https://www.youtube.com/watch?v=j0dQmivkJTw', 'j0dQmivkJTw', 0, 1, 1, 5),
(6, 'KICK BACK', 'Kenshi Yonezu', 'Season 1 - OP 1', 'https://www.youtube.com/watch?v=dFlDRhvM4L0', 'dFlDRhvM4L0', 0, 1, 1, 6),
(7, 'Shinda!', ' Oishi Masayoshi', 'Season 1 - OP 1', 'https://www.youtube.com/watch?v=z1VBlur77cI', 'z1VBlur77cI', 0, 1, 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

DROP TABLE IF EXISTS `serie`;
CREATE TABLE IF NOT EXISTS `serie` (
  `idserie` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `year` year NOT NULL,
  `studio` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idserie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `serie`
--

INSERT INTO `serie` (`idserie`, `libelle`, `year`, `studio`) VALUES
(1, 'Oshi no Ko', 2023, 'Doga Kobo'),
(2, 'Edomae Elf / Otaku Elf', 2023, 'C2C'),
(3, 'Kusuriya no Hitorigoto', 2023, 'OLM/TOHO animation STUDIO'),
(4, 'Dragon Ball Z: Shin Budokai 2', 2007, 'Namco Bandai'),
(5, 'Insomniacs after school', 2023, 'LIDENFILMS'),
(6, 'Chainsaw Man', 2022, 'MAPPA'),
(7, 'The legendary hero is dead', 2023, 'Liden Films');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `idtype` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtype`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`idtype`, `libelle`, `filepath`, `active`) VALUES
(1, 'Opening', 'opening', 1),
(2, 'Ending', 'ending', 1),
(3, 'OST', 'ost', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `FK_GENRE_MUSIC` FOREIGN KEY (`idgenre`) REFERENCES `genre` (`idgenre`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_SERIE_MUSIC` FOREIGN KEY (`idserie`) REFERENCES `serie` (`idserie`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_TYPE_MUSIC` FOREIGN KEY (`idtype`) REFERENCES `type` (`idtype`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

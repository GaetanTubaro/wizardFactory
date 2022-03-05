-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 04 mars 2022 à 15:52
-- Version du serveur : 8.0.26
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wizardfactory`
--

-- --------------------------------------------------------

--
-- Structure de la table `character_sheets`
--

CREATE TABLE `character_sheets` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `hpMax` int DEFAULT NULL,
  `currentHp` int DEFAULT NULL,
  `mpMax` int DEFAULT NULL,
  `currentMp` int DEFAULT NULL,
  `initiative` int NOT NULL,
  `strength` int DEFAULT NULL,
  `dexterity` int DEFAULT NULL,
  `constitution` int DEFAULT NULL,
  `intelligence` int DEFAULT NULL,
  `wisdom` int DEFAULT NULL,
  `luck` int DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `character_sheets`
--

INSERT INTO `character_sheets` (`id`, `name`, `hpMax`, `currentHp`, `mpMax`, `currentMp`, `initiative`, `strength`, `dexterity`, `constitution`, `intelligence`, `wisdom`, `luck`, `img`) VALUES
(2, 'test', 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 'src/blank-avatar.png'),
(3, 'uhuhu', 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 'src/blank-avatar.png'),
(6, 'unTest', 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 'src/blank-avatar.png'),
(8, 'Furman', 50, 50, 30, 10, 10, 10, 10, 10, 10, 10, 10, 'src/blank-avatar.png'),
(10, 'Clara', 9999, 9999, 9999, 999, 10, 10, 10, 10, 10, 10, 10, 'src/blank-avatar.png'),
(11, 'Dreeckan', 100, 100, 100, 100, 10, 10, 10, 10, 10, 10, 10, 'src/blank-avatar.png'),
(16, 'un joueur test', 100, 100, 50, 50, 10, 10, 10, 10, 10, 10, 10, 'src/blank-avatar.png');

-- --------------------------------------------------------

--
-- Structure de la table `dice_rolls`
--

CREATE TABLE `dice_rolls` (
  `id` int NOT NULL,
  `id_charac` int DEFAULT NULL,
  `id_game` int NOT NULL,
  `sides` int NOT NULL,
  `result` int NOT NULL,
  `date_roll` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `equipments`
--

CREATE TABLE `equipments` (
  `id` int NOT NULL,
  `name` varchar(75) NOT NULL,
  `range_area` int NOT NULL,
  `damages` int NOT NULL,
  `id_charac` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `equipments`
--

INSERT INTO `equipments` (`id`, `name`, `range_area`, `damages`, `id_charac`) VALUES
(4, 'Bouclier', 1, 0, NULL),
(5, 'Dague', 1, 1, NULL),
(6, 'Epée longue', 2, 2, NULL),
(7, 'Casque', 0, 0, NULL),
(8, 'Pavois dentelé', 1, 2, NULL),
(9, 'Arc court', 4, 3, NULL),
(10, 'Arbalète', 4, 4, NULL),
(12, 'couscoussière', 5, 99, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `id_mj` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `games`
--

INSERT INTO `games` (`id`, `name`, `id_mj`) VALUES
(1, 'La Couscousserie', 1),
(2, 'Le retour de Super Couscous', 1),
(4, 'La revanche du chevalier noir', 2),
(8, 'un game test', 9);

-- --------------------------------------------------------

--
-- Structure de la table `game_character`
--

CREATE TABLE `game_character` (
  `id_user` int DEFAULT NULL,
  `id_charac` int NOT NULL,
  `id_game` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `game_character`
--

INSERT INTO `game_character` (`id_user`, `id_charac`, `id_game`) VALUES
(NULL, 8, 2),
(1, 16, 8),
(2, 2, 2),
(8, 10, 1),
(9, 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `game_equipment`
--

CREATE TABLE `game_equipment` (
  `id_equipment` int NOT NULL,
  `id_game` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `game_equipment`
--

INSERT INTO `game_equipment` (`id_equipment`, `id_game`) VALUES
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Structure de la table `game_skill`
--

CREATE TABLE `game_skill` (
  `id_skill` int NOT NULL,
  `id_game` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `game_skill`
--

INSERT INTO `game_skill` (`id_skill`, `id_game`) VALUES
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

CREATE TABLE `skills` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `stats` varchar(50) DEFAULT NULL,
  `level` int NOT NULL,
  `id_charac` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `skills`
--

INSERT INTO `skills` (`id`, `name`, `stats`, `level`, `id_charac`) VALUES
(11, 'Rasengan', 'Dextérité', 5, NULL),
(12, 'Bash', 'Force', 1, NULL),
(13, 'Endure', 'Constitution', 3, NULL),
(14, 'Heal', 'Intelligence', 2, NULL),
(15, 'Vol', 'Chance', 4, NULL),
(16, 'Final Strike', 'Force', 5, NULL),
(17, 'Arc lightning', 'Intelligence', 2, NULL),
(18, 'Cyclone ', 'Dextérité', 5, NULL),
(19, 'Brave Song', 'Sagesse', 3, NULL),
(20, 'Repulse', 'Sagesse', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`) VALUES
(1, 'Gaetan', 'root'),
(2, 'test', 'root'),
(3, 'test2', 'root'),
(4, 'test3', 't'),
(5, 'Jean', 'root'),
(6, 'The_Black_Knight', 'root'),
(7, 'Roger', 'root'),
(8, 'Ekki', 'root'),
(9, 'Abdel', 'Mekouy'),
(10, 'Shiryoa', 'root'),
(11, 'Keider', 'root'),
(12, 'Geraldine', 'root');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `character_sheets`
--
ALTER TABLE `character_sheets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dice_rolls`
--
ALTER TABLE `dice_rolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_charac`),
  ADD KEY `id_game` (`id_game`);

--
-- Index pour la table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_1` (`id_charac`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_1` (`id_mj`);

--
-- Index pour la table `game_character`
--
ALTER TABLE `game_character`
  ADD PRIMARY KEY (`id_charac`,`id_game`) USING BTREE,
  ADD KEY `id_1` (`id_charac`),
  ADD KEY `id_2` (`id_game`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `game_equipment`
--
ALTER TABLE `game_equipment`
  ADD PRIMARY KEY (`id_equipment`,`id_game`),
  ADD KEY `id_1` (`id_game`);

--
-- Index pour la table `game_skill`
--
ALTER TABLE `game_skill`
  ADD PRIMARY KEY (`id_skill`,`id_game`),
  ADD KEY `id_1` (`id_game`);

--
-- Index pour la table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_1` (`id_charac`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `character_sheets`
--
ALTER TABLE `character_sheets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `dice_rolls`
--
ALTER TABLE `dice_rolls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dice_rolls`
--
ALTER TABLE `dice_rolls`
  ADD CONSTRAINT `dice_rolls_ibfk_1` FOREIGN KEY (`id_charac`) REFERENCES `character_sheets` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `dice_rolls_ibfk_2` FOREIGN KEY (`id_game`) REFERENCES `games` (`id`);

--
-- Contraintes pour la table `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `equipments_ibfk_1` FOREIGN KEY (`id_charac`) REFERENCES `character_sheets` (`id`);

--
-- Contraintes pour la table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`id_mj`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `game_character`
--
ALTER TABLE `game_character`
  ADD CONSTRAINT `game_character_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `game_character_ibfk_2` FOREIGN KEY (`id_charac`) REFERENCES `character_sheets` (`id`),
  ADD CONSTRAINT `game_character_ibfk_3` FOREIGN KEY (`id_game`) REFERENCES `games` (`id`);

--
-- Contraintes pour la table `game_equipment`
--
ALTER TABLE `game_equipment`
  ADD CONSTRAINT `game_equipment_ibfk_1` FOREIGN KEY (`id_equipment`) REFERENCES `equipments` (`id`),
  ADD CONSTRAINT `game_equipment_ibfk_2` FOREIGN KEY (`id_game`) REFERENCES `games` (`id`);

--
-- Contraintes pour la table `game_skill`
--
ALTER TABLE `game_skill`
  ADD CONSTRAINT `game_skill_ibfk_1` FOREIGN KEY (`id_skill`) REFERENCES `skills` (`id`),
  ADD CONSTRAINT `game_skill_ibfk_2` FOREIGN KEY (`id_game`) REFERENCES `games` (`id`);

--
-- Contraintes pour la table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`id_charac`) REFERENCES `character_sheets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

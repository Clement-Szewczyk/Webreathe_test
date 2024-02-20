-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 20 fév. 2024 à 14:51
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `webreath`
--

-- --------------------------------------------------------

--
-- Structure de la table `historique_etat`
--

CREATE TABLE `historique_etat` (
  `ID` int NOT NULL,
  `Etat` int NOT NULL,
  `date` datetime NOT NULL,
  `Module` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `historique_etat`
--

INSERT INTO `historique_etat` (`ID`, `Etat`, `date`, `Module`) VALUES
(1, 0, '2024-02-20 14:49:57', 5),
(2, 1, '2024-02-20 14:50:05', 5),
(3, 0, '2024-02-20 14:50:07', 5),
(4, 1, '2024-02-20 14:50:11', 5),
(5, 2, '2024-02-20 14:50:12', 5),
(6, 1, '2024-02-20 14:50:20', 5);

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `ID` int NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Etat` int NOT NULL,
  `description` text NOT NULL,
  `valeur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`ID`, `Nom`, `Etat`, `description`, `valeur`) VALUES
(5, 'Passager', 1, 'Module qui compte le nombre de passager dans un bus par exemple.', 'nombre_passager');

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `id` int UNSIGNED NOT NULL,
  `nombre_passager` int NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `passager`
--

INSERT INTO `passager` (`id`, `nombre_passager`, `date`) VALUES
(1, 50, '2024-02-18 10:41:18'),
(2, 10, '2024-02-18 10:41:18'),
(3, 40, '2024-02-18 10:41:18'),
(4, 43, '2024-02-18 10:41:18'),
(5, 18, '2024-02-18 10:41:18'),
(6, 44, '2024-02-18 10:45:25'),
(7, 6, '2024-02-18 10:45:25'),
(8, 4, '2024-02-18 10:45:25'),
(9, 4, '2024-02-18 14:17:27'),
(10, 12, '2024-02-18 14:17:27'),
(11, 4, '2024-02-18 14:17:27'),
(12, 8, '2024-02-18 14:17:27'),
(13, 12, '2024-02-18 14:17:27'),
(14, 14, '2024-02-18 14:17:27'),
(15, 38, '2024-02-19 09:10:49'),
(16, 6, '2024-02-19 09:10:49'),
(17, 1, '2024-02-19 09:10:49'),
(18, 15, '2024-02-19 09:10:49');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `ID` int NOT NULL,
  `MDP` varchar(255) NOT NULL,
  `Login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`ID`, `MDP`, `Login`) VALUES
(4, '$2y$10$YRtQui0JY40jFwNStLV0tOiCwnKELLkBZ2zwYecDn7s0kUuayPcrq', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `historique_etat`
--
ALTER TABLE `historique_etat`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `module` (`Module`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `passager`
--
ALTER TABLE `passager`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `historique_etat`
--
ALTER TABLE `historique_etat`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `passager`
--
ALTER TABLE `passager`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `historique_etat`
--
ALTER TABLE `historique_etat`
  ADD CONSTRAINT `module` FOREIGN KEY (`Module`) REFERENCES `module` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

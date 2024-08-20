-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 02 août 2024 à 14:46
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `ida` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `prixunitaire` decimal(10,2) NOT NULL,
  `qtestock` int(11) NOT NULL,
  `reference` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`ida`, `libelle`, `prixunitaire`, `qtestock`, `reference`) VALUES
(1, 'Sac de Riz ', 20000.00, 20, 'ART456'),
(2, 'Huile ', 7500.00, 50, 'ART789');

-- --------------------------------------------------------

--
-- Structure de la table `boutiquier`
--

CREATE TABLE `boutiquier` (
  `idb` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `boutiquier`
--

INSERT INTO `boutiquier` (`idb`, `nom`, `prenom`, `telephone`) VALUES
(1, 'Diop', 'Awa', '221772345678'),
(2, 'Ndiaye', 'Moussa', '221773456789');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idcat` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idcat`, `libelle`) VALUES
(1, 'nouveau'),
(2, 'fidele'),
(3, 'non solvant'),
(4, 'solvant');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idclient` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `photo` blob DEFAULT NULL,
  `telephone` varchar(20) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `idb` int(11) DEFAULT NULL,
  `idcat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idclient`, `nom`, `prenom`, `photo`, `telephone`, `adresse`, `email`, `idb`, `idcat`) VALUES
(1, 'Ba', 'Fatou', NULL, '221774567890', 'Dakar', 'fatou.ba@example.com', 1, 1),
(2, 'Sow', 'Ibrahima', NULL, '221775678901', 'Thiès', 'ibrahima.sow@example.com', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

CREATE TABLE `depot` (
  `iddepot` int(11) NOT NULL,
  `datedepot` date NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `idclient` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`iddepot`, `datedepot`, `montant`, `idclient`) VALUES
(1, '2024-01-15', 50000.00, 1),
(2, '2024-02-20', 75000.00, 2);

-- --------------------------------------------------------

--
-- Structure de la table `dette`
--

CREATE TABLE `dette` (
  `iddet` int(11) NOT NULL,
  `dated` date NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `idclient` int(11) DEFAULT NULL,
  `idetat` int(11) DEFAULT NULL,
  `idb` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dette`
--

INSERT INTO `dette` (`iddet`, `dated`, `montant`, `numero`, `idclient`, `idetat`, `idb`) VALUES
(1, '2024-03-10', 100000.00, 'DET123', 1, 1, 1),
(2, '2024-04-05', 150000.00, 'DET456', 2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `dettearticle`
--

CREATE TABLE `dettearticle` (
  `iddet` int(11) NOT NULL,
  `ida` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dettearticle`
--

INSERT INTO `dettearticle` (`iddet`, `ida`, `quantite`) VALUES
(1, 1, 2),
(2, 2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `idetat` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`idetat`, `libelle`) VALUES
(1, 'solvant'),
(2, 'non solvant');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `idp` int(11) NOT NULL,
  `datep` date NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `iddet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`idp`, `datep`, `montant`, `reference`, `iddet`) VALUES
(1, '2024-03-20', 50000.00, 'PAY123', 1),
(2, '2024-04-15', 100000.00, 'PAY456', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`ida`);

--
-- Index pour la table `boutiquier`
--
ALTER TABLE `boutiquier`
  ADD PRIMARY KEY (`idb`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idcat`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idclient`),
  ADD KEY `idb` (`idb`),
  ADD KEY `idcat` (`idcat`);

--
-- Index pour la table `depot`
--
ALTER TABLE `depot`
  ADD PRIMARY KEY (`iddepot`),
  ADD KEY `idclient` (`idclient`);

--
-- Index pour la table `dette`
--
ALTER TABLE `dette`
  ADD PRIMARY KEY (`iddet`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `idetat` (`idetat`),
  ADD KEY `idb` (`idb`);

--
-- Index pour la table `dettearticle`
--
ALTER TABLE `dettearticle`
  ADD PRIMARY KEY (`iddet`,`ida`),
  ADD KEY `ida` (`ida`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`idetat`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`idp`),
  ADD KEY `iddet` (`iddet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `ida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `boutiquier`
--
ALTER TABLE `boutiquier`
  MODIFY `idb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idcat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idclient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `depot`
--
ALTER TABLE `depot`
  MODIFY `iddepot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `dette`
--
ALTER TABLE `dette`
  MODIFY `iddet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `idetat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`idb`) REFERENCES `boutiquier` (`idb`),
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`idcat`) REFERENCES `categorie` (`idcat`);

--
-- Contraintes pour la table `depot`
--
ALTER TABLE `depot`
  ADD CONSTRAINT `depot_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`);

--
-- Contraintes pour la table `dette`
--
ALTER TABLE `dette`
  ADD CONSTRAINT `dette_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`),
  ADD CONSTRAINT `dette_ibfk_2` FOREIGN KEY (`idetat`) REFERENCES `etat` (`idetat`),
  ADD CONSTRAINT `dette_ibfk_3` FOREIGN KEY (`idb`) REFERENCES `boutiquier` (`idb`);

--
-- Contraintes pour la table `dettearticle`
--
ALTER TABLE `dettearticle`
  ADD CONSTRAINT `dettearticle_ibfk_1` FOREIGN KEY (`iddet`) REFERENCES `dette` (`iddet`),
  ADD CONSTRAINT `dettearticle_ibfk_2` FOREIGN KEY (`ida`) REFERENCES `article` (`ida`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`iddet`) REFERENCES `dette` (`iddet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

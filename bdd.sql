-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 08 avr. 2021 à 23:22
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `appli_ecole`
--

-- --------------------------------------------------------

--
-- Structure de la table `bde`
--

CREATE TABLE `bde` (
  `id` int(11) NOT NULL,
  `intituleEvenement` varchar(50) NOT NULL,
  `dateEvenement` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `emploiDuTemps`
--

CREATE TABLE `emploiDuTemps` (
  `id` int(11) NOT NULL,
  `matiere` varchar(50) NOT NULL,
  `salle` int(11) NOT NULL,
  `dates` date NOT NULL,
  `HeureDebut` varchar(50) NOT NULL,
  `HeureFin` varchar(50) NOT NULL,
  `formation` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `intituleFormation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `intituleFormation`) VALUES
(1, 'Bachelor 1'),
(2, 'Bachelor 2'),
(999, 'Personelle'),
(1001, 'Test');

-- --------------------------------------------------------

--
-- Structure de la table `infoEcole`
--

CREATE TABLE `infoEcole` (
  `id` int(11) NOT NULL,
  `intituleEvenement` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `matiere` varchar(50) NOT NULL,
  `note` varchar(50) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  `motDePasse` varchar(70) NOT NULL,
  `adresseMail` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  `numeroRue` int(11) NOT NULL,
  `rue` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `codePostale` int(11) NOT NULL,
  `id_formation` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `identifiant`, `motDePasse`, `adresseMail`, `nom`, `prenom`, `dateNaissance`, `numeroRue`, `rue`, `ville`, `codePostale`, `id_formation`, `role`) VALUES
(4, 'gurak.n', '$2y$10$lbfvdHxxG/wk5m14pY7thu/P57KxDAehN2gPJhQjjtA4uIpxl2l1a', 'nicolasgurak@gmail.com', 'gurak', 'nicolas', '1999-09-15', 50, 'rue des venelles', 'Rennes', 35000, 1, 3),
(15, 'admin2', '$2y$10$xUwP.fBjm1idZMSE6R8nq.XLkgDHa6iNLPaDQwpln5PqkEhbzKn/K', 'nicolasmaheesaip@gmail.com', 'admin2', 'admin2', '2021-04-06', 12, 'rue de la fete', 'rennes', 35760, 999, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bde`
--
ALTER TABLE `bde`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `emploiDuTemps`
--
ALTER TABLE `emploiDuTemps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_formation` (`formation`),
  ADD KEY `fk_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `infoEcole`
--
ALTER TABLE `infoEcole`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_utilisateur_FK` (`id_utilisateur`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `note_utilisateur_FK` (`id_utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_formation_FK` (`id_formation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bde`
--
ALTER TABLE `bde`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `emploiDuTemps`
--
ALTER TABLE `emploiDuTemps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT pour la table `infoEcole`
--
ALTER TABLE `infoEcole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emploiDuTemps`
--
ALTER TABLE `emploiDuTemps`
  ADD CONSTRAINT `fk_formation` FOREIGN KEY (`formation`) REFERENCES `formation` (`id`),
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_formation_FK` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id`);

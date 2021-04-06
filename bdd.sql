-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 06 avr. 2021 à 20:01
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
  `date` date NOT NULL,
  `HeureDebut` varchar(50) NOT NULL,
  `HeureFin` varchar(50) NOT NULL,
  `formation` int(11) NOT NULL
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
(2, 'Bahcelor 2'),
(999, 'Personelle');

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
(1, 'utilisateur1', '$2y$10$dDjHdAbq.yj04/1bulNHsuHNgSEEGHoXCltIs8BxRC9EHrQbgKXBm', 'nicolasgurak2@gmail.com', 'Gurak', 'Nicolas', '1999-09-15', 54, 'rue', 'PacÃ©', 35740, 2, 3),
(2, 'jjnknnl', 'jnljn', 'nhbh@gmail.com', 'hbljbhb', 'hjbb', '2021-01-05', 9, 'hjbh', 'hb', 9999, 2, 2),
(3, 'dsqfdsf', 'dsqdqsddqsdqs', 'fsdfdsfds@gamil.com', 'fsdfs', 'dqsdqsd', '1222-12-12', 50, 'sdfdsf', 'fdsfs', 0, 999, 2),
(4, 'gurak.n', '$2y$10$dDjHdAbq.yj04/1bulNHsuHNgSEEGHoXCltIs8BxRC9EHrQbgKXBm', 'nicolasgurak@gmail.com', 'gurak', 'nicolas', '1999-09-15', 50, 'des venelles', 'Rennes', 35000, 2, 3),
(5, 'qsdqsd', 'dsqdqsdsqdqs', 'dqdqsdq@gmail.com', 'qsdqsd', 'dqsdqs', '1999-09-15', 0, 'dsqdqs', 'sdqs', 0, 1, 1),
(6, 'dqsdsq', 'dqsdsqdfdsdsf', 'dqsdqs@gmail.com', 'dqsdsqd', 'dsqdsqqdsdqsdqs', '2021-02-11', 0, 'fdsfds', 'fdsfsd', 0, 999, 5),
(7, 'dqsdsqd', 'dsfsdfdsfdsfsdf', 'dsqdsqd@fdsf', 'gdfgdfg', 'sqdsqdqssqd', '2012-05-12', 0, 'fdsfsdf', 'dfhgdghfdh', 0, 2, 4),
(8, 'test', 'test12345', 'test@gmail.com', 'test', 'test', '1999-09-15', 10, 'rue', 'rennes', 35740, 1, 3),
(9, '5555555', '$2y$10$R4l1AWuYM8meF88BQdgtL.j8YTg6wHkN0pZibYCwjZfiDpGejNIVu', 'dqsdqd@gmail.com', 'sqdqs', 'qsdsqd', '2000-12-12', 50, '50', '50', 35410, 2, 4),
(10, 'mahe', '$2y$10$se65BMtjP2QA8fQQgsblh.o22rXgOgYncwRjqYeo/JSt3lUGO8YQ.', 'dsqdsq@gmail.com', 'sqdqsddqsd', 'dsqdqs', '1222-12-12', 1212, '121', '12', 12345, 999, 1),
(11, 'admin', '$2y$10$X62m/mDtcP5fsDicUq.TbuRg4pkJUF.FFjlWp8hr6Id1PqE9SPAKS', 'admin@gmail.com', 'admin', 'admin', '1999-09-15', 12, 'rue', 'rennes', 35740, 999, 1),
(12, 'aze', '$2y$10$CtPTlrpMFt4t90wIEx7FSeQ9bsrfu4mkvOZxRe1LS7TSDnhUe/wwe', 'aer@aze.com', 'aze', 'aze', '1999-09-15', 12, 'sdsq', 'dsqd', 31123, 2, 3),
(13, 'aze', '$2y$10$GBiqLtwetUVI3RVrc5neFOv.Mb05E1VNzQFitRz7vpFryPVht1g1.', 'aer@aze.com', 'aze', 'aze', '1999-09-15', 12, 'sdsq', 'dsqd', 31123, 2, 3),
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
  ADD KEY `fk_formation` (`formation`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT pour la table `infoEcole`
--
ALTER TABLE `infoEcole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emploiDuTemps`
--
ALTER TABLE `emploiDuTemps`
  ADD CONSTRAINT `fk_formation` FOREIGN KEY (`formation`) REFERENCES `formation` (`id`);

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

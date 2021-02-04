-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 04, 2021 at 10:53 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `appli_ecole`
--

-- --------------------------------------------------------

--
-- Table structure for table `bde`
--

CREATE TABLE `bde` (
  `id` int(11) NOT NULL,
  `intituleEvenement` varchar(50) NOT NULL,
  `dateEvenement` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emploiDuTemps`
--

CREATE TABLE `emploiDuTemps` (
  `id` int(11) NOT NULL,
  `matiere` varchar(50) NOT NULL,
  `salle` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `intituleFormation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formation`
--

INSERT INTO `formation` (`id`, `intituleFormation`) VALUES
(1, 'Bachelor 1'),
(2, 'Bahcelor 2');

-- --------------------------------------------------------

--
-- Table structure for table `infoEcole`
--

CREATE TABLE `infoEcole` (
  `id` int(11) NOT NULL,
  `intituleEvenement` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `infoEcole`
--

INSERT INTO `infoEcole` (`id`, `intituleEvenement`, `date`) VALUES
(1, 'Porte ouverte', '2021-02-05'),
(2, 'jsp7', '2021-03-04'),
(3, 'dqdqsdsq', '2021-02-18');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message` varchar(50) NOT NULL,
  `createdAt` date NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `matiere` varchar(50) NOT NULL,
  `note` varchar(50) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `matiere`, `note`, `id_utilisateur`) VALUES
(12, 'dsqdsqd', '10', 1),
(13, 'francais', '12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  `motDePasse` varchar(50) NOT NULL,
  `adresseMail` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  `numeroRue` int(11) NOT NULL,
  `rue` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `codePostale` int(11) NOT NULL,
  `id_formation` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `identifiant`, `motDePasse`, `adresseMail`, `nom`, `prenom`, `dateNaissance`, `numeroRue`, `rue`, `ville`, `codePostale`, `id_formation`, `role`) VALUES
(1, 'utilisateur1', 'test', 'nicolasgurak@gmail.com', 'Gurak', 'Nicolas', '1999-09-15', 54, 'rue', 'Pacé', 35740, 1, 4),
(2, 'jjnknnl', 'jnljn', 'nhbh@gmail.com', 'hbljbhb', 'hjbb', '2021-01-05', 9, 'hjbh', 'hb', 9999, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bde`
--
ALTER TABLE `bde`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emploiDuTemps`
--
ALTER TABLE `emploiDuTemps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infoEcole`
--
ALTER TABLE `infoEcole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_utilisateur_FK` (`id_utilisateur`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `note_utilisateur_FK` (`id_utilisateur`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_formation_FK` (`id_formation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bde`
--
ALTER TABLE `bde`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emploiDuTemps`
--
ALTER TABLE `emploiDuTemps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `infoEcole`
--
ALTER TABLE `infoEcole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_utilisateur_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_formation_FK` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id`);

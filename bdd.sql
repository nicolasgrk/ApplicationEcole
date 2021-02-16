-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 16, 2021 at 02:24 PM
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

--
-- Dumping data for table `bde`
--

INSERT INTO `bde` (`id`, `intituleEvenement`, `dateEvenement`) VALUES
(2, 'Pain au cho', '2021-02-13'),
(3, 'dqsdsqd', '2021-02-12'),
(4, 'dqsdsqdqdqsd', '2021-02-13'),
(5, 'dqsdsqdsq', '2021-02-21'),
(6, 'dsqdsqdd', '2021-02-14'),
(7, 'dsfsdfdsfds', '2021-02-06'),
(8, 'sfdfsdfdsf', '2021-02-27'),
(9, 'gfgfdgfdg', '2021-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `emploiDuTemps`
--

CREATE TABLE `emploiDuTemps` (
  `id` int(11) NOT NULL,
  `matiere` varchar(50) NOT NULL,
  `salle` int(11) NOT NULL,
  `date` date NOT NULL,
  `formation` int(11) NOT NULL
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
(2, 'Bahcelor 2'),
(999, 'Personelle');

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
(1, 'Porte ouverte555', '2021-02-05'),
(2, 'jsp7', '2021-03-04'),
(3, 'dqdqsdsq', '2021-02-18'),
(4, 'porte ouverte 2', '1999-09-15'),
(6, 'Pain au chocolat', '1999-09-15'),
(7, 'Pain au chocolat', '1999-09-15'),
(8, 'dddsdqsdq', '2021-02-24'),
(9, 'dsqdqsd', '2021-02-25'),
(10, 'dfsdfdsfdsfdsfdsf', '2021-03-11'),
(11, 'dsfsdf', '2021-03-12');

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
(13, 'francais', '12', 2),
(15, 'dqsdq', '20', 2),
(16, 'xwcwxcwx', '50', 2);

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
  `id_formation` int(11) DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `identifiant`, `motDePasse`, `adresseMail`, `nom`, `prenom`, `dateNaissance`, `numeroRue`, `rue`, `ville`, `codePostale`, `id_formation`, `role`) VALUES
(1, 'utilisateur1', 'test', 'nicolasgurak@gmail.com', 'Gurak', 'Nicolas', '1999-09-15', 54, 'rue', 'Pacé', 35740, 1, 4),
(2, 'jjnknnl', 'jnljn', 'nhbh@gmail.com', 'hbljbhb', 'hjbb', '2021-01-05', 9, 'hjbh', 'hb', 9999, 2, 2),
(3, 'dsqfdsf', 'dsqdqsddqsdqs', 'fsdfdsfds@gamil.com', 'fsdfs', 'dqsdqsd', '1222-12-12', 50, 'sdfdsf', 'fdsfs', 0, 999, 2),
(4, 'gurak.n', 'testnico', 'nicolasgurak@gmail.com', 'gurak', 'nicolas', '1999-09-15', 50, 'des venelles', 'Rennes', 35000, 999, 1),
(5, 'qsdqsd', 'dsqdqsdsqdqs', 'dqdqsdq@gmail.com', 'qsdqsd', 'dqsdqs', '1999-09-15', 0, 'dsqdqs', 'sdqs', 0, 1, 1),
(6, 'dqsdsq', 'dqsdsqdfdsdsf', 'dqsdqs@gmail.com', 'dqsdsqd', 'dsqdsqqdsdqsdqs', '2021-02-11', 0, 'fdsfds', 'fdsfsd', 0, 999, 5),
(7, 'dqsdsqd', 'dsfsdfdsfdsfsdf', 'dsqdsqd@fdsf', 'gdfgdfg', 'sqdsqdqssqd', '2012-05-12', 0, 'fdsfsdf', 'dfhgdghfdh', 0, 2, 4);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_formation` (`formation`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `emploiDuTemps`
--
ALTER TABLE `emploiDuTemps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `infoEcole`
--
ALTER TABLE `infoEcole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `emploiDuTemps`
--
ALTER TABLE `emploiDuTemps`
  ADD CONSTRAINT `fk_formation` FOREIGN KEY (`formation`) REFERENCES `formation` (`id`);

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

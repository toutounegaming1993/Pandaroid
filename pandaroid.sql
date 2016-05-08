-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 03 Mai 2016 à 22:20
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pandaroid`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Nombre de Photos` int(11) NOT NULL,
  `Photos` text NOT NULL,
  `Filtre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `amis_id` int(11) NOT NULL,
  `Status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `amis`
--

INSERT INTO `amis` (`id`, `utilisateur_id`, `amis_id`, `Status`) VALUES
(1, 1, 1, '2'),
(2, 2, 2, '2');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Nombre de membres` int(11) NOT NULL,
  `Membres` text NOT NULL,
  `Admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `email`, `mdp`) VALUES
(1, 'Duhesme', 'Antoine', 'duhesme.antoine@gmail.com', '29121993'),
(2, 'Duhesme', 'Laure', 'laure.duhesme@gmail.com', '080887');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Lieu` varchar(255) NOT NULL,
  `Proprietaire` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`id`, `Nom`, `Lieu`, `Proprietaire`, `Date`) VALUES
(1, '160428060336.PNG', 'Paris', 1, '2016-04-28'),
(2, '160428072940.PNG', 'Paris', 1, '2016-04-28'),
(3, '160428081941.PNG', 'Paris', 1, '2016-04-28'),
(4, '160428093655.PNG', 'Paris', 1, '2016-04-28'),
(5, '160428100955.PNG', 'Ton cul', 2, '2016-04-28'),
(6, '160428110408.PNG', 'Ton cul', 2, '2016-04-28'),
(7, '160428110646.jpg', 'Civil War', 2, '2016-04-28'),
(8, '160430034147.PNG', 'zr', 1, '2016-04-30'),
(9, '160430034157.jpg', 'aze', 1, '2016-04-30'),
(10, '160430034347.PNG', 'gj', 1, '2016-04-30'),
(11, '160430034435.jpg', 'sf', 1, '2016-04-30'),
(12, '160430034500.jpg', 'fh', 1, '2016-04-30'),
(13, '160430035319.jpg', 'fh', 1, '2016-04-30'),
(14, '160430035412.jpg', 'fh', 1, '2016-04-30'),
(15, '160430035442.jpg', 'fh', 1, '2016-04-30'),
(16, '160430035531.jpg', 'fh', 1, '2016-04-30'),
(17, '160430035553.jpg', 'qd', 1, '2016-04-30'),
(18, '160430040408.jpg', 'azaz', 1, '2016-04-30'),
(19, '160430040449.jpg', 'azaz', 1, '2016-04-30'),
(20, '160430040505.jpg', 'ed', 1, '2016-04-30'),
(21, '160430040531.jpg', 'ed', 1, '2016-04-30'),
(22, '160430040537.jpg', 'ae', 1, '2016-04-30'),
(23, '160430040636.jpg', 'ae', 1, '2016-04-30'),
(24, '160430041606.jpg', 'ae', 1, '2016-04-30'),
(25, '160430041624.jpg', 'qdsqds', 1, '2016-04-30'),
(26, '160430041647.jpg', 'qdqd', 1, '2016-04-30'),
(27, '160430041842.jpg', 'qdqd', 1, '2016-04-30'),
(28, '160430041852.jpg', 'qdqd', 1, '2016-04-30'),
(29, '160430041858.jpg', 'qs', 1, '2016-04-30'),
(30, '160503070531.PNG', 'qd', 1, '2016-05-03');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

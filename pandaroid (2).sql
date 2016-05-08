-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 08 Mai 2016 à 15:30
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
  `membre1_id` int(11) NOT NULL,
  `membre2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `mdp` varchar(255) NOT NULL,
  `admin` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `email`, `mdp`, `admin`) VALUES
(1, 'Duhesme', 'Antoine', 'duhesme.antoine@gmail.com', '6634ce5b34f4123955fbcdc56813b0b05221b785', '1');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Lieu` varchar(255) NOT NULL,
  `Proprietaire` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `publique` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`id`, `Nom`, `Titre`, `Lieu`, `Proprietaire`, `Date`, `publique`) VALUES
(9, '160508051615.jpg', 'coucou', 'coucou', 1, '2016-05-08 05:16:15', '0'),
(10, '160508051844.jpg', 'Borderlands', 'Paris', 1, '2016-05-08 05:18:44', '0'),
(11, '160508051913.jpg', 'aaze', 'aa', 1, '2016-05-08 05:19:13', '0');

-- --------------------------------------------------------

--
-- Structure de la table `req_amis`
--

CREATE TABLE `req_amis` (
  `id` int(11) NOT NULL,
  `demandeur` int(11) NOT NULL,
  `recepteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `membre1_id` (`membre1_id`,`membre2_id`),
  ADD KEY `membre2_id` (`membre2_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `Proprietaire` (`Proprietaire`);

--
-- Index pour la table `req_amis`
--
ALTER TABLE `req_amis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demandeur` (`demandeur`,`recepteur`),
  ADD KEY `recepteur` (`recepteur`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `req_amis`
--
ALTER TABLE `req_amis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `amis_ibfk_1` FOREIGN KEY (`membre1_id`) REFERENCES `membre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `amis_ibfk_2` FOREIGN KEY (`membre2_id`) REFERENCES `membre` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`Proprietaire`) REFERENCES `membre` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `req_amis`
--
ALTER TABLE `req_amis`
  ADD CONSTRAINT `req_amis_ibfk_1` FOREIGN KEY (`demandeur`) REFERENCES `membre` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `req_amis_ibfk_2` FOREIGN KEY (`recepteur`) REFERENCES `membre` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

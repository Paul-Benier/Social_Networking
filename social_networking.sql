-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 09 déc. 2021 à 23:30
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `social_networking`
--

-- --------------------------------------------------------

--
-- Structure de la table `private_post`
--

CREATE TABLE `private_post` (
  `privatepost_id` int(11) NOT NULL,
  `userfrom_id` int(11) NOT NULL,
  `userto_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` varchar(512) NOT NULL,
  `file_name` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `private_post`
--

INSERT INTO `private_post` (`privatepost_id`, `userfrom_id`, `userto_id`, `date`, `title`, `content`, `file_name`) VALUES
(1, 0, 1, '2021-12-09 19:02:48', 'Here is the first test', 'This is a test', NULL),
(2, 0, 3, '2021-12-09 19:28:16', 'Great!', 'It works!!', NULL),
(3, 0, 5, '2021-12-09 19:28:47', 'Hello', 'Hello, Hello!', NULL),
(4, 0, 1, '2021-12-09 20:42:08', 'phpMyAdmin', 'phpMyAdmin is working very well!!', NULL),
(5, 5, 2, '2021-12-09 20:42:13', 'Hello', 'It\'s me!', NULL),
(6, 5, 0, '2021-12-09 20:42:25', 'Hello', 'Hello Maël! How are you ?', NULL),
(7, 1, 0, '2021-12-09 21:08:53', 'Yes!', 'We are too strong!!!', NULL),
(8, 0, 2, '2021-12-09 22:05:40', 'Hello', 'How are you Huiting ?', NULL),
(9, 0, 4, '2021-12-09 22:30:09', 'Joke', 'Hello Desmond! \r\nDes pas si tôt! \r\nIt\'s French for \"Des not too early\" and when you read it, it\'s the same pronunciation as the song Despacito!\r\nVery funny, isn\'t it?', NULL),
(10, 4, 0, '2021-12-09 22:31:11', 'Re-Joke', 'Haha! Yes, it\'s a bit funny!!', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `public_post`
--

CREATE TABLE `public_post` (
  `publicpost_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` varchar(512) NOT NULL,
  `file_name` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `public_post`
--

INSERT INTO `public_post` (`publicpost_id`, `user_id`, `date`, `title`, `content`, `file_name`) VALUES
(1, 0, '2021-12-08 15:20:02', 'First post', 'This is the first post', NULL),
(2, 4, '2021-12-09 13:32:07', 'Congratulation', 'Better late than never!', NULL),
(3, 4, '2021-12-09 13:59:58', 'Staffordshire University', 'Staffordshire University is a public research university in Staffordshire, England. It has one main campus based in the city of Stoke-on-Trent and three other campuses; in Stafford, Lichfield and Shrewsbury.', NULL),
(4, 0, '2021-12-09 14:23:24', 'Efrei Paris', 'The EFREI (École d\'ingénieur généraliste en informatique et technologies du numérique) (Engineering School of Information and Digital Technologies) is a French private engineering school located in Villejuif, Île-de-France, at the south of Paris. Its courses, specializing in computer science and management, are taught with support from the state.', NULL),
(5, 0, '2021-12-09 14:26:52', 'Efrei Paris', 'Students who graduate earn an engineering degree accredited by the CTI (national commission for engineering degree accreditation). The degree is equivalent to a master\'s degree in the European higher education area. Today, there are more than 6,500 EFREI graduates working in companies dealing with many different activities: education, human resources development, business/marketing, company management, legal advice and so on.', NULL),
(6, 1, '2021-12-09 14:27:00', 'Impressive!', 'This is really interesting!!!', NULL),
(7, 0, '2021-12-09 15:50:15', 'Grade', 'Hello Sir, what grade will you give us?', NULL),
(8, 4, '2021-12-09 21:23:14', 'Re-Grade', 'I\'ll give you all the points, which is 100%.', NULL),
(9, 0, '2021-12-09 21:56:10', 'Thanks', 'Thank you!!', NULL),
(10, 1, '2021-12-09 22:30:37', 'Very cool !!', 'Thanks Mr!', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `relationships`
--

CREATE TABLE `relationships` (
  `relationship_id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relationships`
--

INSERT INTO `relationships` (`relationship_id`, `user_1`, `user_2`, `active`) VALUES
(1, 0, 1, 1),
(2, 4, 0, 0),
(3, 0, 2, 1),
(4, 0, 3, 0),
(5, 1, 2, 1),
(7, 4, 1, 1),
(8, 5, 4, 1),
(9, 2, 4, 1),
(10, 4, 3, 1),
(11, 3, 5, 0),
(12, 0, 5, 1),
(13, 5, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `birthday` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `birthday`) VALUES
(0, 'Paul', 'BENIER', 'paul.benier@efrei.net', '$2y$10$m9t32z.oghg9ZD8CshSFbeexuPoyY3tufFhA7cwREVYEWrPGB5aRy', 2001),
(1, 'Séverine', 'BENIER', 'severine.benier@efrei.net', '$2y$10$4BQeQHGrdZT40z3qo0tr3eN5144StnS9b4TWIwGw7CJtXPMMuO0YO', 2000),
(2, 'Huiting', 'FENG', 'huiting.feng@efrei.net', '$2y$10$yrcVC4jM5WAA76aUqrBm/ebw3sn8Iabj3QvIsoxMVRF5l1IuUUata', 2001),
(3, 'Logan', 'LE LAY', 'logan.le.lay@efrei.net', '$2y$10$OWSpHSYx9EYKggjJMpJ53eHSAuUhk9KcBAi9aYNwP.Ukg3eeLWcay', 1999),
(4, 'Des­mond', 'KEIHER', 'D.Keiher@staffs.ac.uk', '$2y$10$MBl0q0avYvUZV6z8cErEGef/kWyG15m2/XtfA.V33fqYAu1IoGwDC', 1990),
(5, 'Maël', 'GUEGUEN', 'mael.gueguen@efrei.net', '$2y$10$NwR8zTuFQ5vEX21RCN.x9eOsULTNtwDjSfWzI.TKSovRhBodODaye', 2000);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `private_post`
--
ALTER TABLE `private_post`
  ADD PRIMARY KEY (`privatepost_id`);

--
-- Index pour la table `public_post`
--
ALTER TABLE `public_post`
  ADD PRIMARY KEY (`publicpost_id`);

--
-- Index pour la table `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`relationship_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `private_post`
--
ALTER TABLE `private_post`
  MODIFY `privatepost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `public_post`
--
ALTER TABLE `public_post`
  MODIFY `publicpost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `relationships`
--
ALTER TABLE `relationships`
  MODIFY `relationship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

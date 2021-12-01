-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 01 déc. 2021 à 19:25
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

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
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `message_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`message_id`, `message`, `id_receiver`, `id_author`, `message_date`) VALUES
(19, '(4, \'Le Lay\', \'Logan\', \'logan.lelay@hotmail.fr\', \'$2y$10$vYncK86RYk2vyVdmlRDtNuxT9QN/jQluPc4WpIqI1RDyje4xXCPUe\', 1999);', 2, 1, '2021-12-01 05:14:01'),
(20, 'cjklfhdq', 2, 1, '2021-12-01 05:14:08'),
(21, 'cjklfhdq', 2, 1, '2021-12-01 05:22:58'),
(22, 'sfdsfd', 2, 1, '2021-12-01 05:24:23'),
(23, 'sfdsfd', 2, 1, '2021-12-01 05:25:47'),
(24, 'vsdfbsfdbf', 2, 1, '2021-12-01 05:36:51'),
(25, 'vdqdfgsdgdf', 2, 1, '2021-12-01 05:38:53'),
(26, 'vdvd', 2, 1, '2021-12-01 05:38:59'),
(27, 'f:n:dqfd', 2, 1, '2021-12-01 06:16:41'),
(28, 'hello myfriend.', 2, 1, '2021-12-01 06:17:41'),
(29, 'cssdfds', 2, 1, '2021-12-01 06:19:24'),
(30, 'qsfsqfds', 2, 1, '2021-12-01 06:19:45'),
(31, 'sqfdqf', 2, 1, '2021-12-01 06:22:25'),
(32, 'dfdqsfd', 2, 1, '2021-12-01 06:22:39'),
(33, 'dfdqsfd', 2, 1, '2021-12-01 06:23:45'),
(34, 'coucou logan, i want to leave.', 2, 1, '2021-12-01 06:25:11'),
(35, 'gdfhg', 2, 1, '2021-12-01 06:26:19'),
(36, 'fsfdqf', 2, 1, '2021-12-01 06:26:38');

-- --------------------------------------------------------

--
-- Structure de la table `public_post`
--

CREATE TABLE `public_post` (
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` varchar(512) NOT NULL,
  `file_name` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `relationships`
--

CREATE TABLE `relationships` (
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relationships`
--

INSERT INTO `relationships` (`user_1`, `user_2`, `active`) VALUES
(1, 2, 1),
(1, 23, 1),
(2, 3, 1),
(3, 1, 1),
(1, 2, 1),
(1, 23, 1),
(2, 3, 1),
(3, 1, 1),
(1, 1, 1),
(1, 2, 1),
(1, 3, 1);

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
  `birth_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `birth_year`) VALUES
(1, 'Paul', 'Benier', 'paul.benier@efrei.net', '$2y$10$wpg3LoXb3jJlINThDOyBXO1D9vAw5d3E.MAlsVl5vH7LOsToRlk7O', 2001),
(2, 'Séverine', 'Benier', 'severine.benier@efrei.net', '$2y$10$bbmwWFqw2hj1KaPsHfBr2.pYUdnmcZGWmclervI.qDMTh8viX020W', 2000),
(3, 'John', 'Smith', 'john.smith@staffs.ac.uk', '$2y$10$v1StnVWc9PunMN5kAre/6Om/ycrfvIoSRNDgZfHDHO82J3VXoSzjq', 1999),
(4, 'Le Lay', 'Logan', 'logan.lelay@hotmail.fr', '$2y$10$vYncK86RYk2vyVdmlRDtNuxT9QN/jQluPc4WpIqI1RDyje4xXCPUe', 1999);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

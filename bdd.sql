-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 13, 2020 at 03:14 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ip`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `type`) VALUES
(1, 'En quelle année avez-vous été diplômé ?', 3),
(2, 'De quelle formation étiez-vous ? ', 3),
(3, 'Avez-vous trouvé du travail ?', 4),
(4, 'En combien de mois avez-vous trouvé un emploi ?', 4),
(5, 'Votre salaire annuel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE `question_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `multiple` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`id`, `name`, `multiple`) VALUES
(1, 'Choix multiple', 1),
(2, 'Réponse libre', 0),
(3, 'Date', 0),
(4, 'Cases à cocher', 1),
(5, 'Liste déroulante', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reponses`
--

CREATE TABLE `reponses` (
  `id` int(11) NOT NULL,
  `idU` int(11) NOT NULL,
  `idQ` int(11) NOT NULL,
  `reponse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reponses_type`
--

CREATE TABLE `reponses_type` (
  `id` int(11) NOT NULL,
  `idQ` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reponses_type`
--

INSERT INTO `reponses_type` (`id`, `idQ`, `name`, `value`) VALUES
(1, 4, 'Moins de 15 000€', '1'),
(2, 4, 'Entre 15 000€ et 30 000€', '2'),
(4, 4, 'Plus de 50 000€', '4'),
(5, 3, 'Informatique', '1'),
(6, 3, 'Industrie', '2'),
(7, 3, 'Développement durable', '3');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth` int(11) NOT NULL DEFAULT '1',
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `mail`, `password`, `auth`, `token`) VALUES
(1, 'Pottiez', 'Martin', 'martinp@gmail.com', '$2y$10$Zn/yRyeOzsV/Avg6WtWBseDveFYvIK/rg2MmEPC73wxQwJXMJRNQO', 2, 'cv0pyjzfg3eea7m290q9'),
(2, 'Uyttersprot', 'Valentin', 'valentinu@gmail.com', '$2y$10$Zn/yRyeOzsV/Avg6WtWBseDveFYvIK/rg2MmEPC73wxQwJXMJRNQO', 1, 'y4y3qolv0c8fpucnjon1'),
(3, 'Videcoq', 'Valentin', 'valentinv@gmail.com', '$2y$10$Zn/yRyeOzsV/Avg6WtWBseDveFYvIK/rg2MmEPC73wxQwJXMJRNQO', 1, 'pmargulfkigrpbmbojmb'),
(4, 'Caffiaux', 'Matis', 'alexv@gmail.com', '$2y$10$Zn/yRyeOzsV/Avg6WtWBseDveFYvIK/rg2MmEPC73wxQwJXMJRNQO', 1, 'hol0uwda65f06fu408dq'),
(5, 'Nguyen', 'Martin', 'theop@gmail.com', '$2y$10$Zn/yRyeOzsV/Avg6WtWBseDveFYvIK/rg2MmEPC73wxQwJXMJRNQO', 1, 'doicakva26yjn9qgk7ze');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `question_type`
--
ALTER TABLE `question_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idU` (`idU`),
  ADD KEY `idQ` (`idQ`);

--
-- Indexes for table `reponses_type`
--
ALTER TABLE `reponses_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idQ` (`idQ`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `question_type`
--
ALTER TABLE `question_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `reponses_type`
--
ALTER TABLE `reponses_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`type`) REFERENCES `question_type` (`id`);

--
-- Constraints for table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `reponses_ibfk_1` FOREIGN KEY (`idU`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `reponses_ibfk_2` FOREIGN KEY (`idQ`) REFERENCES `questions` (`id`);

--
-- Constraints for table `reponses_type`
--
ALTER TABLE `reponses_type`
  ADD CONSTRAINT `reponses_type_ibfk_1` FOREIGN KEY (`idQ`) REFERENCES `questions` (`id`);

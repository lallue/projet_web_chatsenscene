-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-chatsenscene.alwaysdata.net
-- Generation Time: Nov 08, 2024 at 06:38 PM
-- Server version: 10.11.8-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatsenscene_bdd`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accueil`
--

CREATE TABLE `Accueil` (
  `id` int(11) NOT NULL,
  `titre` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Accueil`
--

INSERT INTO `Accueil` (`id`, `titre`, `description`) VALUES
(1, 'Bonjour Minoute ! ?', 'Bienvenue sur le meilleur site de chats du monde ! Ici, pas de blabla, juste des images trop mignonnes et des chats adorables !'),
(2, 'Ce que l\'on fait', 'Plongez dans un monde rempli de photos de chats en mode détente, joueur, ou juste trop adorables pour être vrais ! 😻');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(20) DEFAULT 'texte',
  `contenu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `nom`, `description`, `type`, `contenu`) VALUES
(49, 'Calie, notre petit ange parti trop tôt', 'Calie, le chat le plus mignon du monde, avec ses yeux d’or et sa douceur incomparable. Elle avait ce don unique de nous réconforter à chaque instant, nous remontant le moral même dans les moments les plus sombres. Toujours présente, avec sa patte posée tendrement sur nos affaires, comme pour nous dire qu\'elle veillait sur nous. Aujourd\'hui, elle est partie trop tôt, mais son souvenir restera gravé à jamais dans nos cœurs.', 'image', 'uploads/calie.jpg'),
(50, 'Le félin au style unique', 'Avec sa fourrure noire et blanche, ce chat porte un petit motif facial qui lui donne un air tout à fait singulier et mémorable. Son regard intense et son allure posée ajoutent un charme mystérieux à sa personnalité. Ce compagnon unique semble avoir un caractère bien trempé, prêt à observer le monde avec une attention presque solennelle. Un félin au charisme indéniable et à l’allure inoubliable !', 'image', 'uploads/hit.jpg'),
(54, 'Petit trésor aux yeux de velours', 'Un regard profond et plein de douceur, un pelage soyeux aux teintes chaudes et réconfortantes… Ce chat mignon est une boule d’amour, toujours prêt à explorer le monde avec curiosité. Avec ses yeux perçants et son air sage, il semble observer tout ce qui l’entoure comme un petit protecteur silencieux. Un compagnon dont la simple présence réchauffe le cœur !', 'image', 'https://www.zooplus.fr/magazine/wp-content/uploads/2019/06/comprendre-le-langage-des-chats.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(3) NOT NULL,
  `contact` text NOT NULL,
  `adresse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `contact`, `adresse`) VALUES
(1, 'Chats en Scène \r\nTel : XX.XX.XX.XX.XX', '16 rue des Chats 666666 France');

-- --------------------------------------------------------

--
-- Table structure for table `contactEntreprise`
--

CREATE TABLE `contactEntreprise` (
  `id` int(11) NOT NULL,
  `contact` text NOT NULL,
  `tel` text NOT NULL,
  `adresse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactEntreprise`
--

INSERT INTO `contactEntreprise` (`id`, `contact`, `tel`, `adresse`) VALUES
(1, 'chats en scène', 'XX.XX.XX.XX.XX', '1 rue des chats en scène 666666 France chats');

-- --------------------------------------------------------

--
-- Table structure for table `contactPersonne`
--

CREATE TABLE `contactPersonne` (
  `id` int(4) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(3) NOT NULL,
  `utilisateur` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `utilisateur`, `password`) VALUES
(1, 'administrateur', '$2y$10$/UKVttMntjwKnYaUxgwlZOZbk6yYSmVIcwAgt7kYoOWeLwsCZ9WVK'),
(9, 'user', '$2y$10$Q5b3qxCF/4i.UbiH2o/U7.jyGAb.RsO2iwy7/686qfbTnqpWF.sdK'),
(10, 'admin', '$2y$10$EeztzMzbV1hpxy.J.rZdtOwt2iKH/budO97mxuA6PtfsjHNB35uz6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Accueil`
--
ALTER TABLE `Accueil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactEntreprise`
--
ALTER TABLE `contactEntreprise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactPersonne`
--
ALTER TABLE `contactPersonne`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Accueil`
--
ALTER TABLE `Accueil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contactEntreprise`
--
ALTER TABLE `contactEntreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contactPersonne`
--
ALTER TABLE `contactPersonne`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

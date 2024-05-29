-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 29 mai 2024 à 19:22
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `omnes_immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `agents`
--

DROP TABLE IF EXISTS `agents`;
CREATE TABLE IF NOT EXISTS `agents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `cv` text,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `specialite` enum('Immobilier résidentiel','Immobilier commercial','Terrain','Appartement à louer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `specialite2` enum('Immobilier résidentiel','Immobilier commercial','Terrain','Appartement à louer') NOT NULL,
  `specialite3` enum('0','Immobilier résidentiel','Immobilier commercial','Terrain','Appartement à louer') NOT NULL,
  `edt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `agents`
--

INSERT INTO `agents` (`id`, `nom`, `prenom`, `user_id`, `telephone`, `cv`, `photo`, `specialite`, `specialite2`, `specialite3`, `edt`) VALUES
(1, 'Zenakhra', 'Djamel', 1, '01 56 58 54 23', 'cv1.jpg', 'photo1.jpg', 'Immobilier résidentiel', 'Immobilier commercial', '', 'edt1.jpg'),
(2, 'Kester', 'Patricia', 1, '01 58 89 52 63', 'cv2.jpg', 'photo2.jpeg', 'Immobilier résidentiel', 'Immobilier commercial', 'Appartement à louer', 'edt2.jpg'),
(3, 'Louaked', 'Mohammed', 1, '01 56 85 96 52', 'cv3.jpg', 'photo3.jpeg', 'Terrain', 'Appartement à louer', 'Immobilier commercial', 'edt3.jpg'),
(4, 'Mahl', 'Louis', 1, '01 63 52 98 41', 'cv4.jpg', 'photo4.jpeg', 'Terrain', 'Immobilier résidentiel', '0', 'edt4.jpg'),
(5, 'SouthWest', 'Debra', 1, '01 52 63 79 63', 'cv5.jpg', 'photo5.jpeg', 'Terrain', 'Immobilier commercial', 'Appartement à louer', 'edt5.jpg'),
(6, 'Schneider', 'Maxime', 1, '01 52 32 45 16', 'cv6.jpg', 'photo6.jpeg', 'Immobilier commercial', 'Appartement à louer', 'Immobilier résidentiel', 'edt6.jpg'),
(7, 'Mouhali', 'Waleed', 1, '01 52 36 45 85', 'cv7.jpg', 'photo7.jpeg', 'Terrain', 'Immobilier résidentiel', '0', 'edt7.jpg'),
(8, 'Delisle', 'Laurent', 1, '01 52 36 75 95', 'cv8.jpg', 'photo8.jpeg', 'Terrain', 'Appartement à louer', '0', 'edt8.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `jour` tinyint NOT NULL,
  `AMPM` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `agent_id` (`agent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `appointments`
--

INSERT INTO `appointments` (`id`, `client_id`, `agent_id`, `jour`, `AMPM`) VALUES
(13, 1, 2, 3, 0),
(14, 1, 2, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `availabilities`
--

DROP TABLE IF EXISTS `availabilities`;
CREATE TABLE IF NOT EXISTS `availabilities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `agent_id` int DEFAULT NULL,
  `lundiAM` tinyint(1) DEFAULT NULL,
  `lundiPM` tinyint(1) NOT NULL,
  `mardiAM` tinyint(1) NOT NULL,
  `mardiPM` tinyint(1) NOT NULL,
  `mercrediAM` tinyint(1) NOT NULL,
  `mercrediPM` tinyint(1) NOT NULL,
  `jeudiAM` tinyint(1) NOT NULL,
  `jeudiPM` tinyint(1) NOT NULL,
  `vendrediAM` tinyint(1) NOT NULL,
  `vendrediPM` tinyint(1) NOT NULL,
  `samediAM` tinyint(1) NOT NULL,
  `samediPM` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agent_id` (`agent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `availabilities`
--

INSERT INTO `availabilities` (`id`, `agent_id`, `lundiAM`, `lundiPM`, `mardiAM`, `mardiPM`, `mercrediAM`, `mercrediPM`, `jeudiAM`, `jeudiPM`, `vendrediAM`, `vendrediPM`, `samediAM`, `samediPM`) VALUES
(1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
(2, 2, 0, 1, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0),
(3, 3, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, 0),
(4, 4, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
(5, 5, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0),
(6, 6, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0),
(7, 7, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0),
(8, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int DEFAULT NULL,
  `receiver_id` int DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`) VALUES
(2, 1, 4, 'je taime');

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_method` enum('Visa','MasterCard','American Express','PayPal') DEFAULT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `card_expiry` date DEFAULT NULL,
  `card_cvc` varchar(4) DEFAULT NULL,
  `transaction_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `payments`
--

INSERT INTO `payments` (`id`, `client_id`, `amount`, `payment_method`, `card_number`, `card_expiry`, `card_cvc`, `transaction_date`) VALUES
(1, 4, 50.00, '', '1556', '0000-00-00', '156', '2024-05-29 17:00:24'),
(2, 1, 50.00, '', '49', '0000-00-00', '456', '2024-05-29 17:06:11'),
(3, 1, 50.00, '', '555', '0000-00-00', '858', '2024-05-29 17:15:47'),
(4, 1, 50.00, '', '56', '0000-00-00', '156', '2024-05-29 17:19:21'),
(5, 1, 50.00, '', '36838', '0000-00-00', '838', '2024-05-29 17:21:02');

-- --------------------------------------------------------

--
-- Structure de la table `payment_info`
--

DROP TABLE IF EXISTS `payment_info`;
CREATE TABLE IF NOT EXISTS `payment_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nom_prenom` varchar(100) NOT NULL,
  `adresse_ligne1` varchar(255) NOT NULL,
  `adresse_ligne2` varchar(255) DEFAULT NULL,
  `ville` varchar(100) NOT NULL,
  `code_postal` varchar(20) NOT NULL,
  `pays` varchar(100) NOT NULL,
  `numero_telephone` varchar(20) NOT NULL,
  `type_carte` varchar(50) NOT NULL,
  `numero_carte` varchar(20) NOT NULL,
  `nom_carte` varchar(100) NOT NULL,
  `date_expiration` varchar(10) NOT NULL,
  `code_securite` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `payment_info`
--

INSERT INTO `payment_info` (`id`, `user_id`, `nom_prenom`, `adresse_ligne1`, `adresse_ligne2`, `ville`, `code_postal`, `pays`, `numero_telephone`, `type_carte`, `numero_carte`, `nom_carte`, `date_expiration`, `code_securite`) VALUES
(4, 1, 'soubie Anselme', '666', '', 'gabat', '64120', '0', '0771704870', 'Visa', '27', 'soubie', '727', '768'),
(5, 2, 'a', 'a', 'a', 'a', 'a', '0', '6', 'Visa', '5815', '5215', '2151', '5215');

-- --------------------------------------------------------

--
-- Structure de la table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `description` text,
  `type` enum('Immobilier résidentiel','Immobilier commercial','Terrain','Appartement à louer') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `code_postal` varchar(10) DEFAULT NULL,
  `surface` float DEFAULT NULL,
  `nombre_pieces` int DEFAULT NULL,
  `nombre_chambres` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agent_id` (`agent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `properties`
--

INSERT INTO `properties` (`id`, `titre`, `description`, `type`, `prix`, `adresse`, `ville`, `code_postal`, `surface`, `nombre_pieces`, `nombre_chambres`, `agent_id`, `image1`, `image2`, `image3`) VALUES
(1, 'T2 de 35m²', 'Joli appartement en vente proche des invalides', 'Immobilier résidentiel', 800000.00, '1 rue Fabert', 'Paris', '75007', 35, 2, 1, 1, 'property1.jpg', 'property1-2.jpg', 'property1-3.jpg'),
(2, 'Maison moderne avec piscine', 'Grande maison de 3 chambres en banlieue parisienne', 'Immobilier résidentiel', 1200000.00, '10 rue George Jubion', 'Sarcelles', '95000', 150, 5, 3, 2, 'property2.jpg', 'property2-2.jpg', 'property2-3.jpg'),
(3, 'Spacieux étage de bureau à louer', '175 m² de bureau dans le 18ème arrondissement', 'Immobilier commercial', 4000.00, '10 rue Lapeyrere', 'Paris', '75018', 175, 1, 0, 3, 'property3.jpg', 'property3-2.jpg', 'property3-3.jpg'),
(4, 'Ancienne maison rénovée', 'Maison à vendre dans le sud de Paris', 'Immobilier commercial', 500000.00, '1 rue Claude Debussy', 'Savigny-sur-Orge', '91600', 130, 4, 2, 5, 'property4-1.jpg', 'property4-2.jpg', 'property4-3.jpg'),
(5, 'Studio étudiant de 17 m²', 'Studio à louer dans le 15ème', 'Appartement à louer', 900.00, '332 rue Lecourbe', 'Paris', '75015', 17, 1, 1, 6, 'property5-1.jpg', 'property5-2.jpg', 'property5-3.jpg'),
(6, 'Terrain vague en région parisienne', 'Terrain de 200 m²', 'Terrain', 70000.00, '2 rue Savignon', 'Bobigny', '93000', 200, 0, 0, 8, 'property6-1.jpg', 'properties6-2.png', 'properties6-3.png'),
(7, 'Terrain vague 130 m²', 'vaste terrain vague à construire dans l\'ouest parisien', 'Terrain', 30000.00, '2 avenue du Marechal Juin', 'Boulogne-Billancourt', '92100', 130, 0, 0, 4, 'property7-1.jpg', 'property7-2.png', 'property7-3.jpg'),
(8, 'Duplex parisien', 'Appartement de deux étages dans le centre de Paris', 'Immobilier résidentiel', 5200000.00, '10 rue Bouchet', 'Paris', '75001', 180, 6, 3, 7, 'property8-1.jpeg', 'property8-2.jpg', 'property8-3.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role` enum('client','agent','administrateur') DEFAULT NULL,
  `reste_a_payer` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`, `reste_a_payer`) VALUES
(1, 'Soubie', 'Anselme', 'anselme.soubie@gmail.com', '$2y$10$65fJSGic1fqwoZrmefpXO.UJABEKScA0wDktfEMrrxtS9Sg05Ok9q', 'administrateur', 50),
(2, 'Le Bel de Penguilly', 'Louis-Edouard', 'ledepenguilly@gmail.com', '$2y$10$QyfDgeXriIN4OsTQywAcFuLtun1zoisuQtluQfhYwbKYyxJbjmeai', 'administrateur', 0),
(3, 'Perin', 'Paul', 'paul.perin@gmail.com', '$2y$10$1gJOUJJ5cDnr6v6PCjX9Ce9wp/5pIhdGfr2xqhQpeiAgD/QPhmcs.', 'agent', 0),
(4, 'Tuil', 'Shaili', 'shaili.tuil@gmail.com', '$2y$10$eqNcEwKr.EE6BE1xnnr1SeryrI812eDNemoenmldiav3J5Z2mBJXK', 'client', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

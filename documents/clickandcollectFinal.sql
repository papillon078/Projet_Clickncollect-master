-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 12 juin 2021 à 12:59
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `clickncollect`
--

-- --------------------------------------------------------

--
-- Structure de la table `command_line`
--

DROP TABLE IF EXISTS `command_line`;
CREATE TABLE IF NOT EXISTS `command_line` (
  `id_ll7882_orders` int(11) NOT NULL,
  `id_ll7882_items` int(11) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `total_HT` float NOT NULL,
  `total_TTC` float NOT NULL,
  PRIMARY KEY (`id_ll7882_orders`,`id_ll7882_items`),
  KEY `command_line_ll7882_items0_FK` (`id_ll7882_items`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_categories`
--

DROP TABLE IF EXISTS `ll7882_categories`;
CREATE TABLE IF NOT EXISTS `ll7882_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_categories`
--

INSERT INTO `ll7882_categories` (`id`, `name`) VALUES
(1, 'Menu'),
(2, 'Fruits et légumes'),
(3, 'Viandes et poissons'),
(4, 'Frais'),
(5, 'Surgelés'),
(6, 'Epicerie sucrée'),
(7, 'Epicerie salée'),
(8, 'Boissons'),
(9, 'Hygiène et beauté'),
(10, 'Bio'),
(11, 'Entretien'),
(12, 'Animaux'),
(13, 'Maison et décoration'),
(14, 'Bricolage');

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_civilities`
--

DROP TABLE IF EXISTS `ll7882_civilities`;
CREATE TABLE IF NOT EXISTS `ll7882_civilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_civilities`
--

INSERT INTO `ll7882_civilities` (`id`, `name`) VALUES
(1, 'Monsieur'),
(2, 'Madame');

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_items`
--

DROP TABLE IF EXISTS `ll7882_items`;
CREATE TABLE IF NOT EXISTS `ll7882_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(9) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `picture_small` text NOT NULL,
  `picture_large` text NOT NULL,
  `description` varchar(250) NOT NULL,
  `taxe_free_price` float NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `release_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_ll7882_categories` int(11) NOT NULL,
  `id_ll7882_packagings` int(11) NOT NULL,
  `id_ll7882_taxes` int(11) NOT NULL,
  `id_ll7882_menus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ll7882_items_ll7882_categories_FK` (`id_ll7882_categories`),
  KEY `ll7882_items_ll7882_packagings0_FK` (`id_ll7882_packagings`),
  KEY `ll7882_items_ll7882_taxes1_FK` (`id_ll7882_taxes`),
  KEY `ll7882_items_ll7882_menus2_FK` (`id_ll7882_menus`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_items`
--

INSERT INTO `ll7882_items` (`id`, `reference`, `name`, `picture_small`, `picture_large`, `description`, `taxe_free_price`, `stock`, `weight`, `size`, `release_date`, `id_ll7882_categories`, `id_ll7882_packagings`, `id_ll7882_taxes`, `id_ll7882_menus`) VALUES
(1, 'Sur-00001', 'Chou fleur', '../assets/productPictures/smallPictures/chou-fleurS.jpg', '../assets/productPictures/largePictures/chou-fleurL.jpg', 'Chou fleur en fleurettes Surgelé', 3, 15, 1, '', '2021-02-08 16:16:54', 5, 3, 2, 1),
(2, 'Fru-00002', 'Pommes de terre', '../assets/productPictures/smallPictures/pdtS.jpg', '../assets/productPictures/largePictures/pdtL.jpg', 'Filet de pommes de terre spéciales vapeur', 3, 100, 1, '', '2021-02-10 16:57:52', 2, 3, 2, 1),
(3, 'Fra-00003', 'Oeufs', '../assets/productPictures/smallPictures/oeufsS.jpg', '../assets/productPictures/largePictures/oeufsL.jpg', 'oeufs', 2, 70, 0, '', '2021-02-10 17:33:42', 4, 1, 2, 1),
(4, 'Fra-00004', 'Béchamel', '../assets/productPictures/smallPictures/bechamelS.jpg', '../assets/productPictures/largePictures/bechamelL.jpg', 'Béchamel prête à l\'emploi', 1, 70, 25, '', '2021-02-10 17:36:00', 4, 4, 2, 1),
(5, 'Fra-00005', 'Fromage rapé', '../assets/productPictures/smallPictures/gruyereS.jpg', '../assets/productPictures/largePictures/gruyereL.jpg', 'Fromage rapé', 2, 50, 250, '', '2021-02-10 17:37:14', 4, 2, 2, 1),
(6, 'Via-00006', 'Merguez La Fernendière', '../assets/productPictures/smallPictures/merguezS.jpg', '../assets/productPictures/largePictures/merguezL.jpg', 'Lot de 9 merguez fraiches', 6, 90, 0, '', '2021-02-15 17:05:41', 3, 1, 2, 3),
(7, 'Fra-00007', 'Carottes rapées Bonduelle', '../assets/productPictures/smallPictures/carottesRapeesS.jpg', '../assets/productPictures/largePictures/carottesRapeesL.jpg', 'Carottes rapées au citron de Sicile', 2.71, 25, 500, '', '2021-02-16 17:11:26', 4, 2, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_menus`
--

DROP TABLE IF EXISTS `ll7882_menus`;
CREATE TABLE IF NOT EXISTS `ll7882_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_menus`
--

INSERT INTO `ll7882_menus` (`id`, `name`) VALUES
(1, 'Gratin de chou-fleur'),
(2, 'Apéritif'),
(3, 'Barbecue');

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_orders`
--

DROP TABLE IF EXISTS `ll7882_orders`;
CREATE TABLE IF NOT EXISTS `ll7882_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `id_ll7882_users` int(11) NOT NULL,
  `id_ll7882_status` int(11) DEFAULT NULL,
  `id_ll7882_timeslot_allocations` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ll7882_orders_ll7882_users_AK` (`id_ll7882_users`),
  UNIQUE KEY `ll7882_orders_ll7882_timeslot_allocations0_AK` (`id_ll7882_timeslot_allocations`),
  KEY `ll7882_orders_ll7882_status0_FK` (`id_ll7882_status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_orders`
--

INSERT INTO `ll7882_orders` (`id`, `order_date`, `delivery_date`, `total_price`, `id_ll7882_users`, `id_ll7882_status`, `id_ll7882_timeslot_allocations`) VALUES
(2, NULL, NULL, NULL, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_packagings`
--

DROP TABLE IF EXISTS `ll7882_packagings`;
CREATE TABLE IF NOT EXISTS `ll7882_packagings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_packagings`
--

INSERT INTO `ll7882_packagings` (`id`, `name`) VALUES
(1, 'le lot'),
(2, 'g'),
(3, 'Kg'),
(4, 'cL'),
(5, 'L'),
(6, 'la pièce');

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_roles`
--

DROP TABLE IF EXISTS `ll7882_roles`;
CREATE TABLE IF NOT EXISTS `ll7882_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1985 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_roles`
--

INSERT INTO `ll7882_roles` (`id`, `name`) VALUES
(1982, 'admin'),
(1983, 'vendeur'),
(1984, 'client');

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_status`
--

DROP TABLE IF EXISTS `ll7882_status`;
CREATE TABLE IF NOT EXISTS `ll7882_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_status`
--

INSERT INTO `ll7882_status` (`id`, `name`) VALUES
(1, 'en cours'),
(2, 'préparée'),
(3, 'emportée'),
(4, 'annulée');

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_taxes`
--

DROP TABLE IF EXISTS `ll7882_taxes`;
CREATE TABLE IF NOT EXISTS `ll7882_taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rate` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_taxes`
--

INSERT INTO `ll7882_taxes` (`id`, `rate`) VALUES
(1, 1.021),
(2, 1.055),
(3, 1.1),
(4, 1.2);

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_timeslot_allocations`
--

DROP TABLE IF EXISTS `ll7882_timeslot_allocations`;
CREATE TABLE IF NOT EXISTS `ll7882_timeslot_allocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slot_allocation` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_timeslot_allocations`
--

INSERT INTO `ll7882_timeslot_allocations` (`id`, `slot_allocation`) VALUES
(1, '08:00:00'),
(2, '08:30:00'),
(3, '09:00:00'),
(4, '09:30:00'),
(5, '10:00:00'),
(6, '10:30:00'),
(7, '11:00:00'),
(8, '11:30:00'),
(9, '12:00:00'),
(10, '12:30:00'),
(11, '13:00:00'),
(12, '13:30:00'),
(13, '14:00:00'),
(14, '14:30:00'),
(15, '15:00:00'),
(16, '15:30:00'),
(17, '16:00:00'),
(18, '16:30:00'),
(19, '17:00:00'),
(20, '17:30:00'),
(21, '18:00:00'),
(22, '18:30:00'),
(23, '19:00:00'),
(24, '19:30:00');

-- --------------------------------------------------------

--
-- Structure de la table `ll7882_users`
--

DROP TABLE IF EXISTS `ll7882_users`;
CREATE TABLE IF NOT EXISTS `ll7882_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `adress_number` int(11) DEFAULT NULL,
  `adress` varchar(150) DEFAULT NULL,
  `appartment_number` int(11) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `loyalty_card` int(11) DEFAULT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client_number` varchar(10) NOT NULL,
  `id_ll7882_roles` int(11) NOT NULL,
  `id_ll7882_civilities` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ll7882_users_ll7882_roles_FK` (`id_ll7882_roles`),
  KEY `ll7882_users_ll7882_civilities0_FK` (`id_ll7882_civilities`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ll7882_users`
--

INSERT INTO `ll7882_users` (`id`, `lastname`, `firstname`, `birth_date`, `email`, `password`, `phone_number`, `adress_number`, `adress`, `appartment_number`, `postal_code`, `city`, `loyalty_card`, `registration_date`, `client_number`, `id_ll7882_roles`, `id_ll7882_civilities`) VALUES
(2, 'Lebrun', 'Aurélie', '1982-08-03', 'lili6630.al@gmail.com', '$2y$10$hlKwzeakV12GKYtUd39bi.l6ZROF4mMWjj6u/8LY/4OhMuG81NmRO', '0624146213', 1, 'Rue du préfet', 0, 78000, 'Versailles', 2, '2021-02-05 17:49:37', '30914', 1982, 2),
(3, NULL, NULL, NULL, 'test.eur@gmail.com', '$2y$10$ZRuWZACT2y1Pvlzbg4rJkOqvUIlcme/RTh1xZ6KLRyDhVpJOxjbEa', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2021-03-24 16:57:01', '11644', 1984, NULL),
(4, NULL, NULL, NULL, 'chou.fleur@gmail.com', '$2y$10$D54nOwR1HNJbzKgHJUrGVu8mHLabHKwIiK/1dKHahDBmnvZ1u.nbC', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2021-03-24 17:06:50', '16482', 1984, NULL),
(5, NULL, NULL, NULL, 'trouduq@cesttoipasmoi.com', '$2y$10$aEN4sF3RQvyG82d1XCdj6.f6WNhiSDhy8yGuXgfWhS/ghGSfrfLZ2', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2021-03-24 17:09:38', '17794', 1984, NULL),
(7, NULL, NULL, NULL, 'aurelie.lebrun@gmail.com', '$2y$10$dzu4IDvwsYBI22lXurQB2.58ZjyAJ92fRRtEz1XEnmpxWsBMeDHZq', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2021-03-24 17:22:03', '23944', 1984, NULL),
(8, 'Mimi', 'Cracra', '2021-01-01', 'mimi.cracra@gmail.com', '$2y$10$cbh0zT.U8HqvaD.oMsRio.paeLE2GPklmA8lZadW1ONuQ/ys8qXqi', '987654321', 6, 'rue du ménage', 0, 78000, 'Crassouilles', 2, '2021-03-26 14:37:41', '48052', 1984, 2),
(9, 'Morin', 'Ludo', '1978-03-18', 'lulu.lamanu@gmail.com', '$2y$10$SAKfVuhcNRU3HK1iUa0hIO0YzfT5YNnlLoF17ybp1yOZ7yAoo4YB2', '987654321', 7, 'Rue des noix', 0, 55000, 'Le Noyé', 2, '2021-03-26 14:55:55', '56990', 1984, 1),
(10, 'Morino', 'Alberto', '2021-03-01', 'alberto@morino.fr', '$2y$10$XaM7baDqtooeIleUnc6Na.VLH8NuTWR6gUITKPpJ935XW2i8u2LUu', '987654321', 9, 'Rue de là-bas', 7, 67543, 'Cielcity', 2, '2021-03-26 15:00:43', '59368', 1984, 1),
(11, 'Labrune', 'Lilie', '2021-01-12', 'aurelie-dany@hotmail.fr', '$2y$10$0rkOS//PfO6fdfq9WWnIHeQhmUQmVQDfg.ztA4KCtv8udlb2.ct/G', '987654321', 43, 'Rue Quéro Albert', 0, 78000, 'Versailles', 2, '2021-03-26 15:09:25', '63632', 1984, 2),
(12, 'Bas', 'Joe', '2021-02-28', 'jojo.ba@gmail.com', '$2y$10$YnoVwCJ42ZQwVBtBIYNA6eVB67C.RK8WOegQCozh.oHMkgRihPvw6', '987654321', 8, 'Rue des palmiers', 6, 32145, 'Sun beach', 2, '2021-03-26 15:20:04', '68880', 1984, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `command_line`
--
ALTER TABLE `command_line`
  ADD CONSTRAINT `command_line_ll7882_items0_FK` FOREIGN KEY (`id_ll7882_items`) REFERENCES `ll7882_items` (`id`),
  ADD CONSTRAINT `command_line_ll7882_orders_FK` FOREIGN KEY (`id_ll7882_orders`) REFERENCES `ll7882_orders` (`id`);

--
-- Contraintes pour la table `ll7882_items`
--
ALTER TABLE `ll7882_items`
  ADD CONSTRAINT `ll7882_items_ll7882_categories_FK` FOREIGN KEY (`id_ll7882_categories`) REFERENCES `ll7882_categories` (`id`),
  ADD CONSTRAINT `ll7882_items_ll7882_menus2_FK` FOREIGN KEY (`id_ll7882_menus`) REFERENCES `ll7882_menus` (`id`),
  ADD CONSTRAINT `ll7882_items_ll7882_packagings0_FK` FOREIGN KEY (`id_ll7882_packagings`) REFERENCES `ll7882_packagings` (`id`),
  ADD CONSTRAINT `ll7882_items_ll7882_taxes1_FK` FOREIGN KEY (`id_ll7882_taxes`) REFERENCES `ll7882_taxes` (`id`);

--
-- Contraintes pour la table `ll7882_orders`
--
ALTER TABLE `ll7882_orders`
  ADD CONSTRAINT `ll7882_orders_ll7882_status0_FK` FOREIGN KEY (`id_ll7882_status`) REFERENCES `ll7882_status` (`id`),
  ADD CONSTRAINT `ll7882_orders_ll7882_timeslot_allocations1_FK` FOREIGN KEY (`id_ll7882_timeslot_allocations`) REFERENCES `ll7882_timeslot_allocations` (`id`),
  ADD CONSTRAINT `ll7882_orders_ll7882_users_FK` FOREIGN KEY (`id_ll7882_users`) REFERENCES `ll7882_users` (`id`);

--
-- Contraintes pour la table `ll7882_users`
--
ALTER TABLE `ll7882_users`
  ADD CONSTRAINT `ll7882_users_ll7882_civilities0_FK` FOREIGN KEY (`id_ll7882_civilities`) REFERENCES `ll7882_civilities` (`id`),
  ADD CONSTRAINT `ll7882_users_ll7882_roles_FK` FOREIGN KEY (`id_ll7882_roles`) REFERENCES `ll7882_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

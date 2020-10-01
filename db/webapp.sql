-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : mar. 22 sep. 2020 à 11:31
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `webapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `Basket`
--

CREATE TABLE `Basket` (
  `customer` int NOT NULL,
  `product` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Basket`
--

INSERT INTO `Basket` (`customer`, `product`, `quantity`) VALUES
(1, 4, 14),
(2, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Customers`
--

CREATE TABLE `Customers` (
  `id` int NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `familyname` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Customers`
--

INSERT INTO `Customers` (`id`, `firstname`, `familyname`, `address`, `username`, `password`) VALUES
(1, 'George', 'Abitbol', '25 rue la plus classe\r\n00000 Monde', 'george', '288078ebd52ab91e351b6255e08d0e21'),
(2, 'Jean', 'Némar', '99 avenue de la discorde\r\n69999 Pas Lyon', 'colere', 'a94f3faf2fe941f162b6ebfe08ad395d'),
(3, 'Ema', 'Déproblaime', '1729 bd de la révolution\r\n12345 Bourg-les-jonq', 'ema', 'b1fa72e8af53b23a22551d89f3a7390d');

-- --------------------------------------------------------

--
-- Structure de la table `Products`
--

CREATE TABLE `Products` (
  `id` int NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Products`
--

INSERT INTO `Products` (`id`, `name`, `description`, `price`) VALUES
(1, 'Raspberry Pi 4', 'Raspberry Pi 4 Modèle B 4 Go ARM-Cortex-A72 4 x 1,50 GHz, 4 Go de RAM, WLAN-AC, Bluetooth 5, LAN, 4 x USB, 2 x Micro HDMI', 58.44),
(2, 'Module 4 canaux 5V', 'SeeKool 5V 4 canaux Module de Relais Module pour Arduino UNO R3 Mega 2560 1280 DSP Arm PIC AVR STM32 Raspberry Pi', 6.09),
(3, 'Adaptateur USB3.0 Sata 3.5 Pouces', 'UGREEN USB Disque Dur Adaptateur USB 3.0 vers SATA III Câble USB 3.0 pour 2,5 3,5 Pouces HDD SSD Driver jusqu\'à 12To Supporte UASP', 12.9),
(4, 'Buzzer Alarme 12V', 'ICQUANZX 5 Pcs DC 3-24V 85dB Son Alarme Électronique Buzzer Noir 23 x 12mm', 7.99);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Basket`
--
ALTER TABLE `Basket`
  ADD PRIMARY KEY (`customer`,`product`),
  ADD KEY `product` (`product`),
  ADD KEY `customer` (`customer`);

--
-- Index pour la table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Products`
--
ALTER TABLE `Products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Basket`
--
ALTER TABLE `Basket`
  ADD CONSTRAINT `Basket_ibfk_1` FOREIGN KEY (`product`) REFERENCES `Products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Basket_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `Customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

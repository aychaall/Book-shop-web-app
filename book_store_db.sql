-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 20 oct. 2024 à 21:42
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `book_store_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(75, 19, 'Be Well Bee', 7, 1, 'be_well_bee.jpg'),
(87, 20, 'Holy Ghosts', 50, 3, 'holy_ghosts.jpg'),
(88, 20, 'The World', 11, 1, 'the_world.jpg'),
(93, 21, 'Mirror', 26, 1, 'th7.jfif');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(11) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(11, 20, 'aaycha', '01522552273', 'aaycha013@gmail.com', 'cash on delivery', 'isi, ariana', ', Radical Gardening (1), Red Queen (3), The World (1), Boring Girls A Novel (7), The Girl of Ink & Stars (1)', 370, '20-Apr-2024', 'completed'),
(12, 20, 'aaycha', '01010495597', 'aaycha013@gmail.com', 'mastercard', 'isi, ariana', ', Boring Girls A Novel (3), Be Well Bee (2)', 125, '20-Apr-2024', 'completed'),
(13, 21, 'aycha allagui', '54334128', 'aaycha013@gmail.com', 'cash on delivery', 'flat no. 0, hinchir klil morneg, aaa, Ben Arous, Tunisie - 2090', ', Mirror (2)', 52, '20-Oct-2024', 'pending'),
(14, 21, 'aycha allagui', '54334128', 'aaycha013@gmail.com', 'cash on delivery', 'flat no. 0, hinchir klil morneg, aaa, Ben Arous, Tunisie - 2090', ', Death Sentence (1)', 25, '20-Oct-2024', 'completed'),
(15, 21, 'Aicha Allagui', '54334128', 'a.aichaallagui@gmail.com', 'paypal', 'flat no. 0, address, Bin \'Arus, Ben Arous, Tunisie - 2090', ', The Magic of The Unicorn (1)', 25, '20-Oct-2024', 'completed');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(30, 'Treasure island', 20, 'Adv1.jfif'),
(31, 'The Magic of The Unicorn', 25, 'Adv2.jfif'),
(32, 'Summer Adventure Stories', 30, 'Adv3.jfif'),
(33, 'Dragon Run', 28, 'Adv4.jfif'),
(34, ' The Abominable Snowman', 17, 'Adv5.jfif'),
(35, 'Mount Majestic', 21, 'adv7.jfif'),
(36, 'The magical Underwater', 24, 'adv8.jfif'),
(38, 'Three Men in a Boat', 15, 'c2.jfif'),
(39, 'Lose Well', 23, 'c3.jfif'),
(40, ' carry on,Jeeves', 18, 'c4.jfif'),
(41, 'I Must Say', 21, 'c5.jfif'),
(42, 'Baggage', 16, 'c6.jfif'),
(43, '  Dangerously Funny', 21, 'c7.jfif'),
(44, ' The Bolds', 28, 'c8.jfif'),
(45, 'From Goethe to Gundolf', 26, 'img_2.jpg'),
(46, 'Madeleine Brent: A Heritage of Shadows', 15, 'img_3.jpeg'),
(47, 'Heart of the Few', 19, 'img_4.jpg'),
(48, 'Our Darkest Night', 23, 'img_5.jpg'),
(49, ' Darkest Before The Dawn', 15, 'img_6.jpg'),
(50, 'All The Light We Cannot See', 21, 'img_7.jpg'),
(51, 'Solar Bones', 25, 'img_8.jpg'),
(52, 'The House On The Lake', 15, 'img_9.jpg'),
(53, ' The Girl In The Letter', 20, 'img_10.jpg'),
(54, 'A Prince On A Paper', 15, 'r1.jfif'),
(55, 'The Rogue Of Fifth Avenue', 18, 'r2.jfif'),
(56, 'Marrying Winterborne', 23, 'r3.jfif'),
(57, 'The lady Travelers Guide To Scoundrels and Other Gentlmen', 19, 'r4.jfif'),
(58, 'Rosevean', 21, 'r5.jfif'),
(59, 'A Colllector\'S Hem', 26, 'r6.jfif'),
(60, ' Highlander (series1)', 18, 'r7.jfif'),
(61, 'A Challenge Of Love and Faith', 27, 'r8.jfif'),
(62, 'The Takings', 29, 'th2.jfif'),
(63, 'Death Sentence', 25, 'th3.jfif'),
(64, 'The BiLLion Dollar Spy', 22, 'th4.jfif'),
(65, ' The Diven Line', 19, 'th5.jfif'),
(66, 'Stranger Weather', 19, 'th6.jfif'),
(67, 'Mirror', 26, 'th7.jfif'),
(68, ' Malignant', 28, 'th8.jfif'),
(69, 'No land\'s Man', 20, 'c1.jfif');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(19, 'Rania Laffet', 'rania.laffet@etudiant-isi.utm.tn', 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
(20, 'aaycha', 'aaycha013@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(21, 'Brain Diff', 'aaiche@gmail.com', '4607e782c4d86fd5364d7e4508bb10d9', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ActiveDirectories_Cart_UserID` (`user_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ActiveDirectories_UserID` (`user_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_ActiveDirectories_Cart_UserID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_ActiveDirectories_UserID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

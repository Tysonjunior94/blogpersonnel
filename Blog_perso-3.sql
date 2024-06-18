-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 19 juin 2024 à 00:59
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Blog_perso`
--

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE `Article` (
  `ArticleID` int(11) NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Contenu` text NOT NULL,
  `DatePublication` date NOT NULL,
  `Auteur` varchar(255) DEFAULT NULL,
  `CategorieID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Article`
--

INSERT INTO `Article` (`ArticleID`, `Titre`, `Contenu`, `DatePublication`, `Auteur`, `CategorieID`) VALUES
(1, 'Article 1: Les Fondations du Projet', 'Titre: Les Premières Pierres de Notre Édifice Numérique\r\n\r\nContenu:\r\n\r\nDans cette aventure de création d’un site web intégré à une base de données, les premiers pas furent à la fois essentiels et édifiants. Dès le début, l’objectif était clair : établir une plateforme robuste et fonctionnelle, capable de gérer des articles et des commentaires de manière fluide et sécurisée.\r\n\r\nLa conception a débuté par la définition des besoins et des spécifications du projet. Cela impliquait une compréhension approfondie des attentes et des objectifs à atteindre. Nous avons ensuite procédé à la création de la base de données, un pilier central de notre projet, en utilisant MySQL pour structurer les données relatives aux articles, commentaires, et utilisateurs.\r\n\r\nCe travail préparatoire a nécessité une planification minutieuse, où chaque table de la base de données a été soigneusement définie pour assurer une intégrité et une efficacité maximales. Les tables Article, Commentaire, Utilisateur, et Catégorie ont été conçues pour stocker respectivement les données des articles, des commentaires postés, des informations des utilisateurs, et des catégories d’articles.', '2024-05-24', NULL, 1),
(2, 'Qui sommes nous', 'Nous sommes 2 étudiants, qui étudions en école d\'ingénieur en apprentissage dans le domaine du Génie Industriel. Ici nous vous partageons l\'évolution de notre projet autour de la gestion de base de données et création de site web, chaque article vous explique comment ce site évolue ou a évolué.', '2024-05-26', NULL, 2),
(3, 'Article 2: Développement et Expansion', 'Titre: L’Évolution de Notre Projet Web\r\n\r\nContenu:\r\n\r\nLa suite de notre projet a été marquée par une série de développements techniques et des ajouts fonctionnels qui ont enrichi notre site web. Après avoir établi une base solide, nous nous sommes concentrés sur l’interface utilisateur, en veillant à ce que chaque page soit intuitive et réactive.\r\n\r\nNous avons intégré des fonctionnalités clés telles que la gestion des articles par l’administrateur, permettant la création, la modification, et la suppression d’articles. L’ajout de fonctionnalités de commentaire pour chaque article a également été implémenté, favorisant ainsi l’interaction des visiteurs avec le contenu publié.\r\n\r\nLe système d’authentification a été une autre étape cruciale, sécurisant l’accès aux fonctions administratives tout en permettant une gestion aisée des sessions utilisateurs. Les interactions avec la base de données ont été optimisées pour assurer des performances rapides et fiables, essentielles au dynamisme du site.', '2024-05-26', NULL, NULL),
(4, 'Article 3: Réflexions sur un Projet Abouti', 'Titre: Bilan d’un Projet Web Enrichissant\r\n\r\nContenu:\r\n\r\nÀ mesure que notre projet touchait à sa fin, nous avons peaufiné les derniers détails, assurant la cohérence et la qualité du site dans son ensemble. L’ajout d’une fonctionnalité de “like” pour les articles et la mise en place d’un style visuel attrayant ont été les touches finales qui ont transformé notre site en une plateforme à la fois esthétique et fonctionnelle.\r\n\r\nCe projet a été une aventure extraordinaire, riche en apprentissages et en défis. Il m’a permis d’acquérir une multitude de compétences, de la conception de bases de données à la programmation front-end et back-end. Chaque étape, des premières esquisses à la mise en ligne, a renforcé ma compréhension du développement web et a aiguisé ma capacité à résoudre des problèmes complexes.\r\n\r\nLe succès de ce projet réside dans la collaboration et le partage de connaissances, illustrant parfaitement comment la technologie peut transformer des idées en réalités concrètes et fonctionnelles. Je suis impatient de mettre ces compétences nouvellement acquises au service de futurs projets encore plus ambitieux.\r\n\r\nCes articles peuvent être utilisés directement sur ton blog pour expliquer le processus de développement du projet. Ils offrent une vue d’ensemble des phases du projet tout en mettant en avant les apprentissages et les réussites.', '2024-05-26', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `CategorieID` int(11) NOT NULL,
  `NomCategorie` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`CategorieID`, `NomCategorie`, `Description`) VALUES
(1, 'Projet', 'Articles sur la construction du projet'),
(2, 'Personnel', 'Infos sur nous');

-- --------------------------------------------------------

--
-- Structure de la table `Commentaire`
--

CREATE TABLE `Commentaire` (
  `CommentaireID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `AuteurCommentaire` varchar(255) NOT NULL,
  `ContenuCommentaire` text NOT NULL,
  `DateCommentaire` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Commentaire`
--

INSERT INTO `Commentaire` (`CommentaireID`, `ArticleID`, `AuteurCommentaire`, `ContenuCommentaire`, `DateCommentaire`) VALUES
(1, 1, 'Jeremie', 'Très intéressant, merci pour le partage!', '2023-04-03'),
(2, 2, 'Florian', 'Super article, ça donne envie d\'en savoir plus!', '2023-04-04'),
(3, 1, 'Florian', 'Ok, c\'est top, hate de voir la suite de l\'évolution du projet ...', '2024-05-29'),
(4, 2, 'Jeremie', 'Wow c\'est cool', '2024-06-12');

-- --------------------------------------------------------

--
-- Structure de la table `Session`
--

CREATE TABLE `Session` (
  `SessionID` int(11) NOT NULL,
  `UtilisateurID` int(11) NOT NULL,
  `DateDebut` datetime NOT NULL,
  `DateFin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Session`
--

INSERT INTO `Session` (`SessionID`, `UtilisateurID`, `DateDebut`, `DateFin`) VALUES
(1, 1, '2023-04-01 08:00:00', '2023-04-01 18:00:00'),
(2, 2, '2023-04-02 09:00:00', '2023-04-02 17:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `UtilisateurID` int(11) NOT NULL,
  `NomUtilisateur` varchar(255) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`UtilisateurID`, `NomUtilisateur`, `MotDePasse`) VALUES
(1, 'Florian Lassalle', 'motdepasse123'),
(2, 'Jeremie Hamm', 'motdepasse1234'),
(4, 'admin', 'admin123');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (`ArticleID`),
  ADD KEY `CategorieID` (`CategorieID`);

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`CategorieID`);

--
-- Index pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD PRIMARY KEY (`CommentaireID`),
  ADD KEY `ArticleID` (`ArticleID`);

--
-- Index pour la table `Session`
--
ALTER TABLE `Session`
  ADD PRIMARY KEY (`SessionID`),
  ADD KEY `UtilisateurID` (`UtilisateurID`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`UtilisateurID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `ArticleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `CategorieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  MODIFY `CommentaireID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Session`
--
ALTER TABLE `Session`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `UtilisateurID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Article`
--
ALTER TABLE `Article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`CategorieID`) REFERENCES `Categorie` (`CategorieID`);

--
-- Contraintes pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ArticleID`) REFERENCES `Article` (`ArticleID`);

--
-- Contraintes pour la table `Session`
--
ALTER TABLE `Session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`UtilisateurID`) REFERENCES `Utilisateur` (`UtilisateurID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

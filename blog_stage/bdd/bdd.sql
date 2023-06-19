-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour blog
CREATE DATABASE IF NOT EXISTS `blog` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `blog`;

-- Listage de la structure de table blog. comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `author` int DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `comment_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table blog.comments : ~0 rows (environ)

-- Listage de la structure de table blog. logins
CREATE TABLE IF NOT EXISTS `logins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'user',
  `info_plus` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table blog.logins : ~3 rows (environ)
INSERT INTO `logins` (`id`, `username`, `password`, `name`, `firstname`, `role`, `info_plus`) VALUES
	(14, 'sa', 'sa', 'super', 'admin', 'super-admin', 1),
	(17, 'user', 'user', 'George', 'Huston', 'user', 0),
	(18, 'admin', 'admin', 'Lucas', 'Demonarichi', 'admin', 0);

-- Listage de la structure de table blog. posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table blog.posts : ~1 rows (environ)
INSERT INTO `posts` (`id`, `title`, `content`, `creation_date`) VALUES
	(9, 'Le plan canicule pour l’été 2023 prévoit des alertes par SMS et dans les transports', ' De l’alerte par téléphone aux « flyers » distribués par les facteurs, Christophe Béchu a annoncé des dispositifs pour informer les Français sur les « bons gestes » à adopter en période de vagues de chaleur.\r\n\r\nPar Le HuffPost avec AFP.\r\n\r\nPOLITIQUE - Des messages de prévention dans les transports aux alertes par SMS, le gouvernement veut « anticiper, informer, protéger ». Le ministre de la Transition écologique, Christophe Béchu, a dévoilé ce jeudi 8 juin sur Franceinfo son « plan canicule » avec « 15 actions phares » pour faire face aux vagues de chaleur cet été.\r\n\r\nL’ensemble de ces mesures visent à « accompagner l’ensemble des Français, en particulier les plus vulnérables » face aux vagues de chaleur, a expliqué Christophe Béchu. Celles-ci affectent « tous les aspects de notre économie et de la vie quotidienne » comme la santé, le travail, la vie sociale et culturelle, les ressources naturelles, les forêts... Pour anticiper les risques, les dispositifs annoncés visent notamment à rappeler les bons comportements en cas de canicule.', '2023-06-08 09:38:59');

-- Listage de la structure de table blog. profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'x',
  `id_user` int DEFAULT NULL COMMENT 'x',
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'x xxxx xxxxx xxxx',
  `tel` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT '+xx xxx xxx xxx',
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'xxx@xx.xxx',
  `bio` text COLLATE utf8mb4_bin NOT NULL COMMENT 'xxxxxxxxx',
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT 'eva_n.louis' COMMENT '@xxxxxx',
  `ville` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table blog.profiles : ~1 rows (environ)
INSERT INTO `profiles` (`id`, `id_user`, `adress`, `tel`, `mail`, `bio`, `instagram`, `ville`, `code_postal`) VALUES
	(19, 14, '25 rue des narbones', '0615151451', 'admin@gmail.com', 'Lorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It\'s also called placeholder (or filler) text. It\'s a convenient tool for mock-ups. It helps to outline the visual elements of a document or presentation, eg typography, font, or layout. Lorem ipsum is mostly a part of a Latin text by the classical author and philosopher Cicero. Its words and letters have been changed by addition or removal, so to deliberately render its content nonsensical; it\'s not genuine, correct, or comprehensible Latin anymore. While lorem ipsum\'s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero\'s text doesn\'t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of European languages, as are digraphs not to be found in the original.\r\n\r\nIn a professional context it often happens that private or corporate clients corder a publication to be made and presented with the actual content still not being ready. Think of a news blog that\'s filled with content hourly on the day of going live. However, reviewers tend to be distracted by comprehensible content, say, a random text copied from a newspaper or the internet. The are likely to focus on the text, disregarding the layout and its elements. Besides, random text risks to be unintendedly humorous or offensive, an unacceptable risk in corporate environments. Lorem ipsum and its many variants have been employed since the early 1960ies, and quite likely since the sixteenth century.', 'eva_n.louis', 'Gap', '51500');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

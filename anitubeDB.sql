-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.2.0 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela anitube.animeimg
CREATE TABLE IF NOT EXISTS `animeimg` (
  `animeimgid` int NOT NULL AUTO_INCREMENT,
  `anime_idanime` int NOT NULL,
  `imganime` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`animeimgid`),
  KEY `animeimgid` (`animeimgid`),
  KEY `anime_idanime` (`anime_idanime`),
  CONSTRAINT `fk_animeimg_animes` FOREIGN KEY (`anime_idanime`) REFERENCES `animes` (`idanime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela anitube.animeimg: ~0 rows (aproximadamente)
DELETE FROM `animeimg`;

-- Copiando estrutura para tabela anitube.animes
CREATE TABLE IF NOT EXISTS `animes` (
  `idanime` int NOT NULL AUTO_INCREMENT,
  `nomeanime` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `anoanime` year NOT NULL,
  `sinopseanime` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `genero_idgenero` int NOT NULL,
  `datahoraregistro` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idanime`) USING BTREE,
  KEY `idfilme` (`idanime`) USING BTREE,
  KEY `animes_idanimecategorias` (`genero_idgenero`) USING BTREE,
  CONSTRAINT `fk_animes_genero` FOREIGN KEY (`genero_idgenero`) REFERENCES `genero` (`idgenero`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela anitube.animes: ~0 rows (aproximadamente)
DELETE FROM `animes`;

-- Copiando estrutura para tabela anitube.genero
CREATE TABLE IF NOT EXISTS `genero` (
  `idgenero` int NOT NULL AUTO_INCREMENT,
  `genero` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `datahoraregistro` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idgenero`) USING BTREE,
  KEY `idcategoria` (`idgenero`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela anitube.genero: ~16 rows (aproximadamente)
DELETE FROM `genero`;
INSERT INTO `genero` (`idgenero`, `genero`, `datahoraregistro`) VALUES
	(1, 'Shounen', '0000-00-00 00:00:00'),
	(2, 'Shoujo', '0000-00-00 00:00:00'),
	(3, 'Kodomomuke', '0000-00-00 00:00:00'),
	(4, 'Seinen', '0000-00-00 00:00:00'),
	(5, 'Josei', '0000-00-00 00:00:00'),
	(6, 'Shounen AI', '0000-00-00 00:00:00'),
	(7, 'Yaoi', '0000-00-00 00:00:00'),
	(8, 'Yuri', '0000-00-00 00:00:00'),
	(9, 'Meccha', '0000-00-00 00:00:00'),
	(10, 'Ecchi', '0000-00-00 00:00:00'),
	(11, 'Harem', '0000-00-00 00:00:00'),
	(12, 'Reverse Harem', '0000-00-00 00:00:00'),
	(13, 'Youkai', '0000-00-00 00:00:00'),
	(14, 'Isekai', '0000-00-00 00:00:00'),
	(15, 'Slice of life', '0000-00-00 00:00:00'),
	(16, 'Idol', '0000-00-00 00:00:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

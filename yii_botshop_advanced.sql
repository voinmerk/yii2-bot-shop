-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.20 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных yii_botshop_advanced
CREATE DATABASE IF NOT EXISTS `yii_botshop_advanced` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `yii_botshop_advanced`;

-- Дамп структуры для таблица yii_botshop_advanced.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii_botshop_advanced.auth_assignment: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('admin', '1', 1538365661),
	('editor', '2', 1538365661);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii_botshop_advanced.auth_item: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('admin', 1, NULL, NULL, NULL, 1538365661, 1538365661),
	('editor', 1, NULL, NULL, NULL, 1538365661, 1538365661),
	('updateNews', 2, 'Редактирование новости', NULL, NULL, 1538365661, 1538365661),
	('viewAdminPage', 2, 'Просмотр админки', NULL, NULL, 1538365661, 1538365661);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii_botshop_advanced.auth_item_child: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', 'editor'),
	('editor', 'updateNews'),
	('admin', 'viewAdminPage');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii_botshop_advanced.auth_rule: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.blog_category
CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.blog_category: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.blog_post
CREATE TABLE IF NOT EXISTS `blog_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.blog_post: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_post` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.blog_post_to_category
CREATE TABLE IF NOT EXISTS `blog_post_to_category` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.blog_post_to_category: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_post_to_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_post_to_category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.blog_post_to_tag
CREATE TABLE IF NOT EXISTS `blog_post_to_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.blog_post_to_tag: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_post_to_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_post_to_tag` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.blog_tag
CREATE TABLE IF NOT EXISTS `blog_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.blog_tag: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_tag` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot
CREATE TABLE IF NOT EXISTS `bot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `voices` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `bot` DISABLE KEYS */;
/*!40000 ALTER TABLE `bot` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_to_category
CREATE TABLE IF NOT EXISTS `bot_to_category` (
  `bot_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_to_category: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `bot_to_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `bot_to_category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_to_comment
CREATE TABLE IF NOT EXISTS `bot_to_comment` (
  `bot_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_to_comment: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `bot_to_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `bot_to_comment` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `sort_order` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.category: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.comment: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.migration: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1538364346),
	('m130524_201442_init', 1538364347),
	('m140506_102106_rbac_init', 1538365342),
	('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1538365342);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=343142693 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii_botshop_advanced.user: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `first_name`, `last_name`, `avatar`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Z_tYa2wztRkLPPAx-4Hu2iNa2f1RfYFa', '', '', '', 10, 1538365561, 1538365561),
	(343142692, 'voinmerk', 'mynMKut58nbBddoHMgHV3m4Licr8GGzi', 'Evgeniy', 'Voyt', 'https://t.me/i/userpic/320/voinmerk.jpg', 10, 1538387854, 1538387854);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

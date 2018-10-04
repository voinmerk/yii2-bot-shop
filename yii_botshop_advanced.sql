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
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_blog_category_user_created` (`created_by`),
  KEY `FK_blog_category_user_updated` (`updated_by`),
  CONSTRAINT `FK_blog_category_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_blog_category_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.blog_category: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.blog_category_translate
CREATE TABLE IF NOT EXISTS `blog_category_translate` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  KEY `FK_blog_category_translate_blog_category` (`category_id`),
  KEY `FK_blog_category_translate_language` (`language_id`),
  CONSTRAINT `FK_blog_category_translate_blog_category` FOREIGN KEY (`category_id`) REFERENCES `blog_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_blog_category_translate_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.blog_category_translate: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_category_translate` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_category_translate` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.blog_comment
CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_blog_comment_user_created` (`created_by`),
  KEY `FK_blog_comment_user_updated` (`updated_by`),
  KEY `FK_blog_comment_blog_post` (`post_id`),
  CONSTRAINT `FK_blog_comment_blog_post` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_blog_comment_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_blog_comment_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.blog_comment: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comment` ENABLE KEYS */;

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
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_blog_post_user_created` (`created_by`),
  KEY `FK_blog_post_user_updated` (`updated_by`),
  CONSTRAINT `FK_blog_post_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_blog_post_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
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

-- Дамп структуры для таблица yii_botshop_advanced.blog_post_trasnlate
CREATE TABLE IF NOT EXISTS `blog_post_trasnlate` (
  `post_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  KEY `FK_blog_post_trasnlate_blog_post` (`post_id`),
  KEY `FK_blog_post_trasnlate_language` (`language_id`),
  CONSTRAINT `FK_blog_post_trasnlate_blog_post` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_blog_post_trasnlate_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.blog_post_trasnlate: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `blog_post_trasnlate` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_post_trasnlate` ENABLE KEYS */;

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
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `username` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `default_category_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`),
  UNIQUE KEY `token` (`token`),
  KEY `FK_bot_user_created` (`created_by`),
  KEY `FK_bot_user_updated` (`updated_by`),
  KEY `FK_bot_category` (`default_category_id`),
  CONSTRAINT `FK_bot_category` FOREIGN KEY (`default_category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bot_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bot_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `bot` DISABLE KEYS */;
INSERT INTO `bot` (`id`, `title`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `username`, `token`, `image`, `views`, `status`, `default_category_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'FrontVisionBot', 'Удобный бот для работы с клиентами компании ООО FrontVision', 'FrontVisionBot', NULL, NULL, 'frontvision_bot', '502079464:AAGVyl3_NZPLCNQFaj--DY6zKa-SOZySaiA', 'no.jpg', 0, 1, 5, 343142692, 343142692, 1538469948, 1538469948);
/*!40000 ALTER TABLE `bot` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_language
CREATE TABLE IF NOT EXISTS `bot_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_language: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `bot_language` DISABLE KEYS */;
INSERT INTO `bot_language` (`id`, `name`) VALUES
	(1, 'English'),
	(2, 'Український'),
	(3, 'Русский');
/*!40000 ALTER TABLE `bot_language` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_rating
CREATE TABLE IF NOT EXISTS `bot_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bot_rating_bot` (`bot_id`),
  KEY `FK_bot_rating_user` (`user_id`),
  CONSTRAINT `FK_bot_rating_bot` FOREIGN KEY (`bot_id`) REFERENCES `bot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bot_rating_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_rating: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `bot_rating` DISABLE KEYS */;
INSERT INTO `bot_rating` (`id`, `bot_id`, `user_id`, `rating`) VALUES
	(1, 1, 343142692, 5);
/*!40000 ALTER TABLE `bot_rating` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_to_bot_language
CREATE TABLE IF NOT EXISTS `bot_to_bot_language` (
  `bot_id` int(11) NOT NULL,
  `bot_language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_to_bot_language: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `bot_to_bot_language` DISABLE KEYS */;
INSERT INTO `bot_to_bot_language` (`bot_id`, `bot_language_id`) VALUES
	(1, 1),
	(1, 3);
/*!40000 ALTER TABLE `bot_to_bot_language` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_to_category
CREATE TABLE IF NOT EXISTS `bot_to_category` (
  `bot_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_to_category: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `bot_to_category` DISABLE KEYS */;
INSERT INTO `bot_to_category` (`bot_id`, `category_id`) VALUES
	(1, 5);
/*!40000 ALTER TABLE `bot_to_category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_category_user_created` (`created_by`),
  KEY `FK_category_user_updated` (`updated_by`),
  CONSTRAINT `FK_category_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_category_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.category: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `slug`, `image`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'games', NULL, 3, 1, 1, 1, 0, 0),
	(2, 'education', NULL, 1, 1, 1, 1, 0, 0),
	(3, 'social', NULL, 2, 1, 1, 1, 0, 0),
	(4, 'shops', NULL, 4, 1, 1, 1, 0, 0),
	(5, 'utilities', NULL, 5, 1, 1, 1, 0, 0),
	(6, 'entertainment', NULL, 6, 1, 1, 1, 0, 0),
	(7, 'news', NULL, 7, 1, 1, 1, 0, 0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.category_translate
CREATE TABLE IF NOT EXISTS `category_translate` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  KEY `FK_category_translate_category` (`category_id`),
  KEY `FK_category_translate_language` (`language_id`),
  CONSTRAINT `FK_category_translate_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_category_translate_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.category_translate: ~14 rows (приблизительно)
/*!40000 ALTER TABLE `category_translate` DISABLE KEYS */;
INSERT INTO `category_translate` (`category_id`, `language_id`, `title`, `content`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
	(1, 1, 'Игры', NULL, 'Игры', NULL, NULL),
	(1, 2, 'Games', NULL, 'Games', NULL, NULL),
	(2, 1, 'Образование', NULL, 'Образование', NULL, NULL),
	(2, 2, 'Education', NULL, 'Education', NULL, NULL),
	(3, 1, 'Социальные', NULL, 'Социальные', NULL, NULL),
	(3, 2, 'Social', NULL, 'Social', NULL, NULL),
	(4, 1, 'Магазины', NULL, 'Магазины', NULL, NULL),
	(4, 2, 'Shops', NULL, 'Shops', NULL, NULL),
	(5, 1, 'Коммунальные услуги', NULL, 'Коммунальные услуги', NULL, NULL),
	(5, 2, 'Utilities', NULL, 'Utilities', NULL, NULL),
	(6, 1, 'Развлечения', NULL, 'Развлечения', NULL, NULL),
	(6, 2, 'Entertainment', NULL, 'Entertainment', NULL, NULL),
	(7, 1, 'Новости', NULL, 'Новости', NULL, NULL),
	(7, 2, 'News', NULL, 'News', NULL, NULL);
/*!40000 ALTER TABLE `category_translate` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `bot_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_user_created` (`created_by`),
  KEY `FK_comment_user_updated` (`updated_by`),
  KEY `FK_comment_bot` (`bot_id`),
  CONSTRAINT `FK_comment_bot` FOREIGN KEY (`bot_id`) REFERENCES `bot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comment_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_comment_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.comment: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`id`, `content`, `bot_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Первый комент из БД', 1, 343142692, 343142692, 0, 0);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.language
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.language: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` (`id`, `name`, `code`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Русский', 'ru', 1, 1, 0, 0),
	(2, 'English', 'en', 1, 1, 0, 0);
/*!40000 ALTER TABLE `language` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.message
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`,`language`),
  KEY `idx_message_language` (`language`),
  CONSTRAINT `fk_message_source_message` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii_botshop_advanced.message: ~20 rows (приблизительно)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` (`id`, `language`, `translation`) VALUES
	(1, 'en', 'Sign in to start your session'),
	(1, 'ru', 'Войдите, чтобы начать сеанс'),
	(2, 'en', 'Category'),
	(2, 'ru', 'Категория'),
	(3, 'en', 'Categpries'),
	(3, 'ru', 'Категории'),
	(4, 'en', 'Bots Catalog'),
	(4, 'ru', 'Каталог ботов'),
	(5, 'en', 'Catalog'),
	(5, 'ru', 'Каталог'),
	(6, 'en', 'Your profile'),
	(6, 'ru', 'Ваш профиль'),
	(7, 'en', 'Your bots'),
	(7, 'ru', 'Ваши боты'),
	(8, 'en', 'Add bot'),
	(8, 'ru', 'Добавить бота'),
	(9, 'en', 'Setting'),
	(9, 'ru', 'Настройки'),
	(10, 'en', 'Logout'),
	(10, 'ru', 'Выход'),
	(11, 'en', 'Add to {icon}'),
	(11, 'ru', 'Добавить к {icon}'),
	(12, 'en', 'Profile'),
	(12, 'ru', 'Профиль'),
	(13, 'en', 'Bots'),
	(13, 'ru', 'Боты');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.migration: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1538364346),
	('m130524_201442_init', 1538364347),
	('m140506_102106_rbac_init', 1538365342),
	('m150207_210500_i18n_init', 1538468610),
	('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1538365342);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.source_message
CREATE TABLE IF NOT EXISTS `source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_source_message_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii_botshop_advanced.source_message: ~10 rows (приблизительно)
/*!40000 ALTER TABLE `source_message` DISABLE KEYS */;
INSERT INTO `source_message` (`id`, `category`, `message`) VALUES
	(1, 'backend', 'Sign in to start your session'),
	(2, 'backend', 'Category'),
	(3, 'backend', 'Categories'),
	(4, 'frontend', 'Bots Catalog'),
	(5, 'frontend', 'Catalog'),
	(6, 'frontend', 'Your profile'),
	(7, 'frontend', 'Your bots'),
	(8, 'frontend', 'Add bot'),
	(9, 'frontend', 'Setting'),
	(10, 'frontend', 'Logout'),
	(11, 'frontend', 'Add to {icon}'),
	(12, 'frontend', 'Profile'),
	(13, 'frontend', 'Bots');
/*!40000 ALTER TABLE `source_message` ENABLE KEYS */;

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

-- Дамп данных таблицы yii_botshop_advanced.user: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `first_name`, `last_name`, `avatar`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Z_tYa2wztRkLPPAx-4Hu2iNa2f1RfYFa', '', '', '', 10, 1538365561, 1538365561),
	(343142692, 'voinmerk', 'mynMKut58nbBddoHMgHV3m4Licr8GGzi', 'Evgeniy', 'Voyt', 'https://t.me/i/userpic/320/voinmerk.jpg', 10, 1538387854, 1538387854);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

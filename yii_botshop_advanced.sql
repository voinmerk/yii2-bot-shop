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
	('admin', '343142692', 1538975695),
	('user', '343142692', 1538975695);
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

-- Дамп данных таблицы yii_botshop_advanced.auth_item: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('admin', 1, NULL, NULL, NULL, 1538975695, 1538975695),
	('adminUpdateBot', 2, 'Edit the bot', NULL, NULL, 1538975695, 1538975695),
	('editor', 1, NULL, NULL, NULL, 1538975695, 1538975695),
	('moderator', 1, NULL, NULL, NULL, 1538975695, 1538975695),
	('user', 1, NULL, NULL, NULL, 1538975695, 1538975695),
	('userAddBot', 2, 'Adding a bot by the user', NULL, NULL, 1538975695, 1538975695),
	('viewControlPanel', 2, 'View control panel', NULL, NULL, 1538975695, 1538975695);
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

-- Дамп данных таблицы yii_botshop_advanced.auth_item_child: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('editor', 'adminUpdateBot'),
	('admin', 'editor'),
	('user', 'userAddBot'),
	('editor', 'viewControlPanel');
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

-- Дамп структуры для таблица yii_botshop_advanced.bot
CREATE TABLE IF NOT EXISTS `bot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `username` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `start_param` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `default_category_id` int(11) DEFAULT NULL,
  `author_by` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `moderated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`username`),
  UNIQUE KEY `token` (`token`),
  KEY `FK_bot_user_author` (`author_by`),
  KEY `FK_bot_user_added` (`added_by`),
  KEY `FK_bot_user_moderated` (`moderated_by`),
  KEY `FK_bot_bot_category` (`default_category_id`),
  CONSTRAINT `FK_bot_bot_category` FOREIGN KEY (`default_category_id`) REFERENCES `bot_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bot_user_added` FOREIGN KEY (`added_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bot_user_author` FOREIGN KEY (`author_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bot_user_moderated` FOREIGN KEY (`moderated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `bot` DISABLE KEYS */;
INSERT INTO `bot` (`id`, `title`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `username`, `token`, `start_param`, `image`, `views`, `status`, `published`, `default_category_id`, `author_by`, `added_by`, `moderated_by`, `created_at`, `updated_at`) VALUES
	(1, 'FrontVisionBot', 'Удобный бот для работы с клиентами компании ООО FrontVision.', 'FrontVisionBot', NULL, NULL, 'frontvision_bot', '502079464:AAGVyl3_NZPLCNQFaj--DY6zKa-SOZySaiA', 'http://botshop.loc', 'frontvision.png', 0, 1, 1, 5, NULL, 343142692, 343142692, 1538469948, 1538469948),
	(16, 'SuperBot', 'Ебланский бот, который меня уже блять  заебал!!! Но вроде работает...', 'SuperBot', NULL, NULL, 'super_bot', NULL, 'http://botshop.loc', 'bot_2743be6d0ebf6116e5109ac9da8d0ca8.jpg', 0, 1, 1, 1, NULL, 343142692, NULL, 1539022056, 1539022056),
	(18, 'NewBot', 'Просто Lorem ipsum', 'Это новый бот', NULL, NULL, 'new_bot', NULL, 'http://botshop.loc', 'bot_d02a42d9cb3dec9320e5f550278911c7.jpg', 0, 2, 1, 1, NULL, 343142692, NULL, 1539088539, 1539088539);
/*!40000 ALTER TABLE `bot` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_category
CREATE TABLE IF NOT EXISTS `bot_category` (
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
  KEY `FK_bot_category_user_created` (`created_by`),
  KEY `FK_bot_category_user_updated` (`updated_by`),
  CONSTRAINT `FK_bot_category_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bot_category_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_category: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `bot_category` DISABLE KEYS */;
INSERT INTO `bot_category` (`id`, `slug`, `image`, `sort_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'games', NULL, 3, 1, 1, 1, 0, 0),
	(2, 'education', NULL, 1, 1, 1, 1, 0, 0),
	(3, 'social', NULL, 2, 1, 1, 1, 0, 0),
	(4, 'shops', NULL, 4, 1, 1, 1, 0, 0),
	(5, 'utilities', NULL, 5, 1, 1, 1, 0, 0),
	(6, 'entertainment', NULL, 6, 1, 1, 1, 0, 0),
	(7, 'news', NULL, 7, 1, 1, 1, 0, 0);
/*!40000 ALTER TABLE `bot_category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_category_translate
CREATE TABLE IF NOT EXISTS `bot_category_translate` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  KEY `FK_bot_category_translate_bot_category` (`category_id`),
  KEY `FK_bot_category_translate_language` (`language_id`),
  CONSTRAINT `FK_bot_category_translate_bot_category` FOREIGN KEY (`category_id`) REFERENCES `bot_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bot_category_translate_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_category_translate: ~14 rows (приблизительно)
/*!40000 ALTER TABLE `bot_category_translate` DISABLE KEYS */;
INSERT INTO `bot_category_translate` (`category_id`, `language_id`, `title`, `content`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
	(1, 1, 'Игры', NULL, 'Игры', NULL, NULL),
	(1, 2, 'Games', NULL, 'Games', NULL, NULL),
	(2, 1, 'Образование', NULL, 'Образование', NULL, NULL),
	(2, 2, 'Education', NULL, 'Education', NULL, NULL),
	(3, 1, 'Социальные', NULL, 'Социальные', NULL, NULL),
	(3, 2, 'Social', NULL, 'Social', NULL, NULL),
	(4, 1, 'Магазины', NULL, 'Магазины', NULL, NULL),
	(4, 2, 'Shops', NULL, 'Shops', NULL, NULL),
	(5, 1, 'Инструменты', NULL, 'Инструменты', NULL, NULL),
	(5, 2, 'Utilities', NULL, 'Utilities', NULL, NULL),
	(6, 1, 'Развлечения', NULL, 'Развлечения', NULL, NULL),
	(6, 2, 'Entertainment', NULL, 'Entertainment', NULL, NULL),
	(7, 1, 'Новости', NULL, 'Новости', NULL, NULL),
	(7, 2, 'News', NULL, 'News', NULL, NULL);
/*!40000 ALTER TABLE `bot_category_translate` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_comment
CREATE TABLE IF NOT EXISTS `bot_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `bot_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bot_comment_user_created` (`created_by`),
  KEY `FK_bot_comment_user_updated` (`updated_by`),
  KEY `FK_bot_comment_bot` (`bot_id`),
  CONSTRAINT `FK_bot_comment_bot` FOREIGN KEY (`bot_id`) REFERENCES `bot` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bot_comment_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bot_comment_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_comment: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `bot_comment` DISABLE KEYS */;
INSERT INTO `bot_comment` (`id`, `content`, `bot_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(4, 'Hello, guys!', 1, 343142692, NULL, 1539064329, 1539064329),
	(7, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 1, 343142692, NULL, 1539064756, 1539064756),
	(8, 'Комменты комменты', 1, 343142692, NULL, 1539064930, 1539064930),
	(9, 'Привет', 1, 343142692, NULL, 1539064998, 1539064998),
	(10, 'Что за еблан на фото?', 16, 343142692, NULL, 1539065744, 1539065744);
/*!40000 ALTER TABLE `bot_comment` ENABLE KEYS */;

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

-- Дамп структуры для таблица yii_botshop_advanced.bot_tag
CREATE TABLE IF NOT EXISTS `bot_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_tag: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `bot_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `bot_tag` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_to_bot_category
CREATE TABLE IF NOT EXISTS `bot_to_bot_category` (
  `bot_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_to_bot_category: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `bot_to_bot_category` DISABLE KEYS */;
INSERT INTO `bot_to_bot_category` (`bot_id`, `category_id`) VALUES
	(1, 5),
	(16, 1),
	(16, 2),
	(16, 3),
	(18, 1);
/*!40000 ALTER TABLE `bot_to_bot_category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_to_bot_language
CREATE TABLE IF NOT EXISTS `bot_to_bot_language` (
  `bot_id` int(11) NOT NULL,
  `bot_language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_to_bot_language: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `bot_to_bot_language` DISABLE KEYS */;
INSERT INTO `bot_to_bot_language` (`bot_id`, `bot_language_id`) VALUES
	(1, 1),
	(1, 3),
	(16, 1),
	(16, 2),
	(18, 3);
/*!40000 ALTER TABLE `bot_to_bot_language` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.bot_to_bot_tag
CREATE TABLE IF NOT EXISTS `bot_to_bot_tag` (
  `bot_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.bot_to_bot_tag: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `bot_to_bot_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `bot_to_bot_tag` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.language
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.language: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `language` DISABLE KEYS */;
INSERT INTO `language` (`id`, `name`, `code`, `default`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Русский', 'ru', 0, 1, 1, 0, 0),
	(2, 'English', 'en', 1, 1, 1, 0, 0);
/*!40000 ALTER TABLE `language` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.language_message
CREATE TABLE IF NOT EXISTS `language_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_source_message_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii_botshop_advanced.language_message: ~36 rows (приблизительно)
/*!40000 ALTER TABLE `language_message` DISABLE KEYS */;
INSERT INTO `language_message` (`id`, `category`, `message`) VALUES
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
	(13, 'frontend', 'Bots'),
	(14, 'frontend', 'There is nothing in this category!'),
	(15, 'frontend', 'There is nothing in the catalog!'),
	(16, 'frontend', 'This category does not exist!'),
	(17, 'frontend', 'This bot does not exist!'),
	(18, 'frontend', 'The above error occurred while the Web server was processing your request.'),
	(19, 'frontend', 'Please contact us if you think this is a server error. Thank you!'),
	(20, 'frontend', 'At your request, nothing found!'),
	(21, 'frontend', 'Response to query: {query}'),
	(22, 'frontend', 'The list of categories is not filled!'),
	(23, 'frontend', 'Search...'),
	(24, 'frontend', 'You have not added a single bot, you can do this by clicking on the link: {link}'),
	(25, 'frontend', 'Comment'),
	(26, 'frontend', '{icon} Send'),
	(27, 'frontend', 'Comments'),
	(28, 'frontend', 'Reports'),
	(29, 'frontend', 'The bot has been successfully added!'),
	(30, 'frontend', '{icon} Save'),
	(31, 'frontend', 'Update bot: {bot}'),
	(32, 'frontend', 'Development'),
	(33, 'frontend', 'Successful authorization on the site {link}'),
	(34, 'frontend', 'Unprocessed error!'),
	(35, 'frontend', 'Send report'),
	(36, 'frontend', 'message test');
/*!40000 ALTER TABLE `language_message` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.language_message_translate
CREATE TABLE IF NOT EXISTS `language_message_translate` (
  `id` int(11) NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`,`language`),
  KEY `idx_message_language` (`language`),
  CONSTRAINT `fk_language_message_translate_language_message` FOREIGN KEY (`id`) REFERENCES `language_message` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii_botshop_advanced.language_message_translate: ~72 rows (приблизительно)
/*!40000 ALTER TABLE `language_message_translate` DISABLE KEYS */;
INSERT INTO `language_message_translate` (`id`, `language`, `translation`) VALUES
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
	(13, 'ru', 'Боты'),
	(14, 'en', 'There is nothing in this category!'),
	(14, 'ru', 'В этой категории ничего нет!'),
	(15, 'en', 'There is nothing in the catalog!'),
	(15, 'ru', 'В каталоге ничего нет!'),
	(16, 'en', 'This category does not exist!'),
	(16, 'ru', 'Этой категории не существует!'),
	(17, 'en', 'This bot does not exist!'),
	(17, 'ru', 'Этого бота не существует!'),
	(18, 'en', 'The above error occurred while the Web server was processing your request.'),
	(18, 'ru', 'Вышеуказанная ошибка произошла во время обработки запроса веб-сервером.'),
	(19, 'en', 'Please contact us if you think this is a server error. Thank you!'),
	(19, 'ru', 'Пожалуйста, свяжитесь с нами, если вы думаете, что это ошибка сервера. Спасибо!'),
	(20, 'en', 'At your request, nothing found!'),
	(20, 'ru', 'По вашему запросу, ничего не найдено!'),
	(21, 'en', 'Response to query: {query}'),
	(21, 'ru', 'Ответ по запросу: {query}'),
	(22, 'en', 'The list of categories is not filled!'),
	(22, 'ru', 'Список категорий не заполнен!'),
	(23, 'en', 'Search...'),
	(23, 'ru', 'Искать...'),
	(24, 'en', 'You have not added a single bot, you can do this by clicking on the link: {link}'),
	(24, 'ru', 'Вы не добавили ни одного бота, сделать это можно перейдя по ссылке: {link}'),
	(25, 'en', 'Comment'),
	(25, 'ru', 'Комментарий'),
	(26, 'en', '{icon} Send'),
	(26, 'ru', '{icon} Отправить'),
	(27, 'en', 'Comments'),
	(27, 'ru', 'Комментарии'),
	(28, 'en', 'Reports'),
	(28, 'ru', 'Репорты'),
	(29, 'en', 'The bot has been successfully added!'),
	(29, 'ru', 'Бот успешно добавлен!'),
	(30, 'en', '{icon} Save'),
	(30, 'ru', '{icon} Сохранить'),
	(31, 'en', 'Update bot: {bot}'),
	(31, 'ru', 'Редактировать бота: {bot}'),
	(32, 'en', 'Development'),
	(32, 'ru', 'Разработка'),
	(33, 'en', 'Successful authorization on the site {link}'),
	(33, 'ru', 'Успешная авторизация на сайте {link}'),
	(34, 'en', 'Unprocessed error!'),
	(34, 'ru', 'Необработанная ошибка!'),
	(35, 'en', 'Send report'),
	(35, 'ru', 'Отправить репорт'),
	(36, 'en', 'Message test'),
	(36, 'ru', 'Тест сообщения');
/*!40000 ALTER TABLE `language_message_translate` ENABLE KEYS */;

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

-- Дамп структуры для таблица yii_botshop_advanced.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_post_user_created` (`created_by`),
  KEY `FK_post_user_updated` (`updated_by`),
  CONSTRAINT `FK_post_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_post_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.post: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `image`, `slug`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'uploads/post/1.png', 'first-post', 1, 343142692, 343142692, 0, 0);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.post_category
CREATE TABLE IF NOT EXISTS `post_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `template` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `FK_post_category_user_created` (`created_by`),
  KEY `FK_post_category_user_updated` (`updated_by`),
  CONSTRAINT `FK_post_category_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_post_category_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.post_category: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `post_category` DISABLE KEYS */;
INSERT INTO `post_category` (`id`, `slug`, `image`, `template`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'faq', '', 0, 1, 343142692, 343142692, 0, 0);
/*!40000 ALTER TABLE `post_category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.post_category_translate
CREATE TABLE IF NOT EXISTS `post_category_translate` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  KEY `FK_post_category_translate_post_category` (`category_id`),
  KEY `FK_post_category_translate_language` (`language_id`),
  CONSTRAINT `FK_post_category_translate_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_category_translate_post_category` FOREIGN KEY (`category_id`) REFERENCES `post_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.post_category_translate: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `post_category_translate` DISABLE KEYS */;
INSERT INTO `post_category_translate` (`category_id`, `language_id`, `title`, `content`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
	(1, 1, 'FAQ', NULL, 'FAQ', NULL, NULL),
	(1, 2, 'FAQ', NULL, 'FAQ', NULL, NULL);
/*!40000 ALTER TABLE `post_category_translate` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.post_comment
CREATE TABLE IF NOT EXISTS `post_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_comment_user_created` (`created_by`),
  KEY `FK_post_comment_user_updated` (`updated_by`),
  KEY `FK_post_comment_post` (`post_id`),
  CONSTRAINT `FK_post_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_comment_user_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_post_comment_user_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.post_comment: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `post_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_comment` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.post_tag
CREATE TABLE IF NOT EXISTS `post_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.post_tag: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.post_to_post_category
CREATE TABLE IF NOT EXISTS `post_to_post_category` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.post_to_post_category: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `post_to_post_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_to_post_category` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.post_to_post_tag
CREATE TABLE IF NOT EXISTS `post_to_post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.post_to_post_tag: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `post_to_post_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_to_post_tag` ENABLE KEYS */;

-- Дамп структуры для таблица yii_botshop_advanced.post_translate
CREATE TABLE IF NOT EXISTS `post_translate` (
  `post_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `preview_content` text NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text,
  `meta_description` text,
  KEY `FK_post_trasnlate_post` (`post_id`),
  KEY `FK_post_trasnlate_language` (`language_id`),
  CONSTRAINT `FK_post_trasnlate_language` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_trasnlate_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii_botshop_advanced.post_translate: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `post_translate` DISABLE KEYS */;
INSERT INTO `post_translate` (`post_id`, `language_id`, `title`, `preview_content`, `content`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
	(1, 1, 'Первый пост, на русском', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', NULL, NULL),
	(1, 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', NULL, NULL);
/*!40000 ALTER TABLE `post_translate` ENABLE KEYS */;

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

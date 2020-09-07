-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 07 2020 г., 14:30
-- Версия сервера: 5.6.43
-- Версия PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2-newshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `title`, `description`, `keywords`, `img`) VALUES
(1, 0, 'Branded Foods', 'Branded Foods keywords', 'Branded Foods description!', 'images/2020-04-09/5e8eeb547a8d2_12.jpg'),
(2, 0, 'Households', 'Households keywords', 'Households description', 'images/2020-04-09/5e8eeb6d453d5_16.jpg'),
(3, 0, 'Veggies & Fruits', 'Veggies & Fruits description', 'Veggies & Fruits keywords', 'images/2020-04-09/5e8eeb82675fc_17.jpg'),
(4, 3, 'Vegetables', 'Vegetables description', 'Vegetables keywords', 'images/2020-04-09/5e8eeb9e10409_2.jpg'),
(5, 3, 'Fruits', 'Fruits description', 'Fruits keywords', 'images/2020-04-09/5e8eebb7d2820_12.jpg'),
(6, 0, 'Kitchen', 'Kitchen description', 'Kitchen keywords', 'images/2020-04-09/5e8eebd544e24_21.jpg'),
(7, 0, 'Short Codes', '', '', 'images/2020-04-09/5e8eebec919de_28.jpg'),
(8, 0, 'Beverages', '222', '111', 'images/2020-04-09/5e8eec0ba6d82_25.jpg'),
(9, 8, 'Soft Drinks', '222', '', 'images/2020-04-09/5e8eec67693b9_3.jpg'),
(10, 8, 'Juices', '', '', 'images/2020-04-09/5e8eec9c60f33_12.jpg'),
(11, 0, 'Pet Food', 'Pet Food description', 'Pet Food ', 'images/2020-04-09/5e8eeccb4f275_27.jpg'),
(12, 0, 'Frozen Foods', 'Frozen Foods description', 'Frozen Foods', 'images/2020-04-09/5e8eecf98a32a_17.jpg'),
(13, 12, 'Frozen Snacks', 'Frozen Snacks description', 'Frozen Snacks', 'images/2020-04-09/5e8eed542ce9b_1.jpg'),
(14, 12, 'Frozen Nonveg', 'Frozen Nonveg description', 'Frozen Nonveg', 'images/2020-04-09/5e8eed8b3164f_25.jpg'),
(15, 0, 'Bread & Bakery', 'Bread & Bakery description', 'Bread & Bakery', 'images/2020-04-09/5e8eedb185801_26.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `category_product`
--

CREATE TABLE `category_product` (
  `id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `title`) VALUES
(1, 1, 'food'),
(2, 1, 'beverages'),
(3, 1, 'vegetables & fruits'),
(4, 2, 'cleaning'),
(5, 2, 'utenstil'),
(6, 2, 'pet food'),
(7, 10, 'SOFT DRINKS'),
(8, 10, 'JUICES'),
(9, 10, 'ENERGY DRINKS'),
(10, 15, '');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `qty` tinyint(3) UNSIGNED NOT NULL,
  `total` decimal(6,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `qty`, `total`, `status`, `name`, `email`, `phone`, `address`, `note`) VALUES
(1, '2020-03-13 23:00:11', '2020-03-13 23:00:11', 5, '15.00', 1, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(3, '2020-03-13 23:09:48', '2020-03-26 13:28:01', 4, '16.00', 1, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', '111111'),
(4, '2020-03-16 13:31:34', '2020-03-16 13:31:34', 2, '4.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', '111'),
(5, '2020-03-16 13:32:43', '2020-03-16 13:32:43', 2, '4.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', '111'),
(6, '2020-03-16 13:32:47', '2020-03-16 13:32:47', 2, '4.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', '111'),
(7, '2020-03-16 13:33:04', '2020-03-16 13:33:04', 2, '4.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(8, '2020-03-16 13:36:25', '2020-03-16 13:36:25', 2, '4.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(9, '2020-03-16 13:37:50', '2020-03-16 13:37:50', 2, '4.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(10, '2020-03-16 13:38:16', '2020-03-16 13:38:16', 2, '4.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(11, '2020-03-16 13:39:08', '2020-03-16 13:39:08', 2, '4.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(12, '2020-03-16 13:45:21', '2020-03-16 13:45:21', 2, '4.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(13, '2020-03-16 14:32:40', '2020-03-16 14:32:40', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(14, '2020-03-16 14:35:07', '2020-03-16 14:35:07', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(15, '2020-03-16 14:38:05', '2020-03-16 14:38:05', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(16, '2020-03-16 14:39:53', '2020-03-16 14:39:53', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(17, '2020-03-16 14:40:27', '2020-03-16 14:40:27', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(18, '2020-03-16 14:40:37', '2020-03-16 14:40:37', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(19, '2020-03-16 14:41:31', '2020-03-16 14:41:31', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(20, '2020-03-16 14:44:26', '2020-03-16 14:44:26', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(21, '2020-03-16 14:44:48', '2020-03-16 14:44:48', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(22, '2020-03-16 14:44:55', '2020-03-24 23:25:40', 1, '5.00', 1, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(23, '2020-03-16 14:48:45', '2020-03-20 17:49:05', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', 'Примечание менеджера'),
(24, '2020-03-17 09:54:47', '2020-03-17 09:54:47', 1, '3.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', '111'),
(25, '2020-03-17 09:57:33', '2020-03-17 09:57:33', 1, '3.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(26, '2020-03-17 10:16:41', '2020-03-17 10:16:41', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(27, '2020-03-17 10:17:21', '2020-03-17 10:17:21', 1, '5.00', 0, 'Ivan', 'taf_397@yahoo.com', '89312667119', 'Науки пр., д.63-60', ''),
(28, '2020-03-24 22:41:49', '2020-03-24 22:41:49', 3, '100.00', 1, 'Ivan', 'linnike@list.ru', '+79523685861', 'Mooni 21-14', ''),
(29, '2020-04-05 22:34:48', '2020-04-05 22:34:48', 1, '3.00', 0, 'Ivan', 'vanotur2006@gmail.com', '89046440687', 'Невзоровой', '');

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `qty` tinyint(4) NOT NULL,
  `total` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `title`, `price`, `qty`, `total`) VALUES
(1, 1, 1, 'knorr instant soup (100 gm)', '3.00', 5, '15.00'),
(5, 3, 35, 'Bread Wheat Pita (250 Gm)', '4.00', 4, '16.00'),
(6, 4, 33, 'Raisin Rolls (2 In 1 Pack)', '2.00', 2, '4.00'),
(7, 5, 33, 'Raisin Rolls (2 In 1 Pack)', '2.00', 2, '4.00'),
(8, 6, 33, 'Raisin Rolls (2 In 1 Pack)', '2.00', 2, '4.00'),
(9, 7, 33, 'Raisin Rolls (2 In 1 Pack)', '2.00', 2, '4.00'),
(10, 8, 33, 'Raisin Rolls (2 In 1 Pack)', '2.00', 2, '4.00'),
(11, 9, 33, 'Raisin Rolls (2 In 1 Pack)', '2.00', 2, '4.00'),
(12, 10, 33, 'Raisin Rolls (2 In 1 Pack)', '2.00', 2, '4.00'),
(13, 11, 33, 'Raisin Rolls (2 In 1 Pack)', '2.00', 2, '4.00'),
(14, 12, 33, 'Raisin Rolls (2 In 1 Pack)', '2.00', 2, '4.00'),
(15, 13, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(16, 14, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(17, 15, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(18, 16, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(19, 17, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(20, 18, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(21, 19, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(22, 20, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(23, 21, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(24, 22, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(25, 23, 2, 'chings noodles (75 gm)', '5.00', 1, '5.00'),
(26, 24, 17, 'Dish Wash Bar (500 Gm)', '3.00', 1, '3.00'),
(27, 25, 18, 'Air Freshener (50 Gm)', '3.00', 1, '3.00'),
(28, 26, 4, 'premium bake rusk (350 gm)', '5.00', 1, '5.00'),
(29, 27, 4, 'premium bake rusk (350 gm)', '5.00', 1, '5.00'),
(30, 29, 3, 'lahsun (150 gm)', '3.00', 1, '3.00');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `old_price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `is_offer` tinyint(4) NOT NULL,
  `gift` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `content`, `price`, `old_price`, `description`, `keywords`, `img`, `is_offer`, `gift`) VALUES
(1, 1, 'knorr instant soup (100 gm)', '<p><img alt=\"\" src=\"/upload/files/some/sub/path/product9.jpg\" style=\"float:right; height:200px; width:134px\" />Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?!!!</p>\r\n\r\n<p><strong>Lorem ipsum dolor sit ame</strong>t, consectetur adipisicing elit. <em>Cumque, debitis evenie</em>t exercitationem odio odit provident?!!!</p>\r\n', '3.00', '0.00', 'soup description', 'knorr keywords', 'images/2020-04-05/5e89b12a8864d_5.png', 0, 1),
(2, 1, 'chings noodles (75 gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?</p>\r\n', '5.00', '6.00', '', '', 'images/2020-04-05/5e89b1827a5af_6.png', 0, 0),
(3, 1, 'lahsun (150 gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident.Cumque, debitis eveniet exercitationem odio odit provident.</p>\r\n', '3.00', '6.00', 'lahsun  description', 'lahsun  keywords', 'images/2020-04-05/5e89b199b3930_7.png', 1, 1),
(4, 1, 'premium bake rusk (350 gm)', '<p>Cumque, debitis eveniet exercitationem odio odit provident.Cumque, debitis eveniet exercitationem odio odit provident.</p>\r\n', '5.00', '8.00', '', '', 'images/2020-04-05/5e89b1b524d97_8.png', 1, 0),
(5, 8, 'fresh spinach (palak)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?</p>\r\n', '2.00', '3.00', '', '', 'images/2020-04-05/5e89b28f2cbd2_9.png', 1, 1),
(6, 8, 'fresh mango dasheri (1 kg)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?</p>\r\n', '5.00', '8.00', '', '', 'images/2020-04-05/5e89b27d16769_10.jpg', 0, 0),
(7, 8, 'fresh apple red (1 kg)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?</p>\r\n', '6.00', '8.00', '', '', 'images/2020-04-05/5e89b2b279aca_11.png', 1, 1),
(8, 8, 'fresh broccoli (500 gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit provident?</p>\r\n', '4.00', '6.00', '', '', 'images/2020-04-05/5e89b2c48e281_12.png', 1, 0),
(9, 10, 'mixed fruit juice (500 gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '3.00', '0.00', '', '', 'images/2020-04-05/5e89b2e6b3340_13.png', 1, 1),
(10, 10, 'prune juice-sunsweet (1 ltr)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '4.00', '0.00', '', '', 'images/2020-04-05/5e89b305b47f3_14.png', 1, 0),
(11, 10, 'coca-cola zero can(330 ml)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '3.00', '0.00', '', '', 'images/2020-04-05/5e89b3201cfb6_15.png', 1, 1),
(12, 8, 'sprite bottle(2 ltr)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '3.00', '0.00', '', '', 'images/2020-04-05/5e89b33988a04_16.png', 1, 0),
(13, 9, 'Fortune Sunflower Oil', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '7.99', '10.00', '', '', 'images/2020-04-05/5e89b37a1f192_1.png', 1, 1),
(16, 2, 'Dishwash Gel, Lemon (1.5 Ltr)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '8.00', '10.00', '', '', 'images/2020-04-05/5e89b395b1310_17.png', 1, 0),
(17, 2, 'Dish Wash Bar (500 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '3.00', '4.00', '', '', 'images/2020-04-05/5e89b3bfce071_18.png', 1, 0),
(18, 2, 'Air Freshener (50 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '3.00', '5.00', '', '', 'images/2020-04-05/5e89b3e3b886f_19.png', 1, 0),
(19, 2, 'Toilet Cleaner Expert (1 Ltr)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '6.00', '7.00', '', '', 'images/2020-04-05/5e89b3f5410c7_20.png', 1, 0),
(20, 2, 'Princeware Packaging Container Pack (6 No\'s)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '8.00', '10.00', '', '', 'images/2020-04-05/5e89b4257eb01_21.png', 1, 0),
(21, 2, 'Signoraware Container Center Press (900 Ml)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '7.00', '11.00', '', '', 'images/2020-04-05/5e89b44003311_22.png', 1, 0),
(22, 2, 'Ship Stainless Steel Sauce Pan Single (1 Pc)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '6.00', '8.00', '', '', 'images/2020-04-05/5e89b45a7542c_23.png', 1, 0),
(23, 2, 'Omega Stainless Steel Puri Dabba (1 Pc)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '6.00', '8.00', '', '', 'images/2020-04-05/5e89b47c53be1_24.png', 1, 0),
(24, 11, 'Food For Adult Dogs (80 Gms)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '3.00', '5.00', '', '', 'images/2020-04-05/5e89b83923e90_25.png', 1, 0),
(25, 11, 'Young Adult Dogs (1.2 Kg)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '6.00', '9.00', '', '', 'images/2020-04-09/5e8ef106a400c_26.png', 1, 0),
(26, 11, 'Cat Food Ocean Fish (1.4 Kg)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '6.00', '8.00', '', '', 'images/2020-04-09/5e8ef12ec751c_27.png', 1, 0),
(27, 11, 'Chicken In Jelly Can (400 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '7.00', '9.00', '', '', 'images/2020-04-09/5e8ef16488df1_28.png', 1, 0),
(28, 10, 'Schweppes Water (250 Ltr)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '2.00', '4.00', '', '', 'images/2020-04-05/5e89b8ba722a1_55.png', 1, 0),
(29, 10, 'Red Bull Energy Drink (250 Ml)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '3.00', '4.00', '', '', 'images/2020-04-05/5e89b8d106f2a_56.png', 1, 0),
(30, 10, 'Ceres Orange Juice (1 Ltr)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '4.00', '5.00', '', '', 'images/2020-04-09/5e8ef1ef91373_52.png', 1, 0),
(31, 10, 'Red Bull Energy Drink (250 Ml)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>\r\n', '3.00', '4.00', '', '', 'images/2020-04-09/5e8ef20b00fa3_56.png', 1, 0),
(32, 10, 'prune juice-sunsweet (1 ltr)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '4.00', '0.00', '', '', 'images/2020-04-05/5e89b8f412c9e_14.png', 1, 0),
(33, 15, 'Raisin Rolls (2 In 1 Pack)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '2.00', '3.00', '', '', 'images/2020-04-05/5e89b91b53548_37.png', 0, 0),
(34, 15, 'Butter Croissants (50 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '2.00', '3.50', '', '', 'images/2020-04-05/5e89b93a9306c_38.png', 1, 0),
(35, 15, 'Bread Wheat Pita (250 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '4.00', '5.50', '', '', 'images/2020-04-05/5e89b95a14056_39.png', 1, 0),
(36, 15, 'Hot Dog Roll (150 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '3.49', '5.50', '', '', 'images/2020-04-05/5e89b97e49307_40.png', 1, 0),
(37, 15, 'Masala Bread (500 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '1.99', '2.50', '', '', 'images/2020-04-05/5e89b9974e50f_41.png', 1, 0),
(38, 15, 'Rolls Chocolate (3 Pcs)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '4.99', '6.50', '', '', 'images/2020-04-05/5e89b9afe1eb4_42.png', 1, 0),
(39, 15, 'Wheat Masala Pav (500 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '5.00', '6.50', '', '', 'images/2020-04-05/5e89b9d07d94a_43.png', 1, 1),
(40, 15, 'Baked - Garlic Bread (200 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '4.00', '6.50', '', '', 'images/2020-04-05/5e89ba10187f9_44.png', 0, 1),
(41, 15, 'Eggless Walnut (250 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '4.50', '6.50', '', '', 'images/2020-04-05/5e89ba2abec4d_45.png', 0, 1),
(42, 15, 'Assorted Muffins (200 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '3.50', '5.50', '', '', 'images/2020-04-05/5e89ba3fe9b28_46.png', 1, 0),
(43, 15, 'Bagels - Sesame (200 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '6.50', '7.50', '', '', 'images/2020-04-05/5e89ba5c59d8d_47.png', 0, 1),
(44, 15, 'Flax & Walnut Loaf (400 Gm)', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, debitis eveniet exercitationem odio odit provident?Cumque, debitis eveniet exercitationem odio odit.</p>\r\n', '8.50', '10.50', '', '', 'images/2020-04-05/5e89ba7b2a963_48.png', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `related_product`
--

CREATE TABLE `related_product` (
  `product_id` int(10) NOT NULL,
  `related_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `related_product`
--

INSERT INTO `related_product` (`product_id`, `related_id`) VALUES
(1, 2),
(1, 3),
(1, 2),
(1, 3),
(1, 11),
(1, 10),
(2, 12),
(2, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `post` text NOT NULL,
  `created_at` datetime NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `username`, `email`, `post`, `created_at`, `rating`) VALUES
(1, 1, 'Peter', 'taf_397@yahoo.com', 'Lorem ipsum dolor', '2020-09-07 13:00:55', 1.5),
(2, 1, 'Andrew', 'linnike@list.ru', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, distinctio dolorem harum necessitatibus sed unde.', '2020-09-07 13:02:04', 3),
(3, 1, 'Andrew', 'taf_397@yahoo.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, distinctio dolorem harum necessitatibus sed unde.', '2020-09-07 13:04:24', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `fio`, `password`, `auth_key`) VALUES
(1, 'admin', 'Иван Петров', '$2y$13$oO04a1TdbWuwm7PQp.uDMOwop58M24T40NDIjWqr2XoOMscbPScZO', 'PKkcO402U8QZJVF23uqQVPeFbZTgZcNa');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

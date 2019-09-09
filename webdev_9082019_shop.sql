-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 08 2019 г., 20:00
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `webdev_9082019_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catalogs`
--

CREATE TABLE `catalogs` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalogs`
--

INSERT INTO `catalogs` (`id`, `name`) VALUES
(1, 'Мужчинам'),
(2, 'Женщинам'),
(3, 'Детям');

-- --------------------------------------------------------

--
-- Структура таблицы `catalogs_products`
--

CREATE TABLE `catalogs_products` (
  `id` int(11) NOT NULL,
  `catalog_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalogs_products`
--

INSERT INTO `catalogs_products` (`id`, `catalog_id`, `product_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 8),
(10, 1, 9),
(11, 1, 10),
(12, 1, 11),
(13, 1, 12);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `text` text NOT NULL,
  `sku` varchar(255) NOT NULL,
  `size` varchar(10) NOT NULL DEFAULT 'M',
  `category` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `pic`, `price`, `text`, `sku`, `size`, `category`) VALUES
(1, 'Куртка синяя', '1.jpg', 5400, 'Куртка синяя', '552233', 'M', 1),
(2, 'Кожаная куртка', '2.jpg', 22500, 'Кожаная куртка', '112244', 'L', 1),
(3, 'Куртка с карманами', '3.png', 9200, 'Куртка с карманами', '554463', 'M', 1),
(4, 'Куртка с капюшоном', '2.jpg', 6100, 'Куртка с капюшоном', '455211', 'M', 1),
(5, 'Куртка Casual', '5.jpg', 8800, 'Куртка Casual', '6633221', 'M', 1),
(6, 'Стильная кожаная куртка', '6.jpg', 12800, 'Стильная кожаная куртка', '4488862', 'M', 1),
(7, 'Кеды серые', '7.jpg', 2900, 'Кеды серые', '5544220', 'M', 2),
(8, 'Кеды черные', '8.jpg', 4500, 'Кеды черные', '9966550', 'M', 2),
(9, 'Кеды Casual', '9.jpg', 5900, 'Кеды Casual', '66322450', 'M', 2),
(10, 'Кеды всепогодные', '10.jpg', 9200, 'Кеды всепогодные', '551552', 'M', 2),
(11, 'Джинсы', '11.jpg', 4800, 'Джинсы', '223366400', 'M', 1),
(12, 'Джинсы голубые', '12.jpg', 4200, 'Джинсы голубые', '55112200', 'M', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catalogs`
--
ALTER TABLE `catalogs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `catalogs_products`
--
ALTER TABLE `catalogs_products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catalogs`
--
ALTER TABLE `catalogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `catalogs_products`
--
ALTER TABLE `catalogs_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

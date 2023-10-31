-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 31 2023 г., 09:37
-- Версия сервера: 11.1.0-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sf-adtech`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(2, 'Обучение'),
(7, 'Строительство'),
(8, 'Услуги'),
(9, 'Продажи'),
(10, 'Другое');

-- --------------------------------------------------------

--
-- Структура таблицы `clicks`
--

CREATE TABLE `clicks` (
  `id` int(10) NOT NULL,
  `subscription_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `clicks`
--

INSERT INTO `clicks` (`id`, `subscription_id`, `date`, `status`) VALUES
(1, 2, '2023-10-10', 'success'),
(2, 2, '2023-10-10', 'success'),
(3, 2, '2023-10-12', 'success'),
(4, 2, '2023-10-12', 'success'),
(5, 2, '2023-10-12', 'success'),
(6, 2, '2023-10-15', 'success'),
(7, 12, '2023-10-30', 'denial'),
(8, 12, '2023-10-30', 'denial'),
(9, 12, '2023-10-30', 'success'),
(10, 12, '2023-10-30', 'success'),
(11, 14, '2023-10-30', 'success'),
(12, 14, '2023-10-30', 'success'),
(13, 14, '2023-10-12', 'success'),
(14, 14, '2023-10-12', 'success'),
(15, 14, '2023-10-30', 'success'),
(16, 14, '2023-10-30', 'success'),
(17, 12, '2023-10-30', 'success'),
(18, 12, '2023-10-30', 'success'),
(19, 22, '2023-10-30', 'success'),
(20, 25, '2023-10-30', 'success');

-- --------------------------------------------------------

--
-- Структура таблицы `offers`
--

CREATE TABLE `offers` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `offer_name` varchar(255) NOT NULL,
  `price` decimal(7,2) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `offers`
--

INSERT INTO `offers` (`id`, `category_id`, `offer_name`, `price`, `url`, `status`) VALUES
(2, 2, 'Курс Web-разработчик с нуля', 20.00, 'https://itcub.com/getcourse/web', 'A'),
(3, 9, 'Мягкая мебель от производителя', 15.00, 'https://mebeltest.com', 'N'),
(8, 8, 'Организация свадеб', 8.00, 'https://testexample.com', 'N'),
(9, 2, 'Сезонные скидки на обучающие курсы', 12.00, 'https://itcub.com/getcourse/seles', 'N'),
(29, 8, 'Изготовление тортов на заказ', 7.00, 'https://testexample1.com', 'A'),
(31, 8, 'Оформление праздников', 7.00, 'https://testexample2.com', 'N'),
(33, 8, 'Доставка цветов', 8.00, 'https://testexample3.com', 'N'),
(34, 8, 'Организация корпоративных мероприятий', 16.00, 'https://testexample4.com', 'A'),
(35, 10, 'Some text', 23.00, 'https://testexample1.com/somelink/nextlink11111155555555/endlink111111111111111111111111111111111', 'N'),
(36, 8, 'Some text1', 20.00, 'https://testexample2.com', 'N'),
(37, 8, 'test', 20.00, 'https://testexample2.com', 'N'),
(38, 9, 'test2', 10.00, 'https://testexample2.com', 'A'),
(39, 7, 'test3', 12.00, 'https://testexample.com', 'A'),
(40, 2, 'test4', 13.00, 'https://testexample.com', 'A'),
(41, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'A'),
(42, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'A'),
(43, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'A'),
(44, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'A'),
(46, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'A'),
(47, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'A'),
(48, 10, 'Some text3', 15.00, 'https://testexample2.com', 'A'),
(51, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(52, 10, 'Some text11', 12.00, 'https://testexample.com', 'N'),
(53, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'A'),
(54, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(55, 9, 'Some text11', 22.00, 'https://testexample.com', 'N'),
(56, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(57, 9, 'Some text1', 22.00, 'https://testexample2.com', 'N'),
(58, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(59, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(60, 10, 'Some text11', 23.00, 'https://testexample2.com', 'N'),
(61, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(62, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(63, 9, 'Some text3', 31.00, 'https://testexample2.com', 'N'),
(64, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(65, 2, 'Some text1', 41.00, 'https://testexample.com', 'N'),
(66, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(67, 2, 'Some text11', 41.00, 'https://testexample2.com', 'N'),
(68, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(69, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(70, 8, 'Some text11', 41.00, 'https://testexample.com', 'N'),
(71, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(72, 8, 'Some text11', 41.00, 'https://mebeltest.com', 'N'),
(73, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(74, 8, 'Some text1', 41.00, 'https://mebeltest.com', 'N'),
(75, 8, 'Some text1', 41.00, 'https://mebeltest.com', 'N'),
(76, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(77, 2, 'Some text1', 5.00, 'https://mebeltest.com', 'N'),
(78, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(79, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(80, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(81, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(82, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(83, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(84, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(85, 8, 'Some text11', 41.00, 'https://mebeltest.com', 'N'),
(86, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(87, 8, 'Some text3', 41.00, 'https://testexample2.com', 'N'),
(88, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(89, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(90, 10, 'Some text1', 41.00, 'https://mebeltest.com', 'N'),
(91, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(92, 9, 'Some text2', 41.00, 'https://itcubtest.com/getcourse/analitics', 'N'),
(93, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(94, 9, 'Some text11', 41.00, 'https://itcubtest.com/getcourse/analitics', 'N'),
(95, 2, 'Some text1', 20.00, 'https://itcub.com/getcourse/web', 'N'),
(96, 8, 'Some text11', 41.00, 'https://testexample.com', 'N'),
(97, 9, 'Some text11', 41.00, 'https://mebeltest.com', 'N'),
(98, 2, 'test111', 121.00, 'https://testexample2.com', 'N'),
(99, 8, 'test', 41.00, 'https://testexample2.com', 'N'),
(100, 9, 'test', 41.00, 'https://testexample.com', 'A'),
(101, 9, 'test1', 41.00, 'https://testexample.com', 'N'),
(102, 10, 'test', 41.00, 'https://testexample2.com', 'N'),
(103, 2, 'test', 41.00, 'https://mebeltest.com', 'N'),
(104, 7, 'test', 41.00, 'https://testexample.com', 'N'),
(105, 7, 'test', 41.00, 'https://testexample2.com', 'N'),
(106, 0, '', 0.00, '', 'N'),
(107, 7, '', 41.00, 'https://testexample2.com', 'N'),
(108, 0, '', 0.00, '', 'N'),
(109, 0, '', 0.00, '', 'N'),
(110, 7, '', 41.00, 'https://testexample.com', 'N'),
(111, 7, '', 41.00, 'https://testexample.com', 'N'),
(112, 0, '', 0.00, '', 'N'),
(113, 0, '', 0.00, '', 'N'),
(114, 0, '', 0.00, '', 'N'),
(115, 0, '', 0.00, '', 'N'),
(116, 8, '', 41.00, 'https://testexample.com', 'N'),
(117, 8, '', 41.00, 'https://testexample.com', 'N'),
(118, 0, '', 0.00, '', 'N'),
(119, 8, '', 41.00, 'https://testexample2.com', 'N'),
(120, 7, 'test', 41.00, 'https://testexample.com', 'N'),
(121, 8, 'test', 41.00, 'https://testexample.com', 'N'),
(122, 7, 'test', 41.00, 'https://testexample.com', 'N'),
(123, 8, 'test', 41.00, 'https://testexample2.com', 'N'),
(124, 8, 'test', 41.00, 'https://testexample.com', 'N'),
(125, 2, 'test', 41.00, 'https://testexample.com', 'N'),
(126, 2, 'test', 41.00, 'https://testexample.com', 'N'),
(127, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(128, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(129, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(130, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(131, 2, 'test', 31.00, 'https://testexample.com', 'N'),
(132, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(133, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(134, 7, 'test', 31.00, 'https://mebeltest.com', 'N'),
(135, 7, 'test', 31.00, 'https://mebeltest.com', 'N'),
(136, 7, 'test', 31.00, 'https://mebeltest.com', 'N'),
(137, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(138, 7, 'test', 31.00, 'https://testexample2.com', 'N'),
(139, 7, 'test', 31.00, 'https://testexample2.com', 'N'),
(140, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(141, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(142, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(143, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(144, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(145, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(146, 2, 'test', 31.00, 'https://testexample2.com', 'N'),
(147, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(148, 8, 'test', 11.00, 'https://testexample.com', 'N'),
(149, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(150, 9, 'test', 11.00, 'https://testexample.com', 'N'),
(151, 10, 'test', 12.00, 'https://testexample.com', 'N'),
(152, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(153, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(154, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(155, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(156, 7, 'test', 11.00, 'https://itcub.com/getcourse/web', 'N'),
(157, 7, 'test', 11.00, 'https://itcub.com/getcourse/web', 'N'),
(158, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(159, 7, 'test', 11.00, 'https://itcub.com/getcourse/web', 'N'),
(160, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(161, 8, 'test', 11.00, 'https://testexample2.com', 'N'),
(162, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(163, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(164, 7, 'test', 11.00, 'https://testexample2.com', 'N'),
(165, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(166, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(167, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(168, 8, 'test', 11.00, 'https://itcub.com/getcourse/web', 'N'),
(169, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(170, 7, 'test', 11.00, 'https://mebeltest.com', 'N'),
(171, 8, 'test', 31.00, 'https://testexample.com', 'N'),
(172, 2, 'test', 11.00, 'https://testexample2.com', 'N'),
(173, 10, 'test', 11.00, 'https://testexample.com', 'N'),
(174, 9, 'test', 11.00, 'https://testexample.com', 'N'),
(175, 7, 'test', 11.00, 'https://itcubtest.com/getcourse/analitics', 'N'),
(176, 7, 'test', 62.00, 'https://testexample2.com', 'N'),
(177, 8, 'test', 22.00, 'https://testexample2.com', 'N'),
(178, 7, 'test', 33.00, 'https://testexample2.com', 'N'),
(179, 8, 'test', 33.00, 'https://testexample2.com', 'N'),
(180, 8, 'test', 44.00, 'https://testexample.com', 'N'),
(181, 8, 'test', 22.00, 'https://testexample2.com', 'N'),
(182, 9, 'test', 21.00, 'https://testexample2.com', 'N'),
(183, 8, 'test', 14.00, 'https://testexample2.com', 'N'),
(184, 7, 'test', 31.00, 'https://testexample.com', 'N'),
(185, 7, 'test', 14.00, 'https://testexample.com', 'N'),
(186, 7, 'test22', 41.00, 'https://testexample.com', 'A'),
(187, 10, 'test33', 33.00, 'https://testexample.com', 'N'),
(188, 8, 'test22', 12.00, 'https://testexample.com', 'N'),
(189, 8, 'test22', 14.00, 'https://testexample.com', 'N'),
(190, 8, 'test', 21.00, 'https://testexample2.com', 'N'),
(191, 8, 'test22', 11.00, 'https://itcub.com/getcourse/web', 'N'),
(192, 8, 'test22', 11.00, 'https://itcub.com/getcourse/web', 'N'),
(193, 9, 'test', 21.00, 'https://mebeltest.com', 'N'),
(194, 8, 'test22', 22.00, 'https://mebeltest.com', 'N'),
(195, 8, 'test', 21.00, 'https://testexample.com', 'N'),
(196, 9, 'test22', 21.00, 'https://itcubtest.com/getcourse/analitics', 'N'),
(197, 8, 'test22', 41.00, 'https://testexample2.com', 'A'),
(198, 8, 'test22', 41.00, 'https://testexample2.com', 'N'),
(199, 8, 'test22', 32.00, 'https://testexample.com', 'N'),
(200, 7, 'test22', 32.00, 'https://testexample2.com', 'N'),
(201, 7, 'test22', 32.00, 'https://testexample2.com', 'N'),
(202, 8, 'test', 12.00, 'https://testexample2.com', 'N'),
(203, 8, 'test', 12.00, 'https://testexample2.com', 'N'),
(204, 8, 'test', 22.00, 'https://testexample.com', 'N'),
(205, 7, 'test', 11.00, 'https://testexample2.com', 'N'),
(206, 8, 'test22', 12.00, 'https://testexample2.com', 'N'),
(207, 9, 'test22', 12.00, 'https://testexample2.com', 'N'),
(208, 7, 'test', 22.00, 'https://testexample.com', 'N'),
(209, 7, 'test22', 22.00, 'https://testexample2.com', 'N'),
(210, 2, 'test', 44.00, 'https://testexample2.com', 'N'),
(211, 8, 'test33', 33.00, 'https://testexample2.com', 'N'),
(212, 8, 'test33', 33.00, 'https://testexample2.com', 'N'),
(213, 8, 'test22', 22.00, 'https://testexample2.com', 'N'),
(214, 7, 'test', 21.00, 'https://testexample2.com', 'N'),
(215, 8, 'test', 12.00, 'https://testexample2.com', 'N'),
(216, 8, 'test22', 22.00, 'https://testexample2.com', 'N'),
(217, 7, 'test', 33.00, 'https://testexample.com', 'N'),
(218, 8, 'test33', 333.00, 'https://testexample2.com', 'N'),
(219, 7, 'test22', 22.00, 'https://testexample2.com', 'N'),
(220, 8, 'test33', 33.00, 'https://testexample.com', 'N'),
(221, 8, 'test', 11.00, 'https://testexample.com', 'N'),
(222, 8, 'test22', 71.00, 'https://testexample.com', 'N'),
(223, 7, 'test15', 15.00, 'https://testexample15.com', 'N'),
(224, 7, 'test17', 17.00, 'https://testexample17.com', 'A'),
(225, 8, 'test22', 21.00, 'https://testexample2.com', 'N'),
(226, 7, 'test19', 19.00, 'https://testexample19.com', 'A'),
(227, 8, 'test10', 10.00, 'https://testexample10.com', 'A'),
(228, 2, 'test111', 11.00, 'https://testexample111.com', 'A'),
(229, 10, 'test', 20.00, 'https://testexample2.com', 'N'),
(230, 7, 'test', 30.00, 'https://testexample.com', 'N'),
(231, 8, 'test22', 22.00, 'https://testexample.com', 'N'),
(232, 7, 'test17', 15.00, 'https://testexample.com', 'N'),
(233, 7, 'test223', 12.00, 'https://testexample2.com', 'N'),
(234, 10, 'test11111', 12.00, 'test@test.com', 'N');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'customer'),
(2, 'webmaster'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `offer_id` int(10) UNSIGNED NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'N',
  `refer_url` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `offer_id`, `status`, `refer_url`) VALUES
(1, 29, 'N', '$2y$10$C1wlUGKJsPeoUo1B6AW8XuMl5NKBMCHa/6pMrk/CYSG.eQZ7Fbm8C'),
(2, 34, 'N', '$2y$10$ykOfLiMhI5clmvb2P2c/cuYRXWrHkkDh/3ys1FmOODJAtwD0L4ZZe'),
(3, 36, 'N', '$2y$10$SmQ.wRtGUR1stIt2rRxc4e3/E5odvHBjReV9H5d45zWdGpAtxPcKW'),
(5, 38, 'N', '$2y$10$QMVtZuHYnaK8fUzbsnpbr.xtiwzMP1PuFHrIfXbUppXab88s2xoym'),
(12, 40, 'A', '$2y$10$qNJ2c2255uw9FP5nXFIbRu5j5xo0Mg5u6Ub7nnsmgz6472cWNYBHC'),
(13, 186, 'A', '$2y$10$NiG7vp9BFlW6Db2I8R41ReXzJ9H98RD2sHgVN4Q/mL/wWWl4TGr02'),
(14, 224, 'N', '$2y$10$KbslvHMWEKtokTVHCeZShOd0HW6MCxvWdjkWQ4FV3bwTUSn7n54kK'),
(15, 100, 'N', '$2y$10$hQx8bqp2mRTH9.EW9UTbR.aDlEJMqyqTSuACL6c3qDcXc5BvVE2u2'),
(22, 2, 'A', '$2y$10$NziT97kShrpqhUIEE2XRqufIuLLLljGMul7YWRsV0dFEFt0Fgvcee'),
(24, 228, 'A', ''),
(25, 227, 'A', '$2y$10$5frrSsit134bjtMI1AX4JOPveDUgtX81fwCelRgRu2vK6KrMHgKiK'),
(26, 226, 'A', '$2y$10$2PJEEdy.Eteos1tT4GtAMugCf9YNO/rpKevLAb3gnZ.aX.Izo6vF.');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `login`, `password`, `status`) VALUES
(1, 1, 'Artem', 'test1@test.com', '$2y$10$Oqfp8FOSBgXzz5iGtzWYTeNYF5ETLJc/fjrV854Kvdo2azuwy3Hq2', 'A'),
(2, 1, 'Egor', 'test2@test.com', '$2y$10$UAuIMyKUq5.OCtv23DKwYuxsKMa7K.wqPVecKTgPaqPDfJNCXH.S2', 'A'),
(4, 1, 'Petr', 'test3@test.com', '$2y$10$Bb.4/CId9WtHEYMaiebS8.RroqGQieVKUkp55BCt4Gi6Q4fg4Nhu.', 'A'),
(5, 1, 'Ivan', 'test5@test.com', '$2y$10$ZV.E00g08uhAon6O.7Nh.eKNVGBBgcqcLmmEANkFWzsFaRtZeNfB2', 'A'),
(6, 2, 'Alex', 'web1@test.com', '$2y$10$ZQIm9rJsTWaHEn.slOonT.m/BBARrRhJdj9d7l3fketuDIAfQLGVC', 'A'),
(7, 2, 'Test', 'test7@test.com', '$2y$10$hp9d1Ul1PF98m7Flqr7Gh./CQze50i1BB.XErRAFrksF8Op6sViDO', 'A'),
(8, 2, 'Testuser', 'test8@test.com', '$2y$10$guSB9Sl9XkWzpk2lGYH0W.WVst1Kk3566GrxKdEEbGNPSBIKYEvqS', 'N'),
(9, 2, 'test', 'web2@test.com', '$2y$10$y18SyEjAsySGX1iH1wwN4OWjGxjs1Nhba2jKHbCG6VEeT.w7UtGc.', 'N'),
(10, 2, 'Test', 'web5@test.com', '$2y$10$IW2Ux6fTuziVwGVpUKLz3eFDyg9VPz1EQozKJwZzmoWWRdlYIJpjS', 'N'),
(11, 1, 'Test', 'testemail@test.com', '$2y$10$sbIUpRwnnk9X1pIadZjKXeI1s/XEZr98.vIrkm6YOAHQVPl8pYDW6', 'N'),
(12, 2, 'UserNameTest', 'web9@test.com', '$2y$10$mGvSh/gqVygKhkllI9spRuA0MfEbnbZCIYPgC.Y18Tbjo8LX7cdaK', 'N'),
(13, 3, 'admin', 'admin@test.com', '$2y$10$AKJqQ7JTogXv.7ZocBjU.uXmJOUZaD1yeYBRQ62EA4l7Cf.3OtFwm', 'A'),
(14, 1, 'TestUser', 'testuser5@test.com', '$2y$10$DpGWVgZBf2I50jM.fNf8nu7.bMS2TWsxFytIwwUUJ381l4vIG3GDW', 'N'),
(15, 2, 'User11', 'User11@test.com', '$2y$10$gs1RI5irvmuJdPhCOTCPNeGE5vQu1wFNZ6EM1Cr27tnf8JbQyQThC', 'N'),
(16, 2, 'Someone', 'testemail1@test.com', '$2y$10$ERGb4K6aXiPTd2fOaAG2Qu7S.UvkbH.oYLJNi.X8R6orYtIdwRI6C', 'N'),
(17, 2, 'Someone1', 'testemail11@test.com', '$2y$10$6/tn3jORR/vdlxWiExOIs.Zv6aZPrei.4sdpr3IrZgAAKbUhyAmgS', 'N'),
(18, 2, 'Someone11', 'testemail111@test.com', '$2y$10$/LV2cUOGPABp1eRjFnbyJ.fyahw47DvBI07i4hogF8Bny8MIJMo2O', 'N'),
(19, 2, 'Someone5', 'testemail5@test.com', '$2y$10$vHPKwnImujcqCNendkviTudtNiXoBY.qzDwe//YGW1sYb6E2.yMTq', 'N');

-- --------------------------------------------------------

--
-- Структура таблицы `user_offer`
--

CREATE TABLE `user_offer` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `offer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_offer`
--

INSERT INTO `user_offer` (`user_id`, `offer_id`) VALUES
(1, 2),
(2, 3),
(4, 8),
(4, 31),
(4, 29),
(1, 9),
(4, 33),
(4, 34),
(4, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 186),
(1, 224),
(1, 197),
(1, 226),
(1, 227),
(1, 228),
(1, 37),
(1, 100),
(1, 186),
(1, 232),
(9, 39),
(1, 233),
(1, 234),
(6, 2),
(6, 29),
(6, 186),
(6, 40),
(6, 228),
(6, 227),
(6, 226);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clicks`
--
ALTER TABLE `clicks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription_id` (`subscription_id`);

--
-- Индексы таблицы `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Индексы таблицы `user_offer`
--
ALTER TABLE `user_offer`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `clicks`
--
ALTER TABLE `clicks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `clicks`
--
ALTER TABLE `clicks`
  ADD CONSTRAINT `clicks_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`);

--
-- Ограничения внешнего ключа таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_offer`
--
ALTER TABLE `user_offer`
  ADD CONSTRAINT `offer_id` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

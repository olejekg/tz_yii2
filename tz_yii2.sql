-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 27 2020 г., 15:22
-- Версия сервера: 5.6.41
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tz_yii2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) NOT NULL,
  `post_index` varchar(24) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house_number` int(5) NOT NULL,
  `apartmant_office` int(5) DEFAULT NULL,
  `users_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `addresses`
--

INSERT INTO `addresses` (`id`, `post_index`, `country`, `city`, `street`, `house_number`, `apartmant_office`, `users_id`) VALUES
(1, '14020', 'UA', 'Чернігів', 'Шевченко', 202, NULL, 1),
(2, '14034', 'UA', 'Чернігів', '1 Травня', 189, 181, 1),
(3, '14030', 'UA', 'Чернігів', 'Захисників України', 25, NULL, 1),
(4, '14020', 'UA', 'Київ', 'Симиренко', 136, 34, 2),
(5, '14034', 'UA', 'Київ', 'Корольова вул.', 11, 111, 2),
(6, '14030', 'UA', 'Київ', 'Відрадний пр-т', 25, 101, 2),
(7, '61000', 'UA', 'Харків', 'пр-т Героїв Сталінграду', 136, NULL, 4),
(8, '61000', 'UA', 'Харків', 'Харківських Дивізій', 4, NULL, 4),
(9, '88000', 'UA', 'Ужгород', 'Собранецька', 212, NULL, 3),
(10, '40000', 'UA', 'Суми', 'Герасима Кондратьєва', 168, NULL, 5),
(11, '40000', 'UA', 'Суми', 'Чорновола', 57, 101, 5),
(12, '87500', 'UA', 'Маріуполь', 'Італійська', 75, NULL, 6),
(14, '43225444', 'UA', 'Макакинск', 'Пьяная', 344, 7, 41),
(15, '4322', 'UZ', 'Макакинск', 'Пьяная', 344, 7, 42),
(16, '4322', 'SL', 'Макакинск', 'двлулпр', 344, 7, 43),
(24, '123456', 'UA', 'Swert', 'KIuytf', 8, 33, 51),
(26, '123456', 'SI', 'Swert', 'KIuytf', 8, 33, 53),
(27, '123456', 'SI', 'Swert', 'KIuytf', 8, 33, 54),
(28, '123456', 'SI', 'Swert', 'KIuytf', 8, 33, 55),
(29, '123456', 'SI', 'Swert', 'KIuytf', 8, 33, 56),
(30, '124321', 'UA', 'ывапку', 'йцыфяч', 2, 2, 57),
(31, '123123', 'US', 'qwert', 'Juytr', 22, NULL, 58),
(32, '100245', 'UA', 'Flslj', 'уккк', 8888, NULL, 59),
(154, '171819', 'MY', 'Utrewq', 'Turk', 7, NULL, 28),
(34, '125689', 'UA', 'Qwerty', '5рнеа', 45, 78, 61),
(156, '123456', 'UA', 'sdfre', 'xcvbn', 2, 2, 28),
(157, '123456', 'UA', 'Акеп', 'GFHGFHF', 2, NULL, 28),
(183, '4853431', 'RW', 'YJHYT', 'XXXYYYZZZ', 9, 5, 68),
(179, '2344', 'TZ', 'sdfre', 'Ghytrewq', 3, NULL, 40),
(178, '123456', 'TM', 'Акеп', 'ZXCVB', 78, NULL, 40),
(177, '123456', 'TM', 'ERW', 'SDF', 3, NULL, 40),
(158, '1111', 'UA', '1', '1', 1, NULL, 28),
(159, '1211', 'UA', '1', '1', 1, NULL, 28),
(160, '2222', 'UA', 'wwww', 'wwww', 1, NULL, 28),
(176, '123456', 'UA', 'sdfre', 'ZXCVB', 44, 55, 40),
(164, '1231', 'UA', 'Dcvfrtg', 'Sxcdew', 2, NULL, 30),
(165, '1245', 'US', 'New-York', 'East 52 street', 6, 61, 1),
(166, '12345', 'JP', 'Чернігів', 'Любецька 78', 1, NULL, 1),
(173, '123456', 'UA', 'qwer', 'rewq', 3, 3, 40),
(171, '123456', 'UA', 'Акеп', 'GFHGFHF', 7, NULL, 40),
(172, '123456', 'UA', 'Акеп', 'xcvbn', 44, 5, 40),
(174, '123453', 'SD', 'qwer', 'rewq', 3, 3, 40),
(175, '123454', 'SL', 'qwer', 'rewq', 3, 3, 40);

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `two_letter_code` varchar(2) NOT NULL,
  `three_letter_code` varchar(3) NOT NULL,
  `country` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`two_letter_code`, `three_letter_code`, `country`) VALUES
('AU', 'AUS', 'Австралия'),
('AT', 'AUT', 'Австрия'),
('AZ', 'AZE', 'Азербайджан'),
('AL', 'ALB', 'Албания'),
('DZ', 'DZA', 'Алжир'),
('AO', 'AGO', 'Ангола'),
('AD', 'AND', 'Андорра'),
('AG', 'ATG', 'Антигуа и Барбуда'),
('AR', 'ARG', 'Аргентина'),
('AM', 'ARM', 'Армения'),
('AF', 'AFG', 'Афганистан'),
('BS', 'BHS', 'Багамские Острова'),
('BD', 'BGD', 'Бангладеш'),
('BB', 'BRB', 'Барбадос'),
('BH', 'BHR', 'Бахрейн'),
('BZ', 'BLZ', 'Белиз'),
('BY', 'BLR', 'Белоруссия'),
('BE', 'BEL', 'Бельгия'),
('BJ', 'BEN', 'Бенин'),
('BG', 'BGR', 'Болгария'),
('BO', 'BOL', 'Боливия'),
('BA', 'BIH', 'Босния и Герцеговина'),
('BW', 'BWA', 'Ботсвана'),
('BR', 'BRA', 'Бразилия'),
('BN', 'BRN', 'Бруней'),
('BF', 'BFA', 'Буркина-Фасо'),
('BI', 'BDI', 'Бурунди'),
('BT', 'BTN', 'Бутан'),
('VU', 'VUT', 'Вануату'),
('VA', 'VAT', 'Ватикан'),
('GB', 'GBR', 'Великобритания'),
('HU', 'HUN', 'Венгрия'),
('VE', 'VEN', 'Венесуэла'),
('TL', 'TLS', 'Восточный Тимор'),
('VN', 'VNM', 'Вьетнам'),
('GA', 'GAB', 'Габон'),
('HT', 'HTI', 'Гаити'),
('GY', 'GUY', 'Гайана'),
('GM', 'GMB', 'Гамбия'),
('GH', 'GHA', 'Гана'),
('GT', 'GTM', 'Гватемала'),
('GN', 'GIN', 'Гвинея'),
('GW', 'GNB', 'Гвинея-Бисау'),
('DE', 'DEU', 'Германия'),
('HN', 'HND', 'Гондурас'),
('PS', 'PSE', 'Государство Палестина'),
('GD', 'GRD', 'Гренада'),
('GR', 'GRC', 'Греция'),
('GE', 'GEO', 'Грузия'),
('DK', 'DNK', 'Дания'),
('DJ', 'DJI', 'Джибути'),
('DM', 'DMA', 'Доминика'),
('DO', 'DOM', 'Доминиканская Республика'),
('CD', 'COD', 'ДР Конго'),
('EG', 'EGY', 'Египет'),
('ZM', 'ZMB', 'Замбия'),
('ZW', 'ZWE', 'Зимбабве'),
('IL', 'ISR', 'Израиль'),
('IN', 'IND', 'Индия'),
('ID', 'IDN', 'Индонезия'),
('JO', 'JOR', 'Иордания'),
('IQ', 'IRQ', 'Ирак'),
('IR', 'IRN', 'Иран'),
('IE', 'IRL', 'Ирландия'),
('IS', 'ISL', 'Исландия'),
('ES', 'ESP', 'Испания'),
('IT', 'ITA', 'Италия'),
('YE', 'YEM', 'Йемен'),
('CV', 'CPV', 'Кабо-Верде'),
('KZ', 'KAZ', 'Казахстан'),
('KH', 'KHM', 'Камбоджа'),
('CM', 'CMR', 'Камерун'),
('CA', 'CAN', 'Канада'),
('QA', 'QAT', 'Катар'),
('KE', 'KEN', 'Кения'),
('CY', 'CYP', 'Кипр'),
('KG', 'KGZ', 'Киргизия'),
('KI', 'KIR', 'Кирибати'),
('CN', 'CHN', 'Китай'),
('KP', 'PRK', 'КНДР'),
('CO', 'COL', 'Колумбия'),
('KM', 'COM', 'Коморские Острова'),
('CR', 'CRI', 'Коста-Рика'),
('CI', 'CIV', 'Кот-д\'Ивуар'),
('CU', 'CUB', 'Куба'),
('KW', 'KWT', 'Кувейт'),
('LA', 'LAO', 'Лаос'),
('LV', 'LVA', 'Латвия'),
('LS', 'LSO', 'Лесото'),
('LR', 'LBR', 'Либерия'),
('LB', 'LBN', 'Ливан'),
('LY', 'LBY', 'Ливия'),
('LT', 'LTU', 'Литва'),
('LI', 'LIE', 'Лихтенштейн'),
('LU', 'LUX', 'Люксембург'),
('MU', 'MUS', 'Маврикий'),
('MR', 'MRT', 'Мавритания'),
('MG', 'MDG', 'Мадагаскар'),
('MW', 'MWI', 'Малави'),
('MY', 'MYS', 'Малайзия'),
('ML', 'MLI', 'Мали'),
('MV', 'MDV', 'Мальдивские Острова'),
('MT', 'MLT', 'Мальта'),
('MA', 'MAR', 'Марокко'),
('MH', 'MHL', 'Маршалловы Острова'),
('MX', 'MEX', 'Мексика'),
('MZ', 'MOZ', 'Мозамбик'),
('MD', 'MDA', 'Молдавия'),
('MC', 'MCO', 'Монако'),
('MN', 'MNG', 'Монголия'),
('MM', 'MMR', 'Мьянма'),
('NA', 'NAM', 'Намибия'),
('NR', 'NRU', 'Науру'),
('NP', 'NPL', 'Непал'),
('NE', 'NER', 'Нигер'),
('NG', 'NGA', 'Нигерия'),
('NL', 'NLD', 'Нидерланды'),
('NI', 'NIC', 'Никарагуа'),
('NZ', 'NZL', 'Новая Зеландия'),
('NO', 'NOR', 'Норвегия'),
('AE', 'ARE', 'ОАЭ'),
('OM', 'OMN', 'Оман'),
('PK', 'PAK', 'Пакистан'),
('PW', 'PLW', 'Палау'),
('PA', 'PAN', 'Панама'),
('PG', 'PNG', 'Папуа - Новая Гвинея'),
('PY', 'PRY', 'Парагвай'),
('PE', 'PER', 'Перу'),
('PL', 'POL', 'Польша'),
('PT', 'PRT', 'Португалия'),
('CG', 'COG', 'Республика Конго'),
('KR', 'KOR', 'Республика Корея'),
('RU', 'RUS', 'Россия'),
('RW', 'RWA', 'Руанда'),
('RO', 'ROU', 'Румыния'),
('SV', 'SLV', 'Сальвадор'),
('WS', 'WSM', 'Самоа'),
('SM', 'SMR', 'Сан-Марино'),
('ST', 'STP', 'Сан-Томе и Принсипи'),
('SA', 'SAU', 'Саудовская Аравия'),
('MK', 'MKD', 'Северная Македония'),
('SC', 'SYC', 'Сейшельские Острова'),
('SN', 'SEN', 'Сенегал'),
('VC', 'VCT', 'Сент-Винсент и Гренадины'),
('KN', 'KNA', 'Сент-Китс и Невис'),
('LC', 'LCA', 'Сент-Люсия'),
('RS', 'SRB', 'Сербия'),
('SG', 'SGP', 'Сингапур'),
('SY', 'SYR', 'Сирия'),
('SK', 'SVK', 'Словакия'),
('SI', 'SVN', 'Словения'),
('SB', 'SLB', 'Соломоновы Острова'),
('SO', 'SOM', 'Сомали'),
('SD', 'SDN', 'Судан'),
('SR', 'SUR', 'Суринам'),
('US', 'USA', 'США'),
('SL', 'SLE', 'Сьерра-Леоне'),
('TJ', 'TJK', 'Таджикистан'),
('TH', 'THA', 'Таиланд'),
('TZ', 'TZA', 'Танзания'),
('TG', 'TGO', 'Того'),
('TO', 'TON', 'Тонга'),
('TT', 'TTO', 'Тринидад и Тобаго'),
('TV', 'TUV', 'Тувалу'),
('TN', 'TUN', 'Тунис'),
('TM', 'TKM', 'Туркмения'),
('TR', 'TUR', 'Турция'),
('UG', 'UGA', 'Уганда'),
('UZ', 'UZB', 'Узбекистан'),
('UA', 'UKR', 'Украина'),
('UY', 'URY', 'Уругвай'),
('FM', 'FSM', 'Федеративные Штаты Микронезии'),
('FJ', 'FJI', 'Фиджи'),
('PH', 'PHL', 'Филиппины'),
('FI', 'FIN', 'Финляндия'),
('FR', 'FRA', 'Франция'),
('HR', 'HRV', 'Хорватия'),
('CF', 'CAF', 'ЦАР'),
('TD', 'TCD', 'Чад'),
('ME', 'MNE', 'Черногория'),
('CZ', 'CZE', 'Чехия'),
('CL', 'CHL', 'Чили'),
('CH', 'CHE', 'Швейцария'),
('SE', 'SWE', 'Швеция'),
('LK', 'LKA', 'Шри-Ланка'),
('EC', 'ECU', 'Эквадор'),
('GQ', 'GNQ', 'Экваториальная Гвинея'),
('ER', 'ERI', 'Эритрея'),
('SZ', 'SWZ', 'Эсватини'),
('EE', 'EST', 'Эстония'),
('ET', 'ETH', 'Эфиопия'),
('ZA', 'ZAF', 'ЮАР'),
('OS', 'OST', 'Южная Осетия'),
('SS', 'SSD', 'Южный Судан'),
('JM', 'JAM', 'Ямайка'),
('JP', 'JPN', 'Япония');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL DEFAULT 'ni',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `first_name`, `last_name`, `sex`, `date_created`, `email`) VALUES
(1, 'usr1', 'usr1111', 'John', 'Smith', 'Male', '2020-01-07 12:56:47', 'john@smith.com'),
(2, 'usr2', 'usr222', 'John', 'Doe', 'Male', '2020-01-07 14:34:32', 'john@doe.com'),
(3, 'usr3', 'usr333', 'Kate', 'Edisson', 'Female', '2020-01-07 14:34:32', 'kate@edisson.com'),
(4, 'usr4', 'usr444', 'William', 'Smith', 'Male', '2020-01-07 14:34:32', 'william@smith.com'),
(5, 'usr5', 'usr555', 'Sarah', 'Connor', 'Female', '2020-01-07 14:34:32', 'sarah@connor.com'),
(6, 'usr6', 'usr666', 'Super', 'Mega', 'NI', '2020-01-07 14:46:32', 'supermega@gmail.com'),
(7, 'UIO', 'KJH', 'WSX', 'QAZ', 'Male', '2020-01-10 21:14:07', 'asdf@qwerty.com'),
(8, 'ujmnhy', 'lkjhgfdsa', 'tyui', 'qwerty', 'NI', '2020-01-10 21:15:51', 'zxcv@jkl.com'),
(9, 'olkiuj', 'yhnmju', 'rfvcde', 'wsxcdwe', 'Female', '2020-01-10 21:22:18', 'bnhgfd@zxcvfdsa.com'),
(23, 'qwertyui', 'qwertyui', 'qwertyui', 'qwertyui', 'Male', '2020-01-10 22:27:12', 'qawe@asd.com'),
(24, 'Йqwertyui', 'qwertyui', 'qwertyui', 'qwertyui', 'Male', '2020-01-10 22:30:44', 'qaw1e@asd.com'),
(25, 'Йqwertyuiф', 'qwertyui', 'qwertyui', 'qwertyui', 'NI', '2020-01-10 22:45:48', 'qaw12e@asd.com'),
(26, 'Йqw111', 'qwer111', 'Oqwertyui', 'Їоваё', 'Female', '2020-01-11 18:12:05', 'qaw12oe@asd.com'),
(27, 'Йqw1119', 'qwer1112', 'Фыва', 'Їоваёф', 'Male', '2020-01-11 20:16:57', 'qaw124oe@asd.com'),
(28, 'Йqw1119e', 'qwer1112', 'Фыва', 'Їоваёф', 'Male', '2020-01-11 20:21:31', 'qaw124oee@asd.com'),
(66, 'alen', 'alenionok', 'Алень', 'Алененок', 'Male', '2020-01-25 15:25:21', 'alenionok@alen.com'),
(30, 'LKJHGq', 'qwer88', 'Фыва', 'Їоваёф', 'Male', '2020-01-11 20:29:30', 'wfj@asd.com'),
(31, 'LKJHGqh', 'qwer88', 'Фыва', 'Їоваёф', 'Male', '2020-01-11 20:30:51', 'wfj@asdo.com'),
(32, 'dusiaagregat', 'dusiaagregat', 'Дуся', 'Агрегат', 'Female', '2020-01-11 20:36:26', 'dusiaagregat@gmail.com'),
(33, 'geniusstar', 'geniusstar', 'Гений', 'Звезда', 'Male', '2020-01-11 20:38:32', 'geniusstar@gmail.com'),
(34, 'wsxcde', 'wsxcde', 'Qqazxsw', 'Qikmju', 'NI', '2020-01-11 23:21:21', 'qawe2@asd.com'),
(35, 'типуля', 'типуля', 'Типуля', 'Типуля', 'Male', '2020-01-11 23:30:06', 'uytre@asdf.com'),
(36, 'йфячыц', 'камипе', 'Ввыаа', 'Цвыаы', 'NI', '2020-01-12 00:31:46', 'qa4we@asd.com'),
(37, 'йфячыцw', 'камипе', 'Ввыаа', 'Цвыаы', 'NI', '2020-01-12 00:34:01', 'qa4we5@asd.com'),
(38, 'klk44', 'klk44j', 'Абдула', 'Джихардхибад', 'NI', '2020-01-12 00:40:42', 'asalay@mahalay.com'),
(39, 'klkp44', 'klk44j', 'Абдула', 'Джихардхибад', 'NI', '2020-01-12 00:42:47', 'easalay@mahalay.com'),
(40, 'UIO77d', 'KJH555', 'Wlkjhgf', 'Kjhgfdk', 'Male', '2020-01-12 01:28:02', 'qawde@asd.com'),
(41, 'WinnyPuh', 'WinnyPuh', 'Винни', 'Пух', 'Male', '2020-01-12 18:13:02', 'zxcvb333@jkl.com'),
(42, 'WinnyPuhт', 'WinnyPuh', 'Винни', 'Пух', 'Male', '2020-01-12 18:48:39', 'zx8cv333@jkl.com'),
(43, 'Wint', 'WinnyPuh', 'Болт', 'Пухо', 'Male', '2020-01-12 18:56:55', 'zx8c7v333@jkl.com'),
(44, 'щздлог', 'акувф777', 'Лорп', 'Гнеа', 'Female', '2020-01-12 19:00:10', 'zxcvt@jkl.com'),
(48, 'wsxcde345u', 'rfvbgt', 'Wertyu', 'Sdfghj', 'Female', '2020-01-12 20:21:20', 'zxcv2@jklp.com'),
(49, 'rfvhn', 'tghyujm', 'Lertyu', 'Dfghjk', 'NI', '2020-01-12 20:37:13', 'aswqd2@fvbgt.com'),
(50, 'ertyuio', 'lkjhgfdsa', 'Atyuif', 'Atyuif', 'Male', '2020-01-12 20:44:46', 'asdewq@edcvfrt.com'),
(51, 'Qwertyq11jh', 'qwertyu', 'Aqwert', 'Iqwert', 'NI', '2020-01-12 20:58:41', 'aqwert@aqwert.com'),
(53, 'йцqwertyul', 'qwertyu', 'Aqwert', 'Iqwert', 'Male', '2020-01-13 23:17:04', 'aqwe91rt@aqwert.com'),
(54, 'йцqwertyulq', 'qwertyu', 'Aqwert', 'Iqwert', 'Male', '2020-01-13 23:19:13', 'aqwe911rt@aqwert.com'),
(55, 'tyulq', 'qwertyu', 'Aqwert', 'Iqwert', 'Male', '2020-01-13 23:19:50', 'aqwe311rt@aqwert.com'),
(56, 'Яtyulq', 'qwertyu', 'Aqwert', 'Iqwert', 'Male', '2020-01-13 23:22:48', 'aqw1e311rt@aqwert.com'),
(57, 'ГНЕЗ', 'йцукен', 'Йывак', 'Йцук', 'NI', '2020-01-13 23:52:14', 'qawe222@asd.com'),
(58, 'Qwerty', 'Qwerty', 'Qwerty', 'Qwerty', 'Male', '2020-01-14 00:16:52', 'asdfg@qazxsw.com'),
(59, 'asdf', 'qwer33', 'Qsdf', 'Wasdf', 'NI', '2020-01-14 00:28:43', 'olejdk@ouy.com'),
(61, 'Qwerty123', 'Qwerty', 'Qwerty', 'Ывапр', 'Female', '2020-01-14 00:57:31', 'z2xcv@jkl.com'),
(68, 'alenionok', 'alenionok', 'Алень', 'Алененок', 'NI', '2020-01-25 15:37:22', 'aaa@alen.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

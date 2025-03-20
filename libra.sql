-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Окт 13 2024 г., 16:44
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS libra;
USE libra;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `libra`
--

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Название книги',
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Имя автора'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Сведения о книгах';

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `title`, `author`) VALUES
(1, 'Война и мир', 'Лев Толстой'),
(2, 'Преступление и наказание', 'Федор Достоевский'),
(3, 'Анна Каренина', 'Лев Толстой'),
(4, 'Мастер и Маргарита', 'Михаил Булгаков'),
(5, 'Идиот', 'Федор Достоевский'),
(6, 'Отцы и дети', 'Иван Тургенев'),
(7, 'Тихий Дон', 'Михаил Шолохов'),
(8, 'Доктор Живаго', 'Борис Пастернак'),
(9, 'Герой нашего времени', 'Михаил Лермонтов'),
(10, 'Обломов', 'Иван Гончаров'),
(11, 'Дубровский', 'Александр Пушкин'),
(12, 'Мертвые души', 'Николай Гоголь'),
(13, 'Капитанская дочка', 'Александр Пушкин'),
(14, 'Евгений Онегин', 'Александр Пушкин'),
(15, 'Человек-невидимка', 'Герберт Уэллс');

-- --------------------------------------------------------

--
-- Структура таблицы `copy`
--

CREATE TABLE `copy` (
  `id` int NOT NULL,
  `book_id` int NOT NULL,
  `wear_coefficient` decimal(3,2) NOT NULL COMMENT 'Коэф.износа (от 1 до 10)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Экземпляры книг';

--
-- Дамп данных таблицы `copy`
--

INSERT INTO `copy` (`id`, `book_id`, `wear_coefficient`) VALUES
(1, 1, 1.00),
(2, 1, 3.50),
(3, 2, 1.00),
(4, 2, 2.00),
(5, 3, 1.00),
(6, 3, 4.00),
(7, 4, 1.00),
(8, 4, 5.00),
(9, 5, 1.00),
(10, 5, 2.50),
(11, 6, 1.00),
(12, 6, 3.00),
(13, 7, 1.00),
(14, 7, 6.50),
(15, 8, 1.00),
(16, 8, 4.00),
(17, 9, 1.00),
(18, 9, 2.50),
(19, 10, 1.00),
(20, 10, 5.50),
(21, 11, 1.00),
(22, 11, 1.50),
(23, 12, 1.00),
(24, 12, 3.00),
(25, 13, 1.00),
(26, 13, 4.50),
(27, 14, 1.00),
(28, 14, 3.50),
(29, 15, 1.00),
(30, 15, 2.00);

-- --------------------------------------------------------

--
-- Структура таблицы `loan`
--

CREATE TABLE `loan` (
  `id` int NOT NULL,
  `copy_id` int NOT NULL,
  `reader_id` int NOT NULL,
  `loan_date` date NOT NULL COMMENT 'Дата выдачи книги',
  `return_date_plan` date DEFAULT NULL COMMENT 'Планируемая дата возврата',
  `return_date_fact` date DEFAULT NULL COMMENT 'Фактическая дата возврата'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Учет выдач';

--
-- Дамп данных таблицы `loan`
--

INSERT INTO `loan` (`id`, `copy_id`, `reader_id`, `loan_date`, `return_date_plan`, `return_date_fact`) VALUES
(1, 1, 1, '2024-09-01', '2024-09-10', '2024-09-09'),
(2, 2, 2, '2024-09-03', '2024-09-12', '2024-09-11'),
(3, 3, 3, '2024-09-05', '2024-09-15', NULL),
(4, 4, 4, '2024-09-06', '2024-09-16', '2024-09-14'),
(5, 5, 5, '2024-09-07', '2024-09-17', NULL),
(6, 6, 6, '2024-09-08', '2024-09-18', '2024-09-17'),
(7, 7, 7, '2024-09-09', '2024-09-19', NULL),
(8, 8, 8, '2024-09-10', '2024-09-20', '2024-09-18'),
(9, 9, 9, '2024-09-11', '2024-09-21', '2024-09-20'),
(10, 10, 10, '2024-09-12', '2024-09-22', NULL),
(11, 11, 11, '2024-09-13', '2024-09-23', '2024-09-22'),
(12, 12, 12, '2024-09-14', '2024-09-24', NULL),
(13, 13, 13, '2024-09-15', '2024-09-25', '2024-09-24'),
(14, 14, 14, '2024-09-16', '2024-09-26', '2024-09-25'),
(15, 15, 15, '2024-09-17', '2024-09-27', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `reader`
--

CREATE TABLE `reader` (
  `id` int NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'ФИО читателя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Читатель';

--
-- Дамп данных таблицы `reader`
--

INSERT INTO `reader` (`id`, `full_name`) VALUES
(1, 'Иванов Иван Иванович'),
(2, 'Петров Петр Петрович'),
(3, 'Сидоров Сидор Сидорович'),
(4, 'Кузнецов Алексей Сергеевич'),
(5, 'Попова Анна Викторовна'),
(6, 'Волков Дмитрий Александрович'),
(7, 'Смирнов Максим Олегович'),
(8, 'Федорова Елена Николаевна'),
(9, 'Соколов Павел Дмитриевич'),
(10, 'Михайлова Мария Евгеньевна'),
(11, 'Ковалев Артем Борисович'),
(12, 'Киселева Ирина Ивановна'),
(13, 'Никитин Сергей Павлович'),
(14, 'Орлова Наталья Юрьевна'),
(15, 'Тимофеев Андрей Леонидович');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `copy`
--
ALTER TABLE `copy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Индексы таблицы `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `copy_id` (`copy_id`),
  ADD KEY `reader_id` (`reader_id`);

--
-- Индексы таблицы `reader`
--
ALTER TABLE `reader`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `copy`
--
ALTER TABLE `copy`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `reader`
--
ALTER TABLE `reader`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `copy`
--
ALTER TABLE `copy`
  ADD CONSTRAINT `copy_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`);

--
-- Ограничения внешнего ключа таблицы `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`copy_id`) REFERENCES `copy` (`id`),
  ADD CONSTRAINT `loan_ibfk_2` FOREIGN KEY (`reader_id`) REFERENCES `reader` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

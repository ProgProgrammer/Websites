-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 26 2023 г., 20:59
-- Версия сервера: 8.0.31
-- Версия PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `forum`
--

DELIMITER $$
--
-- Процедуры
--
DROP PROCEDURE IF EXISTS `checkUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkUser` (IN `sess_id` VARCHAR(26))   BEGIN
        SELECT ip_address FROM users WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `deleteSession`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteSession` (IN `sess_id` VARCHAR(26), IN `num` VARCHAR(26))   BEGIN
        UPDATE users SET session_id = num WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `deleteSessionц`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteSessionц` (IN `sess_id` VARCHAR(26))   BEGIN
        UPDATE users SET session_id = '' WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `delUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delUser` (IN `sess_id` VARCHAR(26))   BEGIN
        DELETE FROM users WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `getAutKey`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAutKey` (IN `id_val` INT(6))   BEGIN
        SELECT unique_number FROM users WHERE id = id_val;
    END$$

DROP PROCEDURE IF EXISTS `getCabinet`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCabinet` (IN `sess_id` VARCHAR(26))   BEGIN
        SELECT login, name, email FROM users WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `getEmail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getEmail` (IN `sess_id` VARCHAR(26))   BEGIN
        SELECT email FROM users WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `getIp`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getIp` (IN `sess_id` VARCHAR(26))   BEGIN
        SELECT ip_address FROM users WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `getMes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getMes` (IN `mes_id` INT(6))   BEGIN
        SELECT users.name, messages.id, messages.text FROM messages 
            INNER JOIN users ON messages.user = users.id WHERE messages.id > mes_id ORDER BY messages.id ASC LIMIT 12;
    END$$

DROP PROCEDURE IF EXISTS `getPassword`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getPassword` (IN `sess_id` VARCHAR(26))   BEGIN
        SELECT password FROM users WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `getSession`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getSession` (IN `user_id` INT(6))   BEGIN
        SELECT session_id FROM users WHERE id = user_id;
    END$$

DROP PROCEDURE IF EXISTS `getUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getUser` (IN `login` VARCHAR(40))   BEGIN
        SELECT id, password, name, session_id, ip_address FROM users 
            WHERE users.login = login;
    END$$

DROP PROCEDURE IF EXISTS `getUserId`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserId` (IN `sess_id` VARCHAR(26))   BEGIN
        SELECT id FROM users WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `getUserIdLog`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserIdLog` (IN `log` VARCHAR(40))   BEGIN
        SELECT id FROM users WHERE login = log;
    END$$

DROP PROCEDURE IF EXISTS `getUsername`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getUsername` (IN `sess_id` VARCHAR(26))   BEGIN
        SELECT name FROM users WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `log`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `log` (IN `login` VARCHAR(40), IN `password` VARCHAR(40))   BEGIN
        SELECT users.id FROM users WHERE users.login = login AND users.password = password;
    END$$

DROP PROCEDURE IF EXISTS `mes2`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mes2` ()   BEGIN
                SELECT messages.id, messages.text, users.name FROM messages AS m JOIN users AS u1 ON u1.id = m.user
                    JOIN users AS u2 ON u2.id = m.response_user;
            END$$

DROP PROCEDURE IF EXISTS `pas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `pas` (IN `login` VARCHAR(40))   BEGIN
        SELECT id, password FROM users WHERE users.login = login;
    END$$

DROP PROCEDURE IF EXISTS `setAutKey`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `setAutKey` (IN `id_val` INT(6))   BEGIN
        UPDATE users SET unique_number = SUBSTRING(MD5(RAND()) FROM 1 FOR 30) WHERE id = id_val;
    END$$

DROP PROCEDURE IF EXISTS `setMes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `setMes` (IN `text_mes` VARCHAR(2000), IN `user_id` INT(6))   BEGIN
        INSERT INTO messages (text, user) 
            VALUES (text_mes, user_id);
    END$$

DROP PROCEDURE IF EXISTS `setSession`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `setSession` (IN `user_id` INT(6), IN `sess_id` VARCHAR(26))   BEGIN
        UPDATE users SET session_id = sess_id WHERE id = user_id;
    END$$

DROP PROCEDURE IF EXISTS `setUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `setUser` (IN `log` VARCHAR(40), IN `pass` VARCHAR(60), IN `str_name` VARCHAR(20), IN `str_email` VARCHAR(60), IN `str_sess_id` VARCHAR(26), IN `str_ip` VARCHAR(60))   BEGIN
        INSERT INTO users (login, password, name, email, session_id, ip_address) 
            VALUES (log, pass, str_name, str_email, str_sess_id, str_ip);
    END$$

DROP PROCEDURE IF EXISTS `setUsermail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `setUsermail` (IN `mail` VARCHAR(40), IN `sess_id` VARCHAR(26))   BEGIN
        UPDATE users SET email = mail WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `setUsername`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `setUsername` (IN `str_name` VARCHAR(20), IN `sess_id` VARCHAR(26))   BEGIN
        UPDATE users SET name = str_name WHERE session_id = sess_id;
    END$$

DROP PROCEDURE IF EXISTS `setUserpass`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `setUserpass` (IN `pass` VARCHAR(60), IN `sess_id` VARCHAR(26))   BEGIN
        UPDATE users SET password = pass WHERE session_id = sess_id;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Сообщение пользователя',
  `user` int UNSIGNED NOT NULL COMMENT 'Кто написал',
  UNIQUE KEY `id` (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `text`, `user`) VALUES
(3, 'Lorem ipsum.', 3),
(4, 'Lorem ipsum2', 3),
(5, 'Hello, world!', 3),
(18, 'Hello world!', 6),
(19, 'Привет всем!', 7),
(20, 'Привет, Сергей.', 3),
(21, 'Здарова!', 8),
(22, 'выпвыапвыап', 3),
(23, 'выпвыапвыап2', 3),
(24, 'выпвыапвыап23', 3),
(25, 'привет!', 7),
(26, 'Как дела?', 7),
(27, 'Как погода?', 6),
(28, 'Азазаза.', 6),
(29, 'Всем привет. Как дела?', 6),
(30, 'Что делаете?', 6),
(33, 'Привет, Рома. Все хорошо. У тебя как?', 6),
(35, 'Всем првиет!', 3),
(36, 'Привет!', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `session_id` varchar(26) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `email`, `session_id`, `ip_address`) VALUES
(3, 'user', '$2y$10$3exuAqbzcbpaco2qp86ShOKQvzoqnKk4Ff0Dq.gwy3qlhfW.31lwW', 'Владимир Андреев', 'zverushka699@gmail.com', '0', '$2y$10$UsWNt6XvhwosTRm19.F9Q.myXPgEEuyDjelnD5KRs/5kOzM3ba4oa'),
(6, 'user2', '$2y$10$Rh6pnFdYF2XSnZ6FhOQojOwdiNlhLv3Gq9sQAvpHfSBhi8g5Svwc6', 'Анатолий Зайцев', 'zubr.f@yandex.ru', '0', '$2y$10$ujTJov.viM5ek3SB5mBexulmhMImvB.6jnHrf2LxGjlP/2rzMElda'),
(7, 'sergey_tuylenev', '$2y$10$47edW6wq2ZDDqfpvOsHLXeF91cqbYkuva72on9brU2V.S.t.TyU/G', 'Sergey Tuylenev', 'marleeeeeey@mail.com', '0', '$2y$10$wWGcxVsuNdi/wdD84QTJue5zXbfVPgSvCU7HKWi19JyEKpzCU5vn.'),
(8, 'asd', '$2y$10$IBnUnprvS/hUyfnw7jy8G.bFR1B4shfVQK1YILJreegigSCOu2C5y', 'asd', 'asd', '2srmeirodn9745tnmb1p80ts5t', '$2y$10$yoHDA2Q9Mfb6D9wgN0xgU.HBzTVfOx5SkxFidpBmrV07NPKcU/kIa');

--
-- Триггеры `users`
--
DROP TRIGGER IF EXISTS `delete_messages`;
DELIMITER $$
CREATE TRIGGER `delete_messages` BEFORE DELETE ON `users` FOR EACH ROW DELETE from `messages` WHERE `user`= OLD.`id`
$$
DELIMITER ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `user` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

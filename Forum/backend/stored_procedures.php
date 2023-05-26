<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '12345';
    $database = 'forum';

    // Запрос на получение сводной таблицы сообщений с лимитом на вывод в 12 строк (LIMIT)
    // и сортировкой messages.id по возрастанию (ORDER BY messages.id ASC)
    $GLOBALS['mysqli_get_mes'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_get_mes']->query("DROP PROCEDURE IF EXISTS getMes");
    $GLOBALS['mysqli_get_mes']->query("CREATE PROCEDURE getMes(IN mes_id INT(6))
    BEGIN
        SELECT users.name, messages.id, messages.text FROM messages 
            INNER JOIN users ON messages.user = users.id WHERE messages.id > mes_id ORDER BY messages.id ASC LIMIT 12;
    END;");

    // Добавление нового сообщения
    $GLOBALS['mysqli_set_mes'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_set_mes']->query("DROP PROCEDURE IF EXISTS setMes");
    $GLOBALS['mysqli_set_mes']->query("CREATE PROCEDURE setMes(IN text_mes VARCHAR(2000), IN user_id INT(6))
    BEGIN
        INSERT INTO messages (text, user) 
            VALUES (text_mes, user_id);
    END;");

    // Добавление нового пользователя
    $GLOBALS['mysqli_set_user'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_set_user']->query("DROP PROCEDURE IF EXISTS setUser");
    $GLOBALS['mysqli_set_user']->query("CREATE PROCEDURE setUser(IN log VARCHAR(40), IN pass VARCHAR(60), 
                                        IN str_name VARCHAR(20), IN str_email VARCHAR(60), IN str_sess_id VARCHAR(26), 
                                        IN str_ip VARCHAR(60))
    BEGIN
        INSERT INTO users (login, password, name, email, session_id, ip_address) 
            VALUES (log, pass, str_name, str_email, str_sess_id, str_ip);
    END;");

    // Запрос на получение идентификационных данных о пользователе по логину
    $GLOBALS['mysqli_get_user'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_get_user']->query("DROP PROCEDURE IF EXISTS getUser");
    $GLOBALS['mysqli_get_user']->query("CREATE PROCEDURE getUser(IN login VARCHAR(40))
    BEGIN
        SELECT id, password, name, session_id, ip_address FROM users 
            WHERE users.login = login;
    END;");

    // Запрос на получение идентификационных данных о пользователе по номеру сессии
    $GLOBALS['mysqli_get_user_id'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_get_user_id']->query("DROP PROCEDURE IF EXISTS getUserId");
    $GLOBALS['mysqli_get_user_id']->query("CREATE PROCEDURE getUserId(IN sess_id VARCHAR(26))
    BEGIN
        SELECT id FROM users WHERE session_id = sess_id;
    END;");

    // Запрос на получение идентификационных данных о пользователе по логину
    $GLOBALS['mysqli_get_user_id_log'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_get_user_id_log']->query("DROP PROCEDURE IF EXISTS getUserIdLog");
    $GLOBALS['mysqli_get_user_id_log']->query("CREATE PROCEDURE getUserIdLog(IN log VARCHAR(40))
    BEGIN
        SELECT id FROM users WHERE login = log;
    END;");

    // Изменение сессии
    $GLOBALS['mysqli_set_session'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_set_session']->query("DROP PROCEDURE IF EXISTS setSession");
    $GLOBALS['mysqli_set_session']->query("CREATE PROCEDURE setSession(IN user_id INT(6), IN sess_id VARCHAR(26))
    BEGIN
        UPDATE users SET session_id = sess_id WHERE id = user_id;
    END;");

    // Обнуление сессии
    $GLOBALS['mysqli_delete_session'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_delete_session']->query("DROP PROCEDURE IF EXISTS deleteSession");
    $GLOBALS['mysqli_delete_session']->query("CREATE PROCEDURE deleteSession(IN sess_id VARCHAR(26), IN num VARCHAR(26))
    BEGIN
        UPDATE users SET session_id = num WHERE session_id = sess_id;
    END;");

    // Изменение имени пользователя
    $GLOBALS['mysqli_set_username'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_set_username']->query("DROP PROCEDURE IF EXISTS setUsername");
    $GLOBALS['mysqli_set_username']->query("CREATE PROCEDURE setUsername(IN str_name VARCHAR(20), IN sess_id VARCHAR(26))
    BEGIN
        UPDATE users SET name = str_name WHERE session_id = sess_id;
    END;");

    // Изменение пароля пользователя
    $GLOBALS['mysqli_set_userpass'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_set_userpass']->query("DROP PROCEDURE IF EXISTS setUserpass");
    $GLOBALS['mysqli_set_userpass']->query("CREATE PROCEDURE setUserpass(IN pass VARCHAR(60), IN sess_id VARCHAR(26))
    BEGIN
        UPDATE users SET password = pass WHERE session_id = sess_id;
    END;");

    // Изменение email пользователя
    $GLOBALS['mysqli_set_usermail'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_set_usermail']->query("DROP PROCEDURE IF EXISTS setUsermail");
    $GLOBALS['mysqli_set_usermail']->query("CREATE PROCEDURE setUsermail(IN mail VARCHAR(40), IN sess_id VARCHAR(26))
    BEGIN
        UPDATE users SET email = mail WHERE session_id = sess_id;
    END;");

    // Запрос IP-адреса пользователя по номеру сессии
    $GLOBALS['mysqli_get_ip'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_get_ip']->query("DROP PROCEDURE IF EXISTS getIp");
    $GLOBALS['mysqli_get_ip']->query("CREATE PROCEDURE getIp(IN sess_id VARCHAR(26))
    BEGIN
        SELECT ip_address FROM users WHERE session_id = sess_id;
    END;");

    // Получение имени пользователя по id сессии
    $GLOBALS['mysqli_get_username'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_get_username']->query("DROP PROCEDURE IF EXISTS getUsername");
    $GLOBALS['mysqli_get_username']->query("CREATE PROCEDURE getUsername(IN sess_id VARCHAR(26))
    BEGIN
        SELECT name FROM users WHERE session_id = sess_id;
    END;");

    // Запрос пароля пользователя
    $GLOBALS['mysqli_get_password'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_get_password']->query("DROP PROCEDURE IF EXISTS getPassword");
    $GLOBALS['mysqli_get_password']->query("CREATE PROCEDURE getPassword(IN sess_id VARCHAR(26))
    BEGIN
        SELECT password FROM users WHERE session_id = sess_id;
    END;");

    // Запрос email пользователя
    $GLOBALS['mysqli_get_email'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_get_email']->query("DROP PROCEDURE IF EXISTS getEmail");
    $GLOBALS['mysqli_get_email']->query("CREATE PROCEDURE getEmail(IN sess_id VARCHAR(26))
    BEGIN
        SELECT email FROM users WHERE session_id = sess_id;
    END;");

    // Запрос на получение информации для личного кабинета
    $GLOBALS['mysqli_get_cabinet'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_get_cabinet']->query("DROP PROCEDURE IF EXISTS getCabinet");
    $GLOBALS['mysqli_get_cabinet']->query("CREATE PROCEDURE getCabinet(IN sess_id VARCHAR(26))
    BEGIN
        SELECT login, name, email FROM users WHERE session_id = sess_id;
    END;");

    // Запрос на удаление пользователя
    $GLOBALS['mysqli_del_user'] = new mysqli($hostname, $username, $password, $database);
    $GLOBALS['mysqli_del_user']->query("DROP PROCEDURE IF EXISTS delUser");
    $GLOBALS['mysqli_del_user']->query("CREATE PROCEDURE delUser(IN sess_id VARCHAR(26))
    BEGIN
        DELETE FROM users WHERE session_id = sess_id;
    END;");
?>
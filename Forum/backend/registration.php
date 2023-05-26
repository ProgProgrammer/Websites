<?php
/*echo session_id();    // идентификатор сессии
echo session_name();*/  // имя - PHPSESSID

require_once "stored_procedures.php";

if (isset($_GET["login"]))
{
    $login = htmlspecialchars($_GET["login"]);

    // bind the value of the first IN parameter to the session variable @login
    $stmt = $GLOBALS['mysqli_get_user_id_log']->prepare("SET @log = ?");
    $stmt->bind_param('s', $login);
    $stmt->execute();

    // execute the stored Procedure
    $result = $GLOBALS['mysqli_get_user_id_log']->query('CALL getUserIdLog(@log)');
    header('Content-Type: application/json');
    $row = $result->fetch_assoc();

    if ($row === null)
    {
        echo json_encode("1", JSON_UNESCAPED_UNICODE);
    }
    else
    {
        echo json_encode("0", JSON_UNESCAPED_UNICODE);
    }
}

if (isset($_GET["login"]) && isset($_GET["password"]) && isset($_GET["name"]) && isset($_GET["email"]) &&
    isset($_GET["ip"]) && isset($_GET["session_id"]))
{
    $login = htmlspecialchars($_GET["login"]);
    $password = htmlspecialchars($_GET["password"]);
    $name = htmlspecialchars($_GET["name"]);
    $email = htmlspecialchars($_GET["email"]);
    $ip = htmlspecialchars($_GET["ip"]);
    $session_id = htmlspecialchars($_GET["session_id"]);

    $password = password_hash($password, PASSWORD_BCRYPT);
    $ip = password_hash($ip, PASSWORD_BCRYPT);

    // bind the value of the first IN parameter to the session variable @login
    $stmt = $GLOBALS['mysqli_set_user']->prepare("SET @log = ?");
    $stmt->bind_param('s', $login);
    $stmt->execute();

    // bind the value of the first IN parameter to the session variable @login
    $stmt = $GLOBALS['mysqli_set_user']->prepare("SET @pass = ?");
    $stmt->bind_param('s', $password);
    $stmt->execute();

    // bind the value of the first IN parameter to the session variable @login
    $stmt = $GLOBALS['mysqli_set_user']->prepare("SET @str_name = ?");
    $stmt->bind_param('s', $name);
    $stmt->execute();

    // bind the value of the first IN parameter to the session variable @login
    $stmt = $GLOBALS['mysqli_set_user']->prepare("SET @str_email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();

    // bind the value of the first IN parameter to the session variable @login
    $stmt = $GLOBALS['mysqli_set_user']->prepare("SET @str_ip = ?");
    $stmt->bind_param('s', $ip);
    $stmt->execute();

    // bind the value of the first IN parameter to the session variable @login
    $stmt = $GLOBALS['mysqli_set_user']->prepare("SET @str_sess_id = ?");
    $stmt->bind_param('s', $session_id);
    $stmt->execute();

    // execute the stored Procedure
    $GLOBALS['mysqli_set_user']->query('CALL setUser(@log, @pass, @str_name, @str_email, 
                @str_sess_id, @str_ip)');
}
?>
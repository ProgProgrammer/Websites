<?php
    /*echo session_id();    // идентификатор сессии
    echo session_name();*/  // имя - PHPSESSID

    require_once "stored_procedures.php";

    $authorization = "logup";
    $logout = "logout";

    if (isset($_GET["authorization"]) && isset($_GET["login"]) && isset($_GET["password"]) &&
        isset($_GET["ip"]) && isset($_GET["sessid"]))
    {
        $request = htmlspecialchars($_GET["authorization"]);
        $login = htmlspecialchars($_GET["login"]);
        $password = htmlspecialchars($_GET["password"]);
        $ip = htmlspecialchars($_GET["ip"]);
        $session_id = htmlspecialchars($_GET["sessid"]);

        if ($request === $authorization)
        {
            // bind the value of the first IN parameter to the session variable @login
            $stmt = $GLOBALS['mysqli_get_user']->prepare("SET @login = ?");
            $stmt->bind_param('s', $login);
            $stmt->execute();

            // execute the stored Procedure
            $result = $GLOBALS['mysqli_get_user']->query('CALL getUser(@login)');
            $row = $result->fetch_assoc();

            header('Content-Type: application/json');

            if ($row !== null)
            {
                $hash_pas = $row['password'];
                $hash_ip = $row['ip_address'];
                $sess = $row['session_id'];

                if (password_verify($password, $hash_pas) && $session_id === $sess &&
                    password_verify($ip, $hash_ip))  // если пароль, сессия и ip верны, то возвращается имя пользователя
                {
                    $username = $row['name'];
                    echo json_encode($username, JSON_UNESCAPED_UNICODE);
                }
                else if (password_verify($password, $hash_pas) && $session_id !== $sess &&
                        password_verify($ip, $hash_ip))  // если сессия истекла, а пароль и ip-адрес верны, то
                {                                        // обновляется номер сессии
                    $user_id = $row['id'];
                    $stmt = $GLOBALS['mysqli_set_session']->prepare("SET @user_id = ?");
                    $stmt->bind_param('i', $user_id);
                    $stmt->execute();

                    $stmt = $GLOBALS['mysqli_set_session']->prepare("SET @sess_id = ?");
                    $stmt->bind_param('s', $session_id);
                    $stmt->execute();

                    $sess_result = $GLOBALS['mysqli_set_session']->query('CALL setSession(@user_id, @sess_id)');

                    $username = $row['name'];

                    echo json_encode($username, JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    echo json_encode("0", JSON_UNESCAPED_UNICODE);
                }
            }
            else
            {
                echo json_encode("0", JSON_UNESCAPED_UNICODE);
            }
        }
    }
    else if (isset($_GET["authorization"]) && isset($_GET["ip"]) && isset($_GET["sessid"]))
    {
        $request = htmlspecialchars($_GET["authorization"]);
        $ip = htmlspecialchars($_GET["ip"]);
        $session_id = htmlspecialchars($_GET["sessid"]);

        if ($request === $logout)
        {
            $stmt = $GLOBALS['mysqli_get_ip']->prepare("SET @sess_id = ?");
            $stmt->bind_param('s', $session_id);
            $stmt->execute();

            $result = $GLOBALS['mysqli_get_ip']->query('CALL getIp(@sess_id)');
            $row = $result->fetch_assoc();
            $hash_ip = $row['ip_address'];

            if (password_verify($ip, $hash_ip))
            {
                $stmt = $GLOBALS['mysqli_delete_session']->prepare("SET @sess_id = ?");
                $stmt->bind_param('s', $session_id);
                $stmt->execute();

                $num = "0";
                $stmt = $GLOBALS['mysqli_delete_session']->prepare("SET @num = ?");
                $stmt->bind_param('s', $num);
                $stmt->execute();

                $result = $GLOBALS['mysqli_delete_session']->query('CALL deleteSession(@sess_id, @num)');

                echo json_encode("1", JSON_UNESCAPED_UNICODE);
            }
        }
        else
        {
            echo json_encode("0", JSON_UNESCAPED_UNICODE);
        }
    }
?>
<?php

    require_once "stored_procedures.php";

    function getInfoCabinet($session_id)
    {
        $stmt = $GLOBALS['mysqli_get_cabinet']->prepare("SET @sess_id = ?");
        $stmt->bind_param('s', $session_id);
        $stmt->execute();

        $result = $GLOBALS['mysqli_get_cabinet']->query('CALL getCabinet(@sess_id)');

        if (mysqli_num_rows($result) !== 0)
        {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    $action = "delete";

    if (isset($_GET["action"]) && isset($_GET["ip"]) && isset($_GET["session_id"]))
    {
        $act = htmlspecialchars($_GET["action"]);
        $ip = htmlspecialchars($_GET["ip"]);
        $session_id = htmlspecialchars($_GET["session_id"]);

        if ($action == $act)
        {
            $stmt = $GLOBALS['mysqli_get_ip']->prepare("SET @sess_id = ?");
            $stmt->bind_param('s', $session_id);
            $stmt->execute();

            $result = $GLOBALS['mysqli_get_ip']->query('CALL getIp(@sess_id)');

            if (mysqli_num_rows($result) !== 0)
            {
                $row = $result->fetch_assoc();

                if (password_verify($ip, $row['ip_address']))
                {
                    $stmt = $GLOBALS['mysqli_del_user']->prepare("SET @sess_id = ?");
                    $stmt->bind_param('s', $session_id);
                    $stmt->execute();

                    if ($GLOBALS['mysqli_del_user']->query('CALL delUser(@sess_id)'))
                    {
                        echo json_encode("1", JSON_UNESCAPED_UNICODE);
                    }
                    else
                    {
                        echo json_encode("0", JSON_UNESCAPED_UNICODE);
                    }
                }
            }
        }
    }

    if (!isset($_GET["action"]) && isset($_GET["ip"]) && isset($_GET["session_id"]))
    {
        $ip = htmlspecialchars($_GET["ip"]);
        $session_id = htmlspecialchars($_GET["session_id"]);

        $stmt = $GLOBALS['mysqli_get_ip']->prepare("SET @sess_id = ?");
        $stmt->bind_param('s', $session_id);
        $stmt->execute();

        $result = $GLOBALS['mysqli_get_ip']->query('CALL getIp(@sess_id)');

        if (mysqli_num_rows($result) !== 0)
        {
            $row = $result->fetch_assoc();

            if (password_verify($ip, $row['ip_address']))
            {
                if (isset($_GET["name"]) && iconv_strlen($_GET["name"],'UTF-8') > 0)
                {
                    $name = htmlspecialchars($_GET["name"]);
                    $name = trim($name);

                    $stmt = $GLOBALS['mysqli_set_username']->prepare("SET @str_name = ?");
                    $stmt->bind_param('s', $name);
                    $stmt->execute();

                    $stmt = $GLOBALS['mysqli_set_username']->prepare("SET @sess_id = ?");
                    $stmt->bind_param('s', $session_id);
                    $stmt->execute();

                    $GLOBALS['mysqli_set_username']->query('CALL setUsername(@str_name, @sess_id)');
                }

                if (isset($_GET["password"]) && iconv_strlen($_GET["password"],'UTF-8') > 0)
                {
                    $password = htmlspecialchars($_GET["password"]);
                    $password = trim($password);
                    $password = password_hash($password, PASSWORD_BCRYPT);

                    $stmt = $GLOBALS['mysqli_set_userpass']->prepare("SET @pass = ?");
                    $stmt->bind_param('s', $password);
                    $stmt->execute();

                    $stmt = $GLOBALS['mysqli_set_userpass']->prepare("SET @sess_id = ?");
                    $stmt->bind_param('s', $session_id);
                    $stmt->execute();

                    $GLOBALS['mysqli_set_userpass']->query('CALL setUserpass(@pass, @sess_id )');
                }

                if (isset($_GET["email"]) && iconv_strlen($_GET["email"],'UTF-8') > 0)
                {
                    $email = htmlspecialchars($_GET["email"]);
                    $email = trim($email);

                    $stmt = $GLOBALS['mysqli_set_usermail']->prepare("SET @mail = ?");
                    $stmt->bind_param('s', $email);
                    $stmt->execute();

                    $stmt = $GLOBALS['mysqli_set_usermail']->prepare("SET @sess_id = ?");
                    $stmt->bind_param('s', $session_id);
                    $stmt->execute();

                    $GLOBALS['mysqli_set_usermail']->query('CALL setUsermail(@mail, @sess_id)');
                }

                $stmt = $GLOBALS['mysqli_get_cabinet']->prepare("SET @sess_id = ?");
                $stmt->bind_param('s', $session_id);
                $stmt->execute();

                $result = $GLOBALS['mysqli_get_cabinet']->query('CALL getCabinet(@sess_id)');
                $row = $result->fetch_assoc();

                header('Content-Type: application/json');
                echo json_encode($row, JSON_UNESCAPED_UNICODE);
            }
        }
    }
?>
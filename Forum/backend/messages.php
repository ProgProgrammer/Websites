<?php
    require_once "stored_procedures.php";

    if (isset($_GET["num_mes"]))
    {
        $num_mes = htmlspecialchars($_GET["num_mes"]);
        $stmt = $GLOBALS['mysqli_get_mes']->prepare("SET @mes_id = ?");
        $stmt->bind_param('i', $num_mes);
        $stmt->execute();

        $result = $GLOBALS['mysqli_get_mes']->query("CALL getMes(@mes_id)");
        $myArray = array();

        while($row = $result->fetch_assoc())
        {
            $myArray[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($myArray, JSON_UNESCAPED_UNICODE);
    }
    else if (isset($_GET["text"]) && isset($_GET["ip"]) && isset($_GET["sess_id"]))
    {
        $text = htmlspecialchars($_GET["text"]);
        $ip = htmlspecialchars($_GET["ip"]);
        $session_id = htmlspecialchars($_GET["sess_id"]);

        $stmt = $GLOBALS['mysqli_get_mes']->prepare("SET @sess_id = ?");
        $stmt->bind_param('s', $session_id);
        $stmt->execute();

        $result = $GLOBALS['mysqli_get_mes']->query("CALL getIp(@sess_id)");
        $row = $result->fetch_assoc();
        $hash_ip = $row['ip_address'];

        if (password_verify($ip, $hash_ip))
        {
            $stmt = $GLOBALS['mysqli_get_user_id']->prepare("SET @sess_id = ?");
            $stmt->bind_param('s', $session_id);
            $stmt->execute();

            $result = $GLOBALS['mysqli_get_user_id']->query("CALL getUserId(@sess_id)");
            $myArray = array();
            $row = $result->fetch_assoc();

            $stmt = $GLOBALS['mysqli_set_mes']->prepare("SET @text_mes = ?");
            $stmt->bind_param('s', $text);
            $stmt->execute();

            $stmt = $GLOBALS['mysqli_set_mes']->prepare("SET @user_id = ?");
            $stmt->bind_param('s', $row['id']);
            $stmt->execute();

            $GLOBALS['mysqli_set_mes']->query("CALL setMes(@text_mes, @user_id)");

            header('Content-Type: application/json');
            echo json_encode("1", JSON_UNESCAPED_UNICODE);
        }
    }
?>

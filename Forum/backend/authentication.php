<?php
    require_once "stored_procedures.php";

    function checkAuthentification($session_id, $ip)
    {
        $stmt = $GLOBALS['mysqli_get_ip']->prepare("SET @sess_id = ?");
        $stmt->bind_param('s', $session_id);
        $stmt->execute();

        $result = $GLOBALS['mysqli_get_ip']->query('CALL getIp(@sess_id)');

        if (mysqli_num_rows($result) !== 0)
        {
            $row = $result->fetch_assoc();
            $hash_ip = $row['ip_address'];

            if (password_verify($ip, $hash_ip))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    function getUsername($session_id)
    {
        $stmt = $GLOBALS['mysqli_get_username']->prepare("SET @sess_id = ?");
        $stmt->bind_param('s', $session_id);
        $stmt->execute();

        $result = $GLOBALS['mysqli_get_username']->query('CALL getUsername(@sess_id)');

        if (mysqli_num_rows($result) !== 0)
        {
            $row = $result->fetch_assoc();
            $name = $row['name'];

            return $name;
        }
        else
        {
            return false;
        }
    }
?>
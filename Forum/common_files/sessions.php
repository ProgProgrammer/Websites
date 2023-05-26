<?php
    $options = session_set_cookie_params([
        //'lifetime' => 3600,  // время жизни сессионной куки, заданное в секундах
        'path' => '/',       // Путь в домене, где cookie будет работать. Одна косая черта ('/') для всех путей в домене.
        'domain' => $_SERVER['HTTP_HOST'],  // Домен cookie
        'secure' => false,   // Если true, то cookies будут передаваться только через защищённые соединения
        'httponly' => true   // Если задано true, cookie будут доступны только через HTTP-протокол
    ]);

    session_start();
?>
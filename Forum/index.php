Hello, world!
<?php
    require_once "common_files/sessions.php";
    require_once "common_files/ip_and_session.php";
    require_once "backend/authentication.php";

    $check_authentification = checkAuthentification(session_id(), $_SERVER['REMOTE_ADDR']);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="files/css/styles.scss" type="text/css"/>
    <title>Forum</title>
</head>
<body>
    <div class="container py-3">
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="/forum/" class="d-flex align-items-center link-body-emphasis text-decoration-none">
                <span class="fs-4">Форум</span>
            </a>
            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="/forum/">Главная</a>
                <?php if ($check_authentification) { ?>
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="/forum/pages/cabinet.php">Личный кабинет
                    <span class="username-js"></span></a>
                <button class="btn btn-primary button-logout-js">Выйти</button>
                <?php } else { ?>
                <a class="btn btn-primary" href="/forum/pages/logup.php">Войти</a>
                <?php } ?>
            </nav>
        </div>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h6 class="border-bottom pb-2 mb-0">Сообщения:</h6>
            <div class="d-flex text-body-secondary pt-3 display-none block-message-js">
                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark name-message-js">Имя</strong>
                        <span class="number-message-js">№ сообщения</span>
                    </div>
                    <p class="text-message-js">Hello, world!</p>
                    <!--<a href="#answer" class="str-url str-url-js">Ответить</a>-->
                </div>
            </div>
            <div class="container-message-js"></div>
            <small class="d-block text-end mt-3">
                <p class="more-messages more-messages-js">Больше сообщений</p>
            </small>
            <?php if ($check_authentification) { ?>
                <a href="" name="answer"></a>
                <div class="form-group blockSendMes form-messages">
                    <label for="exampleFormControlTextarea1" class="blockSendMes__title">Введите сообщение</label>
                    <textarea class="form-control form-messages-text-js" id="exampleFormControlTextarea1" rows="5"></textarea>
                    <button type="button" class="btn btn-primary blockSendMes__button form-button mes-button-js" href="#">Отправить</button>
                </div>
            <?php } ?>
        </div>
        <script>
            const url_ajax_index = "backend/messages.php";
            const url_ajax_auth = "backend/authorization.php";
        </script>
        <script src="files/js/index.js"></script>
        <script src="files/js/authorization.js"></script>
    </div>
</body>
</html>
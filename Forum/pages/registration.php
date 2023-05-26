<?php
require_once "../common_files/sessions.php";
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../files/css/styles.scss" type="text/css"/>
    <title>Forum</title>
</head>
<body>
<?php
require_once "../common_files/ip_and_session.php";
require_once "../backend/authentication.php";

$check_authentification = checkAuthentification(session_id(), $_SERVER['REMOTE_ADDR']);
?>
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
            <?php } ?>
        </nav>
    </div>
</div>
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5 logupBlock" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <?php if (!$check_authentification) { ?>
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Зарегистрируйтесь</h1>
                <a href="../index.php" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body p-5 pt-0">
                <form class="form-log-js">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3 login-js" id="floatingInput" placeholder="Login" required>
                        <label for="floatingInput">Введите логин</label>
                    </div>
                    <p class="display-none form-error-text-js">Такой логин уже существует</p>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3 name-js" id="floatingInput" placeholder="Name" required>
                        <label for="floatingInput">Введите имя</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-3 email-js" id="floatingInput" placeholder="Email" required>
                        <label for="floatingInput">Введите email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3 password-js" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Введите пароль</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3 password-js" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Подтвердите пароль</label>
                    </div>
                    <p class="display-none form-error-text-js">Пароли не совпадают</p>
                    <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary button-registr-js" type="submit">Регистрация</button>
                </form>
            </div>
            <p style="margin: 15px;" class="display-none log-text-js">Добро пожаловать, <span class="log-name-js"></span>.</p>
            <?php } else { ?>
                <p style="margin: 15px;">Добро пожаловать, <span><?php echo getUsername(session_id(), $_SERVER['REMOTE_ADDR']); ?></span>.</p>
            <?php } ?>
        </div>
    </div>
    <script>
        const url_ajax_auth = "../backend/registration.php";
    </script>
</div>
<script src="../files/js/registration.js"></script>
</body>
</html>

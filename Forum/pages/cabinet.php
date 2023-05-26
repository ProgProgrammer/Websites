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
require_once "../backend/cabinet.php";

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
                <button class="btn btn-primary button-logout-js">Выйти</button>
            <?php } ?>
        </nav>
    </div>
</div>
<?php if ($check_authentification)
{
$data = getInfoCabinet(session_id());
?>
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5 logupBlock" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow block-cabinet">
            <p class="info-cabinet">Имя: <span class="info-cabinet-js"><?php echo $data['name']; ?></span></p>
            <p class="info-cabinet">Логин: <span class="info-cabinet-js"><?php echo $data['login']; ?></span></p>
            <p class="info-cabinet">Email: <spab class="info-cabinet-js"><?php echo $data['email']; ?></spab></p>
            <button class="btn btn-primary button button-delete-user-js">Удалить себя</button>
        </div>
    </div>
</div>
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5 logupBlock" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow block-cabinet">
            <form action="" method="get" clas="form-block">
                <input type="text" name="name" class="input-js" placeholder="Name"/>
                <input type="text" name="password" class="input-js" placeholder="Password"/>
                <input type="text" name="email" class="input-js" placeholder="Email"/>
                <button type="submit" class="btn btn-primary button button-change-user-js">Изменить свои данные</button>
            </form>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5 logupBlock" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow block-cabinet">
            <p style="margin: 15px;">Вам необходимо авторизоваться.</p>
        </div>
    </div>
</div>
<?php } ?>
<script>
    const url_ajax_index = "../backend/cabinet.php";
    const url_ajax_auth = "../backend/authorization.php";
</script>
<script src="../files/js/cabinet.js"></script>
<script src="../files/js/authorization.js"></script>
</body>
</html>

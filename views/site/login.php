<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="/server-php/public/css/login.css">
</head>
<body>

<div class="login-container">
       <h2>Авторизация</h2>
    <h3><?= $message ?? ''; ?></h3>

    <h3><?= app()->auth->user()->name ?? ''; ?></h3>
    <?php
    if (!app()->auth::check()):
       ?>
       <form method="post">
           <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
           <label>Логин <input type="text" name="login"></label>
           <label>Пароль <input type="password" name="password"></label>
           <button>Войти</button>
       </form>
    <?php endif;?>
</div>

</body>
</html>

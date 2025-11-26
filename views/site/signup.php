<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/server-php/public/css/register.css">
</head>
<body>

<div class="register-container">
    <h2>Регистрация нового пользователя</h2>
    <pre><?= $message ?? ''; ?></pre>
    <form method="post">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>Имя <input type="text" name="name"></label>
        <label>Логин <input type="text" name="login"></label>
        <label>Пароль <input type="password" name="password"></label>
        <button>Зарегистрироваться</button>
    </form>
</div>

</body>
</html>
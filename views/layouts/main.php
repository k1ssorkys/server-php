<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pop it MVC</title>
</head>
<body>

<?php
// Определяем текущий путь
$uri = explode('?', $_SERVER['REQUEST_URI'])[0];
$showHeader = in_array($uri, [
    app()->route->getUrl('/login'),
    app()->route->getUrl('/signup')
]);
?>

<?php if ($showHeader): ?>
    <header>
        <nav>
<!--            <a href="--><?php //= app()->route->getUrl('/hello') ?><!--">Главная</a>-->
            <?php if (!app()->auth::check()): ?>
<!--                <a href="--><?php //= app()->route->getUrl('/login') ?><!--">Вход</a>-->
<!--                <a href="--><?php //= app()->route->getUrl('/signup') ?><!--">Регистрация</a>-->
            <?php else: ?>
                <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
            <?php endif; ?>
        </nav>
    </header>
<?php endif; ?>

<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>

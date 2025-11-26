<?php $showLayout = false; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить читателя</title>
    <link rel="stylesheet" href="/server-php/public/css/hello.css">
    <link rel="stylesheet" href="/server-php/public/css/new-books.css">
</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <div class="logo">
            <img src="/assets/Notebook Bookmark.svg" alt="Library logo">
            <span>LIBRARY</span>
        </div>
        <ul class="menu">
            <li><a href="hello"><img src="/assets/Widget.svg" alt=""><span>Книги</span></a></li>
<!--            <li><a href="#"><img src="/assets/Chart 2.svg" alt=""><span>Популярные</span></a></li>-->
            <li><a href="show_reader"><img src="/assets/User Id.svg" alt=""><span>Читатели</span></a></li>
            <li><a href="issued"><img src="/assets/Unread.svg" alt=""><span>Учёт выдачи</span></a></li>
            <li><a href="new_reader"><img src="/assets/User Plus Rounded.svg" alt=""><span>Новые читатели</span></a></li>
            <li><a href="new_books"><img src="/assets/Vector.svg" alt=""><span>Новые книги</span></a></li>
            <?php if (app()->auth::check() && app()->auth->user()->roleID === 1): ?>
                <li><a href="new_librarian">
                        <img src="/assets/User Plus Rounded.svg" alt="">
                        <span>Новые библиотекари</span>
                    </a></li>
            <?php endif; ?>

        </ul>


        <div class="auth-block">
            <?php if (!app()->auth::check()): ?>
                <a href="login" class="auth-link">Вход</a>
                <a href="signup" class="auth-link">Регистрация</a>
            <?php else: ?>
                <p class="auth-user"><?= app()->auth->user()->name ?></p>
                <a href="logout" class="auth-link">Выход</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="main">
        <h1>Добавить нового читателя</h1>
        <div class="form-wrapper">
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                <div class="form-row">
                    <label>Фамилия</label>
                    <input type="text" name="lastName" required>
                </div>
                <div class="form-row">
                    <label>Имя</label>
                    <input type="text" name="firstName" required>
                </div>
                <div class="form-row">
                    <label>Отчество</label>
                    <input type="text" name="patronymic">
                </div>
                <div class="form-row">
                    <label>Адрес</label>
                    <input type="text" name="address">
                </div>
                <div class="form-row">
                    <label>Телефон</label>
                    <input type="text" name="phone">
                </div>
                <div class="button-wrap">
                    <button type="submit" class="btn dark">Добавить читателя</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

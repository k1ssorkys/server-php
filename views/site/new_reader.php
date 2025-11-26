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
            <span>LIBRARY</span>
        </div>
        <ul class="menu">
            <li><a href="hello"><span>📚 Книги</span></a></li>
            <li><a href="show_reader"><span>👥 Читатели</span></a></li>
            <li><a href="issued"><span>📋 Учёт выдачи</span></a></li>
            <li><a href="new_reader"><span>➕ Новые читатели</span></a></li>
            <li><a href="new_books"><span>🆕 Новые книги</span></a></li>
            <?php if (app()->auth::check() && app()->auth->user()->roleID === 1): ?>
                <li><a href="new_librarian">
                        <span>👨‍💼 Новые библиотекари</span>
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
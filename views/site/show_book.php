<?php $showLayout = false; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($book->title) ?></title>
    <link rel="stylesheet" href="/server-php/public/css/hello.css">
</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <div class="logo">
            <img src="/assets/Notebook Bookmark.svg" alt="Логотип библиотеки">
            <span>LIBRARY</span>
        </div>
        <ul class="menu">
            <li><a href="hello"><img src="/assets/Widget.svg" alt=""><span>Книги</span></a></li>
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
        <h1><?= htmlspecialchars($book->title) ?></h1>

        <?php
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/' . $book->image;
        if (!empty($book->image) && file_exists($imagePath)): ?>
            <img src="/uploads/<?= htmlspecialchars($book->image) ?>" alt="Обложка книги" style="max-width:200px; margin-bottom:20px;">
        <?php else: ?>
            <p>Обложка не загружена.</p>
        <?php endif; ?>

        <p><strong>Год выпуска:</strong> <?= htmlspecialchars($book->year) ?></p>
        <p><strong>Автор:</strong> <?= htmlspecialchars($book->author) ?></p>
        <p><strong>ISBN:</strong> <?= htmlspecialchars($book->isbn) ?></p>
        <p><strong>Цена:</strong> <?= number_format($book->price, 2) ?> ₽</p>
        <p><strong>Описание:</strong> <?= nl2br(htmlspecialchars($book->description)) ?></p>
    </div>
</div>
</body>
</html>

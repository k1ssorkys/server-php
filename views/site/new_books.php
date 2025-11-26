<?php $showLayout = false; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить книгу</title>
    <link rel="stylesheet" href="/server-php/public/css/hello.css">
    <link rel="stylesheet" href="/server-php/public/css/new-books.css">
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
<!--            <li><a href="#"><img src="/assets/Chart 2.svg" alt=""><span>Популярные</span></a></li>-->
            <li><a href="show_reader"><img src="/assets/User Id.svg" alt=""><span>Читатели</span></a></li>
            <li><a href="issued"><img src="/assets/Unread.svg" alt=""><span>Учёт выдачи</span></a></li>
            <li><a href="new_reader"><img src="/assets/User Plus Rounded.svg" alt=""><span>Новые читатели</span></a></li>
            <li><a href="new_books"><img src="/assets/Vector.svg" alt=""><span>Новые книги</span></a></li>
            <?php if (app()->auth::check() && app()->auth->user()->roleID === 1): ?>
                <li><a href="new_librarian"><img src="/assets/User Plus Rounded.svg" alt=""><span>Новые библиотекари</span></a></li>
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
        <h1>Добавить новую книгу</h1>
        <div class="form-wrapper">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
                <div class="form-row">
                    <label>Название</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-row">
                    <label>Автор</label>
                    <input type="text" name="author" required>
                </div>
                <div class="form-row">
                    <label>Год выпуска</label>
                    <input type="text" name="year" required>
                </div>
                <div class="form-row">
                    <label>ISBN</label>
                    <input type="text" name="isbn">
                </div>
                <div class="form-row">
                    <label>Описание</label>
                    <input type="text" name="description">
                </div>
                <div class="form-row">
                    <label>Цена (₽)</label>
                    <input type="text" name="price">
                </div>
                <div class="form-row">
                    <label>Обложка</label>
                    <input type="file" name="image" accept="image/*">
                </div>
                <div class="button-wrap">
                    <button type="submit" class="btn dark">Добавить книгу</button>
                </div>
            </form>

            <?php if (!empty($message)): ?>
                <p style="margin-top: 20px;"><strong><?= htmlspecialchars($message) ?></strong></p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
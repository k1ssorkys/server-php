<?php $showLayout = false; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Читатели</title>
    <link rel="stylesheet" href="/server-php/public/css/hello.css">
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
        <h1>Читатели</h1>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>№</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Телефон</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($readers as $reader): ?>
                    <tr>
                        <td><?= $reader->id ?></td>
                        <td><a href="/reader/<?= $reader->id ?>" class="book-row"><?= htmlspecialchars($reader->lastName) ?></a></td>
                        <td><?= htmlspecialchars($reader->firstName) ?></td>
                        <td><?= htmlspecialchars($reader->patronymic) ?></td>
                        <td><?= htmlspecialchars($reader->phone) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
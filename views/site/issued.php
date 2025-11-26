<?php $showLayout = false; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Учёт выдачи</title>
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
        <h1>Учёт выдачи и возврата книг</h1>

        <div class="form-wrapper">
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

                <div class="form-row">
                    <label>Выбрать пользователя</label>
                    <select name="readerID" required>
                        <option value="">Выберите</option>
                        <?php foreach ($readers as $reader): ?>
                            <option value="<?= $reader->id ?>" <?= isset($foundReader) && $foundReader->id == $reader->id ? 'selected' : '' ?>>
                                <?= $reader->lastName ?> <?= $reader->firstName ?> (ID: <?= $reader->id ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-row">
                    <label>Выбрать книгу</label>
                    <select name="bookID" required>
                        <option value="">Выберите</option>
                        <?php foreach ($books as $book): ?>
                            <option value="<?= $book->id ?>"><?= $book->title ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="button-wrap">
                    <button type="submit" name="action" value="issue" class="btn dark">Выдать</button>
                    <button type="submit" name="action" value="return" class="btn dark">Вернуть</button>
                </div>
            </form>
        </div>

        <?php if (!empty($message)): ?>
            <p style="margin-top: 20px;"><strong><?= htmlspecialchars($message) ?></strong></p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
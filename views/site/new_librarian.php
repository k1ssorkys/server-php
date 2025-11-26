<?php $showLayout = false; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новые библиотекари</title>
    <link rel="stylesheet" href="/server-php/public/css/hello.css">
    <link rel="stylesheet" href="/server-php/public/css/new-books.css">
    <link rel="stylesheet" href="/server-php/public/css/new_librarian.css">
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
            <li><a href="new_librarian"><span>👨‍💼 Новые библиотекари</span></a></li>
        </ul>
        <div class="auth-block">
            <?php if (!app()->auth::check()): ?>
                <a href="login" class="auth-link">Вход</a>
            <?php else: ?>
                <p class="auth-user"><?= app()->auth->user()->name ?></p>
                <a href="logout" class="auth-link">Выход</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="main">
        <h1>Добавление библиотекаря</h1>

        <?php if (!empty($message)): ?>
            <p style="color: #333; background: #e0e0e0; padding: 10px 20px; border-radius: 10px; margin-bottom: 20px;">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

        <div class="main-content-flex">
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
                        <label>Логин</label>
                        <input type="text" name="login" required>
                    </div>
                    <div class="form-row">
                        <label>Пароль</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="form-row">
                        <label>Телефон</label>
                        <input type="text" name="phone">
                    </div>
                    <div class="button-wrap">
                        <button type="submit" class="btn dark">Добавить</button>
                    </div>
                </form>
            </div>

            <div class="librarian-wrapper">
                <h2>Список библиотекарей</h2>
                <div class="librarian-list">
                    <table>
                        <thead>
                        <tr>
                            <th>ФИО</th>
                            <th>Логин</th>
                            <th>Телефон</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($librarians as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars("{$user->lastName} {$user->firstName} {$user->patronymic}") ?></td>
                                <td><?= htmlspecialchars($user->login) ?></td>
                                <td><?= htmlspecialchars($user->phone) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>
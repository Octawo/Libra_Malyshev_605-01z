<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
<h2>Вход в систему</h2>
<form action="../app/auth.php" method="post">
    <label>Логин:</label>
    <input type="text" name="username" required>
    <br>
    <label>Пароль:</label>
    <input type="password" name="password" required>
    <br>
    <button type="submit">Войти</button>
</form>
</body>
</html>
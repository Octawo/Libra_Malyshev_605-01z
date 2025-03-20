<?php
session_start();
if (!isset($_SESSION['user'])) { // Если нет пользователя в сессии
    header("Location: login.php"); // Перенаправляем на вход
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель библиотекаря</title>
</head>
<body>
<h1>Добро пожаловать, <?php echo $_SESSION['user']['username']; ?>!</h1>
<a href="logout.php">Выход</a>
</body>
</html>

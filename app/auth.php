<?php
session_start(); // Начинаем сессию
require_once 'db.php'; // Подключаем базу данных

// Проверяем, был ли отправлен POST-запрос
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // Получаем введённый логин
    $password = $_POST['password']; // Получаем введённый пароль

    // Ищем пользователя в базе
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(); // Получаем пользователя

    // Проверяем пароль
    if ($user && hash('sha256', $password) === $user['password']) {
        $_SESSION['user'] = $user; // Сохраняем пользователя в сессии
        header("Location: ../public/dashboard.php"); // Перенаправляем в панель библиотекаря
        exit();
    } else {
        echo "Неверный логин или пароль!";
    }
}
?>

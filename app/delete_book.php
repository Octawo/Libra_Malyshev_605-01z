<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../public/login.php");
    exit();
}
require_once 'db.php';

// Проверяем, передан ли ID книги
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ../public/dashboard.php");
    exit();
}

// Удаляем все копии книги
$stmt = $pdo->prepare("DELETE FROM copy WHERE book_id = ?");
$stmt->execute([$id]);

// Удаляем саму книгу
$stmt = $pdo->prepare("DELETE FROM book WHERE id = ?");
$stmt->execute([$id]);

// Возвращаемся на главную страницу
header("Location: ../public/dashboard.php");
exit();
?>
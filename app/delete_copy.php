<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../public/login.php");
    exit();
}
require_once 'db.php';

// Получаем ID экземпляра
$copy_id = $_GET['id'] ?? null;
$book_id = $_GET['book_id'] ?? null;
if (!$copy_id || !$book_id) {
    header("Location: ../public/dashboard.php");
    exit();
}

try {
    // Удаляем экземпляр
    $stmt = $pdo->prepare("DELETE FROM copy WHERE id = ?");
    $stmt->execute([$copy_id]);

    // Возвращаемся на страницу управления экземплярами
    header("Location: ../public/manage_copies.php?id=$book_id");
    exit();
} catch (PDOException $e) {
    die("Ошибка удаления: " . $e->getMessage());
}
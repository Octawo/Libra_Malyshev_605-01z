<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Система учета книг'; ?></title>
        <script>
            function confirmDelete(bookId) {
                if (confirm('Вы уверены, что хотите удалить эту книгу?')) {
                    window.location.href = '../app/delete_book.php?id=' + encodeURIComponent(bookId);
                }
            }
        </script>
        <style>
            .nav-container {
                margin-bottom: 20px;
            }
            .user-info {
                font-weight: bold;
                color: #333;
                margin-bottom: 10px;
            }
        </style>
    </head>
<body>
<div class="user-info">
    Вы авторизованы как: <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong>
</div>
<nav class="nav-container">
    <a href="dashboard.php">Главная</a> |
    <a href="logout.php">Выйти</a>
</nav>

<?php
// Здесь можно добавить дополнительные сообщения или ошибки, если они есть
if (isset($error)) {
    echo "<p style='color: red;'>{$error}</p>";
}
?>
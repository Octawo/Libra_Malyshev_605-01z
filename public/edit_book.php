<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
require_once '../app/db.php';

// Получаем ID книги из запроса
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: dashboard.php");
    exit();
}

// Получаем данные о книге
$stmt = $pdo->prepare("SELECT * FROM book WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();
if (!$book) {
    header("Location: dashboard.php");
    exit();
}

// Обновляем данные книги
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    if (!empty($title) && !empty($author)) {
        $stmt = $pdo->prepare("UPDATE book SET title = ?, author = ? WHERE id = ?");
        $stmt->execute([$title, $author, $id]);
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Заполните все поля!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать книгу</title>
</head>
<body>
<h1>Редактировать книгу</h1>
<a href="dashboard.php">Назад</a>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Название книги:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
    <br>
    <label>Автор:</label>
    <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
    <br>
    <button type="submit">Сохранить</button>
</form>
</body>
</html>

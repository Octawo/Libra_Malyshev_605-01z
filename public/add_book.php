<?php
require_once 'header.php'; // Включаем общий заголовок
require_once '../app/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $wear_coefficient = $_POST['wear_coefficient'] ?? '';

    if (!empty($title) && !empty($author) && !empty($wear_coefficient)) {
        $wear_coefficient = filter_var($wear_coefficient, FILTER_VALIDATE_FLOAT);
        if ($wear_coefficient === false || $wear_coefficient < 0 || $wear_coefficient > 100) {
            $error = "Степень износа должна быть числом от 0 до 100!";
        } else {
            try {
                $pdo->beginTransaction();
                $stmt = $pdo->prepare("INSERT INTO book (title, author) VALUES (?, ?)");
                $stmt->execute([$title, $author]);
                $book_id = $pdo->lastInsertId();
                $stmt = $pdo->prepare("INSERT INTO copy (book_id, wear_coefficient) VALUES (?, ?)");
                $stmt->execute([$book_id, $wear_coefficient]);
                $pdo->commit();
                header("Location: dashboard.php");
                exit();
            } catch (PDOException $e) {
                $pdo->rollBack();
                $error = "Ошибка при добавлении книги: " . $e->getMessage();
            }
        }
    } else {
        $error = "Заполните все поля!";
    }
}
?>

<h1>Добавить книгу</h1>
<a href="dashboard.php">Назад</a>

<form method="POST">
    <label>Название книги:</label>
    <input type="text" name="title" required>
    <br>
    <label>Автор:</label>
    <input type="text" name="author" required>
    <br>
    <label>Степень износа (от 0 до 100, где 0 - новая книга):</label>
    <input type="number" name="wear_coefficient" step="0.01" min="0" max="100" required>
    <br>
    <button type="submit">Добавить</button>
</form>

</body>
</html>
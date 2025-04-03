<?php
require_once 'header.php'; // Включаем общий заголовок
require_once '../app/db.php';

// Получаем ID книги
$book_id = $_GET['id'] ?? null;
if (!$book_id) {
    header("Location: dashboard.php");
    exit();
}

// Получаем данные о книге
$stmt = $pdo->prepare("SELECT * FROM book WHERE id = ?");
$stmt->execute([$book_id]);
$book = $stmt->fetch();
if (!$book) {
    header("Location: dashboard.php");
    exit();
}

// Получаем список копий книги
$stmt = $pdo->prepare("SELECT * FROM copy WHERE book_id = ?");
$stmt->execute([$book_id]);
$copies = $stmt->fetchAll();

// Обработка добавления нового экземпляра
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wear_coefficient = $_POST['wear_coefficient'] ?? '';

    if (!empty($wear_coefficient)) {
        $wear_coefficient = filter_var($wear_coefficient, FILTER_VALIDATE_FLOAT);
        if ($wear_coefficient === false || $wear_coefficient < 0 || $wear_coefficient > 100) {
            $error = "Степень износа должна быть числом от 0 до 100!";
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO copy (book_id, wear_coefficient) VALUES (?, ?)");
                $stmt->execute([$book_id, $wear_coefficient]);
                header("Location: manage_copies.php?id=$book_id");
                exit();
            } catch (PDOException $e) {
                $error = "Ошибка при добавлении экземпляра: " . $e->getMessage();
            }
        }
    } else {
        $error = "Заполните поле степени износа!";
    }
}
?>

<h1>Экземпляры книги: <?= htmlspecialchars($book['title']) ?></h1>
<a href="dashboard.php">Назад</a>

<h2>Список экземпляров</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Степень износа</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($copies as $copy): ?>
        <tr>
            <td><?= $copy['id'] ?></td>
            <td><?= number_format($copy['wear_coefficient'], 2) ?></td>
            <td>
                <a href="../app/delete_copy.php?id=<?= $copy['id'] ?>&book_id=<?= $book_id ?>" onclick="return confirm('Удалить экземпляр?')">Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Добавить экземпляр</h2>
<form method="POST">
    <label>Степень износа (от 0 до 100, где 0 - новая книга):</label>
    <input type="number" name="wear_coefficient" step="0.01" min="0" max="100" required>
    <br>
    <button type="submit">Добавить экземпляр</button>
</form>

</body>
</html>
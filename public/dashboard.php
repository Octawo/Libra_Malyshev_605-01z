<?php
require_once 'header.php'; // Включаем общий заголовок
require_once '../app/db.php';
?>

<h1>Добро пожаловать в систему учета книг</h1>

<h2>Список книг</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Автор</th>
        <th>Количество экземпляров</th>
        <th>Действия</th>
    </tr>
    <?php
    try {
        $stmt = $pdo->query("SELECT book.id, book.title, book.author, 
                                        COUNT(copy.id) AS copies_count
                                 FROM book 
                                 LEFT JOIN copy ON book.id = copy.book_id 
                                 GROUP BY book.id");
        while ($book = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>{$book['id']}</td>";
            echo "<td>{$book['title']}</td>";
            echo "<td>{$book['author']}</td>";
            echo "<td>{$book['copies_count']}</td>";
            echo "<td>
                    <a href='manage_copies.php?id={$book['id']}'>Управлять экземплярами</a> |
                    <button onclick='confirmDelete({$book['id']})'>Удалить</button>
                  </td>";
            echo "</tr>";
        }
    } catch (PDOException $e) {
        echo "Ошибка при загрузке списка книг: " . $e->getMessage();
    }
    ?>
</table>

<div style="margin-top: 20px; text-align: left;">
    <a href="add_book.php" style="color: blue; text-decoration: underline; cursor: pointer;">Добавить книгу</a>
</div>

</body>
</html>
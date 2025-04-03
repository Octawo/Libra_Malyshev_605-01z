<?php

$conn = new PDO("mysql:host=localhost;dbname=libra", 'root', 'STb6R42Nr5');
$result = $conn->query("SELECT * from book");
echo "<table border='1'>";
while ($row = $result->fetch()) {
    echo '<tr><td>'.$row['title'].'</td><td>'.$row['author'].'</td></tr>';
}

?>
<?php
// Подключение к базе данных
session_start();
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение ID платья из формы
    $id = $_POST['id'];

    // Подготовка SQL запроса
    $sql = "DELETE FROM wedding_dresses WHERE id = ?";
    $stmt = $db->prepare($sql);

    // Выполнение запроса
    if ($stmt->execute([$id])) {
        echo "Платье удалено.";
    } else {
        echo "Ошибка при удалении платья.";
    }
}
?>
<?php
// Подключение к базе данных
session_start();
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Подготовка SQL запроса
    $sql = "INSERT INTO wedding_services (name, description) VALUES (?, ?)";
    $stmt = $db->prepare($sql);

    // Привязка параметров
    $stmt->bind_param("ss", $name, $description);

    // Выполнение запроса
    if ($stmt->execute()) {
        echo "Услуга добавлена.";
    } else {
        echo "Ошибка при добавлении услуги: " . $stmt->error;
    }

    // Закрытие подготовленного запроса
    $stmt->close();
}

// Закрытие соединения
$db->close();
?>
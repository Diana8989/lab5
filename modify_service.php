<?php
// Подключение к базе данных
session_start();
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == 'Изменить') {
        // Получение данных из формы
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Подготовка SQL запроса
        $sql = "UPDATE wedding_services SET name = ?, description = ? WHERE id = ?";
        $stmt = $db->prepare($sql);

        // Привязка параметров
        $stmt->bind_param("ssi", $name, $description, $id);

        // Выполнение запроса
        if ($stmt->execute()) {
            echo "Услуга изменена.";
        } else {
            echo "Ошибка при изменении услуги: " . $stmt->error;
        }
    } elseif ($action == 'Удалить') {
        // Подготовка SQL запроса
        $sql = "DELETE FROM wedding_services WHERE id = ?";
        $stmt = $db->prepare($sql);

        // Привязка параметров
        $stmt->bind_param("i", $id);

        // Выполнение запроса
        if ($stmt->execute()) {
            echo "Услуга удалена.";
        } else {
            echo "Ошибка при удалении услуги: " . $stmt->error;
        }
    }

    // Закрытие подготовленного запроса
    $stmt->close();
}

// Закрытие соединения
$db->close();
?>
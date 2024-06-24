<?php

session_start();
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Получаем id записи, которую нужно обновить
    $decoration_type = $_POST['decoration_type'];
    $additional_services = $_POST['additional_services'];

    // Подключение к базе данных
    $db = new mysqli('localhost', 'root', '', 'svadebniy_salon');
    if ($db->connect_error) {
        die("Ошибка подключения: " . $db->connect_error);
    }

    // Подготовка запроса
    // Используем id как идентификатор для обновления
    $query = $db->prepare("UPDATE users_selections SET decoration_type = ?, additional_services = ? WHERE id = ?");
    $query->bind_param("ssi", $decoration_type, $additional_services, $id);

    // Выполнение запроса
    if ($query->execute()) {
        echo "Запись успешно обновлена";
    } else {
        echo "Ошибка: " . $query->error;
    }

    $query->close();
    $db->close();
}

?>
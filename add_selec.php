<?php
//ТАБЛИЦА ОФОРМЛЕНИЕ
session_start();
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users_id = $_POST['users_id'];
    $venues_id = $_POST['venues_id'];
    $decoration_type = $_POST['decoration_type'];
    $additional_services = $_POST['additional_services'];

    // Подготовка запроса
    $query = $db->prepare("INSERT INTO users_selections (users_id, venues_id, decoration_type, additional_services) VALUES (?, ?, ?, ?)");
    // Не нужно вставлять id, так как он должен автоматически инкрементироваться
    $query->bind_param("iiss", $users_id, $venues_id, $decoration_type, $additional_services);

    // Выполнение запроса
    if ($query->execute()) {
        echo "Запись успешно добавлена";
    } else {
        echo "Ошибка: " . $query->error;
    }

    $query->close();
    $db->close();
}
?>
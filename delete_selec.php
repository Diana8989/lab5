<?php
session_start();

$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

// Проверка, был ли отправлен запрос на удаление
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Подготовка запроса на удаление
    $query = $db->prepare("DELETE FROM users_selections WHERE id = ?");
    $query->bind_param("i", $id);

    // Выполнение запроса
    if ($query->execute()) {
        echo "Запись успешно удалена";
    } else {
        echo "Ошибка: " . $query->error;
    }

    $query->close();
}
$db->close();
?>

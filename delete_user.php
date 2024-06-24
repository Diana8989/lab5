<?php

session_start();
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

// Проверка отправленных данных
if (isset($_POST['users_id'])) {
    // Получение данных из формы
    $users_id = $_POST['users_id'];

    // Подготовка SQL-запроса
    if ($stmt = $db->prepare("DELETE FROM users WHERE users_id=?")) {
        // Привязка параметров
        $stmt->bind_param('i', $users_id);
        // Выполнение запроса
        $stmt->execute();

        // Проверка успешности выполнения запроса
        if ($stmt->affected_rows > 0) {
            echo "Пользователь удален.";
        } else {
            echo "Ошибка при удалении пользователя.";
        }
        // Закрытие запроса
        $stmt->close();
    } else {
        echo "Ошибка подготовки запроса: " . $db->error;
    }
}
?>


<?php

session_start();
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

// Проверка отправленных данных
if (isset($_POST['login'], $_POST['email'], $_POST['password'], $_POST['role'])) {
    // Получение данных из формы
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хеширование пароля
    $role = $_POST['role'];

    // Подготовка SQL-запроса
    if ($stmt = $db->prepare("INSERT INTO users (login, email, password, role) VALUES (?, ?, ?, ?)")) {
        // Привязка параметров
        $stmt->bind_param('ssss', $login, $email, $password, $role);
        // Выполнение запроса
        $stmt->execute();

        // Проверка успешности выполнения запроса
        if ($stmt->affected_rows > 0) {
            echo "Пользователь добавлен.";
        } else {
            echo "Ошибка при добавлении пользователя.";
        }
        // Закрытие запроса
        $stmt->close();
    } else {
        echo "Ошибка подготовки запроса: " . $db->error;
    }
}
?>



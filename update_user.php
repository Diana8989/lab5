<?php

session_start();
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

// Проверка отправленных данных
if (isset($_POST['users_id'], $_POST['login'], $_POST['email'], $_POST['password'], $_POST['role'])) {
    // Получение данных из формы
    $users_id = $_POST['users_id'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хеширование пароля
    $role = $_POST['role'];

    // Подготовка SQL-запроса
    $query = $db->prepare("UPDATE users SET login=?, email=?, password=?, role=? WHERE users_id=?");
    $query->bind_param('ssssi', $login, $email, $password, $role, $users_id);
    $query->execute();

    // Проверка успешности выполнения запроса
    if ($query->affected_rows > 0) {
        echo "Пользователь обновлен.";
    } else {
        echo "Ошибка при обновлении пользователя.";
    }
}
?>

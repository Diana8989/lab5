<?php
session_start();

$db = new mysqli("localhost", "root", "", "svadebniy_salon");

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $db->real_escape_string($_POST['login']);
    $email = $db->real_escape_string($_POST['email']);
    $password = $db->real_escape_string($_POST['password']);
    $confirm_password = $db->real_escape_string($_POST['confirm-password']);

    if ($password !== $confirm_password) {
        die("Пароли не совпадают!");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = $db->prepare("INSERT INTO users (login, email, password) VALUES (?, ?, ?)");
    $query->bind_param("sss", $login, $email, $hashed_password);

    if ($query->execute()) {
        echo "Регистрация успешна!";
    } else {
        echo "Ошибка: " . $query->error;
    }

    $query->close();
}

header('Location: http://localhost/Свадебный%20салон/account1.php');


$db->close();
?>


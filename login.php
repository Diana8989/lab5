<?php
session_start(); 

$db = new mysqli("localhost", "root", "", "svadebniy_salon");

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $db->real_escape_string($_POST['email']);
    $password = $db->real_escape_string($_POST['password']);

    $query = $db->prepare("SELECT users_id, password FROM users WHERE email = ?");
    $query->bind_param("s", $email);

    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['users_id'];
            $_SESSION['email'] = $email;
            echo "Авторизация успешна!";
        } else {
            echo "Неверный email или пароль.";
        }
    } else {
        echo "Неверный email или пароль.";
    }

    $query->close();
}

header('Location: http://localhost/Свадебный%20салон/account1.php');

$db->close();
?>

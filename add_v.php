<?php
// Подключение к базе данных
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');
if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

// Проверка отправленных данных
if (isset($_POST['submit'])) {
    // Получение данных из формы
    $name = $_POST['name'];
    $address = $_POST['address'];
    $capacity = $_POST['capacity'];
    $available_dates = $_POST['available_dates'];
    $price = $_POST['price'];
    $payment_status = $_POST['payment_status'];

    // Подготовка SQL-запроса
    $stmt = $db->prepare("INSERT INTO venues (name, address, capacity, available_dates, price, payment_status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssisds', $name, $address, $capacity, $available_dates, $price, $payment_status);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        echo "Запись успешно добавлена.";
    } else {
        echo "Ошибка: " . $stmt->error;
    }
    $stmt->close();
}
$db->close();
?>
<?php
// Подключение к базе данных
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');
if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

// Проверка отправленных данных
if (isset($_POST['update'])) {
    // Получение данных из формы
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $capacity = $_POST['capacity'];
    $available_dates = $_POST['available_dates'];
    $price = $_POST['price'];
    $payment_status = $_POST['payment_status'];

    // Подготовка SQL-запроса
    $stmt = $db->prepare("UPDATE venues SET name=?, address=?, capacity=?, available_dates=?, price=?, payment_status=? WHERE id=?");
    $stmt->bind_param('ssisdsi', $name, $address, $capacity, $available_dates, $price, $payment_status, $id);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        echo "Запись успешно обновлена.";
    } else {
        echo "Ошибка: " . $stmt->error;
    }
    $stmt->close();
}
$db->close();
?>
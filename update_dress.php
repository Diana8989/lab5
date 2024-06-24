<?php
// Подключение к базе данных
session_start();
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');

if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $id = $_POST['id'];
    $name = $_POST['name'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $manufacturer = $_POST['manufacturer'];
    $in_stock = isset($_POST['in_stock']) ? 1 : 0;

    // Подготовка SQL запроса
    $sql = "UPDATE wedding_dresses SET name = ?, size = ?, price = ?, manufacturer = ?, in_stock = ? WHERE id = ?";
    // Используйте объект $db для подготовки SQL запроса
    $stmt = $db->prepare($sql);

    // Проверка на успешность подготовки запроса
    if ($stmt === false) {
        die("Ошибка подготовки запроса: " . $db->error);
    }

    // Привязка параметров и выполнение запроса
    $stmt->bind_param("ssdsii", $name, $size, $price, $manufacturer, $in_stock, $id);
    if ($stmt->execute()) {
        echo "Данные платья обновлены.";
    } else {
        echo "Ошибка при обновлении данных платья: " . $stmt->error;
    }
    // Закрытие подготовленного запроса
    $stmt->close();
}
?>
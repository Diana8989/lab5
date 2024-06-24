<?php
// Подключение к базе данных
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');
if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

// Проверка отправленных данных
if (isset($_POST['delete'])) {
    // Получение данных из формы
    $id = $_POST['id'];

    // Подготовка SQL-запроса
    $stmt = $db->prepare("DELETE FROM venues WHERE id=?");
    $stmt->bind_param('i', $id);
    
    // Выполнение запроса
    if ($stmt->execute()) {
        echo "Запись успешно удалена.";
    } else {
        echo "Ошибка: " . $stmt->error;
    }
    $stmt->close();
}
$db->close();
?>
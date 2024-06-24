<?php
// Подключение к базе данных
$db = new mysqli('localhost', 'root', '', 'svadebniy_salon');
if ($db->connect_error) {
    die("Ошибка подключения: " . $db->connect_error);
}

// Функции для управления данными
function addRecord($name, $surname, $phone, $dress_type, $date) {
    global $db;
    $stmt = $db->prepare("INSERT INTO appointments (name, surname, phone, dress_type, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $surname, $phone, $dress_type, $date);
    $stmt->execute();
    $stmt->close();
}

function updateRecord($id, $name, $surname, $phone, $dress_type, $date) {
    global $db;
    $stmt = $db->prepare("UPDATE appointments SET name=?, surname=?, phone=?, dress_type=?, date=? WHERE id=?");
    $stmt->bind_param("sssssi", $name, $surname, $phone, $dress_type, $date, $id);
    $stmt->execute();
    $stmt->close();
}

function deleteRecord($id) {
    global $db;
    $stmt = $db->prepare("DELETE FROM appointments WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Обработка отправленных форм
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        addRecord($_POST['name'], $_POST['surname'], $_POST['phone'], $_POST['dress_type'], $_POST['date']);
    } elseif (isset($_POST['update'])) {
        updateRecord($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['phone'], $_POST['dress_type'], $_POST['date']);
    } elseif (isset($_POST['delete'])) {
        deleteRecord($_POST['id']);
    }
}
?>

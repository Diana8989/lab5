<?php
// Подключение к БД
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "svadebniy_salon";

header('Content-Type: application/json');

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, phone, dress_type, date FROM appointments";
$result = $conn->query($sql);

$appointments_data = array();

if ($result->num_rows > 0) {
  // Вывод данных каждой записи
  while($row = $result->fetch_assoc()) {
    $appointments_data[] = $row;
  }
}

echo json_encode($appointments_data);

$conn->close();
?>
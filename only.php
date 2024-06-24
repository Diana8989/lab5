<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "svadebniy_salon";

header('Content-Type: text/html; charset=UTF-8');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

$name = $_POST['name'];
$surname = $_POST['surname'];
$phone = $_POST['phone'];
$dress_type = $_POST['dress_type'];
$date = $_POST['date'];

$stmt = $conn->prepare("INSERT INTO appointments (name, surname, phone, dress_type, date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $surname, $phone, $dress_type, $date);

$stmt->execute();

header('Location: http://localhost/Свадебный%20салон/account.html');

$stmt->close();
$conn->close();
?>

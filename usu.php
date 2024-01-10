<?php
$conn = new mysqli("localhost","root","","userdb");

// Проверка подключения к базе данных
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$id = $_POST['id'];
$name = $_POST['name'];
$passport = $_POST['passport'];
$email = $_POST['email'];
$password = $_POST['password'];

// Обновление данных в таблице
$sql = "UPDATE users SET name='$name', passport='$passport', email='$email', password='$password' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: updated.php?id=$id"); // Перенаправление на страницу с обновленной информацией, передача id через параметр в URL
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>

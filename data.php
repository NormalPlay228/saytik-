<?php
session_start();
$conn = new mysqli("localhost","root","","userdb");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, name, passport FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$stmt->bind_result($id, $name, $passport);

if ($stmt->fetch()) {
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['passport'] = $passport;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
} else {
    header("Location: registration_and_login.html");
    exit();
}

$stmt->close();
$conn->close();
?>
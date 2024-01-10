<?php
session_start();
$conn = new mysqli("localhost","root","","userdb");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение данных из формы авторизации
$email = $_POST['email'];
$password = $_POST['password'];

// Поиск пользователя в базе данных
$stmt = $conn->prepare("SELECT id, name, passport FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$stmt->bind_result($id, $name, $passport);

if ($stmt->fetch()) {
    // Пользователь найден - установка сессионных переменных
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['passport'] = $passport;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
} else {
    // Пользователь не найден - перенаправление на страницу авторизации
    header("Location: registration_and_login.html");
    exit();
}

// Закрытие соединения с базой данных
$stmt->close();
$conn->close();
?>
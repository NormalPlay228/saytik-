<?php

$conn = new mysqli("localhost","root","","userdb");

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $passport =$_POST['passport'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name, passport, email, password) VALUES ('$name','passport', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Регистрация прошла успешно!";
    } else {
        echo "Ошибка при регистрации: " . $conn->error;
    }
}

$conn->close();
?>

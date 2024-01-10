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

    // Проверяем, существует ли уже запись с указанным email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Учетная запись с указанным email уже существует.";
    } else {
        // Выполняем вставку новой записи
        $sql = "INSERT INTO users (name, passport, email, password) VALUES ('$name','$passport', '$email', '$password')";
        if ($conn->query($sql) === true) {
            echo "Учетная запись успешно создана!";
              header("Location: usercab2.php");
        } else {
            echo "Ошибка при создании учетной записи: " . $conn->error;

        }
    }
}

// Закрытие соединения с базой данных
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Обновленная информация</title>
</head>
<body>
    <h2>Обновленная информация</h2>

    <?php
    $conn = new mysqli("localhost","root","","userdb");

    // Проверка подключения к базе данных
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Получение обновленных данных из БД через параметр в URL
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id='$id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row['id'] . "<br>";
            echo "Имя: " . $row['name'] . "<br>";
            echo "Паспорт: " . $row['passport'] . "<br>";
            echo "Email: " . $row['email'] . "<br>";
        }
    } else {
        echo "Нет данных.";
    }

    $conn->close();
    ?>
</body>
</html>


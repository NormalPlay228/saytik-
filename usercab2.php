<?php
$conn = new mysqli("localhost","root","","userdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_FILES['photo'])) {
    $file = $_FILES['photo'];

    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $maxSize = 5 * 1024 * 1024;

    $filename = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxSize && $fileError === 0) {
        $newFilename = uniqid('', true) . "." . $fileExtension;

        // Сохраняем файл в папке на сервере
        move_uploaded_file($fileTmpName, "uploads/" . $newFilename);

        $sql = "UPDATE users SET photo='$newFilename'";
        $conn->query($sql);

        echo "Фото успешно загружено и сохранено в базе данных.";

        $filename = $newFilename;
    } else {
        echo "Ошибка при загрузке фото.";
    }
}
$sql = "SELECT photo FROM users LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $filename = $row['photo'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Личный кабинет</title>
  <link rel="stylesheet" href="stile.css">
</head>
<body>
   <div class="container">
    <div class="link">
  <ul>
    <li><a href="registration_and_login.html">Войти</a></li>
    <li><a href="registration_and_login.html">Зарегистрироваться</a></li>
    <li><a href="aboutsite/index.html">Главная</a></li>
  </ul>
  </div>

<div class="wrapper">
    <div class="left">
       <form id="upload_form" enctype="multipart/form-data">
  <input type="file" name="photo">
  <input type="submit" onclick="uploadPhoto()" value="Загрузить">
</form>
  <script src="script.js"></script>
<img src="uploads/<?php echo $filename; ?>" alt="Фото">
        <?php include('data.php'); ?>
        <div class="h4">
       <p><?php echo $_SESSION['name']; ?></p>
       </div>
    </div>
    <div class="right">
        <div class="info">

            <h3>Информация</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Email</h4>
                  <p><?php echo $_SESSION['email']; ?></p>
                 </div>
                 <div class="data">
                   <h4>Пароль</h4>
                    <p> <?php echo $_SESSION['password']; ?></p>
              </div>
            </div>
        </div>

      <div class="projects">
            <h3>Доп.Данные</h3>
            <div class="projects_data">
                 <div class="data">
                    <h4>Паспорт</h4>
                    <p><?php echo $_SESSION['passport']; ?></p>
                 </div>
                 <div class="data">
                   <h4>Имя</h4>
                    <p><?php echo $_SESSION['name']; ?></p>
                    <h4>Ваш ID</h4>
                     <p><?php echo $_SESSION['id']; ?></p>
                     <form action="indexx.html">
        <input type="submit" value="Изменить данные">

              </div>
            </div>
        </div>
    </div>
</div>
</div>
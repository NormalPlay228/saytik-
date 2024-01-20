<?php
$conn = new mysqli("localhost","root","","userdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$name = $_POST['name'];
$passport = $_POST['passport'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "UPDATE users SET name='$name', passport='$passport', email='$email', password='$password' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: updated.php?id=$id");
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>

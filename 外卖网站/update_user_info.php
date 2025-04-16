<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: user_login.html");
    exit();
}

$username = $_SESSION["username"];

$servername = "localhost";
$dbusername = "root";
$password = "";
$dbname = "users";

$conn = new mysqli($servername, $dbusername, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$conn->set_charset('utf8');

$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$newPassword = $_POST['password'];
$photo = $_FILES['photo'];

$photoPath = "";
if ($photo && $photo['tmp_name']) {
    $photoPath = 'uploads/' . basename($photo['name']);
    move_uploaded_file($photo['tmp_name'], $photoPath);
}

$sql = "UPDATE users SET phone = '$phone', email = '$email', address = '$address', password = '$newPassword'";
if ($photoPath) {
    $sql .= ", photo = '$photoPath'";
}
$sql .= " WHERE username = '$username'";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("信息更新成功！"); window.location.href="personal_center.html";</script>';
} else {
    echo "错误: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

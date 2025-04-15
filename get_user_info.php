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

$sql = "SELECT username, phone, email, address, password, photo FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode([]);
}

$conn->close();
?>

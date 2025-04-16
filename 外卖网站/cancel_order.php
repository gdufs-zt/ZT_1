<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: user_login.html");
    exit();
}

if (!isset($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "订单ID缺失"]);
    exit();
}

$orderId = $_GET['id'];

$servername = "localhost";
$dbusername = "root";
$password = "";
$dbname = "my_db";

$conn = new mysqli($servername, $dbusername, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$conn->set_charset('utf8');

$sql = "UPDATE 订单 SET 用户状态 = '用户取消该订单' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $orderId);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "更新失败"]);
}

$stmt->close();
$conn->close();
?>

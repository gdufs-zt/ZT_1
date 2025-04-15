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
$dbname = "my_db";

$conn = new mysqli($servername, $dbusername, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$conn->set_charset('utf8');

$sql = "SELECT * FROM 订单 WHERE 顾客名 = '$username'";
$result = $conn->query($sql);

$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // 切换到外卖员数据库并查询外卖员的手机号
        $conn->select_db('wm_db');
        $deliveryman = $row['外卖员'];
        $sql2 = "SELECT phone FROM 外卖员 WHERE user = '$deliveryman'";
        $result2 = $conn->query($sql2);
        if ($result2 && $result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            $row['外卖员手机号'] = $row2['phone'];
        }
        // 切换回订单数据库
        $conn->select_db($dbname);
        $orders[] = $row;
    }
}

echo json_encode($orders);

$conn->close();
?>

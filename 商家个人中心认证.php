<?php
session_start();

$servername = "localhost";
$dbusername = "root";
$password = "";
$dbname = "my_db";

$conn = new mysqli($servername, $dbusername, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$conn->set_charset('utf8');

$phone = $_POST['手机号码'];
$newPassword = $_POST['密码'];
$address = $_POST['商家地址'];
$name = $_POST['用户名'];
$商家名 = $_POST['商家名'];


$sql = "UPDATE 商家 SET 手机号码 = '$phone', 密码 = '$newPassword', 商家地址 = '$address', 商家名 = '$商家名' WHERE 用户名 = '$name'";

mysqli_query($conn, $sql);

$conn->close();

echo '<script>alert("信息更新成功！"); window.location.href="商家个人中心.php";</script>';
?>

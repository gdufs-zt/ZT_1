<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ad_db";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("连接失败: " . $conn->connect_error);
}
$conn->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$管理员名 = $_POST['管理员名'];
	$密码 = $_POST['密码'];
	$确认密码 = $_POST['确认密码'];
	$手机号 = $_POST['手机号'];
	$邮箱 = $_POST['邮箱'];

	if ($密码 != $确认密码) {
		echo '<script>alert("密码不一致，请重新输入！"); history.back();</script>';
	} else {
		$sql = "INSERT INTO 管理员 (管理员名, 密码, 手机号, 邮箱) VALUES ('$管理员名', '$密码', '$手机号', '$邮箱')";
		if (mysqli_query($conn, $sql)) {
			mysqli_close($conn);
			header("Location:管理员登录.html");
		} else {
			echo "注册失败: " . mysqli_error($conn);
		}
	}
}
?>

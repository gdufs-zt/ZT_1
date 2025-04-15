<!doctype html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_db";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("连接失败: " . $conn->connect_error);
} else {
	//echo "连接数据库成功";
}
$conn->set_charset('utf8');
?>

<html>

<head>
	<meta charset="utf-8">
	<title> 登录界面 </title>
</head>

<body>
	<?php
	print_r($_POST);
	$sql = "SELECT * FROM 商家 where 用户名='{$_POST['用户名']}'";
	$result = mysqli_query($conn, $sql);
	while ($row = $result->fetch_array()) {
		$密码 = $row['密码'];
	}
	$num_rows = mysqli_num_rows($result);
	if ($num_rows == 0) {
		echo '<script>alert("查无此人，请检查用户名！"); history.back();</script>';
	} else {
		if ($密码 == $_POST['密码']) {
			header("Location: 菜单table.php");
		} else {
			echo '<script>alert("密码错误，请重新输入！"); history.back();</script>';
		}
	}

	session_start(); // 启动session
	$_SESSION['商家名'] = $_POST['用户名']; // 将用户信息存储到session中

	mysqli_close($conn);
	?>
</body>

</html>
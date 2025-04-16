<!doctype html>
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
?>

<html>

<head>
	<meta charset="utf-8">
	<title>管理员登录界面</title>
</head>

<body>
	<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$管理员名 = $_POST['管理员名'];
		$密码 = $_POST['密码'];
		
		$sql = "SELECT * FROM 管理员 WHERE 管理员名='$管理员名'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		
		if ($row) {
			if ($row['密码'] == $密码) {
				header("Location: 管理员管理界面.php");
			} else {
				echo '<script>alert("密码错误，请重新输入！"); history.back();</script>';
			}
		} else {
			echo '<script>alert("查无此人，请检查用户名！"); history.back();</script>';
		}
		mysqli_close($conn);
	}
	?>
</body>

</html>

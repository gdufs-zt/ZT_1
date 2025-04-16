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

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>商家注册</title>
</head>

<body>
	<pre>
		<?php
		print_r($_POST);
		$sql = "INSERT INTO 商家 (用户名, 密码, 身份证号码, 商家地址, 手机号码) VALUES ('{$_POST['用户名']}', '{$_POST['密码']}', '{$_POST['身份证号码']}', '{$_POST['商家地址']}', '{$_POST['手机号码']}')";
		//echo $sql;
		if ($_POST['密码'] != $_POST['确认密码']) {
			echo '<script>alert("密码不一致，请重新输入！"); history.back();</script>';
		} else {
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			header("Location:商家登录.html");
		}
		?>
		<a href="注册界面table.php">查看数据表</a>
	</pre>
</body>

</html>
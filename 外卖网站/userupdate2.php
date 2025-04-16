<!doctype html>
<?php
require_once 'conn.php';
?>

<html>

<head>
	<meta charset="utf-8">
	<title>select </title>
</head>

<body>
	<pre>
		<?php
		print_r($_GET);
		print_r($_POST);

		if (isset($_POST['username'])) {
			$sql = "UPDATE Users SET username = '{$_POST['username']}',phone = '{$_POST['phone']}',email = '{$_POST['email']}',password = '{$_POST['password']}' WHERE userID = '{$_POST['userID']}';";
			echo $sql,"\n";
			mysqli_query($conn, $sql);
		}

$sql = "SELECT * FROM Users where userid={$_GET['id']} ;";
echo $sql;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
mysqli_close($conn);
?>
	</pre>
		<hr/>
		<form method="post" action="">
				<p> userID:
				<input name="userID" type="text" value="<?php echo $row['userID']; ?>" readonly>
				</p>
				<p> username:
					<input name="username" type="text" value="<?php echo $row['username']; ?>">
				</p>
				<p> phone:
					<input type="text" name="phone" value="<?php echo $row['phone']; ?>">
				</p>
				<p> email:
					<input type="text" name="email" value="<?php echo $row['email']; ?>">
				</p>
				<p> password:
					<input type="text" name="password" value="<?php echo $row['password']; ?>">
				</p>
				<p>
					<input type="submit" name="submit" id="submit" value="更新">
				</p>
		</form>
		<a href="user_table.php">返回--查看数据表</a>


</body>

</html>
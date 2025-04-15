<?php
require_once( "conn.php" );
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>DELETE Users </title>
</head>

<body>
	<pre>
		<?php
		if (empty($_POST['userID']) || empty($_POST['username']) || empty($_POST['phone']) || empty($_POST['email']) || empty($_POST['password'])) {
            echo "请填写完整的注销信息";
        } else {
            $sql = "SELECT * FROM Users WHERE userID='{$_POST['userID']}' AND username='{$_POST['username']}' AND phone='{$_POST['phone']}' AND email='{$_POST['email']}' AND address='{$_POST['address']}' AND password='{$_POST['password']}'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $delete_sql = "DELETE FROM Users WHERE userID='{$_POST['userID']}' AND username='{$_POST['username']}' AND phone='{$_POST['phone']}' AND email='{$_POST['email']}' AND address='{$_POST['address']}' AND password='{$_POST['password']}'";
                if (mysqli_query($conn, $delete_sql)) {
                    echo "账号注销成功";
                } else {
                    echo "账号注销失败";
                }
            } else {
                echo "账号不存在，请检查输入的信息是否正确";
            }
        }
		mysqli_close( $conn );
		?>
	</pre>
</body>

</html>
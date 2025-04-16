<!doctype html>
<?php
session_start();
require_once 'wm_conn.php';
?>
<html>

<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="groupuse_1.css">
	<title>登陆  </title>
</head>

<body>
	<pre>
		<?php
        //print_r($_POST);
$sql = "SELECT * FROM 外卖员  where user='{$_POST['user']}' and pwd='{$_POST['pwd']}' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$count = mysqli_num_rows($result);
if ($count == 0) {
    echo '用户或密码错误';
    ?>
    <a href="外卖员登录.html">返回登录</a>
    <?php
} else {
    $user = $row['user'];
$id = $row['id'];
        $_SESSION['user'] = $user;
        $_SESSION['id'] = $id;
        header("location:外卖员当前订单.php");
        
}
mysqli_close($conn);
?>
	</pre>
</body>

</html>
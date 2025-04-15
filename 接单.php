<!doctype html>

<?php
require_once 'conn1.php';
session_start();
?>

<html>
<head>
	<meta charset="utf-8">
	<title>select </title>
</head>
<body>

 
	<?php
	//把订单所有菜状态更新
	$sql_1 = "update 订单 set 外卖员状态 = '已接单' where 编号 = '{$_GET['编号']}'";
	$sql_2 = "update 订单 set 外卖员 = '{$_SESSION['user']}' where 编号 = '{$_GET['编号']}'";
	mysqli_query($conn,$sql_1);
	mysqli_query($conn, $sql_2);

	?>
	<?php
	mysqli_close($conn);
	?>
	

<!--连接外卖db-->



   <?php
	

	header("location:外卖员当前订单.php");
	
	
	?>
	
</body>

</html>
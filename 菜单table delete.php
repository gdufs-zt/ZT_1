<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>菜单删除</title>
</head>
<body>
   <?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "my_db";
   
   $conn = new mysqli($servername,$username,$password,$dbname);
   if($conn->connect_error){
	   die("连接失败：".$conn->connect_error);
   }
   else{
	   //echo "连接成功";
   }
   $conn->set_charset('utf8');
   ?>
	<?php
	$sql = "delete from 菜单主菜 where 菜名 = '{$_GET['菜名2']}'";
	$result = mysqli_query($conn, $sql);
	mysqli_close($conn);
	?>
   <?php
   
    /*当对数据进行删除后进行页面重定向*/
    header("Location:菜单table.php");

?>
</body>
</html>
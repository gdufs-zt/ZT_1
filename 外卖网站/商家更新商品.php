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
} 
else{
	//echo "连接数据库成功";
}
$conn->set_charset('utf8');
?>

<html>

<head>
	<meta charset="utf-8">
	<LINK REL="stylesheet" TYPE="text/css" HREF="example.css">
	<title> 商家更新商品 </title>
</head>

<body>
	<pre>
		<?php
		$dest_filename = '';
		include("商家菜品图片.php");
		$photo = $dest_filename;
		
		$sql = "INSERT INTO 菜单主菜 (菜名, 价格, 商品图片, 商品描述, 商家名) VALUES ('{$_POST['菜名']}', '{$_POST['价格']}', '{$photo}', '{$_POST['商品描述']}', '{$_POST['商家名']}')";

		echo $sql;
		mysqli_query( $conn, $sql );

		mysqli_close( $conn );
		?>
    </pre>
	<?php
   //如果处理了提交的表单数据，则进行页面重定向
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      header("Location:菜单table.php");
}
?>
</body>

</html>
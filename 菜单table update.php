<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>菜单更新</title>
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

<form method="post" action="">
      <p> 菜名:
          <input name="菜名" type="text"  >
      </p>
      <p> 价格:
          <input name="价格" type="text"  >
      </p> 
      <p> 商品描述：
          <input name = "商品描述" type="text">
      </p>
      <p> 商品图片：
          <input name="file" type="file" id="file">
      </p>
        <input type="submit" name="submit" value="修改">
      </p>
   </form>

	<?php
   
   $dest_filename = '';
   include("商家菜品图片.php");
   $photo = $dest_filename;

   if (isset($_POST['菜名'])) {   /*没有这个if语句会报错，变量未定义*/
	$sql = "UPDATE 菜单主菜 SET 菜名 = '{$_POST['菜名']}',价格 = '{$_POST['价格']}',商品图片 ='{$photo}', 商品描述 = '{$_POST['商品描述']}' WHERE 菜名 = '{$_GET['菜名1']}';";
	$result = mysqli_query($conn, $sql);
   }
	mysqli_close($conn);
	?>

   
   <?php
   //如果处理了提交的表单数据，则进行页面重定向
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      header("Location:菜单table.php");
}
?>
</body>
</html>
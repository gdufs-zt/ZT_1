<?php
require_once 'wm_conn.php';
?>
<link rel="stylesheet" type="text/css" href="groupuse.css">
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>INSERT INTO Persons </title>
</head>

<body>



<?php
$sql = "select user from 外卖员 where user='{$_POST['user']}' ";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
		
if($count == 0)
{?>
<?php


   // include("外卖员图片.php");  //处理上传的图片
	//$photo = $dest_filename;

    //print_r($_POST);
    $sql = "INSERT INTO 外卖员 (user,pwd,CN_name,phone)  VALUES ('{$_POST['user']}', '{$_POST['pwd']}', '{$_POST['Name']}','{$_POST['phone']}')";

mysqli_query($conn, $sql);
mysqli_close($conn);
echo "注册成功";

?>
    
    <a href="外卖员登录.html">点此返回登录</a>
    <?php
}
else{
    echo "该用户名已被注册，请重新注册";
    ?>
    <a href="外卖员注册.html">点此返回注册</a>
      <?php  

}




?>
    


</body>

</html>
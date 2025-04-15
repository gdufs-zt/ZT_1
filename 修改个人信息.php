<?php
session_start();
    require_once( "conn.php" );
?>
<html>

<head>
	<meta charset="utf-8">
	<title>select </title>
	<link rel="stylesheet" type="text/css" href="groupuse.css">
</head>


<body>
	<?php	
    
    $sql = "UPDATE 外卖员 SET user = '{$_POST['user']}',pwd = '{$_POST['pwd']}',CN_name= '{$_POST['Name']}',phone= '{$_POST['phone']}' WHERE id = '{$_SESSION['id']}';";
	$_SESSION['user'] = $_POST['user'];
    //echo $sql;
	mysqli_query($conn, $sql);

	//header("location:个人中心.php");
?>
	<?php

?>

</body>

</html>

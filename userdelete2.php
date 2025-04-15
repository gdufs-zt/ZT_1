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

$sql = "delete from Users WHERE userID = '{$_GET['id']}';";
mysqli_query($conn, $sql);

mysqli_close($conn);
?>
	<a href="user_table.php">返回--查看数据表</a>
</pre>
</body>

</html>
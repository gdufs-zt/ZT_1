<?php
session_start();
session_destroy();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
用户退出
<?php 
header("location:外卖员登录.html");
?>
</body>
</html>
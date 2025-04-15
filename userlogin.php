<!doctype html>
<?php 
require_once("conn.php");
session_start(); // 启动session
?>
<html>

<head>
    <meta charset="utf-8">
    <title>用户登录</title>
    <link rel="stylesheet" href="商家界面style.css" type="text/css" />
    <script>
        function redirectToPage(selectElement) {
            var selectedValue = selectElement.value;
            if (selectedValue) {
                window.location.href = selectedValue;
            }
        }

        function showUserAgreement() {
            alert("用户协议: \n\n欢迎使用我们的外卖网站服务！在您使用我们的服务之前，请仔细阅读以下条款。1. 服务描述我们的外卖网站旨在为顾客提供方便快捷的外卖订购服务。2. 免责声明在法律允许的范围内，我们将尽最大努力确保我们的服务的安全性和可靠性。");
        }
    </script>
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>用户登录</h1>
        </div>
        <br class="clearfloat" />
        <div id="menu">
            <a href="外卖系统首页.html">主页</a>
            <a href="#">活动</a>
            <a href="联系我们.html">联系我们</a>
        </div>
        <br class="clearfloat" />
        <div id="mainContent">
            <a href="user_register.html" id="注册界面">没有账号？去注册</a>
            <form method="post" action="">
                用户名:
                <input name="username" type="text">
                密码:
                <input name="password" type="password">
                角色：
                <select id="pageSelect" name="pages" onchange="redirectToPage(this)">
                    <option value="商家登录.php">商家</option>
                    <option value="user_login.html">用户</option>
                    <option value="http://www.example.com/page3">外卖员</option>
                </select>
                <a href="#" onclick="showUserAgreement()">用户协议</a>
                <input type="submit" name="submit" id="submit" value="登陆">
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);

                // 检查用户名是否存在
                $sql = "SELECT * FROM Users WHERE username='$username'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) == 0) {
                    echo '<script>alert("无此用户"); history.back();</script>';
                } else {
                    $row = mysqli_fetch_assoc($result);
                    // 检查密码是否正确
                    if ($row['password'] == $password) {
                        $_SESSION['username'] = $row['username']; // 将用户信息存储到session中
                        header("Location:外卖系统首页.html");
                        exit(); // 确保重定向后的代码不会继续执行
                    } else {
                        echo '<script>alert("密码错误"); history.back();</script>';
                    }
                }
                mysqli_close($conn);
            }
            ?>
        </div>
    </div>
</body>

</html>

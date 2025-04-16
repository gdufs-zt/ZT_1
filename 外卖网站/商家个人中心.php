<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>个人中心</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #container {
            width: 80%;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .logout-btn {
            background-color: #ff6347;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            float: right;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #e55337;
        }

        .form-container {
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="tel"],
        .form-container input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container input[type="file"] {
            margin-bottom: 10px;
        }

        .form-container button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    // 检查商家是否登录
    if (!isset($_SESSION['商家名'])) {
        // 如果未登录，重定向到登录页面
        header("Location: 商家登录.html");
        exit();
    }
    ?>

    <div id="container">
        <h1>个人中心</h1>
        <a href="商家登出.php" class="logout-btn">登出</a>

        <h2>用户信息</h2>
        <div class="form-container">
            <form id="user-info-form" action="商家个人中心认证.php" method="post" enctype="multipart/form-data">
                <label for="用户名">用户名:</label>
                <input type="text" id="用户名" name="用户名">

                <label for="手机号码">手机号码:</label>
                <input type="text" id="手机号码" name="手机号码">


                <label for="地址">商家地址:</label>
                <input type="text" id="商家地址" name="商家地址">

                <label for="商家名">商家名:</label>
                <input type="text" id="商家名" name="商家名">

                <label for="密码">密码:</label>
                <input type="password" id="密码" name="密码">

                <button type="submit">更新信息</button>
            </form>
        </div>
    </div>
</body>

</html>

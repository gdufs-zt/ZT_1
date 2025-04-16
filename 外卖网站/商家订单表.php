<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <title>商家订单列表</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        #container {
            width: 80%;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        #header {
            background-color: #1E90FF;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        #menu {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
        }

        #menu a {
            display: inline-block;
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px 15px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn-update {
            padding: 5px 12px;
            background-color: #1E90FF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn-update:hover {
            background-color: #218838;
        }

        .btn-update:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>鳄了吗</h1>
        </div>
        <br class="clearfloat" />
        <div id="menu">
            <a href="外卖系统首页.html">主页</a>
            <a href="#">活动</a>
            <a href="商家-联系我们.html">联系我们</a>
        </div>
        <br class="clearfloat" />
        <div id="mainContent">

            <?php
            // 开启会话
            session_start();

            // 检查商家是否登录
            if (!isset($_SESSION['商家名'])) {
                // 如果未登录，重定向到登录页面
                header("Location: 商家登录.html");
                exit();
            }

            // 数据库连接参数
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "my_db";

            // 创建数据库连接
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 检查连接
            if ($conn->connect_error) {
                die("连接失败: " . $conn->connect_error);
            }
            $conn->set_charset('utf8');

            // 更新订单状态
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['操作一'])) {
                $orderId = $_POST['操作一'];
                $sqlUpdate = "UPDATE 订单 SET 商家状态 = '已接单' WHERE id = $orderId";
                $conn->query($sqlUpdate);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['操作二'])) {
                $orderId = $_POST['操作二'];
                $sqlUpdate = "UPDATE 订单 SET 商家状态 = '已出餐' WHERE id = $orderId";
                $conn->query($sqlUpdate);
            }

            // 查询订单数据
            $sql = "SELECT * FROM 订单";
            $result = $conn->query($sql);

            // 检查是否有数据
            if ($result->num_rows > 0) {
                // 输出 HTML 表格
                echo "<table>";
                echo "<tr><th>顾客名</th><th>手机号</th><th>餐品</th><th>数量</th><th>价格</th><th>time</th><th>外卖员状态</th><th>商家状态</th><th>用户状态</th><th>编号</th><th>操作1</th><th>操作二</th></tr>";

                // 遍历结果集
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['顾客名'] . "</td>";
                    echo "<td>" . $row['手机号'] . "</td>";
                    echo "<td>" . $row['餐品'] . "</td>";
                    echo "<td>" . $row['数量'] . "</td>";
                    echo "<td>" . $row['价格'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "<td>" . $row['外卖员状态'] . "</td>";
                    echo "<td>" . $row['商家状态'] . "</td>";
                    echo "<td>" . $row['用户状态'] . "</td>";
                    echo "<td>" . $row['编号'] . "</td>";
                    echo "<td>";
                    echo "<form method='post' style='display:inline;'>
                          <input type='hidden' name='操作一' value='" . $row['id'] . "'>
                          <input type='submit' class='btn-update' value='接单'>
                   </form>";
                    echo "</td>";
                    echo "<td>";
                    echo "<form method='post' style='display:inline;'>
                   <input type='hidden' name='操作二' value='" . $row['id'] . "'>
                   <input type='submit' class='btn-update' value='出餐'>
            </form>";
                }
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>

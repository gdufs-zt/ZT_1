<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理员管理界面</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            background: linear-gradient(to right, #ece9e6, #ffffff);
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 20px 0;
            box-shadow: 2px 0 5px 0 rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
        }
        .sidebar a {
            display: block;
            width: 80%;
            padding: 15px 20px;
            color: #fff;
            text-decoration: none;
            margin: 10px 0;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 40px;
            overflow-y: auto;
            background: #fff;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 15px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        a.action {
            color: #007bff;
            text-decoration: none;
            margin: 0 5px;
            transition: color 0.3s;
        }
        a.action:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="管理员管理界面.php?view=users">管理用户</a>
        <a href="管理员管理界面.php?view=商家">管理商家</a>
        <a href="管理员管理界面.php?view=外卖员">管理外卖员</a>
    </div>
    <div class="content">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "users";
            $sql = "SELECT * FROM users";
            $keyField = "username"; // 默认用户的关键字段
            $view = "users"; // 默认视图
            // 根据查询参数选择要查看的信息类型
            if (isset($_GET['view'])) {
                $view = $_GET['view'];
                if ($view == '商家') {
                    $dbname = "my_db";
                    $sql = "SELECT * FROM 商家";
                    $keyField = "用户名"; // 商家的关键字段
                } elseif ($view == '外卖员') {
                    $dbname = "wm_db";
                    $sql = "SELECT * FROM 外卖员";
                    $keyField = "user"; // 外卖员的关键字段
                }
            }
            // 创建连接
            $conn = new mysqli($servername, $username, $password, $dbname);
            // 检查连接
            if ($conn->connect_error) {
                die("连接失败: " . $conn->connect_error);
            }
            $conn->set_charset('utf8');
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("查询失败: " . mysqli_error($conn));
            }
            echo "<table>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>$value</td>";
                }
                echo "<td><a href='修改.php?key={$row[$keyField]}&view=$view'>修改</a></td>";
                echo "<td><a href='删除.php?key={$row[$keyField]}&view=$view'>删除</a></td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>

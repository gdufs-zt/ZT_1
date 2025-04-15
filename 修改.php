<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $key = $_GET['key'];

    $dbname = "users";
    $sql = "SELECT * FROM users WHERE username='$key'";
    $fields = array('username', 'phone', 'email', 'address', 'password');
    
    if (isset($_GET['view'])) {
        if ($_GET['view'] == '商家') {
            $dbname = "my_db";
            $sql = "SELECT * FROM 商家 WHERE 用户名='$key'";
            $fields = array('用户名', '密码', '身份证号码', '商家地址', '手机号码', '商家名');
        } elseif ($_GET['view'] == '外卖员') {
            $dbname = "wm_db";
            $sql = "SELECT * FROM 外卖员 WHERE user='$key'";
            $fields = array('user', 'pwd', 'CN_name', 'phone');
        }
    }

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $conn->set_charset('utf8');
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("查询失败: " . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        die("没有找到匹配的记录。");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>修改记录</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ece9e6, #ffffff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        label {
            font-weight: bold;
        }
        input[type='text'] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type='submit'] {
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background 0.3s;
        }
        input[type='submit']:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <form action="处理修改.php" method="post">
        <?php
            foreach ($fields as $field) {
                $value = $row[$field];
                echo "<label for='$field'>$field</label><br>";
                echo "<input type='text' id='$field' name='$field' value='$value'><br><br>";
            }
            echo "<input type='hidden' name='key' value='$key'>";
            if (isset($_GET['view'])) {
                echo "<input type='hidden' name='view' value='{$_GET['view']}'>";
            }
        ?>
        <input type="submit" value="提交">
    </form>
</body>
</html>
<?php
    mysqli_close($conn);
?>

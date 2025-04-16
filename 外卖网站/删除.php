<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $key = $_GET['key'];

    $dbname = "users";
    $sql = "DELETE FROM users WHERE username='$key'";
    
    if (isset($_GET['view'])) {
        if ($_GET['view'] == '商家') {
            $dbname = "my_db";
            $sql = "DELETE FROM 商家 WHERE 用户名='$key'";
        } elseif ($_GET['view'] == '外卖员') {
            $dbname = "wm_db";
            $sql = "DELETE FROM 外卖员 WHERE user='$key'";
        }
    }

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $conn->set_charset('utf8');
    
    if (mysqli_query($conn, $sql)) {
        echo "记录已成功删除";
        header("Location:管理员管理界面.php");
    } else {
        echo "删除记录时出错: " . mysqli_error($conn);
    }
    mysqli_close($conn);
?>

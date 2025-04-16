<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $key = $_POST['key'];

    $dbname = "users";
    $sql = "UPDATE users SET username='$_POST[username]', phone='$_POST[phone]', email='$_POST[email]', address='$_POST[address]', password='$_POST[password]' WHERE username='$key'";
    
    if (isset($_POST['view'])) {
        if ($_POST['view'] == '商家') {
            $dbname = "my_db";
            $sql = "UPDATE 商家 SET 用户名='$_POST[用户名]', 密码='$_POST[密码]', 身份证号码='$_POST[身份证号码]', 商家地址='$_POST[商家地址]', 手机号码='$_POST[手机号码]', 商家名='$_POST[商家名]' WHERE 用户名='$key'";
        } elseif ($_POST['view'] == '外卖员') {
            $dbname = "wm_db";
            $sql = "UPDATE 外卖员 SET user='$_POST[user]', pwd='$_POST[pwd]', CN_name='$_POST[CN_name]', phone='$_POST[phone]' WHERE user='$key'";
        }
    }

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }
    $conn->set_charset('utf8');
    if (mysqli_query($conn, $sql)) {
        header("Location:管理员管理界面.php");
    } else {
        echo "更新记录时出错: " . mysqli_error($conn);
    }
    mysqli_close($conn);
?>

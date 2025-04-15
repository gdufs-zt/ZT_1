<?php
require_once("conn.php");

// 检查用户名是否已经存在
$username = $_POST['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // 如果用户名已经存在，显示错误信息
    echo "用户名重复，请重新填写";
} else {
    // 如果用户名不存在，执行插入操作
    $dest_filename = '';
    include("userupload_file.php");
    $photo = $dest_filename;

    $sql = "INSERT INTO users (username, phone, email, address, password, photo) VALUES ('{$_POST['username']}', '{$_POST['phone']}', '{$_POST['email']}', '{$_POST['address']}', '{$_POST['password']}', '{$photo}')";
    mysqli_query($conn, $sql);
    header("Location:user_login.html");
}

mysqli_close($conn);
?>

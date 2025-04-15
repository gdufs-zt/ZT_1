<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {   //如果点击提交按钮
    session_start(); // 启动会话

    // 检查购物车是否为空
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "购物车为空。";
        exit();
    }

    // 检查会话中是否存在用户名
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
    }

    $cart = $_SESSION['cart'];
    $servername2 = "localhost";
    $username2 = "root";
    $password2 = "";
    $dbname2 = "users";

    // 创建连接
    $conn2 = new mysqli($servername2, $username2, $password2, $dbname2);
    if ($conn2->connect_error) {
        die("连接失败: " . $conn2->connect_error);
    }
    $conn2->set_charset('utf8');

    $sql2 = "SELECT phone, address FROM users WHERE username = '$username'";
    $result2 = mysqli_query($conn2, $sql2);
    while ($row = $result2->fetch_array()) {
        $phone = $row['phone'];
        $address = $row['address'];
    }

    $conn2->close();

    // 连接数据库
    $servername1 = "localhost";
    $username1 = "root";
    $password1 = "";
    $dbname1 = "my_db";

    $conn1 = new mysqli($servername1, $username1, $password1, $dbname1);

    // 检查连接是否成功
    if ($conn1->connect_error) {
        die("连接失败: " . $conn1->connect_error);
    }
    $conn1->set_charset('utf8');

    if (empty($username)) {
        echo '<script>alert("请先登录再下单！"); history.back();</script>';   //如果用户名为空，说明用户未登录
    } else {
        $order_id = uniqid(); // 生成唯一订单编号
        foreach ($cart as $item) {
            $item_name = $item['name'];
            $quantity = $item['quantity'];
            $price = $item['price']*$quantity;
            $seller_name = $item['seller'];

            $sql_seller_address = "SELECT 商家地址 FROM 商家 WHERE 商家名 = '$seller_name'";
            $result_seller_address = mysqli_query($conn1, $sql_seller_address);
            $row_seller_address = $result_seller_address->fetch_array();
            $seller_address = $row_seller_address['商家地址'];
            
            if ($quantity != 0) {
                $sql1 = "INSERT INTO 订单 (顾客名, 手机号, 商家地址, 用户地址,  餐品, 数量, 价格, 外卖员状态, 商家状态, 用户状态, 编号) VALUES ('$username', '$phone', '$seller_address' , '$address',  '$item_name', '$quantity', '$price', '未接单', '未接单', '已下单', '$order_id')";
                mysqli_query($conn1, $sql1);
              }
            }
        $_SESSION['cart'] = []; // 清空购物车
        echo '<script>alert("订单生成成功！"); history.back();</script>';
    }

    $conn1->close();
}
?>

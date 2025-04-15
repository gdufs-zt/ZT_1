<?php
session_start();

// 检查购物车是否为空
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "购物车为空。";
    exit();
}

// 处理订单生成逻辑
require_once("商家conn.php");

$cart = $_SESSION['cart'];
$用户id = $_SESSION['userID'];
$订单总价 = 0;

// 计算订单总价
foreach ($cart as $item) {
    $订单总价 += $item['price'] * $item['quantity'];
}

// 生成订单
$sql = "INSERT INTO 订单 (用户ID, 总价, 状态) VALUES ($用户id, $订单总价, '未支付')";
if ($conn->query($sql) === TRUE) {
    $订单ID = $conn->insert_id;

    // 插入订单详情
    foreach ($cart as $item) {
        $商品名 = $item['name'];
        $单价 = $item['price'];
        $数量 = $item['quantity'];
        $sql = "INSERT INTO 订单详情 (订单ID, 商品名, 单价, 数量) VALUES ($订单ID, '$商品名', $单价, $数量)";
        $conn->query($sql);
    }

    // 清空购物车
    $_SESSION['cart'] = [];
    echo "订单已生成！订单ID: $订单ID";
} else {
    echo "生成订单时出错: " . $conn->error;
}

$conn->close();
?>

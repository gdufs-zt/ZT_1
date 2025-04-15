<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "请先登录";
    ?>
    <button onclick="location.href='外卖员登录.html';" style="position: fixed; top: 10px; left: 80px;">点此登录</button>
    <?php
} else {
    // 数据库连接
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "my_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("连接失败：" . $conn->connect_error);
    }
    $conn->set_charset('utf8');
    ?>

    <html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="groupuse_1.css">
        <title>当前订单</title>
        <script>
            function showPopup() {
                alert("有问题不要联系我");
            }
        </script>
    </head>
    <body>
    <div id="header">
        当前订单
    </div>
    <div id="menu">
        <button onclick="location.href='外卖员个人中心.php';">个人中心</button>
        <button onclick="location.href='外卖员当前订单.php';">当前订单</button>
        <button onclick="location.href='所有订单展示.php';">所有订单</button>
        <button onclick="showPopup();">在线客服</button>
        <button onclick="location.href='登出.php';">登出</button>
    </div>
    <div id="container">
        <?php
        echo "欢迎：" . $_SESSION['user'] . "<br>";

        $result = mysqli_query($conn, "SELECT distinct 编号 FROM 订单 where 外卖员 = '{$_SESSION['user']}'");
        $count = mysqli_num_rows($result);

        if ($count == 0) {
            echo '没有订单';
        } else {
            echo '你的订单如下：<br>';
            ?>
            <table width="900" border="1">
                <tr>
                    <th>编号</th>
                    <th>顾客名</th>
                    <th>商家地址</th>
                    <th>顾客地址</th>
                    <th>餐品</th>
                    <th>数量</th>
                    <th>配送费</th>
                    <th>外卖员状态</th>
                    <th>时间</th>
                    <th>操作</th>
                </tr>
                <?php
                while ($row_1 = mysqli_fetch_array($result)) {
                    $bianhao = $row_1['编号'];
                    $result_1 = mysqli_query($conn, "select * from 订单 where 编号 = '$bianhao'");
                    $row = mysqli_fetch_array($result_1);
                    $price = $row['价格'];
                    $num = $row['数量'];
                    $餐品 = array();
                    $餐品[] = $row['餐品'];
                    while ($row_3 = mysqli_fetch_array($result_1)) {
                        $price += $row_3['价格'];
                        $num += $row_3['数量'];
                        $餐品[] = $row_3['餐品'];
                    }
                    ?>
                    <?php
                    if($row['外卖员状态'] != '已送达')
                    {?>
                        <tr>
                        <td><?php echo $bianhao; ?></td>
                        <td><?php echo $row['顾客名']; ?></td>
                        <td><?php echo $row['商家地址']; ?></td>
                        <td><?php echo $row['用户地址']; ?></td>
                        <td><?php foreach ($餐品 as $item) {
                                echo $item . " ";
                            } ?></td>
                        <td><?php echo $num; ?></td>
                        <td><?php echo $price * 0.1; ?></td>
                        <td><?php echo $row['外卖员状态']; ?></td>
                        <td><?php echo $row['time']; ?></td>
                        <td>
                            <?php if ($row['外卖员状态'] == '已接单') { ?>
                                <a href="取餐.php?编号=<?php echo $row['编号']; ?>">取餐</a>
                            <?php } else if ($row['外卖员状态'] == '已取餐') { ?>
                                <a href="送达.php?编号=<?php echo $row['编号']; ?>">送达</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                    }
                    
                }
                ?>
            </table>
            <?php
        }
        ?>
    </div>
    </body>
    </html>

    <?php
}
?>

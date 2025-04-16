<!doctype html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败：" . $conn->connect_error);
} else {
    //echo "连接成功";
}
$conn->set_charset('utf8');
?>
<html>

<head>
    <meta charset="utf-8">
    <title>菜单表</title>
    <link rel="stylesheet" href="商家界面style.css" type="text/css" />
    <style>
        table {
            width: 900px;
            border-collapse: collapse;
            margin: 50px auto;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }

        td img {
            max-width: 100px;
            max-height: 100px;
        }

        a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #337ab7;
            color: #1E90FF;
        }

        a:hover {
            background-color: #23527c;
        }

        #a添加菜品 {
            margin: auto auto;
            /* 设置左右外边距为自动，使元素水平居中 */
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
            <a href="外卖系统首页.html" id="主页">主页</a>
            <a href="#" id="活动">活动</a>
            <a href="商家订单表.php" id="订单">订单</a>
            <a href="商家-联系我们.html" id="联系我们">联系我们</a>
            <a href="商家个人中心.php" id="商家个人中心">用户中心</a>
        </div>
        <br class="clearfloat" />
        <div id="mainContent">
            <table width="900" border="1">
                <tbody>
                    <?php
                    $result = mysqli_query($conn, 'SELECT * FROM 菜单主菜');


                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $row['菜名']; ?>
                            </td>
                            <td>
                                <?php echo $row['价格']; ?>
                            </td>
                            <td>
                                <img src="<?php echo $row['商品图片']; ?>" width="60">
                            </td>
                            <td>
                                <?php echo $row['商品描述']; ?>
                            </td>
                            <td>
                                <a href="菜单table delete.php?菜名2=<?php echo $row['菜名']; ?> ">删除</a>
                            </td>
                        </tr>
                    <?php
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
            <!--<p><a href="菜品图片展示.php">查看菜品图片</a></p>-->
            <a href="商家更新商品.html" id="添加菜品">添加菜品</a>
        </div>
    </div>
</body>

</html>
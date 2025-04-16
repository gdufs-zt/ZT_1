<?php
session_start();
if ( !isset( $_SESSION[ 'user' ] ) ) {
	echo "请先登陆";

    ?>
    <button onclick="location.href='外卖员登录.html';" style="position: fixed; top: 10px; left: 80px;">点此登录</button>
   
    <?php
} else
{

    require_once 'conn1.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="groupuse_1.css">
    <title>所有订单 </title>
    <script>
function showPopup() {
  alert("有问题不要联系我");
}
</script>
</head>

<body>
<div id="header">
所有订单
</div>
<div id="menu">
    <button onclick="location.href='外卖员个人中心.php';" >个人中心</button>
    <button onclick="location.href='外卖员当前订单.php';" >当前订单</button>
    <button onclick="location.href='所有订单展示.php';" >所有订单</button>
    <button onclick="showPopup()" >在线客服</button>
    <button onclick="location.href='登出.php';" >登出</button>
       
</div>
<br>
<br>

    <div id="container">
    <table width="900" border="1">
        <tbody>

            <?php
 echo '你的订单如下：<br>';
           
                ?>
                <tr>
    <th>编号</th>
    <th>商家地址</th>
    <th>顾客地址</th>
    <th>餐品</th>
    <th>数量</th>
    <th>价格</th>
    <th>操作</th>
</tr>

                
                <?php
 $bianhao = mysqli_query($conn,'select distinct 编号 from 订单 ');
while ($row_2 = mysqli_fetch_array($bianhao))   //编号
{

    $result_1 = mysqli_query($conn,"select * from 订单 where 编号 = '{$row_2['编号']}'");
    $row = mysqli_fetch_array($result_1);
    $price = $row['价格'];
    $num = $row['数量'];
    $餐品 =array();
    $餐品[] = $row['餐品'];
 
    while($row_3 = mysqli_fetch_array($result_1))//把查询到这个订单的所有商品的价格数量名字相加
    {
       

        $price += $row_3['价格'];
        $num +=$row_3['数量'];
        $餐品[] = $row_3['餐品'];
        
    }

    if($row['外卖员状态']=='未接单')
    {
        ?>
        <tr>
            <td>
                <?php echo $row_2['编号']; ?>
            </td>
    <td>
                <?php echo $row['商家地址']; ?>
            </td>
            <td>
                <?php echo $row['用户地址']; ?>
            </td>
            <td>
                <?php 
                foreach ($餐品 as $item) {
                echo $item . " ";
                }
               ?>
            </td>
            <td>
                <?php echo $num; ?>
            </td>
            <td>
                <?php echo $price; ?>
            </td>
            <td><a href="接单.php?编号=<?php echo $row_2['编号']; ?> ">接单</a>
            </td>

            <?php
    }
   
   
            
  
}       

mysqli_close($conn);
}
?>

        </tbody>
    </table>    
    </div>

   
</body>

</html>

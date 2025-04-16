<?php
    require_once( "conn1.php" );
    ?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="groupuse.css">
    <title>送达 </title>
   
</head>

<body>
    <?php
   
    
  
    if (isset($_GET['编号'])) {
        $sql = "UPDATE 订单 SET 外卖员状态 = '已送达' WHERE 编号 = '{$_GET['编号']}';";
        mysqli_query($conn, $sql);
       
    }
    header("location:外卖员当前订单.php");
    
    ?>
    
    
        

</body>

</html>
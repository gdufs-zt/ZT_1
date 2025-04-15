<!doctype html>
<?php
require_once 'wm_conn.php';
?>
<html>

<head>
    <meta charset="utf-8">
    <title>select </title>
</head>

<body>


    <?php



if (isset($_GET['id'])) {
    $sql = "delete from 当前订单 WHERE id = '{$_GET['id']}'";
        mysqli_query($conn, $sql);
       
    }

    mysqli_close($conn);
    header("location:外卖员当前订单.php");
    echo "删除";
?>
    

</body>

</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_db";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("连接失败：".$conn->connect_error);
}
else{
    //echo "连接成功";
}
$conn->set_charset('utf8');

?>
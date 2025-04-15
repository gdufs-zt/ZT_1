<?php
session_start();
$_SESSION['order_id'] = uniqid();
echo $_SESSION['order_id'];
?>

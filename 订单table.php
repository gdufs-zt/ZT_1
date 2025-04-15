<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title> 订单表 </title>
</head>

<body>
<div id="container">
    <div id="header">
      <h1>鳄了吗</h1>
    </div>
    <br class="clearfloat" />
    <div id="menu">
      <a href="外卖系统首页.html"> 主页 </a>
      <a href="#"> 活动 </a>
      <a href="商家-联系我们.html"> 联系我们 </a>
    </div>
    <br class="clearfloat" />
    <div id="mainContent">
	<table width="900" border="1">
		<tbody>
			<?php
			$conn = mysqli_connect("localhost", "root", "");
			if (!$conn) {
				die('不能连接数据库: ' . mysqli_error());
			}
			mysqli_select_db($conn, "my_db");
			$result = mysqli_query($conn, "SELECT * FROM 订单");
			while ($row = mysqli_fetch_array($result)) {
			?>
 <tbody>

<?php

$result = mysqli_query($conn, 'SELECT * FROM 订单');
	?>
	<tr>
					<td>
						<?php echo $row['顾客名']; ?>
					</td>
					<td>
						<?php echo $row['手机号']; ?>
					</td>
					<td>
						<?php echo $row['商家地址']; ?>
					</td>
					<td>
						<?php echo $row['用户地址']; ?>
					</td>
					<td>
						<?php echo $row['餐品']; ?>
					</td>
					<td>
						<?php echo $row['数量']; ?>
					</td>
					<td>
						<?php echo $row['价格']; ?>
					</td>
					<td>
						<?php echo $row['time']; ?>
					</td>
					<td>
						<?php echo $row['外卖员状态']; ?>
					</td>
					<td>
						<?php echo $row['商家状态']; ?>
					</td>
					<td>
						<?php echo $row['用户状态']; ?>
					</td>
					<td>
						<?php echo $row['编号']; ?>
					</td>
					
				</tr>
	
	<?php


while ($row = mysqli_fetch_array($result)) {
?>

<tr>
					<td>
						<?php echo $row['顾客名']; ?>
					</td>
					<td>
						<?php echo $row['手机号']; ?>
					</td>
					<td>
						<?php echo $row['商家地址']; ?>
					</td>
					<td>
						<?php echo $row['用户地址']; ?>
					</td>
					<td>
						<?php echo $row['餐品']; ?>
					</td>
					<td>
						<?php echo $row['数量']; ?>
					</td>
					<td>
						<?php echo $row['价格']; ?>
					</td>
					<td>
						<?php echo $row['time']; ?>
					</td>
					<td>
						<?php echo $row['外卖员状态']; ?>
					</td>
					<td>
						<?php echo $row['商家状态']; ?>
					</td>
					<td>
						<?php echo $row['用户状态']; ?>
					</td>
					<td>
						<?php echo $row['编号']; ?>
					</td>
					
				</tr>
<?php
}

}
mysqli_close($conn);
?>

</tbody>




				
			<?php
			?>
	</div>
</div>
</body>

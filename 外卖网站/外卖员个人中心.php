<?php
session_start();
if ( !isset( $_SESSION[ 'user' ] ) ) {
	echo "请先登陆";
    ?>
    <a href="外卖员登录.html">登录</a>
    <?php

} else {
	require_once( "wm_conn.php" );
	?>
	<html>

	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="groupuse_1.css">
		<title>select </title>
        <style>
/* 灰色覆盖层 */
.overlay {
  display: none;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1;
  opacity: 0; /* 初始时透明度为0 */
  transition: opacity 0.3s ease; /* 添加过渡效果 */
}

/* 弹窗 */
.dialog {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px;
  z-index: 2;
  opacity: 0; /* 初始时透明度为0 */
  transition: opacity 0.3s ease; /* 添加过渡效果 */
}
.closeButton{
  position: fixed;
  right: 10px;  
}
</style>
        <script>
function showPopup() {
  alert("有问题不要联系我");
}
</script>


	</head>

	<body>
  <div id="header">个人中心</div>
  <div id="menu">

  <button onclick="location.href='外卖员个人中心.php';" >个人中心</button>
    <button onclick="location.href='外卖员当前订单.php';" >当前订单</button>
    <button onclick="location.href='所有订单展示.php';" >所有订单</button>
    <button onclick="showPopup()" >在线客服</button>
    <button onclick="location.href='登出.php';" >登出</button>
         
</div>
  
<!-- 灰色覆盖层（照抄） -->
<div id="overlay" class="overlay"></div>
<!-- 弹窗（照抄） -->
<div id="editDialog" class="dialog">

<?php
                $sql = "SELECT * FROM 外卖员 where id = '{$_SESSION['id']}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                ?>


<button class="closeButton" onclick="closeEditDialog()">X</button>
<br>
<br>
  <p>用户名：<input type="text" id="editInput1" value = "<?php echo $row['user']; ?>"></p>
  <p>密码:<input type="text" id="editInput2" value = "<?php echo $row['pwd']; ?>"></p>
  <p>姓名:<input type="text" id="editInput3" value = "<?php echo $row['CN_name']; ?>"></p>
  <p>手机号:<input type="text" id="editInput4"value = "<?php echo $row['phone']; ?>"></p>
  <button onclick="submitEdit()">提交修改</button>
</div>
<script>
// 弹出修改弹窗（照抄）
function openEditDialog() {
  event.preventDefault(); // 阻止表单提交
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overlay").style.opacity = "1"; // 设置透明度为1，使其显示
  document.getElementById("editDialog").style.display = "block";
  setTimeout(function() {
    document.getElementById("editDialog").style.opacity = "1"; // 设置透明度为1，使其显示
  }, 100); // 延迟100毫秒，等待灰色覆盖层渐变完成后再显示弹窗

  
}

// 提交修改内容（修改这里的php）
function submitEdit() {
    //写你要修改的个人信息
  var user = document.getElementById("editInput1").value;
  var pwd = document.getElementById("editInput2").value;
  var Name = document.getElementById("editInput3").value;
  var phone = document.getElementById("editInput4").value;
  var xhr = new XMLHttpRequest();
  //post方法把数据传到php修改
  xhr.open("POST", "修改个人信息.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        alert("已修改");
        closeEditDialog(); // 关闭弹窗
        location.reload();// 刷新页面
      } else {
        alert("发生错误：" + xhr.status);
      }
    }
  };
  var data = "user=" + encodeURIComponent(user) +
               "&pwd=" + encodeURIComponent(pwd) +
               "&Name=" + encodeURIComponent(Name) +
               "&phone=" + encodeURIComponent(phone);
  xhr.send(data);
}

// 关闭修改弹窗（照抄）
function closeEditDialog() {
  document.getElementById("overlay").style.opacity = "0"; // 设置透明度为0，使其渐变消失
  document.getElementById("editDialog").style.opacity = "0"; // 设置透明度为0，使其渐变消失
  setTimeout(function() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("editDialog").style.display = "none";
  }, 300); // 延迟300毫秒，等待渐变效果完成后隐藏弹窗
}
</script>


   

<div id="container">
<h1></h1>        


      <h2>你的个人信息如下：<h2>
      <p><strong>用户名：</strong><?php echo $row['user']; ?></p>
      <p><strong>姓名：</strong><?php echo $row['CN_name']; ?></p>
      <p><strong>手机号：<?php echo $row['phone']; ?></p>
      <p><form onsubmit="openEditDialog()">
<input type="submit" value="修改">
</form></p>
    </div>
		
               
                
               
            
				
			
		
	</body>

	</html>


	<?php
}
?>
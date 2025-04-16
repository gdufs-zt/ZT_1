<?php
session_start();

// 连接数据库
require_once("商家conn.php");

$sql = "SELECT * FROM 菜单甜点";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>外卖点餐系统 - 甜点</title>
  <link rel="stylesheet" href="点餐界面style.css" type="text/css" />
  
  <script>
    let cart = <?php echo isset($_SESSION['cart']) ? json_encode($_SESSION['cart']) : '[]'; ?>;

    function addToCart(itemName, itemPrice, itemQuantity, sellerName) { //商品加入购物车
      const itemIndex = cart.findIndex(item => item.name === itemName);
      if (itemIndex > -1) {
        cart[itemIndex].quantity += itemQuantity;
      } else {
        cart.push({ name: itemName, price: itemPrice, quantity: itemQuantity, seller: sellerName });
      }
      updateSessionCart();
    }

    function updateSessionCart() { //更新购物车数据
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "update_cart.php", true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.send(JSON.stringify(cart));
    }

    function updateCartDisplay() { //更新购物车的显示
      const cartItemsContainer = document.getElementById('cart-items');
      cartItemsContainer.innerHTML = '';
      cart.forEach((item, index) => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.innerHTML = `
          <span>${item.name}</span>
          <span>${item.price}元</span>
          <input type="number" value="${item.quantity}" min="1" onchange="updateCartItemQuantity(${index}, this.value)">
          <button onclick="removeFromCart(${index})">删除</button>
        `;
        cartItemsContainer.appendChild(cartItem);
      });
      document.getElementById('cart-popup').style.display = 'block';
      document.getElementById('cart-overlay').style.display = 'block';
    }

    function updateCartItemQuantity(index, quantity) { //更新购物车中的商品数量
      cart[index].quantity = parseInt(quantity);
      updateSessionCart();
      updateCartDisplay();
    }

    function removeFromCart(index) { //从购物车中移除商品
      cart.splice(index, 1);
      updateSessionCart();
      updateCartDisplay();
    }

    function closeCart() { //关闭购物车的显示
      document.getElementById('cart-popup').style.display = 'none';
      document.getElementById('cart-overlay').style.display = 'none';
    }

    function generateOrderId() {
      const xhr = new XMLHttpRequest();
      xhr.open("GET", "generate_order_id.php", true);
      xhr.onload = function() {
        if (this.status == 200) {
          console.log("订单编号生成: " + this.responseText);
        }
      }
      xhr.send();
    }

    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.expand-btn').forEach(button => {
        button.addEventListener('click', event => {
          event.preventDefault();
          const menuItem = button.closest('.menu-item');
          const itemName = menuItem.querySelector('.item-name').textContent;
          const itemPrice = parseFloat(menuItem.querySelector('.item-price').textContent);
          const itemQuantity = parseInt(menuItem.querySelector('input[type=number]').value);
          const sellerName = menuItem.querySelector('.seller-name').textContent;
          if (itemQuantity > 0) {
            addToCart(itemName, itemPrice, itemQuantity, sellerName);
            alert('已加入购物车');
          } else {
            alert('请选择有效的数量');
          }
        });
      });

      document.getElementById('cart-button').addEventListener('click', updateCartDisplay);
      document.getElementById('submit').addEventListener('click', generateOrderId);
    });
  </script>
</head>

<body>
  <div id="container">
    <div id="header">
      <h1>鳄了吗</h1>
    </div>
    <br class="clearfloat" />
    <div id="menu">
      <a href="外卖系统首页.html">主页</a>
      <a href="#">订单</a>
      <a href="商家-联系我们.html">联系我们</a>
      <a href="personal_center.html">个人中心</a>
    </div>
    <br class="clearfloat" />
    <div id="mainContent">
      <div id="sidebar">
        <a href="主菜点餐界面.php">主菜</a> <br>
        <br> <a href="甜品点餐界面.php">甜点</a> <br>
        <br> <a href="饮料点餐界面.php">饮料</a> <br>
      </div>
      <div id="content">
        <form id="order-form" action="订单生成.php" method="post">
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<div class='menu-item'>";
              $imageData = base64_encode($row['商品图片']);
              echo '<img src="data:image/jpeg;base64,'.$imageData.'" alt="图片" width="170" height="120">';
              echo "<span class='item-name'>" . $row["菜名"] . "</span>";
              echo "<span class='item-price'>" . $row["价格"] . "￥</span>";
              echo "<input type='number' name='quantities[]' value='0' min='0'>";
              echo "<input type='hidden' name='items[]' value='" . $row["菜名"] . "'>";
              echo "<input type='hidden' name='prices[]' value='" . $row["价格"] . "'>";
              echo "<span class='seller-name' style='display:none;'>" . $row["商家名"] . "</span>";
              echo "<button class='expand-btn'>+</button>";
              echo "</div>";
            }
          } else {
            echo "0 结果";
          }
          $conn->close();
          ?>
          <button id="submit" type="submit">提交订单</button>
        </form>
      </div>
    </div>
    <br class="clearfloat" />
  </div>

<button id="cart-button">购物车</button>

<div id="cart-popup">
  <h2>购物车</h2>
  <div id="cart-items"></div>
  <button onclick="closeCart()">关闭</button>
</div>
<div id="cart-overlay" onclick="closeCart()"></div>

</body>

</html>

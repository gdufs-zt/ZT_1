<?php
// 连接数据库
require_once("商家conn.php");

$sql = "SELECT * FROM 菜单主菜";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>外卖点餐系统</title>
  <style>
  .clearfloat {
    clear: both;
  }

  #container {
      width: 80%;
      margin: 0 auto;
  }

  #header {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
  }

  #menu {
      background-color: #f4f4f4;
      padding: 10px;
      text-align: center;
  }

  #menu a {
      display: inline-block;
      margin: 0 10px;
      text-decoration: none;
      color: #333;
      font-size: 16px;
  }

  #mainContent {
      margin-top: 20px;
  }

  #sidebar {
      float: left;
      width: 15%;
      background-color: #ece9e9e1;
      padding: 10px;
  }

  #sidebar a {
      color: #e36f6f;
      text-decoration: none;
  }

  #sidebar a:hover {
      color: #ff6347;
      font-weight: bold;
  }

  #content {
      float: right;
      width: 80%;
      padding: 10px;
  }

  .menu-item {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
  }

  .menu-item label {
      display: block;
      font-weight: bold;
  }

  .menu-item img {
      margin-left: 10px;
      border-radius: 5px;
  }

  .item-name {
      margin-left: 50px;
      margin-top: -10px;
  }

  .item-price {
      margin-left: 500px;
      color: #ff6347;
  }

  .menu-item input[type="number"] {
      margin-right: 10px;
      margin-top: 10px;
  }

  .expand-btn {
      background-color: #4caf50;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      margin-left: 10px;
  }

  .options {
      display: none;
      margin-top: 10px;
      padding-left: 20px;
  }

  #order-form button[type="submit"] {
      background-color: #4caf50;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
  }

  #order-form button[type="submit"]:hover {
      background-color: #45a049;
  }

  #cart-popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80%;
    max-width: 500px;
    background: white;
    border: 1px solid #ccc;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }
  #cart-popup h2 {
    text-align: center;
  }
  .cart-item {
    display: flex;
    justify-content: space-between;
    margin: 10px 0;
  }
  #cart-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 500;
  }
  #cart-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  </style>
  
<script>
  let cart = [];

  function addToCart(itemName, itemPrice, itemQuantity) {
    const itemIndex = cart.findIndex(item => item.name === itemName);
    if (itemIndex > -1) {
      cart[itemIndex].quantity += itemQuantity;
    } else {
      cart.push({ name: itemName, price: itemPrice, quantity: itemQuantity });
    }
  }

  function updateCartDisplay() {
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

  function updateCartItemQuantity(index, quantity) {
    cart[index].quantity = parseInt(quantity);
    updateCartDisplay();
  }

  function removeFromCart(index) {
    cart.splice(index, 1);
    updateCartDisplay();
  }

  function closeCart() {
    document.getElementById('cart-popup').style.display = 'none';
    document.getElementById('cart-overlay').style.display = 'none';
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.expand-btn').forEach(button => {
      button.addEventListener('click', event => {
        event.preventDefault();
        const menuItem = button.closest('.menu-item');
        const itemName = menuItem.querySelector('.item-name').textContent;
        const itemPrice = parseFloat(menuItem.querySelector('.item-price').textContent);
        const itemQuantity = parseInt(menuItem.querySelector('input[type=number]').value);
        if (itemQuantity > 0) {
          addToCart(itemName, itemPrice, itemQuantity);
          alert('已加入购物车');
        } else {
          alert('请选择有效的数量');
        }
      });
    });

    document.getElementById('cart-button').addEventListener('click', updateCartDisplay);
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
      <a href="#">主页</a>
      <a href="#">菜单</a>
      <a href="#">订单</a>
      <a href="商家-联系我们.html">联系我们</a>
    </div>
    <br class="clearfloat" />
    <div id="mainContent">
      <div id="sidebar">
        <a href="主菜点餐界面.php">主菜</a> <br>
        <br> <a href="甜品点餐界面.php">甜点</a> <br>
        <br> <a href="饮料点餐界面.php">饮料</a> <br>
      </div>
      <div id="content">
        <form id="order-form" action="订单生成尝试.php" method="post">
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<div class='menu-item'>";
              $imagePath = $row['商品图片'];
              echo '<img src="' . $imagePath . '" width="170" height="120">';
              echo "<span class='item-name'>" . $row["菜名"] . "</span>";
              echo "<span class='item-price'>" . $row["价格"] . "￥</span>";
              echo "<input type='number' name='quantities[]' value='0' min='0'>";
              echo "<input type='hidden' name='items[]' value='" . $row["菜名"] . "'>";
              echo "<input type='hidden' name='prices[]' value='" . $row["价格"] . "'>";
              echo "<button class='expand-btn'>+</button>";
              echo "</div>";
            }
          } else {
            echo "0 结果";
          }
          $conn->close();
          ?>
          <button type="submit">提交订单</button>
        </form>
      </div>
      <br class="clearfloat" />
    </div
    
<button id="cart-button">购物车</button>
<div id="cart-popup">
  <h2>购物车</h2>
  <div id="cart-items"></div>
  <button onclick="closeCart()">关闭</button>
</div>
<div id="cart-overlay" onclick="closeCart()"></div>

</body>

</html>
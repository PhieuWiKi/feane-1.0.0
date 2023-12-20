<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $conn = new mysqli('localhost', 'root', '', 'restaurant');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $name = $_GET['id'];
  $user = $_SESSION['user'];
  $row_ = 0;
  $sql = "SELECT * FROM cart WHERE id_kh = '" . $user . "' AND id_menu = '" . $name . "'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row_ = $result->num_rows;
    while ($row = $result->fetch_assoc()) {
      $count = $row['count'];
      $count++;
      update($user, $name, $count);
    }
  } else {
    add($user, $name);

  }
  $conn->close();
  $product = getProduct($name);
  if ($row_ == 0) {
    $string = "
    <img src='" . $product["img"] . "' alt=''>
    <div class='name'>" . $product["name"] . "</div>
    <div class='count'>1</div>
    <div class='price'>$" . $product["price"] . "</div>
    <button onclick='xoa_(".$name.")'>Delete</button>";
    $txt = ['status' => 0, 'content' => $string];
    echo json_encode($txt);
  }else{
    $txt = ["status" => 1, "content" => $product['price']];
    echo json_encode($txt);
  }
}
function add($user, $name)
{
  $product = getProduct($name);
  $conn = new mysqli('localhost', 'root', '', 'restaurant');
  $sql = "INSERT INTO `cart`(`id_kh`, `id_menu`, `count`, `total`) VALUES ('" . $user . "','" . $name . "',1," . $product['price'] . ")";
  $conn->query($sql);
  $conn->close();
}

function update($user, $name, $count)
{
  $product = getProduct($name);
  $total = $product['price'] * $count;
  $conn = new mysqli('localhost', 'root', '', 'restaurant');
  $sql = "UPDATE `cart` SET `count`='" . $count . "',`total`='" . $total . "' WHERE id_kh = '" . $user . "' AND id_menu = '" . $name . "'";
  $conn->query($sql);
  $conn->close();
}

function getProduct($name)
{
  $conn = new mysqli('localhost', 'root', '', 'restaurant');
  $sql = "SELECT * FROM `menu` WHERE id_menu = " . $name . "";
  $result = $conn->query($sql);
  $menu = [];
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $menu = ["name" => $row['name'], 'img' => $row['img'], 'price' => $row['price']];
    }
  }
  return $menu;
}
//   echo 'hello';
?>
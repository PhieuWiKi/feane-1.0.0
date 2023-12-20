<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $conn = new mysqli('localhost', 'root', '', 'restaurant');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $name = $_GET['id'];
  $user = $_SESSION['user'];
  $count = 0;
  $sql = "SELECT count FROM cart WHERE id_kh = '" . $user . "' AND id_menu = '" . $name . "'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $count = $row['count'];
    }
  }
  $sql = "DELETE FROM cart WHERE id_kh = ".$user." AND id_menu = ".$name;
  $conn->query($sql);
  $conn->close();
  echo $count;
}
?>
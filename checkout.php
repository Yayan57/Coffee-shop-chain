<?php
session_start();

// db connections
$servername = "coffee-shop.mysql.database.azure.com";
$username = "group9";
$password = "Databases9!";
$dbname = "pointofsales";

// Create connection
$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL, '/path/to/mysql-ca.pem', NULL, NULL);
mysqli_real_connect($con, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Retrieve cart items
$cart_items = $_SESSION['cart'];

// Update inventory and clear cart
foreach ($cart_items as $item_id => $quantity) {
  // Retrieve item details from inventory
  $item_query = "SELECT * FROM inventory WHERE productid='".$item_id."'";
  $item_result = mysqli_query($con, $item_query);
  $item_row = mysqli_fetch_assoc($item_result);
  
  // Subtract quantity from inventory
  $new_quantity = $item_row['quantity'] - $quantity;
  $update_query = "UPDATE inventory SET quantity='".$new_quantity."' WHERE productid='".$item_id."'";
  mysqli_query($con, $update_query);
}

// Clear cart
$_SESSION['cart'] = array();

// Display success message
echo "<h1>Thank you for your order!</h1>";
?>


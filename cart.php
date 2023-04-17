<?php
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

// Process cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Insert transaction details
  $payment_total = 0;
  foreach ($_POST['item'] as $item_id) {
    $item_query = "SELECT * FROM inventory WHERE productid='".$item_id."'";
    $item_result = mysqli_query($con, $item_query);
    $item_row = mysqli_fetch_assoc($item_result);
    $payment_total += $item_row['price'];
  }
  $payment_type = $_POST['payment_type'];
  $date = date("Y-m-d");
  $time = date("Y-m-d H:i:s");
  $to_go = $_POST['to_go'];
  $branchN = $_POST['branchN'];
  $transaction_query = "INSERT INTO transaction_details (customer_user, payment_total, payment_type, date, time, to_go, branchN) VALUES ('".$_SESSION['username']."', '".$payment_total."', '".$payment_type."', '".$date."', '".$time."', '".$to_go."', '".$branchN."')";
  mysqli_query($con, $transaction_query);
  $transaction_id = mysqli_insert_id($con);

  // Insert transaction items and update inventory
  foreach ($_POST['item'] as $item_id) {
    $quantity = 1;
    $transit_id = $transaction_id;
    $item_query = "SELECT * FROM inventory WHERE productid='".$item_id."'";
    $item_result = mysqli_query($con, $item_query);
    $item_row = mysqli_fetch_assoc($item_result);
    $product_id = $item_row['productid'];
    $transaction_item_query = "INSERT INTO transaction_items (product_id, quantity, transit_id) VALUES ('".$product_id."', '".$quantity."', '".$transit_id."')";
    mysqli_query($con, $transaction_item_query);
    
    // Update inventory
    $inventory_quantity = $item_row['quantity'];
    $new_inventory_quantity = $inventory_quantity - $quantity;
    $inventory_update_query = "UPDATE inventory SET quantity='".$new_inventory_quantity."' WHERE productid='".$product_id."'";
    mysqli_query($con, $inventory_update_query);
  }

  // Display confirmation message
  echo "<h1>Thank you for your order!</h1>";
}
?>

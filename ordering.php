<html>
    <head>
        <link rel="stylesheet" href="cstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <title>User Login</title>
    </head>
</html>
  
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

// Retrieve inventory items
$inventory_query = "SELECT * FROM inventory";
$inventory_result = mysqli_query($con, $inventory_query);

// Display menu
echo "<div style= 'margin-left: 20px;'>";
echo "<h1>Menu</h1>";
echo "<form action='cart.php' method='post'>";
while ($inventory_row = mysqli_fetch_assoc($inventory_result)) {
  echo "<div style= 'margin-left: 20px;'>";
  echo "<input type='number' name='item[]' value='0' min='0' max='15' style='width: 40px; margin-right: 20px;'>";
  echo "<label>".$inventory_row['item_name']." - $".$inventory_row['price']."</label>";
  echo "</div>";
}
echo "<input type='submit' value='Add to Cart'>";
echo "</form>";
echo "</div>";
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

  // Insert transaction items
  foreach ($_POST['item'] as $item_id) {
    $quantity = 1;
    $transit_id = $transaction_id;
    $item_query = "SELECT * FROM inventory WHERE productid='".$item_id."'";
    $item_result = mysqli_query($con, $item_query);
    $item_row = mysqli_fetch_assoc($item_result);
    $product_id = $item_row['productid'];
    $transaction_item_query = "INSERT INTO transaction_items (product_id, quantity, transit_id) VALUES ('".$product_id."', '".$quantity."', '".$transit_id."')";
    mysqli_query($con, $transaction_item_query);
  }

  // Display confirmation message
  echo "<h1>Thank you for your order!</h1>";
}
?>

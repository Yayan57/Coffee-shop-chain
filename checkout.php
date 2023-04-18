<?php
  include('includes/headeruser.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

////
// Get the username from the session
$user = $_SESSION['username'];

// Get the total price from the session
$total_price = $_SESSION['total_price'];

//branch number
$branchN = $_SESSION['branchN'];

//payment type
$payment_type = $_SESSION['payment_type'];

//togo option
$to_go = $_SESSION['to_go'];


// inserting data
$date = date("Y-m-d");
$time = date("Y-m-d H:i:s");
$sql = "INSERT INTO transaction_details (customer_user, payment_total, payment_type, date, time, to_go, branchN) 
        VALUES ('$user', '$total_price', '$payment_type', '$date', '$time', '$to_go', '$branchN')";
mysqli_query($con, $sql);

// Get the transaction id from that insertion
$transaction_id = mysqli_insert_id($con);

// now for the items table
foreach ($_SESSION['cart'] as $item) {
  $product_id = $item['productid'];
  $quantity = $item['quantity'];

  // updating inventory
  $sql = "UPDATE inventory SET quantity = quantity - $quantity WHERE productid = '$product_id'";

  mysqli_query($con, $sql);

  // insertion
  $sql = "INSERT INTO transaction_items (product_id, quantity, transit_id) 
          VALUES ('$product_id', '$quantity', '$transaction_id')";
  mysqli_query($con, $sql);
}

// Clear the cart
unset($_SESSION['cart']);


// Close connection
mysqli_close($con);

echo "Checkout complete. Thank you for your order! Payment will be collected upon arrival, please have your chosen payment type ready.";

include('includes/footer.php');
?>

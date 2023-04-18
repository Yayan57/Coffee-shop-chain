<?php 
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

// Retrieve menu items from inventory table
$sql = "SELECT productid, item_name, price FROM inventory";
$result = mysqli_query($con, $sql);

// Display menu items with forms
if (mysqli_num_rows($result) > 0) {
  echo "<form method='post' action='cart.php'>";
  echo "<ul>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<li>" . $row["item_name"] . " - $" . $row["price"] . " ";
    echo "<input type='number' name='qty" . $row["productid"] . "' value='0' min='0' style='width:50px;'>";
    echo "<input type='hidden' name='productid" . $row["productid"] . "' value='" . $row["productid"] . "'></li>";
  }
  echo "</ul>";
  echo "<input type='submit' name='addtocart' value='Add to Cart'>";
  echo "</form>";
} else {
  echo "No menu items available.";
}

// Close connection
mysqli_close($con);


?>

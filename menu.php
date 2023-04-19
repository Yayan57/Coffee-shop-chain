<html>
  <style>
    .my-input{
      margin-bottom: 10px;
    }  
    .my-div {
    margin-top: 20px;
  }
  </style>
	<link rel="stylesheet" href="cstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</html>
<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
if(!isset($_SESSION)){
  session_start();
}

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

// creating menu from inventory
$sql = "SELECT productid, item_name, price FROM inventory";
$result = mysqli_query($con, $sql);

if(isset($_POST['addtocart'])){
  header('Location: cart.php');
}


if (mysqli_num_rows($result) > 0) {
  include('includes/headeruser.php');

  echo "<form method='post' action='cart.php'>";
  echo "<div class='my-div' style='display: flex; flex-wrap: wrap;'>";
  $count = 0;
  while($row = mysqli_fetch_assoc($result)) {
    $count++;
    if ($count <= 5) {
      echo "<div style='flex: 1 1 50%;'>" . $row["item_name"] . " - $" . $row["price"] . " ";
      echo "<input type='number' class='my-input' name='qty" . $row["productid"] . "' value='0' min='0' style='width:50px;'>";
      echo "<input type='hidden' class='my-input' name='productid" . $row["productid"] . "' value='" . $row["productid"] . "'></div>";
    } else {
      echo "<div style='flex: 1 1 50%;'>" . $row["item_name"] . " - $" . $row["price"] . " ";
      echo "<input type='number' class='my-input' name='qty" . $row["productid"] . "' value='0' min='0' style='width:50px;'>";
      echo "<input type='hidden' class='my-input' name='productid" . $row["productid"] . "' value='" . $row["productid"] . "'></div>";
    }
  }
  echo "</div>";
  echo "<input type='submit'  name='addtocart' value='Add to Cart'>";
  echo "</form>";
} else {
  include('includes/headeruser.php');
  echo "No items available.";
}

// Close connection
mysqli_close($con);

  include('includes/footer.php');
?>
<?php 
  if( empty(session_id()) && !headers_sent()){
    session_start();
  }

  if (isset($_POST['continue'])) {
    header('Location: checkout.php');
    exit();
  }
  include('includes/headeruser.php');
?>

<style>
  table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #eee;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

form {
  margin-top: 20px;
}

label {
  font-weight: bold;
}

input[type="radio"],
input[type="submit"],
select {
  margin-left: 10px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  margin-top: 10px;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}

</style>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



// Check for cart
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

// remove button
if (isset($_POST['remove'])) {
  $productid = $_POST['productid'];
  foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['productid'] == $productid) {
      unset($_SESSION['cart'][$key]);
      break;
    }
  }
}

//adding into cart
foreach ($_POST as $key => $value) {
  if (substr($key, 0, 3) == "qty" && $value > 0) {
    $productid = substr($key, 3);
    $item = array(
      "productid" => $productid,
      "quantity" => $value
    );
    $_SESSION['cart'][] = $item;
  }
}
$total_price = 0;

//getting necessary variables
if (count($_SESSION['cart']) > 0) {
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

  include('includes/headeruser.php');


  echo "<table>";
  echo "<tr><th>Item Name</th><th>Quantity</th><th>Price</th><th>Remove</th></tr>";

  //setting variables
  foreach ($_SESSION['cart'] as $item) {
    $productid = $item['productid'];
    $quantity = $item['quantity'];
    $sql = "SELECT item_name, price FROM inventory WHERE productid = '$productid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $item_name = $row['item_name'];
    $price = $row['price'];
    $item_price = $price * $quantity;
    $total_price += $item_price;
    echo "<tr><td>$item_name</td><td>$quantity</td><td>$item_price</td>";
    echo "<td><form method='post' action='cart.php'><input type='hidden' name='productid' value='$productid'><input type='submit' name='remove' value='Remove'></form></td></tr>";
  }

  echo "<tr><td colspan='2'>Total:</td><td>$total_price</td></tr>";
  echo "</table>";

  echo '<form method="post">
  <label>Is this a to-go order? </label>
  <input type="radio" name="to_go" value="yes"> Yes
  <input type="radio" name="to_go" value="no" checked> No<br>';

  if(isset($_POST['to_go'])) {
  $_SESSION['to_go'] = $_POST['to_go'];
  }  

  echo '<label>Select payment type:</label>
    <select name="payment">
        <option value="cash">Cash</option>
        <option value="card">Card</option>
    </select><br>';

  if(isset($_POST['payment'])) {
  $_SESSION['payment_type'] = $_POST['payment'];
  }

  echo '<label>Branch No: </label>
    <select name="branchN">
        <option value="001">123 Main St, Houston, TX</option>
        <option value="002">456 Elm St, Houston, TX</option>
        <option value="003">789 Oak St, Houston, TX</option>
    </select><br>';

  if(isset($_POST['branchN'])) {
  $_SESSION['branchN'] = $_POST['branchN'];
  }



  //set price
  $_SESSION['total_price'] = $total_price;

} else {
  echo "No items in cart.";
}

  echo '<input type="submit" name="continue" value="Checkout">
  </form>';



    // Close connection
  mysqli_close($con);
?>


<?php
include('includes/footer.php');
?>
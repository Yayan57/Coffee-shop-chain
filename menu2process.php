<html>
    <head>
        <link rel="stylesheet" href="cstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>
</html>
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

  // Initialize cart
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  // Add items to cart
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['item'] as $item_id) {
      if (!isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id] = 1;
      } else {
        $_SESSION['cart'][$item_id]++;
      }
    }
  }

  // Retrieve cart items
  $cart_items = array();
  foreach ($_SESSION['cart'] as $item_id => $quantity) {
    $item_query = "SELECT * FROM inventory WHERE productid='".$item_id."'";
    $item_result = mysqli_query($con, $item_query);
    $item_row = mysqli_fetch_assoc($item_result);
    $item_row['quantity'] = $quantity;
    $cart_items[] = $item_row;
  }

  // Display cart
  echo "<style>.table-header-item {padding-right: 20px;}</style>";
  echo "<div style= 'margin-left: 20px;'>";
  echo "<h1>Cart</h1>";
  echo "<table>";
  echo "<thead><tr><th class='table-header-item'>Item</th><th class='table-header-item'>Price</th><th class='table-header-item'>Quantity</th><th class='table-header-item'>Total</th></tr></thead>";
  echo "</div>";
  echo "<tbody>";
  $total_price = 0;
  foreach ($cart_items as $item) {
    $item_price = $item['price'] * $item['quantity'];
    $total_price += $item_price;
    echo "<tr>";
    echo "<td>".$item['item_name']."</td>";
    echo "<td>$".$item['price']."</td>";
    echo "<td>".$item['quantity']."</td>";
    echo "<td>$".$item_price."</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "<tfoot><tr><td colspan='3'>Total:</td><td>$".$total_price."</td></tr></tfoot>";
  echo "</table>";

  // Checkout form
  echo "<h2>Checkout</h2>";
  echo "<form action='checkout.php' method='post'>";
  echo "<label for='payment_type' style='margin-right: 20px;'>Payment Type:</label>";
  echo "<select name='payment_type' id='payment_type'>";
  echo "<option value='cash'>Cash</option>";
  echo "<option value='card'>Card</option>";
  echo "</select>";
  echo "<br>";
  echo "<label for='to_go' style='margin-right: 20px;'>To Go:</label>";
  echo "<input type='checkbox' name='to_go' id='to_go'>";
  echo "<br>";
  echo "<label for='branchN' style='margin-right: 20px;'>Location:</label>";
  echo "<select name='branchN' id='branchN'>";
  echo "<option value='1'>123 Main St, Houston, TX</option>";
  echo "<option value='2'>456 Elm St, Houston, TX</option>";
  echo "<option value='3'>789 Oak St, Houston, TX</option>";
  echo "</select>";
  echo "<br>";
  echo "<input type='submit' value='Checkout'>";
  echo "</form>";
?>
<?php
if(!isset($_SESSION)){
  session_start();
}

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


  
  if(isset($_POST['to_go'])) {
  $_SESSION['to_go'] = $_POST['to_go'];
  }  


  if(isset($_POST['payment'])) {
  $_SESSION['payment_type'] = $_POST['payment'];
  }

  
  if(isset($_POST['branchN'])) {
  $_SESSION['branchN'] = $_POST['branchN'];
  }



  //set price
  $_SESSION['total_price'] = $total_price;
  if(isset($_POST["check_out"])){
    header('Location: checkout.php');
  }

}


  
?>

<html>
<form name="cart_form" method="POST" action="cart.php">
  <?php if (count($_SESSION['cart']) > 0) { ?>
  <tr><td><?php echo $item_name ?></td><td><?php echo $quantity ?></td><td><?php echo $item_price?></td>
  <table id="table">
  <tr><th>Item Name</th><th>Quantity</th><th>Price</th><th>Remove</th></tr>

  <?php
  $total_price = 0;
  foreach ($_SESSION['cart'] as $item) {
    $productid = $item['productid'];
    $quantity = $item['quantity'];
    $sql = "SELECT item_name, price FROM inventory WHERE productid = '$productid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $item_name = $row['item_name'];
    $price = $row['price'];
    $item_price = $price * $quantity;
    $total_price = $total_price + $item_price;
    $type="submit";
    $remove="remove"; ?>
    <tr><td><?php echo $item_name ?></td><td><?php echo $quantity?></td><td><?php echo $item_price?></td><td><input type="type" name="remove" value="remove"></td></tr>";
    <?php}?>
  
  <tr><td colspan='2'>Total:</td><td><?php echo $total_price ?></td></tr>

  </table>

  <script>
    
            var index, table = document.getElementById('table');
            for(var i = 1; i < table.rows.length; i++)
            {
                table.rows[i].cells[3].onclick = function()
                {
                  index = this.parentElement.rowIndex;
                  table.deleteRow(index);
                };
                
            }
    
  </script>

  <label>Is this a to-go order? </label>
  <input type="radio" name="to_go" value="yes"> Yes
  <input type="radio" name="to_go" value="no" checked> No<br>

  
  <label>Select payment type:</label>
    <select name="payment">
        <option value="cash">Cash</option>
        <option value="card">Card</option>
    </select><br>

    <label>Branch No: </label>
    <select name="branchN" id="branchN">
        <option value="001">123 Main St, Houston, TX</option>
        <option value="002">456 Elm St, Houston, TX</option>
        <option value="003">789 Oak St, Houston, TX</option>
    </select><br>
    <input type="submit" class="btn btn-success" name="check_out" value="Check Out">


  <?php } else { ?>
  <h1>No items in cart</h1>
  <?php } ?>

</form>
</html>



<?php
include('includes/footer.php');
?>
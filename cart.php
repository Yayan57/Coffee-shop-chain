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

  $_SESSION['item'] = array();
  $_SESSION['item'] = array();
  $_SESSION['quantity'] = array();
  $i=0;
  $total_price = 0;
  foreach ($_SESSION['cart'] as $item) {
    $productid = $item['productid'];
    $_SESSION['quantity'][$i] = $item['quantity'];
    $sql = "SELECT item_name, price FROM inventory WHERE productid = '$productid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['item'][$i] = $row['item_name'];
    $_SESSION['price'][$i] = $row['price'];
    $item_price = $_SESSION['price'][$i] * $_SESSION['quantity'][$i];
    $total_price = $total_price + $item_price;
    $i = $i+1;
  }




  //set price
  $_SESSION['total_price'] = $total_price;
  if(isset($_POST["check_out"])){
    header('Location: checkout.php');
  }

}


  
?>

<html>
<head>
        <link rel="stylesheet" href="landingstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>

<form name="cart_form" method="POST" action="cart.php">
  <?php if (count($_SESSION['cart']) > 0) { ?>
  <table id="table">
  <tr><th>Item Name</th><th>Quantity</th><th>Price</th><th>Remove</th></tr>
    <?php $j = 0;
    while ($j < count($_SESSION['item'])) { ?>
    <tr><td><?php echo $_SESSION["item"][$j] ?></td><td><?php echo $_SESSION["quantity"][$j]?></td><td><?php echo $_SESSION["price"][$j]?></td><td><input type="type" name="remove" value="remove"></td></tr>
    <?php $j = $j+1;} ?>
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
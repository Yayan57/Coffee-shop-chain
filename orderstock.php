<?php 
  //shows any errors on the script
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
 
    // DB connection
    $servername = "coffee-shop.mysql.database.azure.com";
    $username = "group9";
    $password = "Databases9!";
    $dbname = "pointofsales";

    $con = mysqli_init();
    mysqli_ssl_set($con, NULL, NULL, '/path/to/mysql-ca.pem', NULL, NULL);
    mysqli_real_connect($con, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }
    $branch_number = $_SESSION['branch_number'];
    // Retrieve stock information
    $sql = "SELECT * FROM inventory WHERE branchnum = $branch_number";
    $result = $con->query($sql);


    if ($result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Order Quantity</th><th></th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
        echo "<tr>";
        echo "<td>".$row['product_id']."</td>";
        echo "<td>".$row['item_name']."</td>";
        echo "<td>".$row['price']."</td>";
        echo "<td>".$row['quantity']."</td>";
        echo "<td><input type='number' name='quantity' value='1' min='1' max='".$row['quantity']."'></td>";
        echo "<td><input type='hidden' name='product_id' value='".$row['product_id']."'><input type='submit' name='order_button' value='Order'></td>";
        echo "</tr>";
        echo "</form>";
      }
      echo "</table>";
    } else {
      echo "No products found.";
    }

    // Process orders
    if (isset($_POST['order_button'])) {
      $sql = "UPDATE inventory SET quantity = quantity + '$quantity' WHERE productid = '$productid'";
    if ($con->query($sql) === TRUE) {
        header("Location: stock.php");
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $con->error;
        header("Location: stock.php?error=$error");
        exit();
    }

      // Check if there is enough stock
      $sql = "SELECT * FROM inventory WHERE branchnum = $branch_number AND product_id='$product_id'";
      $row = $result->fetch_assoc();
      $available_quantity = $row['quantity'];

      if ($order_quantity > $available_quantity) {
        echo "<p>Not enough stock available.</p>";
      } else {
        // Update stock
        $new_quantity = $available_quantity - $order_quantity;
        $sql = "UPDATE stock SET quantity='$new_quantity' WHERE product_id='$product_id'";
        if (mysqli_query($conn, $sql)) {
          echo "<p>Order placed successfully.</p>";
        } else {
          echo "Error updating record: " . mysqli_error($conn);
        }
      }
    }

    // Check if inventory is low
    $sql = "SELECT * FROM inventory WHERE branchnum = $branch_number AND quantity < 10";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
      echo "<h2>Low Inventory</h2>";
      echo "<table>";
      echo "<tr><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity</th><th></th></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['$product_id']."</td>";
        echo "<td>".$row['item_name']."</td>";
        echo "<td>".$row['price']."</td>";
        echo "<td>".$row['quantity']."</td>";
        echo "</tr>";
		}
		echo "</table>";
		} else {
		echo "<p>No products with low inventory.</p>";
		}
		?>
		
		<?php 
		  include('includes/footer.php');
		?>

<?php 
	session_start();
	if(isset($_SESSION['type']) and $_SESSION['type'] == "manager"){
	include('includes/managerheader.php');    
	}else{
	include('includes/header.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inventory</title>
</head>
<style>
    /* CSS for the inventory page */
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

table, th, td {
  border: 1px solid black;
}

th, td {
  padding: 10px;
}

th {
  background-color: #ccc;
}

input[type="text"] {
  padding: 10px;
  border: 1px solid black;
}

button[type="submit"] {
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}

</style>
<body>
	<h1>Inventory</h1>
	<form method="post" action="inventory.php">
		<label for="search">Search item:</label>
		<input type="text" id="search" name="search">
		<button type="submit">Search</button>
	</form>
	<table>
		<thead>
			<tr>
				<th>Product ID</th>
				<th>Item Name</th>
				<th>Price</th>
				<th>Quantity</th>
			</tr>
		</thead>
		<tbody>
			<?php include('inventoryp.php'); ?>
		</tbody>
	</table>
</body>
</html>


<?php 
  include('includes/footer.php');
?>
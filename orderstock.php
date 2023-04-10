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


    // Process orders
    if (isset($_POST['order_button'])) {
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
    if ($con->query($sql) === TRUE) {
        header("Location: inventory.php");
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $con->error;
        header("Location: inventory.php?error=$error");
        exit();
    }

      
      
    }

    // Check if inventory is low
    $sql = "SELECT * FROM inventory WHERE branchnum = $branch_number AND quantity < 3";
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
  include('includes/footer.php');
?>
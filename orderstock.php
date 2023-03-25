<?php 
  include('includes/header.php');


}
?>

<div>
<h1>
    Order Stock
</h1>
    <a href = "#stock"> table containing stock </a>
    <?php 
    // DB connection
    $servername = "coffee-shop.mysql.database.azure.com";
    $username = "group9";
    $password = "Databases9!";
    $dbname = "pointofsales";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve stock information
    $sql = "SELECT product_id, item_name, price, quantity FROM stock";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo "<tr><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Order Quantity</th><th></th></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
        echo "<tr>";
        echo "<td>".$row['product_id']."</td>";
        echo "<td>".$row['item_name']."</td>";
        echo "<td>".$row['price']."</td>";
        echo "<td>".$row['quantity']."</td>";
        echo "<td><input type='number' name='order_quantity' value='1' min='1' max='".$row['quantity']."'></td>";
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
      $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
      $order_quantity = mysqli_real_escape_string($conn, $_POST['order_quantity']);

      // Check if there is enough stock
      $sql = "SELECT quantity FROM stock WHERE product_id='$product_id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
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
    $sql = "SELECT product_id, item_name, price, quantity FROM stock WHERE quantity < 10";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "<h2>Low Inventory</h2>";
      echo "<table>";
      echo "<tr><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity</th><th></th></tr>";
      while ($row = mysqli_fetch_assoc($result)) {
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
		
		</div>
		<?php 
		  include('includes/footer.php');
		?>
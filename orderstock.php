<?php 
  include('includes/header.php');

  $servername = "coffee-shop.mysql.database.azure.com";
  $username = "group9";
  $password = "Databases9";
  $dbname = "pointofsales";
  
?>

<div>
<h1>
    Order Stock
</h1>
    <a href = "#stock"> table containing stock </a>
    <?php 
    // Connect to the database
	$db = new mysqli('localhost', 'username', 'password', 'database_name');

	// Check if connection was successful
	if ($db->connect_errno) {
		echo "Failed to connect to MySQL: " . $db->connect_error;
		exit();
	}

	// Retrieve the stock from the database
	$sql = "SELECT * FROM stock";
	$result = $db->query($sql);

	if ($result->num_rows > 0) {
		echo "<table>";
		echo "<tr><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Order Quantity</th><th></th></tr>";
		while($row = $result->fetch_assoc()) {
			echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
			echo "<tr>";
			echo "<td>".$row['product_id']."</td>";
			echo "<td>".$row['product_name']."</td>";
			echo "<td>".$row['price']."</td>";
			echo "<td>".$row['quantity']."</td>";
			echo "<td><input type='number' name='order_quantity' value='1' min='1' max='".($row['quantity'])."'></td>";
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
		$product_id = $_POST['product_id'];
		$order_quantity = $_POST['order_quantity'];

		// Check if there is enough stock
		$sql = "SELECT quantity FROM stock WHERE product_id='$product_id'";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		$available_quantity = $row['quantity'];

		if ($order_quantity > $available_quantity) {
			echo "<p>Not enough stock available.</p>";
		} else {
			// Update stock
			$new_quantity = $available_quantity - $order_quantity;
			$sql = "UPDATE stock SET quantity='$new_quantity' WHERE product_id='$product_id'";
			if ($db->query($sql) === TRUE) {
				echo "<p>Order placed successfully.</p>";
			} else {
				echo "Error updating record: " . $db->error;
			}
		}
	}

	// Check if inventory is low
	$sql = "SELECT product_id, quantity FROM stock WHERE quantity < 5";
	$result = $db->query($sql);

	if ($result->num_rows > 0) {
		echo "<h2>Low Inventory</h2>";
		echo "<table>";
		echo "<tr><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity</th><th></th></tr>";
		while($row = $result->fetch_assoc()) {
			$product_id = $row['product_id'];
    ?>
</div>


 
<?php 
  include('includes/footer.php');
?>
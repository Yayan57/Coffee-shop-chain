<?php 
  include('includes/managerheader.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Popular Items Report</title>
</head>
<body>
	<h1>Popular Items Report</h1>
	<form action="" method="post">
		<label for="start">Start Date:</label>
		<input type="date" name="start" required>
		<label for="end">End Date:</label>
		<input type="date" name="end" required>
		<input type="submit" value="Generate Report">
	</form>
	<br>

	<?php
	// db connections
	$servername = "coffee-shop.mysql.database.azure.com";
	$username = "group9";
	$password = "Databases9!";
	$dbname = "pointofsales";

	$conn = mysqli_init();
	mysqli_ssl_set($conn, NULL, NULL, '/path/to/mysql-ca.pem', NULL, NULL);
	mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	// receiving date range input
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$start_date = $_POST["start"];
		$end_date = $_POST["end"];

		// query to get 10 items in the date range
		$sql = "SELECT product_id, SUM(quantity) AS total_quantity 
				FROM transaction_items 
				INNER JOIN transaction_details ON transaction_items.transit_id = transaction_details.transaction_id 
				WHERE transaction_details.date BETWEEN '$start_date' AND '$end_date'
				GROUP BY product_id 
				ORDER BY total_quantity DESC 
				LIMIT 10";

		$result = $conn->query($sql);

		// generates the table with items
		if ($result->num_rows > 0) {
		  echo "<table><tr><th>Product ID</th><th>Total Quantity Sold</th></tr>";
		  while($row = $result->fetch_assoc()) {
		    echo "<tr><td>" . $row["product_id"] . "</td><td>" . $row["total_quantity"] . "</td></tr>";
		  }
		  echo "</table>";
		} else {
		  echo "No results found.";
		}
	}
	?>
</body>
</html>


<html>
<head>
	<title>Items and Customers</title>
</head>
<body>
	<h1>Report On Items and Who Buy Them</h1>
	<form action="" method="post">
		<label for="item">Item Name:</label>
		<input type="input" name="item" required>
		<input type="submit" name="gen_report" value="gen_report">
	</form>
	<br>

	<?php
	// db connections
	$servername = "coffee-shop.mysql.database.azure.com";
	$username = "group9";
	$password = "Databases9!";
	$dbname = "pointofsales";

	$conn = mysqli_init();
	mysqli_ssl_set($conn, NULL, NULL, '/path/to/mysql-ca.pem', NULL, NULL);
	mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	// receiving date range input
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if(isset($_POST['gen_report'])){
			$item = $_POST['item'];
		// query to get 10 items in the date range
			$sql = "SELECT DISTINCT customer.name, customer.email, customer.phone
					FROM pointofsales.customer,pointofsales.transaction_details,
					pointofsales.transaction_items,pointofsales.inventory
					WHERE item_name LIKE '%$item%' 
					and inventory.productid = transaction_items.product_id
					and transaction_id = transit_id and customer_user = customer.username;";

			$result = $conn->query($sql);

		// generates the table with items
			if ($result->num_rows > 0) {
				echo "<h3>Results for '$item'</h3>";
		  	echo "<table><tr><th>Name</th><th>Email</th><th>phone</th></tr>";
		  	while($row = $result->fetch_assoc()) {
		    	echo "<tr><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>". $row["phone"] . "</td></tr>";
		  	}
		  	echo "</table>";
			} else {
		  	echo "No results found.";
			}
		}
	}
	?>
</body>
</html>


<html>
<head>
	<title>Inventory Report</title>
</head>
<body>
	<h1>Inventory Report</h1>
	<form action="" method="post">
		<label for="start_date">Start Date:</label>
		<input type="date" name="start_date" required>
		<label for="end_date">End Date:</label>
		<input type="date" name="end_date" required>
		<input type="submit" value="Generate Report">
	</form>

	<?php
		// checking form submission 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];

			// get inventory on start date
			$sql_start = "SELECT productid, quantity FROM inventory";
			$result_start = mysqli_query($conn, $sql_start);
			$inventory_start = array();
			while ($row_start = mysqli_fetch_assoc($result_start)) {
				$inventory_start[$row_start['productid']] = $row_start['quantity'];
			}

			// get inventory on end date
			$sql_end = "SELECT transit_id, product_id, quantity FROM transaction_items INNER JOIN transaction_details ON transaction_items.transit_id = transaction_details.transaction_id WHERE transaction_details.date BETWEEN '$start_date' AND '$end_date'";
			$result_end = mysqli_query($conn, $sql_end);
			$inventory_end = array();
			while ($row_end = mysqli_fetch_assoc($result_end)) {
				$product_id = $row_end['product_id'];
				$quantity = $row_end['quantity'];
				if (isset($inventory_end[$product_id])) {
					$inventory_end[$product_id] += $quantity;
				} else {
					$inventory_end[$product_id] = $quantity;
				}
			}

			// creating the report
			echo "<h2>Inventory Levels</h2>";
			echo "<table><tr><th>Product ID</th><th>Item Name</th><th>Starting Quantity</th><th>Ending Quantity</th><th>Change</th></tr>";
			$sql_inventory = "SELECT productid, item_name FROM inventory";
			$result_inventory = mysqli_query($conn, $sql_inventory);
			while ($row_inventory = mysqli_fetch_assoc($result_inventory)) {
				$product_id = $row_inventory['productid'];
				$item_name = $row_inventory['item_name'];
				$start_quantity = isset($inventory_start[$product_id]) ? $inventory_start[$product_id] : 0;
				$end_quantity = isset($inventory_end[$product_id]) ? $inventory_end[$product_id] : 0;
				$change = $end_quantity - $start_quantity;
				echo "<tr><td>$product_id</td><td>$item_name</td><td>$start_quantity</td><td>$end_quantity</td><td>$change</td></tr>";
			}
			echo "</table>";
		}

		// closing db connection
		mysqli_close($conn);
	?>
</body>
</html>

<?php 
  include('includes/footer.php');
?>
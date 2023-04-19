<?php 
  include('includes/managerheader.php');
?>

<!DOCTYPE html>
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
		<input type="submit" name="report1" value="Generate Report">
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
	if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["report1"])) {
		$start_date = $_POST["start"];
		$end_date = $_POST["end"];

		// query to get 10 items in the date range, joins 3 different tables
		$sql = "SELECT i.productid, i.item_name, SUM(ti.quantity) AS total_quantity
				FROM transaction_items ti
				INNER JOIN transaction_details td ON ti.transit_id = td.transaction_id
				INNER JOIN inventory i ON ti.product_id = i.productid
				WHERE td.date BETWEEN '$start_date' AND '$end_date'
				GROUP BY i.productid
				ORDER BY total_quantity DESC
				LIMIT 10;
				";

		$result = $conn->query($sql);

		// generates the table with items
		echo "<h3>Results from '$start_date' to '$end_date'</h3>";
		if ($result->num_rows > 0) {
		  echo "<table><tr><th>Product ID</th><th>Product Name</th><th>Total Quantity Sold</th></tr>";
		  while($row = $result->fetch_assoc()) {
		    echo "<tr><td>" . $row["productid"] . "</td><td>" . $row["item_name"] . "</td><td>" . $row["total_quantity"] . "</td></tr>";
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
	<h1>Item Clients Report</h1>
	<form action="" method="post">
		<label for="item">Item Name:</label>
		<input type="input" name="item" required>
		<input type="submit" name="gen_report" value="Generate Report">
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
			$sql = "SELECT DISTINCT customer.name, customer.email, customer.phone, sum(transaction_items.quantity) as 'num'
					FROM pointofsales.customer,pointofsales.transaction_details,
					pointofsales.transaction_items,pointofsales.inventory
					WHERE item_name LIKE '%$item%' 
					and inventory.productid = transaction_items.product_id
					and transaction_id = transit_id and customer_user = customer.username
					group by customer_user;";

			$result = $conn->query($sql);

			$sql2 = "SELECT item_name, sum( transaction_items.quantity) as 'num',sum( transaction_items.quantity) * price as 'sold'
					FROM pointofsales.transaction_items,pointofsales.inventory
					WHERE item_name LIKE '%$item%' 
					and inventory.productid = transaction_items.product_id
					group by transaction_items.product_id;";

			$result2 = $conn->query($sql2);

		// generates the table with items
			if ($result->num_rows > 0) {
				echo "<h3>Results for '$item'</h3>";
		  	echo "<table><tr><th>Name</th><th>Email</th><th>phone</th><th>Quantity Purchased</th></tr>";
		  	while($row = $result->fetch_assoc()) {
		    	echo "<tr><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>". $row["phone"] . "</td><td>"
				. $row["num"] . "</td></tr>";
		  	}
		  	echo "</table>";
			$total = 0;
			while($row = $result2->fetch_assoc()){
				$total = $total + $row["sold"];
				echo "<p>".$row["num"]." ".$row["item_name"]." sold for ".$row["sold"]."$</p>";
			}
			echo "<h3>Total: ".$total."$</h3>";
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
		<label for="sort_order">Sort by:</label>
		<input type="checkbox" name="sort_order" value="asc">Understocked
		<input type="checkbox" name="sort_order" value="desc">Overstocked
		<input type="submit" name = "report2" value="Generate Report">
	</form>


	<?php
		// checking form submission 
		if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['report2'])) {
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
			echo "<h3>Results from '$start_date' to '$end_date'</h3>";

			// creating the report
			echo "<h2>Inventory Levels</h2>";
			echo "<table><tr><th>Product ID</th><th>Item Name</th><th>Starting Quantity</th><th>Ending Quantity</th><th>Change</th></tr>";
			$sql_inventory = "SELECT productid, item_name FROM inventory";
			$result_inventory = mysqli_query($conn, $sql_inventory);
			$inventory_data = array();
			while ($row_inventory = mysqli_fetch_assoc($result_inventory)) {
				$product_id = $row_inventory['productid'];
				$item_name = $row_inventory['item_name'];
				$start_quantity = isset($inventory_start[$product_id]) ? $inventory_start[$product_id] : 0;
				$end_quantity = isset($inventory_end[$product_id]) ? $inventory_end[$product_id] : 0;
				$change = $end_quantity - $start_quantity;
				$inventory_data[] = array(
					'product_id' => $product_id,
					'item_name' => $item_name,
					'start_quantity' => $start_quantity,
					'end_quantity' => $end_quantity,
					'change' => $change
				);
			}
			if(isset($_POST['sort_order']) && !empty($_POST['sort_order'])) {
				$sort_order = $_POST['sort_order'];
				usort($inventory_data, function($a, $b) use ($sort_order) {
					if ($sort_order == 'asc') {
						return $a['change'] <=> $b['change'];
					} else {
						return $b['change'] <=> $a['change'];
					}
				});
			}
			foreach ($inventory_data as $row_inventory) {
				$product_id = $row_inventory['product_id'];
				$item_name = $row_inventory['item_name'];
				$start_quantity = $row_inventory['start_quantity'];
				$end_quantity = $row_inventory['end_quantity'];
				$change = $row_inventory['change'];
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
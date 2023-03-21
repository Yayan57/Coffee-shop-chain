<?php 
  include('includes/managerheader.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Popular Items Report</title>
</head>
<body>
	<h2>Popular Items Report</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		Start Date: <input type="date" name="start_date"><br><br>
		End Date: <input type="date" name="end_date"><br><br>
		<input type="submit" name="submit" value="Generate Report">
	</form>
	<br>

	<?php
	// connect to database
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

	// get date range from user
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];

		// query to get popular items within date range
		$sql = "SELECT product_id, SUM(quantity) AS total_quantity 
				FROM transaction_items 
				INNER JOIN transaction_details ON transaction_items.transit_id = transaction_details.transaction_id 
				WHERE transaction_details.date BETWEEN '$start_date' AND '$end_date'
				GROUP BY product_id 
				ORDER BY total_quantity DESC 
				LIMIT 10";

		$result = $conn->query($sql);

		// generate HTML report
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

	// close database connection
	$conn->close();
	?>
</body>
</html>

<?php 
  include('includes/footer.php');
?>
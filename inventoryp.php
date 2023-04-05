<?php
// db connections
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
// Get the branch number of the person that is logged in
$branchnum = 1; // Example value, change as needed

// Prepare the SQL query to get the inventory
$sql = "SELECT * FROM inventory WHERE branchnum = $branchnum";

// If the search box is not empty, filter the results based on the search query
if (!empty($_POST['search'])) {
	$search = $_POST['search'];
	$sql .= " AND item_name LIKE '%$search%'";
}

// Execute the SQL query
$result = $con->query($sql);

// Display the results in the table
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row['productid'] . "</td>";
		echo "<td>" . $row['item_name'] . "</td>";
		echo "<td>" . $row['price'] . "</td>";
		echo "<td>" . $row['quantity'] . "</td>";
		echo "</tr>";
	}
} else {
	echo "<tr><td colspan='4'>No items found.</td></tr>";
}

// Close the database connection
$con->close();
?>

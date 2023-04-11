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

#setting the branch number of employee logged in
$branch_number = $_SESSION['branch_number'];

//query
$sql = "SELECT * FROM inventory WHERE branchnum = $branch_number";
#for search box
if (!empty($_POST['search'])) {
	$search = $_POST['search'];
	$sql .= " AND item_name LIKE '%$search%'";
}

//exe the sql
$result = $con->query($sql);

//display
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

//Close the database connection
$con->close();
?>

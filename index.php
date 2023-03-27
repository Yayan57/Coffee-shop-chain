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

	// query the database for some data
	$sql = "SELECT * FROM employee";
	$result = mysqli_query($conn, $sql);

	// output the results in an HTML table
	echo "<table>";
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>" . $row["bran_num"] . "</td>";
		echo "<td>" . $row["username"] . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	// close the database connection
	mysqli_close($conn);
?>


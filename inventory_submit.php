<?php
	// Connect to the database
	$servername = "coffee-shop.mysql.database.azure.com";
	$username = "group9";
	$password = "Databases9";
	$dbname = "pointofsales";

	$conn = mysqli_init();
    mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, NULL, MYSQLI_CLIENT_SSL);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Check if form is received
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Clean input
		$productid = mysqli_real_escape_string($conn, $_POST["productid"]);
		$item_name = mysqli_real_escape_string($conn, $_POST["item_name"]);
		$price = mysqli_real_escape_string($conn, $_POST["price"]);
		$quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

		// Validating before insertion
		if (!is_numeric($productid) || strlen($productid) != 7) {
			die("Invalid Product ID");
		}
		if (empty($item_name)) {
			die("Item Name cannot be empty");
		}
		if (!is_numeric($price) || $price <= 0) {
			die("Invalid Price");
		}
		if (!is_numeric($quantity) || $quantity <= 0) {
			die("Invalid Quantity");
		}

		// insertion
		$sql = "INSERT INTO inventory (productid, item_name, price, quantity)
				VALUES ('$productid', '$item_name', $price, $quantity)";

		if ($conn->query($sql) === TRUE) {
			echo "Stock added successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
    //closing connection
	$conn->close();
?>

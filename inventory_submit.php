<?php
$servername = "coffee-shop.mysql.database.azure.com";
$username = "group9";
$password = "Databases9";
$dbname = "pointofsales";

// Create connection
$con = mysqli_init();
mysqli_real_connect($con, $servername, $username, $password, $dbname, 3306, NULL, MYSQLI_CLIENT_SSL);
// Check connection
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}

// Get form data
$productid = mysqli_real_escape_string($con, $_POST['productid']);
$item_name = mysqli_real_escape_string($con, $_POST['item_name']);
$price = mysqli_real_escape_string($con, $_POST['price']);
$quantity = mysqli_real_escape_string($con, $_POST['quantity']);

// Check if item already exists
$sql = "SELECT * FROM inventory WHERE productid = '$productid'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
	// Item already exists, update quantity
	$sql = "UPDATE inventory SET quantity = quantity + '$quantity' WHERE productid = '$productid'";
	if ($con->query($sql) === TRUE)
	header("Location: index.php");
	exit();
} else {
// Item does not exist, add new item
$sql = "INSERT INTO inventory (productid, item_name, price, quantity) VALUES ('$productid', '$item_name', '$price', '$quantity')";
if ($con->query($sql) === TRUE) {
	header("Location: index.php");
	exit();
} else {
	$error = "Error: " . $sql . "<br>" . $con->error;
	header("Location: index.php?error=$error");
	exit();
}
}

$con->close();
?>

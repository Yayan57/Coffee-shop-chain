<?php 
        session_start();
		if(isset($_SESSION['type']) and $_SESSION['type'] == "customer"){
		include('includes/headeruser.php');    
		}
		else if(isset($_SESSION['type']) and $_SESSION['type'] == "manager"){
		include('includes/managerheader.php');    
		}else{
		include('includes/header.php');
		}

		ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//

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

$sql = "SELECT supplier.company_name, inventory.item_name
        FROM supplier
        INNER JOIN inventory ON supplier.product_id = inventory.productid";
$result = $con->query($sql);

// Get form data
if(isset($_POST['product_id'])){
$product_id = mysqli_real_escape_string($con, $_POST['product_id']);
}
if(isset($_POST['quantity'])){
$quantity = mysqli_real_escape_string($con, $_POST['quantity']);
}

// Check if order button was clicked
if(isset($_POST['order_button'])) {
    // update quantity
    $sql = "UPDATE inventory SET quantity = quantity + '$quantity' WHERE productid = '$product_id'";
    if ($con->query($sql) === TRUE) {
        header("Location: inventoryregister.php");
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $con->error;
        header("Location: inventoryregister.php?error=$error");
        exit();
    }
}

$con->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Order Inventory Item</title>
	<style>
		input[type="text"], input[type="number"], input[type="submit"] {
			padding: 5px;
			font-size: 18px;
			margin: 5px;
			border-radius: 5px;
			border: 1px solid #ccc;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		.error {
			color: red;
			font-size: 16px;
		}
	</style>
</head>
<body>
	<h2>Order Inventory Items</h2>
	<form method="post" action="orderstock.php">
		<label for="supplier">Select an item:</label>
			<select name="supplier" id="supplier">
				<option value="">--Select--</option>
				<?php if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()){ ?>
				<?php $str = $row["company_name"].$row["item_name"]; ?>
				<option value=".<?php $str  ?>."><?php echo $str ?></option>
				<?php }} ?>

			</select>
		<label for="quantity">Quantity:</label>
		<input type="number" name="quantity" id="quantity" min="0"><br>
		
		<input type="submit" value="order" name="order_button">

	</form>
    

	<?php if(isset($_GET['error'])) { ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
	<?php } ?>
</body>
</html>

<?php 
  include('includes/footer.php');
?>

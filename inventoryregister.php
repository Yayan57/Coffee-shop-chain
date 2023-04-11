<?php 
	session_start();
	if(isset($_SESSION['type']) and $_SESSION['type'] == "customer"){
	include('includes/headeruser.php');    
	}
	else if(isset($_SESSION['type']) and $_SESSION['type'] == "employee"){
	include('includes/employeeheader.php');    
	}else{
	include('includes/header.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Inventory Item</title>
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
	<h2>Add/View Inventory Items</h2>
	<form method="post" action="inventory_submit.php">
		<label for="productid">Product ID:</label>
		<input type="text" name="productid" id="productid" pattern="[0-9]{7}" title="Please enter a 7-digit number." required><br>
		<label for="item_name">Item Name:</label>
		<input type="text" name="item_name" id="item_name" maxlength="45" required><br>
		<label for="price">Price:</label>
		<input type="number" name="price" id="price" step="0.01" min="0" required><br>
		<label for="quantity">Quantity:</label>
		<input type="number" name="quantity" id="quantity" min="0" required><br>
		<label for="branchnum">Branch Number:</label>
		<input type="text" name="branchnum" id="branchnum" pattern="[0-9]{3}" title="Please enter a 3-digit number." required><br>

		<input type="submit" value="Add Item">
		<input type="submit" value="Delete Item" name="delete">

	</form>

	<input type="submit" value="View Inventory" href="#about" onclick="window.location.href = 'inventory.php';">

	<?php if(isset($_GET['error'])) { ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
	<?php } ?>
</body>
</html>

<?php 
  include('includes/footer.php');
?>

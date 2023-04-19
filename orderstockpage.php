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
		<label for="inventory">Select an item:</label>
			<select name="inventory" id="inventory">
				<option value="">--Select--</option>
				<?php
				$sql = "SELECT supplier.company_name, inventory.item_name
				FROM supplier
				INNER JOIN inventory ON supplier.product_id = inventory.productid";
				$result = $conn->query($sql);
				
				//Loop through items and add them to the dropdown list
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo "<option value='" . $row["company_name"] . " '> " . $row["item_name"] . "</option>";
					}
				} else {
					echo "0 results";
				}
			?>
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

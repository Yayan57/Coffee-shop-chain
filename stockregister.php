<?php 
  include('includes/header.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Stock</title>
	<style>
		input[type="text"], input[type="number"], input[type="submit"] {
			display: block;
			margin: 10px;
		}
	</style>
</head>
<body>
	<h1>Add Stock</h1>
	<form method="post" action="inventory_submit.php">
		<label for="productid">Product ID:</label>
		<input type="text" name="productid" required>

		<label for="item_name">Item Name:</label>
		<input type="text" name="item_name" required>

		<label for="price">Price:</label>
		<input type="number" name="price" min="0.01" step="0.01" required>

		<label for="quantity">Quantity:</label>
		<input type="number" name="quantity" min="1" required>

		<input type="submit" name="submit" value="Add Stock">
	</form>
</body>
</html>


<?php 
  include('includes/footer.php');
?>
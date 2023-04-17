<?php 
	if (!isset($_SESSION['managerid'])) {
        header("Location: managerlogin.php");
        exit();
    }
      if(isset($_SESSION['type']) and $_SESSION['type'] == "manager"){
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
	<h2>Order/View Inventory Items</h2>
    <label for="branchnum">Location:</label>
	<input type="text" name="branchnum" id="branchnum" pattern="[0-9]{3}" title="Please enter a 3-digit number." required><br>
	<form method="post" action="stock.php">
		<label for="item_name">Item Name:</label>
		<input type="submit" name="item_name" id="item_name" maxlength="45"><br>
		<label for="price">Price:</label>
		<label for="quantity">Quantity:</label>
		<input type="number" name="quantity" id="quantity" min="0"><br>
		
		<input type="submit" value="order_button">

	</form>
    <h3> Submitted Order </h3>
    <table>
		<thead>
			<tr>
				<th>Item Name</th>
				<th>Price</th>
				<th>Quantity</th>
			</tr>
		</thead>
		<tbody>
			<?php include('orderstock.php'); ?>
		</tbody>
	</table>

	<?php if(isset($_GET['error'])) { ?>
		<p class="error"><?php echo $_GET['error']; ?></p>
	<?php } ?>
</body>
</html>

<?php 
  include('includes/footer.php');
?>

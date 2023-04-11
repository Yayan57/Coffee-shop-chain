<?php 
	session_start();
	if(isset($_SESSION['type']) and $_SESSION['type'] == "employee"){
	include('includes/employeeheader.php');    
	}else{
	include('includes/header.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inventory</title>
</head>
<style>
    /* CSS for the inventory page */
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

table, th, td {
  border: 1px solid black;
}

th, td {
  padding: 10px;
}

th {
  background-color: #ccc;
}

input[type="text"] {
  padding: 10px;
  border: 1px solid black;
}

button[type="submit"] {
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}

</style>
<body>
	<h1>Inventory</h1>
	<form method="post" action="inventory.php">
		<label for="search">Search item:</label>
		<input type="text" id="search" name="search">
		<button type="submit">Search</button>
	</form>
	<table>
		<thead>
			<tr>
				<th>Product ID</th>
				<th>Item Name</th>
				<th>Price</th>
				<th>Quantity</th>
			</tr>
		</thead>
		<tbody>
			<?php include('inventoryp.php'); ?>
		</tbody>
	</table>
</body>
</html>


<?php 
  include('includes/footer.php');
?>
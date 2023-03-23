<?php 
  include('includes/managerheader.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Manager Dashboard</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .sidebar {
	background-color: #f0f0f0;
	padding: 20px;
	width: 200px;
	float: left;
	height: 100%;
    }
    .sidebar h3 {
        margin-top: 0;
    }
    .sidebar ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    .sidebar li {
        margin-bottom: 10px;
    }
    .sidebar a {
        display: block;
        padding: 10px;
        background-color: #ccc;
        color: #000;
        text-decoration: none;
    }
    .sidebar a:hover {
        background-color: #555;
        color: #fff;
    }
    .main-content {
        margin-left: 220px;
        padding: 20px;
    }
    </style>
</head>
<body>
	<div class="sidebar">
		<h3>Dashboard</h3>
		<ul>
			<li><a href="inventoryregister.php">Stock Register</a></li>
			<li><a href="reports.php">Reports</a></li>
			<li><a href="order_stock.php">Order Stock</a></li>
		</ul>
	</div>

	<div class="main-content">
		<h1>Welcome to the Manager Dashboard</h1>
		<p>Please select an option from the sidebar.</p>
	</div>
</body>
</html>
<?php 
  include('includes/footer.php');
?>

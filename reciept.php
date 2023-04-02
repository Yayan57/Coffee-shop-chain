<?php 
  include('includes/header.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		h1, h2, p {
			color: #000;
			text-align: left; /* changed text alignment to left */
			margin-left: 20px; /* added left margin */
		}

		table {
			border-collapse: collapse;
			margin-left: 20px; /* added left margin */
		}

		table, th, td {
			border: 1px solid black;
			padding: 10px;
		}

		th {
			background-color: #ddd;
		}
	</style>
</head>
<body>
	<h1>Receipt</h1>
	<table>
		<tr>
			<th>Transaction ID:</th>
			<td>12345</td>
		</tr>
		<tr>
			<th>Time/Date:</th>
			<td>March 21, 2023 3:45 PM</td>
		</tr>
		<tr>
			<th>Total:</th>
			<td>$12.95</td>
		</tr>
		<tr>
			<th>Payment Method:</th>
			<td>Credit Card</td>
		</tr>
		<tr>
			<th>Email:</th>
			<td>johndoe@example.com</td>
		</tr>
		<tr>
			<th>Cart:</th>
			<td>
				<ul>
					<li>Coffee (x2)</li>
					<li>Latte (x1)</li>
					<li>Croissant (x1)</li>
				</ul>
			</td>
		</tr>
	</table>
</body>
</html>

<?php 
  include('includes/footer.php');
?>

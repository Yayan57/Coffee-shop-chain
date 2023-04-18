<?php 
  include('includes/header.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Coffee Shop Virtual Register</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #693311;
		}

		h1, h2 {
			color: #fff;
			text-align: center;
		}

		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
		}

		li {
			padding: 10px;
			background-color: #fff;
			margin-bottom: 5px;
			border-radius: 5px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
		}

		label {
			font-weight: bold;
		}

		form {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-top: 20px;
		}

		button[type="submit"] {
			background-color: #fff;
			color: #693311;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			transition: background-color 0.2s;
		}

		button[type="submit"]:hover {
			background-color: #eee;
		}
	</style>
</head>
<body>
	<h1>Coffee Shop Virtual Register</h1>

	<h2>Beverages</h2>
	<ul>
		<li>
			<input type="checkbox" name="beverage" value="coffee" id="coffee">
			<label for="coffee">Coffee</label>
            <input type="number" name="coffee-quantity" value="0" min="0">
		</li>
		<li>
			<input type="checkbox" name="beverage" value="latte" id="latte">
			<label for="latte">Latte</label>
            <input type="number" name="latte-quantity" value="0" min="0">
		</li>
		<li>
			<input type="checkbox" name="beverage" value="cappuccino" id="cappuccino">
			<label for="cappuccino">Cappuccino</label>
            <input type="number" name="cappuccino-quantity" value="0" min="0">
		</li>
	</ul>

	<h2>Foods</h2>
	<ul>
		<li>
			<input type="checkbox" name="food" value="croissant" id="croissant">
			<label for="croissant">Croissant</label>
            <input type="number" name="croissant-quantity" value="0" min="0">
		</li>
		<li>
			<input type="checkbox" name="food" value="muffin" id="muffin">
			<label for="muffin">Muffin</label>
            <input type="number" name="muffin-quantity" value="0" min="0">
		</li>
		<li>
			<input type="checkbox" name="food" value="bagel" id="bagel">
			<label for="bagel">Bagel</label>
            <input type="number" name="bagel-quantity" value="0" min="0">
		</li>
	</ul>

	<h2>Cart</h2>
	<ul id="cart"></ul>

	<h2>Checkout</h2>
	<form>
		<label for="payment-method">Payment Method:</label>
		<select id="payment-method" name="payment-method">
			<option value="card">Card</option>
			<option value="cash">Cash</option>
		</select>
		<br>
		<button type="submit">Pay Now</button>
	</form>

	<script>
		const beverages = document.getElementsByName("beverage");
		const foods = document.getElementsByName("food");
		const cart = document.getElementById("cart");

		function updateCart() {
			cart.innerHTML = "";
			beverages.forEach(beverage => {
				if (beverage.checked) {
					const li = document.createElement("li");
					li.innerText = beverage.value;
					cart.appendChild(li);
				}
			});
			foods.forEach(food => {
				if (food.checked) {
					const li = document.createElement("li");
					li.innerText = food.value;
					cart.appendChild(li);
				}
			});
		}

		beverages.forEach(beverage => {
			beverage.addEventListener("click", updateCart);
		});

		foods.forEach(food => {
			food.addEventListener("click", updateCart);
		});
	</script>
</body>
</html>

<?php 
  include('includes/footer.php');
?>

<?php 
  session_start();
  if(isset($_SESSION['type']) and $_SESSION['type'] == "customer"){
    include('includes/headeruser.php');    
  }else{
    include('includes/header.php');
  } 
?>
<?php

    $servername = "coffee-shop.mysql.database.azure.com";
    $username = "group9";
    $password = "Databases9!";
    $dbname = "pointofsales";

    $conn = mysqli_init();
    mysqli_ssl_set($conn, NULL, NULL, '/path/to/mysql-ca.pem', NULL, NULL);
    mysqli_real_connect($conn, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the value of the "fruits" array from the HTML form
    $cart = isset($_POST['cart']) ? $_POST['cart'] : [];

    // Loop through each fruit in the array
    foreach ($cart as $item) {
        $sql = "UPDATE inventory
                SET quantity = quantity - 1
                WHERE item_name LIKE CONCAT(TRIM(SUBSTRING_INDEX('$item', ':', 1)), ': ', 
                    TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX('$item', ':', -1), ' - ', 1)));";
        mysqli_query($conn, $sql);
    }
    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="cstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Menu - Coffee Shop</title>
	<style>
	  .container {
        display: flex;
        justify-content: space-between;
      }
      .left-column,
      .right-column {
        width: 200px;
        padding: 20px;
        border: 1px solid #ccc;
        margin: 0 10px;
      }
      .output-item {
        margin-bottom: 10px;
      }
      .remove-button {
        font-size: 0.8em;
        padding: 2px 5px;
      }
    </style>
    <script>
    //gets the selected dropdown value and appends it to the output area
      var total  = 0;
      var cart = [];
      function displaySelectedValue(dropdownId) {
    //get value from dropdown
        var dropdown = document.getElementById(dropdownId);
        var output = document.getElementById("output-area");
        var totaloutput = document.getElementById("output-area");
    //store value in array
        var selectedValue = dropdown.value;
        cart.push(selectedValue);
    //update price
        var num = Number(selectedValue.match(/\d+\.\d+$/)[0]);
        total = total + num;
    //ouput item mto cart
        var newOutput = document.createElement("div");
        newOutput.className = "output-item";
        newOutput.innerHTML = selectedValue + " ";
    //'remove' button
        var removeButton = document.createElement("button");
        removeButton.className = "remove-button";
        removeButton.innerHTML = "Remove";
        removeButton.onclick = function() {
        //remove 'remove' button
            newOutput.parentNode.removeChild(newOutput);
            removeButton.parentNode.removeChild(removeButton);
        //update price
            total = total - num;
            var totalstrng = "$"+total+"0"
            var totalstring = document.getElementById("output-area-2");
            totalstring.innerHTML = "$"+total;
        //remove item from cart
            var index = cart.indexOf(selectedOption);
            if (index > -1) {
                cart.splice(index, 1);
            }    
        };
        newOutput.appendChild(removeButton);
        output.appendChild(newOutput);
    //output price
        var totalstrng = "$"+total+"0"
        var totalstring = document.getElementById("output-area-2");
        totalstring.innerHTML = "$"+total;
      }
    </script>
</head>
<body>
<div class="container">
    <div class = "left-section">
        <main>
            <h2>Menu</h2>
            <section>
                <h3>Coffee</h3>
                <ul>
                    <li>Espresso</li>
                        <label for="espresso-dropdown"></label>
                        <select id="espresso-dropdown">
                            <option value="Espresso Small - $2.50">Small - $2.50</option>
                            <option value="Espresso Medium - $3.50">Medium - $3.50</option>
                            <option value="Espresso Large - $4.50">Large - $4.50</option>
                        </select>
                        <button onclick="displaySelectedValue('espresso-dropdown')">Add to cart</button>
                    <li>Americano</li>
                        <label for="americano-dropdown"></label>
                        <select id="americano-dropdown">
                            <option value="Americano Small - $3.00">Small - $3.00</option>
                            <option value="Americano Medium - $4.00">Medium - $4.00</option>
                            <option value="Americano Large - $3.00">Large - $3.00</option>
                        </select>
                        <button onclick="displaySelectedValue('americano-dropdown')">Add to cart</button>
                    <li>Cappuccino</li>
                        <label for="capp-dropdown"></label>
                        <select id="capp-dropdown">
                            <option value="Cappuccino Small - $4.00">Small - $4.00</option>
                            <option value="Cappuccino Medium - $5.00">Medium - $5.00</option>
                            <option value="Cappuccino Large - $6.00">Large - $6.00</option>
                        </select>
                        <button onclick="displaySelectedValue('capp-dropdown')">Add to cart</button>
                    <li>Latte</li>
                        <label for="latte-dropdown"></label>
                        <select id="latte-dropdown">
                            <option value="Latte Small - $4.50">Small - $4.50</option>
                            <option value="Latte Medium - $5.50">Medium - $5.50</option>
                            <option value="Latte Large - $6.50">Large - $6.50</option>
                        </select>
                        <button onclick="displaySelectedValue('latte-dropdown')">Add to cart</button>
                    <li>Mocha</li>
                        <label for="mocha-dropdown"></label>
                        <select id="mocha-dropdown">
                            <option value="Mocha Small - $5.00">Small - $5.00</option>
                            <option value="Mocha Medium - $6.00">Medium - $6.00</option>
                            <option value="Mocha Large - $7.00">Large - $7.00</option>
                        </select>
                        <button onclick="displaySelectedValue('mocha-dropdown');storeSelection()">Add to cart</button>
                </ul>
            </section>
            <section>
                <h3>Tea</h3>
                <ul>
                    <li>Green Tea</li>
                        <label for="green-dropdown"></label>
                        <select id="green-dropdown">
                            <option value="Green Tea Small - $3.50">Small - $3.50</option>
                            <option value="Green Tea Medium - $4.50">Medium - $4.50</option>
                            <option value="Green Tea Large - $5.50">Large - $5.50</option>   
                        </select>
                        <button onclick="displaySelectedValue('green-dropdown')">Add to cart</button>
                    <li>Black Tea</li>
                        <label for="black-dropdown"></label>
                        <select id="black-dropdown">
                            <option value="Black Tea Small - $3.50">Small - $3.50</option>
                            <option value="Black Tea Medium - $4.50">Medium - $4.50</option>
                            <option value="Black Tea Large - $5.50">Large - $5.50</option> 
                        </select>
                        <button onclick="displaySelectedValue('black-dropdown')">Add to cart</button>
                    <li>Chai Tea</li>
                        <label for="chai-dropdown"></label>
                        <select id="chai-dropdown">
                            <option value="Chai Tea Small - $4.50">Small - $4.50</option>
                            <option value="Chai Tea Medium - $5.50">Medium - $5.50</option>
                            <option value="Chai Tea Large - $6.50">Large - $6.50</option>
                        </select>
                        <button onclick="displaySelectedValue('chai-dropdown')">Add to cart</button>
                    <li>Herbal Tea</li>
                        <label for="herb-dropdown"></label>
                        <select id="herb-dropdown">
                            <option value="Herbal Tea Small - $3.50">Small - $3.50</option>
                            <option value="Herbal Tea Medium - $4.50">Medium - $4.50</option>
                            <option value="Herbal Tea Large - $5.50">Large - $5.50</option> 
                        </select>
                        <button onclick="displaySelectedValue('herb-dropdown')">Add to cart</button>
                </ul>
            </section>
            <section>
                <h3>Snacks</h3>
                <ul>
                    <label for="snack-dropdown"></label>
                    <select id="snack-dropdown">
                        <option value="Plain Croissant - $3.00">Plain Croissant - $3.00</option>
                        <option value="Chocolate Chip Muffin - $2.50">Chocolate Chip Muffin - $2.50</option>
                        <option value="Blueberry Scone - $3.50">Blueberry Scone - $3.50</option> 
                        <option value="Chocolate Chip Cookie - $1.50">Chocolate Chip Cookie - $1.50</option> 
                    </select>
                    <button onclick="displaySelectedValue('snack-dropdown')">Add to cart</button>
                </ul>
    </div>
    <div class = "right-section">
        <main>
        <h4>Select store: </h4>
        <label for="loc-dropdown"></label>
                    <select id="loc-dropdown">
                        <option value="1">Location 1</option>
                        <option value="2">Location 2</option>
                    </select>
                    <button onclick="displaylocation('loc-dropdown')">Confirm</button>
                    
                    <script>
                    var locdropdown = document.getElementById("loc-dropdown");
                    var selectedValue = locdropdown.options[locdropdown.selectedIndex].text;
                    function displaylocation() {
                        var locdropdown = document.getElementById("loc-dropdown");
                        var selectedValue = locdropdown.options[locdropdown.selectedIndex].text;
                        document.getElementById("selectedValue").innerHTML = selectedValue;
                    }
                    function OrderCheck(){
                        if(total < 1 && locdropdown == null) {alert("Select items and location");}
                        else if(total > 0 && locdropdown == null){alert("Select location");}
                        else if(total < 1 && locdropdown !== null){alert("Select items");}
                    }
                    </script>
            </section>
        </main>
            <h2>Cart</h2>
            <div id = "output-area"> </div>
            <h3>Order details: </h3>
            <h4>Total:</h4>
            <div id = "output-area-2"></div>
            <h4>Location:</h4><p id="selectedValue"></p>
            <button id = "placeOrder" onclick = "OrderCheck()">Place Order</button>
        </main>
    </div>
    </div>
</body>
</html>

<?php 
  include('includes/footer.php');
?>
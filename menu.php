<?php 
  session_start();
  if(isset($_SESSION['type']) and $_SESSION['type'] == "customer"){
    include('includes/headeruser.php');    
  }else{
    include('includes/header.php');
  } 
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
      // This JavaScript code gets the selected dropdown value and appends it to the output area
      var total  = 0;
      function displaySelectedValue(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        var output = document.getElementById("output-area");
        var totaloutput = document.getElementById("output-area");
        var selectedValue = dropdown.value;
        var num = Number(selectedValue.match(/\d+\.\d+$/)[0]);
        total = total + num;
        var newOutput = document.createElement("div");
        newOutput.className = "output-item";
        newOutput.innerHTML = selectedValue + " ";
        var removeButton = document.createElement("button");
        removeButton.className = "remove-button";
        removeButton.innerHTML = "Remove";
        removeButton.onclick = function() {
        newOutput.parentNode.removeChild(newOutput);
        removeButton.parentNode.removeChild(removeButton);
        total = total - num;
        var totalstrng = "$"+totaloutput+"0"
        var totalstring = document.getElementById("output-area-2");
        totalstring.innerHTML = "$"+total;
        removeSelection();
        };
        newOutput.appendChild(removeButton);
        output.appendChild(newOutput);
        var totalstrng = "$"+totaloutput+"0"
        var totalstring = document.getElementById("output-area-2");
        totalstring.innerHTML = "$"+total;
      }

    var selections = [];
    function storeSelection() {
        var dropdown = document.getElementById("myDropdown");
        var selectedOption = dropdown.options[dropdown.selectedIndex].value;
        selections.push(selectedOption);
        var outputElement = document.getElementById("selectionsOutput");
        outputElement.innerHTML = selections.join(", ");
        }

    function removeSelection() {
        var dropdown = document.getElementById("myDropdown");
        var selectedOption = dropdown.options[dropdown.selectedIndex].value;
        var index = selections.indexOf(selectedOption);
        if (index > -1) {
            selections.splice(index, 1);
        }
        var outputElement = document.getElementById("selectionsOutput");
        outputElement.innerHTML = selections.join(", ");
        }
    
    function placeOrder(){
        
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
                            <option value="Espresso: Small - $2.50">Small - $2.50</option>
                            <option value="Espresso: Medium - $3.50">Medium - $3.50</option>
                            <option value="Espresso: Large - $4.50">Large - $4.50</option>
                        </select>
                        <button onclick="displaySelectedValue('espresso-dropdown')">Add to cart</button>
                    <li>Americano</li>
                        <label for="americano-dropdown"></label>
                        <select id="americano-dropdown">
                            <option value="Americano: Small - $3.00">Small - $3.00</option>
                            <option value="Americano: Medium - $4.00">Medium - $4.00</option>
                            <option value="Americano: Large - $3.00">Large - $3.00</option>
                        </select>
                        <button onclick="displaySelectedValue('americano-dropdown')">Add to cart</button>
                    <li>Cappuccino</li>
                        <label for="capp-dropdown"></label>
                        <select id="capp-dropdown">
                            <option value="Cappuccino: Small - $4.00">Small - $4.00</option>
                            <option value="Cappuccino: Medium - $5.00">Medium - $5.00</option>
                            <option value="Cappuccino: Large - $6.00">Large - $6.00</option>
                        </select>
                        <button onclick="displaySelectedValue('capp-dropdown')">Add to cart</button>
                    <li>Latte</li>
                        <label for="latte-dropdown"></label>
                        <select id="latte-dropdown">
                            <option value="Latte: Small - $4.50">Small - $4.50</option>
                            <option value="Latte: Medium - $5.50">Medium - $5.50</option>
                            <option value="Latte: Large - $6.50">Large - $6.50</option>
                        </select>
                        <button onclick="displaySelectedValue('latte-dropdown')">Add to cart</button>
                    <li>Mocha</li>
                        <label for="mocha-dropdown"></label>
                        <select id="mocha-dropdown">
                            <option value="Mocha: Small - $5.00">Small - $5.00</option>
                            <option value="Mocha: Medium - $6.00">Medium - $6.00</option>
                            <option value="Mocha: Large - $7.00">Large - $7.00</option>
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
                            <option value="Green Tea: Small - $3.50">Small - $3.50</option>
                            <option value="Green Tea: Medium - $4.50">Medium - $4.50</option>
                            <option value="Green Tea: Large - $5.50">Large - $5.50</option>   
                        </select>
                        <button onclick="displaySelectedValue('green-dropdown')">Add to cart</button>
                    <li>Black Tea</li>
                        <label for="black-dropdown"></label>
                        <select id="black-dropdown">
                            <option value="Black Tea: Small - $3.50">Small - $3.50</option>
                            <option value="Black Tea: Medium - $4.50">Medium - $4.50</option>
                            <option value="Black Tea: Large - $5.50">Large - $5.50</option> 
                        </select>
                        <button onclick="displaySelectedValue('black-dropdown')">Add to cart</button>
                    <li>Chai Tea</li>
                        <label for="chai-dropdown"></label>
                        <select id="chai-dropdown">
                            <option value="Chai Tea: Small - $4.50">Small - $4.50</option>
                            <option value="Chai Tea: Medium - $5.50">Medium - $5.50</option>
                            <option value="Chai Tea: Large - $6.50">Large - $6.50</option>
                        </select>
                        <button onclick="displaySelectedValue('chai-dropdown')">Add to cart</button>
                    <li>Herbal Tea</li>
                        <label for="herb-dropdown"></label>
                        <select id="herb-dropdown">
                            <option value="Herbal Tea: Small - $3.50">Small - $3.50</option>
                            <option value="Herbal Tea: Medium - $4.50">Medium - $4.50</option>
                            <option value="Herbal Tea: Large - $5.50">Large - $5.50</option> 
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
                    function displaylocation() {
                        var dropdown = document.getElementById("loc-dropdown");
                        var selectedValue = dropdown.options[dropdown.selectedIndex].text;
                        document.getElementById("selectedValue").innerHTML = selectedValue;
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
            <button>Place Order</button>
        </main>
    </div>
    </div>
</body>
</html>

<?php 
  include('includes/footer.php');
?>
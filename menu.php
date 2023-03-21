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
        totalstring.innerHTML = "$"+total+".0";
        };
        newOutput.appendChild(removeButton);
        output.appendChild(newOutput);
        var totalstrng = "$"+totaloutput+"0"
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
                        <button onclick="displaySelectedValue('mocha-dropdown')">Add to cart</button>
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
            </section>
        </main>
    </div>
    <div class = "right-section">
        <main>
            <h2>Cart</h2>
            <div id = "output-area"> </div>
            <h3>Total: </h3>
            <div id = "output-area-2"></div>
        </main>
    </div>
    </div>
</body>
</html>
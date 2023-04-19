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
    //gets the selected dropdown value and appends it to the output area
      var total  = 0;
      var itemcount = 0;
      var cart = [];
      var done;
      var branch = 0;
      function displaySelectedValue(dropdownId) {
    //get value from dropdown
        var dropdown = document.getElementById(dropdownId);
        var output = document.getElementById("output-area");
    //store value in array
        var selectedValue = dropdown.value;
        cart.push(selectedValue);
    //update price
        var num = Number(selectedValue.match(/\d+\.\d+$/)[0]);
        total = total + num;
        itemcount++;
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
            itemcount--;
            var totalstrng = "$"+total+"0"
            var totalstring = document.getElementById("output-area-2");
            totalstring.innerHTML = "$"+total;
        //remove item from cart
            var index = cart.indexOf(selectedValue);
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
                        <option value = 1>123 Main St, Houston, TX</option>
                        <option value = 2>456 Elm St, Houston, TX</option>
                        <option value = 3>789 Oak St, Houston, TX</option>
                    </select>
                    <button onclick="displaylocation('loc-dropdown')">Confirm</button>
                    
                    <script>
                    var locdropdown = document.getElementById("loc-dropdown");
                    var selectedValue = locdropdown.options[locdropdown.selectedIndex].text;
                    var loc = false;
                    function displaylocation() {
                        var locdropdown = document.getElementById("loc-dropdown");
                        branch = locdropdown;
                        var selectedValue = locdropdown.options[locdropdown.selectedIndex].text;
                        loc = true;
                        document.getElementById("selectedValue").innerHTML = selectedValue;
                    }
                    function OrderCheck(){
                        if(total < 1 && loc == false) {alert("Select items and location");}
                        else if(total > 1 && loc == false){alert("Select location");}
                        else if(total < 1 && loc == true){alert("Select items");}
                        else if(total > 1 && loc == true){
                            alert("Order Placed!");
                        }
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
            <form id="myForm" formname="myForm" action="menu2process.php" method="POST">
                <input type="hidden" name="cart" id="cart">
                <input type="hidden" name="branch" id="branch">
                <input type="hidden" name="itemcount" id="itemcount">
                <input type="hidden" name="total" id="total">
                <input type="submit" onclick="OrderCheck()" name="order" value="Place Order">
                </form>
/
            <script>
                if (!localStorage.getItem("formSubmitted")) {
                    // Set form values
                    document.getElementById("cart").value = cart;
                    document.getElementById("branch").value = branch;
                    document.getElementById("itemcount").value = itemcount;
                    document.getElementById("total").value = total;
                    
                    // Submit form using POST
                    var form = document.getElementById("myForm");
                    form.method = "POST";
                    form.submit();
                    
                    localStorage.setItem("formSubmitted", true);
                }
            </script>
        </main>
    </div>
    </div>
</body>
</html>
<?php 
/*TRIGGER CODE FOR REFERENCE
'BEGIN
  DECLARE count INT;
  DECLARE branchno INT;
  -- Get branch number of the transaction
  SELECT transaction_details.branchN INTO branchno
  FROM transaction_details
  WHERE transaction_details.transaction_id = NEW.transit_id;
  -- Count number of items in the transaction
  SELECT COUNT(*) INTO count
  FROM transaction_items
  WHERE transaction_items.transit_id = NEW.transit_id;
  -- If there are more than 10 items in the transaction, send a message
  IF count > 10 THEN
    INSERT INTO messages (sender, recipient, message_text, timestamp, branchno)
    VALUES (''System'', ''Manager'', CONCAT(''Transaction '', NEW.transit_id, '' has more than 10 items.''), NOW(), branchno);
  END IF;
END'
*/
  include('includes/footer.php');
?>
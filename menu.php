<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="cstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Menu - Coffee Shop</title>
	<style>
      /* This CSS code sets the color of the first option to grey */
      option:first-child {
        color: grey;
      }
	  .container {
        display: flex;
        justify-content: space-between;
      }
      /* This CSS code styles the left and right columns */
      .left-column,
      .right-column {
        width: 200px;
        padding: 20px;
        border: 1px solid #ccc;
        margin: 0 10px;
      }
    </style>
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
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $2.50</option>
                            <option value="2">Medium - $3.50</option>
                            <option value="3">Large - $4.50</option>
                        </select>
                        <button>Add to cart</button>
                    <li>Americano</li>
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $3.00</option>
                            <option value="2">Medium - $4.00</option>
                            <option value="3">Large - $3.00</option>
                        </select>
                        <button>Add to cart</button>
                    <li>Cappuccino</li>
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $4.00</option>
                            <option value="2">Medium - $5.00</option>
                            <option value="3">Large - $6.00</option>
                        </select>
                        <button>Add to cart</button>
                    <li>Latte</li>
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $4.50</option>
                            <option value="2">Medium - $5.50</option>
                            <option value="3">Large - $6.50</option>
                        </select>
                        <button>Add to cart</button>
                    <li>Mocha</li>
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $5.00</option>
                            <option value="2">Medium - $6.00</option>
                            <option value="3">Large - $7.00</option>
                        </select>
                        <button>Add to cart</button>
                </ul>
            </section>
            <section>
                <h3>Tea</h3>
                <ul>
                    <li>Green Tea</li>
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $3.50</option>
                            <option value="2">Medium - $4.50</option>
                            <option value="3">Large - $5.50</option>   
                        </select>
                        <button>Add to cart</button>
                    <li>Black Tea</li>
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $3.50</option>
                            <option value="2">Medium - $4.50</option>
                            <option value="3">Large - $5.50</option> 
                        </select>
                        <button>Add to cart</button>
                    <li>Chai Tea</li>
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $4.50</option>
                            <option value="2">Medium - $5.50</option>
                            <option value="3">Large - $6.50</option>
                        </select>
                        <button>Add to cart</button>
                    <li>Herbal Tea</li>
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $3.50</option>
                            <option value="2">Medium - $4.50</option>
                            <option value="3">Large - $5.50</option> 
                        </select>
                        <button>Add to cart</button>
                </ul>
            </section>
            <section>
                <h3>Snacks</h3>
                <ul>
                    <li>Plain Croissant - $3.00</li>
                        <select>
                            <option value="0">Quantity</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button>Add to cart</button>
                    <li>Chocolate Chip Muffin - $2.50</li>
                        <select>
                            <option value="0">Quantity</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button>Add to cart</button>
                    <li>Blueberry Scone - $3.50</li>
                        <select>
                            <option value="0">Quantity</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button>Add to cart</button>
                    <li>Chocolate Chip Cookie - $1.50</li>
                        <select>
                            <option value="0">Quantity</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button>Add to cart</button>
                </ul>
            </section>
        </main>
    </div>
    <div class = "right-section">
        <main>
            <h2>Cart</h2>
            <section>
                <h3>Coffee</h3>
                <ul>
                    <li>Espresso</li>
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $2.50</option>
                            <option value="2">Medium - $3.50</option>
                            <option value="3">Large - $4.50</option>
                        </select>
                        <button>Add to cart</button>
                </ul>
            </section>
            <section>
                <h3>Tea</h3>
                <ul>
                    <li>Green Tea</li>
                        <select>
                            <option value="0">Size - Price</option>
                            <option value="1">Small - $3.50</option>
                            <option value="2">Medium - $4.50</option>
                            <option value="3">Large - $5.50</option>   
                        </select>
                        <button>Add to cart</button>
                </ul>
            </section>
            <section>
                <h3>Snacks</h3>
                <ul>
                    <li>Plain Croissant - $3.00</li>
                        <select>
                            <option value="0">Quantity</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button>Add to cart</button>
                </ul>
            </section>
        </main>
    </div>
    </div>
</body>
</html>
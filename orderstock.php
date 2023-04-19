<?php
//shows any errors on the script
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//

// db connections
$servername = "coffee-shop.mysql.database.azure.com";
$username = "group9";
$password = "Databases9!";
$dbname = "pointofsales";

$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL, '/path/to/mysql-ca.pem', NULL, NULL);
mysqli_real_connect($con, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}


// Get form data
$productid = mysqli_real_escape_string($con, $_POST['productid']);
$item_name = mysqli_real_escape_string($con, $_POST['item_name']);
$price = mysqli_real_escape_string($con, $_POST['price']);
$quantity = mysqli_real_escape_string($con, $_POST['quantity']);
$branchnum = mysqli_real_escape_string($con, $_POST['branchnum']);

$sql = "SELECT supplier.company_name, inventory.item_name
        FROM supplier
        INNER JOIN inventory ON supplier.product_id = inventory.productid";
$result = $conn->query($sql);

//Loop through items and add them to the dropdown list
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["company_name"] . "'>" . $row["item_name"] . "</option>";
    }
}

// Check if order button was clicked
if(isset($_POST['order_button'])) {
    // update quantity
    $sql = "UPDATE inventory SET quantity = quantity + '$quantity' WHERE productid = '$productid'";
    if ($con->query($sql) === TRUE) {
        header("Location: inventoryregister.php");
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $con->error;
        header("Location: inventoryregister.php?error=$error");
        exit();
    }
}

$con->close();
?>
<?php
session_start();

//check if the employee is logged in
if (!isset($_SESSION['employee_id'])) {
    header("Location: login.php");
    exit();
}

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


// get the employee's branch number from the session
$branch_number = $_SESSION['branch_number'];

// query to get all the transactions for the employee's branch
$sql = "SELECT * FROM transaction_details td
        INNER JOIN transaction_items ti ON td.transaction_id = ti.transit_id
        WHERE td.branchN = '$branch_number'
        ORDER BY td.date DESC, td.time DESC";

$result = mysqli_query($con, $sql);
include('includes/employeeheader.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Home</title>
</head>
<body>
    <h1>Welcome, Employee!</h1>
    <p>Branch Number: <?php echo $branch_number; ?></p>
    <h2>Orders Received:</h2>
    <table>
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Customer User</th>
                <th>Date</th>
                <th>Time</th>
                <th>Payment Type</th>
                <th>Payment Total</th>
                <th>To Go</th>
                <th>Items</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // loop through all the transactions and display their details
            while ($row = mysqli_fetch_assoc($result)) {
                $transaction_id = $row['transaction_id'];
                $customer_user = $row['customer_user'];
                $date = $row['date'];
                $time = $row['time'];
                $payment_type = $row['payment_type'];
                $payment_total = $row['payment_total'];
                $to_go = $row['to_go'];
                $product_id = $row['product_id'];
                $quantity = $row['quantity'];

                // query to get the product name
                $sql_product = "SELECT name FROM inventory WHERE productid = $product_id";
                $result_product = mysqli_query($conn, $sql_product);
                $row_product = mysqli_fetch_assoc($result_product);
                $product_name = $row_product['name'];

                echo "<tr>";
                echo "<td>$transaction_id</td>";
                echo "<td>$customer_user</td>";
                echo "<td>$date</td>";
                echo "<td>$time</td>";
                echo "<td>$payment_type</td>";
                echo "<td>$payment_total</td>";
                echo "<td>$to_go</td>";
                echo "<td>$product_name x $quantity</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="inventory_register.php"><button>Enter Inventory</button></a>
</body>
</html>

<?php
// close the database connection
mysqli_close($con);
?>

<?php 
  include('includes/footer.php');
?>
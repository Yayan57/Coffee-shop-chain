<?php 
  include('includes/header.php');

?>

<div>
  <h1>Inventory Stock</h1>
  <?php 
    // db connections
    $servername = "coffee-shop.mysql.database.azure.com";
    $username = "group9";
    $password = "Databases9!";
    $dbname = "pointofsales";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve stock information
    $productid = mysqli_real_escape_string($conn, $_POST['productid']);
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $branchnum = mysqli_real_escape_string($conn, $_POST['branchnum']);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM stock WHERE item_name = ?");
    $stmt->bind_param("s", $item_name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display stock information
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p>" . $row["item_name"] . " - " . $row["quantity"] . " available - <a href='order.php?id=" . $row["productid"] . "'>Order Now</a></p>";
        }
    } else {
        echo "No stock available";
    }

    mysqli_close($conn);
  ?>
</div>

<?php 
  include('includes/footer.php');
?>
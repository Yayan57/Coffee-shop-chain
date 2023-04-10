<?php 
  include('includes/header.php');

?>


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

    #setting the branch number of employee logged in
    $branch_number = $_SESSION['branch_number'];

    //query
    $sql = "SELECT * FROM inventory WHERE branchnum = $branch_number";
    #for search box
    if (!empty($_POST['search'])) {
      $search = $_POST['search'];
      $sql .= " AND item_name LIKE '%$search%'";
    }

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
  

<?php 
  include('includes/footer.php');
?>
<div>
  <h1>Inventory Stock</h1>
</div>
<?php 
  include('includes/header.php');

  $servername = "coffee-shop.mysql.database.azure.com";
  $username = "group9";
  $password = "Databases9";
  $dbname = "pointofsales";

  function Print_Stock(){
    echo "stock item";
    echo $item_amount
}
?>

<div>
<h1>
    Inventory Stock
</h1>
    <a href = "#stock"> table containing stock </a>
    <?php 
    $db = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve stock information
$sql = "SELECT * FROM stock";
$result = mysqli_query($db, $sql);

// Display stock information
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<p>" . $row["name"] . " - " . $row["quantity"] . " available - <a href='order.php?id=" . $row["id"] . "'>Order Now</a></p>";
    }
} else {
    echo "No stock available";
}

mysqli_close($db);
    ?>
</div>


 
<?php 
  include('includes/footer.php');
?>
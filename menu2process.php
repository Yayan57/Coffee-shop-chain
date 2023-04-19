<?php
    session_start();
    if(isset($_SESSION['type']) and $_SESSION['type'] == "customer"){
        include('includes/headeruser.php');    
      }else{
        include('includes/header.php');}
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
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $cart = $_GET["cart"];
        $branch = $_GET["branch"];
        $itemcount = $_GET["itemcount"];
        $total = $_GET["total"];

        $newcart = explode(",", $cart);
        // Loop through the array and further split each item at the hyphen
        foreach ($newcart as $cart_item) {
            $item_details = explode(" - ", $cart_item);
            $item_name = $item_details[0];
            $item_price = $item_details[1];
            
            // Do something with the item name and price
            // For example, you can add them to separate arrays
            $item_names[] = $item_name;
            $item_prices[] = $item_price;
        }
        $first  = ''; //stores first word of item name
        $second = ''; //stores second word of item name
        //checks if each item is available before processing order
        //error is returned with name of item which is out of stock
        foreach ($newcart as $item) {
            $parts  = explode(" ", $item);
            $first  = $parts[0];
            $second = $parts[1];
            $sql = "SELECT quantity FROM inventory WHERE item_name LIKE '{$first}%{$second}%'
                   ";
            $iquant = $conn->query($sql);
        }
        //decrements quantity of each item
        foreach ($newcart as $item) {
            $parts  = explode(" ", $item);
            $first  = $parts[0];
            $second = $parts[1];
            $sql = "UPDATE inventory
                        SET quantity = quantity - 1
                        WHERE item_name LIKE '{$first}%{$second}%' AND quantity > 0;
                        ";
                mysqli_query($conn, $sql);
        }
        }
    //}
    mysqli_close($conn);
 ?>
 <!DOCTYPE html>
<html>
    <link rel="stylesheet" href="cstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<h1>ORDER PLACED!</h1>
</html>
<?php
    include('includes/footer.php');
?>

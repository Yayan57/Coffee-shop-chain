<?php
    session_start();
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cart   = $_POST['cart']; //array of items
        $branch   = $_POST['branch']; //location where order is placed
        $itemcount   = $_POST['itemcount']; //number of items ordered
        $total  = $_POST['total']; //total cost
        var_dump($_POST);
        $first  = ''; //stores first word of item name
        $second = ''; //stores second word of item name
        //checks if each item is available before processing order
        //error is returned with name of item which is out of stock
        foreach ($cart as $item) {
            $parts  = explode(" ", $item);
            $first  = $parts[0];
            $second = $parts[1];
            //subtracts from quantity of each item ordered 
            $sql = "SELECT quantity FROM inventory WHERE item_name LIKE '{$first}%{$second}%'
                   ";
            $iquant = $conn->query($sql);
            if($iquant < 1){trigger_error("$first $second OUT OF STOCK! SORRY!", E_USER_ERROR);}
        }
        //decrements quantity of each item
        foreach ($cart as $item) {
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
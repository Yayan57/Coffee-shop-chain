<?php
session_start();

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

if (isset($_POST['submit'])) {
  $managerid = $_POST['managerid'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM managers WHERE managerid='$managerid' AND managerpass='$password'";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) == 1) {
    $_SESSION['managerid'] = $managerid;
    header("Location: managerhome.php");
  } else {
    echo "<p>Invalid login credentials. Please try again.</p>";
  }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Manager Login</title>
  </head>
  <body>
    <div class="login">
      <h2>Manager Login</h2>
      <form method="post" action="managerlogin.php">
        <label>Manager ID:</label>
        <input type="text" name="managerid" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <input type="submit" name="submit" value="Login">
      </form>
    </div>
  </body>
</html>

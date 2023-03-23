<!DOCTYPE html>
<html>
<head>
	<title>Employee Login</title>
</head>
<body>
	<h2>Employee Login</h2>
	<form method="post" action="testlogin.php">
		<label>Username:</label><br>
		<input type="text" name="username"><br><br>
		<label>Password:</label><br>
		<input type="password" name="password"><br><br>
		<label>Branch Number:</label><br>
		<input type="text" name="bran_num"><br><br>
		<input type="submit" value="Login">
	</form>
</body>
</html>

<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
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

   // Get username, password, and branch number from POST data
   $username = mysqli_real_escape_string($db,$_POST['username']);
   $password = mysqli_real_escape_string($db,$_POST['password']);
   $bran_num = mysqli_real_escape_string($db,$_POST['bran_num']);

   // Query the employee table for a matching username, password, and branch number
   $sql = "SELECT * FROM employee WHERE username = '$username' AND password = '$password' AND bran_num = '$bran_num'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

   // If a matching record is found, set session variables and redirect to employee home page
   $count = mysqli_num_rows($result);
   if($count == 1) {
      $_SESSION['login_user'] = $username;
      $_SESSION['bran_num'] = $bran_num;
      header("location: employeehome.php");
   } else {
      $error = "Invalid login credentials.";
   }
}
?>

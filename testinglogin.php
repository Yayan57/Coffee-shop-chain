<!DOCTYPE html>
<html>
  <head>
    <title>Employee Login</title>
  </head>
  <body>
    <div class="login">
      <h2>Employee Login</h2>
      <!-- form to take employee id and password input -->
      <form method="post" action="testinglogin.php">
        <label>Employee ID:</label>
        <input type="text" name="employeeid" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <input type="submit" name="submit" value="Login">
      </form>
    </div>
  </body>
</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// start the session
session_start();

// establish database connection
$servername = "coffee-shop.mysql.database.azure.com";
$username = "group9";
$password = "Databases9!";
$dbname = "pointofsales";

// create a new mysqli object and configure it for SSL
$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL, '/path/to/mysql-ca.pem', NULL, NULL);
mysqli_real_connect($con, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);

// check for connection errors and exit if there are any
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// check if the form was submitted
if (isset($_POST['submit'])) {
  // get the employee id and password from the form
  $employeeid = $_POST['employeeid'];
  $password = $_POST['password'];

  // prepare the SQL query to retrieve employee data for the given id and password
  $sql = "SELECT * FROM employee WHERE id='$employeeid' AND password='$password'";

  // execute the query and store the result in $result
  $result = mysqli_query($con, $sql);

  // if there is only one row in the result set, it means the employee id and password combination is valid
  if (mysqli_num_rows($result) == 1) {
    // fetch the branch number from the query result
    $row = mysqli_fetch_assoc($result);
    $branch = $row['branch_number'];

    // set the employee id and branch number in the session variables
    $_SESSION['employeeid'] = $employeeid;
    $_SESSION['branch'] = $branch;

    // redirect the user to the employee home page
    header("Location: employeehome.php");
  } else {
    // display an error message if the login credentials are invalid
    echo "<p>Invalid login credentials. Please try again.</p>";
  }
}

// close the database connection
mysqli_close($con);
?>

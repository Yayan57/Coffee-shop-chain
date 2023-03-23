<?php
session_start();

include('includes/managerheader.php');

// db connections
$servername = "coffee-shop.mysql.database.azure.com";
$username = "group9";
$password = "Databases9!";
$dbname = "pointofsales";

// Create connection
$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL, '/path/to/mysql-ca.pem', NULL, NULL);
mysqli_real_connect($con, $servername, $username, $password, $dbname, 3306, MYSQLI_CLIENT_SSL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Get manager's branch number
$managerid = $_SESSION['managerid'];
$sql = "SELECT managesbranch FROM managers WHERE managerid = $managerid";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  // Manager found, get their branch number
  $row = mysqli_fetch_assoc($result);
  $branchnum = $row["managesbranch"];

  // Display messages for manager's branch 
  $sql = "SELECT * FROM messages WHERE branchno = $branchnum ORDER BY timestamp DESC";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Recipient</th><th>Message Text</th><th>Timestamp</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>" . $row["recipient"] . "</td><td>" . $row["message_text"] . "</td><td>" . $row["timestamp"] . "</td></tr>";
    }
    echo "</table>";
  } else {
    echo "No messages found for your branch.";
  }
} else {
  echo "Manager not found.";
}

mysqli_close($con); // closing connection
?>
<style>
  /* Basic table styling */
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    text-align: left;
    padding: 8px;
  }

  th {
    background-color: #f2f2f2;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  </style>
<?php
include('includes/footer.php');
?>

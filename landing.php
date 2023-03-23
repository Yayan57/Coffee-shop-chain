<?php 
  include('includes/header.php');
?>

<html>
  <head>
  <title>Bean Me Up</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="landingstyle.css">
  </head>
  <div class="background">
      <div class = "cont">
          <button class = "button-1" onclick="window.location.href = 'menu.php';">
              View our menu
          </button>
      </div>
      <img class = "backimg" src="assets/coback.jpeg" alt="coffe image">
  </div>
</html>

<?php
//THIS CHECKS IF USER IS LOGGED OUT, DELETE BEFORE DEPLOYMENT
// Start session
session_start();

// Check if user is logged in
if (isset($_SESSION['username'])) {
    // User is still logged in, logout process failed
    echo "Logout process failed";
} else {
    // User is logged out, logout process successful
    echo "Logout process successful";
}
?>

<?php 
  include('includes/mfooter.php');
?>
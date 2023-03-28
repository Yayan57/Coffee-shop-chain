<?php 
  if(!isset($_SESSION)){
    session_start();
}
  if(isset($_SESSION['type']) and $_SESSION['type'] == "customer"){
    include('includes/headeruser.php');
  }
  else if(isset($_SESSION['type']) and $_SESSION['type'] == "employee"){
    include('includes/employeeheader.php');    
  }else{
    include('includes/header.php');
  }
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
  include('includes/mfooter.php');
?>
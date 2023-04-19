<?php 
  if(!isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['type']) and $_SESSION['type'] == "customer"){
    include('includes/headeruser.php');
    $menuURL = "menu.php"; // if logged in, go to menu.php
  } else if(isset($_SESSION['type']) and $_SESSION['type'] == "employee"){
    include('includes/employeeheader.php');
    $menuURL = "menu.php"; // if logged in, go to menu
  } else {
    include('includes/header.php');
    $menuURL = "menuguest.php"; // if not logged in, go to menuguest
  }
?>

<html>
  <head>
    <title>Bean Me Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="landingstyle.css">
    <style>
      .background {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
      }

      .backimg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 1s ease-in-out;
      }

      .backimg.active {
        opacity: 1;
      }

      .backimg.inactive {
        opacity: 0;
      }
    </style>
  </head>
  <body>
    <div class="background">
      <img class="backimg active" src="assets/coback.jpeg" alt="coffee image">
      <img class="backimg active" src="assets/strawberry.jpeg" alt="latte image">
      <img class="backimg active" src="assets/cookie1.jpeg" alt="snack image">
      <div class="cont">
        <button class="button-1" onclick="window.location.href = '<?php echo $menuURL; ?>';">
          View our menu
        </button>
      </div>
    </div>
    <script>
      const images = document.querySelectorAll('.backimg');
      let index = 0;

      setInterval(() => {
        images[index].classList.remove('active');
        images[index].classList.add('inactive');
        index = (index + 1) % images.length;
        images[index].classList.remove('inactive');
        images[index].classList.add('active');
      }, 3000);
    </script>
  </body>
</html>

<?php 
  include('includes/mfooter.php');
?>

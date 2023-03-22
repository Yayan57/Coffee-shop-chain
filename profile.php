<?php 
  include('includes/header.php');
?>


<?php
    session_start();
    //Initializes MySQLi
    $host = 'coffee-shop.mysql.database.azure.com';
    $username = 'group9';
    $password = 'Databases9!';
    $db_name = 'pointofsales';

    $con = mysqli_init();
    
    // Establish the connection
    mysqli_real_connect($con, $host, $username, $password, $db_name, 3306, NULL, MYSQLI_CLIENT_SSL);

    //If connection failed, show the error
    if (mysqli_connect_errno())
    {
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }

    $connect = mysqli_query($con,
    "SELECT * FROM ".$_SESSION['type']." WHERE username = '".$_SESSION['username']."'");
    
    $row = mysqli_fetch_row($connect);
    foreach($connect as $row){}

    if(isset($_POST['update'])){
        header('Location:update.php');
    }

    if(isset($_POST['log_out'])){
    //delete all session information when user logs out
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['type']);
        header("Location:login.php");
    }


    
 
    
?>

<html>
    <head>
    <link rel="stylesheet" href="cstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Profil</title>
    </head>

    <body>
        <form name = "profile_form" method="post" action="profile.php">
        <div class = "center">
            <i name="profil_p" class="fa fa-user" style="font-size:48px"></i>
            <label for = 'profile_p'><?php echo $_SESSION['username']?></label>
            <br></br>
                <?php if($_SESSION['type']=='customer'){ ?>
                    <p>Name:<?php echo $row["name"]?></p>
                    <p>Phone:<?php echo $row["phone"]?><p>
                    <p>Email:<?php echo $row["email"] ?><p>
                <?php } ?>
                <?php if($_SESSION['type']=='employee'){ ?>
                    <p>Name:<?php echo $row['ename_first']." ".$row['ename_last']?></p>
                    <p>Branch:<?php echo $row['bran_num']?><p>
                    <p>ID:<?php echo $row['id'] ?><p>
                <?php } ?>
                <input type="submit" class="btn btn-primary" name="update" value="Update">
                <input type="submit" class="btn btn-primary" name="log_out" value="Log Out">
            
        </div>
        </form>
    </body>
</html>


<?php 
  include('includes/footer.php');
?>
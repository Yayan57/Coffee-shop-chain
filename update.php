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
    $phone = "";
    $email = "";
    $table = "";

    $message='';
    $change = '';

    if(isset($_POST['cancel'])){
        header('Location:profile.php');
    }

    elseif($_SERVER['REQUEST_METHOD'] === 'POST')
    {
    

    //mysqli_ssl_set($conn,NULL,NULL, "/var/www/html/DigiCertGlobalRootG2.crt.pem", NULL, NULL);

    // Establish the connection
    mysqli_real_connect($con, $host, $username, $password, $db_name, 3306, NULL, MYSQLI_CLIENT_SSL);

    //If connection failed, show the error
    if (mysqli_connect_errno())
    {
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }

    $update_str = "";

    if(!empty($_POST['name'])){
        $update_str = $update_str."name='".$_POST['name']."'";
    }

    if(!empty($_POST['fname'])){
        $update_str = $update_str."ename_first='".$_POST['fname']."'";
    }

    if(!empty($_POST['lname'])){
        $update_str = $update_str."ename_last='".$_POST['lname']."'";
    }


    if(!empty($_POST['phone'])){
        if($update_str != ""){
            $update_str = $update_str." , ";
        }
        $update_str = $update_str."phone='".$_POST['phone']."'";
    }

    if(!empty($_POST['email'])){
        if($update_str != ""){
            $update_str = $update_str." , ";
        }
        $update_str = $update_str."email='".$_POST['email']."'";
    }

    if(!empty($_POST['password'])){
        if($update_str != ""){
            $update_str = $update_str." , ";
        }
        $update_str = $update_str."password='".$_POST['password']."'";
    }


    if($_SESSION['type']=='customer'){
        $change = "UPDATE ".$_SESSION['type']." SET ".$update_str." WHERE username = '".$_SESSION['username']."'"; 
    }

    if (mysqli_query($con,$change)) {
        //$message= "Record updated successfully";
        header('Location:profile.php');
      } else {
        $message= "Error updating record: " . $con->error;
        //header('Location:update.php');
      }
      
    $con->close();
    }
    
?>

<html>
    <head>
        <link rel="stylesheet" href="cstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Update Information</title>
    </head>

    <body>
        <form name = "update_form" method="post" action="update.php">
        <div class = "center"><?php if (!empty($message)){?><p><?php echo $message;}?>
            <i name="profil_p" class="fa fa-user" style="font-size:48px"></i>
            <label for = 'profile_p'><?php echo $_SESSION['username']?></label>
            <?php if($_SESSION['type']=='customer'){?>
            <p>
                <label for = 'name'>Name&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="name">
            </p>
            <?php }?>
            <?php if($_SESSION['type']=='employee'){?>
            <p>
                <label for = 'fname'>First Name&nbsp&nbsp</label>
                <input type="text" name="fname">
            </p>
            <p>
                <label for = 'lname'>Last Name&nbsp&nbsp</label>
                <input type="text" name="lname">
            </p>
            <?php }?>
            <?php if($_SESSION['type']=='customer'){?>
            <p>
                <label for = 'phone'>Phone&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="phone">
            </p>
            <p>
                <label for = 'email'>Email&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="email">
            </p>
            <?php } ?>
            <p>
                <label for = 'password'>Password&nbsp</label>
                <input type="text" name="password">
            </p>
            <input type="submit" class="btn btn-success" name="update" value="Confirm Change">
            <input type="submit" class="btn btn-success" name="cancel" value="Cancel">
            
            
        </div>
        </form>
    </body>
</html>


<?php 
  include('includes/footer.php');
?>
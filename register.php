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
    $insert = '';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
    
    
    if($_POST['password'] != $_POST['confirm_password']){
        $message = "Passwords not matching";

    }

    elseif(empty($_POST["username"]) or empty($_POST["password"] or empty($_POST["confirm_password"]))){
        $message= "Some required informations have not been provided!";
    }


    else{
        // Establish the connection
        mysqli_real_connect($con, $host, $username, $password, $db_name, 3306, NULL, MYSQLI_CLIENT_SSL);

    //If connection failed, show the error
        if (mysqli_connect_errno())
        {
            die('Failed to connect to MySQL: '.mysqli_connect_error());
        }

        
        if($_SESSION['type']=='customer'){
            $sql = "INSERT INTO ".$_SESSION['type']." (name,email,phone,username,password) VALUES('".$_POST['name']."','"
                .$_POST['email']."',".$_POST['phone'].",'".$_POST['username']."','".$_POST['password']."')";
        }

        if($_SESSION['type']=='employee'){
            $sql = "INSERT INTO ".$_SESSION['type']." (id,bran_num,ename_first,ename_last,username,password) VALUES(".$_POST['id'].",".$_POST['branch'].",'".$_POST['fname']."','"
            .$_POST['lname']."','".$_POST['username']."','".$_POST['password']."')";
        }

        if (mysqli_query($con,$sql)) {
            $_SESSION['username'] = $_POST['username'];
            $message= "Account successfully created";
            header('Location:landing.php');
        } else {
            if(str_contains($con->error,"id")){
                $message = "The entered ID is not valid. Please enter a valid ID.";
            }
            else if(str_contains($con->error,"username")){
                $message = "The entered username is not valid. Please enter a valid username.";
            }
            else if(str_contains($con->error,"password")){
                $message = "The entered password is not valid. The password must be at least 7 characters.";
            }
            else if(str_contains($con->error,"bran_num")){
                $message = "The entered branch number is not valid. Please enter a valid branch number.";
            }
            else{
                $message= "Something went wrong. Please try again.";
            }
        //header('Location:update.php');
        }
      
        $con->close();
    }
    }
    
?>


<html>
    <head>
        <link rel="stylesheet" href="cstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Register</title>
    </head>

    <body>
        <form name = "reg_form" method="post" action="register.php">
        <div class = "center"><?php if (!empty($message)){?><p><?php echo $message;}?>
            <i name="profil_p" class="fa fa-user" style="font-size:48px"></i>
            <label for = 'profile_p'>Create an Account</label>
            <p>
                <label for = 'username'>Username&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="username">
            </p>
            <?php if($_SESSION['type']=='customer'){?>
            <p>
                <label for = 'name'>Name&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="name">
            </p>
            <?php }?>
            <?php if($_SESSION['type']=='employee'){?>
            <p>
                <label for = 'fname'>First Name&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="fname">
            </p>
            <p>
                <label for = 'lname'>Last Name&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="lname">
            </p>
            <p>
                <label for = 'id'>ID Number&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="id">
            </p>
            <p>
                <label for = 'branch'>Branch Number&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="branch">
            </p>
            <?php }?>
            <?php if($_SESSION['type']=='customer'){?>
            <p>
                <label for = 'phone'>Phone&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="phone">
            </p>
            <p>
                <label for = 'email'>Email&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="text" name="email">
            </p>
            <?php } ?>
            <p>
                <label for = 'password'>Password&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="password" name="password">
            </p>
            <p>
                <label for = 'confirm_password'>Confirm Password&nbsp&nbsp&nbsp&nbsp</label>
                <input type="password" name="confirm_password">
            </p>
            <input type="submit" class="btn btn-success" name="register" value="Register">
        </div>
        </form>
    </body>
</html>

<?php 
  include('includes/footer.php');
?>
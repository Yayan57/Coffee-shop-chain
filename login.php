<?php 
  include('includes/header.php');
?>

<?php
    session_start();
    $message='';

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        
        
        $host = 'coffee-shop.mysql.database.azure.com';
        $username = 'group9';
        $password = 'Databases9!';
        $db_name = 'pointofsales';

        //Initializes MySQLi
        $con = mysqli_init();

        //mysqli_ssl_set($conn,NULL,NULL, "/var/www/html/DigiCertGlobalRootG2.crt.pem", NULL, NULL);

        // Establish the connection
        mysqli_real_connect($con, $host, $username, $password, $db_name, 3306, NULL, MYSQLI_CLIENT_SSL);

        //If connection failed, show the error
        if (mysqli_connect_errno())
        {
            die('Failed to connect to MySQL: '.mysqli_connect_error());
        }
        //Get user connection's credential
        if(isset($_POST['emp']) or isset($_POST['customer'])){
            if(!empty($_POST['emp'])){
                $_SESSION["type"] = "employee";
            }
            elseif(!empty($_POST['customer'])){
                $_SESSION["type"] = "customer";
            }
            if(isset($_POST['reg'])){
                header('Location:register.php');
            }
            $connect = mysqli_query($con,
                "SELECT * FROM ".$_SESSION['type']." WHERE username = '".$_POST["username"]."' and password = '".$_POST["password"]."'");
            $row = mysqli_fetch_row($connect);


            //set id and username
            if(is_array($row))
            {
                foreach($connect as $row){
                    $_SESSION["username"] = $row['username'];
                    if(!empty($_POST['emp'])){
                        $_SESSION['employee_id'] = $row['id'];
                        $_SESSION['branch_number'] = $row['bran_num'];
                    }       
                }
            }        
            else
            {
                //in case username or password is wrong
                $message = "Username or password is wrong.";
            }

        

            if(isset($_SESSION['username']))
            {
                if(!empty($_POST["emp"])){
                    header('Location:employeehome.php');
                }
                if(!empty($_POST['customer'])){
                    header('Location:landing.php');
                }
            }
        }
        else
            {
                //in case username or password is wrong
                $message = "Select type of Log In";
            }
        }
?>

<html>
    <head>
        <link rel="stylesheet" href="cstyle.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <title>User Login</title>
    </head>

    <body>
        <form name = "login_form" method="post" action="login.php">
        <div class = "center">
            <div><?php if (!empty($message)){ echo $message;}?></div>
            <h1>Welcome</h1>
            <label for = 'username'>Username</label>
            <input type="text" name="username">
            <br></br>
            <label for = 'password'>Password</label>
            <input type="password" name="password">
            <br></br>
            <label>Log In as: </label>
            <input type="checkbox" id="emp" name="emp" value="Employee">
            <label for="emp"> Employee </label>
            <input type="checkbox" id="customer" name="customer" value="Customer">
            <label for="customer"> Customer</label>
            <br></br>
            <br>
            <input type="submit" class="btn btn-primary" name="reg" value="Register">
            <input type="submit" class="btn btn-success" name="log_in" value="Log In">
            </br>
        </div>
        </form>
    </body>
</html>

<script>

let empCheck = Array.from(document.getElementsByName('emp'))
let custCheck = document.getElementById('customer')
    
empCheck.forEach(element => {
    element.onchange = () => {
        if (element.checked) {
            custCheck.checked = false;
        }
    }
})
    
custCheck.onchange = () => {
    if (custCheck.checked) {
        empCheck.forEach(element => {
            element.checked = false;
        })
    }
}
</script>



<?php 
  include('includes/footer.php');
?>
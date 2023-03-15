<?php 
  include('includes/header.php');
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
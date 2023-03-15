<?php 
  include('includes/header.php');
?>


<html>
    <head>
        <title>User Login</title>
    </head>

    <body>
        <form name = "login_form" method="post" action="login.php">
            <div class="message"><?php if (!empty($message)){ echo $message;}?></div>
            <h2 class = 'title'>Welcome, please log in</h1>
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
            <input type="submit" name="log_in" value="Log In">
            <input type="submit" name="reg" value="Registration">
            </br>
        </form>
        <br></br>
    </body>
</html>

<?php 
  include('includes/footer.php');
?>
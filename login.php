<html>
    <head>
        <title>User Login</title>
    </head>

    <body>
        <form name = "login_form" method="post" action="login.php">
            <div class="message"><?php if (!empty($message)){ echo $message;}?></div>
            <h3>Welcome, please log in</h3>
            <label for = 'username'>Username</label>
            <input type="text" name="username">
            <br></br>
            <label for = 'password'>Password</label>
            <input type="password" name="password">
            <br></br>
            <input type="submit" name="log_in_c" value="Customer Log In">
            <input type="submit" name="log_in_e" value="Employee Log In">
        </form>
    </body>
</html>
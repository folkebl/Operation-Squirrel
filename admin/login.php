<!-- Blake Folkenroth
Project4
11/9/17 -->
<!DOCTYPE html>
<html>
    <head>
    <?php require("../links.html");?> 
    </head>
    <body class="pagecolor">
        <div class = "centertext"><p>Admin Login</p></div>
        <div id = "logininfo">
            <form action = "login.php" method = "POST">
            <input type="text" name = "username" placeholder = "Username:"><br>
            <input type="password" name = "password" Placeholder = "Password:"><br>
            <div>
            <button class = "buttondesign" type = "submit" name = "Submit">Login</button><br>
            <!-- <button class = "buttondesign" type = "submit" name = "register">Register</button> -->
            </div>    
        </form>
        </div>
    </body>
</html>

<?php
require("UserAuthenticator.php");
if(isset($_POST["Submit"]))
{
    $passhash = Password_hash($_POST["password"],PASSWORD_BCRYPT);
if($UserAuthenticator->authenticate($_POST["username"],$_POST["password"]))
    {
        echo "you entered a good username or password";
        header("location:Admin.php");
    }
    else
    echo "you entered and incorrect username or password";
}

?>

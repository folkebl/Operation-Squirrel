<!-- Blake Folkenroth
Project4
11/11/17 -->
<?php
$UserAuthenticator = new UserAuthenticator();
class UserAuthenticator
{
    public function isLoggedin()
    {
        if($_SESSION["userid"] != TRUE)
            return FALSE;
        else
            return TRUE;
    }
    public function authenticate($username, $password)
    {
        Session_start();
        $user = "root";
        $pass = "";
        $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
        $query = "SELECT `admin_users`.`password`
                    FROM `capstone`.`admin_users`
                    where `username` = :uname;";
        $queryauthstmt = $dbh->prepare($query);
        $queryauthstmt->bindparam(':uname', $username);
        $queryauthstmt->execute();
        $row = $queryauthstmt->fetch();
        $nouserquery = "SELECT count(ID) From `capstone`.`admin_users`;";
        $nouserquery = $dbh->prepare($nouserquery);
        $nouserquery->execute();
        $count = $nouserquery->fetch();
        if(password_verify($password,$row[0]) || $count[0] == '0')
        {
            $_SESSION["userid"] = TRUE;
            return true;
        }
        else
        {
            return false;
        }
    
    }
    public function logUserIn($username)
    {
        Session_start();
        $_SESSION["username"] = $username;
    }
    public function logout()
    {
        Session_start();
        session_destroy();
        session_regenerate_id(TRUE);
        header("location:login.php");
    }
    public function redirectToLogin()
    {
        header("location:login.php");
        die;
    }
}
?>
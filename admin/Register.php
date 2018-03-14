<!-- Blake Folkenroth
Project4
11/9/17 -->

<?php
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);

    $pass = $_POST["password"];
    $username = $_POST["username"];
    $passhash = Password_hash($_POST["password"],PASSWORD_BCRYPT);
    $insertquery = "INSERT INTO `capstone`.`admin_users`(`username`,`password`)VALUES(:username,:pass);";
    $insertquerystmt = $dbh->prepare($insertquery);
    $insertquerystmt->bindparam(':username',$_POST["username"]);
    $insertquerystmt->bindparam(':pass',$passhash);
    $insertquerystmt->execute();
?>
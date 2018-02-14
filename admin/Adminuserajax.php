<!-- This updates all of the user information when the update button is pressed on the admin page -->
<?php
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $itemsbought = $_POST["itemsbought"];
    $itemssold = $_POST["itemssold"];
    $id = $_POST["id"];
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);

    $queryupdate = "UPDATE `capstone`.`registration` SET `FirstName` = :fname, `LastName` = :lname, `Email` = :email, `Phone` = :phone, `Payment` = :itemsbought, `Paymentforitemssold` = :itemssold WHERE `Seller ID` = :id;";
    $queryupdate = $dbh->prepare($queryupdate);
    $queryupdate->bindparam(':fname', $fname);
    $queryupdate->bindparam(':lname', $lname);
    $queryupdate->bindparam(':email', $email);
    $queryupdate->bindparam(':phone', $phone);
    $queryupdate->bindparam(':itemssold', $itemssold);
    $queryupdate->bindparam(':itemsbought', $itemsbought);
    $queryupdate->bindparam(':id', $id);
    $queryupdate->execute();
?>
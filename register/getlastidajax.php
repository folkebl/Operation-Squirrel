<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $Query = "SELECT `registration`.`Seller ID`
              FROM `capstone`.`registration`
              WHERE `FirstName` = :fname AND `LastName` = :lname;";
    $Query = $dbh->prepare($Query);
    $Query->bindparam(':fname', $_POST['fname']);
    $Query->bindparam(':lname', $_POST['lname']);
    $Query->execute();
    $data = $Query->fetch();
    echo $data[0];
?>
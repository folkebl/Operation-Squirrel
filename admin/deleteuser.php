<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $query = "UPDATE `capstone`.`registration` SET `user_delete` = TRUE WHERE `Seller ID` = :userid;";
    $query = $dbh->prepare($query);
    $query->bindparam('userid', $_POST["id"]);
    $query->execute();
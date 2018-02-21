<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $deletetable = "TRUNCATE TABLE `capstone`.`iteminformation`;";
    $deletetable = $dbh->prepare($deletetable);
    $deletetable->execute();
    $deletetableuser = "TRUNCATE TABLE `capstone`.`registration`;";
    $deletetableuser = $dbh->prepare($deletetableuser);
    $deletetableuser->execute();
?>
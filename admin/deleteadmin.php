<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $query = "DELETE FROM `capstone`.`admin_users` WHERE `ID` = :adminid;";
    $query = $dbh->prepare($query);
    $query->bindparam('adminid', $_POST["adminid"]);
    $query->execute();
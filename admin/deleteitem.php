<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $query = "UPDATE `capstone`.`iteminformation` SET `item_delete` = TRUE WHERE `ITEMNumber` = :itemnum;";
    $query = $dbh->prepare($query);
    $query->bindparam('itemnum', $_POST["itemnum"]);
    $query->execute();
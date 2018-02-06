<?php
    $itemnumber = $_POST["buyerid"];
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $buyernamequery = "SELECT BuyerNumber from iteminformation where ItemNumber = :itemnum;";
    $buyernamequery = $dbh->prepare($buyernamequery);
    $buyernamequery->bindparam(':itemnum',$itemnumber);
    $buyernamequery->execute();
    $row = $buyernamequery->fetch();
    echo $row[0];
?>
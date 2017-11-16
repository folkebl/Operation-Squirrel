<?php
    $id = $_POST["id"];
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $Confirmpayquery = "UPDATE `capstone`.`registration` SET`Payment` = TRUE WHERE `Seller ID` = :userid";
    $Confirmpaystmt = $dbh->prepare($Confirmpayquery);
    $Confirmpaystmt->bindparam(':userid',$id);
    $Confirmpaystmt->execute();
?>
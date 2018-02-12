<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);

        $sql = "UPDATE `iteminformation` SET `BuyerNumber`= :buyernumber,`SellingPrice`= :sellernumber where `ItemNumber` = :itemnumber";
        $sql=$dbh->prepare($sql);
        $sql->bindparam(':buyernumber',$_POST["buyernumber"]);
        $sql->bindparam(':sellernumber',$_POST["sellprice"]);
        $sql->bindparam(':itemnumber',$_POST["itemnumber"]);
        $sql->execute();
?>
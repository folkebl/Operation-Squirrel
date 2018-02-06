<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
     $itemnum = $_POST["itemnum"]; 
     $sellernamedropdown = $_POST["sellernamedropdown"];
     $buyernamedropdown = $_POST["buyernamedropdown"];
     $Description = $_POST["Description"];
     $itemcondition = $_POST["itemcondition"];
     $sellernotes = $_POST["sellernotes"];
     $startingbid = $_POST["startingbid"];
     $sellingprice = $_POST["sellingprice"];
     $charity = $_POST["charity"];
     
    $itemupdatequery = "UPDATE `capstone`.`iteminformation` SET `sellerNumber` = :sellerNumber,`BuyerNumber` = :BuyerNumber, `Description` = :descr, `ItemCondition` = :ItemCondition, `SellersNotes` = :SellersNotes, `StartingBid` = :StartingBid, `SellingPrice` = :SellingPrice, `Charity` = :charity WHERE `ItemNumber` = :itemnum;";

    $itemupdatequery = $dbh->prepare($itemupdatequery);
    $itemupdatequery->bindparam(':itemnum', $itemnum);
    $itemupdatequery->bindparam(':sellerNumber', $sellernamedropdown);
    $itemupdatequery->bindparam(':BuyerNumber', $buyernamedropdown);
    $itemupdatequery->bindparam(':descr', $Description);
    $itemupdatequery->bindparam(':ItemCondition', $itemcondition);
    $itemupdatequery->bindparam(':SellersNotes', $sellernotes);
    $itemupdatequery->bindparam(':StartingBid', $startingbid);
    $itemupdatequery->bindparam(':SellingPrice', $sellingprice);
    $itemupdatequery->bindparam(':charity', $charity);
    $itemupdatequery->execute();
?>
<?php

$queryclass = new Queries();
class Queries 
{
    public function __constructor()
    {
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    }
    public function getnamequery()
    {
        $user = "root";
        $pass = "";
        $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
       $query = "SELECT `Seller ID`, `FirstName`, `LastName` FROM `registration` WHERE user_delete = 0";
       $stmt = $dbh->prepare($query);
       $stmt->execute();
       return $stmt;
    }
    public function gettabledata($sellernumber)
    {
        $user = "root";
        $pass = "";
        $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
        $query = "SELECT `ItemNumber`, `sellerNumber`, `BuyerNumber`, `StartingBid`, `SellingPrice`, `Charity` FROM `iteminformation` where sellerNumber = $sellernumber AND item_delete = 0";
        $stmt=$dbh->prepare($NameQuery);
        $stmt->execute();
        return $stmt;
    }
}
?>
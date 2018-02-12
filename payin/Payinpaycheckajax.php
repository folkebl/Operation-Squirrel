<?php
    $userid = $_POST["id"];
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    ////
    $beenpaidQuery = "SELECT `Payment`,`FirstName`, `LastName` from capstone.registration where `Seller ID` = :userid";
    $beenpaidQuerystmt = $dbh->prepare($beenpaidQuery);
    $beenpaidQuerystmt->bindparam(':userid',$userid);
    $beenpaidQuerystmt->execute();
    $payment = $beenpaidQuerystmt->fetch();
    if($payment[0] == TRUE)
        $paymentalert = true; // has made payement
   else
        $paymentalert = false; // hasn't made payement
    echo $paymentalert;
?>
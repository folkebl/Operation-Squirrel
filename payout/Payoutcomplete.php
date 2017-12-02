<?php
    $userid = $_POST["id"];
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    ////
    $beenpaidQuery = "SELECT `Paymentforitemssold`,`FirstName`, `LastName` from capstone.registration where `Seller ID` = :userid";
    $beenpaidQuerystmt = $dbh->prepare($beenpaidQuery);
    $beenpaidQuerystmt->bindparam(':userid',$userid);
    $beenpaidQuerystmt->execute();
    $payment = $beenpaidQuerystmt->fetch();
    if($payment[0] == TRUE)
        $paymentyesno = "has";
   else
       $paymentyesno = "has not";

    echo $payment[1]." ".$payment[2] . " " . $paymentyesno . " been paid for the items sold";

?>
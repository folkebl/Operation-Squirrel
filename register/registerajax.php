<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $query = "INSERT INTO `capstone`.`registration`
    (`Seller ID`,
    `FirstName`,
    `LastName`,
    `Email`,
    `Phone`,
    `Buyer/seller`,
    `Payment`,
    `Paymentforitemssold`)
    VALUES
    ('',
    '$fname',
    '$lname',
    '$email',
    '$phone',
    '',
    '',
    '');
    ";
    $query = $dbh->prepare($query);
    // $query->bindparam(':fname',$fname); //// this should be used but for some reason it won't bing the param
    // $query->bindparam(':lname',$_POST["lname"]);
    // $query->bindparam(':phone',$_POST["phone"]);
    // $query->bindparam(':email',$_POST["email"]);
    $query->execute();
    $id = $dbh->lastInsertId();
    //require("ZebraRegister.php"); // undo this to print labels
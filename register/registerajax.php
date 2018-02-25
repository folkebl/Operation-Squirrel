<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
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
    :fname,
    :lname,
    :email,
    :phone,
    '',
    '',
    '');
    ";
    $query = $dbh->prepare($query);
    $query->bindparam(':fname',$_POST["fname"]);
    $query->bindparam(':lname',$_POST["lname"]);
    $query->bindparam(':phone',$_POST["phone"]);
    $query->bindparam(':email',$_POST["email"]);
    $query->execute();
    $id = $dbh->lastInsertId();
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    require("ZebraRegister.php"); // undo this to print labels
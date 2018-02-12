<?php
$NameOfUser = $_POST['artist'];
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
$NameQuery = "SELECT `FirstName`,`LastName` FROM `registration` where `Seller ID` = :nameofuser";
$statement = $dbh->prepare($NameQuery);
$statement->bindparam(':nameofuser',$NameOfUser);
$statement->execute();
$namerowseller = $statement->fetch();
$namerowseller = $namerowseller[0] . " " .  $namerowseller[1];
$img = $_POST['imgBase64'];
$title = $_POST['title'];
$date = $_POST['date'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
$fileName = 'images/'.$namerowseller.'_'.$title.'_'.date('m-d-Y_hia').'.png';
file_put_contents($fileName, $fileData);
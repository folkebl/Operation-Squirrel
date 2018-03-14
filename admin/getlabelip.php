
<?php
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);

    $getipquery = "SELECT * FROM `capstone`.`label_printer`where `id` = 1;";
    $getipquery = $dbh->prepare($getipquery);
    $getipquery->execute();
    $row = $getipquery->fetch();
    echo $row[1];
?>
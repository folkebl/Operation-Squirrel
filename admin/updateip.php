<!-- Blake Folkenroth -->

<?php
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);

    $ip = $_POST["ip"];
    $updateipquery = "UPDATE `capstone`.`label_printer`SET `label_printer_ip` = :ip where `id` = 1;";
    $updateipquery = $dbh->prepare($updateipquery);
    $updateipquery->bindparam(':ip',$ip);
    $updateipquery->execute();
?>
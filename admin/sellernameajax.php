
<?php
    $itemnumber = $_POST["sellerid"];
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $buyernamequery = "SELECT sellernumber from iteminformation where ItemNumber = :itemnum;";
    $buyernamequery = $dbh->prepare($buyernamequery);
    $buyernamequery->bindparam(':itemnum',$itemnumber);
    $buyernamequery->execute();
    $row = $buyernamequery->fetch();
    echo json_encode($row[0]);
?>
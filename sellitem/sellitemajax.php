<?php
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
$con = mysqli_connect('127.0.0.1', 'root','');
    if(!$con)
    {
        echo 'not connected to the server';
    }
    if(!mysqli_select_db($con,'capstone'))
    {
        echo 'database not selected';
    }
        $SellerID=$_POST["itemnum"];
		$Description=$_POST["desc"];
		$Condition=$_POST["condition"];
        $SellerNotes=$_POST["sellernotes"];
        $StartingBid=$_POST["stratingbid"];
        $charity = $_POST["charity"];

        $sql = "INSERT INTO `iteminformation`(`ItemNumber`, `sellerNumber`,`BuyerNumber`, `Description`, `ItemCondition`, `SellersNotes`, `StartingBid`,`SellingPrice`, `Charity`) VALUES ('','$SellerID','','$Description','$Condition','$SellerNotes','$StartingBid','','$charity')";
        if(!mysqli_query($con,$sql))
        {
            echo "Data not inserted";
        }
        else
        {
            $id = mysqli_insert_id($con);
            $query = "SELECT `FirstName`, `LastName` FROM `registration` WHERE `Seller ID` = :id ";
            $querystmt = $dbh->prepare($query);
            $querystmt->bindparam(':id',$SellerID);
            $querystmt->execute();
            $row = $querystmt->fetch();
            $fname = $row[0];
            $lname = $row[1];
            //require("ZebraItem.php"); // this is commented out when not wanting to print otherwise errors will be thrown
    }
?>
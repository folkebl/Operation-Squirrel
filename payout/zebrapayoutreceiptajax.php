<?php 
$count = 0;
$id = $_POST["id"];
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
$querytabledata = "SELECT `ItemNumber`, `sellerNumber`, `BuyerNumber`, `StartingBid`, `SellingPrice`, `Charity`,`Description` FROM `iteminformation` where sellerNumber = :nameofuser AND item_delete = 0;";
$tablestatement = $dbh->prepare($querytabledata);
$tablestatement->bindparam(':nameofuser',$id);
$itemrow = $tablestatement->execute();
$NameQuery = "SELECT `FirstName`,`LastName` FROM `registration` where `Seller ID` = :nameofuser";
$statement = $dbh->prepare($NameQuery);
$statement->bindparam(':nameofuser',$id);
$statement->execute();
$totalprice = 0;
$RunningTotal = 0;
$itemcounter = 0;
$feetotal = 0.0;
$feerunningtotal = 0.0;
$date = date("m.d.y");
 while($row = $tablestatement->fetch())
 {
    $fee = 0;
    $itemTotal = 0;
   if(!($row[5]) && ($row[4] != "0"))
   {
   $itemcounter++;
   $RunningTotal += $row[4];
   $itemTotal += $row[4];
   if($itemcounter >= 1 && $itemcounter <= 15)
       {
       $feetotal = $feetotal + .25;
       $fee = .25;
       }
   elseif($itemcounter >= 16 && $itemcounter <= 25)
       {
           $feetotal = $feetotal + .50;
           $fee = .50;
       }
   }

     if($row[5] == TRUE)
         $price = 0;
     else
        $price = $row[4];
$itemdata = $itemdata . "Item Number : $row[0] Price : $$price \n";
$totalprice = $totalprice + $price;
 $count++;
 }
 $totalprice = $totalprice - $feetotal;
$labellength = 560 + ($count * 60);
$itemstart = 250;
$receiptlabel = $labellength - 150;
$line = $labellength - 190;
$name = $labellength - 250;
$namequery = $statement->fetch();
$first_and_last_name = $namequery[0] . " " . $namequery[1];
$zebraCode = <<<ZEBRA
﻿CT~~CD,~CC^~CT~
^XA~TA000~JSN^LT0^MNN^MTD^PON^PMN^LH0,0^JMA^PR5,5~SD15^JUS^LRN^CI0^XZ
^XA
^MMT
^PW812
^LL$labellength
^LS0
^FT523,39^A0I,68,67^FH\^FD$date^FS
^FT800,152^A0I,68,67^FH\^FD Fees:$$feetotal Total:$$totalprice^FS
^FT620,$receiptlabel^A0I,135,134^FH\^FDReceipt^FS
^FO17,$line^GB777,0,8^FS
^FT774,$name^A0I,68,67^FH\^FDSeller: $first_and_last_name^FS
^FT774,$itemstart^A0I,62,62^FB800,$count,L,^FD$itemdata^FS;
^FO21,220^GB769,0,8^FS
^FO21,123^GB769,0,8^FS
^PQ1,0,1,Y^XZ

ZEBRA;
// printer connection variables
$printerIpAddress = "192.168.2.2";
$port = "9100";
$password = "1234";

// will attempt to connect to the printer
// if it fails 3 times then it will quit the script
$tryCount = 0;
do {

	$printerConnection = stream_socket_client(
		"tcp://" . $printerIpAddress . ":" . $port
		, $errno
		, $errstr
		, 2
	);

	$tryCount++;
} while ($printerConnection === false && $tryCount < 3);

if (!$printerConnection) {
	echo "\nUnable to connect to printer";
	exit;
}

fwrite($printerConnection, $zebraCode);
fclose($printerConnection);

// include this if you are printing a bunch in a loop...gives the printer 1 second to "catch up"
sleep(1);
?>
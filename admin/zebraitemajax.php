<!-- This page gets all of the required data to print the labels -->
<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $id = $_POST["id"];
    $itemquery = "SELECT `iteminformation`.`sellerNumber`,
                    `iteminformation`.`Description`,
                    `iteminformation`.`ItemCondition`,
                    `iteminformation`.`SellersNotes`,
                    `iteminformation`.`StartingBid`,
                    `iteminformation`.`Charity`
                FROM `capstone`.`iteminformation`
                WHERE `ItemNumber` = :id ;";
    $itemquery = $dbh->prepare($itemquery);
    $itemquery->bindparam(':id',$id);
    $itemquery->execute();
    $itemrow = $itemquery->fetch();
    $SellerID = $itemrow[0];
    $Description = $itemrow[1];
    $Condition = $itemrow[2];
    $SellerNotes = $itemrow[3];
    $StartingBid = $itemrow[4];
    $Charitytext = $itemrow[5];  

    $namequery = "SELECT `registration`.`FirstName`,
    `registration`.`LastName`,
    FROM `capstone`.`registration`
    WHERE `Seller ID` = :id;";
    $namequery = $dbh->prepare($namequery);
    $namequery->bindparam(':id',$SellerID);
    $namequery->execute();
    $namerow = $namequery->fetch();
    $fname = $namerow[0];
    $lname = $namerow[1];
// This is the zebra code. if the label needs changed you will have to swap out the zebra code
$zebraCode = <<<ZEBRA

﻿CT~~CD,~CC^~CT~
^XA~TA000~JSN^LT0^MNN^MTD^PON^PMN^LH0,0^JMA^PR5,5~SD15^JUS^LRN^CI0^XZ
^XA
^MMT
^PW812
^LL2030
^LS0
^FT768,163^A0I,51,50^FH\^FDCharity: $Charitytext^FS
^FT768,358^A0I,51,50^FH\^FDSeller Name: $fname $lname ^FS
^FT768,553^A0I,51,50^FH\^FDSeller Number: $SellerID^FS
^FT771,743^A0I,51,50^FH\^FDStarting Bid: $StartingBid ^FS
^FT768,940^A0I,51,50^FH\^FDSeller Notes: $SellerNotes^FS
^FT768,1135^A0I,51,50^FH\^FDCondition: $Condition ^FS
^FT773,1449^A0I,51,50^FH\^FDItem Description: ^FS
^FT545,1780^A0I,203,201^FH\^FD$id^FS
^BY5,3,160^FT576,1542^BCI,,N,N
^FD>:$id^FS
^FB800,3,L,
^FT774,1300^A0I,51,50^FH\^FD$Description^FS
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
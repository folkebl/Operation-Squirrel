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
    if($Charitytext == FALSE)
        $Charitytext = "No";
    else
        $Charitytext = "Yes";

    $namequery = "SELECT `registration`.`FirstName`,
    `registration`.`LastName`
    FROM `capstone`.`registration`
    WHERE `Seller ID` = :id;";
    $namequery = $dbh->prepare($namequery);
    $namequery->bindparam(':id',$SellerID);
    $namequery->execute();
    $namerow = $namequery->fetch();
    $fname = $namerow[0];
    $lname = $namerow[1];
// This is the zebra code. if the label needs changed you will have to swap out the zebra code
// $zebraCode = <<<ZEBRA

// ﻿CT~~CD,~CC^~CT~
// ^XA~TA000~JSN^LT0^MNN^MTD^PON^PMN^LH0,0^JMA^PR5,5~SD15^JUS^LRN^CI0^XZ
// ^XA
// ^MMT
// ^PW812
// ^LL2030
// ^LS0
// ^FT768,163^A0I,51,50^FH\^FDCharity: $Charitytext^FS
// ^FT768,358^A0I,51,50^FH\^FDSeller Name: $fname $lname ^FS
// ^FT768,553^A0I,51,50^FH\^FDSeller Number: $SellerID^FS
// ^FT771,743^A0I,51,50^FH\^FDStarting Bid: $StartingBid ^FS
// ^FT768,940^A0I,51,50^FH\^FDSeller Notes: $SellerNotes^FS
// ^FT768,1135^A0I,51,50^FH\^FDCondition: $Condition ^FS
// ^FT773,1449^A0I,51,50^FH\^FDItem Description: ^FS
// ^FT545,1780^A0I,203,201^FH\^FD$id^FS
// ^BY5,3,160^FT576,1542^BCI,,N,N
// ^FD>:$id^FS
// ^FB800,3,L,
// ^FT774,1300^A0I,51,50^FH\^FD$Description^FS
// ^PQ1,0,1,Y^XZ

// ZEBRA;
$date = date("m.d.y");
$zebraCode = <<<ZEBRA
CT~~CD,~CC^~CT~
^XA~TA000~JSN^LT0^MNN^MTD^PON^PMN^LH0,0^JMA^PR5,5~SD15^JUS^LRN^CI0^XZ
^XA
^MMT
^PW812
^LL2030
^LS0
^FT771,430^A0I,68,76^FH\^FDCharity: $Charitytext^FS
^FT554,59^A0I,68,84^FH\^FD$date^FS
^FT627,320^A0I,68,84^FH\^FDBuyer Name:^FS
^FT773,609^A0I,68,84^FH\^FDSeller Name: ^FS
^FT773,704^A0I,68,84^FH\^FDSeller Number: $SellerID^FS
^FT773,807^A0I,68,84^FH\^FDOpening Bid: $$StartingBid^FS
^FT777,1017^A0I,68,67^FH\^FDSeller Notes: ^FS
^FT777,1124^A0I,68,81^FH\^FDCondition: $Condition ^FS
^FT775,1407^A0I,68,72^FH\^FDItem Description: ^FS
^FT597,1670^A0I,417,412^FH\^FD$id^FS
^BY5,3,160^FT551,1476^BCI,,N,N
^FD>:$id^FS
^FO24,157^GB763,0,8^FS
^FO22,1651^GB763,0,8^FS
^FO283,1385^GB495,0,8^FS
^FO458,1102^GB323,0,6^FS
^FO438,994^GB338,0,8^FS
^FO346,780^GB425,0,8^FS
^FO267,681^GB509,0,8^FS
^FO339,582^GB437,0,8^FS
^FO542,402^GB232,0,8^FS
^FT774,1200^A0I,51,50^FB800,3,L,^FD $Description^FS
^FT774,942^A0I,51,50^FH\^FD$SellerNotes^FS
^FT774,534^A0I,51,50^FH\^FD$fname $lname^FS
^PQ1,0,1,Y^XZ

ZEBRA;
// the lines at the bottom of zebra code with varbs are for inserting stuff in test boxes
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
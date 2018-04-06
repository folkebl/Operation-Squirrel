<?php

if($charity == FALSE)
$Charitytext = "";
else
$Charitytext = "C";

$date = date("m.d.y");
$zebraCode = <<<ZEBRA
CT~~CD,~CC^~CT~
^XA~TA000~JSN^LT0^MNN^MTD^PON^PMN^LH0,0^JMA^PR5,5~SD15^JUS^LRN^CI0^XZ
^XA
^MMT
^PW812
^LL1500
^LS0
^FT38,1110^A0N,45,45^FH\^FDSelling Price:^FS
^FT255,1350^A0N,68,84^FH\^FD$date^FS
^FT38,1209^A0N,45,45^FH\^FDBuyer:^FS
^FT35,984^A0N,45,45^FH\^FDSeller Name: $fname $lname ^FS
^FT35,920^A0N,45,45^FH\^FDSeller Number: $SellerID^FS
^FT35,834^A0N,45,45^FH\^FDOpening Bid: $$StartingBid ^FS
^FT35,590^A0N,45,45^FH\^FDSeller Notes:  ^FS
^FT35,530^A0N,45,45^FH\^FDCondition: $Condition ^FS
^FT35,290^A0N,45,45^FH\^FDItem Description: ^FS
^FT650,196^A0N,116,115^FH\^FD$Charitytext^FS
^FT57,196^A0N,116,115^FH\^FD$id^FS
^BY4,3,112^FT277,216^BCN,,N,N
^FD>:$id^FS
^FO24,865^GB763,0,8^FS
^FO22,1024^GB763,0,8^FS
^FO23,1252^GB763,0,8^FS
^FO25,225^GB763,0,8^FS
^FO35,301^GB323,0,4^FS
^FO35,540^GB178,0,4^FS
^FO35,600^GB229,0,4^FS
^FO35,850^GB236,0,4^FS
^FO35,936^GB280,0,4^FS
^FO174,1219^GB605,0,4^FS
^FO35,1003^GB240,0,4^FS
^FO309,1118^GB468,0,4^FS
^FT35,470^A0N,56,55^FB800,3,L,^FD $Description^FS
^FT35,770^A0N,56,55^FB800,3,L,^FD$SellerNotes^FS
^PQ1,0,1,Y^XZ

ZEBRA;

// printer connection variables
$getipquery = "SELECT * FROM `capstone`.`label_printer`where `id` = 1;";
$getipquery = $dbh->prepare($getipquery);
$getipquery->execute();
$ip = $getipquery->fetch();
$printerIpAddress = $ip[1];
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
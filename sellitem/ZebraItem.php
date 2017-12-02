<?php



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
$printerIpAddress = "192.168.2.9";
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
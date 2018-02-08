<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    $id = $_POST["id"];
    $namequery = "SELECT `registration`.`FirstName`,
    `registration`.`LastName`,
    FROM `capstone`.`registration`
    WHERE `Seller ID` = :id;";
    $namequery = $dbh->prepare($namequery);
    $namequery->bindparam(':id',$id);
    $namequery->execute();
    $namerow = $namequery->fetch();
    $fname = $namerow[0];
    $lname = $namerow[1];
$zebraCode = <<<ZEBRA
CT~~CD,~CC^~CT~
^XA~TA000~JSN^LT0^MNN^MTD^PON^PMN^LH0,0^JMA^PR5,5~SD15^JUS^LRN^CI0^XZ
^XA
^MMT
^PW812
^LL1015
^LS0
^FT316,267^A0N,203,201^FH\^FD$id^FS
^BY5,3,160^FT271,588^BCN,,N,N
^FD>$id^FS
^FT24,781^A0N,45,45^FH\^FDName: $fname $lname^FS
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
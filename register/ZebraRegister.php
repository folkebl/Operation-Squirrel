<?php
$date = date("m.d.y");
if($id < 10)
{
$zebraCode = <<<ZEBRA
CT~~CD,~CC^~CT~
^XA~TA000~JSN^LT0^MNN^MTD^PON^PMN^LH0,0^JMA^PR5,5~SD15^JUS^LRN^CI0^XZ
^XA
^MMT
^PW812
^LL1050
^LS0
^FT240,631^A0N,660,655^FH\^FD$id^FS
^BY5,3,75^FT272,768^B3N,,N,N
^FD>$id^FS
^FT17,915^A0N,45,45^FH\^FDDate: $date^FS
^FT19,846^A0N,45,45^FH\^FDName: $fname $lname^FS
^FO94,660^GB632,0,8^FS
^PQ1,0,1,Y^XZ
ZEBRA;
}
elseif($id < 100){
$zebraCode=<<<ZEBRA
CT~~CD,~CC^~CT~
^XA~TA000~JSN^LT0^MNN^MTD^PON^PMN^LH0,0^JMA^PR5,5~SD15^JUS^LRN^CI0^XZ
^XA
^MMT
^PW812
^LL1050
^LS0
^FT94,631^A0N,660,655^FH\^FD$id^FS
^BY5,3,75^FT272,768^B3N,,N,N
^FD>$id^FS
^FT17,915^A0N,45,45^FH\^FDDate: $date^FS
^FT19,846^A0N,45,45^FH\^FDName: $fname $lname^FS
^FO94,660^GB632,0,8^FS
^PQ1,0,1,Y^XZ
ZEBRA;
}
else
{
$zebraCode=<<<ZEBRA
CT~~CD,~CC^~CT~
^XA~TA000~JSN^LT0^MNN^MTD^PON^PMN^LH0,0^JMA^PR5,5~SD15^JUS^LRN^CI0^XZ
^XA
^MMT
^PW812
^LL1050
^LS0
^FT0,631^A0N,660,550^FH\^FD$id^FS
^BY5,3,75^FT272,768^B3N,,N,N
^FD>$id^FS
^FT17,915^A0N,45,45^FH\^FDDate: $date^FS
^FT19,846^A0N,45,45^FH\^FDName: $fname $lname^FS
^FO94,660^GB632,0,8^FS
^PQ1,0,1,Y^XZ
ZEBRA;
}

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
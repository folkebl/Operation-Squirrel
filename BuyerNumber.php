<?php

require("../Query.php");
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);

$query= "SELECT ItemNumber FROM capstone WHERE SellerID=$SellerId";

?>

?>
<!DOCTYPE html>
<html>
<title>Reports</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" type="text/css" href="../stylesheet.css"/>
  </head>
  <body class="pagecolor">
    <div class="menu-wrap">
        <nav class="menu">
            <ul class="clearfix">
                <li><a href="../index.html">Home</a></li>
            </ul>
        </nav>
    </div>
		<div class = "textboxes">
            <h1>Item Number</h1>
            <?php echo $query ?>
      </div>
 </body>
</html>
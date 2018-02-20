<?php
$queryclass = new Queries();
class Queries 
{
    public function __constructor()
    {
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    }

    public function getbuyersquery()
    {

        $user = "root";
        $pass = "";
        $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
       $queryr = "SELECT 'COUNT(*)' FROM 'registration'";
       $stmt = $dbh->prepare($queryr);
       $stmt->execute();
       return $stmt;
    }

    public function getitemsquery()
    {

        $user = "root";
        $pass = "";
        $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
       $queryi = "SELECT 'COUNT(*)' FROM 'iteminformation'";
       $stmt = $dbh->prepare($queryi);
       $stmt->execute();
       return $stmt;
    }
    public function getcharityquery()
    {

        $user = "root";
        $pass = "";
        $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
       $queryc = "SELECT 'COUNT(*)' FROM 'iteminformation' WHERE 'charity=1' "; //?????
       $stmt = $dbh->prepare($queryc);
       $stmt->execute();
       return $stmt;
    }

<!DOCTYPE html>
<html>
<title>Reports</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
  </head>
  <body class="pagecolor">
    <div class="menu-wrap">
        <nav class="menu">
            <ul class="clearfix">
                <li><a href="index.html">Home</a></li>
            </ul>
        </nav>
    </div>
		<div class = "textboxes">
            <h1>Reports</h1>
        </div>
        <div class = "reportstext">
            <p>Number of buyers: <?php echo "$queryr"; ?></p> 
            <p>number of items:<?php echo "$queryi"; ?></p>
            <p>average sale price:</p>
            <p>average sale price: </p>
            <p>money made:</p>
            <p>items for charity:<?php echo "$queryc"; ?></p>
        </div>
 </body>
</html>
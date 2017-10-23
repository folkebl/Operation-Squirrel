<!DOCTYPE html>
<html>
  <head>
    <title>Great River Gaming Guild</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
  </head>
  <body id="RegistrationPage">
    <div class="menu-wrap">
        <nav class="menu">
            <ul class="clearfix">
                <li><a href="#">Home</a></li>
                <li>
                    <a href="#">Auction <span class="arrow">&#9660;</span></a>

                    <ul class="sub-menu">
                        <li><a href="Registration.php">Register</a></li>
                        <li><a href="SellersPage.php">Sell items</a></li>
                        <li><a href="AuctionBlock.php">Auction block</a></li>
                        <li><a href="#">Reports</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <div class = "searchbox">
     <br>Name:<input type="text" >
    </div>
  </body>
</html>
<?php
$con = mysqli_connect('127.0.0.1', 'root','');
if(!$con)
{
    echo 'not connected to the server';
}
elseif(!mysqli_select_db($con,'capstone'))
{
    echo 'database not selected';
}
else 
{

    $sql = "SELECT `Seller ID`, `FirstName`, `LastName`, FROM `registration`";
    if(!mysqli_query($con,$sql))
    {
        echo "Data not inserted";
    }
    else
    {
        echo "<select name = 'sub1'>";
        while($row = mysql_fetch_array($sql))
        {
            echo "<option value = '" . $row['Seller ID'] . "'>" . $row['FirstName'] . $row['LastName']. "</option>";
        }
        echo "</select>"; 
    }
}
?>
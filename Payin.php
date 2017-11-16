<!DOCTYPE html>
<?php
session_start();
//require("Databaseconfig.php");
$con = mysqli_connect('127.0.0.1', 'root','');
if(!$con)
{
    echo 'not connected to the server';
}
if(!mysqli_select_db($con,'capstone'))
{
    echo 'database not selected';
}
$query = "SELECT `Seller ID`, `FirstName`, `LastName` FROM `registration`";
$result = mysqli_query($con, $query);
?>
<html>
  <head>
    <title>Great River Gaming Guild</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="payin-out.js"></script>
  </head>
  <body id="RegistrationPage">
    <div class="menu-wrap">
        <nav class="menu">
            <ul class="clearfix">
                <li><a href="index.html">Home</a></li>

                <!-- <li>
                    <a href="#">Auction <span class="arrow">&#9660;</span></a>

                    <ul class="sub-menu">
                        <li><a href="Registration.php">Register</a></li>
                        <li><a href="SellersPage.php">Sell items</a></li>
                        <li><a href="AuctionBlock.php">Auction block</a></li>
                        <li><a href="#">Reports</a></li>
                    </ul>
                </li> -->
            </ul>
        </nav>
    </div>
    <div class = "Headtext">
          <h1>Receive Money</h1>
    </div>
     <div class = "searchbox"><br>
        Select Buyer: <select name="namedropdownpayin" id="namedroppayin">
            <option name = "DropDown" value = "0">Select Name:</option>
             <?php while($row = mysqli_fetch_array($result)):;?>
                <option name = "DropDown" value="<?php echo $row[0]?>"><?php echo $row[1] . " " . $row[2];?></option>
            <?php endwhile;?>
         </select>
    </div>
     <div class = "displayname" id = "displaynamepayinajax">
        
     </div>
    <div id = "payintable">

    </div>
  </body>
</html>
<?php
 if(isset($_POST['confirmbutton']))
 {
    $Confirmpayquery = "UPDATE capstone.registration SET `payment` = true WHERE `Seller ID` = $row[1]";
 }
?>
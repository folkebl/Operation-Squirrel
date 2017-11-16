<!DOCTYPE html>
<?php
session_start();
require("Query.php");
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
          <h1>Pay Out Money</h1>
    </div>
     <div class = "searchbox"><br>
        Select Seller: <select name="namedropdown" id="namedrop">
            <option name = "DropDown" value = "0">Select Name:</option>
             <?php
              $stmt = $queryclass->getnamequery();
              while($row = $stmt->fetch()):; ?>
                <option id = "dropdownlist" name = "DropDown" value="<?php echo $row[0]?>"><?php echo $row[1] . " " . $row[2];?></option>
            <?php endwhile;?>
         </select>
    </div>
    <div class = "displayname" id = "displaynameforajax"></div>
    <div id = "payouttable"></div>
  </body>
</html>


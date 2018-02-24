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
    <form action="PayOut.php" method="POST">
     <div class = "searchbox"><br>
        Select Seller: <select name="namedropdown" id="namedrop">
            <option name = "DropDown" value = "0">Select Name:</option>
             <?php while($row = mysqli_fetch_array($result)):;?>
                <option name = "DropDown" value="<?php echo $row[0]?>"><?php echo $row[1] . " " . $row[2];?></option>
            <?php endwhile;?>
         </select>
        <input type = "submit" name = "SearchButton" value = "Search"></input>
    </div>
    </form>
    <?php 
    if(isset($_POST['SearchButton']) && $_POST["namedropdown"] != "0")
    {
    ?>
    <div id = "table">
        <table>
            <tr>
                <th>Item Number</th>
                <th>Name of seller</th>
                <th>Name of buyer</th>
                <th>starting Bid</th>
                <th>Selling Price</th>
                <th>For Charity</th> 
            </tr>

            <?php 
            $NameOfUser=$_POST["namedropdown"];
            $query = "SELECT `ItemNumber`, `sellerNumber`, `BuyerNumber`, `StartingBid`, `SellingPrice`, `Charity` FROM `iteminformation` where sellerNumber = $NameOfUser";
            $result2 = mysqli_query($con, $query);
            $NameQuery = "SELECT `FirstName`,`LastName` FROM `registration` where `Seller ID` = $NameOfUser";
            $NameResult = mysqli_query($con, $NameQuery);
            $Namerow = mysqli_fetch_array($NameResult);
            while($row = mysqli_fetch_array($result2)):;?>
            <?php
                $NameQuery = "SELECT `FirstName`,`LastName` FROM `registration` where `Seller ID` = $row[2]";
                $NameResultforseller = mysqli_query($con, $NameQuery);
                $Namerowbuyer = mysqli_fetch_array($NameResultforseller);
            ?>
            <tr><td><?php echo $row[0]?></td><td><?php echo $Namerow[0] ." ". $Namerow[1]?></td><td><?php echo $Namerowbuyer[0] . " " . $Namerowbuyer[1]?></td><td><?php echo "$".$row[3]?></td><td><?php echo "$".$row[4]?></td><td><?php if($row[5] == true) echo "Yes"; else echo "No"; ?></td></tr>
            <?php endwhile?>
        </table>
       <?php
    }
    ?> 
    </div>
  </body>
</html>

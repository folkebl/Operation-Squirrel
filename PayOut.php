<!DOCTYPE html>
<?php
session_start();
require("Query.php");
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
$RunningTotal = 0;
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
             <?php
              $stmt = $queryclass->getnamequery();
              while($row = $stmt->fetch()):; ?>
                <option name = "DropDown" value="<?php echo $row[0]?>"><?php echo $row[1] . " " . $row[2];?></option>
            <?php endwhile;?>
         </select>
        <input type = "submit" name = "SearchButton" value = "Search"></input>
    </div>
    </form>
    <?php 
    if(isset($_POST['SearchButton']) && $_POST["namedropdown"] != "0")
    {
        $userid = $_POST["namedropdown"];
    ?>
        <div class = "displayname">
           <?php 
              $beenpaidQuery = "SELECT `Paymentforitemssold`,`FirstName`, `LastName` from capstone.registration where `Seller ID` = :userid";
              $beenpaidQuerystmt = $dbh->prepare($beenpaidQuery);
              $beenpaidQuerystmt->bindparam(':userid',$userid);
              $beenpaidQuerystmt->execute();
              $payment = $beenpaidQuerystmt->fetch();
            //   $Paymentresult = mysqli_query($con, $NameQuery);
            //   $payment = mysqli_fetch_array($Paymentresult);
              if($payment[0] == TRUE)
                  $paymentyesno = "has";
             else
                 $paymentyesno = "has not";
             ?>
          <p> <?php echo $payment[1]." ".$payment[2] . " " . $paymentyesno?> been paid for the items sold </p>
     </div>
    <div id = "table">
        <table>
            <tr>
                <th>Item Number</th>
                <th>Name of seller</th>
                <th>Name of buyer</th>
                <th>Starting Bid</th>
                <th>Selling Price</th>
                <th>For Charity</th>
                <th>  Total  </th> 
            </tr>

            <?php
            //Gets the table data where base on the name selected.
            $NameOfUser=$_POST["namedropdown"];
            $querytabledata = "SELECT `ItemNumber`, `sellerNumber`, `BuyerNumber`, `StartingBid`, `SellingPrice`, `Charity` FROM `iteminformation` where sellerNumber = :nameofuser";
            $tablestatement = $dbh->prepare($querytabledata);
            $tablestatement->bindparam(':nameofuser',$NameOfUser);
            $tablestatement->execute();
            //Gets the name of the seller
            $NameQuery = "SELECT `FirstName`,`LastName` FROM `registration` where `Seller ID` = :nameofuser";
            $statement = $dbh->prepare($NameQuery);
            $statement->bindparam(':nameofuser',$NameOfUser);
            $statement->execute();
            $namerowseller = $statement->fetch();

            while($row = $tablestatement->fetch()):;?>
            <?php
                // gets the buyers name
                 $buyernamequery = "SELECT `FirstName`,`LastName` FROM `registration` where `Seller ID` = :buyernumber";
                 $buyernamestatement = $dbh->prepare($buyernamequery);
                 $buyernamestatement->bindparam(':buyernumber',$row[2]);
                 $buyernamestatement->execute();
                 $namerowbuyer = $buyernamestatement->fetch();
                 if(!($row[5]))
                 $RunningTotal += $row[4];
                 //

            ?>
            <tr><td><?php echo $row[0]?></td><td><?php echo $namerowseller[0] . " " . $namerowseller[1]?></td><td><?php  echo $namerowbuyer[0] ." ". $namerowbuyer[1]?></td><td><?php echo "$".$row[3]?></td><td><?php echo "$".$row[4]?></td><td><?php if($row[5] == true) echo "Yes"; else echo "No"; ?></td><td><?php echo "$".$RunningTotal ?></td></tr>
            <?php endwhile?>
            <tfoot>
              <tr>
                <th id = "total" colspan="6">Total Amount Owed:</th>
                <td><?php echo "$".$RunningTotal?></td>
            </tr>
            </tfoot>
        </table>
        <form action="Payout.php" method="POST">
        <div id = "confirmpayment">
            <button type="submit" name = "confirmbutton"> Confirm Payment</button>
        </div>
        </form>
       <?php
    }
    ?> 
    </div>
  </body>
</html>

<?php
 if(isset($_POST['confirmbutton']))
 {
    $Confirmpayquery = "UPDATE `capstone`.`registration` SET`Paymentforitemssold` = TRUE WHERE `Seller ID` = :userid";
    $Confirmpaystmt = $dbh->prepare($Confirmpayquery);
    $Confirmpaystmt->bindparam(':userid',$NameOfUser);
    $Confirmpaystmt->execute();
    echo $NameOfUser;
}
?>


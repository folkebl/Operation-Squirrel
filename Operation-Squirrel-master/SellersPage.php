
<html>
<title>Sell Items</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
  </head>
  <body id="RegistrationPage">
    <div class="menu-wrap">
        <nav class="menu">
            <ul class="clearfix">
                <li><a href="index.html">Home</a></li>
            </ul>
        </nav>
    </div>

		<div class = "textboxes" id = "sellerpagetextboxes">
      <h2>Sell your Items</h2>
      <form action="SellersPage.php" method="post">
      <label>Seller ID:</label><br>
			<input type="text" name="SellerID"></input><br>
			<label>Description:</label><br>
      <textarea rows="3" cols="30" name="Description"></textarea><br>
			<label>Condition:</label> <br>
      <input type="text" name="Condition"></input><br>
			<label>Seller Notes:</label><br>
      <input type="text" name="SellerNotes"></input><br>
      <label>Starting Bid:</label><br>
      <input type="text" name="StartingBid"></input><br>
      <label>Charity:</label>
      <input type="checkbox" name="Charity"></input><br>
      <input type="submit" name="Done" value="Done"></input><br><br>
      <input type="submit" name="Addanotheritem" value = "Add Another Item"></input><br>
      </form>
    </div>
		</form>
  </body>
</html>
<?php
session_start();
$con = mysqli_connect('127.0.0.1', 'root','');
    if(!$con)
    {
        echo 'not connected to the server';
    }
    if(!mysqli_select_db($con,'capstone'))
    {
        echo 'database not selected';
    }
    if(isset($_POST["Done"]))
	{
    echo 'post';
        $SellerID=$_POST["SellerID"];
		    $Description=$_POST["Description"];
		    $Condition=$_POST["Condition"];
        $SellerNotes=$_POST["SellerNotes"];
        $StartingBid=$_POST["StartingBid"];
        if(isset($_POST["Charity"]))
        {
          $Charity=true ;
        }
        else
        {
          $Charity=false;
        }
        $sql = "INSERT INTO `iteminformation`(`ItemNumber`, `sellerNumber`,`BuyerNumber`, `Description`, `ItemCondition`, `SellersNotes`, `StartingBid`,`SellingPrice`, `Charity`) VALUES ('','$SellerID','','$Description','$Condition','$SellerNotes','$StartingBid','','$Charity')";
        if(!mysqli_query($con,$sql))
        {
            echo "Data not inserted";
        }
        else
        {
            echo "data inserted";
        }
    }
?>
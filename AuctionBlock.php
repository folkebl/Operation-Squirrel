
<html>
<title>AuctionBlock</title>
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
		<div class = "textboxes" id = "AuctionBlockTestBoxes">
            <h2>Auction Block</h2>
			<form action="AuctionBlock.php" method="post">
                <label>Item Number:</label><br>
                <input type="number" name="ItemNumber"><br>
				<label>Buyer Number:</label><br>
                <input type="number" name="BuyerNumber"><br>
				<label>Selling Price:</label><br>
                <input type="number" name="SellingPrice"><br><br>
                <div>
				    <input type="submit" name="SubmitButton" value="Submit">
                </div>
            </form>
        </div>
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
	if(isset($_POST["SubmitButton"]))
	{
        $BuyerNumber=$_POST["BuyerNumber"];
        $SellingPrice=$_POST["SellingPrice"];
        $ItemNumber=$_POST["ItemNumber"];
        $sql = "UPDATE `iteminformation` SET `BuyerNumber`= '$BuyerNumber',`SellingPrice`= '$SellingPrice' where `ItemNumber` = '$ItemNumber'";
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

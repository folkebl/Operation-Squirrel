
<html>
<title>AuctionBlock</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" type="text/css" href="../stylesheet.css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    <script src="auctionblock.js"></script>     
  </head>
  <body id="RegistrationPage">
    <div class="menu-wrap">
        <nav class="menu">
            <ul class="clearfix">
                <li><a href="../index.html">Home</a></li>
            </ul>
        </nav>
    </div>
        <div class = "headtext">
            <h1>Auction Block</h1>
        </div>
		<div class = "textboxes" id = "AuctionBlockTestBoxes">
                <label>Item Number:</label><br>
                <input type="number" name="ItemNumber" id = "itemnumber"><br>
				<label>Buyer Number:</label><br>
                <input type="number" name="BuyerNumber" id = "buyernumber"><br>
				<label>Selling Price:</label><br>
                <input type="number" name="SellingPrice" id = "sellprice"><br><br>
                <div>
				    <input type="submit" name="SubmitButton" value="Submit" id = "auctionbutton">
                </div>
        </div>
 </body>
</html>



<html>
<title>AuctionBlock</title>
    <?php require("../links.html");?> 
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
                <input type="number" min="0"name="ItemNumber" id = "itemnumber"><br>
				<label>Buyer Number:</label><br>
                <input type="number" min="0" name="BuyerNumber" id = "buyernumber"><br>
				<label>Selling Price:</label><br>
                <input type="number" min="0"name="SellingPrice" id = "sellprice"><br><br>
                <div>
				    <input type="submit" name="SubmitButton" value="Submit" id = "auctionbutton">
                </div>
        </div>
 </body>
</html>


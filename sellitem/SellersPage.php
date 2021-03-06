<!DOCTYPE html>
<?php
require("../Query.php");
$user = "root";
$pass = "";
$dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
?>
<html>
<title>Sell Items</title>
<?php require("../links.html");?> 
    <script src="sellitem.js"></script>    
  </head>
  <body id="RegistrationPage">
    <div class="menu-wrap">
        <nav class="menu">
            <ul class="clearfix">
                <li><a href="../index.html">Home</a></li>
            </ul>
        </nav>
    </div>
    <div class="Headtext">
        <h1>Sell your Items</h1>
    </div>
		<div class = "textboxes" id = "sellerpagetextboxes">
            <label>Seller Name:</label><br>
            <select name="namedropdown" id="namedropregistration">
            <option name = "DropDown" value = "0">Select Name:</option>
             <?php
              $stmt = $queryclass->getnamequery();
              while($row = $stmt->fetch()):; ?>
                <option name = "DropDown" value="<?php echo $row[0]?>"><?php echo $row[1] . " " . $row[2];?></option>
            <?php endwhile;?>
            </select><br>
			<label>Item Description:</label><br>
      <textarea rows="3" cols="30" name="Description" id = "desc"></textarea><br>
			<label>Item Condition:</label> <br>
      <input type="text" name="Condition"id = "condition"></input><br>
      <label>Seller Notes:</label><br>
      <textarea rows="3" cols="30" name="SellerNotes" id = "sellernotes"></textarea><br>
      <label>Opening Bid:</label><br>
      <input type="number" name="StartingBid"id = "stratingbid" min="0"></input><br>
      <label>Charity:</label><br>
      <input class="label__checkbox" type="checkbox" name="Charity" id = "charity_checkbox" /><br>
      <input type="submit" name="Done" value="Done" id = "itemdone"></input><br>
    </div>
    <div id = "itemdialogbox" style = "display:none">
            <h3>Press done or add Another item and a tag will be printed.</h3>
    </div>
  </body>
</html>

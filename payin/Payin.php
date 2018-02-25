<!DOCTYPE html>
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
$query = "SELECT `Seller ID`, `FirstName`, `LastName` FROM `registration` WHERE user_delete = 0;";
$result = mysqli_query($con, $query);
?>
<html>
  <head>
    <title>Great River Gaming Guild</title>
    <?php require("../links.html");?> 
    <script src="payin.js"></script>
  </head>
  <body id="RegistrationPage">
    <div class="menu-wrap">
        <nav class="menu">
            <ul class="clearfix">
                <li><a href="../index.html">Home</a></li>
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
    <div id="signpaddialog">
            <div class = "signpad-wrap">
            <canvas class = "signpad" id = "signpad"  width=850 height=300></canvas>
            </div>
        </div>
        <div id = "alreadypaid" style="display: none" > <h3>These items have already been paid for. Are you sure you want to continue?<h3></div>
  </body>
</html>
<?php
 if(isset($_POST['confirmbutton']))
 {
    $Confirmpayquery = "UPDATE capstone.registration SET `payment` = true WHERE `Seller ID` = $row[1]";
 }
?>
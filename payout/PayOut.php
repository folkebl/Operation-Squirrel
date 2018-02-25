<!DOCTYPE html>
<?php
require("../Query.php");
?>
<html>
  <head>
  <title>Great River Gaming Guild</title>
  <?php require("../links.html");?> 
    <script src="payout.js"></script>                                                                                                                                                                   
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
    <div id="signpaddialog">
            <div class = "signpad-wrap">
            <canvas class = "signpad" id = "signpad"  width=850 height=300></canvas>
            </div>
        </div>
    <div id = "alreadypaid" style = "display: none"><h3> This person has already been paid. Are you sure you want to continue?</h3></div>
  </body>
</html>


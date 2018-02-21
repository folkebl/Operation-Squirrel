<!DOCTYPE html>
<?php
require("../Query.php");
?>
<html>
  <head>
  <title>Great River Gaming Guild</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" type="text/css" href="../stylesheet.css"/>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="payout.js"></script>     
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>                                                                                                                                                                  
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



<html>
<title>Registration</title>
<?php require("../links.html");?> 
    <script src="register.js"></script>     
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
            <h1>Registration</h1>
        </div>
		<div class = "textboxes" id = "registrationpagetextboxes">
				<label>First Name:</label><br>
                <input type="text" name="fname" id = "firstname"></input><br>
				<label>Last Name:</label><br>
                <input type="text" name="lname" id = "lastname"></input><br>
				<label>Phone (Optional):</label><br>
                <input type="text" name="phone" id = "phone"></input><br>
				<label>Email (Optional):</label><br>
                <input type="text" name="email" id = "email"></input><br><br>
                <div>
				    <input type="submit" name="SubmitButton" id = "registersubmit"></input>
                </div>
        </div>
        <div id = "registerdialogbox" style = "display:none">
            <h3>Press the Sell Items button to sell an item, otherwise press done. A tag will then be printed.</h3>
        </div>
 </body>
</html>
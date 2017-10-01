
<html>

<title>Great River Gaming Guild</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
  </head>
  <body id="RegistrationPage">
    <div class="menu-wrap">
        <nav class="menu">
            <ul class="clearfix">
                <li><a href="#">Home</a></li>
            </ul>
        </nav>
    </div>

		<div class = "textboxes" id = "sellerpagetextboxes">
			<form action="registration.php" method="post">
				First Name: <input type="text" name="fname">
				<br>
				Last Name: <input type="text" name="lname">
				<br>
				Phone (Optional): <input type="text" name="phone">
				<br>
				Email (Optional): <input type="text" name="email">
				<br>
				<input type="submit" name="SubmitButton" value="submit">
    </div>
</form>
    </body>

</html>

<?php
session_start();
$user = 'root';
$pass = '';
$test = 'localhost';
$db = 'Capstone';
$db = mysqli_connect("$test", "$user", "$pass","$db");
	if(isset($_POST["SubmitButton"]))
	{
$fname=$_POST["fname"];
		$lname=$_POST["lname"];
		$phone=$_POST["phone"];
        $email=$_POST["email"];
        INSERT INTO registration values (,"$fname","$lname","$phone","$email","0");
    }

?>

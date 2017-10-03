
<html>

<title>Registration</title>
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
		<div class = "textboxes" id = "registrationpagetextboxes">
            <h2>Registration</h2>
			<form action="registration.php" method="post">
				<label>First Name:</label><br>
                <input type="text" name="fname"><br>
				<label>Last Name:</label><br>
                <input type="text" name="lname"><br>
				<label>Phone (Optional):</label><br>
                <input type="text" name="phone"><br>
				<label>Email (Optional):</label><br>
                <input type="text" name="email"><br><br>
                <div>
				    <input type="submit" name="SubmitButton" value="Submit">
                </div>
            </form>
        </div>
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

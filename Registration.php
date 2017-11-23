
<html>
<title>Registration</title>
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
        <div class = "headtext">
            <h1>Registration</h1>
        </div>
		<div class = "textboxes" id = "registrationpagetextboxes">
			<form action="registration.php" method="post">
				<label>First Name:</label><br>
                <input type="text" name="fname"></input><br>
				<label>Last Name:</label><br>
                <input type="text" name="lname"></input><br>
				<label>Phone (Optional):</label><br>
                <input type="text" name="phone"></input><br>
				<label>Email (Optional):</label><br>
                <input type="text" name="email"></input><br><br>
                <div>
				    <input type="submit" name="SubmitButton" value="Submit"></input>
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
        $fname=$_POST["fname"];
		$lname=$_POST["lname"];
		$phone=$_POST["phone"];
        $email=$_POST["email"];
        $sql = "INSERT INTO `registration`(`Seller ID`, `FirstName`, `LastName`, `Email`, `Phone`, `Buyer/seller`,`payment`,`Paymentforitemssold`) VALUES ('','$fname','$lname','$email','$phone','0','0','0')";
        if(!mysqli_query($con,$sql))
        {
            echo "Data not inserted";
        }
        else
        {
            $id = mysqli_insert_id($con);
            echo "data inserted";
            require("ZebraRegister.php");
        }
    }
?>

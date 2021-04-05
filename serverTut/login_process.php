<?php
$pagename="Log in Process"; //Create and populate a variable called $pagename
session_start();
include("db.php");
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

$email=$_POST['email'];
$password=$_POST['password'];

if(empty($email)||empty($password)){
	echo "<b>Log in Failed</b>";
	echo "<br><br>Your Log in Form is Incomplete.<br>Make Sure you provide all the information";
	echo "<br><br><a href='login.php'>Back to Log in</a>";
}else{

	echo "Entered Email : ".$email;
	echo "<br>Entered Password : ".$password;

	$SQL="select * from users where userEmail like '$email'";
	$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

	if (mysqli_num_rows($exeSQL)==0){
		echo "<br><br><b>Log in Failed</b>";
		echo "<br><br>Email Entered is not Valid";
		echo "<br><br><a href='login.php'>Back to Log in</a>";

	}

	while ($arrayp=mysqli_fetch_array($exeSQL))
				{

					if($arrayp["userPassword"]!==$password){
						echo "<br><br><b>Log in Failed</b>";
						echo "<br><br>Password Entered is not Valid";
						echo "<br><br><a href='login.php'>Back to Log in</a>";
					}else{

						$_SESSION['userId']=$arrayp['userId'];
						$_SESSION['userType']=$arrayp['userType'];
						$_SESSION['userFName']=$arrayp['userFName'];
						$_SESSION['userSName']=$arrayp['userSName'];


						if($arrayp["userType"]=="C"){
							 $_SESSION['user_type']="Customer";

							echo "<br><br><b>Log in Sucess</b>";
							echo "<br>Hello ".$arrayp['userFName'];
							echo "<br>You have succesfully sighned up as a hometq csutomer";
							echo "<br>Continue Shopping for <a href='index.php'>Home Tech</a>";
							echo "<br>View Your <a href='basket.php'>Smart Basket</a>";
						}else if($arrayp["userType"]=="A"){
							 $_SESSION['user_type']="Administrator";

							echo "<br><br><b>Log in Sucess</b>";
							echo "<br>Hello ".$arrayp['userFName'];
							echo "<br>You have succesfully sighned up as a hometq Administrator";
						}
						
					}

					
				}
	
}

include("footfile.html"); //include head layout
echo "</body>";
?>
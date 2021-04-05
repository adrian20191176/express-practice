<?php
session_start();
include("db.php");
$pagename="Sign Up Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

  $fname = $_POST['firstName'];
	$lname = $_POST['lastName'];
	$address = $_POST['address'];
	$pcode = $_POST['postCode'];
	$telno = $_POST['telNo'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confPassword'];
	
			
		//To check if the fields are filled.
		if (!empty($fname)&&($lname)&&($address)&&($pcode)&&($telno)&&($email)&&($password)) {
			
			$validatePaswsword = strcmp($password,$confirmPassword);
			
			//validating the password
			if($validatePaswsword == 0){
				
				//validating the email
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					
					$SQL="insert into 
						users (userType,userFName, userSName, userAddress, userPostCode,userTelNo,userEmail,userPassword)
						values ('C','".$fname."', '".$lname."','".$address."','".$pcode."', '".$telno."','".$email."','".$password."')";
					
					$exeSQL = mysqli_query($conn, $SQL) or die (mysqli_error($conn));
					
					//to check mysql errors
					if (mysqli_errno($conn)==0)
					{
						echo "<b>Sign-Up Successful! </b><br><br>";
						echo "You have sucessfully registered to our page. <br><br>";
						echo "To continue, please<a href='login.php'> LOGIN </a> ";
					}else{
						echo "<p>There is an error with the details you entered.</p>";
						
						//To check if the email exists in the database
						if (mysqli_errno($conn)==1062)
						{
							echo "<b>Sign-Up Failed</b><br><br>";
							echo "Email already in use .<br>";
							echo "You may be already registered or try another email address.<br><br>";
							echo "Go back to <a href='signup.php'>SIGN UP</a>";
						}
						if (mysqli_errno($conn)==1064)
						{
							echo "<b>Sign-Up Failed</b><br><br>";
							echo "<br>Invalid characters entered in the form.";
							echo "Make sure you avoid the following characters : apostrophes like ['] and backslahes like [\] <br><br>";
							echo "Go back to <a href='signup.php'>SIGN UP</a>";
						}
					}
					
				}else{
					echo "<b>Sign-Up Failed</b><br><br>";
					echo "Email not valid<br> ";
					echo "Make sure you enter a correct email address<br><br>";
					echo "Go back to <a href='signup.php'>SIGN UP</a> again.";
				}
				
				
			}else{
				echo "<b>Sign-Up Failed</b><br><br>";
				echo "The 2 Passwords are not matching<br>";
				echo "Make sure you ener them correctly<br><br>";
				echo "Go back to <a href='signup.php'>SIGN UP</a>";
				
			}

		}else{
			echo "<b>Sign-Up Failed</b><br><br>";
			echo"<p>Your SignUp form is incompleted and all fields are mandatory<p>";
			echo"Make sure you provide all the required details<br><br>";
			echo"Go back <a href='signup.php'>SIGN UP</a> ";
		}
include("footfile.html"); //include head layout
echo "</body>";
?>
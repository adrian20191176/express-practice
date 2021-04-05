<?php
session_start();
$pagename="Sign Up"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href='mystylesheet.css'>"; //Call in stylesheet
echo "<style>
input, textarea {
	width: 100%;
	padding: 12px;
  }
  table,th,td{
	  wdith:100%;
	  border:none;
  }
  th{
	  text-align:left;
	  width:20%;
	  font-weight:0px;
  }
  td{
	  width:80%;
  }
</style>";
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
//display random text

echo "<form action= signup_process.php method=post>
		<table border='0'>
			<tr>
				<th> <label>* First Name : </label> </th>
				<td> <input type='text' name='firstName'> </td>
			</tr>
			<tr>
				<th> <label>* Last Name : </label> </th>
				<td> <input type='text' name='lastName'> </td>
			</tr>
			<tr>
				<th> <label>* Address : </label> </th>
				<td> <textarea rows=4 name='address'> </textarea> </td>
			</tr>
			<tr>
				<th> <label>* PostCode : </label> </th>
				<td> <input type='text' name='postCode'> </td>
			</tr>
			<tr>
				<th> <label>* Tel No : </label> </th>
				<td> <input type='text' name='telNo'> </td>
			</tr>
			<tr>
				<th> <label>* Email Address : </label> </th>
				<td> <input type='text' name='email'> </td>
			</tr>
			<tr>
				<th> <label>* Password : </label> </th>
				<td> <input type='password' name='password'> </td>
			</tr>
			<tr>
				<th> <label>* Confirm Password : </label> </th>
				<td> <input type='password' name='confPassword'> </td>
			</tr>
			<tr>
  				<td colspan='2'>
				 	<input type=submit value='Sign Up'>
				</td>
			<tr>
		</table>
		</form>";

include("footfile.html"); //include head layout
echo "</body>";
?>
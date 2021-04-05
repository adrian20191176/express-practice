<?php
$pagename="Log in"; //Create and populate a variable called $pagename

session_start();

echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
echo "<style>
input, textarea {
	width: 100%;
	padding: 12px;
  }
  table,th,td{
	  border:none;
  } 
</style>";
//display random text

echo "<form action=login_process.php method=post>

    <table>
    <tr>
        <th> <label>* Email : </label> </th>
        <td width='303px'> <input type='text' name='email' > </td> 
    </tr>
    <tr>
        <th> <label>* Password : </label> </th>
        <td> <input type='password' name='password'> </td>
    </tr>
    <tr>
        <th>
            <input type=reset value='Clear' name='Clear'> 
        </th>
        <td>
            <input type=submit value='Log in' name='Log_in'>
        </td>
    </tr>
    </table>";
include("footfile.html"); //include head layout
echo "</body>";
?>
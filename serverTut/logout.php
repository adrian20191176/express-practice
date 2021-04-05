<?php
session_start();
$pagename="LOGOUT"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include ("detectlogin.php");
echo "<h4 style=''>".$pagename."</h4>";
echo "<p>Thank you, ".$_SESSION['userFName'].".</p>";
unset($_SESSION['basket']);
session_destroy();
echo "<p>You are now logged out.</p>";
include("footfile.html"); //include head layout
echo "</body>";
?>
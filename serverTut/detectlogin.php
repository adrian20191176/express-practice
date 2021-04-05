<?php

if(isset($_SESSION['userId'])){
	echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";

	echo "<h4 style='float:right'>".$_SESSION['userFName']." | ".$_SESSION['user_type']." No : ".$_SESSION['userId']."</h4>";
}
?>
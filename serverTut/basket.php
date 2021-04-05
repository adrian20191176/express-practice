<?php
session_start();
include("db.php");
$pagename="Your Smart Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

$newprodid=null;
$reququantity=null;

if(isset($_POST['h_prodid'])){



 	  $newprodid=$_POST['h_prodid'];
 	  $reququantity=$_POST['p_quantity'];

 	  $_SESSION['basket'][$newprodid]=$reququantity;
 }

  echo "<br>";

  echo "<table>
 	 	 		<tr>
 	 	 			<th>Product Name</th>
 	 	 			<th>Unit Price</th>
 	 	 			<th>Quantity</th>
 	 	 			<th>Sub Total</th>
 	 	 			<th>Action</th>
 	 	 		</tr>";

 	 	$total_amount=0;

 		if(isset($_SESSION['basket'])){	

 			if(isset($_POST['r_prodId'])){
 				$deleteId=$_POST['r_prodId'];
				// echo $deleteId;
						unset($_SESSION['basket'][$deleteId]);
		
				}	  	

 	 	 	foreach($_SESSION['basket'] as $index => $value)
 	 	 	{

 	 	 		$SQL="select prodName,prodPrice from Product where prodId=$index";
				//run SQL query for connected DB or exit and display error message
				$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());

				
				while ($arrayp=mysqli_fetch_array($exeSQL))
				{
 	 	 		// $sql="INSERT INTO basket(prodId,qty) VALUES('$index','$value')";
 	 	 		// $exeSQL=mysqli_query($conn, $sql) or die (mysqli_error());
 	 	 		

 	 	 		$subTotal=$value*$arrayp['prodPrice'];
 	 	 		$total_amount+=$subTotal;

			  echo "<form action=basket.php method=post>";
 	 	 		echo "<tr>
 	 	 				
 	 	 				<td>".$arrayp['prodName']."</td>
 	 	 				<td>".$arrayp['prodPrice']."</td>
 	 	 				<td>".$value."</td>
 	 	 				<td>".$subTotal."</td>
 	 	 				<td><input type=submit value=Remove></input></td>
 	 	 				
 	 	 			</tr>";

 	 	 	echo "<input type=hidden name=r_prodId value=".$index.">";
 	 	 	echo "</form>";

				}
 	 	 	} 	
 		 }else{
 		 	echo "<br><h3>Empty Basket</h3>";
 		 }

			echo "<tr><td colspan='3'>Total Amount</td>
 	 	 				<td>".$total_amount."</td>
 	 	 				<td></td>";

 	 	 	echo "</table>";

			   if(isset($_SESSION['userId'])){
				   echo "<p>To finalize your order:  <a href='checkout.php'>Checkout</a></p>";
			}else{
				echo "<br><a href='clearbasket.php'>Clear Basket</a>";
				echo "<br><br>New hometeq Customers : <a href='signup.php'>Sign Up</a>";
				echo "<br><br>Returning hometq Customers : <a href='login.php'>Log in</a>";
			}
 	 	

include("footfile.html"); //include head layout
echo "</body>";
?>
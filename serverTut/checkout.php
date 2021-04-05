<?php
session_start();
include("db.php"); 
$pagename="Your Log in Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

$currentdatetime=date("Y-m-d H:i:s");

$userId=$_SESSION['userId'];

echo "$currentdatetime";



$insert_user_quary="INSERT INTO orders (userId,orderDateTime,orderStatus) VALUES ('$userId','$currentdatetime','Placed')";
$execution=mysqli_query($conn, $insert_user_quary);

$orderId= mysqli_insert_id($conn);

echo "<br>Your Order id :  $orderId";

if(mysqli_errno($conn)==0){




	$total_amount=0;
	echo "<table>
 	 	 		<tr>
 	 	 			<th>Product Name</th>
 	 	 			<th>Unit Price</th>
 	 	 			<th>Quantity</th>
 	 	 			<th>Sub Total</th>
 	 	 			
 	 	 		</tr>";

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
 	 	 				
 	 	 				
 	 	 			</tr>";

 	 	 	echo "<input type=hidden name=r_prodId value=".$index.">";
 	 	 	echo "</form>";

 	 	 	$insert_to_orderLine="INSERT INTO order_line(orderNo,prodId,quantityOrdered,subTotal) VALUES ('$orderId','$index','$value','$subTotal')";

 	 	 	$execution=mysqli_query($conn,$insert_to_orderLine);


				}
 	 	 	}

 	 	 	echo "<tr><td colspan='3'>Order Total</td>
 	 	 				<td colspan='1'>".$total_amount."</td>
 	 	 				";

 	 	 	echo "</table>";

 	 	 
 	 	 	$update_user_quary="UPDATE orders SET orderTotal='$total_amount' WHERE orderNo='$orderId'";
			$execution=mysqli_query($conn, $update_user_quary);


			echo "<a href='logout.php'>LogOut</a>";


 	 	 	 
}else{
	echo "Error in Database";
}


//display random text

include("footfile.html"); //include head layout
echo "</body>";
?>
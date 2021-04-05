<?php
session_start();
include("db.php");
$pagename="A smart buy for a smart home"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

$prodid=$_GET['u_prod_id'];
//display the value of the product id, for debugging purposes
echo "<p>Selected product Id: ".$prodid;

echo "<br>";

$SQL="select prodId, prodName, prodPicNameLarge,prodDescripShort,prodDescripLong ,prodPrice,prodQuantity   from Product where prodId=$prodid";
//run SQL query for connected DB or exit and display error message
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error());

while ($arrayp=mysqli_fetch_array($exeSQL))
{
echo "<tr>";

echo "<td style='border: 0px'>";

echo "<div style='text-align:center;'>";

echo "<img src=images/".$arrayp['prodPicNameLarge']." height=250 width=400></a>";

echo "</div>";


echo "<td style='border: 0px'>";
echo "<p><h5>Product Name : ".$arrayp['prodName']."</h5>"; //display product name as contained in the array


echo "<p><h5 style='text-align: justify;'>Product Description : ".$arrayp['prodDescripLong']."</h5>"; //display product name as contained in the array


echo "<p><h5>Product Price : ".$arrayp['prodPrice']."</h5>"; //display product name as contained in the array

echo "<p><h5>Product Quantity : ".$arrayp['prodQuantity']."</h5>"; //display product name as contained in the array
echo "</td>";
echo "</tr>";

echo "<p>Number to be purchased: ";
//create form made of one text field and one button for user to enter quantity
//the value entered in the form will be posted to the basket.php to be processed
echo "<form action=basket.php method=post>";


echo "<select name='p_quantity'>";

for( $i=1;$i<=$arrayp['prodQuantity'];$i++){
	echo "<option>$i</option>";
}

echo "<select>";

echo "<input type=submit value='ADD TO BASKET'>";

//pass the product id to the next page basket.php as a hidden value
echo "<input type=hidden name=h_prodid value=".$prodid.">";
echo "<input type=hidden name=h_prodqty value=".$arrayp['prodQuantity'].">";
echo "</form>";

}
//display random text
echo "";
include("footfile.html"); //include head layout
echo "</body>";
?>
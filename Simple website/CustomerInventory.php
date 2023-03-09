<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <title>A Meaningful Page Title</title>
    </head>
    
    <body>
	<?php include 'customerMenu.php';?>


<?php include 'openconnection.php';?>

<?php

$sql = "SELECT SodaName, Price, Quantity FROM Sodas WHERE Quantity > 0";
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>Soda</th>
	<th>Price</th>
    <th>Available amount</th>
    <th>Add soda to cart</th>
    <th>View soda reviews</th>
    <th>Add soda review</th>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
		<td>" . $row["SodaName"]. "</td>
		<td>" . $row["Price"]. "</td>
        <td>" . $row["Quantity"]. "</td>
        <td><a href='addSodaToCart.php?id=".$row['SodaName']."'>Add</a></td>
        <td><a href='viewReview.php?id=" . $row['SodaName']."'>View</a></td>
        <td><a href='review.php?id=" . $row['SodaName']."'>Add</a></td></tr>";

}
    echo "</table>";
} 
else {
    echo "0 results";
}
?>

<?php mysqli_close($con)?>


    </body>
</html>

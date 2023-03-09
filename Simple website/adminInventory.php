<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <title>A Meaningful Page Title</title>
    </head>
    
    <body>
	<?php include 'menu.php';?>


<?php include 'openconnection.php';?>
<?php


$sql = "SELECT SodaName, Price, Quantity FROM Sodas";
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>Soda</th>
	<th>Price</th>
    <th>Available amount</th>
    <th>Delete Soda</th>
    <th>Add Soda</th>
    <th>Decrease Soda</th>
    <th>View Reviews</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
		<td>" . $row["SodaName"]. "</td>
		<td>" . $row["Price"]. "</td>
        	<td>" . $row["Quantity"]. "</td>
        	<td><a href='deleteSoda.php?id=".$row['SodaName']."'>Delete</a>
        	<td><a href='addSoda.php?id=".$row['SodaName']."'>+</a></td>
        	<td><a href='decreaseSoda.php?id=".$row['SodaName']."'>-</a></td>
            <td><a href='viewReview.php?id=" . $row['SodaName']."'>View</a></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
//header('Location: .inventory.php');
?>

<?php mysqli_close($con)?>


    </body>
</html>

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


$sql = "SELECT Soda, Quantity FROM Sodas";
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Soda</th>
    <th>Available amount</th>
    <th>Delete Soda</th>
    <th>Add Soda</th>
    <th>Decrease Soda</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Soda"]. "</td>
        	<td>" . $row["Quantity"]. "</td>
        	<td><a href='deleteSoda.php?id=".$row['Soda']."'>Delete</a>
        	<td><a href='addSoda.php?id=".$row['Soda']."'>+</a></td>
        	<td><a href='decreaseSoda.php?id=".$row['Soda']."'>-</a></td></tr>";
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

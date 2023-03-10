<?php session_start(); ?>
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
$Uid = $_SESSION["UID"];
$sql = "SELECT * FROM Orders WHERE IDCustomer = $Uid AND Sent = '1'";
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>Customer ID</th>
    <th>First Name</th>
    <th>Last Name</th>
	<th>Order ID</th>
    <th>Sent or not</th>
    <th>Detailed view</th>
    <th>Delete</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
		<td>" . $row["IDOrder"]. "</td>
        <td><a href='adminViewSpecificOrder.php?id=".$row['IDOrder']."'>View</a></td>
        </tr>";
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

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

$sql = "SELECT Orders.IDOrder, Orders.IDCustomer, Orders.Sent, Orders.Price, Customers.FirstName, Customers.LastName FROM Orders INNER JOIN Customers ON Orders.IDCustomer=Customers.IDCustomer";
$result = mysqli_query($con, $sql);


//$sql = "SELECT * FROM Orders";
//$result = mysqli_query($con, $sql);

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
		<td>" . $row["IDCustomer"]. "</td>
        <td>" . $row["FirstName"]. "</td>
        <td>" . $row["LastName"]. "</td>
		<td>" . $row["IDOrder"]. "</td>
        <td>" . $row["Sent"]. "</td>
        <td><a href='adminViewSpecificOrder.php?id=".$row['IDOrder']."'>View</a></td>
    	<td><a href='adminDeleteOrder.php?id=".$row['IDOrder']."'>DELETE</a></td></tr>";
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

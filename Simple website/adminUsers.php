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


$sql = "SELECT * FROM Customers";
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>Customer ID</th>
    <th>Password</th>
    <th>Type</th>
	<th>First Name</th>
    <th>Last Name</th>
    <th>Address</th>
    <th>Email</th>
    <th>Phonenumber</th>
    <th>Delete User</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
		<td>" . $row["IDCustomer"]. "</td>
        <td>" . $row["Password"]. "</td>
        <td>" . $row["Type"]. "</td>
		<td>" . $row["FirstName"]. "</td>
        <td>" . $row["LastName"]. "</td>
        <td>" . $row["BillingAddress"]. "</td>
		<td>" . $row["Email"]. "</td>
        <td>" . $row["PhoneNumber"]. "</td>
    	<td><a href='adminDeleteCustomer.php?id=".$row['IDCustomer']."'>DELETE</a></td></tr>";
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

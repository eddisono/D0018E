<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Customer Register Account</title>
</head>
<body>
<?php include 'customerMenu.php';?>
<?php include 'openconnection.php';?>
<?php 
$Uid = $_SESSION["UID"];
$sql = "SELECT * FROM Customers WHERE IDCustomer = $Uid";
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>Customer ID</th>
    <th>Password</th>
	<th>First Name</th>
    <th>Last Name</th>
    <th>Address</th>
    <th>Email</th>
    <th>Phonenumber</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
		<td>" . $row["IDCustomer"]. "</td>
        <td>" . $row["Password"]. "</td>
		<td>" . $row["FirstName"]. "</td>
        <td>" . $row["LastName"]. "</td>
        <td>" . $row["BillingAddress"]. "</td>
		<td>" . $row["Email"]. "</td>
        <td>" . $row["PhoneNumber"]. "</td></tr>";
    }
    echo "</table>";
    echo"<br><br>";
} else {
    echo "0 results";
}

?>
<form method="post" action="insert.php">
    Billing Address : <input type="text" name="userAddress" required><br><br>
	Email : <input type="text" name="userEmail" required><br><br>
	Phone Number : <input type="text" name="phoneNumber" required><br><br>
    <input type="submit" name="submitChangedUserCheckout" value="Submit">
</form>

<?php mysqli_close($con)?>
</body>
</html>
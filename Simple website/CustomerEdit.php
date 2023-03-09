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
    First Name : <input type="text" name="firstName"><br><br>
    Last Name : <input type="text" name="lastName"><br><br>
    Billing Address : <input type="text" name="userAddress"><br><br>
	Email : <input type="text" name="userEmail"><br><br>
	Phone Number : <input type="text" name="phoneNumber"><br><br>
    Password : <input type="text" name="Password"><br><br>
    <input type="submit" name="submitChangedUser" value="Submit">
</form>

<?php
$sql = "SELECT IDReview, SodaName, Text, Date FROM Reviews WHERE IDCustomer = '$Uid' ORDER BY Date DESC";
        $result = mysqli_query($con, $sql);

        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        echo"<br>YOUR REVIEWS: <br>";
        echo "<table><tr>
            <th>SodaName</th>
            <th>Review Text</th>
            <th>Date</th>
            <th>Delete Review</th></tr>";
        foreach ($data as $row){
            echo "<tr>
            <td>" . $row["SodaName"]. "</td>
            <td>" . $row["Text"]. "</td>
            <td>" . $row["Date"]. "</td>
            <td><a href='deleteReview.php?id=".$row['IDReview']."'>Delete</a></td></tr>";
        }
        echo "</table>";
?>

<?php mysqli_close($con)?>
</body>
</html>
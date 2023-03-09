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

$Uid = $_SESSION["UID"];

$test = "SELECT * FROM ShoppingCart WHERE IDOrder IN (SELECT IDOrder FROM Orders WHERE IDCustomer = '$Uid' AND Sent = '0')";

//$sql = "SELECT SodaName, Quantity FROM ShoppingCart";
$result = mysqli_query($con, $test);

if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>Order ID</th>
    <th>Soda</th>
    <th>Quantity</th>
    <th>SUM</th>
    <th>Delete Soda</th>
    <th>Add Soda</th>
    <th>Decrease Soda</th></tr>";
    // output data of each row
    $totsum = 0;
    while($row = $result->fetch_assoc()) {
        $SodaName = $row["SodaName"];
        $sql = "SELECT Price FROM Sodas WHERE SodaName = '$SodaName'";
        $rs = mysqli_query($con, $sql);
        $rsArray = $rs->fetch_assoc();
        $sum = $rsArray["Price"] * $row["Quantity"];
        
        //$totsum = $totsum + $sum; 

        echo "<tr>
        <td>" . $row["IDOrder"]. "</td>
		<td>" . $row["SodaName"]. "</td>
        <td>" . $row["Quantity"]. "</td>
        <td>" . $sum. "</td>
        <td><a href='CustomerDeleteSoda.php?id=".$row['SodaName']."'>Delete</a>
        <td><a href='CustomerAddSoda.php?id=".$row['SodaName']."'>+</a></td>
        <td><a href='CustomerDecreaseSoda.php?id=".$row['SodaName']."'>-</a></td></tr>";
    }
    echo "</table>";

    $sql = "SELECT * FROM Orders WHERE IDCustomer = '$Uid' AND Sent = '0'";
    $rs = mysqli_query($con, $sql);
    $row = $rs->fetch_assoc();
    $totsum = $row["Price"];
    echo"<br> TOTAL: " . $totsum . "";
} else {
    echo "0 results";
}
mysqli_close($con);

 
if(isset($_POST['button1'])) {
    include 'openconnection.php';
    $sql = "UPDATE Orders SET Sent = '1', Price = $totsum WHERE IDCustomer = '$Uid' AND Sent = '0'";
    $rs = mysqli_query($con, $sql);
    mysqli_close($con);
    header('Location: ./CustomerShoppingCart.php');
}


//header('Location: .inventory.php');
?>

<form method="post">
        <input type="submit" name="button1"
                value="Purchase"/>
</form>

<?php mysqli_close($con)?>


    </body>
</html>

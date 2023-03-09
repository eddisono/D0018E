<?php
    session_start();
?>
<?php include 'openconnection.php';?>

<?php
$Uid = $_SESSION["UID"];
$SodaName = $_GET['id'];
echo"STEP 1<br>";

$sql = "SELECT Quantity FROM Sodas WHERE SodaName = '$SodaName'";
$rs = mysqli_query($con, $sql);
if (mysqli_num_rows($rs) == 0){
    echo "Sorry, no more of this soda in stock";
}
else{
    echo"STEP 2<br>";
    $sql = "SELECT IDOrder FROM Orders WHERE IDCustomer = $Uid AND Sent = '0'";
    $rs = mysqli_query($con, $sql);
    if(mysqli_num_rows($rs) > 0){	//Item Exists
        mysqli_begin_transaction($con);

        // Reduce amount of sodas within the inventory
        $sql = "UPDATE Sodas SET Quantity = Quantity - 1  WHERE SodaName = '$SodaName'";
        $rs = mysqli_query($con, $sql);

        // Update only the soda with the correct Order ID
        $sql = "UPDATE ShoppingCart SET Quantity = Quantity + 1  WHERE SodaName = '$SodaName' AND IDOrder IN (SELECT IDOrder FROM Orders WHERE IDCustomer = $Uid AND Sent = '0')";
        $rs = mysqli_query($con, $sql);
        mysqli_commit($con);
    }
}

    

if($rs){
    echo " Succesfully increased!";
}

//SET PRICE IN ORDER
$sql = "SELECT ShoppingCart.IDOrder, ShoppingCart.SodaName, ShoppingCart.Quantity, Sodas.Price FROM ShoppingCart INNER JOIN Sodas ON ShoppingCart.SodaName =Sodas.SodaName WHERE IDOrder IN (SELECT IDOrder FROM Orders WHERE IDCustomer = $Uid AND Sent = '0')";
$rs = mysqli_query($con, $sql);
$totPrice = 0;
while($row = $rs->fetch_assoc()) {
    $totPrice = $totPrice + $row["Quantity"] * $row["Price"];
}
$sql = "UPDATE Orders SET Price = $totPrice WHERE IDCustomer = $Uid AND Sent = '0'";
$rs = mysqli_query($con, $sql);



mysqli_close($con);
header('Location: ./CustomerShoppingCart.php');



?>


<?php mysqli_close($con)?>

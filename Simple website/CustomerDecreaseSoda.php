<?php
    session_start();
?>
<?php include 'openconnection.php';?>

<?php
$Uid = $_SESSION["UID"];
$SodaName = $_GET['id'];
echo"STEP 1<br>";



$sql = "SELECT Quantity FROM ShoppingCart WHERE SodaName = '$SodaName' and IDOrder IN (SELECT IDOrder FROM Orders WHERE IDCustomer = $Uid AND Sent = '0')";
$rs = mysqli_query($con, $sql);
if (mysqli_num_rows($rs) == 0){
    echo "ERROR";
}
else{
    $row = $rs->fetch_assoc();
	$Quantity = $row["Quantity"];
    if($Quantity > 0){
        echo"starting transaction";
        mysqli_begin_transaction($con);

        // Increase amount of sodas within the inventory
        $sql = "UPDATE Sodas SET Quantity = Quantity + 1 WHERE SodaName = '$SodaName'";
        $rs = mysqli_query($con, $sql);

        // Update only the soda with the correct Order ID
        $sql = "UPDATE ShoppingCart SET Quantity = Quantity - 1  WHERE SodaName = '$SodaName' AND IDOrder IN (SELECT IDOrder FROM Orders WHERE IDCustomer = $Uid AND Sent = '0')";
        $rs = mysqli_query($con, $sql);
        mysqli_commit($con);

    }
    else{
        Echo"no sodas to remove";
    }
}    

if($rs){
    echo " Succesfully Decresed!";
}
// check if item in shoppingcart should be deleted.
$sql = "SELECT Quantity FROM ShoppingCart WHERE SodaName = '$SodaName' and IDOrder IN (SELECT IDOrder FROM Orders WHERE IDCustomer = $Uid AND Sent = '0')";
$rs = mysqli_query($con, $sql);
$row = $rs->fetch_assoc();
if ($row["Quantity"] <= 0){
    $sql = "DELETE FROM ShoppingCart WHERE SodaName = '$SodaName' AND IDOrder IN (SELECT IDOrder FROM Orders WHERE IDCustomer = $Uid AND Sent = '0')";
    $rs = mysqli_query($con, $sql);
}

//check if order should be deleted.
$sql = "SELECT * FROM ShoppingCart WHERE IDOrder IN (SELECT IDOrder FROM Orders WHERE IDCustomer = $Uid AND Sent = '0')";
$rs = mysqli_query($con, $sql);
$row = $rs->fetch_assoc();
if ($row["Quantity"] <= 0){
    $sql = "DELETE FROM Orders WHERE IDCustomer = $Uid AND Sent = '0'";
    $rs = mysqli_query($con, $sql);
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
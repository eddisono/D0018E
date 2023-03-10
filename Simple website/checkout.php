<?php session_start(); ?>
<?php include 'openconnection.php';?>

<?php
$Uid = $_SESSION["UID"];

$sql = "SELECT * FROM Customers";
$rs = mysqli_query($con, $sql);
//$row = $rs->fetch_assoc();
while($row = $rs->fetch_assoc()) {
    if ($row['BillingAddress'] == "" || $row['Email'] == "" || $row['PhoneNumber'] == ""){
        header('Location: ./checkoutEdit.php');
        mysqli_close($con);
    }
}

if(isset($_POST['button2'])) {

    $sql = "UPDATE Orders SET Sent = '1' WHERE IDCustomer = $Uid AND Sent = '0'";
    $rs = mysqli_query($con, $sql);
    mysqli_close($con);
    header('Location: ./CustomerShoppingCart.php');
}
?>
<a href="CustomerShoppingCart.php">Back to shopping cart</a>
<h2>Once you've payed through the swish QR, you can finish checkout</h2>
<img src="./qr-code.png" alt="QR for swish">
<form method="post" action="checkout.php">
        <input type="submit" name="button2" value="Finish Checkout"/>
</form>



<?php mysqli_close($con)?>

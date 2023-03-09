<?php session_start(); ?>



<html>
    <head>
		<meta charset="utf-8">
        <title>A Meaningful Page Title</title>
    </head>
    
    <body>

<?php
	include 'openconnection.php';
	//No protection From Negative Store Inventory ----------------------

	$SodaName = $_GET['id'];
	$myID = $_SESSION["UID"];

	$sql = "SELECT Quantity FROM Sodas WHERE SodaName = '$SodaName'";
	$rs = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($rs);
	if($row["Quantity"] > 0){

		//Check if Order Exists
		$sql = "SELECT IDOrder FROM Orders WHERE IDCustomer = $myID AND Sent = 0";
		$rs = mysqli_query($con, $sql);

		//if Order not existing, Create Order before proceeding
		if(mysqli_num_rows($rs) == 0){	
			$sql = "INSERT INTO Orders (IDCustomer) VALUES ('$myID')";
			$rs = mysqli_query($con, $sql);
		}

		//ORDER EXIST, Proceed
		$sql = "SELECT IDOrder FROM Orders WHERE IDCustomer = $myID AND Sent = 0";
		$rs = mysqli_query($con, $sql);

		if(mysqli_num_rows($rs) == 1){
			$row = $rs->fetch_assoc();
			$IDOrder = $row["IDOrder"];

			$sql = "SELECT * FROM ShoppingCart WHERE IDOrder = '$IDOrder' and SodaName = '$SodaName'";	// '$Myvar' <-- NÖDVÄNDIGT vid mer än en var efter WHERE!
			$rs = mysqli_query($con, $sql);
			$row = $rs->fetch_assoc();
			
			if(mysqli_num_rows($rs) == 1){	//Item Exists in Order
				mysqli_begin_transaction($con);
				$sql = "UPDATE Sodas SET Quantity = Quantity - 1  WHERE SodaName = '$SodaName'";
				$rs = mysqli_query($con, $sql);
				$sql = "UPDATE ShoppingCart SET Quantity = Quantity + 1  WHERE SodaName = '$SodaName'";
				$rs = mysqli_query($con, $sql);
				mysqli_commit($con);
			}
			elseif(mysqli_num_rows($rs) == 0){	// item not in order
				mysqli_begin_transaction($con);
				$sql = "UPDATE Sodas SET Quantity = Quantity - 1  WHERE SodaName = '$SodaName'";
				$rs = mysqli_query($con, $sql);
				$sql = "INSERT INTO ShoppingCart (IDOrder, SodaName, Quantity) VALUES ('$IDOrder', '$SodaName', '1')";
				$rs = mysqli_query($con, $sql);
				mysqli_commit($con);
			}
			else{
				echo "ERROR ILLEGAL ROW NR RETURNED";
			}
		}
		else{
			echo "ERROR FAILURE WITH ORDER";
		}
	}

//SET PRICE IN ORDER
$sql = "SELECT ShoppingCart.IDOrder, ShoppingCart.SodaName, ShoppingCart.Quantity, Sodas.Price FROM ShoppingCart INNER JOIN Sodas ON ShoppingCart.SodaName =Sodas.SodaName WHERE IDOrder IN (SELECT IDOrder FROM Orders WHERE IDCustomer = $myID AND Sent = '0')";
$rs = mysqli_query($con, $sql);
$totPrice = 0;
while($row = $rs->fetch_assoc()) {
    $totPrice = $totPrice + $row["Quantity"] * $row["Price"];
}
$sql = "UPDATE Orders SET Price = $totPrice WHERE IDCustomer = $myID AND Sent = '0'";
$rs = mysqli_query($con, $sql);

	mysqli_close($con);
	header('Location: ./CustomerInventory.php');

?>
    </body>
</html>
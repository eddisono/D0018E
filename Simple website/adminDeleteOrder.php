<?php session_start(); ?>
<?php include 'openconnection.php';?>




<?php

$IDOrder = $_GET['id'];

$sql = "SELECT * FROM ShoppingCart WHERE IDOrder = '$IDOrder' ";
$rs = mysqli_query($con, $sql);
if (mysqli_num_rows($rs) > 0) {
    echo"FOUND ROWS: ". mysqli_num_rows($rs) . " <br>";
    // remove all sodas individually

    $data = array();
    while($row = mysqli_fetch_assoc($rs)){
        $data[] = $row;
    }
    mysqli_begin_transaction($con);
    foreach ($data as $row){
        echo"" . $row["SodaName"] . "<br>";
        echo"" . $row["Quantity"] . "<br>";
        $Quantity = $row["Quantity"];
        $SodaName = $row["SodaName"];

        
        
        // Increase amount of sodas within the inventory
        $sql = "UPDATE Sodas SET Quantity = Quantity + '$Quantity' WHERE SodaName = '$SodaName'";
        $rs = mysqli_query($con, $sql);

        // Update only the soda with the correct Order ID
        $sql = "DELETE FROM ShoppingCart WHERE SodaName = '$SodaName' AND IDOrder = '$IDOrder'";
        $rs = mysqli_query($con, $sql);


    }
    $sql = "DELETE FROM Orders WHERE IDOrder = '$IDOrder'";
    $rs = mysqli_query($con, $sql);
    mysqli_commit($con);


} else {
echo "0 results";
}
mysqli_close($con);



if($_SESSION["TYPE"] == 'Admin'){ header('Location: ./adminOrders.php');}
elseif($_SESSION["TYPE"] == 'Employee'){ header('Location: ./employeeOrders.php');}
else {echo"Uid ERROR!";}

?>


<?php mysqli_close($con)?>
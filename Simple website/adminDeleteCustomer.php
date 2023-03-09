<?php session_start(); ?>
<?php include 'openconnection.php';?>

<?php
$IDCustomer = $_GET['id'];

$topsql = "SELECT IDOrder FROM Orders WHERE IDCustomer = '$IDCustomer' ";
$toprs = mysqli_query($con, $topsql);
$topdata = array();
while($toprow = mysqli_fetch_assoc($toprs)){
    $topdata[] = $toprow;
}

mysqli_begin_transaction($con); // CLEAN UP

foreach ($topdata as $toprow){
    $IDOrder = $toprow["IDOrder"];

    $sql = "SELECT * FROM ShoppingCart WHERE IDOrder = '$IDOrder' ";
    $rs = mysqli_query($con, $sql);
    if (mysqli_num_rows($rs) > 0) {
        echo"FOUND ROWS: ". mysqli_num_rows($rs) . " <br>";
        // remove all sodas individually

        $data = array();
        while($row = mysqli_fetch_assoc($rs)){
            $data[] = $row;
        }
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
        


    } else {
    echo "ZERO ORDERS FOUND";
    }
}

$sql = "DELETE FROM Reviews WHERE IDCustomer = '$IDCustomer'";
$rs = mysqli_query($con, $sql);

$sql = "DELETE FROM Customers WHERE IDCustomer = '$IDCustomer'";
$rs = mysqli_query($con, $sql);
mysqli_commit($con);

mysqli_close($con);
//header('Location: ./adminUsers.php');

if($_SESSION["TYPE"] == 'Admin'){ header('Location: ./adminUsers.php');}
elseif($_SESSION["TYPE"] == 'Employee'){ header('Location: ./employeeUsers.php');}
else {echo"Uid ERROR!";}
?>


<?php mysqli_close($con)?>
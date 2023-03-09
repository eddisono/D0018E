<?php session_start(); ?>
<?php include 'openconnection.php';?>

<?php
$sodaName = $_GET['id'];

$sql = "DELETE FROM Reviews WHERE SodaName = '$sodaName'";
$rs = mysqli_query($con, $sql);
$sql = "DELETE FROM ShoppingCart WHERE SodaName = '$sodaName'";
$rs = mysqli_query($con, $sql);
$sql = "DELETE FROM Sodas WHERE SodaName = '$sodaName'";
$rs = mysqli_query($con, $sql);

if($rs){
    echo "Soda deleted!";
}
//header('Location: ./adminInventory.php');
if($_SESSION["TYPE"] == 'Admin'){ header('Location: ./adminInventory.php');}
elseif($_SESSION["TYPE"] == 'Employee'){ header('Location: ./employeeInventory.php');}
else {echo"Uid ERROR!";}
?>

<?php mysqli_close($con)
;?>

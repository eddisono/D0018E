<?php session_start(); ?>
<?php include 'openconnection.php';?>

<?php
$sodaName = $_GET['id'];
echo "$sodaName";
$sql = "UPDATE Sodas SET Quantity = Quantity + 1  WHERE SodaName = '$sodaName'";
$rs = mysqli_query($con, $sql);

if($rs){
    echo " Succesfully increased!";
}
//header('Location: ./adminInventory.php');


if($_SESSION["TYPE"] == 'Admin'){ header('Location: ./adminInventory.php');}
elseif($_SESSION["TYPE"] == 'Employee'){ header('Location: ./employeeInventory.php');}
else {echo"Uid ERROR!";}
?>

<?php mysqli_close($con)?>

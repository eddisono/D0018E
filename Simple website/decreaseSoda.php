<?php include 'openconnection.php';?>

<?php
$sodaName = $_GET['id'];
echo "$sodaName";
$sql = "UPDATE Sodas SET Quantity = Quantity - 1  WHERE Soda = '$sodaName'";
$rs = mysqli_query($con, $sql);

if($rs){
    echo " Succesfully decreased!";
}
header('Location: ./inventory.php');
?>

<?php mysqli_close($con)?>

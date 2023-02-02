<?php include 'openconnection.php';?>

<?php
$sodaName = $_GET['id'];
$sql = "DELETE FROM Sodas WHERE Soda = '$sodaName'";
$rs = mysqli_query($con, $sql);

if($rs){
    echo "Soda deleted!";
}
header('Location: ./inventory.php');
?>

<?php mysqli_close($con)
;?>

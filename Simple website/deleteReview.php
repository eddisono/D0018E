<?php session_start(); ?>
<?php include 'openconnection.php';?>

<?php
$IDReview = $_GET['id'];
$sql = "DELETE FROM Reviews WHERE IDReview = '$IDReview'";
$result = mysqli_query($con, $sql);
?>

<?php mysqli_close($con);
    //header('Location: ./adminInventory.php');
    if($_SESSION["TYPE"] == 'Admin'){ header('Location: ./adminInventory.php');}
    elseif($_SESSION["TYPE"] == 'Employee'){ header('Location: ./employeeInventory.php');}
    else {header('Location: ./CustomerEdit.php');}
?>
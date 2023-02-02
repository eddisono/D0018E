<?php include 'openconnection.php';?>

<?php
if(isset($_POST['submit'])){
    $sodaName = $_POST['sodaname'];
    $sodaprice = $_POST['price'];
    $sodaquantity = $_POST['quantity'];
}

$sql = "INSERT INTO Sodas (Soda, Price, Quantity) VALUES ('$sodaName', '$sodaprice', '$sodaquantity')";

$rs = mysqli_query($con, $sql);
if($rs){
    echo "Entries added!";
}
?>

<?php mysqli_close($con)?>
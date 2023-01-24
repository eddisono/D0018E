<?php
$servername = "127.0.0.1";
$username = "20001030";
$password = "rodLadaGarFort";
$db_name = "db20001030";

if(isset($_POST['submit'])){
    $sodaName = $_POST['sodaname'];
    $sodaprice = $_POST['price'];
    $sodaquantity = $_POST['quantity'];
}

// Create connection
$con = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (!$con){
    die("Connection failed! " . mysqli_connect_error());
}
else{
    echo "Connection successful! 
    
    ";
}

$sql = "INSERT INTO Sodas (SodaName, Price, Quantity) VALUES ('$sodaName', '$sodaprice', '$sodaquantity')";

$rs = mysqli_query($con, $sql);
if($rs){
    echo "Entries added!";
}

mysqli_close($con)

?>
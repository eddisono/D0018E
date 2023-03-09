<?php session_start(); ?>
<?php
	
	//No protection From Negative Store Inventory ----------------------

    if(isset($_POST['submitReview'])){
    $ReviewText = $_POST['reviewText'];
    $SodaName = $_POST['SodaName'];
    $myID = $_SESSION["UID"];
    include 'openconnection.php';

	$sql = "INSERT INTO Reviews (IDCustomer, SodaName, Text, Date) VALUES ('$myID', '$SodaName', '$ReviewText', CURRENT_TIMESTAMP())";
	$rs = mysqli_query($con, $sql);
    echo"SQL DONE";
    if($rs){
        echo "Review Added";
    }
	mysqli_close($con);
    header('Location: ./CustomerInventory.php');
    }

	//$SodaName = $_GET['id'];
	

?>

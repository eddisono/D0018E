<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <title>A Meaningful Page Title</title>
    </head>
    
    <body>
	<?php 

    if($_SESSION["TYPE"] == 'Admin'){ include 'menu.php';}
    elseif($_SESSION["TYPE"] == 'Employee'){ include 'employeeMenu.php';}
    else {echo"Uid ERROR!";}
    ?>


<?php include 'openconnection.php';?>
<?php



$IDOrder = $_GET['id'];
echo"<br>ORDER ID: ". $IDOrder ."<br>";

$sql = "SELECT * FROM ShoppingCart WHERE IDOrder = $IDOrder";
$result = mysqli_query($con, $sql);

if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>Soda Name</th>
	<th>Quantity</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
		<td>" . $row["SodaName"]. "</td>
		<td>" . $row["Quantity"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
//header('Location: .inventory.php');
?>

<?php mysqli_close($con)?>


    </body>
</html>

<?php session_start(); ?>
<?php
echo '<a href="CustomerPage.php">home</a> -
<a href="CustomerShoppingCart.php">Shopping cart</a> -
<a href="CustomerInventory.php">Inventory</a> - 
<a href="CustomerEdit.php">Edit Profile</a> -
<a href="CustomerCompletedOrders.php">View Completed Orders</a>';
echo "  USER ID: " . $_SESSION["UID"] . " USER TYPE: " .$_SESSION["TYPE"] . "<br>";
?>

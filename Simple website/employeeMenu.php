<?php session_start(); ?>
<?php
echo '<a href="employeePage.php">Insert Soda</a> -
<a href="/employeeUsers.php">Users</a> -
<a href="/employeeOrders.php">Orders</a> -
<a href="employeeInventory.php">Inventory</a>';
echo "  USER ID: " . $_SESSION["UID"] . " USER TYPE: " .$_SESSION["TYPE"] . "<br>";
?>
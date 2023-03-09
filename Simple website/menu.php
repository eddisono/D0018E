<?php session_start(); ?>
<?php
echo '<a href="adminPage.php">Insert Soda</a> -
<a href="/adminUsers.php">Users</a> -
<a href="/adminOrders.php">Orders</a> -
<a href="adminInventory.php">Inventory</a> -
<a href="adminAddEmployee.php">Add Employee</a>';
echo "  USER ID: " . $_SESSION["UID"] . " USER TYPE: " .$_SESSION["TYPE"] . "<br>";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Customer Register Account</title>
</head>
<body>
<?php include 'menu.php';?>

<h1>Please register a new user</h1>

<form method="post" action="insert.php">
    First Name : <input type="text" name="firstName"><br><br>
    Last Name : <input type="text" name="lastName"><br><br>
    Billing Address : <input type="text" name="userAddress"><br><br>
	Email : <input type="text" name="userEmail"><br><br>
	Phone Number : <input type="text" name="phoneNumber"><br><br>
    Password : <input type="text" name="Password"><br><br>
    <input type="submit" name="submitEmployee" value="Submit">
</form>




</body>
</html>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <title>A Meaningful Page Title</title>
    </head>
    
    <body>
		<?php include 'employeeMenu.php';?>

        <form method="post" action="insert.php">
            Name of soda : <input type="text" name="sodaname"><br><br>
            Price of soda : <input type="text" name="price"><br><br>
            Quantity of soda : <input type="text" name="quantity"><br><br>
            <input type="submit" name="submitSoda" value="Submit">
        </form>

    </body>
</html>
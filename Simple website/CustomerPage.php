<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <title>A Meaningful Page Title</title>
    </head>
    
    <body>
		<?php include 'customerMenu.php';?>

		<?php
			echo "UID is: " . $_SESSION["UID"] . ".<br>";
		?>
		


    </body>
</html>

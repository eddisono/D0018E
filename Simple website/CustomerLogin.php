<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <title>A Meaningful Page Title</title>
    </head>
    
    <body>
		<a href="./customerRegister.php">Register new account</a>

        <form method="post" action="loginBackend.php">
            Enter your ID : <input type="text" name="UserID"><br><br>
            <input type="submit" name="submit" if="submit" value="Submit">
        </form>

    </body>
</html>

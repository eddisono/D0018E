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
        <?php
            $SodaName = $_GET['id'];
            echo "Soda you're reviewing: ". $SodaName;
            ?>
		<form method="post" action="reviewBackend.php">
            What do you think? : <input type="text" name="reviewText"><br><br>
            <input type="hidden" name="SodaName" value="<?= $SodaName ?>">
            <input type="submit" name="submitReview" if="submit" value=Submit>
        </form>

    </body>
</html>

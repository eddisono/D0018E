<?php
$servername = "localhost";
$username = "phpmyadmin";
$password = "";     // Add your own password here
$db_name = "Sodas";

// Create connection
$con = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (!$con){
    die("Connection failed! " . mysqli_connect_error());
}
else{
    echo "Connection successful! 
    
    ";
}
?>

<?php
// Start the session MUST ALLWAYS ME FIRST
session_start();
?>

<?php include 'openconnection.php';?>

<?php
if(isset($_POST['submit'])){
    $UserID = $_POST['UserID'];
    $Pass = $_POST['Password'];
}

$checkID = "SELECT * FROM Customers WHERE IDCustomer = '$UserID' AND Password = '$Pass'";
$rs = mysqli_query($con, $checkID);
echo"RADER " . $rs->num_rows . "<br>";

if($rs){
    if($rs->num_rows > 0){
        while($row = $rs->fetch_assoc()){
            $_SESSION["UID"] = "$UserID";
            $_SESSION["TYPE"] = $row["Type"];

            if ($row["Type"] == 'Admin'){
                mysqli_close($con);
                header('Location: ./adminPage.php');
            }
            else if ($row["Type"] == 'Employee'){
                mysqli_close($con);
                header('Location: ./employeePage.php');
            }
            else{
                mysqli_close($con);
                header('Location: ./CustomerPage.php');
            }
        }
    }
    else{
        mysqli_close($con);
        header('Location: ./customerRegister.php');
    }
}


?>

<?php mysqli_close($con)?>


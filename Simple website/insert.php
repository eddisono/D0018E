<?php session_start(); ?>
<?php include 'openconnection.php'; ?>

<?php
if(isset($_POST['submitSoda'])){
    $sodaName = $_POST['sodaname'];
    $sodaprice = $_POST['price'];
    $sodaquantity = $_POST['quantity'];

    $insertSoda = "INSERT INTO Sodas (SodaName, Price, Quantity) VALUES ('$sodaName', '$sodaprice', '$sodaquantity')";

    $rs = mysqli_query($con, $insertSoda);
    if($rs){
        echo "Entries added!";
    }
    else{
        echo "Entry unsuccessful!";
    }
    
    mysqli_close($con);

    
    if($_SESSION["TYPE"] == 'Admin'){ header('Location: ./adminPage.php');}
    elseif($_SESSION["TYPE"] == 'Employee'){ header('Location: ./employeePage.php');}
    else {echo"Uid ERROR!";}
    
}


if(isset($_POST['submitUser'])){
    $FirstName = $_POST['firstName'];
    $LastName = $_POST['lastName'];
    $Billing = $_POST['userAddress'];
    $mail = $_POST['userEmail'];
    $number = $_POST['phoneNumber'];
    $Password = $_POST['Password'];

    $insertUser = "INSERT INTO Customers (FirstName, LastName, BillingAddress, Email, PhoneNumber, Type, Password)
    VALUES ('$FirstName', '$LastName', '$Billing', '$mail', '$number', 'Customer', '$Password')";

    $result = mysqli_query($con, $insertUser);
    if($result){
        echo "User Added!";
        
        //Tar första bästa, om nånn annan har samma namn kommer man loggas in som den. Ful lösning med ORDER BY tar senaste tillagda.
        $getID = "SELECT * FROM Customers WHERE FirstName = '$FirstName' AND LastName = '$LastName' AND BillingAddress = '$Billing' AND Email = '$mail' AND PhoneNumber = '$number' ORDER BY IDCustomer DESC"; 
        $rs = mysqli_query($con, $getID);
        if($rs){
            if(mysqli_num_rows($rs) > 0){
                $row = $rs->fetch_assoc();
                $_SESSION["UID"] = $row["IDCustomer"];
                $_SESSION["TYPE"] = $row["Type"];
                
                mysqli_close($con);
                header('Location: ./CustomerPage.php');
                
            }
        }
        
    }
}
if(isset($_POST['submitChangedUser'])){
    echo"found SubmitChangedUser <br>";
    $FirstName = $_POST['firstName'];
    $LastName = $_POST['lastName'];
    $Billing = $_POST['userAddress'];
    $mail = $_POST['userEmail'];
    $number = $_POST['phoneNumber'];
    $Password = $_POST['Password'];

    $Uid = $_SESSION["UID"];
    echo $Uid ;
    //$sql = "UPDATE Customers SET 'FirstName' = '$FirstName', 'LastName' = '$LastName', 'BillingAddress' = '$Billing', 'Email' = '$mail', 'PhoneNumber' = '$number', 'Password' = '$Password' WHERE IDCustomer = '$Uid'";
    //$sql = "UPDATE Customers SET 'FirstName' = $FirstName, 'LastName' = $LastName, WHERE IDCustomer = $Uid";
    $sql = "UPDATE Customers SET FirstName = '$FirstName', LastName = '$LastName', BillingAddress = '$Billing', Email = '$mail', PhoneNumber = '$number', Password = '$Password' WHERE IDCustomer = $Uid;";
    $result = mysqli_query($con, $sql);
    echo $result;
    echo"preformed update <br>";
    if($result){
        echo "User Changed! ";
        mysqli_close($con);
        header('Location: ./CustomerPage.php');
        
    }
    else{
        mysqli_close($con);
        echo "User Update failed!";
    }
}

if(isset($_POST['submitEmployee'])){
    $FirstName = $_POST['firstName'];
    $LastName = $_POST['lastName'];
    $Billing = $_POST['userAddress'];
    $mail = $_POST['userEmail'];
    $number = $_POST['phoneNumber'];
    $Password = $_POST['Password'];

    $insertUser = "INSERT INTO Customers (FirstName, LastName, BillingAddress, Email, PhoneNumber, Type, Password)
    VALUES ('$FirstName', '$LastName', '$Billing', '$mail', '$number', 'Employee', '$Password')";

    $result = mysqli_query($con, $insertUser);
    if($result){
        echo "User Added!";
        
        //Tar första bästa, om nånn annan har samma namn kommer man loggas in som den. Ful lösning med ORDER BY tar senaste tillagda.
        $getID = "SELECT IDCustomer FROM Customers WHERE FirstName = '$FirstName' AND LastName = '$LastName' AND BillingAddress = '$Billing' AND Email = '$mail' AND PhoneNumber = '$number' ORDER BY IDCustomer DESC"; 
        $rs = mysqli_query($con, $getID);
        if($rs){
            if(mysqli_num_rows($rs) > 0){
                $row = $rs->fetch_assoc();
                $_SESSION["UID"] = $row["IDCustomer"];
                
                mysqli_close($con);
                header('Location: ./adminUsers.php');
                
            }
        }
        
    }
}

?>

<?php mysqli_close($con)?>

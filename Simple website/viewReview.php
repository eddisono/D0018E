<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
        <title>A Meaningful Page Title</title>
    </head>
    
    <body>
    <?php include 'openconnection.php';?>

	<?php 

    if($_SESSION["TYPE"] == 'Customer'){ include 'customerMenu.php';
        $SodaName = $_GET['id'];

        $sql = "SELECT Customers.FirstName, Customers.LastName, Reviews.Text, Reviews.Date FROM Reviews INNER JOIN Customers ON Reviews.IDCustomer=Customers.IDCustomer WHERE Reviews.SodaName = '$SodaName' ORDER BY Reviews.Date DESC";
        $result = mysqli_query($con, $sql);
        
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        echo"Reviws of " . $SodaName . ": <br>";
        echo "<table><tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Review Text</th>
            <th>Date</th></tr>";
        foreach ($data as $row){
            echo "<tr>
            <td>" . $row["FirstName"]. "</td>
            <td>" . $row["LastName"]. "</td>
            <td>" . $row["Text"]. "</td>
            <td>" . $row["Date"]. "</td></tr>";
        
            

        }
        echo "</table>";
    }
    elseif($_SESSION["TYPE"] == 'Employee'){ include 'employeeMenu.php';
    
        $SodaName = $_GET['id'];

        $sql = "SELECT Reviews.IDReview, Customers.FirstName, Customers.LastName, Reviews.Text, Reviews.Date FROM Reviews INNER JOIN Customers ON Reviews.IDCustomer=Customers.IDCustomer WHERE Reviews.SodaName = '$SodaName' ORDER BY Reviews.Date DESC";
        $result = mysqli_query($con, $sql);

        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        echo"<tr>Reviws of " . $SodaName . ": </tr><br>";
        echo "<table><tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Review Text</th>
            <th>Date</th>
            <th>Delete Review</th></tr>";
        foreach ($data as $row){
            echo "<tr>
            <td>" . $row["FirstName"]. "</td>
            <td>" . $row["LastName"]. "</td>
            <td>" . $row["Text"]. "</td>
            <td>" . $row["Date"]. "</td>
            <td><a href='deleteReview.php?id=".$row['IDReview']."'>Delete</a></td></tr>";
        }
        echo "</table>";
    }
    elseif($_SESSION["TYPE"] == 'Admin'){ include 'menu.php';
    
        $SodaName = $_GET['id'];

        $sql = "SELECT Reviews.IDReview, Customers.FirstName, Customers.LastName, Reviews.Text, Reviews.Date FROM Reviews INNER JOIN Customers ON Reviews.IDCustomer=Customers.IDCustomer WHERE Reviews.SodaName = '$SodaName' ORDER BY Reviews.Date DESC";
        $result = mysqli_query($con, $sql);

        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        echo"<tr>Reviws of " . $SodaName . ": </tr><br>";
        echo "<table><tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Review Text</th>
            <th>Date</th>
            <th>Delete Review</th></tr>";
        foreach ($data as $row){
            echo "<tr>
            <td>" . $row["FirstName"]. "</td>
            <td>" . $row["LastName"]. "</td>
            <td>" . $row["Text"]. "</td>
            <td>" . $row["Date"]. "</td>
            <td><a href='deleteReview.php?id=".$row['IDReview']."'>Delete</a></td></tr>";
        }
        echo "</table>";
    }
?>

<?php mysqli_close($con)?>


    </body>
</html>

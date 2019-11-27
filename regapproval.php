<?php
include_once 'db.php';
securitygate($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Registration Approval - Old Home</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="adminreport.php">Admin Home</a></li>
            <li><a href="regapproval.php">Registration Approval</a></li>
            <li><a href="supervisorhome.php">Supervisor Home</a></li>
            <li><a href="caregiverhome.php">Caregiver Home</a></li>
            <li><a href="doctorhome.php">Doctor Home</a></li>
            <li><a href="familyhome.php">Family Home</a></li>
            <li><a href="patienthome.php">Patient Home</a></li>
            <li><a href="rosterhome.php">Roster Home</a></li>
            <li><a href="employee.php">Employee</a></li>
            <li><a href="doctappt.php">Doctor Appointments</a></li>
            <li><a href="patientinfo.php">Patient Info</a></li>
            <li><a href="patientofdoc.php">Patients of Doctor</a></li>
            <li><a href="payment.php">Payments</a></li>
            <li><a href="role.php">Role</a></li>
            <li><a href="newroster.php">New Roster</a></li>


        </ul>
    </nav>





    <form action="regapproval.php" method="post">
        <fieldset>
            <legend>Registration Approval</legend>

            <?php
        $approved = $_POST['approved'] ?? '';
        $denied = $_POST['denied'] ?? '';

        $i = 1;
        $sql = "SELECT fname, lname, role, userid
        FROM users
        WHERE approved = 0;";
        $userid = "SELECT userid FROM users;";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0) {




        echo "<table border='1'>";
        echo "<tr><td>Name</td><td>Role</td><td>Yes</td><td>No</td><tr>\n";
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['userid'];
            echo "<tr class='index'>";
            echo"<td>{$row['fname']} {$row['lname']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td><button type='submit' value='$id' name='approved' >Approve</button></td>";
            echo "<td><button type='submit' value='$id' name='denied' >Deny</button></td>";
            echo "</tr>\n";

        }
    } else {
        echo "No users to approve!";
    }

        echo "</table>";




        if( isset($_POST['approved']) )  {
            echo $approved;
            $makeapproved = "UPDATE users SET approved = 1 WHERE userid = '$approved';";
            mysqli_query($conn, $makeapproved);
            header("Refresh:0");
        }
        elseif ( isset($_POST['denied']) ) {
            $remove_patient = "DELETE FROM patient WHERE userid = '$denied';";
            mysqli_query($conn, $remove_patient);
            echo $denied;
            $remove_users = "DELETE FROM users WHERE userid = '$denied';";
            mysqli_query($conn, $remove_users);
            header("Refresh:0");
        }

        ?>
        </fieldset>


    </form>
</body>

</html>
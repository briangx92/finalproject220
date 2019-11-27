<?php
include_once 'db.php';
securitygate($conn);

?>

<?php
// SQL CODE TO LIST PATIENTS

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Caregiver Home - Old Home</title>
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
            <li><a href="payments.php">Payments</a></li>
            <li><a href="role.php">Role</a></li>


        </ul>
    </nav>
    <form action="" method="post">
        <button type="submit" value="submit" name="submit">List Patients Duty Today</button>
    </form>
    <table>

        <tr>
            <th>Name</th>
            <th>Morning Medicine</th>
            <th>Afternoon Medicine</th>
            <th>Night Medicine</th>
            <th>Breakfast</th>
            <th>Lunch</th>
            <th>Dinner</th>
        </tr>
        <?php

    // WHILE LOOP TO CREATE A TABLE FOR THE LIST OF PATIENTS DUTY <tr></tr> <td></td>
    ?>


    </table>
    <!-- OK and Cancel Form -->
    <form action="" method="post">
        <button type="submit" name="submit" value="submit">Ok</button>
        <input type="button" onclick="location.href='index.php';" value="Cancel">
    </form>


</body>

</html>

<?php


?>
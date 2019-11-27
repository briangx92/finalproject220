<?php
include_once 'db.php';
securitygate($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
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


        </ul>
    </nav>
    <form action="">
        <fieldset>
            <input type="date" name="date">
            <button type="submit" value="submit" name="submit">Search</button>
        </fieldset>
    </form>
    <!-- Missed Patient Activity code here -->
    <!-- Don't really know how to go about this part -->
    <!-- End Code -->
    <table>

        <tr>
            <th>Name</th>
            <th>Doctor's Name</th>
            <th>Doctor's Appointment</th>
            <th>Caregiver's Name</th>
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



</body>

</html>
<?php
include_once 'db.php';
securitygate($conn);
?>
<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Family Home - Old Home</title>
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
    <main>

    </main>
    <form action="" method="post">
        <fieldset>
            <legend>Family Member's Home</legend>
            <label>Date: </label>
            <input type="date" name="date">
            <br>
            <label>Family code: </label>
            <input type="text" name="famcode">
            <br>
            <label>Patient ID: </label>
            <input type="text" name="patid" id="">
            <br>
            <button type="submit" value="ok" name="ok">OK</button>
            <input type="button" onclick="location.href='index.php';" value="Cancel">
        </fieldset>
    </form>

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

    // WHILE LOOP TO CREATE A TABLE FOR THE LIST OF PATIENTS INFO <tr></tr> <td></td>
    ?>


    </table>

</body>

</html>

<?php


?>
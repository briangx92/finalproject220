<?php
include_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" type="text/css" rel="stylesheet">
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
    <form action="verify.php" method="post">
        <label> Email:
            <input type="email" name="email">
        </label>
        <label> Password:
            <input type="password" name="password">
        </label>
        <br>
        <button type="submit" name="submit" value="submit">Ok</button>
        <input type="button" onclick="location.href='index.php';" value="Cancel">
        <input type="button" onclick="location.href='register.php';" value="Register">

    </form>
    <footer>

    </footer>
</body>

</html>
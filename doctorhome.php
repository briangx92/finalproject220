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
    <title>Old Home</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>

<body>
    <!--Doctors home table  -->
    <table>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Comment</th>
            <th>Morning Meds</th>
            <th>Afternoon Meds</th>
            <th>Night Meds</th>
        </tr>
        <?php
    // PHP CODE FOR LISTING RESULTS OF PATIENTS
    ?>
    </table>
    <input type="date" name="date">
    <button type="submit">Appointments</button>
    <table>
        <tr>
            <th>Patient</th>
            <th>Date</th>
        </tr>
        <?php

    // PHP CODE FOR LISTING APPOINTMENTS
    ?>
    </table>
</body>

</html>

<?php


?>
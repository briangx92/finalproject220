<?php
include_once 'db.php';

session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
}
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
<body>
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

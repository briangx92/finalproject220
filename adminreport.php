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
</head>

<body>
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

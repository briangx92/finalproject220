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
    <title>Patient Home - Old Home</title>
</head>

<body>
    <main>
        <label>Date: </label>
        <input type="date" name="date" value="">
        <label>Patient Name:
            <!-- Session username here --></label>
        <label>Patient ID:
            <!-- Session patientid here --></label>

        <br>
        <form action="" method="post">

            <table>

                <legend>Patients Home</legend>
                <tr>
                    <th>Doctor</th>
                    <th>Appointment</th>
                    <th>Caregiver</th>
                    <th>Morning Medicine</th>
                    <th>Afternoon Medicine</th>
                    <th>Night Medicine</th>
                    <th>Breakfast</th>
                    <th>Lunch</th>
                    <th>Dinner</th>
                </tr>

            </table>




        </form>
    </main>


</body>

</html>

<?php


?>

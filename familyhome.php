<?php
include_once 'db.php';
securitygate($conn);

// POSTS

$submit = isset($_POST['submit']);
$famcode = $_POST['famcode'] ?? '';
$patientid = $_POST['patid'] ?? '';
$date = ''; // Current date stuff needed

// SQL variables

$sql_all = "SELECT *
FROM `users` u 
	LEFT JOIN `doctor_appt` d ON d.`doctorid` = u.`userid` 
	LEFT JOIN `patient_activity` pa ON pa.`caregiver` = u.`userid` 
    LEFT JOIN `patient` p ON d.`patientid` = p.`patientid` WHERE p.family_code = '$famcode' AND p.patientid = '$patientid';";

// MYSQL Query
$sql_query = mysqli_query($conn, $sql_all);

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
            <button type="submit" value="submit" name="submit">OK</button>
            <input type="button" onclick="location.href='index.php';" value="Cancel">
        </fieldset>
    </form>

    <table>

        <tr>
            <th>Doctor</th>
            <th>Doctor's Appointment</th>
            <th>Caregiver</th>
            <th>Morning Medicine</th>
            <th>Afternoon Medicine</th>
            <th>Night Medicine</th>
            <th>Breakfast</th>
            <th>Lunch</th>
            <th>Dinner</th>
        </tr>
        <tr>
            <?php
            if ($submit) {

                if (mysqli_num_rows($sql_query) > 0) {
                    while ($row = mysqli_fetch_array($sql_query)) {
                        echo "<td>{$row['fname']} {$row['lname']}</td>";
                        echo "<td>{$row['apt_date']}</td>";
                        echo "<td>{$row['caregiver']}</td>";
                        echo "<td>{$row['morning_meds']}</td>";
                        echo "<td>{$row['afternoon_med']}</td>";
                        echo "<td>{$row['night_med']}</td>";
                        echo "<td>{$row['breakfast']}</td>";
                        echo "<td>{$row['lunch']}</td>";
                        echo "<td>{$row['dinner']}</td>";
                    }
                }
            }

            ?>

        </tr>



    </table>

</body>

</html>

<?php


?>
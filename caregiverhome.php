<?php
include_once 'db.php';
securitygate($conn);
$list = isset($_POST['list']);




$today = date('Y/m/d');
$date = date('Y/m/d');

echo $date;
// SQL Query Variables

$sql_patient_activity_today = "SELECT * FROM patient_activity p JOIN users u ON p.patientid = u.userid WHERE p.today = '$today';";

// MYSQL Queries

$patient_activity_today_query = mysqli_query($conn, $sql_patient_activity_today);



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
    <form action="caregiverhome.php" method="post">
        <button type="submit" value="list" name="list">List Patients Duty Today</button>
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
        <tr>

            <?php


            if ($list) {
                if (mysqli_num_rows($patient_activity_today_query) > 0) {
                    while ($row = mysqli_fetch_assoc($patient_activity_today_query)) {
                        if ($row['morning_meds'] == 1) {
                            $morning = "<td><input type='checkbox' name='morning_meds' checked></td>";
                        } elseif ($row['morning_meds'] == 0) {
                            $morning = "<td><input type='checkbox' name='morning_meds'></td>";
                        }
                        if ($row['afternoon_meds'] == 1) {
                            $afternoon = "<td><input type='checkbox' name='afternoon_meds' checked></td>";
                        } elseif ($row['afternoon_meds'] == 0) {
                            $afternoon = "<td><input type='checkbox' name='afternoon_meds'></td>";
                        }
                        if ($row['night_meds'] == 1) {
                            $night = "<td><input type='checkbox' name='night_meds' checked></td>";
                        } elseif ($row['night_meds'] == 0) {
                            $night = "<td><input type='checkbox' name='night_meds'></td>";
                        }
                        if ($row['breakfast'] == 1) {
                            $breakfast = "<td><input type='checkbox' name='breakfast' checked></td>";
                        } elseif ($row['breakfast'] == 0) {
                            $breakfast = "<td><input type='checkbox' name='breakfast'></td>";
                        }
                        if ($row['lunch'] == 1) {
                            $lunch = "<td><input type='checkbox' name='lunch' checked></td>";
                        } elseif ($row['lunch'] == 0) {
                            $lunch = "<td><input type='checkbox' name='lunch'></td>";
                        }
                        if ($row['dinner'] == 1) {
                            $dinner = "<td><input type='checkbox' name='dinner' checked></td>";
                        } elseif ($row['dinner'] == 0) {
                            $dinner = "<td><input type='checkbox' name='dinner'></td>";
                        }


                        echo "<td>{$row['fname']} {$row['lname']}</td>";
                        echo $morning;
                        echo $afternoon;
                        echo $night;
                        echo $breakfast;
                        echo $lunch;
                        echo $dinner;
                    }
                }
            }

            ?>

        </tr>
        <input type="button" onclick="location.href='index.php';" value="Cancel">



    </table>



    </form>


</body>

</html>
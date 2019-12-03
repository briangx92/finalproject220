<?php
include_once 'db.php';
securitygate($conn);
$list = isset($_POST['list']);
$submit = isset($_POST['submit']);



$today = date('Y/m/d');


// SQL Query Variables
// $sql_patient_activity = "SELECT CONCAT(u.fname, ' ', u.lname) AS name, p.morning_meds, p.afternoon_meds, p.night_meds, p.breakfast, p.lunch, p.dinner FROM patient_activity p JOIN users u ON p.patientid = u.userid;";

$sql_patient_activity_today = "SELECT CONCAT(u.fname, ' ', u.lname) AS name, p.morning_meds, p.afternoon_meds, p.night_meds, p.breakfast, p.lunch, p.dinner FROM patient_activity p JOIN users u ON p.patientid = u.userid WHERE p.today = '$today';";

// MYSQL Queries
// list_activity_query = mysqli_query($conn, $sql_patient_activity);
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
    <form action="" method="post">
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
                        echo "<td>{$row['name']}</td>";
                        echo "<td><input type='checkbox' name='morning_meds' value='1'></td>";
                        echo "<td><input type='checkbox' name='afternoon_meds' value='1'></td>";
                        echo "<td><input type='checkbox' name='night_meds' value='1'></td>";
                        echo "<td><input type='checkbox' name='breakfast' value='1'></td>";
                        echo "<td><input type='checkbox' name='lunch' value='1'></td>";
                        echo "<td><input type='checkbox' name='dinner' value='1'></td>";
                    }
                }
            }

            ?>

        </tr>


    </table>

    <button type="submit" name="submit" value="submit">Submit</button>
    <input type="button" onclick="location.href='index.php';" value="Cancel">
    </form>


</body>

</html>

<?php


?>

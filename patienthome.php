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
            <?php
            $theid = $_SESSION['id'] ;
            $sql = "SELECT fname, lname FROM users WHERE userid = '$theid';";
            $nameis = mysqli_query($conn, $sql);
            $havename = mysqli_fetch_assoc($nameis);
            echo ucfirst($havename['fname']) . ' ' . ucfirst($havename['lname']);?>
        </label>
        <label>Patient ID:
            <?php
            echo $_SESSION['id'];?></label>

        <br>
        <form action="" method="post">

            <table>

                <legend>Patients Home</legend>
                <tr>
                    <th>Doctor</th>
                    <th>Appointment</th>
                    <th>Morning Medicine</th>
                    <th>Afternoon Medicine</th>
                    <th>Night Medicine</th>
                </tr>
<?php               $sql_search = "SELECT DISTINCT CONCAT(u.fname, ' ', u.lname) AS name, d.doctorid, d.apt_date, d.morning_med, d.afternoon_med, d.night_med FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE d.patientid = '$theid';";
                    $name_query = mysqli_query($conn, $sql_search);
                    if (mysqli_num_rows($name_query) > 0) {
                        while ($row = mysqli_fetch_assoc($name_query)) {
                            $doctorid = $row['doctorid'];
                            $getit = "SELECT CONCAT(fname, ' ', lname) AS name FROM users WHERE userid = '$doctorid';";
                            $docname_query = mysqli_query($conn, $getit);
                            $nameofdoc = mysqli_fetch_assoc($docname_query);
                            echo "<tr>";
                            echo "<td>{$nameofdoc['name']}</td>";
                            echo "<td>{$row['apt_date']}</td>";
                            echo "<td>{$row['morning_med']}</td>";
                            echo "<td>{$row['afternoon_med']}</td>";
                            echo "<td>{$row['night_med']}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
        </table>
        <hr>
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
                $sql_patient_activity = "SELECT CONCAT(u.fname, ' ', u.lname) AS name, p.today, p.morning_meds, p.afternoon_meds, p.night_meds, p.breakfast, p.lunch, p.dinner FROM patient_activity p JOIN users u ON p.patientid = u.userid WHERE p.patientid = '$theid';";
                $patient_activity_query = mysqli_query($conn, $sql_patient_activity);
                    if (mysqli_num_rows($patient_activity_query) > 0) {
                        while ($row = mysqli_fetch_assoc($patient_activity_query)) {
                            echo "<td>{$row['today']}</td>";
                            echo "<td><input type='checkbox'";
                            if ($row['morning_meds'] == 1) {
                                echo "checked";
                            }
                            echo " disabled name='morning_meds' value='1'></td>";
                            echo "<td><input type='checkbox'";
                            if ($row['afternoon_meds'] == 1) {
                                echo "checked";
                            }
                            echo " disabled name='afternoon_meds' value='1'></td>";
                            echo "<td><input type='checkbox'";
                            if ($row['night_meds'] == 1) {
                                echo "checked";
                            }
                            echo " disabled name='night_meds' value='1'></td>";
                            echo "<td><input type='checkbox'";
                            if ($row['breakfast'] == 1) {
                                echo "checked";
                            }
                            echo " disabled name='breakfast' value='1'></td>";
                            echo "<td><input type='checkbox'";
                            if ($row['lunch'] == 1) {
                                echo "checked";
                            }
                            echo " disabled name='lunch' value='1'></td>";
                            echo "<td><input type='checkbox'";
                            if ($row['dinner'] == 1) {
                                echo "checked";
                            }
                            echo " disabled name='dinner' value='1'></td>";
                        }
                    }

                ?>

            </tr>


        </table>
    </form>
    </main>


</body>

</html>

<?php


?>

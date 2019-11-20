<?php
include_once 'db.php';
session_start();
?>
<?php



// POSTS
$patientid = $_POST['patid'] ?? '';
$apt_date = $_POST['date'] ?? '';
$docid = $_POST['doctorid'] ?? '';


// SQL Variable Queries

$sql_doctor = "SELECT fname, lname FROM users WHERE role = 'doctor';";

$sql_patient = "SELECT * FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE d.patientid = '$patientid';";

$sql_date = "SELECT * FROM users u JOIN doctor_appt d ON u.userid = d.doctorid WHERE d.apt_date = '$apt_date';";

$sql_new_appt = "INSERT INTO doct_appt (patientid, doctorid, apt_date)
VALUES ($patientid, $docid, $apt_date);";

// Doctor Query
$sql_doc_query = mysqli_query($conn, $sql_doctor);
$result_doctor = mysqli_fetch_assoc($sql_doc_query);

// Patient Query
$sql_query_patient = mysqli_query($conn, $sql_patient);
$result_patient = mysqli_fetch_assoc($sql_query_patient);

// Date Query
$sql_query_date = mysqli_query($conn, $sql_date);
$result_date = mysqli_fetch_assoc($sql_query_date);

// Insert Query
$sql_query_insert = mysqli_query($conn, $sql_new_appt);
$result_insert = mysqli_fetch_assoc($sql_query_insert);

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
            <legend>Doctors Appointment</legend>
            <label>Patient ID</label>
            <input type="text" name="patid" value="<?php ?>">
            <br>
            <label>Patient: <?php echo "{$result_patient['fname']} {$result_patient['lname']}"; ?></label>
            <br>
            <label>Date</label>
            <input type="date" name="date" value="<?php  ?>">
            <label>Doctor</label>
            <select name="doctor">
                <?php
                if($result_doctor > 0) {
                    while($row = mysqli_fetch_assoc($sql_query_user)) {
                        echo "<option>{$row['fname']} {$row['lname']}</option>";
                    }
                }
                ?>
            </select>
            <br>
            
            <button type="submit" value="submit">Submit</button>

        </fieldset>

    </form>

</body>

</html>

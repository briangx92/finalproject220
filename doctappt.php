<?php
include_once 'db.php';
?>
<?php



// Posts
$apt_date = $_POST['date'] ?? '';
$patientid = $_POST['patid'] ?? '';


// Queries
$sql_doctor = "SELECT fname, lname FROM users;";
$sql_date = "SELECT * FROM users u JOIN doctor_appt d ON u.userid = d.doctorid WHERE d.apt_date = '$apt_date';";
$sql_user = "SELECT * FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE d.patientid = '$patientid';";

// User Query
$sql_query_user = mysqli_query($conn, $sql_user);
$result_user = mysqli_fetch_assoc($sql_query_user);

// Date Query
$sql_query_date = mysqli_query($conn, $sql_date);
$result_date = mysqli_fetch_assoc($sql_query_date);


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
            <input type="text" name="patid" value="<?php echo "{$result_date['patientid']}"; ?>">
            <br>
            <label>Patient: <?php echo "{$result_user['fname']} {$result_user['lname']}"; ?></label>
            <br>
            <label>Date</label>
            <input type="date" name="date" value="<?php  echo $apt_date; ?>">
            <label>Doctor</label>
            <select name="doctor">
                <?php
           
                echo "<option>{$result_date['fname']} {$result_date['lname']}</option>";
                ?>
            </select>
            <button type="submit" value="submit">Submit</button>
        </fieldset>
    </form>

</body>

</html>

<?php


?>
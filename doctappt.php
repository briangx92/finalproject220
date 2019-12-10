<?php
include_once 'db.php';
securitygate($conn);
?>
<?php
// POSTS
$patientid = $_POST['patientid'] ?? '';
$date = $_POST['date'] ?? '';
$doctor = $_POST['doctor'] ?? '';

$submit = isset($_POST['submit']);
$search = isset($_POST['search']);

// SQL Query Variables
$sql_patientid = "SELECT * FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE d.patientid = '$patientid';";

$sql_date = "SELECT * FROM users u JOIN doctor_appt d ON u.userid = d.doctorid WHERE d.apt_date = '$date';";



$sql_doctor = "SELECT DISTINCT * FROM users WHERE role = 'doctor';";


// MYSQL Queries

// Patient ID
$sql_patid_query = mysqli_query($conn, $sql_patientid);
$result_patientid = mysqli_fetch_assoc($sql_patid_query);

// Date
$sql_date_query = mysqli_query($conn, $sql_date);
$result_date = mysqli_fetch_assoc($sql_date_query);

$patient = "{$result_patientid['fname']} {$result_patientid['lname']}";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Doctor Appointments - Old Home</title>
</head>

<body>
    <form action="" method="post">
        <fieldset>
            <legend>Doctors Appointment</legend>
            <label>Patient ID: </label>
            <input type="text" name="patientid" value="<?php echo $patientid; ?>">
            <label>Patient Name: <?php if ($search) {
                                        echo "{$patient}";
                                    } ?></label>
            <br>

            <label>Date: </label>
            <input type="date" name="date" value='<?php echo $date; ?>'>
            <br>
            <label>Doctor: </label>
            <select name="doctor">
                <option>-- SELECT --</option>
                <?php
                $result = mysqli_query($conn, $sql_doctor);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $docid = $row['userid'];
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        echo "<option value='{$docid}'>{$fname} {$lname} ID: {$docid}</option>";
                    }
                }

                ?>
            </select>
            <br>
            <button type="submit" name="search" value="">Search Patient ID</button>
            <button type="submit" name="submit" value="">Submit Form</button>
            <?php

            if ($submit) {
                if ($date < date('Y/m/d')) {
                    echo "Enter valid date";
                } else {
                    $patientid = $_POST['patientid'] ?? '';
                    $date = $_POST['date'] ?? '';
                    $doctor = $_POST['doctor'] ?? '';
                    $sql_new_apt = "INSERT INTO doctor_appt (patientid, doctorid, apt_date) VALUES ($patientid, $docid, '$date');";

                    echo mysqli_query($conn, $sql_new_apt);
                }
            }


            ?>

        </fieldset>

    </form>

</body>

</html>
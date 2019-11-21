<?php
include_once 'db.php';
securitygate($conn);

$getpatientid = $_POST['getpatientid'] ?? '';
$getpatientid = intval($getpatientid);
$getpatient = "SELECT * FROM patient WHERE patientid = '$getpatientid'";
$patientinfo = mysqli_query($conn, $getpatient);
$wegood = mysqli_fetch_assoc($patientinfo);
$nameid = $wegood['userid'];
$nameget = "SELECT fname,lname FROM users WHERE userid = '$nameid'";
$namegot = mysqli_query($conn, $nameget);
$getgot = mysqli_fetch_assoc($namegot);

// Money Owed Calculation
$admindate = $wegood['admission_date'];
$admindate = date_create($admindate);
$date = date_create(date('Y/m/d'));
$interval = date_diff($admindate, $date);
$date_difference = $interval->format('%a');

$appointment_count = "SELECT count(patientid) FROM doctor_appt WHERE patientid = '$getpatientid'";
$numgot = mysqli_query($conn, $appointment_count);
$appointno = mysqli_fetch_assoc($numgot);
$numnappoint = $appointno['count(patientid)'];
$thecost = ($numnappoint * 50) + ($date_difference * 10);
?>
<?php

// sql statement to search for patid
// sql statement that will search for total due and math operations
// sql statement that will insert payment
// echo into inputs
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
        <legend>Payment</legend>
        <label>Patient ID:</label>
        <input type="text" name="getpatientid">
        <input type="submit">
        Patient Name: <?php echo $getgot['fname'] . ' ' . $getgot['lname']; ?>
        <br>
        <label>Total Due: $</label>
        <input type="text" name="due" value=" <?php echo $thecost ?>" disabled>
        <br>
        <label>New Payment: $</label>
        <input type="text" name="pay" placeholder="0.00" value="<?php // sql variable for insert ?>">
        <br>
        <button type="submit" value="ok">Ok</button>
        <input type="button" onclick="location.href='index.php';" value="Cancel">
    </fieldset>
</form>

<p>$10 for every day</p>
<p>$50 for every appointment</p>
</body>
</html>

<?php


?>

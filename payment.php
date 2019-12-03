<?php
include_once 'db.php';
securitygate($conn);

// POSTS
$patientid = $_POST['patientid'] ?? '';
$due = $_POST['due'] ?? '';
$newpayment = $_POST['pay'] ?? '';
$submit = isset($_POST['submit']);
$search = isset($_POST['search']);

// SQL Variables
    // SELECT statements
$sql_patient_name = "SELECT fname, lname, userid FROM users WHERE userid = '$patientid';";

$sql_appt_count = "SELECT count(patientid) FROM doctor_appt WHERE patientid = '$patientid';";

$sql_admission_date = "SELECT admission_date FROM patient WHERE patientid= '$patientid';";

$sql_amount_due = "SELECT amount_due FROM patient WHERE patientid = '$patientid';";

$sql_appt_date_count = "SELECT count(apt_date) FROM doctor_appt WHERE patientid = '$patientid';";

    // UPDATE Values
$sql_new_payment = "UPDATE patient SET amount_due = amount_due - '$newpayment' WHERE patientid = '$patientid';";



// MYSQL Queries
$patient_name_query = mysqli_query($conn, $sql_patient_name);
$appt_count_query = mysqli_query($conn, $sql_appt_count);
$appt_date_count_query = mysqli_query($conn, $sql_appt_date_count);
$admission_date_query = mysqli_query($conn, $sql_admission_date);
$amount_due_query = mysqli_query($conn, $sql_amount_due);

// Query Results
$patient_name_result = mysqli_fetch_assoc($patient_name_query);
$appt_count_result = mysqli_fetch_assoc($appt_count_query);
$appt_date_result = mysqli_fetch_assoc($appt_date_count_query);
$admission_date_result = mysqli_fetch_assoc($admission_date_query);
$amount_due_result = mysqli_fetch_assoc($amount_due_query);


// Admission Date
$date = date_create(date('Y-m-d'));
$admission_date = date_create($admission_date_result['admission_date']);
$admission = $admission_date_result['admission_date'];


// CREATE EVENT to update the DB on a regular schedule
    // Living Charge event $10 daily

if ($submit) {
    $event_name = "living_charge_{$patient_name_result['fname']}{$patient_name_result['lname']}{$patient_name_result['userid']}";

    $sql_living_charge = "CREATE EVENT IF NOT EXISTS $event_name
    ON SCHEDULE EVERY 1 DAY
    STARTS '$admission' + INTERVAL 1 DAY
    DO
    UPDATE old_home.patient SET amount_due = amount_due + 10 WHERE patientid = '$patientid';";

    mysqli_query($conn, $sql_living_charge);

}
else {}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Payment - Old Home</title>
</head>

<body>
    <form action="" method="post">


        <fieldset>
            <legend>Payment</legend>
            <label>Patient ID:</label>
            <input type="text" name="patientid" value="<?php echo $patientid; ?>">
            <button type="submit" name="search">Search</button>
            Patient Name:
            <?php if($search) {echo "{$patient_name_result['fname']} {$patient_name_result['lname']}";} ?>
            <br>
            <label>Total Due: $</label>
            <input type="text" name="due" value=" <?php if ($search) {echo "{$amount_due_result['amount_due']}";} ?>"
                disabled>
            <br>
            <label>New Payment: $</label>
            <input type="text" name="pay" placeholder="0.00" value="<?php if ($submit) {
            $new_payment_query = mysqli_query($conn, $sql_new_payment);}?>">
            <br>
            <button type="submit" value="submit" name="submit">Submit</button>
            <input type="button" onclick="location.href='index.php';" value="Cancel">
        </fieldset>
    </form>

    <p>$10 for every day</p>
    <p>$50 for every appointment</p>
    <p>$5 for every medicine a month</p>
</body>

</html>

<?php


?>

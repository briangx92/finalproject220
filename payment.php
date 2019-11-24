<?php
include_once 'db.php';
securitygate($conn);

// $getpatientid = $_POST['getpatientid'] ?? '';
// $getpatientid = intval($getpatientid);
// $getpatient = "SELECT * FROM patient WHERE patientid = '$getpatientid'";
// $patientinfo = mysqli_query($conn, $getpatient);
// $wegood = mysqli_fetch_assoc($patientinfo);
// $nameid = $wegood['userid'];
// $amount_paid = $wegood['amount_paid'];
// $nameget = "SELECT fname,lname FROM users WHERE userid = '$nameid'";
// $namegot = mysqli_query($conn, $nameget);
// $getgot = mysqli_fetch_assoc($namegot);

// // Money Owed Calculation
// $admindate = $wegood['admission_date'];
// $admindate = date_create($admindate);
// $date = date_create(date('Y/m/d'));
// $interval = date_diff($admindate, $date);
// $date_difference = $interval->format('%a');

// $appointment_count = "SELECT count(patientid) FROM doctor_appt WHERE patientid = '$getpatientid'";
// $numgot = mysqli_query($conn, $appointment_count);
// $appointno = mysqli_fetch_assoc($numgot);
// $numnappoint = $appointno['count(patientid)'];
// $thecost = ($numnappoint * 50) + ($date_difference * 10) - $amount_paid;

// $pay = $_POST['pay'] ?? '';
// $newtotal = intval($thecost) - intval($pay);
// $moneyupdate = "UPDATE patient SET amount_paid = $newtotal WHERE patientid = '$getpatientid';";
// mysqli_query($conn, $moneyupdate);

// POSTS
$patientid = $_POST['patientid'] ?? '';
$due = $_POST['due'] ?? '';
$newpayment = $_POST['pay'] ?? '';
$newcharge = 0;
$submit = isset($_POST['submit']);
$search = isset($_POST['search']);

// SQL Variables
// SELECT statements
$sql_patient_name = "SELECT fname, lname FROM users WHERE userid = '$patientid';";

$sql_appt_count = "SELECT count(patientid) FROM doctor_appt WHERE patientid = '$patientid';";

$sql_admission_date = "SELECT admission_date FROM patient WHERE patientid= '$patientid';";

$sql_amount_due = "SELECT amount_due FROM patient WHERE patientid = '$patientid';";

$sql_med_charge = "SELECT count(patientid) FROM prescription WHERE patientid = '$patientid';";

$sql_appt_date_count = "SELECT count(apt_date) FROM doctor_appt WHERE patientid = '$patientid';";

// UPDATE Values
$sql_new_payment = "UPDATE patient SET amount_due = amount_due - '$newpayment' WHERE patientid = '$patientid';";

$sql_add_charge = "UPDATE amount_due FROM patient SET amount_due = amount_due + '$newcharge' WHERE patientid = $patientid;";

// MYSQL Queries
$patient_name_query = mysqli_query($conn, $sql_patient_name);
$appt_count_query = mysqli_query($conn, $sql_appt_count);
$appt_date_count_query = mysqli_query($conn, $sql_appt_date_count);
$admission_date_query = mysqli_query($conn, $sql_admission_date);
$amount_due_query = mysqli_query($conn, $sql_amount_due);
$med_charge_query = mysqli_query($conn, $sql_med_charge);

$add_charge_query = mysqli_query($conn, $sql_add_charge);

// Query Results
$patient_name_result = mysqli_fetch_assoc($patient_name_query);
$appt_count_result = mysqli_fetch_assoc($appt_count_query);
$appt_date_result = mysqli_fetch_assoc($appt_date_count_query);
$admission_date_result = mysqli_fetch_assoc($admission_date_query);
$amount_due_result = mysqli_fetch_assoc($amount_due_query);
$med_charge_result = mysqli_fetch_assoc($med_charge_query);

$add_charge_result = mysqli_fetch_assoc($add_charge_query);

// Math

// Current Date
$date = date_create(date('Y-m-d'));
$admission_date = date_create($admission_date_result['admission_date']);

// Date Difference
$interval = date_diff($admission_date,$date);
$date_difference = $interval->format('%a');

// Charge $10 for every day living on property
$living_charge = $date_difference * 10;
$newcharge += $living_charge;

// Charge $50 for every appointment

print_r($appt_count_result);


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
        <?php  ; ?>
        <legend>Payment</legend>
        <label>Patient ID:</label>
        <input type="text" name="patientid" value=" <?php echo $patientid; ?>">
        <button type="submit" name="search">Search</button>
        Patient Name: 
        <?php if($search) {echo "{$patient_name_result['fname']} {$patient_name_result['lname']}";} ?>
        <br>
        <label>Total Due: $</label>
        <input type="text" name="due" value=" <?php if ($search) {echo "{$amount_due_result['amount_due']}";} ?>" disabled>
        <br>
        <label>New Payment: $</label>
        <input type="text" name="pay" placeholder="0.00" value="<?php if ($submit) {
            @$new_payment_query = mysqli_query($conn, $sql_new_payment);
            @$new_payment_result = mysqli_fetch_assoc($new_payment_query);
            echo "{$newpayment}";}?>">
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

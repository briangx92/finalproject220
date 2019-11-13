<?php
include_once 'db.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
}
?>
<?php

$getpatientid = $_POST['getpatientid'] ?? '';
$getpatientid = intval($getpatientid);

$getpatient = "SELECT * FROM patient WHERE patientid = '$getpatientid'";
$patientinfo = mysqli_query($conn, $getpatient);
$wegood = mysqli_fetch_assoc($patientinfo);

$nameid = $wegood['userid'];
$nameget = "SELECT fname,lname FROM users WHERE userid = '$nameid'";
$namegot = mysqli_query($conn, $nameget);
$getgot = mysqli_fetch_assoc($namegot);
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

<!-- Patient  Information Form-->
<form action="patientinfo.php" method="POST">
    <fieldset>
        <legend>Patient Information</legend>
        <p>
        Patient ID: <input type="text" name="getpatientid" value="<?php echo $wegood['patientid'];?>" >
        <input type="submit">
        <br>
        Group: <input type="text" name="group" value="<?php echo $wegood['group_num'];?>">
        Admission Date<input type="date" name="admdate" value="<?php echo $wegood['admission_date'];?>">

        Patient First Name: <input type="text" name="fname" value="<?php echo $getgot['fname']; ?>">
        Patient Last Name: <input type="text" name="lname" value="<?php echo $getgot['lname']; ?>">
        </p>
        <select name="doctor">
            <?php
            // PHP CODE FOR LISTING DOCTORS
            ?>
        </select>
        <button type="submit">Ok</button>
        <input type="button" onclick="location.href='index.php';" value="Cancel">

    </fieldset>
</form>


</body>
</html>

<?php


?>

<?php
include_once 'db.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
}
?>
<?php


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
<form action="" method="POST">
    <fieldset>
        <legend>Patient Information</legend>
        <p>
        Patient ID: <input type="text" name="patientid">
        <br>
        Group: <input type="text" name="group">
        Admission Date<input type="date" name="admdate">

        <input type="date" name="date">
        Patient Name: <input type="text" name="name" value="<?php // CODE FOR PATIENT NAME ?>">
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

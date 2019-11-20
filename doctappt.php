<?php
include_once 'db.php';
securitygate($conn);
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
<form action="" method="post">
    <fieldset>
        <legend>Doctors Appointment</legend>
        <label>Patient ID</label>
            <input type="text" name="patid" value="<?php // sql variable for patient id?>">
        <label>Date</label>
            <input type="date" name="date" value=="<?php // sql variable for date ?>">
        <label>Doctor</label>
            <select name="doctor">
                <option value=""></option>
            </select>
    </fieldset>
</form>

</body>
</html>

<?php


?>

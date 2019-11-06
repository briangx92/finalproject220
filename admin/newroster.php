<?php
include_once 'db.php';
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
        <legend>New Roster</legend>
        <label>Date:</label>
        <input type="date" name="date">
        <label>Supervisor:</label>
        <select name="supervisor">
            <?php
            // PHP CODE FOR LISTING SUPERVISOR
            ?>
        </select>
        <label>Doctor:</label>
        <select name="doctor">
            <?php
            // PHP CODE FOR LISTING DOCTORS
            ?>
        </select>
        <br>
        <label>Caregiver 1:</label>
        <select name="cg1">
            <?php
            // PHP CODE FOR LISTING CAREGIVER 1
            ?>
        </select>
        <select name="cgg1">
            <?php
            // PHP CODE FOR LISTING CAREGIVER GROUP 1
            ?>
        </select>
        <br>
        <label>Caregiver 2:</label>
        <select name="cg2">
            <?php
            // PHP CODE FOR LISTING CAREGIVER 2
            ?>
        </select>
        <select name="cgg2">
            <?php
            // PHP CODE FOR LISTING CAREGIVER GROUP 2
            ?>
        </select>
        <br>
        <label>Caregiver 3:</label>
        <select name="cg3">
            <?php
            // PHP CODE FOR LISTING CAREGIVER 3
            ?>
        </select>
        <select name="cgg3">
            <?php
            // PHP CODE FOR LISTING CAREGIVER GROUP 3
            ?>
        </select>
        <br>
        <label>Caregiver 4:</label>
        <select name="cg4">
            <?php
            // PHP CODE FOR LISTING CAREGIVER 4
            ?>
        </select>
        <select name="cgg4">
            <?php
            // PHP CODE FOR LISTING CAREGIVER GROUP 4
            ?>
        </select>
        <br>

        <button type="submit" value="ok" name="ok">Ok</button>
        <button type="submit" value="cancel" name="cancel">Cancel</button>
      


    </fieldset>
</form>
    
</body>
</html>

<?php


?>
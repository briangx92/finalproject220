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
        <legend>Register</legend>
        <label>Role: </label>
        <select name="role">
            <option value="none">Select</option>
            <option value="admin">Admin</option>
            <option value="patient">Patient</option>
            <option value="family">Family Member</option>
            <option value="doctor">Doctor</option>
            <option value="supervisor">Supervisor</option>

        </select>
        <br>
        <label>First Name: </label>
            <input type="text" name="fname" value="<?php // sql variable ?>">
        <br>
        <label>Last Name: </label>
            <input type="text" name="lname" value="<?php // sql variable ?>">
        <br>
        <label>Email ID: </label>
            <input type="text" name="emailid" value="<?php //sql variable ?>">
        <br>
        <label>Phone: </label>
            <input type="text" name="phone" value="<?php // sql variable ?>">
        <br>
        <label>Date of Birth: </label>
            <input type="text" name="dob" value="<?php // sql variable ?>">
        <br>
        <!-- Make this appear when role is patient -->
        <label>Family Code: </label>
            <input type="text" name="famcode" value="<?php // sql variable ?>">
        <br>
        <label>Emergency Contact: </label>
            <input type="text" name="emcontact" value="<?php // sql variable ?>">
        <br>
        <label>Relationship: </label>
            <input type="text" name="relation" value="<?php // sql variable ?>">
        <!-- End appear -->
        
        <button type="submit" name="submit" value="submit">Ok</button>
        <input type="button" onclick="location.href='index.php';" value="Cancel">



        


    </fieldset>
</form>
    
</body>
</html>

<?php


?>
<?php
include_once 'db.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
}
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
        <input type="text" name="patid" value="<?php // sql variable ?>">
        <br>
        <label>Total Due: $</label>
        <input type="text" name="due" value=" <?php // sql variable ?>" disabled>
        <br>
        <label>New Payment: $</label>
        <input type="text" name="pay" placeholder="00.00" value="<?php // sql variable for insert ?>">
        <br>
        <button type="submit" value="ok">Ok</button>
        <button type="submit" value="cancel">Cancel</button>
    </fieldset>
</form>

<p>$10 for every day</p>
<p>$50 for every appointment</p>
<p>$5 for every medicine/month</p>
</body>
</html>

<?php


?>

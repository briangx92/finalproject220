<?php
include_once 'db.php';

session_start();

if ($_SESSION['role'] = '') {
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
<form action="" method="post">
    <fieldset>
        <legend>Roster</legend>
        <label>Date: </label>
        <input type="date" name="date">
    </fieldset>
</form>

</body>
</html>

<?php


?>

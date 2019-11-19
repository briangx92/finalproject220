<?php
include_once 'db.php';
session_start();

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
        <table>
            <tr>
                <th><h1>Page</h1>
                <th>Admin</th>
                <th>Patient</th>
                <th>Family Member</th>
                <th>Doctor</th>
                <th>Supervisor</th>
                <th>Caregiver</th>
            </tr>

<?php
$dir    = getcwd();
$files = scandir($dir);
        foreach ($files as $page) {
            echo "<tr>";
            echo "<td> $page </td>";
            echo "<td><button type='submit' value='$page' name='' ></button></td>";
            echo "<td><button type='submit' value='$page' name='' ></button></td>";
            echo "<td><button type='submit' value='$page' name='' ></button></td>";
            echo "<td><button type='submit' value='$page' name='' ></button></td>";
            echo "<td><button type='submit' value='$page' name='' ></button></td>";
            echo "<td><button type='submit' value='$page' name='' ></button></td>";
            echo "</tr>";
        }

?>
</body>

</html>

<?php


?>

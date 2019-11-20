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
    <style>
    table {
    border-collapse: collapse;
    width: 100%;
    border-color: 10px solid blue;
    text-align: center;
    }
    th, td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    }
</style>
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

        $dir = getcwd();
        $files = scandir($dir);
        foreach ($files as $page) {
            if ($page == 'index.php' or $page == 'verify.php' or $page == 'db.php') {
                continue;
            }
            elseif (strpos($page, 'php') == True) {
                $sql = "INSERT INTO role (page) VALUES ('$page');";
                if ($conn->query($sql) === TRUE) {
                    echo "Page $page added";
                }
                $getinfo = "SELECT * FROM role WHERE page = '$page'" ;
                $theirinfo = mysqli_query($conn, $getinfo);
                $newinfo = mysqli_fetch_assoc($theirinfo);
                echo "<form action='role.php' method='post'>";
                echo "<tr>";
                echo "<td> $page </td>";
                echo "<td><button type='submit' value='$page' name='admin'>" . ($newinfo['admin'] == 1 ? 'True' : 'False') . "</button></td>";
                echo "<td><button type='submit' value='$page' name='patient'>" . ($newinfo['patient'] == 1 ? 'True' : 'False') . "</button></td>";
                echo "<td><button type='submit' value='$page' name='family'>" . ($newinfo['family'] == 1 ? 'True' : 'False') . "</button></td>";
                echo "<td><button type='submit' value='$page' name='doctor'>" . ($newinfo['doctor'] == 1 ? 'True' : 'False') . "</button></td>";
                echo "<td><button type='submit' value='$page' name='supervisor'>" . ($newinfo['supervisor'] == 1 ? 'True' : 'False') . "</button></td>";
                echo "<td><button type='submit' value='$page' name='caregiver'>" . ($newinfo['caregiver'] == 1 ? 'True' : 'False') . "</button></td>";
                echo "</tr>";
                echo "</form>";
            }
        }

        $admin = $_POST['admin'] ?? '';
        $patient = $_POST['patient'] ?? '';
        $family = $_POST['family'] ?? '';
        $doctor = $_POST['doctor'] ?? '';
        $supervisor = $_POST['supervisor'] ?? '';
        $caregiver = $_POST['caregiver'] ?? '';

?>
</body>

</html>

<?php


?>

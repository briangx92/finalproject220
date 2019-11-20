<?php
include_once 'db.php';
session_start();

$admin = $_POST['admin'] ?? '';
$patient = $_POST['patient'] ?? '';
$family = $_POST['family'] ?? '';
$doctor = $_POST['doctor'] ?? '';
$supervisor = $_POST['supervisor'] ?? '';
$caregiver = $_POST['caregiver'] ?? '';

if( isset($_POST['admin']) )  {
    $getinfo = "SELECT admin FROM role WHERE page = '$admin'" ;
    $theirinfo = mysqli_query($conn, $getinfo);
    $newinfo = mysqli_fetch_assoc($theirinfo);

    $approval = ($newinfo['admin'] == 1 ? 1 : 0);
    if ($approval == 1) {
        $unapprove = "UPDATE role SET admin = 0 WHERE page = '$admin';";
        mysqli_query($conn, $unapprove);
    } else {
        $approve = "UPDATE role SET admin = 1 WHERE page = '$admin';";
        mysqli_query($conn, $approve);
    }
    header("Refresh:0");
} elseif ( isset($_POST['patient']) ) {
    $getinfo = "SELECT patient FROM role WHERE page = '$patient'" ;
    $theirinfo = mysqli_query($conn, $getinfo);
    $newinfo = mysqli_fetch_assoc($theirinfo);
    $approval = ($newinfo['patient'] == 1 ? 1 : 0);
    if ($approval == 1) {
        $unapprove = "UPDATE role SET patient = 0 WHERE page = '$patient';";
        mysqli_query($conn, $unapprove);
    } else {
        $approve = "UPDATE role SET patient = 1 WHERE page = '$patient';";
        mysqli_query($conn, $approve);
    }
    header("Refresh:0");
} elseif ( isset($_POST['family']) ) {
    $getinfo = "SELECT family FROM role WHERE page = '$family'" ;
    $theirinfo = mysqli_query($conn, $getinfo);
    $newinfo = mysqli_fetch_assoc($theirinfo);
    $approval = ($newinfo['family'] == 1 ? 1 : 0);
    if ($approval == 1) {
        $unapprove = "UPDATE role SET family = 0 WHERE page = '$family';";
        mysqli_query($conn, $unapprove);
    } else {
        $approve = "UPDATE role SET family = 1 WHERE page = '$family';";
        mysqli_query($conn, $approve);
    }
    header("Refresh:0");
} elseif ( isset($_POST['doctor']) ) {
    $getinfo = "SELECT doctor FROM role WHERE page = '$doctor'" ;
    $theirinfo = mysqli_query($conn, $getinfo);
    $newinfo = mysqli_fetch_assoc($theirinfo);
    $approval = ($newinfo['doctor'] == 1 ? 1 : 0);
    if ($approval == 1) {
        $unapprove = "UPDATE role SET doctor = 0 WHERE page = '$doctor';";
        mysqli_query($conn, $unapprove);
    } else {
        $approve = "UPDATE role SET doctor = 1 WHERE page = '$doctor';";
        mysqli_query($conn, $approve);
    }
    header("Refresh:0");
} elseif ( isset($_POST['supervisor']) ) {
    $getinfo = "SELECT supervisor FROM role WHERE page = '$supervisor'" ;
    $theirinfo = mysqli_query($conn, $getinfo);
    $newinfo = mysqli_fetch_assoc($theirinfo);
    $approval = ($newinfo['supervisor'] == 1 ? 1 : 0);
    if ($approval == 1) {
        $unapprove = "UPDATE role SET supervisor = 0 WHERE page = '$supervisor';";
        mysqli_query($conn, $unapprove);
    } else {
        $approve = "UPDATE role SET supervisor = 1 WHERE page = '$supervisor';";
        mysqli_query($conn, $approve);
    }
    header("Refresh:0");
} elseif ( isset($_POST['caregiver']) ) {
    $getinfo = "SELECT caregiver FROM role WHERE page = '$caregiver'" ;
    $theirinfo = mysqli_query($conn, $getinfo);
    $newinfo = mysqli_fetch_assoc($theirinfo);
    $approval = ($newinfo['caregiver'] == 1 ? 1 : 0);
    if ($approval == 1) {
        $unapprove = "UPDATE role SET caregiver = 0 WHERE page = '$caregiver';";
        mysqli_query($conn, $unapprove);
    } else {
        $approve = "UPDATE role SET caregiver = 1 WHERE page = '$caregiver';";
        mysqli_query($conn, $approve);
    }
    header("Refresh:0");
}

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
            <form action='role.php' method='post'>
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
                echo "<tr>";
                echo "<td> $page </td>";
                echo "<td><button type='submit' value='$page' name='admin'>" . ($newinfo['admin'] == 1 ? 'Approved' : 'Denied') . "</button></td>";
                echo "<td><button type='submit' value='$page' name='patient'>" . ($newinfo['patient'] == 1 ? 'Approved' : 'Denied') . "</button></td>";
                echo "<td><button type='submit' value='$page' name='family'>" . ($newinfo['family'] == 1 ? 'Approved' : 'Denied') . "</button></td>";
                echo "<td><button type='submit' value='$page' name='doctor'>" . ($newinfo['doctor'] == 1 ? 'Approved' : 'Denied') . "</button></td>";
                echo "<td><button type='submit' value='$page' name='supervisor'>" . ($newinfo['supervisor'] == 1 ? 'Approved' : 'Denied') . "</button></td>";
                echo "<td><button type='submit' value='$page' name='caregiver'>" . ($newinfo['caregiver'] == 1 ? 'Approved' : 'Denied') . "</button></td>";
                echo "</tr>";

            }
        }


?>
</form>
</body>

</html>

<?php


?>

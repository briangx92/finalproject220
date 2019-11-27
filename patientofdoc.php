
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
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>Date</th>
        <th>Comment</th>
        <th>Morning Meds</th>
        <th>Afternoon Meds</th>
        <th>Night Meds</th>
    </tr>

<?php
include_once 'db.php';
securitygate($conn);

$date = date('Y-m-d');

if (isset($_GET["name"])) {
   $name = $_GET["name"] ?? '';
   $_SESSION['currentpatient'] = $name;
   $docid = $_GET["docid"] ?? '';
   $_SESSION['docid'] = $docid;
   $sendname = str_replace(' ', '_', $name);
   $falname = explode("_", $sendname);
   echo "<h1> $falname[0] $falname[1] </h1>";
   $sql_search = "SELECT DISTINCT CONCAT(u.fname, ' ', u.lname) AS name, u.userid, d.apt_date, d.comment, d.morning_med, d.afternoon_med, d.night_med FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE d.doctorid = '$docid' AND u.lname = '$falname[1]' AND u.fname = '$falname[0]' ;";
   $name_query = mysqli_query($conn, $sql_search);
   if(mysqli_num_rows($name_query) > 0) {
       while ($row = mysqli_fetch_assoc($name_query)) {
           if($row['apt_date'] == $date) {
            $todaysappt = $row['apt_date'];
            continue;
           }
           echo "<tr>";
           echo "<td>{$row['apt_date']}</td>";
           echo "<td>{$row['comment']}</td>";
           echo "<td>{$row['morning_med']}</td>";
           echo "<td>{$row['afternoon_med']}</td>";
           echo "<td>{$row['night_med']}</td>";
           echo "<td></td>";
           echo "</tr>";
           }
       }

}

if (isset($_POST)) {
    $patid = $_POST["patid"] ?? '';
    $docid = $_SESSION['docid'];
    $name = $_SESSION['currentpatient'];

    $com = $_POST["new_comment"] ?? '';
    if (empty($com) == false) {
            $makenewcom = "UPDATE doctor_appt SET comment = $com WHERE apt_date = '$date' AND doctorid = '$docid' AND patientid = '$patid';";
            echo "$makenewcom";
            mysqli_query($conn, $makenewcom);
    }
    $morn = $_POST["new_morning"] ?? '';
    $after = $_POST["new_afternoon"] ?? '';
    $night = $_POST["new_night"] ?? '';
    $sendname = str_replace(' ', '_', $name);
    $falname = explode("_", $sendname);


    $sql_search = "SELECT DISTINCT CONCAT(u.fname, ' ', u.lname) AS name, u.userid, d.apt_date, d.comment, d.morning_med, d.afternoon_med, d.night_med FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE d.doctorid = '$docid' AND u.lname = '$falname[1]' AND u.fname = '$falname[0]' ;";
    $name_query = mysqli_query($conn, $sql_search);
    if(mysqli_num_rows($name_query) > 0) {
        while ($row = mysqli_fetch_assoc($name_query)) {
            $date = date('Y-m-d');
            if($row['apt_date'] == $date) {
             $todaysappt = $row['apt_date'];
             continue;
            }
            echo "<tr>";
            echo "<td>{$row['apt_date']}</td>";
            echo "<td>{$row['comment']}</td>";
            echo "<td>{$row['morning_med']}</td>";
            echo "<td>{$row['afternoon_med']}</td>";
            echo "<td>{$row['night_med']}</td>";
            echo "<td></td>";
            echo "</tr>";
            }
        }

 }



?>
<form action='patientofdoc.php' action='post'>
<?php
if(isset($todaysappt)) {
    $sql_appt = "SELECT DISTINCT CONCAT(u.fname, ' ', u.lname) AS name, u.userid, d.apt_date, d.comment, d.morning_med, d.afternoon_med, d.night_med FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE d.doctorid = '$docid' AND u.lname = '$falname[1]' AND u.fname = '$falname[0]' AND d.apt_date = '$todaysappt';";
    $appt_query = mysqli_query($conn, $sql_appt);
    if(mysqli_num_rows($appt_query) > 0) {
        while ($row = mysqli_fetch_assoc($appt_query)) {
        echo "<tr>";
        echo "<td><h2> Todays Appointment</h2></td>";
        echo "<td><label>Comment:<input name='new_comment'></label> </td>";
        echo "<td><label>Morning Med:<input value = '{$row['morning_med']}' name='new_morning'> </label></td>";
        echo "<td><label>Afternoon Med:<input value ='{$row['afternoon_med']}' name='afternoon_med'> </label></td>";
        echo "<td><label>Night Med:<input value ='{$row['night_med']}' name='night_med'> </label></td>";
        echo "<td><input type='submit' name='today'></td>";
        echo "</tr>";
        }
    }
}
?>

</form>
</body>
</html>

<?php


?>

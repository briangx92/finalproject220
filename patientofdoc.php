
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
if (isset($_GET["name"])) {
   $name = $_GET["name"] ?? '';
   $docid = $_GET["docid"] ?? '';
   $sendname = str_replace(' ', '_', $name);
   $falname = explode("_", $sendname);
   echo "<h1> $falname[0] $falname[1] </h1>";
   $sql_search = "SELECT DISTINCT CONCAT(u.fname, ' ', u.lname) AS name, u.userid, d.apt_date, d.comment, d.morning_med, d.afternoon_med, d.night_med FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE d.doctorid = '$docid' AND u.lname = '$falname[1]' AND u.fname = '$falname[0]' ;";
   $name_query = mysqli_query($conn, $sql_search);
   if(mysqli_num_rows($name_query) > 0) {
       while ($row = mysqli_fetch_assoc($name_query)) {
           echo "<tr>";
           echo "<td>{$row['apt_date']}</td>";
           echo "<td>{$row['comment']}</td>";
           echo "<td>{$row['morning_med']}</td>";
           echo "<td>{$row['afternoon_med']}</td>";
           echo "<td>{$row['night_med']}</td>";
           echo "</tr>";


           }
       }
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


</body>
</html>

<?php


?>

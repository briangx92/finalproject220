<?php
include_once 'db.php';
session_start();

if ($_SESSION['role'] != 'admin') {
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
    <style>
    table {
    border-collapse: collapse;
    width: 100%;
    }

    th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    }
    </style>
</head>
<body>
<!-- Shows current employee list with all attributes -->
<form action="" method="post">
    <fieldset>
        <legend>Search</legend>
        <input type="text" name="empid" placeholder="Enter ID">
        <br>
        <input type="text" name="newsalary" placeholder="Enter New Salary">
        <br>
        <button type="submit" name="ok" value="ok">Ok</button>
        <input type="button" onclick="location.href='index.php';" value="Cancel">
    </fieldset>
</form>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Role</th>
        <th>Salary</th>
    </tr>
<?php
// Statement for displaying  employee info from the user info table and joining the salary from the employee table
$empsql = "SELECT * FROM employee;";
$result = mysqli_query($conn, $empsql);

$resultcheck = mysqli_num_rows($result);
if ($resultcheck > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $whoareyou = $row['userid'];
        $nameget = "SELECT fname,lname, role FROM users WHERE userid = '$whoareyou'";
        $namegot = mysqli_query($conn, $nameget);
        $getgot = mysqli_fetch_assoc($namegot);
        echo "<tr>";
        echo "<td>" . $row['userid'] . "</td>";
        echo "<td>" . $getgot['fname'] . ' ' . $getgot['lname'] . "</td>";
        echo "<td>" . ucfirst($getgot['role']) . "</td>";
        echo "<td>$" . $row['salary'] . "</td>";
        echo "</tr>";
}
echo "</table>";
} else { echo "0 results"; }

?>
</table>


</body>
</html>

<?php


?>

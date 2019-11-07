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
        <button type="submit">Cancel</button>
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
$sql = "SELECT ui.userid AS ID, CONCAT(ui.fname, ' ', ui.lname) AS emp_name, ui.role, emp.salary FROM user_info ui JOIN employee emp ON ui.userid = emp.userid;";

$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
// output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["emp_name"] . "</td><td>" . $row["role"] . "</td><td>" . $row["salary"] . "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }

?>
</table>


</body>
</html>

<?php


?>

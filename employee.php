<?php
include_once 'db.php';
securitygate($conn);
?>
<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee - Old Home</title>
</head>

<body>
    <form action="" method="post">
        <fieldset>
            <legend>Update Salary</legend>
            <label>ID:
                <select name="empid">
                    <?php
                    $empsql = "SELECT userid FROM employee;";
                    $result = mysqli_query($conn, $empsql);
                    $resultcheck = mysqli_num_rows($result);
                    if ($resultcheck > 0) {
                        while ($tables = mysqli_fetch_assoc($result)) {
                            echo '<option value = ' . $tables['userid'] . '>' . $tables['userid'] . '</option>';
                        }
                    }
                    ?>
                </select>
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
        $sql = "SELECT u.userid AS ID, CONCAT(u.fname, ' ', u.lname) AS emp_name, u.role, emp.salary FROM users u JOIN employee emp ON u.userid = emp.userid;";

        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["emp_name"] . "</td><td>" . $row["role"] . "</td><td>" . $row["salary"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        ?>
    </table>


</body>

</html>

<?php
$empid = $_POST['empid'] ?? '';
$newsal = $_POST['newsalary'] ?? '';
$newsal = intval($newsal);
if ($newsal > 0) {
    $updatesal = "UPDATE employee
    SET salary = '$newsal'
    WHERE userid = '$empid';";
    mysqli_query($conn, $updatesal);
    header("Refresh:0");
}
?>
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
</head>
<body>






<form action="regapproval.php" method="post">
    <fieldset>
        <legend>Registration Approval</legend>

        <?php
        $approved = $_POST['approved'] ?? '';
        $denied = $_POST['denied'] ?? '';

        $i = 1;
        $sql = "SELECT u.fname, u.lname, role, l.userid
        FROM users u JOIN login l ON u.userid = l.userid
        WHERE l.approved = 0;";
        $userid = "SELECT userid FROM login;";
        $result = mysqli_query($conn, $sql);




        echo "<table border='1'>";
        echo "<tr><td>Name</td><td>Role</td><td>Yes</td><td>No</td><tr>\n";
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['userid'];
            echo "<tr class='index'>";
            echo"<td>{$row['fname']} {$row['lname']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td><button type='submit' value='$id' name='approved' >Approve</button></td>";
            echo "<td><button type='submit' value='$id' name='denied' >Deny</button></td>";
            echo "</tr>\n";

        }

        echo "</table>";




        if( isset($_POST['approved']) )  {
            echo $approved;
            $makeapproved = "UPDATE login SET approved = 1 WHERE userid = '$approved';";
            mysqli_query($conn, $makeapproved);
            header("Refresh:0");
        }
        elseif ( isset($_POST['denied']) ) {
            $remove_patient = "DELETE FROM patient WHERE userid = '$denied';";
            mysqli_query($conn, $remove_patient);
            echo $denied;
            $remove_login = "DELETE FROM login WHERE userid = '$denied';";
            mysqli_query($conn, $remove_login);
            $remove_users = "DELETE FROM users WHERE userid = '$denied';";
            mysqli_query($conn, $remove_users);
            header("Refresh:0");
        }

        ?>
    </fieldset>


</form>
</body>
</html>
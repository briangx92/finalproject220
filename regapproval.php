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




        if (isset($approved) == true)  {
            echo $approved;
            $makeapproved = "UPDATE login SET approved = 1 WHERE userid = '$approved';";
            mysqli_query($conn, $makeapproved);
        }
        elseif (isset($denied) == true)  {
            echo $denied;
            $remove_login = "DELETE FROM login WHERE userid = '$denied';";
            mysqli_query($conn, $remove_login);
            $remove_users = "DELETE FROM users WHERE userid = '$denied';";
            mysqli_query($conn, $remove_users);
        }

        ?>
    </fieldset>


</form>

</body>
</html>

<?php

// $usersinfo = "INSERT INTO users (role, fname, lname, phone, dob)
// VALUES ('$role', '$fname', '$lname', '$phone', '$dob');";
// $what = mysqli_query($conn, $usersinfo);
// $getid = "SELECT userid FROM users WHERE lname = '$lname' AND fname = '$fname'";
// $theirid = mysqli_query($conn, $getid);
// $newid = mysqli_fetch_assoc($theirid);


?>

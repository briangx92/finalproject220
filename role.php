<?php
include_once 'db.php';
securitygate($conn);

function update_values($conn) {
    $role_list = array();
    $getinfo = "SELECT * FROM role " ;
    $theirinfo = mysqli_query($conn, $getinfo);
    $newinfo = mysqli_fetch_assoc($theirinfo);
    $u = 0;
    foreach ($newinfo as $key => $new) {
        array_push($role_list, $key);
    }
    foreach ($role_list as $role) {
        if (isset($_POST[$role])) {
            $page = $_POST[$role];
            $getinfo = "SELECT $role FROM role WHERE page = '$page'" ;
            $theirinfo = mysqli_query($conn, $getinfo);
            $newinfo = mysqli_fetch_assoc($theirinfo);

            $approval = ($newinfo[$role] == 1 ? 1 : 0);
            if ($approval == 1) {
                $unapprove = "UPDATE role SET $role = 0 WHERE page = '$page';";
                mysqli_query($conn, $unapprove);
            } else {
                $approve = "UPDATE role SET $role = 1 WHERE page = '$page';";
                mysqli_query($conn, $approve);
            }
            header("Refresh:0");
        }
    }
}

$newrole = $_POST['newrole'] ?? '';

$addnewrole = "ALTER TABLE role
ADD $newrole varchar(20);";
mysqli_query($conn, $addnewrole);

update_values($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Role - Old Home</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="adminreport.php">Admin Home</a></li>
            <li><a href="regapproval.php">Registration Approval</a></li>
            <li><a href="supervisorhome.php">Supervisor Home</a></li>
            <li><a href="caregiverhome.php">Caregiver Home</a></li>
            <li><a href="doctorhome.php">Doctor Home</a></li>
            <li><a href="familyhome.php">Family Home</a></li>
            <li><a href="patienthome.php">Patient Home</a></li>
            <li><a href="rosterhome.php">Roster Home</a></li>
            <li><a href="employee.php">Employee</a></li>
            <li><a href="doctappt.php">Doctor Appointments</a></li>
            <li><a href="patientinfo.php">Patient Info</a></li>
            <li><a href="patientofdoc.php">Patients of Doctor</a></li>
            <li><a href="payment.php">Payments</a></li>
            <li><a href="role.php">Role</a></li>
            <li><a href="newroster.php">New Roster</a></li>


        </ul>
    </nav>
    <table>
        <tr>
            <?php
                $getinfo = "SELECT * FROM role " ;
                $theirinfo = mysqli_query($conn, $getinfo);
                $newinfo = mysqli_fetch_assoc($theirinfo);
                $u = 0;
                foreach ($newinfo as $key => $new) {
                    if ($u == 0) {
                        echo "<td><h1>" . ucfirst($key) . "</h1></td>";
                        $thispage = $new;
                        $u += 1;
                    } else {
                        echo "<td>" . ucfirst($key) . "</td>";
                    }
                }
                ?>
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
                }
                $getinfo = "SELECT * FROM role WHERE page = '$page'" ;
                $theirinfo = mysqli_query($conn, $getinfo);
                $newinfo = mysqli_fetch_assoc($theirinfo);
                echo "<tr>";
                $i = 0;
                foreach ($newinfo as $key => $new) {
                    if ($i == 0) {
                        echo "<td> $new </td>";
                        $thispage = $new;
                        $i += 1;
                    } else {
                        echo "<td><button type='submit' value='$thispage' name='$key'>" . ($new == 1 ? 'Approved' : 'Denied') . "</button></td>";
                    }
                }
                echo "</tr>";
            }
        }


?>
        </form>
        <form action='role.php' method='post'>
            New Role <input type="text" name="newrole">
            <input type="submit" name="newrolesubmit">
        </form>
        <?php echo $newrole; ?>
</body>

</html>

<?php


?>
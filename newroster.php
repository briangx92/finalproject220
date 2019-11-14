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
<form action="" method="post">
    <fieldset>
        <legend>New Roster</legend>
        <label>Date:</label>
        <input type="date" name="date">
        <label>Supervisor:</label>
        <select name="supervisor">
            <?php
            $getsup = "SELECT fname, lname, userid FROM users WHERE role = 'supervisor';";
            $thesup = mysqli_query($conn, $getsup);
            $resultCheck = mysqli_num_rows($thesup);
            if($resultCheck>0) {
                while($tables = mysqli_fetch_assoc($thesup))
            {
                echo '<option value = ' . $tables['userid'] . '>' . $tables['fname'] . ' ' . $tables['lname'] . '</option>';

            }
        }
            ?>
        </select>
        <label>Doctor:</label>
        <select name="doctor">
            <?php
            $getsup = "SELECT fname, lname, userid FROM users WHERE role = 'doctor';";
            $thesup = mysqli_query($conn, $getsup);
            $resultCheck = mysqli_num_rows($thesup);
            if($resultCheck>0) {
                while($tables = mysqli_fetch_assoc($thesup))
            {
                echo '<option value = ' . $tables['userid'] . '>' . $tables['fname'] . ' ' . $tables['lname'] . '</option>';

            }
        }
            ?>
        </select>
        <br>
        <label>Caregiver 1:</label>
        <select name="cg1">
            <?php
            $getsup = "SELECT fname, lname, userid FROM users WHERE role = 'caregiver';";
            $thesup = mysqli_query($conn, $getsup);
            $resultCheck = mysqli_num_rows($thesup);
            if($resultCheck>0) {
                while($tables = mysqli_fetch_assoc($thesup))
            {
                echo '<option value = ' . $tables['userid'] . '>' . $tables['fname'] . ' ' . $tables['lname'] . '</option>';

            }
        }
            ?>
        </select>
        <select name="cgg1">
            <?php
            // PHP CODE FOR LISTING CAREGIVER GROUP 1
            ?>
        </select>
        <br>
        <label>Caregiver 2:</label>
        <select name="cg2">
            <?php
            $getsup = "SELECT fname, lname, userid FROM users WHERE role = 'caregiver';";
            $thesup = mysqli_query($conn, $getsup);
            $resultCheck = mysqli_num_rows($thesup);
            if($resultCheck>0) {
                while($tables = mysqli_fetch_assoc($thesup))
            {
                echo '<option value = ' . $tables['userid'] . '>' . $tables['fname'] . ' ' . $tables['lname'] . '</option>';

            }
        }
            ?>
        </select>
        <select name="cgg2">
            <?php
            // PHP CODE FOR LISTING CAREGIVER GROUP 2
            ?>
        </select>
        <br>
        <label>Caregiver 3:</label>
        <select name="cg3">
            <?php
            $getsup = "SELECT fname, lname, userid FROM users WHERE role = 'caregiver';";
            $thesup = mysqli_query($conn, $getsup);
            $resultCheck = mysqli_num_rows($thesup);
            if($resultCheck>0) {
                while($tables = mysqli_fetch_assoc($thesup))
            {
                echo '<option value = ' . $tables['userid'] . '>' . $tables['fname'] . ' ' . $tables['lname'] . '</option>';

            }
        }
            ?>
        </select>
        <select name="cgg3">
            <?php
            // PHP CODE FOR LISTING CAREGIVER GROUP 3
            ?>
        </select>
        <br>
        <label>Caregiver 4:</label>
        <select name="cg4">
            <?php
            $getsup = "SELECT fname, lname, userid FROM users WHERE role = 'caregiver';";
            $thesup = mysqli_query($conn, $getsup);
            $resultCheck = mysqli_num_rows($thesup);
            if($resultCheck>0) {
                while($tables = mysqli_fetch_assoc($thesup))
            {
                echo '<option value = ' . $tables['userid'] . '>' . $tables['fname'] . ' ' . $tables['lname'] . '</option>';

            }
        }
            ?>
        </select>
        <select name="cgg4">
            <?php
            // PHP CODE FOR LISTING CAREGIVER GROUP 4
            ?>
        </select>
        <br>

        <button type="submit" value="ok" name="ok">Ok</button>
        <input type="button" onclick="location.href='index.php';" value="Cancel">



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

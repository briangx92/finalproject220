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
    <link rel="stylesheet" type="text/css" href="style.css">
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
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
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
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
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
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
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
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
            </select>
            <br>

            <button type="submit" value="submit" name="submit">Ok</button>
            <input type="button" onclick="location.href='index.php';" value="Cancel">
            <?php
            $submit = $_POST['submit'] ?? '';
            $cg1 = $_POST['cg1'] ?? '';
            $cg2 = $_POST['cg2'] ?? '';
            $cg3 = $_POST['cg3'] ?? '';
            $cg4 = $_POST['cg4'] ?? '';
            $cgg1 = $_POST['cgg1'] ?? '';
            $cgg2 = $_POST['cgg2'] ?? '';
            $cgg3 = $_POST['cgg3'] ?? '';
            $cgg4 = $_POST['cgg4'] ?? '';
            $date = $_POST['date'] ?? '';
            $supervisor = $_POST['supervisor'] ?? '';
            $doctor = $_POST['doctor'] ?? '';
            

            
           
            // Prepare insert statement
            $new_roster = "INSERT INTO roster (roster_date, supervisor, doctor, caregiver_1, caregiver_2, caregiver_3, caregiver_4, caregiver_group1, caregiver_group2, caregiver_group3, caregiver_group4)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_prepare($conn, $new_roster);
            
            if ($stmt) {
                // Bind variables to the prepared statement as parameters
                // ORDER MATTERS ON VARIABLES
                mysqli_stmt_bind_param($stmt, "sssssssssss", $date, $supervisor, $doctor, $cg1, $cg2, $cg3, $cg4, $cgg1, $cgg2, $cgg3, $cgg4);

                // Set parameters
                $set_cg1 = $cg1;
                $set_cg2 = $cg2;
                $set_cg3 = $cg3;
                $set_cg4 = $cg4;
                $set_cgg1 = $cgg1;
                $set_cgg2 = $cgg2;
                $set_cgg3 = $cgg3;
                $set_cgg4 = $cgg4;
                $set_date = $date;
                $set_supervisor = $supervisor;
                $set_doctor = $doctor;

                // Attempt to execute the prepared statement

                if (mysqli_stmt_execute($stmt)) {
                    echo "Inserted successfully";
                } else {
                  
                }
            
                

                }
                mysqli_stmt_close($stmt);
           
            
        ?>

        </fieldset>
    </form>

</body>

</html>

<?php






?>
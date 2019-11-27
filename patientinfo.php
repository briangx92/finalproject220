<?php
include_once 'db.php';
securitygate($conn);
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    $_SESSION['message'] = '';
}

$group = $_POST['group'] ?? '';
$admindate = $_POST['admdate'] ?? '';
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$getpatientid = $_POST['getpatientid'] ?? '';
$getpatientid = intval($getpatientid);
$getpatient = "SELECT * FROM patient WHERE patientid = '$getpatientid'";
$patientinfo = mysqli_query($conn, $getpatient);
$wegood = mysqli_fetch_assoc($patientinfo);
$nameid = $wegood['userid'];
$nameget = "SELECT fname,lname FROM users WHERE userid = '$nameid'";
$namegot = mysqli_query($conn, $nameget);
$getgot = mysqli_fetch_assoc($namegot);

if( isset($_POST['change']) )
{
    echo 'Update Complete';
    $grouptwo = intval($group);
    $updateinfo = "UPDATE patient
    SET group_num = '$grouptwo', admission_date = '$admindate'
    WHERE patientid = '$getpatientid';";
    mysqli_query($conn, $updateinfo);
    $group = $_POST['group'] ?? '';
    $admindate = $_POST['admdate'] ?? '';
    $_SESSION['message'] = 'Update Submitted!';
    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Patient Info - Old Home</title>
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
            <li><a href="payments.php">Payments</a></li>
            <li><a href="role.php">Role</a></li>


        </ul>
    </nav>

    <!-- Patient  Information Form-->
    <form action="patientinfo.php" method="POST">
        <fieldset>
            <form action="patientinfo.php" method="POST">
                <legend>Patient Information</legend>
                <p>
                    Patient ID: <input type="text" name="getpatientid" value="<?php echo $wegood['patientid'];?>">
                    <input type="submit" value="search" name="search">
                    Patient Name: <?php echo $getgot['fname'] . ' ' . $getgot['lname']; ?>
            </form>

            <br>
            Group:
            <select name="group">
                <option value="<?php echo $wegood['group_num']?>"> <?php echo $wegood['group_num'] ?></option>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
            </select>
            Admission Date<input type="date" name="admdate" value="<?php echo $wegood['admission_date'];?>">
            </p>
            <input type="submit" value="Update" name="change">
            <input type="button" onclick="location.href='index.php';" value="Cancel">

        </fieldset>
    </form>


</body>

</html>

<?php

?>
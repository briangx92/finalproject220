<?php
include_once 'db.php';
securitygate($conn);
?>
<?php
// POSTS
$patientid = $_POST['patientid'] ?? '';
$date = $_POST['date'] ?? '';
$doctor = $_POST['doctor'] ?? '';

$submit = isset($_POST['submit']);
$search = isset($_POST['search']);

// SQL Query Variables
$sql_patientid = "SELECT * FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE d.patientid = '$patientid';";

$sql_date = "SELECT * FROM users u JOIN doctor_appt d ON u.userid = d.doctorid WHERE d.apt_date = '$date';";



$sql_doctor = "SELECT DISTINCT * FROM users WHERE role = 'doctor';";


// MYSQL Queries

// Patient ID
$sql_patid_query = mysqli_query($conn, $sql_patientid);
$result_patientid = mysqli_fetch_assoc($sql_patid_query);

// Date 
$sql_date_query = mysqli_query($conn, $sql_date);
$result_date = mysqli_fetch_assoc($sql_date_query);

$patient = "{$result_patientid['fname']} {$result_patientid['lname']}";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Doctor Appointments - Old Home</title>
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

    <form action="" method="post">
        <fieldset>
            <legend>Doctors Appointment</legend>
            <label>Patient ID: </label>
            <input type="text" name="patientid" value="<?php echo $patientid; ?>">
            <label>Patient Name: <?php if($search) {
                echo "{$patient}"; }?></label>
            <br>

            <label>Date: </label>
            <input type="date" name="date" value='<?php echo $date; ?>'>
            <br>
            <label>Doctor: </label>
            <select name="doctor">
                <option>-- SELECT --</option>
                <?php
                $result = mysqli_query($conn,$sql_doctor);
                if ($result-> num_rows > 0) {
                    while ($row = $result-> fetch_assoc()) {
                        $docid = $row['userid'];
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        echo "<option value='{$docid}'>{$fname} {$lname} ID: {$docid}</option>";

                    }
                }     
                
                ?>
            </select>
            <br>
            <button type="submit" name="search" value="">Search Patient ID</button>
            <button type="submit" name="submit" value="">Submit Form</button>
            <?php 
       
        if ($submit) {
            $patientid = $_POST['patientid'] ?? '';
            $date = $_POST['date'] ?? '';
            $doctor = $_POST['doctor'] ?? '';
            $sql_new_apt = "INSERT INTO doctor_appt (patientid, doctorid, apt_date) VALUES ($patientid, $docid, '$date');";

            echo mysqli_query($conn, $sql_new_apt);
        }
        else {}
        
      
        ?>

        </fieldset>

    </form>

</body>

</html>
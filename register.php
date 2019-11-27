<?php
include_once 'db.php';
securitygate($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Register - Old Home</title>

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
    <form action="register.php" method="post">
        <fieldset>
            <legend>Register</legend>
            <label>Role: </label>
            <select id="role" name="role">
                <option value="none">-- Select --</option>
                <option value="admin">Admin</option>
                <option value="patient">Patient</option>
                <option value="family">Family Member</option>
                <option value="doctor">Doctor</option>
                <option value="supervisor">Supervisor</option>
                <option value="caregiver">Caregiver</option>

            </select>
            <br>
            <label>First Name: </label>
            <input type="text" name="fname">
            <br>
            <label>Last Name: </label>
            <input type="text" name="lname">
            <br>
            <label>Email: </label>
            <input type="text" name="email">
            <br>
            <label>Password: </label>
            <input type="password" name="pass">
            <br>
            <label>Phone: </label>
            <input type="text" name="phone">
            <br>
            <label>Date of Birth: </label>
            <input type="date" name="dob">
            <br>
            <!-- Make this appear when role is patient -->
            <section id="section">
                <label class="hideit">Family Code: </label>
                <input class="hideit" type="text" name="famcode">
                <br>
                <label class="hideit">Emergency Contact: </label>
                <input class="hideit" type="text" name="emcontact">
                <br>
                <label class="hideit">Relationship: </label>
                <input class="hideit" type="text" name="relation">
            </section>
            <!-- End appear -->

            <button type="submit" name="submit" value="submit">Ok</button>
            <input type="button" onclick="location.href='index.php';" value="Cancel">






        </fieldset>
    </form>

    <script>
    // This shows the patient form when selected in the dropdown menu
    let role = document.getElementById('role');

    role.addEventListener("change", (event) => {
        let select = role.options[role.selectedIndex].value;
        if (select != "patient") {
            document.getElementById('section').style.display = "none";
        } else {
            document.getElementById('section').style.display = "block";
        }
    });
    </script>



</body>

</html>

<?php
if (!empty($_POST)) {
$role = $_POST['role'] ?? '';
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$dob = $_POST['dob'] ?? '';
$pass = $_POST['pass'] ?? '';
// Patient only
$famcode = $_POST['famcode'] ?? '';
$emcontact = $_POST['$emcontact'] ?? '';
$relation = $_POST['relation'] ?? '';

$usersinfo = "INSERT INTO users (role, fname, lname, phone, dob, email, pass, approved)
VALUES ('$role', '$fname', '$lname', '$phone', '$dob', '$email', '$pass', 0);";
$what = mysqli_query($conn, $usersinfo);
$getid = "SELECT userid FROM users WHERE lname = '$lname' AND fname = '$fname'";
$theirid = mysqli_query($conn, $getid);
$newid = mysqli_fetch_assoc($theirid);
$youid = $newid['userid'];
echo "Your registration has been submitted, please wait on admin approval.";
    if ($role == 'patient') {
        $patientinfo = "INSERT INTO patient(userid, family_code, emergency_contact_name, relation)
        VALUES ('$youid', '$famcode', '$emcontact', '$relation');";
        mysqli_query($conn, $patientinfo);
    }
    elseif ($role != 'patient' AND $role != 'family') {
        $salary = "INSERT INTO employee(userid)
        VALUES ('$youid');";
        mysqli_query($conn, $salary);
    }
}
?>
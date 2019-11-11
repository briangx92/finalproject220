<?php
include_once 'db.php';
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

<form action="register.php" method="post">
    <fieldset>
        <legend>Register</legend>
        <label>Role: </label>
        <select name="role">
            <option value="none">Select</option>
            <option value="admin">Admin</option>
            <option value="patient">Patient</option>
            <option value="family">Family Member</option>
            <option value="doctor">Doctor</option>
            <option value="supervisor">Supervisor</option>

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
        <label>Family Code: </label>
            <input type="text" name="famcode">
        <br>
        <label>Emergency Contact: </label>
            <input type="text" name="emcontact">
        <br>
        <label>Relationship: </label>
            <input type="text" name="relation">
        <!-- End appear -->

        <button type="submit" name="submit" value="submit">Ok</button>
        <input type="button" onclick="location.href='index.php';" value="Cancel">






    </fieldset>
</form>

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

$usersinfo = "INSERT INTO users (role, fname, lname, phone, dob)
VALUES ($role, $fname, $lname, $phone, $dob);";
mysqli_query($conn, $usersinfo);
$getid = "SELECT userid FROM users WHERE lname = '$lname' AND fname = '$fname'";
$theirid = mysqli_query($conn, $getid);
$nowid = mysqli_fetch_assoc($theirid);
print_r($nowid);
$userinfo = "INSERT INTO login (userid, email, pass, approved)
VALUES ($theirid, $email, $pass, 0);";
$theirid = mysqli_query($conn, $userinfo);
echo "Your registration has been submitted, please wait on admin approval.";
    if ($role == patient) {

    }
}
?>

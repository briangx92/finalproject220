<?php
include_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Register - Old Home</title>
    <script>

    </script>
</head>

<body>
    <form action="register.php" method="post">
        <fieldset>
            <legend>Register</legend>
            <label>Role: </label>
            <select id="role" name="role">
                <?php
                $getinfo = "SELECT * FROM role ";
                $theirinfo = mysqli_query($conn, $getinfo);
                $newinfo = mysqli_fetch_assoc($theirinfo);
                $u = 0;
                foreach ($newinfo as $key => $new) {
                    if ($u == 0) {
                        $u += 1;
                    } else {
                        $capkey = ucfirst($key);
                        echo "<option value='{$key}'>{$capkey}</option>";
                    }
                }
                ?>
            </select>
            <br>
            <label>First Name: </label>
            <input type="text" name="fname" required>
            <br>
            <label>Last Name: </label>
            <input type="text" name="lname" required>
            <br>
            <label>Email: </label>
            <input type="text" name="email" required>
            <br>
            <label>Password: </label>
            <input type="password" name="pass" required>
            <br>
            <label>Phone: </label>
            <input type="text" name="phone" required>
            <br>
            <label>Date of Birth: </label>
            <input type="date" name="dob" required>
            <br>
            <!-- Make this appear when role is patient -->
            <section id="section" style='display:none'>
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

    if (!empty($fname) and !empty($lname) and !empty($email) and !empty($phone) and !empty($dob) and !empty($pass) and $dob > date('Y/m/d')) {
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
        } elseif ($role != 'patient' and $role != 'family') {
            $salary = "INSERT INTO employee(userid)
        VALUES ('$youid');";
            mysqli_query($conn, $salary);
        }
    } else {
        echo "Please enter valid inputs";
    }
}
?>
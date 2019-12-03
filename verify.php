<?php
include_once 'db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM users WHERE email = '$email' AND pass = '$password' AND approved = 1;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck >= 1) {
    $tables = mysqli_fetch_assoc($result);
    $id = intval($tables['userid']);
    $roleChecks = "SELECT * FROM users WHERE userid = $id;";
    $what_role = mysqli_query($conn, $roleChecks);
    $user_info = mysqli_fetch_assoc($what_role);
    // All re-directs must be changed once we have the actual html files
    $_SESSION['id'] = $id;
    if ($user_info['role'] == 'admin') {
        $_SESSION['role'] = 'admin';
        header("Location: ./adminreport.php");
    }
    elseif ($user_info['role'] == 'patient') {
            $_SESSION['role'] = 'patient';
            header("Location: ./patients.php");
    }
    elseif ($user_info['role'] == 'supervisor') {
            $_SESSION['role'] = 'supervisor';
            header("Location: ./supervisorhome.php");
    }
    elseif ($user_info['role'] == 'doctor') {
            $_SESSION['role'] = 'doctor';
            header("Location: ./doctorhome.php");
    }
    elseif ($user_info['role'] == 'caregiver') {
            $_SESSION['role'] = 'caregiver';
            header("Location: ./caregiverhome.php");
    }
    elseif ($user_info['role'] == 'family') {
            $_SESSION['role'] = 'family';
            header("Location: ./familyhome.php");

    }
    elseif (isempty($user_info['role']) == TRUE) {
            header("Location: ./index.php");
    }
}
else {
    header("Location: /finalproject220/index.php");
}
?>

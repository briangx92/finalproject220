<?php
include_once 'db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM login WHERE email = '$email' AND pass = '$password' AND approved = 1;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck >= 1) {
    $tables = mysqli_fetch_assoc($result);
    $id = intval($tables['User_ID']);
    $roleChecks = "SELECT * FROM user WHERE User_ID = $id;";
    $what_role = mysqli_query($conn, $roleChecks);
    $user_info = mysqli_fetch_assoc($what_role);
    // All re-directs must be changed once we have the actual html files
    if ($user_info['role'] == admin) {
           header("Location: admin/admin.php");
    }
    elseif ($user_info['role'] == patient) {
           header("Location: admin/patient.php");
    }
    elseif ($user_info['role'] == supervisor) {
           header("Location: admin/patient.php");
    }
    elseif ($user_info['role'] == doctor) {
           header("Location: admin/patient.php");
    }
    elseif ($user_info['role'] == caregiver) {
           header("Location: admin/patient.php");
    }
    elseif ($user_info['role'] == family) {
           header("Location: admin/patient.php");
    }
    elseif (isempty($user_info['role']) == TRUE) {
           header("Location: admin/index.php");
    }
}
else {
    header("Location: /finalproject220/");
}
?>

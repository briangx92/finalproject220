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
    <title>Old Home</title>
</head>
<body>

<!-- Patient  Information Form-->
<form action="patientinfo.php" method="POST">
    <fieldset>
        <form action="patientinfo.php" method="POST">
        <legend>Patient Information</legend>
        <p>
        Patient ID: <input type="text" name="getpatientid" value="<?php echo $wegood['patientid'];?>" >
        <input type="submit" value="search" name="search">
        Patient Name: <?php echo $getgot['fname'] . ' ' . $getgot['lname']; ?>
    </form>

        <br>
        Group:
        <select name="group">
            <option value= "<?php echo $wegood['group_num']?>"> <?php echo $wegood['group_num'] ?></option>
            <option value = '1'>1</option>
            <option value = '2'>2</option>
            <option value = '3'>3</option>
            <option value = '4'>4</option>
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

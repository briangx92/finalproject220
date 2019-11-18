<?php
include_once 'db.php';

session_start();

if ($_SESSION['role'] = '') {
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
    <form action="rosterhome.php" method="post">
        <fieldset>
            <legend>Roster</legend>
            <label>Date: </label>
            <input type="date" name="date">
            <button type="submit" value="submit" name="Submit">Submit



        </fieldset>
        <table>
            <tr>
                <th>Date</th>
                <th>Supervisor</th>
                <th>Doctor</th>
                <th>Caregiver 1</th>
                <th>Caregiver 2</th>
                <th>Caregiver 3</th>
                <th>Caregiver 4</th>
            </tr>
            <?php

            $date = $_POST['date'] ?? '';
            if (empty($date) == false) {
        
            // Query
            $sql = "SELECT * FROM roster WHERE roster_date = '{$date}';";


            // Initiate query
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            function getname($conn, $whichguy) {
                $nameget = "SELECT fname,lname FROM users WHERE userid = '$whichguy'";
                $namegot = mysqli_query($conn, $nameget);
                $getgot = mysqli_fetch_assoc($namegot);
                return $getgot;
            }

            $supname = getname($conn, $row['supervisor']);
            $supname = ($supname['fname'] . ' ' . $supname['lname'] );

            $docname = getname($conn, $row['doctor']);
            $docname = ($docname['fname'] . ' ' . $docname['lname'] );

            $cg1name = getname($conn, $row['caregiver_1']);
            $cg1name = ($cg1name['fname'] . ' ' . $cg1name['lname'] );
            $cg1num = $row['caregiver_group1'];

            $cg2name = getname($conn, $row['caregiver_2']);
            $cg2name = ($cg2name['fname'] . ' ' . $cg2name['lname'] );
            $cg2num = $row['caregiver_group2'];

            $cg3name = getname($conn, $row['caregiver_3']);
            $cg3name = ($cg3name['fname'] . ' ' . $cg3name['lname'] );
            $cg3num = $row['caregiver_group3'];

            $cg4name = getname($conn, $row['caregiver_4']);
            $cg4name = ($cg4name['fname'] . ' ' . $cg4name['lname'] );
            $cg4num = $row['caregiver_group4'];



            echo "<tr>";

                echo "<td>{$row['roster_date']}</td>";
                echo "<td>{$supname}</td>";
                echo "<td>{$docname}</td>";
                echo "<td>{$cg1name} <p>Group: {$cg1num}</p>";
                ?>
                <p>Patients:</p>
                <select name="care1">
                <?php
                $getsup = "SELECT userid FROM patient WHERE group_num = '$cg1num';";
                $thesup = mysqli_query($conn, $getsup);
                $resultCheck = mysqli_num_rows($thesup);
                if($resultCheck>0) {
                    while($tables = mysqli_fetch_assoc($thesup))
                {
                    $patient_name = getname($conn, $tables['userid']);
                    echo '<option>' . $patient_name['fname'] . ' ' . $patient_name['lname'] . '</option>';
                }
            }
            ?>
                </select>
                <?php
                echo "</td>";
                echo "<td>{$cg2name} <p>Group: {$cg2num}</p>";
                ?>
                <p>Patients:</p>
                <select name="care2">
                <?php
                $getsup = "SELECT userid FROM patient WHERE group_num = '$cg2num';";
                $thesup = mysqli_query($conn, $getsup);
                $resultCheck = mysqli_num_rows($thesup);
                if($resultCheck>0) {
                    while($tables = mysqli_fetch_assoc($thesup))
                {
                    $patient_name = getname($conn, $tables['userid']);
                    echo '<option>' . $patient_name['fname'] . ' ' . $patient_name['lname'] . '</option>';
                }
            }
            ?>
                </select>
            <?php
                echo "</td>";
                echo "<td>{$cg3name} <p>Group: {$cg3num}</p>";
                ?>
                <p>Patients:</p>
                <select name="care3">
                <?php
                $getsup = "SELECT userid FROM patient WHERE group_num = '$cg3num';";
                $thesup = mysqli_query($conn, $getsup);
                $resultCheck = mysqli_num_rows($thesup);
                if($resultCheck>0) {
                    while($tables = mysqli_fetch_assoc($thesup))
                {
                    $patient_name = getname($conn, $tables['userid']);
                    echo '<option>' . $patient_name['fname'] . ' ' . $patient_name['lname'] . '</option>';
                }
            }
            echo "</td>";
            echo "<td>{$cg4name} <p>Group: {$cg4num}</p>";
            ?>
                </select>
                <p>Patients:</p>
                <select name="care4">
                <?php
                    $getsup = "SELECT userid FROM patient WHERE group_num = '$cg4num';";
                    $thesup = mysqli_query($conn, $getsup);
                    $resultCheck = mysqli_num_rows($thesup);
                    if($resultCheck>0) {
                        while($tables = mysqli_fetch_assoc($thesup))
                    {
                        $patient_name = getname($conn, $tables['userid']);
                        echo '<option>' . $patient_name['fname'] . ' ' . $patient_name['lname'] . '</option>';
                    }
                }
            echo "</td>";

            echo "</tr>";

            }
            ?>
            
            <?php
            $sql_all = "SELECT * FROM roster;";
            $result = mysqli_query($conn, $sql_all);
            if(empty($date) == TRUE) {
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$row['roster_date']."</td>";
                    echo "<td>".$row['supervisor']."</td>";
                    echo "<td>{$row['doctor']}</td>";
                    echo "<td>{$row['caregiver_1']}</td>";
                    echo "<td>{$row['caregiver_2']}</td>";
                    echo "<td>{$row['caregiver_3']}</td>";
                    echo "<td>{$row['caregiver_4']}</td>";
                    echo "<br>";
                    echo "</tr>";
                    
                }

            }
            
            ?>
          
        </table>

    </form>


</html>

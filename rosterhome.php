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

            @$date = $_POST['date'];
            // Query
            $sql = "SELECT * FROM roster WHERE roster_date = '{$date}';";


            // Initiate query
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
          
            echo "<tr>";
            
                echo "<td>{$row['roster_date']}</td>";
                echo "<td>{$row['supervisor']}</td>";
                echo "<td>{$row['doctor']}</td>";
                echo "<td>{$row['caregiver_1']}</td>";
                echo "<td>{$row['caregiver_2']}</td>";
                echo "<td>{$row['caregiver_3']}</td>";
                echo "<td>{$row['caregiver_4']}</td>";
                
               
          
            
            echo "</tr>";
            ?>
        </table>

    </form>


</html>
<?php
include_once 'db.php';
?>

<?php
// SQL CODE TO LIST PATIENTS 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Old Home</title>
</head>
<style>
    table {
    border-collapse: collapse;
    width: 100%;
    }

    th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    }
    </style>
<body>
    <form action="" method="post">
        <button type="submit" value="submit" name="submit">List Patients Duty Today</button>
    </form>
<table>

    <tr>
        <th>Name</th>
        <th>Morning Medicine</th>
        <th>Afternoon Medicine</th>
        <th>Night Medicine</th>
        <th>Breakfast</th>
        <th>Lunch</th>
        <th>Dinner</th>
    </tr>
    <?php
    
    // WHILE LOOP TO CREATE A TABLE FOR THE LIST OF PATIENTS DUTY <tr></tr> <td></td>
    ?>


</table>

        


</body>
</html>

<?php


?>
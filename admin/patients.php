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
<form action="">
    <fieldset>
        <legend>Patients</legend>
        <p>ID: <input type="text" name="id">
        <br>
        <p>Name: <input type="text" name="name">
        <br>
        Age: <input type="text" name="age">
        <br>
        Emergency Contact: <input type="text" name="emcontact">
        <br>
        Emergency Contact Name: <input type="text" name="emname">
        <br>
        Admission Date: <input type="date" name="admdate">
        </p>
        <button type="submit" name="submit" value="submit">Search</button>
        

        
    </fieldset>
</form>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Emergency Contact</th>
            <th>Emergency Contact Name</th>
            <th>Admission Date</th>
        </tr>
        <?php
        // PHP CODE FOR LISTING RESULTS
        // NEED A WHILE LOOP FOR THE <td></td>
        ?>
    </table>
</body>
</html>

<?php


?>
<?php
include_once 'db.php';
session_start();

if ($_SESSION['role'] != 'admin') {
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
    <title>Old Home</title>
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
</head>
<body>






<form action="" method="post">
    <fieldset>
        <legend>Registration Approval</legend>
        
        <?php
        $i = 1;
        $sql = "SELECT u.fname, u.lname, role, l.userid
        FROM users u JOIN login l ON u.userid = l.userid
        WHERE l.approved = 0;";
        $userid = "SELECT userid FROM login;";
        $result = mysqli_query($conn, $sql);
        $approved = "UPDATE login SET approved = 1 WHERE userid = ". $userid.";";
        $unapproved = "UPDATE login SET approved = 0 WHERE userid = ". $userid.";";
        
        
        
        
        echo "<table border='1'>";
        echo "<tr><td>Name</td><td>Role</td><td>Yes</td><td>No</td><tr>\n";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr class='index'>";       
            echo"<td>{$row['fname']} {$row['lname']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td><input id='{$row['userid']}' type='checkbox' name='approve' value='yes'></td>";
            echo "<td><input id='{$row['userid']}' type='checkbox' name='unapprove' value='no'></td>";
            echo "</tr>\n"; 
            
        }

        echo "</table>";

    
        
        $yes = isset($_POST['yes']);
        $no = isset($_POST['no']);
        if ($yes) {
            mysqli_query($conn, $approved);
        }
        if ($no) {
            mysqli_query($conn,$unapproved);
        }
    
        echo "<button type='submit' value='submit'>Submit</button>";
        ?>
    </fieldset>

  
</form> 

</body>
</html>

<?php




?>

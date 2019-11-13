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
        $sql = "SELECT u.fname, u.lname, role
        FROM users u JOIN login l ON u.userid = l.userid
        WHERE l.approved = 0;";
        $result = mysqli_query($conn, $sql);
        echo "<table border='1'>";
        echo "<tr><td>Name</td><td>Role</td><td>Yes</td><td>No</td><tr>\n";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr class='index'>";       
            echo"<td>{$row['fname']} {$row['lname']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td><input type='radio' name='yes' value='1'></td>";
            echo "<td><input type='radio' name='no' value='0'></td>";
            echo "</tr>\n";   
            
        }
        echo "</table>";

        print_r($_POST);
        
        ?>
        <script>
            let x = document.getElementsByClassName('index');
            var txt = "";
            var i;
            for (i=0;i<x.length;i++) {
                txt = txt + "the index of row "+(i+1)+" is: "+x[i].rowIndex+"<br>";
            }


        </script>
        <button type="submit">Submit</button>

    </fieldset>


</form> 

</body>
</html>

<?php


?>

<?php
include_once 'db.php';
securitygate($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Doctor Home - Old Home</title>
</head>

<body>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="adminreport.php">Admin Home</a></li>
            <li><a href="regapproval.php">Registration Approval</a></li>
            <li><a href="supervisorhome.php">Supervisor Home</a></li>
            <li><a href="caregiverhome.php">Caregiver Home</a></li>
            <li><a href="doctorhome.php">Doctor Home</a></li>
            <li><a href="familyhome.php">Family Home</a></li>
            <li><a href="patienthome.php">Patient Home</a></li>
            <li><a href="rosterhome.php">Roster Home</a></li>
            <li><a href="employee.php">Employee</a></li>
            <li><a href="doctappt.php">Doctor Appointments</a></li>
            <li><a href="patientinfo.php">Patient Info</a></li>
            <li><a href="patientofdoc.php">Patients of Doctor</a></li>
            <li><a href="payment.php">Payments</a></li>
            <li><a href="role.php">Role</a></li>


        </ul>
    </nav>


    <!--Doctors Search Form -->
    <form action="" method="post">

        <fieldset>
            <legend>Doctor's Home Page</legend>
            <label>Search By: </label>
            <select name="searchtype">
                <option value="fname" name="fname">Name</option>
                <option value="apt_date" name="apt_date">Date</option>
                <option value="comment" name="comment">Comment</option>
                <option value="morning_med" name="morning_med">Morning Meds</option>
                <option value="afternoon_med" name="afternoon_med">Afternoon Meds</option>
                <option value="night_med" name="night_med">Night Meds</option>
            </select>
            <input type="text" name="search_text" value="<?php $search_text; ?>">
            <button type="submit" name="search" value="search">Search</button>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Comment</th>
                    <th>Morning Meds</th>
                    <th>Afternoon Meds</th>
                    <th>Night Meds</th>
                </tr>
                <?php

                    // POSTS
                    $search = isset($_POST['search']);
                    $searchtype = $_POST['searchtype'] ?? '';
                    $search_text = $_POST['search_text'] ?? '';

                    // SQL Variable Query
                    $sql_search = "SELECT DISTINCT CONCAT(u.fname, ' ', u.lname) AS name, d.apt_date, d.comment, d.morning_med, d.afternoon_med, d.night_med FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE u.role = 'patient' AND `$searchtype` LIKE '%$search_text%';";


                    // MYSQL Query
                    $name_query = mysqli_query($conn, $sql_search);
                    //
                    if ($search) {
                        if ($searchtype) {

                            if(mysqli_num_rows($name_query) > 0) {
                                while ($row = mysqli_fetch_assoc($name_query)) {
                                    echo "<tr>";
                                    echo "<td>{$row['name']}</td>";
                                    echo "<td>{$row['apt_date']}</td>";
                                    echo "<td>{$row['comment']}</td>";
                                    echo "<td>{$row['morning_med']}</td>";
                                    echo "<td>{$row['afternoon_med']}</td>";
                                    echo "<td>{$row['night_med']}</td>";
                                    echo "</tr>";


                                }
                            }

                        }
                    }

                    ?>

            </table>
        </fieldset>
        <!-- Appointment Search Form -->
    </form>
    <form action="doctorhome.php" method="post">
        <input type="date" name="date">
        <button type="submit">Appointments</button>
    </form>
    <table>
        <tr>
            <th>Patient</th>
            <th>Date</th>
        </tr>
        <?php
            $date = $_POST['date'] ?? '';
            $today = date('m/d/Y');
            $docid = $_SESSION['id'];
            $sql_search_date = "SELECT DISTINCT CONCAT(u.fname, ' ', u.lname) AS name, d.apt_date FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE apt_date BETWEEN '$today' and '$date' AND doctorid = '$docid' ";
            $date_query = mysqli_query($conn, $sql_search_date);
            if(mysqli_num_rows($date_query) > 0) {
                while ($row = mysqli_fetch_assoc($date_query)) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['apt_date']}</td>";
                    echo "</tr>";
                    }
                }


            ?>

    </table>

</body>

</html>
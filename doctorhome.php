<?php
include_once 'db.php';
securitygate($conn);
$docid = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME)) ?></title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>

<body>
    <main>


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
                        <th></th>
                    </tr>
                    <?php

                    // POSTS
                    $searchtype = $_POST['searchtype'] ?? '';
                    $search_text = $_POST['search_text'] ?? '';
                    $search = isset($_POST['search']);

                    $morn = $_POST["new_morning"] ?? '';
                    $after = $_POST["new_afternoon"] ?? '';
                    $night = $_POST["new_night"] ?? '';
                    $com = $_POST["new_comment"] ?? '';

                    if ($search) {
                        // SQL Variable Query
                        $sql_search = "SELECT DISTINCT CONCAT(u.fname, ' ', u.lname) AS name, d.apt_date, d.comment, d.morning_med, d.afternoon_med, d.night_med FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE u.role = 'patient' AND doctorid = '$docid' AND `$searchtype` LIKE '%$search_text%'  ;";
                        $name_query = mysqli_query($conn, $sql_search);
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
                        } else {
                        // MYSQL Query
                        $sql_search = "SELECT DISTINCT CONCAT(u.fname, ' ', u.lname) AS name, d.apt_date, d.comment, d.morning_med, d.afternoon_med, u.userid, d.night_med FROM users u JOIN doctor_appt d ON u.userid = d.patientid WHERE doctorid = '$docid' ";
                        $name_query = mysqli_query($conn, $sql_search);
                        $checker = 0;
                        if(mysqli_num_rows($name_query) > 0) {
                            while ($row = mysqli_fetch_assoc($name_query)) {
                                $date = date('Y-m-d');
                                if($row['apt_date'] == $date) {
                                    echo "<tr>";
                                    echo "<td>{$row['name']}</td>";
                                    echo "<td><h3>Today</h3></td>";
                                    echo "<td><label>Comment:<input value = '{$row['comment']}' name='new_comment'></label> </td>";
                                    echo "<td><label>Morning Med:<input value = '{$row['morning_med']}' name='new_morning'> </label></td>";
                                    echo "<td><label>Afternoon Med:<input value ='{$row['afternoon_med']}' name='new_afternoon'> </label></td>";
                                    echo "<td><label>Night Med:<input value ='{$row['night_med']}' name='new_night'> </label></td>";
                                    echo "<td><input type='submit' name='today'></td>";
                                    echo "</tr>";

                                    if (empty($com) == false) {
                                            $makenewcom = "UPDATE doctor_appt SET comment = '$com' WHERE apt_date = '$date' AND doctorid = '$docid' AND patientid = '{$row['userid']}';";
                                            mysqli_query($conn, $makenewcom);
                                            $checker = 1;
                                    }
                                    if (empty($morn) == false) {
                                            $makenewmorn = "UPDATE doctor_appt SET morning_med = '$morn' WHERE apt_date = '$date' AND doctorid = '$docid' AND patientid = '{$row['userid']}';";
                                            mysqli_query($conn, $makenewmorn);
                                            $checker = 1;
                                    }
                                    if (empty($after) == false) {
                                            $makenewafter = "UPDATE doctor_appt SET afternoon_med = '$after' WHERE apt_date = '$date' AND doctorid = '$docid' AND patientid = '{$row['userid']}';";
                                            mysqli_query($conn, $makenewafter);
                                            $checker = 1;
                                    }
                                    if (empty($night) == false) {
                                            $makenewnight = "UPDATE doctor_appt SET night_med = '$night' WHERE apt_date = '$date' AND doctorid = '$docid' AND patientid = '{$row['userid']}';";
                                            mysqli_query($conn, $makenewnight);
                                            $checker = 1;
                                    }
                                    //if ($checker == 1) {
                                    //    header("Refresh:0");
                                    //}
                                    continue;
                                }
                                $sendname = str_replace(' ', '_', $row['name']);
                                $namerow = "/finalproject220/patientofdoc.php?name={$sendname}&docid={$docid}&patid={$row['userid']}";
                                echo "<tr>";
                                echo "<td><a href=$namerow> {$row['name']}</a></td>";
                                echo "<td>{$row['apt_date']}</td>";
                                echo "<td>{$row['comment']}</td>";
                                echo "<td>{$row['morning_med']}</td>";
                                echo "<td>{$row['afternoon_med']}</td>";
                                echo "<td>{$row['night_med']}</td>";
                                echo "</tr>";


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
    </main>
</body>

</html>

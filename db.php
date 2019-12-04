<?php
$currentpage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$conn = new mysqli($dbServername, $dbUsername, $dbPassword);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($currentpage == 'logout') {
    session_destroy();
}

// Database Initialization
$sql = "CREATE DATABASE old_home";
if ($conn->query($sql) === TRUE) {
    echo "Database created";
    $dbName = "old_home";
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    $sql_user = "CREATE TABLE users (
        userid INT AUTO_INCREMENT PRIMARY KEY,
        role varchar(35),
        fname varchar(50),
        lname varchar(50),
        phone char(10),
        dob date,
        email varchar(35),
        pass text,
        approved boolean
    );";

    // Role Table
    $sql_role_table = "CREATE TABLE role (
        page varchar(30) PRIMARY KEY,
        admin boolean,
        patient boolean,
        family boolean,
        doctor boolean,
        supervisor boolean,
        caregiver boolean
        );";


    // Patient Table
    $sql_patient_table = "CREATE TABLE patient (
        userid int,
        FOREIGN KEY (userid) REFERENCES users(userid),
        patientid INT AUTO_INCREMENT UNIQUE PRIMARY KEY,
        family_code int,
        emergency_contact_number char(10),
        relation varchar(50),
        group_num int,
        admission_date date,
        amount_due int
    );";

    // Doctor Appointment Table
    $sql_doctorappt_table = "CREATE TABLE doctor_appt (
        patientid int,
        FOREIGN KEY (patientid) REFERENCES patient(patientid),
        doctorid int,
        FOREIGN KEY (doctorid) REFERENCES users(userid),
        apt_date date,
        complete boolean,
        comment text,
        morning_med text,
        afternoon_med text,
        night_med text
    );";

    // Roster Table
    // The entry of groups must be done on the php side, and can only allow the groups that already exist.
    $sql_roster_table = "CREATE TABLE roster (
        roster_date date PRIMARY KEY,
        supervisor int,
        FOREIGN KEY (supervisor) REFERENCES users(userid),
        doctor int,
        FOREIGN KEY (doctor) REFERENCES users(userid),
        caregiver_1 INT,
        FOREIGN KEY (caregiver_1) REFERENCES users(userid),
        caregiver_group1 INT,
        caregiver_2 INT,
        FOREIGN KEY (caregiver_2) REFERENCES users(userid),
        caregiver_group2 INT,
        caregiver_3 INT,
        FOREIGN KEY (caregiver_3) REFERENCES users(userid),
        caregiver_group3 INT,
        caregiver_4 INT,
        FOREIGN KEY (caregiver_4) REFERENCES users(userid),
        caregiver_group4 INT
    );";

    // Caregiver Table
    $sql_patient_activity_table = "CREATE TABLE patient_activity (
        today date,
        FOREIGN KEY (today) REFERENCES roster(roster_date),
        patientid int,
        FOREIGN KEY (patientid) REFERENCES patient(patientid),
        caregiver int,
        FOREIGN KEY (caregiver) REFERENCES users(userid),
        morning_meds boolean,
        afternoon_meds boolean,
        night_meds boolean,
        breakfast boolean,
        lunch boolean,
        dinner boolean
    );";

    // Employee Table
    $sql_employee_table = "CREATE TABLE employee (
        userid int PRIMARY KEY,
        FOREIGN KEY (userid) REFERENCES users(userid),
        salary int
        );";

    // Prescription Table
    $sql_prescription_table = "CREATE TABLE prescription (patient_id int PRIMARY KEY, doctorid int, FOREIGN KEY (doctorid) REFERENCES doctor_appt(doctorid), appt_exist boolean);";



    // Sample Data

    $sql_user_data = "INSERT INTO users (userid, role, fname, lname, phone, dob, email, pass, approved) VALUES
    (13, 'doctor', 'dr', 'who', '1234567890', '2019-11-30', 'd@a.com', '1', 1),
    (14, 'admin', 'boss', 'admin', '1', '2019-01-01', 'a@a.com', '1', 1),
    (15, 'patient', 'jane', 'smith', '1', '2018-10-29', 'pat@a.com', '1', 1),
    (16, 'patient', 'bob', 'doe', '0987654321', '2015-08-23', 'pat2@a.com', '1', 1),
    (17, 'patient', 'tracy', 'harris', '1234567890', '2009-05-18', 'pat3@a.com', '1', 1),
    (18, 'family', 'jane', 'doe', '1234567890', '2013-03-05', 'fam@a.com', '1', 1),
    (19, 'doctor', 'dr', 'dre', '123456789', '2006-07-06', 'doc@a.com', '1', 1),
    (20, 'doctor', 'evil', 'surgeon', '1234567890', '2006-04-07', 'doc2@a.com', '1', 0),
    (21, 'supervisor', 'eric', 'cartman', '3456789876', '2012-11-20', 'sup@a.com', '1', 1),
    (22, 'caregiver', 'lucy', 'francis', '1234567890', '2014-09-27', 'cg1@a.com', '1', 1),
    (23, 'caregiver', 'izzy', 'rodriguez', '1092837465', '2011-12-28', 'cg2@a.com', '1', 1),
    (24, 'caregiver', 'qincy', 'ruze', '657483892', '2012-03-27', 'cg3@a.com', '1', 1),
    (25, 'caregiver', 'prince', 'op', '1', '2017-10-30', 'cg4@a.com', '1', 1);";

    $sql_default_security = "INSERT INTO role (page, admin, patient, family, doctor, supervisor, caregiver)
    VALUES
    ('adminreport', 1, 0, 0, 0, 0, 0),
    ('role', 1, 0, 0, 0, 0, 0),
    ('caregiverhome', 0, 0, 0, 0, 0, 1),
    ('doctorhome', 0, 0, 0, 1, 0, 0),
    ('familyhome', 0, 0, 1, 0, 0, 0),
    ('patienthome', 0, 1, 0, 0, 0, 0),
    ('supervisorhome', 0, 0, 0, 0, 1, 0),
    ('payment', 1, 0, 0, 0, 1, 0),
    ('newroster', 1, 0, 0, 0, 1, 0),
    ('register', 1, 0, 0, 0, 1, 0),
    ('regapproval', 1, 0, 0, 0, 1, 0);";

    $sql_patient_data = ("INSERT INTO `patient` (`userid`, `patientid`, `family_code`, `emergency_contact_number`, `relation`, `group_num`, `admission_date`, `amount_due`) VALUES
    (15, 15, 54, '90876543', 'mom', 4444, '2019-11-22', 40000),
    (16, 16, 554, '564345654', 'dad', 3211, '2019-11-23', 30000),
    (17, 17, 6543, '345678322', 'killer', 988, '2019-11-25', 1000);
    ");

    $sql_doct_appt_data = "INSERT INTO `doctor_appt` (`patientid`, `doctorid`, `apt_date`, `complete`, `comment`, `morning_med`, `afternoon_med`, `night_med`) VALUES
    (15, 13, '2019-11-30', 0, 'Needs serious help', 'xanax', 'advil', 'hennesy'),
    (16, 20, '2019-11-27', 0, 'Losing his mental health', 'heroin', 'MDMA', 'percs'),
    (17, 19, '2019-11-28', 0, 'I am not qualified to know', 'Weed', 'Whatever he wants', 'Meth');
    ";

    $sql_employee_data = "INSERT INTO `employee` (`userid`, `salary`) VALUES ('14', '100000'), ('25', '20000'), ('24', '20000'), ('23', '20000'), ('22', '20000'), ('20', '30000'), ('19', '30000'), ('13', '30000'), ('21', '25000');";

    $sql_roster_data = "INSERT INTO roster (roster_date, supervisor, doctor, caregiver_1, caregiver_group1, caregiver_2, caregiver_group2, caregiver_3, caregiver_group3, caregiver_4, caregiver_group4) VALUES
    ('2019-12-03', 21, 13, 22, 1, 23, 2, 24, 3, 25, 4),
    ('2019-12-04', 21, 19, 22, 4, 23, 2, 24, 3, 25, 1),
    ('2019-12-05', 21, 20, 23, 1, 24, 2, 22, 4, 25, 3);";

    $sql_patient_activity_data = "INSERT INTO `patient_activity` (`today`, `patientid`, `caregiver`, `morning_meds`, `afternoon_meds`, `night_meds`, `breakfast`, `lunch`, `dinner`) VALUES
    ('2019-12-03', 15, 25, 0, 0, 1, 1, 1, 0),
    ('2019-12-04', 17, 24, 0, 1, 0, 1, 1, 0),
    ('2019-12-05', 16, 22, 1, 1, 1, 1, 1, 1);";

    // SET GLOBAL EVENT SCHEDULER ON;
    $sql_scheduler = "SET GLOBAL event_scheduler = 1;";

    $result = mysqli_query($conn, $sql_scheduler);
    $result = mysqli_query($conn, $sql_user);
    $result = mysqli_query($conn, $sql_role_table);
    $result = mysqli_query($conn, $sql_patient_table);
    $result = mysqli_query($conn, $sql_doctorappt_table);
    $result = mysqli_query($conn, $sql_roster_table);
    $result = mysqli_query($conn, $sql_patient_activity_table);
    $result = mysqli_query($conn, $sql_employee_table);
    $result = mysqli_query($conn, $sql_prescription_table);
    $result = mysqli_query($conn, $sql_user_data);
    $result = mysqli_query($conn, $sql_default_security);
    $result = mysqli_query($conn, $sql_patient_data);
    $result = mysqli_query($conn, $sql_doct_appt_data);
    $result = mysqli_query($conn, $sql_employee_data);
    $result = mysqli_query($conn, $sql_roster_data);
    $result = mysqli_query($conn, $sql_patient_activity_data);
} else { }


$dbName = "old_home";



$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
?>
<link href="style.css" rel="stylesheet">
<nav>
    <ul>
        <?php
        $currentpage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        if (isset($_SESSION['role'])) {
            $sessionrole = $_SESSION['role'];
            $getnav = "SELECT page, $sessionrole FROM role ";
            $theirinfo = mysqli_query($conn, $getnav);
            $resultcheck = mysqli_num_rows($theirinfo);
            if ($resultcheck > 0) {
                while ($tables = mysqli_fetch_assoc($theirinfo)) {
                    if ($tables[$sessionrole] ==  1) {
                        $unchangedpage = $tables['page'];
                        $thepage = ucfirst($tables['page']);
                        if (strpos($thepage, 'home') == True) {
                            $thepage = str_replace("home", " Home", $thepage);
                        }
                        if (strpos($thepage, 'report') == True) {
                            $thepage = str_replace("report", " Report", $thepage);
                        }
                        if (strpos($thepage, 'doctappt') == True) {
                            $thepage = str_replace("doctappt", "Appointments", $thepage);
                        }
                        if (strpos($thepage, 'Newroster') == True) {
                            $thepage = str_replace("New", "New ", $thepage);
                        }
                        if (strpos($thepage, 'approval') == True) {
                            $thepage = str_replace("approval", " Approval", $thepage);
                        }
                        echo "<li><a href='$unchangedpage.php'>" . " $thepage" . "</a></li>";
                    }
                }
            }
        echo "<li><button type='submit' value='logout' name='logout' onclick=location.href='logout.php' >Logout</button></li>";
        $cancel = $_POST['logout'] ?? '';
        }
        ?>



    </ul>
</nav>
<?php
// Security
function securitygate($conn)
{
    $currentpage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
    $sessionrole = $_SESSION['role'];
    $securitycheck = "SELECT $sessionrole FROM role WHERE page = '$currentpage'";
    $clearance = mysqli_query($conn, $securitycheck);
    $passclearance = mysqli_fetch_assoc($clearance);
    if ($passclearance[$sessionrole] == 1) { } else {
        $_SESSION['message'] = "You are not authorized to visit {$currentpage}, you have been logged out.";
        header("Location: /finalproject220/index.php");
    }
}

?>

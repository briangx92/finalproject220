<?php
session_start();
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$conn = new mysqli($dbServername, $dbUsername , $dbPassword);

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
        morning_meds varchar(50),
        afternoon_meds varchar(50),
        night_meds varchar(50)
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
    $sql_prescription_table = "CREATE TABLE prescription ( patient_id int PRIMARY KEY, doctorid int, FOREIGN KEY (doctorid) REFERENCES doctor_appt(doctorid), appt_exist char(1))";

    // Role Table
    $sql_role_table = "CREATE TABLE role (
        page varchar(30) PRIMARY KEY,
        admin boolean,
        patient boolean,
        familyr boolean,
        doctor boolean,
        supervisor boolean,
        caregiver boolean
        );";

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


        $result = mysqli_query($conn, $sql_user);
        $result = mysqli_query($conn, $sql_patient_table );
        $result = mysqli_query($conn, $sql_doctorappt_table);
        $result = mysqli_query($conn, $sql_roster_table);
        $result = mysqli_query($conn, $sql_patient_activity_table);
        $result = mysqli_query($conn, $sql_employee_table);
        $result = mysqli_query($conn, $sql_prescription_table);
        $result = mysqli_query($conn, $sql_user_data);

} else {
}

$dbName = "old_home";



$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);



// Security
function securitygate($conn) {
    $currentpage = basename($_SERVER['PHP_SELF']);
    $sessionrole = $_SESSION['role'];
    $securitycheck = "SELECT $sessionrole FROM role WHERE page = '$currentpage'";
    $clearance = mysqli_query($conn, $securitycheck);
    $passclearance = mysqli_fetch_assoc($clearance);
    if ($passclearance[$sessionrole] == 1) {
    } else {
        $_SESSION['message'] = 'You are not authorized to visit that page, you have been logged out.';
        header("Location: index.php");
    }
}

?>

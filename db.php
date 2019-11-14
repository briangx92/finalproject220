<?php
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
        dob date
    );";

    

    $sql = "CREATE TABLE login (
        userid int PRIMARY KEY,
        FOREIGN KEY (userid) REFERENCES users(userid),
        email varchar(35),
        pass text,
        approved boolean
    );";


    // Patient Table
    $sql_patient_table = "CREATE TABLE patient (
        userid int PRIMARY KEY,
        FOREIGN KEY (userid) REFERENCES users(userid),
        patientid INT AUTO_INCREMENT UNIQUE,
        family_code int,
        emergency_contact char(10),
        emergency_contact_name varchar(50),
        relation varchar(50),
        group_num int,
        admission_date date,
        morning_meds varchar(50),
        afternoon_meds varchar(50),
        night_meds varchar(50)
    );";

    // Doctor Appointment Table
    $sql_doctorappt_table = "CREATE TABLE doctor_appt (
        patientid int PRIMARY KEY,
        FOREIGN KEY (patientid) REFERENCES patient(patientid),
        doctorid int,
        FOREIGN KEY (doctorid) REFERENCES users(userid),
        apt_date date,
        comment text,
        med_records text
    );";

    // Caregiver Table
    $sql_caregiver_table = "CREATE TABLE caregiver (
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

    // Employee Table
    $sql_employee_table = "CREATE TABLE employee (
        userid int PRIMARY KEY,
        FOREIGN KEY (userid) REFERENCES users(userid),
        salary int
        );";
    // Sample Data

    $sql_login_data = "INSERT INTO login (userid, emai, pass, approved) VALUES
    (1, 'sup@a.com', '1', 0),
    (2, 'a@a.com', '1', 0),
    (3, 'patient@a.com', '1', 0),
    (4, 'pat2@a.com', '1', 0),
    (5, 'fam@a.com', '1', 0),
    (6, 'doc@a.com', '1', 0);";
    $sql_patient_data = "INSERT INTO patient (userid, family_code, emergency_contact, emergency_contact_name, relation)
    VALUES (
        3, 12, 5435654564, 'crazy lady', 'mom'),
        (4, 43, 23894984, 'crazy dude', 'dad');";
    
    $sql_user_data = "INSERT INTO users (userid, role, fname, lname, phone, dob) VALUES
    (1, 'supervisor', 'eric', 'cartman', '1234567890', '0022-11-03'),
    (2, 'admin', 'admin', 'admin', '1', '0001-01-01'),
    (3, 'patient', 'john', 'doe', '1234567890', '2023-02-02'),
    (4, 'patient', 'jane', 'doe', '1', '0033-09-03'),
    (5, 'family', 'big', 'doe', '1111111111', '2020-04-20'),
    (6, 'doctor', 'rick', 'sanchez', '1', '0001-01-01');";
    

        $result = mysqli_query($conn, $sql_user);
        $result = mysqli_query($conn, $sql);
        $result = mysqli_query($conn, $sql_patient_table );
        $result = mysqli_query($conn, $sql_doctorappt_table);
        $result = mysqli_query($conn, $sql_roster_table);
        $result = mysqli_query($conn, $sql_caregiver_table);
        $result = mysqli_query($conn, $sql_employee_table);
        $result = mysqli_query($conn, $sql_login_data);
        $result = mysqli_query($conn, $sql_patient_data);
        $result = mysqli_query($conn, $sql_user_data);

} else {
}

$dbName = "old_home";



$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

?>

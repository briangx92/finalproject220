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
    $sql = "CREATE TABLE login (
    userid bigserial PRIMARY KEY,
    email varchar(35),
    pass text,
    approved boolean
);";
$result = mysqli_query($conn, $sql);
$sql2 = "CREATE TABLE user(
userid bigserial PRIMARY KEY,
role varchar(35),
fname varchar(50),
lname varchar(50),
phone char(10),
dob date,
family_code int,
emergency_contact varchar(50),
relation varchar(50)
);";
$result = mysqli_query($conn, $sql2);
} else {
}

$dbName = "old_home";

// Patient Table
$sql_patient_table = "CREATE TABLE patient (
    userid bigserial PRIMARY KEY,
    patientid int,
    patient_name varchar(50),
    family_code int,
    emergency_contact char(10),
    emergency_contact_name varchar(50),
    relation varchar(50),
    group int,
    admission_date date,
    morning_meds varchar(50),
    afternoon_meds varchar(50),
    night_meds varchar(50)
);";

// Doctor Appointment Table
$sql_doctorappt_table = "CREATE TABLE doctor_appt (
    patientid bigserial PRIMARY KEY,
    doctorid bigserial,
    apt_date date,
    comment text,
    med_records text
);";

// Caregiver Table
$sql_caregiver_table = "CREATE TABLE caregiver (
    patientid PRIMARY KEY,
    caregiver_name, varchar(50),
    morning_meds varchar(50),
    afternoon_meds varchar(50),
    night_meds varchar(50),
    breakfast varchar(50),
    lunch varchar(50),
    dinner varchar(50)
);";

// Roster Table
$sql_roster_table = "CREATE TABLE roster (
    roster_date date PRIMARY KEY,
    supervisor varchar(50),
    doctor varchar(50),
    caregiver_1 varchar(50),
    caregiver_group1 varchar(50),
    caregiver_2 varchar(50),
    caregiver_group2 varchar(50),
    caregiver_3 varchar(50),
    caregiver_group3 varchar(50),
    caregiver_4 varchar(50),
    caregiver_group4 varchar(50)
);";

// Employee Table
$sql_employee_table = "CREATE TABLE employee (
    userid bigserial PRIMARY KEY,
    salary int
    );";



$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

?>

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
phone int,
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

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

?>

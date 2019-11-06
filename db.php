<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$conn = new mysqli($dbServername, $dbUsername , $dbPassword);


$sql = "CREATE DATABASE old_home";
if ($conn->query($sql) === TRUE) {
    echo "Database created";
    $dbName = "old_home";
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
    $sql = "CREATE TABLE login (
    User_ID int,
    email varchar(35),
    pass varchar(255),
    approved boolean
);";
$result = mysqli_query($conn, $sql);
$sql2 = "CREATE TABLE user(
User_ID int,
role varchar(35),
fname varchar(255),
lname varchar(255),
phone int,
dob date,
family_code int,
emergency_contact varchar(200),
relation varchar(150)
);";
$result = mysqli_query($conn, $sql2);
} else {
}

$dbName = "old_home";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

?>

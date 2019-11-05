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
    $sql = "CREATE TABLE Login (
    User_ID int,
    email varchar(35),
    password varchar(255),
    approved boolean
);";
$result = mysqli_query($conn, $sql);
} else {
}

$dbName = "old_home";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

?>

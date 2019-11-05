<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$conn = new mysqli($dbServername, $dbUsername , $dbPassword);


$sql = "CREATE DATABASE old_home";
if ($conn->query($sql) === TRUE) {
    echo "Database created";
} else {
}

$dbName = "old_home";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

?>

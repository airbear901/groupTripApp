<?php
// User
$servername = "localhost";
$username = "root";
$password = "root";
$port = 8889;
$dbname = "groupTripApp";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname,$port);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



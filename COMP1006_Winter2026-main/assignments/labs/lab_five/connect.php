<?php
$host = "172.31.22.43";
$user = "Mateo200655020";
$password = "LWTPoqn5W1";
$database = "Mateo200655020";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
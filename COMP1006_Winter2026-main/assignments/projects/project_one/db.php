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

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "172.31.22.43";        // e.g. localhost 
$db   = "Mateo200655020";    // e.g.   mydatabase
$user = "Mateo200655020";    // e.g.  root
$pass = "LWTPoqn5W1";   // e.g. password123

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    // Enable errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
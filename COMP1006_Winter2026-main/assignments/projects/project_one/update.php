<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

// Get POST data
$id = $_POST['id'];
$first = trim($_POST['first_name']);
$last = trim($_POST['last_name']);
$position = trim($_POST['position']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$team = trim($_POST['team_name']);

// Validate
if (empty($first) || empty($last) || empty($position) || empty($phone) || empty($email) || empty($team)) {
    die("All fields are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

if (!preg_match('/^[0-9]{10}$/', $phone)) {
    die("Phone must be 10 digits.");
}

// Update using prepared statement
$stmt = $pdo->prepare("
    UPDATE members
    SET first_name = ?, last_name = ?, position = ?, phone = ?, email = ?, team_name = ?
    WHERE id = ?
");

$stmt->execute([$first, $last, $position, $phone, $email, $team, $id]);

header("Location: index.php");
exit();
?>